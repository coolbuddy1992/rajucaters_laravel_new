<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildOwnMenuListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build_own_menu_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('build_menu_id')->nullable();
            $table->json('build_menu_list_id')->nullable();
            $table->json('build_menu_list_name')->nullable();
            $table->timestamps();
            $table->foreign('build_menu_id')
                ->references('id')
                ->on('build_own_menus')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('build_own_menu_lists');
    }
}
