<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('ic', 12)->unique();
            $table->string('pword');
            $table->integer('role');
            $table->string('position');
            $table->string('phonenumber');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('zipcode');
            $table->string('state');
            $table->string('image')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert some stuff
        DB::table('employees')->insert(
            array(
                'name' => 'ABATA ADMIN',
                'ic' => 'abataadmin12',
                'pword' => Hash::make('admin123'),
                'role' => 1,
                'position' => 1,
                'phonenumber' => 'none',
                'email' => 'none',
                'address' => 'none',
                'city' => 'none',
                'zipcode' => 'none',
                'state' => 'none',
                'image' => 'default.jpg'
            )
        );

        // Insert some stuff
        DB::table('employees')->insert(
            array(
                'name' => 'ABATA HR',
                'ic' => 'abataadminHR',
                'pword' => Hash::make('admin123'),
                'role' => 1,
                'position' => 2,
                'phonenumber' => 'none',
                'email' => 'none',
                'address' => 'none',
                'city' => 'none',
                'zipcode' => 'none',
                'state' => 'none',
                'image' => 'default.jpg'
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
        Schema::dropIfExists('employees');
    }
}
