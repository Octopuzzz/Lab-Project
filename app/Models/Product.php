<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'ProductID';
    protected $guarded = [
        'ProductID'
    ];
    protected $with = [
        'user'
    ];
    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
        );
        // ->when(
        //     $filters['user'] ?? false,
        //     fn ($query, $user) =>
        //     $query->whereHas(
        //         'user',
        //         function ($query) use ($user) {
        //             return   $query->where('name', 'like', '%' . $user . '%');
        //         }
        //     )
        // );
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'UserID');
    }
}
