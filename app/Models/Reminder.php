<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Rate;

class Reminder extends Model {
    use HasFactory;

    protected $fillable = ['product_id', 'date', 'units'];
    protected $casts = [
        'date' => 'date',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute() {
        $rate = $this->product->rates()
            ->where('start_date', '<=', $this->date)
            ->where('end_date', '>=', $this->date)
            ->first();
        return $rate ? $rate->price * $this->units : 0;
    }

    /**
     * 
     */
    public function applicableRate()
    {
        if (!$this->product || !$this->date) {
            return null;
        }

        return $this->product->rates()
            ->whereDate('start_date', '<=', $this->date)
            ->whereDate('end_date', '>=', $this->date)
            ->orderByDesc('start_date')
            ->first();
    }

    /**
     * 
     */
    public function estimatedCost(): Attribute
    {
        return Attribute::make(
            get: fn () => optional($this->applicableRate())->price * $this->units
        );
    }
}
