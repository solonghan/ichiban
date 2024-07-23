<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->string('level')->comment("獎賞等級")->default(0);
            $table->string('category_id')->comment("主分類")->default(0);
            $table->string('classify_id')->comment("子分類")->default(0);
            $table->bigInteger('sort')->comment("排序")->default(0);
            $table->string('no')->comment("產品編號")->default('');
            $table->string('name')->comment("產品名稱")->default('');
            $table->string('cover')->comment("主圖")->default('');
            $table->longText('summary')->comment("摘要")->default('');
            $table->longText('des')->comment("內文")->default('');
            
            $table->bigInteger('stock')->comment("庫存")->default(0);
            $table->bigInteger('total_quantity')->comment("總數量")->default(0);
            $table->string('price')->comment("價格")->default('');
            $table->string('tag')->comment("標籤")->default('');
            $table->enum('status', ['on', 'off'])->comment("是否開啟")->default("on");
            $table->bigInteger('is_hot')->comment("熱門產品")->default(0);
            $table->bigInteger('percentage')->comment("大賞機率")->default(0);
            $table->timestamps();
            $table->softDeletes();
            // $table->index(['parent_id', 'lang']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('products');
    }
}
