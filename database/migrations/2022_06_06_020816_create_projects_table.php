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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_fa')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('subtitle_fa')->nullable();
            $table->string('image')->nullable();
            $table->text('about')->nullable();
            $table->text('about_fa')->nullable();
            $table->text('description')->nullable();
            $table->text('description_fa')->nullable();
            $table->date('order_date')->nullable();
            $table->date('final_date')->nullable();
            $table->string('link')->nullable();
            $table->string('archive')->nullable();
            $table->foreignId('status_id')->nullable();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('city_id')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
