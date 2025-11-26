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
        Schema::create('offers', function (Blueprint $table) {
            $table->integer('cost');
            $table->time('duration');
            $table->date('details');
            $table->boolean('isSelected');

            $table->foreignId('project_id')->constrained();                        
            $table->foreignId('offered_by')->constrained('profiles');                        
            $table->primary(['project_id','offered_by']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
