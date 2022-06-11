<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_title')->nullable();
            $table->string('website_favicon')->nullable();
            $table->string('website_logo')->nullable();
            $table->string('website_logo_pubic_id')->nullable();
            $table->string('website_favicon_public_id')->nullable();
            $table->string('website_address')->nullable();
            $table->string('website_address_city')->nullable();
            $table->string('website_address_state')->nullable();
            $table->string('website_address_pin')->nullable();
            $table->string('website_email')->nullable();
            $table->string('website_phone_1')->nullable();
            $table->string('website_phone_2')->nullable();
            $table->string('website_phone_3')->nullable();
            $table->string('website_phone_4')->nullable();
            $table->json('other_fields')->nullable();
            $table->string('sms_api_key')->nullable();
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
        Schema::dropIfExists('admin_settings');
    }
}
