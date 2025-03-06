<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductKeyPoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'product_id'
    ];

    // public function product(): BelongsTo
    // {
    //     return $this->belongsTo(Product::class, 'product_id');
    // }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }
}
