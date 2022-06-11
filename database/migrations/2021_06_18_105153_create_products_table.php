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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('sub_subcategory_id')->nullable();
            $table->string('product_name_en');
            $table->string('product_name_hi');
            $table->string('product_slug_en');
            $table->string('product_slug_hi');
            $table->string('product_code')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('product_tags_en')->nullable();
            $table->string('product_tags_hi')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_hi')->nullable();
            $table->longText('long_description_en')->nullable();
            $table->longText('long_description_hi')->nullable();
            $table->string('product_thumbnail')->nullable()->default('thumbnail.jpg');
            $table->string('public_id')->nullable();
            $table->boolean('status')->default(true);

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
            $table->foreign('sub_subcategory_id')
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
        // Schema::table('sub_sub_categories', function(Blueprint $table){
        //     $table->dropForeign(['brand_id']);
        //     $table->dropColumn('brand_id');
        //     $table->dropForeign(['category_id']);
        //     $table->dropColumn('category_id');
        //     $table->dropForeign(['subcategory_id']);
        //     $table->dropColumn('subcategory_id');
        //     $table->dropForeign(['sub_subcategory_id']);
        //     $table->dropColumn('sub_subcategory_id');
        // });
        Schema::dropIfExists('products');
    }
}
