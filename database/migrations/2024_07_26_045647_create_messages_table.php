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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assigned_user_id');//This column store the assigned company employee
            $table->string('subject');
            $table->enum('priority', ['Top Urgent(2min)', 'Urgent(5min)', 'Medium(2hrs)', 'Low(1day)'])->default('Low(1day)');
            $table->enum('status', ['In Queue', 'In Progress', 'Document Pending', 'Postponed', 'Move to next day', 'Complete in next day', 'Completed'])->default('In Queue');
            $table->enum('request',['pending', 'accept', 'reject'])->default('pending');
            $table->string('img_1')->nullable();
            $table->string('img_2')->nullable();
            $table->string('img_3')->nullable();
            $table->string('img_4')->nullable();
            $table->string('img_5')->nullable();
            $table->string('progress_note')->nullable();
            $table->timestamps();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->foreign('assigned_user_id')->references('assigned_employee_id')->on('institutes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};

