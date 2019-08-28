<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Income;
use App\User;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
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
        if(Auth::check()){
            $incomes = Income::orderBy('created_at','desc')->where('user_id','=',auth()->user()->id)->get();
        } else {
            $incomes = Income::orderBy('created_at','desc')->get();
        }
        
        foreach ($incomes as $income) {
            $user = User::where('id',$income->user_id)->get();
            $income->category_type = $income->category==1?"Salary":"Sell";
            $income->created_by = $user->count()>0?$user[0]->name:'Anonymouse';
        }

        //return $incomes;

        return view('income/index')->with('incomes',$incomes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('income/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category'=>'required|not_in:0',
            'value'=>'required'
        ]);
        
        //return $validate;
        $income = new Income();
        $income->category = $request->category;
        $income->amount = $request->value;
        $income->user_id= auth()->user()->id;
        $income->save();

        return redirect('/income')->with('success','Post Created');
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
        $income = Income::find($id);
        return view('income/edit')->with('income',$income);
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
        $income = Income::find($id);
        $income->category = $request->input('category');
        $income->amount = $request->input('value');
        $income->save();
        return redirect('/income')->with('success','Income Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::find($id);
        $income->delete();
        return redirect('/income')->with('Success','Icome Deleted');
    }
}
