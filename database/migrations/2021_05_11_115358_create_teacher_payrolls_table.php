<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherPayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique();
            $table->string('teacher_ic');
            $table->string('no_of_student');
            $table->string('rate_per_student');
            $table->decimal('net_salary', 8, 2);
            $table->string('payroll_month');
            $table->string('issued_by');
            $table->string('status');
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
        Schema::dropIfExists('teacher_payrolls');
    }
}
