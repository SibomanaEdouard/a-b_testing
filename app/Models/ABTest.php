<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ABTest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function getVariantForSession($sessionId)
    {
        $variants = $this->variants;
        $totalRatio = $variants->sum('ratio');

        $random = rand(1, $totalRatio);
        $cumulativeRatio = 0;

        foreach ($variants as $variant) {
            $cumulativeRatio += $variant->ratio;
            if ($random <= $cumulativeRatio) {
                return $variant;
            }
        }

        return $variants->first(); // Fallback
    }
}
