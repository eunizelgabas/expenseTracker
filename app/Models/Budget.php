<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updateBalance()
    {
        $expensesTotal = $this->user->expenses()->sum('amount');
        $this->balance = $this->budget_amount - $expensesTotal;
        $this->save();
    }
}
