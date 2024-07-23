<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_recipients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment("user ID")->default(0);
            $table->string('username')->default('')->comment('收貨人姓名');
            $table->string('city')->default('')->comment('城市');
            $table->string('dist')->default('')->comment('行政區');
            $table->string('address')->default('')->comment('收貨地址');
            
            $table->string('phone')->default('')->comment('收貨人聯絡電話');
            $table->string('ext')->default('')->comment('電話分機');
            $table->string('email')->default('')->comment('收貨人Email');
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
        Schema::table('user_recipients', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('user_recipients');
    }
}
