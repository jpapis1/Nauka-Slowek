<?php 

namespace App\Http\Controllers;
use App\Wynik;
use Illuminate\Support\Facades\Input;
use App\Kategoria;
use App\Podkategoria;
use Illuminate\Http\Request;
use App\Zestaw;
use App\Jezyk;
use DB;
use Illuminate\Validation\Rules\In;
use function Sodium\add;

class ZestawController extends Controller
{
    public function addMore()
    {
        return view("addMore");
    }


    public function addMorePost(Request $request)
    {
        $rules = [];
        foreach($request->input('name') as $key => $value) {
            $rules["name.{$key}"] = 'required';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            foreach($request->input('name') as $key => $value) {
                TagList::create(['name'=>$value]);
            }
            return response()->json(['success'=>'done']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);

    }


    public function adminPanel()
    {
        return view('crud.zestaw');
    }


  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
    function createPrivateSet($kategoria,$podkategoria) {
echo $kategoria;
    }
    function mycmp($a, $b) {
        $cmp = strlen($a) - strlen($b);
        if ($cmp === 0)
            $cmp = strcmp($a, $b);
        return $cmp;
    }
    function prepareData($kategoria,$podkategoria, $zestaw, $lang1, $lang2, $alg,$last,$veryLast,$typ) {
        $kat = Kategoria::where('nazwa', $kategoria)->get()->first();
        $pod = Podkategoria::where('nazwa', $podkategoria)
            ->where('kategoria_id', $kat->id)->get()->first();
        $mojZestaw = Zestaw::where('nazwa', $zestaw)
            ->where('podkategoria_id', $pod->id)->get()->first();
        $i = 0;
        if ($mojZestaw->jezyk1_id == $lang1 && $mojZestaw->jezyk2_id == $lang2) {
            foreach (preg_split("/((\r?\n)|(\r\n?))/", $mojZestaw->zestaw) as $line) {
                $word = explode(";", $line);
                $z[$i] = $word;
                $i++;
            }
        } else if ($mojZestaw->jezyk1_id == $lang2 && $mojZestaw->jezyk2_id == $lang1) {
            foreach (preg_split("/((\r?\n)|(\r\n?))/", $mojZestaw->zestaw) as $line) {
                $word = explode(";", $line);
                $temp = $word[0];
                $word[0] = $word[1];
                $word[1] = $temp;
                $z[$i] = $word;
                $i++;
            }
        } else {
            return redirect('/error');
        }
        if($alg==3) {
            //usort($z,'sort');
            //foreach ($z)
            sort($z,SORT_ASC);
            //dd($z);
        } else {
            shuffle($z);
        }
        $zestawy = [
            'zawartosc' => [],
            'odpowiedz' => [],
            'success' => []
        ];
        $y = 0;
        foreach ($z as $zet) {
            $zestawy['zawartosc'][$y] = $z[$y];
            $zestawy['odpowiedz'][$y] = '';
            $zestawy['success'][$y] = '';
            $y++;
        }
        $wordSetData = [
            'typ' => $typ,
            'kategoria' => $kategoria,
            'podkategoria' => $podkategoria,
            'zestaw' => $zestaw,
            'zestaw_id' => $mojZestaw->id,
            'stanObecny' => 0,
            'zestawy' => $zestawy,
            'ostatnieSlowo' => null,
            'veryLast' => $veryLast
        ];

        session(['wordSetData' => $wordSetData],['last' => $last]);
    }
    public function learning(Request $request,$kategoria,$podkategoria, $zestaw, $lang1, $lang2, $alg)
    {
        $last = false;
        $veryLast = false;
        if(!session()->has('wordSetData')) {
            $this->prepareData($kategoria, $podkategoria, $zestaw, $lang1, $lang2, $alg, $last, $veryLast, 'learning');
        }
        if (Input::has('nazwa')) {
            $myWordSet = session()->get('wordSetData');
            $myWordSet['ostatnieSlowo'] = $myWordSet['stanObecny'];
            if ($alg == 1 || $alg == 3) {
                $myWordSet['stanObecny'] = $myWordSet['stanObecny'] + 1; // przechodzimy do kolejnych słówek
                session(['wordSetData' => $myWordSet]);
                $stanPoprzedni = session()->get('wordSetData')['stanObecny'] - 1;
                $wordSet = session()->get('wordSetData');
                $wordSet['zestawy']['odpowiedz'][$stanPoprzedni] = Input::get('nazwa'); // wpisuje odpowiedź
                if (Input::get('nazwa') == session()->get('wordSetData')['zestawy']['zawartosc'][$stanPoprzedni][1]) {

                    $wordSet['zestawy']['success'][$stanPoprzedni] = true; // odpowiedź prawidłowa
                } else {
                    $wordSet['zestawy']['success'][$stanPoprzedni] = false; // odpowiedź nieprawidłowa
                }
                session(['wordSetData' => $wordSet]);

                if (count(session()->get('wordSetData')['zestawy']['zawartosc']) == session()->get('wordSetData')['stanObecny'] + 1) {
                    $last = true;
                    session(['showResult' => true]);
                }
                if (count(session()->get('wordSetData')['zestawy']['zawartosc']) == session()->get('wordSetData')['stanObecny']) {
                    $veryLast = true;
                    session(['showResult' => true]);
                }
            } else if ($alg == 2) {
                //dd($myWordSet);
                $falseIndexes = array();
                $counter = 0;
                if (Input::get('nazwa') == session()->get('wordSetData')['zestawy']['zawartosc'][$myWordSet['ostatnieSlowo']][1]) {

                    $myWordSet['zestawy']['success'][$myWordSet['ostatnieSlowo']] = true; // odpowiedź prawidłowa
                } else {
                    $myWordSet['zestawy']['success'][$myWordSet['ostatnieSlowo']] = false; // odpowiedź nieprawidłowa
                }
                $myWordSet['zestawy']['odpowiedz'][$myWordSet['ostatnieSlowo']] = Input::get('nazwa'); // wpisuje odpowiedź


                for($i = 0;$i<count(session()->get('wordSetData')['zestawy']['success']);$i++) {
                    if($myWordSet['zestawy']['success'][$i]===''||$myWordSet['zestawy']['success'][$i]===false) {
                        $counter++;
                        array_push($falseIndexes,$i);
                    }
                }
                //dd($falseIndexes);
                if($counter>0) {
                    while($myWordSet['stanObecny']==$falseIndexes[0]) {
                        shuffle($falseIndexes);
                    }
                        $myWordSet['stanObecny'] = $falseIndexes[0];
                }
                if ($counter==1) {
                    $last = true;
                    session(['showResult' => true]);
                }
                if ($counter==0) {
                    $veryLast = true;
                    session(['showResult' => true]);
                }
                session(['wordSetData' => $myWordSet]);
            }
        }
        $data = [
            'kategoria' => $kategoria,
            'podkategoria' => $podkategoria,
            'zestaw' => $zestaw,
            'lang1' => $lang1,
            'lang2' => $lang2,
            'alg' => $alg,
            'veryLast' => $veryLast
        ];
        return view ('wordset.showWordSet',['data' =>$data, 'last' => $last]);
    }
    public function testing(Request $request,$kategoria,$podkategoria, $zestaw, $lang1, $lang2, $alg)
    {
        $last = false;
        $veryLast = false;
        if(!session()->has('wordSetData')) {
            $this->prepareData($kategoria, $podkategoria, $zestaw, $lang1, $lang2, $alg, $last, $veryLast, 'testing');
        }
        if (Input::has('nazwa')) {
            if ($alg == 1) {
                $myWordSet = session()->get('wordSetData');
                $myWordSet['stanObecny'] = $myWordSet['stanObecny'] + 1; // przechodzimy do kolejnych słówek
                session(['wordSetData' => $myWordSet]);
                $stanPoprzedni = session()->get('wordSetData')['stanObecny'] - 1;
                $wordSet = session()->get('wordSetData');
                $wordSet['zestawy']['odpowiedz'][$stanPoprzedni] = Input::get('nazwa'); // wpisuje odpowiedź
                if (Input::get('nazwa') == session()->get('wordSetData')['zestawy']['zawartosc'][$stanPoprzedni][1]) {

                    $wordSet['zestawy']['success'][$stanPoprzedni] = true; // odpowiedź prawidłowa
                } else {
                    $wordSet['zestawy']['success'][$stanPoprzedni] = false; // odpowiedź nieprawidłowa
                }
                session(['wordSetData' => $wordSet]);

                if (count(session()->get('wordSetData')['zestawy']['zawartosc']) == session()->get('wordSetData')['stanObecny'] + 1) {
                    $last = true;
                    session(['showResult' => true]);
                }
                if (count(session()->get('wordSetData')['zestawy']['zawartosc']) == session()->get('wordSetData')['stanObecny']) {
                    $veryLast = true;
                    session(['showResult' => true]);
                }
            }
        }
        $data = [
            'kategoria' => $kategoria,
            'podkategoria' => $podkategoria,
            'zestaw' => $zestaw,
            'lang1' => $lang1,
            'lang2' => $lang2,
            'alg' => $alg,
            'veryLast' => $veryLast
        ];
        return view ('wordset.showWordSet',['data' =>$data, 'last' => $last]);

    }
    public function checkAndShowResult(Request $request,$kategoria,$podkategoria, $zestaw, $lang1, $lang2, $alg) {
        $last = false;
        $veryLast = false;
        if(!session()->has('wordSetData')) {
            $this->prepareData($kategoria, $podkategoria, $zestaw, $lang1, $lang2, $alg, $last, $veryLast, 'learning');
        }
        if (Input::has('nazwa')) {
            $myWordSet = session()->get('wordSetData');
            $myWordSet['ostatnieSlowo'] = $myWordSet['stanObecny'];
            if ($alg == 1 | $alg == 3) {
                $myWordSet['stanObecny'] = $myWordSet['stanObecny'] + 1; // przechodzimy do kolejnych słówek
                session(['wordSetData' => $myWordSet]);
                $stanPoprzedni = session()->get('wordSetData')['stanObecny'] - 1;
                $wordSet = session()->get('wordSetData');
                $wordSet['zestawy']['odpowiedz'][$stanPoprzedni] = Input::get('nazwa'); // wpisuje odpowiedź
                if (Input::get('nazwa') == session()->get('wordSetData')['zestawy']['zawartosc'][$stanPoprzedni][1]) {

                    $wordSet['zestawy']['success'][$stanPoprzedni] = true; // odpowiedź prawidłowa
                } else {
                    $wordSet['zestawy']['success'][$stanPoprzedni] = false; // odpowiedź nieprawidłowa
                }
                session(['wordSetData' => $wordSet]);

                if (count(session()->get('wordSetData')['zestawy']['zawartosc']) == session()->get('wordSetData')['stanObecny'] + 1) {
                    $last = true;
                    session(['showResult' => true]);
                }
                if (count(session()->get('wordSetData')['zestawy']['zawartosc']) == session()->get('wordSetData')['stanObecny']) {
                    $veryLast = true;
                    session(['showResult' => true]);
                }
            } else if ($alg == 2) {
                //dd($myWordSet);
                $falseIndexes = array();
                $counter = 0;
                if (Input::get('nazwa') == session()->get('wordSetData')['zestawy']['zawartosc'][$myWordSet['ostatnieSlowo']][1]) {

                    $myWordSet['zestawy']['success'][$myWordSet['ostatnieSlowo']] = true; // odpowiedź prawidłowa
                } else {
                    $myWordSet['zestawy']['success'][$myWordSet['ostatnieSlowo']] = false; // odpowiedź nieprawidłowa
                    $data = [
                        'kategoria' => $kategoria,
                        'podkategoria' => $podkategoria,
                        'zestaw' => $zestaw,
                        'lang1' => $lang1,
                        'lang2' => $lang2,
                        'alg' => $alg,
                        'veryLast' => $veryLast,
                        'ostatnieSlowo1' => $myWordSet['zestawy']['zawartosc'][$myWordSet['ostatnieSlowo']][0],
                        'ostatnieSlowo2' => $myWordSet['zestawy']['zawartosc'][$myWordSet['ostatnieSlowo']][1],
                        'ostatniaOdpowiedz' => Input::get('nazwa')
                    ];
                    $last = true;
                    return view ('wordset.showWordSet',['data' =>$data, 'last' => $last]);
                }
                $myWordSet['zestawy']['odpowiedz'][$myWordSet['ostatnieSlowo']] = Input::get('nazwa'); // wpisuje odpowiedź


                for($i = 0;$i<count(session()->get('wordSetData')['zestawy']['success']);$i++) {
                    if($myWordSet['zestawy']['success'][$i]===''||$myWordSet['zestawy']['success'][$i]===false) {
                        $counter++;
                        array_push($falseIndexes,$i);
                    }
                }
                //dd($falseIndexes);
                if($counter>0&&$counter!=1) {
                    while($myWordSet['stanObecny']==$falseIndexes[0]) {
                        shuffle($falseIndexes);
                    }
                    $myWordSet['stanObecny'] = $falseIndexes[0];
                }
                if ($counter==1) {
                    $last = true;
                    session(['showResult' => true]);
                }
                if ($counter==0) {
                    $veryLast = true;
                    session(['showResult' => true]);
                }
                session(['wordSetData' => $myWordSet]);
            } else if ($alg == 3) {

            }
        }
        $data = [
            'kategoria' => $kategoria,
            'podkategoria' => $podkategoria,
            'zestaw' => $zestaw,
            'lang1' => $lang1,
            'lang2' => $lang2,
            'alg' => $alg,
            'veryLast' => $veryLast
        ];










        if(session()->has('wordSetData')) {
            $wynik = new Wynik;
            $wynik->konto_id = session()->get('loggedUser')['id'];
            $wynik->zestaw_id =session()->get('wordSetData')['zestaw_id'];
            $wynik->data_wyniku = date("Y-m-d");
            $counter = 0;
            //dd(session()->get('wordSetData')['zestawy']['success']);
            foreach (session()->get('wordSetData')['zestawy']['success'] as $success) {
                if($success==true) {
                    $counter++;
                }
            }
            $wynik->wynik = $counter;
            $data = [
                'wynik' => $wynik,
                'daneOWynikach' => session()->get('wordSetData')
            ];
            if(session()->has('loggedUser')&& session()->get('wordSetData')['typ']=='testing') {
                //echo "zalogowany testing";
                //echo "zapisz";
                $wynik->save();
                //$wynik->wynik = session()->get('wordSetData')['zestawy']

                return view ('wordset.showResult',['data' => $data]);
            } else if(session()->has('loggedUser')&& session()->get('wordSetData')['typ']=='learning'){
                return view ('wordset.showResult',['data' => $data]);
            } else if(session()->get('wordSetData')['typ']=='learning'){
                return view ('wordset.showResult',['data' => $data]);
            } else if(session()->get('wordSetData')['typ']=='testing') {
                return view ('wordset.showResult',['data' => $data]);
            } else {
                return view('pages.error');
            }
        }
        return view ('pages.error');

    }
   /* public function showResult() {
        if(session()->has('wordSetData')) {
            $wynik = new Wynik;
            $wynik->konto_id = session()->get('loggedUser')['id'];
            $wynik->zestaw_id =session()->get('wordSetData')['zestaw_id'];
            $wynik->data_wyniku = date("Y-m-d");
            $counter = 0;
            //dd(session()->get('wordSetData')['zestawy']['success']);
            foreach (session()->get('wordSetData')['zestawy']['success'] as $success) {
                if($success==true) {
                    $counter++;
                }
            }
            $wynik->wynik = $counter;
            $wynik->wynik = $counter;
            $data = [
                'wynik' => $wynik,
                'daneOWynikach' => session()->get('wordSetData')
            ];
            dd(session()->get('wordSetData')['typ']);
            if(session()->has('loggedUser')&& session()->get('wordSetData')['typ']=='testing') {
                echo 'zapisz';
                $wynik->save();
                //$wynik->wynik = session()->get('wordSetData')['zestawy']

                return view ('wordset.showResult',['data' => $data]);
            } else if(session()->has('loggedUser')&& session()->get('wordSetData')['typ']=='learning'){

                return view ('wordset.showResult',['data' => $data]);
            } else {
                echo "what";
            }
        }
        return view ('pages.error');

    }
   */
  public function index()
  {
    $zestawy = Zestaw::all()->toArray();
    $jezyki = Jezyk::all()->zestaw();
    dd($jezyki);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create($kategoria,$podkategoria)
  {
      $kat = Kategoria::where('nazwa', $kategoria)->first();
      $podKat = Podkategoria::where('nazwa', $podkategoria)
          ->where('kategoria_id', $kat->id)
          ->first();

      $zawartosc = Input::get('name');
      $str = "";
      $counter = 0;
      for ($i = 0; $i < count($zawartosc); $i = $i + 2) {
              $str = $str . $zawartosc[$i] . ';' . $zawartosc[$i + 1] . "\r\n";


          $counter++;
      }
      $str = substr($str,0,strlen($str)-2);
      $private = true;
      if (Input::has('private')) {
          $private = false;
      }
      $zestaw = new Zestaw;
      $zestaw->konto_id = session()->get('loggedUser')->id;
      $zestaw->jezyk1_id = Jezyk::all()->where('nazwa', Input::get('jezyk1'))->first()->id;
      $zestaw->jezyk2_id = Jezyk::all()->where('nazwa', Input::get('jezyk2'))->first()->id;
      $zestaw->podkategoria_id = $podKat->id;
      $zestaw->nazwa = Input::get('nazwaZestawu');
      $zestaw->zestaw = $str;
      $zestaw->ilosc_slowek = $counter;
      $zestaw->data_edycji = date("Y-m-d");
      $zestaw->private = $private;
      $zestaw->save();
      return \App::make('redirect')->refresh();
     // dd($zestaw);
  }
  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
    public function makeEdit($kat,$id) {


        $nazwaZestawu = Input::get('nazwa');
        $jezyk1 = Jezyk::all()->where('nazwa','=',Input::get('jezyk1'))->first()->toArray()['id'];
        $jezyk2 = Jezyk::all()->where('nazwa','=',Input::get('jezyk2'))->first()->toArray()['id'];
        $zawartosc = Input::get('name');
        $counter = 0;
        $str = '';
        for ($i = 0; $i < count($zawartosc); $i = $i + 2) {
            $str = $str . $zawartosc[$i] . ';' . $zawartosc[$i + 1] . "\r\n";
            $counter++;
        }
        $str = substr($str,0,strlen($str)-2);

        $zestaw = Zestaw::find($id);
        $zestaw->nazwa = $nazwaZestawu;
        $zestaw->jezyk1_id = $jezyk1;
        $zestaw->jezyk2_id = $jezyk2;
        $zestaw->zestaw = $str;
        $zestaw->ilosc_slowek = $counter;
        $zestaw->data_edycji = date('Y-m-d');
        $wyniki = Wynik::where('zestaw_id',$zestaw->id)->delete();
        $zestaw->save();
        $podKat = Podkategoria::find($zestaw->podkategoria_id)->nazwa;
        return redirect('/category/' . $kat . '/' . $podKat);
    }
  public function edit($kat,$id)
  {
      //dd($id);
      $zestaw = Zestaw::find($id)->toArray();
      $jezyki = Jezyk::all();
      $podkategorie = Podkategoria::all();
      $jezyk1 = Jezyk::all()->where('id','=',$zestaw['jezyk1_id'])->first()->toArray();
      $jezyk2 = Jezyk::all()->where('id','=',$zestaw['jezyk2_id'])->first()->toArray();

      $z = array();
      $i = 0;
      foreach (preg_split("/((\r?\n)|(\r\n?))/", $zestaw['zestaw']) as $line) {
          $word = explode(";", $line);
          $z[$i] = $word;
          $i++;
      }

      $zestaw['zestaw'] = $z;
      //dd($zestaw);
      return view('crud.edit.zestawEdit',['zestaw' => $zestaw,'jezyk1' => $jezyk1, 'jezyk2' => $jezyk2,'jezyki' => $jezyki,'podkategorie' => $podkategorie,'kat'=>$kat,'id' => $id]);

    //$zestaw()
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
    public function destroy($kat,$id)
    {
        Zestaw::find($id)->delete();
        return back();

    }
  
}

?>