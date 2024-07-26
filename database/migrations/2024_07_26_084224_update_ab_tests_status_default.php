<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateABTestsStatusDefault extends Migration
{
    public function up()
    {
        Schema::table('a_b_tests', function (Blueprint $table) {
            $table->string('status')->default('not_started')->change();
        });
    }

    public function down()
    {
        Schema::table('a_b_tests', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }
}
