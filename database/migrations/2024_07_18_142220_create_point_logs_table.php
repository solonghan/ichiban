<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('operator')->comment("操作人")->default(0);
            $table->bigInteger('user_id')->comment("USER")->default(0);
            $table->string('mobile')->default('');
            $table->enum('action', ['plus','minus'])->comment("動作")->default(null);
            $table->bigInteger('amount')->comment("數量")->default(0);
            $table->bigInteger('result')->comment("操作後總數")->default(0);
            $table->bigInteger('remaining')->comment("若為plus,此筆紀錄剩餘多少	")->default(0);
            $table->date('deadline')->comment("到期日");
            $table->string('msg')->comment("備註訊息")->default('');
           
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
        Schema::table('point_logs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('point_logs');
    }
}
