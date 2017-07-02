<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user=User::all();
        return view('user.index',['user'=>$user]);
    }
    function delete($id){
        User::destroy($id);
        return Redirect::to('/datatraining/tabel');
    }
    public function update(Request $request){
        User::where('id_user', $request->id)->update([
            'manual_sentimen_label'=>$request->manual_sentimen_label,
            'manual_category_label'=>$request->manual_category_label
        ]);

        return Redirect::to('/user/tabel');
    }
    public function edit($id){
        $user=User::find($id);
        return view('user.edit',['user'=>$user]);
    }
    public function insert(Request $request)
    {
        $this->validate($request,[
            'ontology'=>'required'
        ]);
        User::create([
            'text'=>$request->ontology,
            'parameter'=>$request->parameter
        ]);
        return Redirect::to('/ontology');
    }
}
