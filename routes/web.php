<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\ExampleController;

// Route::middleware('ab_test:example_test')->get('/', [ExampleController::class, 'index']);

// Route::get('/', function () {
//     return view('ab_tests/index');
// });



// routes/web.php

use App\Http\Controllers\ABTestController;

// Route to display A/B test index
Route::get('/', [ABTestController::class, 'index'])->name('ab_tests.index');

// Route to show form for creating a new A/B test
Route::get('/ab-tests/create', [ABTestController::class, 'create'])->name('ab_tests.create');

// Route to store a new A/B test
Route::post('/ab-tests', [ABTestController::class, 'store'])->name('ab_tests.store');

// Route to start an A/B test
Route::patch('/ab-tests/{abTest}/start', [ABTestController::class, 'start'])->name('ab_tests.start');

// Route to stop an A/B test
Route::patch('/ab-tests/{abTest}/stop', [ABTestController::class, 'stop'])->name('ab_tests.stop');


