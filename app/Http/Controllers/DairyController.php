<?php

namespace App\Http\Controllers;

use App\Models\Dairy;
use Illuminate\Http\Request;

class DairyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $dairies = Dairy::get();

        $total_buying = $dairies->map(function ($i){
            return $i->quantity * $i->buying_price;
        });
        //dd($total_buying[1]);
        $total_selling = $dairies->map(function ($i){
            return $i->quantity * $i->selling_price;
        });
        return view('dairy.index', compact('dairies','total_buying','total_selling'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dairy.create');
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
        //dd($request->all());
        $request->validate([
            'date' => 'required',
            'Item' => 'required',
            'quantity' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'expendicture' => 'required',
            'receive_amount' => 'required',
        ]);
        //dd($request->all());
        Dairy::create($request->all());
        return redirect()->route('dairy.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dairy  $dairy
     * @return \Illuminate\Http\Response
     */
    public function show(Dairy $dairy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dairy  $dairy
     * @return \Illuminate\Http\Response
     */
    public function edit(Dairy $dairy)
    {
        //
        return view('dairy.edit', compact('dairy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dairy  $dairy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dairy $dairy)
    {
        //
        $request->validate([
            'date' => 'required',
            'Item' => 'required',
            'quantity' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'expendicture' => 'required',
            'receive_amount' => 'required',
        ]);
        $dairy->update($request->all());
        return redirect()->route('dairy.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dairy  $dairy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dairy $dairy)
    {
        //
    }
}
