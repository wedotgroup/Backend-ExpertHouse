<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->string('paragraph')->nullable();
            $table->string('main_img')->nullable();
            $table->string('small_pag')->nullable();
            $table->string('first_heading')->nullable();
            $table->string('note')->nullable();
            $table->string('sec_heading')->nullable();
            $table->string('sec_img')->nullable();
            $table->string("sec_paragraph")->nullable();
            $table->string('third_heading')->nullable();
            $table->json('list')->nullable();
             $table->foreignId('serviceCat_id')
          ->constrained('service_categories')
          ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
