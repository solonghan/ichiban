<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_awards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->comment("對應產品ID")->default(0);
            $table->string('level')->comment("獎賞等級")->default('');
           
            $table->bigInteger('sort')->comment("排序")->default(0);
            $table->string('awards_no')->comment("獎品編號")->default('');
            $table->string('awards_name')->comment("獎品名稱")->default('');
            $table->string('awards_cover')->comment("獎品主圖")->default('');
            $table->longText('awards_summary')->comment("獎品摘要")->default('');
            $table->longText('awards_des')->comment("獎品內文")->default('');
            
            $table->bigInteger('awards_stock')->comment("獎品庫存")->default(0);
            $table->bigInteger('awards_total_quantity')->comment("獎品總數量")->default(0);
            // $table->string('price')->comment("價格")->default('');
            // $table->string('tag')->comment("標籤")->default('');
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
        Schema::dropIfExists('product_awards');
    }
}
