<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jezyk;

class JezykController extends Controller 
{
    public function adminPanel() {

        $jezyki = Jezyk::orderBy('nazwa','ASC')->get();
        //dd($nazwy_rol);
        return view('crud.jezyk',['jezyki'=>$jezyki]);


    }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $jezyks = Jezyk::all()->toArray();
    //dd($jezyks);
    return view('crud.jezyk');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
    public function create(Request $request)
    {
        $jezyk = new Jezyk;
        $jezyk->nazwa = $request->input('slowo');
        $jezyk->save();
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
        Jezyk::find($id)->delete();
        return back();

    }
  
}

?>