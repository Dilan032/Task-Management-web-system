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
            $table->unsignedBigInteger('user_id'); //Message send user id store this column
            $table->string('assigned_employee');//This column store the assigned company employee
            $table->string('subject');
            $table->string('message');
            $table->enum('priority', ['Top Urgent', 'Urgent', 'Medium', 'Low'])->default('Low');
            $table->enum('status', ['In Queue', 'In Progress', 'Document Pending', 'Postponed', 'Move to next day', 'Complete in next day', 'Completed'])->default('In Queue');
            $table->enum('request',['Pending', 'Accept', 'Reject'])->default('Pending');
            $table->enum('sp_request',['Pending', 'Accepted'])->default('Pending');
            $table->string('img_1')->nullable();
            $table->string('img_2')->nullable();
            $table->string('img_3')->nullable();
            $table->string('img_4')->nullable();
            $table->string('img_5')->nullable();
            $table->string('progress_note')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamps();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

            //for document pending [ get support_description and images]
            $table->string('support_description')->nullable();
            $table->string('support_img_1')->nullable();
            $table->string('support_img_2')->nullable();
            $table->string('support_img_3')->nullable();
            $table->string('support_img_4')->nullable();
            $table->string('support_img_5')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
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

