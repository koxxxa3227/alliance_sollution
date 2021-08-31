<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $_data     = [];
        $employees = Employee::with('expenses', 'orders.client')
                             ->get();
        foreach($employees as $employee) {
            $expenses = $employee->expenses();
            $orders   = $employee->orders();
            if($request->date_f) {
                $date_f = Carbon::parse($request->date_f);
                $expenses->whereDate('created_at', '>=', $date_f);
                $orders->whereDate('created_at', '>=', $date_f);
            }
            if($request->date_t) {
                $date_t = Carbon::parse($request->date_t);
                $expenses->whereDate('created_at', '<=', $date_t);
                $orders->whereDate('created_at', '<=', $date_t);
            }

            if($request->type_id){
                $expenses->whereTypeId($request->type_id);
            }

            $_data[$employee->name]['expenses'] = $expenses->get();
            $_data[$employee->name]['orders']   = $orders->get();
        }
        return $_data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
