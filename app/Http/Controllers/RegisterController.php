<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    Public function index(){
        return view('members.create');
    }

    Public function store(Request $request)
    {
        //dd($request->all());
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
            ]
            );
        User::create($request->all() + ['is_admin' => 0] + ['password'=> bcrypt('123456')]);
        return redirect()->route('members');
    }

    public function edit($id)
    {
        $member = User::find($id);

        return view('members.edit', compact('member'));
    }

    public function update(User $user, Request $request)
    {
        
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
            ]
            );
            //dd($request->all());
            $user = User::find($request->id);
            //dd($user);
            $responce = $user->update($request->all());
            if($responce)
            {
                $notification = array(
                    'message' => 'successfully updated',
                    'alert-type' => 'success'
                );
                return redirect()->route('members')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Error while updating',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
    }

    public function destroy(Request $request){
        $id = $request->id; 
        User::destroy($id);

        return json_encode(array("success"=>true));
    }
}