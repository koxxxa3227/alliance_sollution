<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Order;
use Database\Factories\ExpenseFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();
        Employee::factory(8)
                ->create()
                ->each(function($employee) {
                    Expense::create([
                                        'employee_id' => $employee->id,
                                        'type_id'     => Expense::TYPE_WAGE,
                                        'amount'      => 500
                                    ]);
                    Expense::factory()
                           ->count(5)
                           ->create([
                                        'employee_id' => $employee->id
                                    ]);

                    Client::factory(5)
                          ->create()
                          ->each(function($client) use ($employee) {
                              Order::factory()
                                   ->count(2)
                                   ->create([
                                                'employee_id' => $employee->id,
                                                'client_id'   => $client->id
                                            ]);
                          });
                });
                $this->call(ExpensesSeeder::class);
    }
}
