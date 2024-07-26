<?php

namespace App\Http\Controllers;

use App\Models\ABTest;
use Illuminate\Http\Request;

class ABTestController extends Controller
{
    public function index()
    {
        $abTests = ABTest::with('variants')->get();
        return view('ab_tests.index', compact('abTests'));
    }

    public function create()
    {
        return view('ab_tests.create');
    }

    public function store(Request $request)
    {
        $abTest = ABTest::create([
            'name' => $request->input('name'),
            'status' => 'not_started', // Default status upon creation
        ]);

        foreach ($request->input('variants', []) as $variant) {
            $abTest->variants()->create($variant);
        }

        return redirect()->route('ab_tests.index');
    }

    public function start(ABTest $abTest)
    {
        // Allow starting only if the test is in 'not_started' state
        if ($abTest->status === 'not_started') {
            $abTest->update(['status' => 'running']);
        }

        return back();
    }

    public function stop(ABTest $abTest)
    {
        // Ensure the test can only be stopped, and not restarted
        if ($abTest->status === 'running') {
            $abTest->update(['status' => 'stopped']);
        }

        return back();
    }
}
