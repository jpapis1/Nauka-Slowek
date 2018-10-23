<?php 

namespace App\Http\Controllers;

use App\Kategoria;
use Illuminate\Http\Request;
use App\Podkategoria;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class PodkategoriaController extends Controller
{
    public function adminPanel() {

        $kategorie =Kategoria::all();
        $nazwy_kategorii = array();
        foreach ($kategorie as $kategoria) {
            //$role = $rola->nazwa;
            array_push($nazwy_kategorii, $kategoria->nazwa);
        }

        //$podkategorie = Podkategoria::all();
        $podkategorie = Podkategoria::orderBy('kategoria_id','ASC')->get();
        foreach ($podkategorie as $podkategoria) {
            $podkategoria->kategoria_id = Podkategoria::find($podkategoria->id)->kategoria()->get();
        }

        //dd($nazwy_rol);
        return view('crud.podkategoria',['podkategorie' => $podkategorie],['kategorie'=>$kategorie]);


    }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $podkategorie = Podkategoria::all()->toArray();
    dd($podkategorie);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request)
  {
      $kategoria = Kategoria::where('nazwa','=',$request->input('kategoria'))->first();
      $podkategoria = new Podkategoria;
      $podkategoria->kategoria_id = $kategoria->id;
      $podkategoria->nazwa = $request->input('nazwa');
      $podkategoria->opis = $request->input('opis');
      $podkategoria->save();
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
      $podkategoria = Podkategoria::find($id)->toArray();
      $mojaKategoria = Kategoria::all()->where('id','=',$podkategoria['id'])->first()->toArray();
      $kategorie = Kategoria::all()->toArray();
      return view('crud.edit.podkategoriaEdit',['podkategoria' => $podkategoria,'mojaKategoria' => $mojaKategoria,'kategorie' => $kategorie,'id' => $id]);
  }
    public function makeEdit($id)
    {
        $mojaKategoria = Kategoria::all()->where('nazwa','=',Input::get('kategoria'))->first()->toArray();
        $podkategoria = Podkategoria::find($id);
        $podkategoria->kategoria_id = $mojaKategoria['id'];
        $podkategoria->nazwa = Input::get('nazwa');
        $podkategoria->opis = Input::get('opis');
        $podkategoria->save();
        return redirect('adminPanel/podkategorie');
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
        Podkategoria::find($id)->delete();
        return back();

    }
  
}

?>