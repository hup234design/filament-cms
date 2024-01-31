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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('job_title')
                ->nullable();
            $table->text('bio')
                ->nullable();
            $table->string('linkedin')
                ->nullable();
            $table->string('twitter')
                ->nullable();
            $table->string('threads')
                ->nullable();
            $table->string('email')
                ->nullable();
            $table->boolean('is_visible')
                ->default(true);
            $table->integer('order_column')
                ->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
