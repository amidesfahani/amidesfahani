<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_fa')->nullable();
            $table->string('role')->nullable();
            $table->string('role_fa')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('description_fa')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('website')->nullable();
            $table->boolean('present')->default(false);
            $table->tinyInteger('displayorder')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
};
