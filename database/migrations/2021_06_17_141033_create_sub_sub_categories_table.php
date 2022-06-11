<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('subsubcategory_name_en');
            $table->string('subsubcategory_name_hi');
            $table->string('subsubcategory_slug_en');
            $table->string('subsubcategory_slug_hi');
            $table->string('subsubcategory_icon')->nullable()->default('fa fa-shopping-bag');
            $table->string('subsubcategory_image')->nullable()->default('default.jpg');
            $table->string('public_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('subcategory_id')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::table('sub_sub_categories', function(Blueprint $table){
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropForeign(['subcategory_id']);
            $table->dropColumn('subcategory_id');
        });
        Schema::dropIfExists('sub_sub_categories');
    }
}
