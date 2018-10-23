<?php 

namespace App\Http\Controllers;

use App\Podkategoria;
use Illuminate\Http\Request;
use App\Uprawnienia;
use App\User;
class UprawnieniaController extends Controller 
{
    public function adminPanel() {
        // Klucze Obce
        $konta =User::all()->whereIn('rola_id', array(2, 3));
        $podkategorie =Podkategoria::all();
        $data = [
            'konta'  => $konta,
            'podkategorie'   => $podkategorie
        ];
        // Klucz główny
        $uprawnienia = Uprawnienia::orderBy('konto_id','DESC')->get();
        foreach ($uprawnienia as $uprawnienie) {
            $uprawnienie->konto_id = Uprawnienia::find($uprawnienie->id)->konto()->get();
            $uprawnienie->podkategoria_id = Uprawnienia::find($uprawnienie->id)->podkategoria()->get();
        }
        return view('crud.uprawnienia',['uprawnienia' => $uprawnienia],['data'=>$data]);

    }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $uprawnienia = Uprawnienia::all()->toArray();
    dd($uprawnienia);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
    public function create(Request $request)
    {
        $konto = User::where('login','=',$request->input('login'))->first();
        $podkategoria = Podkategoria::where('nazwa','=',$request->input('podkategoria'))->first();
        $uprawnienia = new Uprawnienia;
        $uprawnienia->konto_id = $konto->id;
        $uprawnienia->podkategoria_id = $podkategoria->id;
        $uprawnienia->save();
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
        Uprawnienia::find($id)->delete();
        return back();

    }
  
}

?>