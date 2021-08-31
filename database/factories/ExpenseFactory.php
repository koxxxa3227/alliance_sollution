<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'employee_id' => null,
            'type_id'     => Expense::TYPE_OTHER_EXPENSES,
            'amount'      => $this->faker->numberBetween($min = 50, $max = 100),
            'created_at'  => now(),
            'updated_at'  => now()
        ];
    }
}
