<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rola;
class RolaController extends Controller 
{
    public function adminPanel() {

        $role =Rola::all();
        //dd($nazwy_rol);
        return view('crud.rola',['role' => $role]);


    }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $role = Rola::all()->toArray();
    dd($role);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
    public function create(Request $request)
    {
        $rola = new Rola();
        $rola->nazwa = $request->input('nazwa');
        $rola->opis = $request->input('opis');
        $rola->save();
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
        Rola::find($id)->delete();
        return back();

    }
  
}

?>