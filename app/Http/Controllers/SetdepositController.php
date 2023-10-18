<?php

namespace App\Http\Controllers;

use App\Models\Setdeposit;
use App\Models\User;
use App\Models\Addmember;
use App\Models\Payment;
use Illuminate\Http\Request;

class SetdepositController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $deposits = Setdeposit::with('payments')->get();

        //check balance from pay
        //sum up all the balance
        //dd($deposits);
        foreach($deposits as $data)
        {
            //dd($data);
            $member = Addmember::where('setdeposit_id',$data->id)->get();
            //dd($member);
        }
        return view('finance.setdeposit.index', compact('deposits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('finance.setdeposit.create');
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
        //$request->all();
        $deposit = $request->validate(
            [
                'title' => 'required',
                'amount' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]
            );

            Setdeposit::create($request->all() + ['status' => 0]);
            return redirect()->route('setdeposit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setdeposit  $setdeposit
     * @return \Illuminate\Http\Response
     */
    public function show(Setdeposit $setdeposit)
    {
        //
        //dd($setdeposit);
        $members = Addmember::where('setdeposit_id',$setdeposit->id)->get();
        //dd($members);
        //dd($members->totalPayments()); 
        //dd($members->user());
        return view('finance.setdeposit.show', compact('setdeposit', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setdeposit  $setdeposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Setdeposit $setdeposit)
    {
        //
        return view('finance.setdeposit.edit', compact('setdeposit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setdeposit  $setdeposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setdeposit $setdeposit)
    {
        //
        
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        //dd($request->all());
        $responce = $setdeposit->update($request->all()); 
        if($responce)
            {
                $notification = array(
                    'message' => 'successfully updated',
                    'alert-type' => 'success'
                );
                return redirect()->route('setdeposit.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Error while updating',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        
        //return redirect()->route('setdeposit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setdeposit  $setdeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setdeposit $setdeposit)
    {
        //deleting a setdeposit pamanently
        $setdeposit->destroy();
    }

    public function addmember($deposit_id)
    {
        //dd($deposit_id);
        $users = User::get();
        return view('finance.setdeposit.addmember', compact('users', 'deposit_id'));
    }

    public function storemember(Request $request)
    {
        //dd($request->all());
        $request->validate(
            [
                'user_id' => 'required',
                'setdeposit_id' => 'required'
            ]
            );
            $available = Addmember::where('user_id',$request->user_id)->where('setdeposit_id',$request->setdeposit_id)->first();
            //dd($available);

            if($available){
                //dd('exit');
                $notification = array(
                    'message' => 'Already added',
                    'alert-type' => 'error'
                );
                return redirect()->route('setdeposit.show', $request->setdeposit_id)->with($notification);
            }else{
                //dd('not exit');
                $notification = array(
                    'message' => 'successfully added',
                    'alert-type' => 'success'
                );
                Addmember::create($request->all() + ['status' => 1])->with($notification);
            }
            
            return redirect()->route('setdeposit.show', $request->setdeposit_id);

    }


    public function payment_store(Request $request)
    {
        //dd($request->all());
        $deposit = $request->validate(
            [
                'amount' => 'required',
                'type' => 'required',
                'user_id' => 'required',
                'setdeposit_id' => 'required',
            ]
            );
            $payment = new Payment;
            //dd($request->type);
            $payment->user_id = $request->user_id;
            $payment->setdeposit_id = $request->setdeposit_id;
            $payment->amount = $request->amount;
            $payment->type = $request->type;
            $payment->save();
            //Payment::create($request->all());
            //dd('test 2');
            return redirect()->back();
    }

    public function deleting(Request $request){
        $id = $request->id;
        Addmember::destroy($id);

        return json_encode(array("success"=>true));
    }

    
}
