<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __contruct()
    {
        $this->middlewate('auth');
    }
    public function index()
    {
        //
        $users = User::get();
        
        return view('account.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd('creating');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
        $user = User::find($account);
        //dd($user);
        return view('account.show', compact('account'));
    }

    //show account payment breakdown
    public function show_pay($id)
    {
        $user = User::find($id);
        //dd($user->account());
        return view('account.show', compact('user'));
    }

    /** P051950272J
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */

    public function add($id)
    {
        //dd($id);
        return view('account.create', compact('id'));
    }

    public function adding(Request $request, $id)
    {
        //dd($request->all());
        //dd($id);
        $account = new Account();
        $account->user_id = $id;
        $account->amount = $request->amount;
        $account->save();
        
        if($account)
            {
                $notification = array(
                    'message' => 'successfully added',
                    'alert-type' => 'success'
                );
                return redirect()->route('account.show', $id)->with($notification);
            }else{
                $notification = array(
                    'message' => 'Error while updating',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        return redirect()->back()->with($notification);
    }

    public function edit(Account $account)
    {
        //
        dd('editing');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
