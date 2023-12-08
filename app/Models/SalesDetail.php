<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'quantity',
        'product_branche_id',
        'status',
    ];

    public function sale (): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
