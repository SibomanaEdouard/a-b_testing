<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ABTest;
use App\Models\Variant;

class CreateSampleAbTest extends Migration
{
    public function up()
    {
        $abTest = ABTest::create(['name' => 'Sample Test', 'status' => 'running']);

        Variant::create(['a_b_test_id' => $abTest->id, 'name' => 'Variant A', 'ratio' => 1]);
        Variant::create(['a_b_test_id' => $abTest->id, 'name' => 'Variant B', 'ratio' => 2]);
    }

    public function down()
    {
        $abTest = ABTest::where('name', 'Sample Test')->first();
        if ($abTest) {
            Variant::where('a_b_test_id', $abTest->id)->delete();
            $abTest->delete();
        }
    }
}


