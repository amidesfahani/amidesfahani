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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('firstname_fa')->nullable();
            $table->string('lastname_fa')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile', 11)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->enum('gender', ['not', 'male', 'female'])->default('not');
            $table->date('birthdate')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->boolean('available')->default(1);
            $table->boolean('admin')->default(0);
            $table->boolean('super_admin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
