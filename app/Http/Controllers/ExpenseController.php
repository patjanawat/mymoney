<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expensive;
use App\Income;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $expensives = Expensive::orderBy('created_at','desc')->where('user_id','=',auth()->user()->id)->get();
            $amount = $expensives->sum('amount');       
        }
        else {
            $expensives = Expensive::orderBy('created_at','desc')->get();
            $amount = $expensives->sum('amount');
        }

        foreach ($expensives as $item) {
            $user = User::where('id',$item->user_id)->get();
            $item->created_by = $user->count()>0?$user[0]->name:'Anonymouse';
        }

        return view('expense/index')->with('expensives',$expensives)->with('amount',$amount);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB::transaction(function () {
        //     try {
            
            //$income_amount=  Income::where('user_id','=',1)->sum('amount');
            
                $this->validate($request,[
                    'amount'=>'required',
                    'detail'=>'required'
                ]);
        
                $expense = new Expensive();
                $expense->amount = $request->amount;
                $expense->detail = $request->detail;
                $expense->user_id = auth()->user()->id;
                $expense->save();
    
                return redirect('/expense')->with('success','Expensive created');
            // } catch (\Throwable $th) {
            //     throw $th;
            //     //Db:roll
            // }
        // });
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expensive::find($id);
        return view('expense\edit')->with('expense',$expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
