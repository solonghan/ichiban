<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhoneVerifiedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_phone_verifieds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment("user ID")->default(0);
            $table->string('phone')->default('')->comment('手機');
            $table->string('code')->default('')->comment('驗證碼');
            $table->enum('status', ['pending', 'success'])->default('pending');
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
        Schema::dropIfExists('user_phone_verifieds');
    }
}
