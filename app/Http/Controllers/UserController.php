<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Redirect;
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
        User::where('id', $request->id)->update([
            'name'=>$request->username,
            'email'=>$request->email,
            'role_id'=>$request->role,
        ]);

        return Redirect::to('/user');
    }
    public function edit($id){
        $user=User::find($id);
        $role=Role::all();
        return view('user.edit',['user'=>$user,'role'=>$role]);
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
