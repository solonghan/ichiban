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
            $table->id();
            $table->enum('role', ['tourist', 'islander','senior_islander'])->default('tourists')->comment('身分角色(依序遊客、島民、資深島民)');
            // $table->string('company')->default('')->comment('公司名');
            // $table->string('tax_id')->default('')->comment('統編');
            $table->string('username')->default('')->comment('暱稱');
            $table->string('realname')->default('')->comment('真實姓名');
            $table->string('phone')->default('')->comment('聯繫人電話');
            // $table->string('ext')->default('')->comment('聯繫人分機');
            $table->string('email')->default('')->comment('Email');
            $table->string('password')->default('');
            // $table->bigInteger('credits')->comment("信用額度")->default(0);
            $table->enum('gender',['normal','male', 'female'])->default('normal')->comment('性別');
            $table->enum('status', ['normal', 'not_verify', 'verified', 'inreview', 'block'])->default('not_verify');
            $table->bigInteger('point')->default(0)->comment("點數");
            $table->timestamps();
            $table->softDeletes();
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
