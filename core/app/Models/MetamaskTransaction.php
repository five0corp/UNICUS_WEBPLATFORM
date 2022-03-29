<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetamaskTransaction extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function productBidding()
    {
        return $this->belongsTo(ProductBidding::class, 'product_bidding_id', 'id');
    }

}
