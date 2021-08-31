<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicController extends Controller {
    public function index(Request $request) {
        $orders_amount = Order::query();
        $expenses      = Expense::query();
        if($request->date_f) {
            $date_f = Carbon::parse($request->date_f);
            $orders_amount->whereDate('created_at', '>=', $date_f);
            $expenses->whereDate('created_at', '>=', $date_f);
        }
        if($request->date_t) {
            $date_t = Carbon::parse($request->date_t);
            $orders_amount->whereDate('created_at', '<=', $date_t);
            $expenses->whereDate('created_at', '<=', $date_t);
        }
        $orders_amount = $orders_amount->sum('amount');
        $expenses = $expenses->sum('amount');

        return [
            'Доход компании'  => $orders_amount,
            "Расход компании" => $expenses,
            "Прибыль компании" => $orders_amount - $expenses,
        ];
    }
}
