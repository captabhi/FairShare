<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonRegisterUsersTable extends Migration
{

    public function up()
    {
        Schema::create('non_register_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('localHash')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

        });
    }
    // Function To generate unique Hash to identify User Uniquely
    // This hash will be stored in User Browser





    public function down()
    {
        Schema::dropIfExists('non_register_users');
    }
}
