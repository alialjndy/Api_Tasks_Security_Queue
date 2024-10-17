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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['Bug','Feature','Improvement']);
            $table->enum('status',['Open','In_Progress','Completed','Blocked']);
            $table->string('description')->nullable();
            $table->string('title');
            $table->enum('priority',['Low','Medium','High']);
            $table->date('due_date');
            $table->foreignId('Assigned_to')->nullable()->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
