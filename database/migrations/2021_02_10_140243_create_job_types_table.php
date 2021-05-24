<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateJobTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_types', function (Blueprint $table) {
            $table->id();
            $table->string('job_position');
            $table->decimal('basic_salary', 10, 2);
            $table->timestamps();
        });

        DB::table('job_types')->insert(
            array(
                'job_position' => 'Admin Clerk',
                'basic_salary' => '0'
            )
        );

        DB::table('job_types')->insert(
            array(
                'job_position' => 'HR Manager',
                'basic_salary' => '0'
            )
        );
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_types');
    }
}
