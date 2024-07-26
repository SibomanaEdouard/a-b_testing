<?php
namespace App\Services;

use App\Models\ABTest;
use Illuminate\Support\Facades\Session;

class ABTestService
{
    public function getVariantForTest(string $testName): ?string
    {
        $test = ABTest::where('name', $testName)->where('is_running', true)->first();

        if (!$test) {
            return null;
        }

        if (Session::has('ab_test_variant_' . $test->id)) {
            return Session::get('ab_test_variant_' . $test->id);
        }

        $totalRatio = $test->variants->sum('targeting_ratio');
        $rand = mt_rand(1, $totalRatio);

        foreach ($test->variants as $variant) {
            if ($rand <= $variant->targeting_ratio) {
                Session::put('ab_test_variant_' . $test->id, $variant->name);
                return $variant->name;
            }
            $rand -= $variant->targeting_ratio;
        }

        return null;
    }
}
