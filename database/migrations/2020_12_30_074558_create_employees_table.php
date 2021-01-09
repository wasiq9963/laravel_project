<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('emp_name');
            $table->bigInteger('emp_phoneno');
            $table->string('emp_email');
            $table->bigInteger('emp_salary');
            $table->longtext('emp_address');
            $table->string('qualification');
            $table->date('dob');
            $table->string('cnic');
            $table->string('ntn');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('dep_id')->on('departments');

            $table->unsignedBigInteger('shift_id');
            $table->foreign('shift_id')->references('s_id')->on('shifts');
            $table->date('doj');
            $table->date('dol');
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
        Schema::dropIfExists('employees');
    }
}
