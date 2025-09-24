<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'bank_code', 'account_number', 'account_name', 'bank_name', 'reserved_account_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
