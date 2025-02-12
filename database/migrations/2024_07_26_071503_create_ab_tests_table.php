<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbTestsTable extends Migration
{
    public function up()
    {
        Schema::create('a_b_tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['running', 'stopped'])->default('running');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('a_b_tests');
    }
};
