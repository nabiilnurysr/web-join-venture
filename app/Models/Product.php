<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'thumbnail',
        'photo',
        'about',
        'tagline',
        'price',
        'duration',
        'capacity',
        'is_popular',
    ];

    // protected function name(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn(string $value) => [
    //             'name' => $value,
    //             'slug' => Str::slug($value)
    //         ]
    //     );
    // }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function groups(): HasMany
    {
        return $this->hasMany(SubscriptionGroup::class);
    }

    public function keypoints(): HasMany
    {
        return $this->hasMany(ProductKeyPoint::class);
    }

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
