<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'HeaderTransactionID';
    protected $guarded = [
        'HeaderTransactionID'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'HeaderID');
    }
}
