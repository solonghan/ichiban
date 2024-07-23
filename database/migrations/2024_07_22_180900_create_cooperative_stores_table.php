<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCooperativeStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperative_stores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sort')->comment("排序")->default(0);
            $table->bigInteger('category_id')->comment("分類")->default(0);
            $table->longText('name')->comment("店家名");
            $table->string('logo')->comment("LOGO")->default('');
            $table->longText('summary')->comment("摘要")->default('');
            $table->longText('content')->comment("內文")->default('');
            
            $table->string('phone')->default('')->comment('電話');
            $table->string('email')->default('')->comment('Email');
            $table->longText('address')->comment("地址");

            $table->longText('website')->comment("官網");
            $table->longText('fb')->comment("臉書");
            $table->longText('line')->comment("LINE");
            $table->longText('ig')->comment("IG");

            $table->enum('status', ['on', 'off'])->comment("是否開啟")->default("on");

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
        Schema::table('cooperative_stores', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('cooperative_stores');
    }
}
