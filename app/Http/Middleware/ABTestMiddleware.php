<?php
namespace App\Http\Middleware;

use Closure;
use App\Services\ABTestService;

class ABTestMiddleware
{
    protected $abTestService;

    public function __construct(ABTestService $abTestService)
    {
        $this->abTestService = $abTestService;
    }

    public function handle($request, Closure $next, $testName)
    {
        $this->abTestService->getVariantForTest($testName);

        return $next($request);
    }
}
