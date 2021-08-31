<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpensesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $employees = Employee::with('orders')
                             ->get();

        $need = null;
        $max  = 0;

        foreach($employees as $employee) {
            $orders     = $employee->orders();
            $orders_sum = $orders->sum('amount');
            if($orders_sum > $max) {
                $need = $employee;
            }
            $now = now();
            foreach($orders->get() as $order) {
                Expense::create(
                    [
                        'employee_id' => $employee->id,
                        'type_id'     => Expense::TYPE_REWARD,
                        'amount'      => $order->amount * 3 / 100,
                        'created_at'  => $now,
                        'updated_at'  => $now
                    ]);
            }
        }
        if($need) {
            Expense::create([
                                'employee_id' => $employee->id,
                                'amount'      => 200,
                                'type_id'     => Expense::TYPE_REWARD
                            ]);
        }
    }
}
