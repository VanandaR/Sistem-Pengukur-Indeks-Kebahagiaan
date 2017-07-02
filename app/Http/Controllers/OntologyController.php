<?php

namespace App\Http\Controllers;

use App\Ontology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OntologyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $ontology=Ontology::all();
        return view('ontology.index',['ontology'=>$ontology]);
    }
    public function insert(Request $request)
    {
        $this->validate($request,[
            'ontology'=>'required'
        ]);
        Ontology::create([
            'text'=>$request->ontology,
            'parameter'=>$request->parameter
        ]);
        return Redirect::to('/ontology');
    }
    public function update(Request $request){
        Ontology::find($request->id)->update([
            'text'=>$request->ontology,
            'parameter'=>$request->parameter
        ]);
        return Redirect::to('/ontology');
    }
    function delete($id){
        Ontology::destroy($id);
        return Redirect::to('/ontology');
    }
}
