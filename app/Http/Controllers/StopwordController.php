<?php

namespace App\Http\Controllers;

use App\Stopword;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class StopwordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $stopword=Stopword::all();
        return view('stopword.index',['stopwords'=>$stopword]);
    }
    public function insert(Request $request)
    {
        $this->validate($request,[
            'stopword'=>'required'
        ]);
        Stopword::create([
            'text'=>$request->stopword
        ]);
        return Redirect::to('/stopword');
    }
    public function update(Request $request){
        Stopword::find($request->id)->update([
            'text'=>$request->stopword
        ]);
        return Redirect::to('/stopword');
    }
    function delete($id){
        Stopword::destroy($id);
        return Redirect::to('/stopword');
    }
}
