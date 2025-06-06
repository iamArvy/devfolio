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
        Schema::create('profiles', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('fullname');
            $table->string('job_description');
            $table->text('bio');
            $table->string('phone');
            $table->string('email');
            $table->string('location');
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExist('profiles');
    }
};
