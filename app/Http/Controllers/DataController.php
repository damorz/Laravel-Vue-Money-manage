<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use App\Transaction;

class DataController extends Controller
{
    function getCategory(){
        $category = Category::all();
        return response()->json($category,200);
    }

    function getTransactions(Request $request){
        $transaction = Transaction::where('user_id',$request['user_id'])->orderBy('date', 'DESC')->get();
        return response()->json($transaction,200);
    }

    function getYears(){
        $year = Transaction::whereNotNull('date')->distinct()->get([DB::raw('YEAR(date) as year')]);
        return response()->json($year);
    }
}
