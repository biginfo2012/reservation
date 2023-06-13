<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_code', 4);
            $table->string('menu_name');
            $table->string('description')->nullable();
            $table->integer('order')->nullable();
            $table->string('price')->nullable();
            $table->string('require_time')->nullable();
            $table->tinyInteger('display')->default(1);
            $table->string('note')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('over')->default(0);
            $table->tinyInteger('ask')->default(1);
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
        Schema::dropIfExists('menus');
    }
}
