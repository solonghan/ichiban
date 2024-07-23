<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('lang')->comment("語系(預設中文)")->default('tw');
            // $table->bigInteger('parent_id')->comment("多語系對應主ID,中文為0")->default(0);
            $table->string('cover')->comment("大圖")->default('');
            $table->string('thumb')->comment("小圖")->default('');
            $table->enum('category', ['bulletin', 'media', 'discount'])->comment("分類")->default('bulletin');
            $table->string('date')->comment("公開顯示日期")->default('');

            $table->string('title')->comment("標題")->default('');
            $table->longText('summary')->comment("摘要");
            $table->longText('content')->comment("內文");
            $table->dateTime('online_date')->comment("上線日")->useCurrent();
            $table->dateTime('offline_date')->comment("下線日")->useCurrent();
            $table->enum('status', ['on', 'off'])->default('on');
            
            $table->bigInteger('create_by')->comment("建立者")->default(1);
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
        Schema::table('news', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('news');
    }
}
