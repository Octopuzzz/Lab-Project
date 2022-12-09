<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'CardID';
    protected $guarded = ['CardID'];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->UserID = Auth::user()->UserID;
        });
        self::addGlobalScope(fn (Builder $builder) => $builder->where('UserID', Auth::user()->UserID));
    }
    public function user()
    {
        return $this->hasOne(User::class, 'UserID', 'UserID');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'ProductID', 'ProductID');
    }
}
