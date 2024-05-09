<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('_employees', function (Blueprint $table) {
            
            $table->id('employee_id');
            $table->string('firstname')->required();
            $table->string('lastname')->required();
            $table->bigInteger('comp_id')->unsigned(); 
            $table->string('email')->unique();
            $table->bigInteger('phone');
            $table->timestamps();

            $table->foreign('comp_id')->references('comp_id')->on('companies') 
            ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_employees');
    }
};
