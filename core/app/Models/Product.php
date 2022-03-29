<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'keyword' => 'object'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'created_by');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }


    public function productSpecification()
    {
        return $this->hasMany(ProductSpecification::class, 'product_id');
    }


    public function review()
    {
        return $this->hasMany(Review::class, 'product_id');
    }


    public function order()
    {
        return $this->hasMany(Order::class, 'product_id')->where('status', 2);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productBids()
    {
        return $this->hasMany(ProductBidding::class, 'product_id')->orderBy('id','desc');
    }
    
    public function metamaskTransactions()
    {
        return $this->hasMany(MetamaskTransaction::class, 'product_id','id');
    }
    
    public function metamaskTransactionPayments()
    {
        return $this->hasMany(MetamaskTransactionPayment::class, 'product_id','id');
    }
}
