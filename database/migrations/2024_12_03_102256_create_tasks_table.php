<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users
            $table->text('task_description');     // Task details
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium'); // Priority level
            $table->date('due_date');             // Due date for the task
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending'); // Task status
            $table->timestamps();
    
            // Foreign Key Constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
    
};
