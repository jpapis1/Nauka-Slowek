<?php 

namespace App\Http\Controllers;
use App\User;
use App\Zestaw;
use Illuminate\Http\Request;
use App\Wynik;
class WynikController extends Controller 
{
    public function adminPanel() {

        // Klucze Obce
        $konta =User::all();
        $zestawy =Zestaw::all();
        $data = [
            'konta'  => $konta,
            'zestawy'   => $zestawy
        ];
        // Klucz główny
        $wyniki = Wynik::all();
        foreach ($wyniki as $wynik) {
            $wynik->konto_id = Wynik::find($wynik->id)->konto()->get();
            $wynik->zestaw_id = Wynik::find($wynik->id)->zestaw()->get();
        }

        return view('crud.wynik',['wyniki' => $wyniki],['data'=>$data]);


    }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $wyniki = Wynik::all()->toArray();
    dd($wyniki);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
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
        Wynik::find($id)->delete();
        return back();

    }
  
}

?>