<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique();
            $table->string('employee_ic');
            $table->decimal('basic_salary', 8, 2);
            $table->decimal('total_allowances', 8, 2);
            $table->decimal('total_deductions', 8, 2);
            $table->decimal('company_income_tax', 8, 2);
            $table->decimal('income_tax', 8, 2);
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
        Schema::dropIfExists('payrolls');
    }
}
