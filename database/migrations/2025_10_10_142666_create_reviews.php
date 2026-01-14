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
        Schema::create('reviews', function (Blueprint $table) {
            
            $table->enum('rate' , ['1', '2' , '3' ,'4' ,'5'])->nullable();
            $table->foreignId('comment');                                    
            $table->foreignId('project_id')->constrained();                        
            $table->foreignId('user_id')->constrained();                                    
            $table->timestamps();
            $table->primary(['project_id', 'user_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
