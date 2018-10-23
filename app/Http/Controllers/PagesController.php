<?php

namespace App\Http\Controllers;
use App\Jezyk;
use App\Kategoria;
use App\Podkategoria;
use App\Uprawnienia;
use App\Wynik;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Zestaw;

class PagesController extends Controller
{
    public function index() {

        $data = array(
            'title' => 'Nauka Słówek - Jacek Papis 2018',
            'services' => ['Zaloguj się', 'Zarejestruj się']
        );
    	//return view('pages.index',compact('title'));
        return view('pages.index')->with($data);
    }
    public function about() {
        $title = 'Nauka Słówek - Jacek Papis 2018';
        return view('pages.about')->with('title',$title);
    }
    public function services() {
        return view('pages.services');
    }
    public function login() {
        return view('pages.login');
    }
    public function loginError() {
        $kategorie = DB::table('kategoria')->get();
        return view('pages.loginError');
    }
    public function roleError() {
        return view('pages.roleError');
    }
    public function error() {
        return view('pages.error');
    }
    public function adminPanel() {
        
        return redirect('/adminPanel/konta');
        
    }
    public function register() {
        return view('pages.register');
    }
    public function main() {
        $kategorie = DB::table('kategoria')->get();

        return view('pages.main', ['kategorie' => $kategorie]);
    }
    
    public function learning() {
        return view('pages.learning');
    }
    public function testing() {
        return view('pages.testing');
    }
    public function showSubcategories($name){
        //echo $name;
        $idKategoria = DB::table('kategoria')->where('nazwa', $name)->value('id');
        $podkategorie = DB::table('podkategoria')->where('kategoria_id',$idKategoria)->get();
        //foreach ($podkategorie->nazwa as $naz) {
        //    echo $naz;
        //}
        //echo $podkategorie->nazwa;
        return view('pages.subcategories',['name' => $name, 'podkategorie' => $podkategorie]);
    }
    public function showWordSets($kategoria, $podkategoria){
        $canCreate = false;
        $canEdit = false;
        $katId = Kategoria::where('nazwa',$kategoria)->value('id');
        $idPodkategoria = DB::table('podkategoria')
            ->where('nazwa', $podkategoria)
            ->where('kategoria_id',$katId)
            ->value('id');
        $zestawyPubliczne = DB::table('zestaw')->where('private','=',false)
            ->join('konto','konto.id','=','zestaw.konto_id')
            ->join('podkategoria','podkategoria.id','=','zestaw.podkategoria_id')
            ->join('jezyk AS j1','j1.id','=','zestaw.jezyk1_id')
            ->join('jezyk AS j2','j2.id','=','zestaw.jezyk2_id')
            ->select('zestaw.nazwa AS nazwa_zestawu','zestaw.konto_id AS konto_id','j1.nazwa AS jezyk1','j2.nazwa AS jezyk2'
                ,'zestaw.ilosc_slowek AS ilosc_slowek','zestaw.data_edycji AS data_edycji','konto.imie AS imie',
                'konto.nazwisko AS nazwisko','konto.login AS login','zestaw.id')
            ->where('podkategoria_id', $idPodkategoria)
            ->get();
        if(session()->has('loggedUser')) {
            $zestawyPrywatne = DB::table('zestaw')->where('private', '=', true)->where('konto_id', '=', session()->get('loggedUser')->id)
                ->join('konto', 'konto.id', '=', 'zestaw.konto_id')
                ->join('podkategoria', 'podkategoria.id', '=', 'zestaw.podkategoria_id')
                ->join('jezyk AS j1', 'j1.id', '=', 'zestaw.jezyk1_id')
                ->join('jezyk AS j2', 'j2.id', '=', 'zestaw.jezyk2_id')
                ->select('zestaw.nazwa AS nazwa_zestawu', 'zestaw.konto_id AS konto_id', 'j1.nazwa AS jezyk1', 'j2.nazwa AS jezyk2'
                    , 'zestaw.ilosc_slowek AS ilosc_slowek', 'zestaw.data_edycji AS data_edycji', 'konto.imie AS imie',
                    'konto.nazwisko AS nazwisko', 'konto.login AS login', 'zestaw.id')
                ->where('podkategoria_id', $idPodkategoria)
                ->get();
        }
        $wyniki = [];
        if(session()->has('loggedUser')) {
            $j=0;
            foreach ($zestawyPubliczne as $zestaw) {
                $wyniki[$j] = Wynik::orderBy('data_wyniku','ASC')
                    ->where('konto_id', session()->get('loggedUser')->id)
                    ->where('zestaw_id', $zestaw->id)->get()->toArray();
                $j++;
            }
            $j=0;
            foreach ($wyniki as $wynik) {
                $count = count($wynik);
                if($count>10) {
                    for ($i = 0; $i <= $count-11; $i++) {
                        array_shift($wynik);
                    }
                }
                $wyniki[$j] = $wynik;
                    $j++;
            }
            $wynikiPubliczne = $wyniki;
            $j=0;
            if(session()->has('loggedUser')) {
                foreach ($zestawyPrywatne as $zestaw) {
                    $wyniki[$j] = Wynik::orderBy('data_wyniku', 'ASC')
                        ->where('konto_id', session()->get('loggedUser')->id)
                        ->where('zestaw_id', $zestaw->id)->get()->toArray();
                    $j++;
                }
                $j = 0;
                foreach ($wyniki as $wynik) {
                    $count = count($wynik);
                    if ($count > 10) {
                        for ($i = 0; $i <= $count - 11; $i++) {
                            array_shift($wynik);
                        }
                    }
                    $wyniki[$j] = $wynik;
                    $j++;
                }
                $wynikiPrywatne = $wyniki;
            }


        // sprawdzanie czy jest przynajmniej redaktorem i czy ma uprawnienia do tworzenia zestawu słówek
            $uprawnienie = Uprawnienia::where('konto_id',session()->get('loggedUser')->id)
                ->where('podkategoria_id',$idPodkategoria)->get();
            if(count($uprawnienie)&&(session('loggedUser')->rola_id==1||
                    session('loggedUser')->rola_id==2||session('loggedUser')->rola_id==3)) {
            $canCreate = true;
            }
            //}

            $jezyki = Jezyk::all();
            $data = [
                'zestawy'  => $zestawyPubliczne,
                'zestawyPrywatne' => $zestawyPrywatne,
                'kategoria' => $kategoria,
                'podkategoria' => $podkategoria,
                'wyniki' => $wynikiPubliczne,
                'wynikiPrywatne' => $wynikiPrywatne,
                'canCreate' => $canCreate,
                'jezyki' => $jezyki
            ];
        }
        else {
            $jezyki = Jezyk::all();
            $data = [
                'zestawy' => $zestawyPubliczne,
                'kategoria' => $kategoria,
                'podkategoria' => $podkategoria,
                'wyniki' => $wyniki,
                'canCreate' => $canCreate,
                'jezyki' => $jezyki
            ];
        }


        return view('pages.wordSets',['data' => $data]);
    }
    public function choice($kategoria, $podkategoria,$zestaw){
        $kat = Kategoria::where('nazwa',$kategoria)->first();
        $podKat = Podkategoria::where('nazwa',$podkategoria)
            ->where('kategoria_id',$kat->id)
            ->first();
        $zestaw2 = Zestaw::where('nazwa',$zestaw)
            ->where('podkategoria_id',$podKat->id)
            ->first();
        $zestaw2->jezyk1_id = Zestaw::find($zestaw2->id)->jezyk1()->get();
        $zestaw2->jezyk2_id = Zestaw::find($zestaw2->id)->jezyk2()->get();

        //dd($zestaw2->jezyk1_id->first());
        //dd(Zestaw::find($zestaw2->id)->jezyk1()->get());
        $i=0;
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $zestaw2->zestaw) as $line) {
            $word = explode(";", $line);
            $z[$i] = $word;
            $i++;
        }
        $data = [
            'kategoria'  => $kategoria,
            'podkategoria' => $podkategoria,
            'zestaw' => $zestaw,
            'zestawDoDanych' => $z,
            'lang1' => $zestaw2->jezyk1_id->first(),
            'lang2' => $zestaw2->jezyk2_id->first()
        ];
        return view('pages.choice',['data' => $data]);
    }
}