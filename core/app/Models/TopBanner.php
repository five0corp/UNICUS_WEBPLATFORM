<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TopBanner extends Model
{
    use HasFactory;
    protected $table = "top_banner";
    public $timestamps = false;
}
