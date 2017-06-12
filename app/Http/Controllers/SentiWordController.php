<?php

namespace App\Http\Controllers;

use App\Sentiword;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class SentiwordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $Sentiword=Sentiword::all();
        return view('Sentiword.index',['sentiword'=>$Sentiword]);
    }
    public function insert(Request $request)
    {
        $this->validate($request,[
            'sentiword'=>'required',
            'pos_score'=>'required',
            'neg_score'=>'required'
        ]);
        Sentiword::create([
            'text'=>$request->sentiword,
            'pos_score'=>$request->pos_score,
            'neg_score'=>$request->neg_score
        ]);
        return Redirect::to('/sentiword');
    }
    public function update(Request $request){;
        Sentiword::find($request->id)->update([
            'text'=>$request->sentiword,
            'pos_score'=>$request->pos_score,
            'neg_score'=>$request->neg_score
        ]);
        return Redirect::to('/sentiword');
    }
    function delete($id){
        Sentiword::destroy($id);
        return Redirect::to('/sentiword');
    }
}
