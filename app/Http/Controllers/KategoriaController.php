<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategoria;
use Illuminate\Support\Facades\Input;

class KategoriaController extends Controller
{
    public function adminPanel() {

    $kategorie = Kategoria::all();

    //dd($nazwy_rol);
    return view('crud.kategoria',['kategorie'=>$kategorie]);


}
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
    public function create(Request $request)
    {
        $kategoria = new Kategoria;
        $kategoria->nazwa = $request->input('nazwa');
        $kategoria->opis = $request->input('opis');
        $kategoria->save();
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
      $kategoria = Kategoria::find($id)->toArray();
      return view('crud.edit.kategoriaEdit',['kategoria' => $kategoria,'id' => $id]);
  }
    public function makeEdit($id)
    {
        $kategoria = Kategoria::find($id);
        $kategoria->nazwa = Input::get('nazwa');
        $kategoria->opis = Input::get('opis');
        $kategoria->save();
        return redirect('adminPanel/kategorie');
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
        Kategoria::find($id)->delete();
        return back();

    }
  
}

?>