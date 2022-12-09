<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'name',
    //     'price',
    //     'description',
    //     'image'
    // ];
    protected $primaryKey = 'ProductID';
    protected $guarded = [
        'ProductID'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'UserID');
    }
}
