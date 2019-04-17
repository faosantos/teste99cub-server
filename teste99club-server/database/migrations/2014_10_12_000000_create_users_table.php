<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50); // \/
            $table->char('email', 120)->unique(); // \/
            $table->timestamp('email_verified_at')->nullable(); // \/
            $table->string('password', 60); // \/
            $table->char('avatar', 255); // \/
            $table->enum('sex', ['m', 'f']);
            $table->enum('interest', ['m', 'f', 'b']);
            $table->point('location');
            $table->spatialIndex('location');
            $table->decimal('feed_max_distance', 11, 8)->default(50);
            $table->string('about', 128);
            $table->dateTime('birth_date');
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
}
