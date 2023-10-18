<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\Account;
use App\Models\Setdeposit;
use App\Models\Addmember;
use Illuminate\Http\Request;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __contruct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd('create pay');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'amount' => 'required',
            'type' => 'required',
            'addmember_id' => 'required',
            'setdeposit_id' => 'required',
        ]);
        
        $setdeposit = Setdeposit::find($request->setdeposit_id);
    
        $get_all_pay = Pay::where('addmember_id',$request->addmember_id)->get();
        
        $total_pay = $get_all_pay->map(function($i){
            return $i->amount;
        })->sum();
        
        $balance = $setdeposit->amount - $total_pay;
        
        if($balance > 0)
        {
            if($request->amount >= $balance)
            {
                $to_account = $request->amount - $balance;
                if($to_account > 0)
                {
                    $account = new Account();
                    $member = Addmember::find($request->addmember_id);
                    $account->user_id = $member->user_id;
                    $account->amount = $to_account;
                    $account->save();
                }
                $amount = strval($balance);
                $pay = new Pay();
                $pay->amount = $amount;
                $pay->type = $request->type;
                $pay->addmember_id = $request->addmember_id;
                $pay->setdeposit_id = $request->setdeposit_id;
                $pay->save();
            }else{
                Pay::create($request->all());
            }
            $notification = array(
                'message' => 'Succefully Paid',
                'alert-type' => 'success'
            );
            return redirect()->route('setdeposit.show', $request->setdeposit_id)->with($notification);
            
        }else{
            $notification = array(
                'message' => 'already paid full amount',
                'alert-type' => 'info'
            );
            return redirect()->route('setdeposit.show', $request->setdeposit_id)->with($notification);
        }
        
        
        return redirect()->route('setdeposit.show', $request->setdeposit_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function show(Pay $pay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function edit(Pay $pay)
    {
        //
        return view('finance.pay.edit', compact('pay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pay $pay)
    {
        //
        //dd($request->all());
        $request->validate(
            [
                'amount' => 'required',
                'type' => 'required',
            ]
            );
            $responce = $pay->update($request->all());
            if($responce)
            {
                $notification = array(
                    'message' => 'Succefully Updated',
                    'alert-type' => 'success'
                );
                return redirect()->route('pay.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Error while updating',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            }
    }

    public function makepayment($user_id, $setdeposit_id)
    {
        return view('finance.pay.create', compact('user_id','setdeposit_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pay $pay)
    {
        //
    }
}
