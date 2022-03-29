<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Collection extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasMany(Product::class, 'created_by');
    }
}
