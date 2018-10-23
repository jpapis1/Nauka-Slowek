<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rola;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class KontoController extends Controller
{
    public function adminPanel() {
        $role = Rola::all();
        $nazwy_rol = array();
        foreach ($role as $rola) {
            //$role = $rola->nazwa;
            array_push($nazwy_rol, $rola->nazwa);
        }

        $users = User::orderBy('login','ASC')->get();
        foreach ($users as $user) {
            $user->rola_id = User::find($user->id)->rola()->get();

        }
        //dd($nazwy_rol);
        return view('crud.konto',['role' => $nazwy_rol],['konta'=>$users]);

    }
    public function changeData() {

        $konto = User::find(session()->get('loggedUser')->id);
        if(Input::get('login')!=$konto->login) {
            $konto->login = Input::get('login');
        }
        if(Input::get('imie')!=$konto->imie) {
            $konto->imie = Input::get('imie');
        }
        if(Input::get('nazwisko')!=$konto->nazwisko) {
            $konto->nazwisko = Input::get('nazwisko');
        }
        $konto->save();


        session(['loggedUser' =>$konto]);
        return redirect('/profile');

    }
    public function changePassword() {
        if(password_verify(Input::get('oldPass'),session()->get('loggedUser')->haslo)) {
            $konto = User::find(session()->get('loggedUser')->id);
            $konto->haslo = password_hash(Input::get('newPass'),PASSWORD_BCRYPT);
            $konto->save();
            session(['loggedUser' =>$konto]);
            return redirect('/profile');
        } else {
            return redirect('/error');
        }
    }
    public function changeSomeonesPassword($id) {
        $konto = User::find($id);
        $konto->haslo = password_hash(Input::get('newPass'),PASSWORD_BCRYPT);
        $konto->save();
        return redirect('adminPanel/konta');
    }
  public function register(Request $request) {
    /*$this>validate($request, [
      'login' => 'required',
      'imie' => 'required',
      'nazwisko' => 'required',
      'email' => 'required|email',
      'haslo' => 'required'
    ]);*/

      $user = new User;
      $user->rola_id = '4';
      $user->login = $request->input('login');
      $user->imie = $request->input('imie');
      $user->nazwisko = $request->input('nazwisko');
      $user->email = $request->input('email');
      $user->haslo = password_hash($request->input('pass'),PASSWORD_BCRYPT);
      $user->save();
      session(['loggedUser' =>$user]);
      return redirect()->action(
      'PagesController@main'
      );
  }
    public function logout(Request $request) {
        /*$this>validate($request, [
          'login' => 'required',
          'imie' => 'required',
          'nazwisko' => 'required',
          'email' => 'required|email',
          'haslo' => 'required'
        ]);*/

        session()->forget('loggedUser');
        session()->forget('idRola');
        if (session()->has('wordSetData')) {
            session()->forget('wordSetData');
        }
        //echo 'hello';
        return redirect()->action(
            'PagesController@main'
        );
    }
    public function login(Request $request) {
        /*$this>validate($request, [
          'login' => 'required',
          'imie' => 'required',
          'nazwisko' => 'required',
          'email' => 'required|email',
          'haslo' => 'required'
        ]);*/
        $user = User::where('login','=',$request->input('login'))->first();
        //dd($user);
        if($user!=null) {
            $hash = $user->haslo;
            if(password_verify($request->input('pass'),$hash)) {
                // hasło poprawne
                session(['loggedUser' =>$user]);
                return redirect()->action(
                    'PagesController@main'
                );
            } else {
                return redirect()->action(
                    'PagesController@loginError'
                );
                // hasło niepoprawne
            }
        } else {
            // użytkownik nie istnieje
            return redirect()->action(
                'PagesController@loginError'
            );

        }

        //return redirect()->action(
        //    'PagesController@main'
       // );
    }

    public function profile()
    {
        $user = User::where('login','=',session('loggedUser')->login)->first();
        $user->rola_id = User::find($user->id)->rola()->first();
        return view('account.profile',['nazwa_roli' => $user->rola_id->nazwa]);
    }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $konta = User::all()->toArray();
    //dd($konta);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request)
  {
      $rola = Rola::where('nazwa','=',$request->input('rola'))->first();
      $user = new User;
      $user->rola_id = $rola->id;
      $user->login = $request->input('login');
      $user->imie = $request->input('imie');
      $user->nazwisko = $request->input('nazwisko');
      $user->email = $request->input('email');
      $user->haslo = password_hash($request->input('pass'),PASSWORD_BCRYPT);
      $user->save();
      return \App::make('redirect')->refresh();
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
  public function edit($id)
  {
    $konto = User::find($id)->toArray();
    $mojaRola = Rola::all()->where('id','=',$konto['rola_id'])->first()->toArray();
    $role = Rola::all()->toArray();
    return view('crud.edit.kontoEdit',['konto' => $konto,'mojaRola' => $mojaRola,'role' => $role,'id' => $id]);
  }
    public function makeEdit($id) {
        $rola = Rola::all()->where('nazwa','=',Input::get('rola'))->first()->toArray();
        $konto = User::find($id);
        $konto->login = Input::get('login');
        $konto->imie = Input::get('imie');
        $konto->nazwisko = Input::get('nazwisko');
        $konto->email = Input::get('email');
        $konto->rola_id = $rola['id'];
        $konto->save();
        return redirect('adminPanel/konta');
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
  public function destroy($id)
  {
     User::find($id)->delete();
     return back();

  }
  
}

?>