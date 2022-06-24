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
        Schema::create('imageables', function (Blueprint $table) {
            $table->id();
            $table->morphs('imageable');
            $table->string('image');
            $table->string('title')->nullable();
            $table->string('title_fa')->nullable();
            $table->tinyInteger('displayorder')->default(0);
            $table->boolean('cover')->default(false);
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
        Schema::dropIfExists('imageables');
    }
};
