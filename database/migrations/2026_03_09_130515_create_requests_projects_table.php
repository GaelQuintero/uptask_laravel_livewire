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
        Schema::create('requests_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('users');
            $table->foreignId('project_id')->constrained();
            $table->foreignId('manager_id')->constrained('users');
            $table->unique(['destination_id','project_id', 'manager_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests_projects');
    }
};
