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
            $table->id();
            $table->string('firstname');
            $table->string('firstname_ar');
            $table->string('lastname');
            $table->string('lastname_ar');
            $table->string('mobile',20)->unique();
            $table->string('barcode');
            $table->string('address',255);
            $table->string('address_ar',255);
            $table->string('email')->nullable()->unique();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('entity_id');
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
