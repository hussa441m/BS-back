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
        Schema::create('projects_types', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 50)->unique();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('duration');
            $table->float('area');
            $table->string('location');
            $table->text('description');
            $table->string('building_no');
            
            $table->integer('budget')->nullable();
            $table->string('note' , 1000);
            
            $table->enum('status' , ['new' , 'contracted' , 'completed'])->default('new');
            
            $table->foreignId('projects_type_id')->constrained();                                    
            $table->foreignId('client_id')->constrained('users');                                    
            $table->foreignId('performed_by')->constrained('profiles');                        

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('projects_types');
    }
};
