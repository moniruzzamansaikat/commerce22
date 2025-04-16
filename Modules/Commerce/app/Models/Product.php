<?php

namespace Modules\Commerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault(['name' => 'N/A']);
    }

    public function scopeRental($query)
    {
        return $query->where('is_rental', 1);
    }

    public function scopeDownloadable($query)
    {
        return $query->where('is_downloadable', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', 1);
    }

    public function published($query)
    {
        return $query->where('is_published', 1);
    }
}
