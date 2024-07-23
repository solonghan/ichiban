<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('code')->default('');
            $table->enum('media_type', ['img','file'])->comment("媒體類型")->default('img');
            $table->string('position')->comment("使用在哪")->default('');
            $table->bigInteger('relation_id')->comment("對應主ID")->default(0);
            $table->string('path')->comment("主要路徑;配合Storage")->default('');
            $table->string('realname')->comment("上傳時的檔名")->default('');
            $table->string('showname')->comment("下載時要顯示的名稱")->default('');
            $table->string('remark')->comment("備註")->default('');
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
        Schema::table('media', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('media');
    }
}
