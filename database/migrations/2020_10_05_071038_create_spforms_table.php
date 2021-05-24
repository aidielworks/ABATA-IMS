<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spforms', function (Blueprint $table) {
            $table->id();
            $table->string('teacherIC');
            $table->string('studentIC');
            $table->string('class_date');
            $table->mediumText('learning_topic');
            $table->mediumText('review');
            $table->integer('status');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spforms');
    }
}
