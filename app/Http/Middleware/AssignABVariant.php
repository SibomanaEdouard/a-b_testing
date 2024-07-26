<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\ABTest;

class AssignABVariant
{
    public function handle($request, Closure $next)
    {
        $runningTests = ABTest::where('status', 'running')->with('variants')->get();

        foreach ($runningTests as $test) {
            $variant = $this->selectVariant($test);
            Session::put('a_b_test_'.$test->id, $variant->id);
        }

        return $next($request);
    }

    private function selectVariant($test)
    {
        $totalRatio = $test->variants->sum('ratio');
        $rand = rand(1, $totalRatio);
        $current = 0;

        foreach ($test->variants as $variant) {
            $current += $variant->ratio;
            if ($rand <= $current) {
                return $variant;
            }
        }

        return $test->variants->first(); // default
    }
}
