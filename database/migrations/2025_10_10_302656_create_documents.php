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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->enum('type' , [ 'area_diagram' , 'certificate' ,  'others']);
            $table->enum('extension' , [ 'image' , 'pdf' ]);
            $table->string('path' );
            $table->string('description' );
            $table->foreignId('user_id')->constrained();                                                
            $table->foreignId('project_id')->nullable()->constrained();                                                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
