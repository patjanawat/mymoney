<?php

namespace App\Http\Controllers;

use App\Income;
use App\Expensive;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index']]);
    }

    public function index(){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            /** Income statement */
            $incomes= Income::where('user_id',$user_id)
            ->get(['user_id','created_at','amount'])
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });

            $income_amount = $incomes
            ->map(function ($row) {
                return $row->sum('amount');
            });

            $incTransactions = new Income;
            foreach ($incomes as $key => $value) {
                $trx = [
                    'date'=>$key,
                    'detail'=>$value
                ];
                array_add($incTransactions,'transactions',[$trx]);
            }

            foreach ($income_amount as $key => $value) {
                array_add($incTransactions, 'total', $value);
            }

            /**Outcome statement */
            $outcomes= Expensive::where('user_id',$user_id)
            ->orderBy('created_at','desc')
            ->get(['user_id','created_at','amount','detail'])
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });

            //return $outcomes;

             $outcome_amount = $outcomes
                ->map(function ($row) {
                    return $row->sum('amount');
                });

            $expTransactions = array();
            foreach ($outcomes as $key => $value) {      
                $tempInfo = [];

                $tmp = $value;
                $expTotal = $value
                    ->groupBy(function($row){
                        return Carbon::parse($row->created_at)->format('Y-m-d');
                    })
                    ->map(function ($row) {
                        return $row->sum('amount');
                    });

                    $total = 0;
                    foreach ($expTotal as $key => $value) {
                        $total  = $value;
                    }

                $trx = [
                    'created_at'=>$key,                    
                    'details'=>$tmp,
                    'total'=>$total
                ];
                array_push($expTransactions,$trx);
            }

            $x = 0;
            $outTotal =0;
            foreach ($expTransactions as $value) { 
                $outTotal += $value['total'];
            }

            // return [
            //     'incomes'=>$incTransactions,
            //     'outcomes'=>['transactions'=>$expTransactions,'total'=> $outTotal ]
            // ];

            return view('pages/index')->with([
                'incomes'=>$incTransactions,
                'outcomes'=>['transactions'=>$expTransactions,'total'=> $outTotal ]
            ]);
        } else {
            return view('pages/index')->with([
                'incomes'=>[],
                'outcomes'=>[]
            ]);
        }
    }

    public function expense(){
        return view('pages/expense');
    }

    public function about(){
        return view('pages/about');
    }
}
