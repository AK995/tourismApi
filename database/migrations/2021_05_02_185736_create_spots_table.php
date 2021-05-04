<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            // spot_id
            $table->integer('pid')->default(0)->comment('父级');
            $table->tinyInteger('level')->default(1)->comment('状态：0禁用 1启用');
            $table->char('locale_name',255)->comment('地区');
            $table->text('content')->comment('景点介绍')->nullable();
            $table->char('spot_img',255)->comment('景点图片地址')->nullable();
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
        Schema::dropIfExists('spots');
    }
}
