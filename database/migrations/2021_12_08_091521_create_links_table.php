<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url',355);
            $table->string('main_filter_selector');
            $table->unsignedInteger('item_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('website_id')->nullable();

            $table->foreign('website_id')
            ->references('id')
            ->on('website')
            ->onUpdate('cascade')
            ->onDelete('set null');

            $table->foreign('category_id')
            ->references('id')
            ->on('category')
            ->onUpdate('cascade')
            ->onDelete('set null');

            $table->foreign('item_id')
            ->references('id')
            ->on('item')
            ->onUpdate('cascade')
            ->onDelete('set null');
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
        Schema::dropIfExists('links');
    }
}
