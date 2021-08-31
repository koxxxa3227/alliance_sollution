<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model {
    // types
    const TYPE_WAGE           = 1;
    const TYPE_OTHER_EXPENSES = 2;
    const TYPE_REWARD         = 3;

    use HasFactory;

    protected $fillable
        = [
            'employee_id',
            'amount',
            'type_id',
        ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
