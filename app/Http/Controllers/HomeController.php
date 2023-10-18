<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pay;
use App\Charts\DashboardChart;
use Carbon\Carbon;
use DB;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $per_year = Pay::get();
        $GrandTotal = $per_year->map(function ($i){
            return $i->amount;
        })->sum();
        //calculating percentage since last year
        $current_year = Carbon::now()->format('Y');
        $previous_year = Carbon::now()->addYear(-1)->format('Y');
        
        $this_year = Pay::where( DB::raw('YEAR(created_at)'), '=', $current_year)->get();
        $total_this_year = $this_year->map(function ($i){
            return $i->amount;
        })->sum();

        $last_year = Pay::where( DB::raw('YEAR(created_at)'), '=', $previous_year)->get();
        $total_last_year = $last_year->map(function ($i){
            return $i->amount;
        })->sum();

        //total percentage between last year and this year
        if($total_this_year == 0){
            $total_this_year = 0;
            $total_percentage = 0;
        }else{
            $total_percentage = (($total_this_year - $total_last_year)/$total_this_year) * 100;
            //dd($total_percentage);
        }

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
            $t_this_m = 0;
            $total_m_per = 0;
        }else{
            $total_m_per = (($t_this_m - $t_last_m)/$t_this_m) * 100; 
        }
        
        $watu = User::latest()->paginate(5);
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
        
        return view('adminHome', compact('watu','GrandTotal','total_percentage','t_this_m','total_m_per','data','total_month_data'));
    }

    public function adminHome()
    {
    
        $per_year = Pay::get();
        $GrandTotal = $per_year->map(function ($i){
            return $i->amount;
        })->sum();
        //calculating percentage since last year
        $current_year = Carbon::now()->format('Y');
        $previous_year = Carbon::now()->addYear(-1)->format('Y');
        
        $this_year = Pay::where( DB::raw('YEAR(created_at)'), '=', $current_year)->get();
        $total_this_year = $this_year->map(function ($i){
            return $i->amount;
        })->sum();

        $last_year = Pay::where( DB::raw('YEAR(created_at)'), '=', $previous_year)->get();
        $total_last_year = $last_year->map(function ($i){
            return $i->amount;
        })->sum();

        //total percentage between last year and this year
        if($total_this_year == 0){
            $total_this_year = 0;
            $total_percentage = 0;
        }else{
            $total_percentage = (($total_this_year - $total_last_year)/$total_this_year) * 100;
            //dd($total_percentage);
        }

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
            $t_this_m = 0;
            $total_m_per = 0;
        }else{
            $total_m_per = (($t_this_m - $t_last_m)/$t_this_m) * 100; 
        }
        
        $watu = User::latest()->paginate(5);
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
        
        return view('adminHome', compact('watu','GrandTotal','total_percentage','t_this_m','total_m_per','data','total_month_data'));
    } 

    public function members()
    {
        $members = User::get();
        $user = User::find(1); // Find a user by ID
        $adminRole = Role::where('name', 'admin')->first();
        
        return view('members.index', compact('members', 'user'));
    }
}
