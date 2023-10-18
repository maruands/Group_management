<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Setdeposit;
use App\Models\Pay;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class FinanceController extends Controller
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
        $deposits = Setdeposit::get();
        //dd($deposits->totalAmount());
        //dd($deposits);
        $current_month = Carbon::now()->format('m');
        $previous_month = Carbon::now()->addMonth(-1)->format('M');
        //dd($current_month);
        $this_month = Pay::where( DB::raw('MONTH(created_at)'), '=', $current_month)->get();
        $last_month = Pay::where( DB::raw('MONTH(created_at)'), '=', $previous_month)->get();
        $t_this_m = $this_month->map(function($i){return $i->amount;})->sum();
        $t_last_m = $last_month->map(function($i){return $i->amount;})->sum();
        //total percentage contribution between last month and this month
        if($t_this_m == 0)
        {
            $t_this_m = 1;
            $total_m_per = (($t_this_m - $t_last_m)/$t_this_m) * 100;
        }else{
            $total_m_per = (($t_this_m - $t_last_m)/$t_this_m) * 100; 
        }
        
        //$watu = User::latest()->paginate(5);
        //dd($total_m_per);
        $data = collect([]);
        for ($per_year = 2; $per_year >= 0; $per_year--) {
            // Could also be an array_push if using an array rather than a collection.
            $data->push(Pay::whereDate('created_at', today()->subDays($per_year))->count());
        }
        $total_month_data = collect([]);
        for($per_month = 01; $per_month <=11; $per_month++){
            $month_data = Pay::where( DB::raw('MONTH(created_at)'), '=', $per_month)->get();
            $total_month_data->push($month_data->map(function($i){return $i->amount;})->sum());
        }

        //dd($total_month_data);
        $data = $data;

        $deposits = Setdeposit::with('payments')->get();

        return view('finance.index', compact('deposits','total_month_data','deposits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function edit(Finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finance $finance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {
        //
    }
}
