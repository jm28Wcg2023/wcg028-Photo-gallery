<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id');
            $table->index('id');
            $table->string('name',50);
            $table->string('email',255)->unique();
            $table->string('phone',15);
            $table->string('role',2)->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',150);
            $table->integer('max_referral')->default(0);
            $table->string('affiliation_link',20)->unique()->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
