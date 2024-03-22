<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            // $table->string('website_name_ar')->nullable();
            // $table->string('website_name_en')->nullable();
            // $table->string('facebook_url')->nullable();
            // $table->string('twitter_url')->nullable();
            // $table->string('instagram_url')->nullable();
            // $table->string('youtube_url')->nullable();
            // $table->string('snapchat_url')->nullable();
            // $table->string('whatsapp_url')->nullable();
            // $table->string('email')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('whatsapp')->nullable();
            // $table->string('tax')->nullable();
            // $table->string('males_insurance')->nullable();
            // $table->string('females_insurance')->nullable();
            // $table->string('maintenance_mode')->nullable();
            // $table->string('meta_tag_description_ar')->nullable();
            // $table->string('meta_tag_description_en')->nullable();
            // $table->string('meta_tag_keyword_ar')->nullable();
            // $table->string('meta_tag_keyword_en')->nullable();
            // $table->string('home_cars_section_label_ar')->nullable();
            // $table->string('home_cars_section_label_en')->nullable();
            // $table->string('purchase_order_text_in_home_page_ar')->nullable();
            // $table->string('purchase_order_text_in_home_page_en')->nullable();
            // $table->string('privacy_policy_ar')->nullable();
            // $table->string('privacy_policy_en')->nullable();
            // $table->string('terms_and_conditions_en')->nullable();
            // $table->string('terms_and_conditions_ar')->nullable();
            // $table->string('slider_dashboard_username')->nullable();
            // $table->string('slider_dashboard_password')->nullable();
            // $table->string('about_us_ar')->nullable();
            // $table->string('about_us_en')->nullable();
            // $table->string('about_us_video_url')->nullable();
            // $table->string('about_us_photo')->nullable();
            // $table->string('why_code_car_cars_ar')->nullable();
            // $table->string('why_code_car_cars_en')->nullable();
            // $table->string('why_code_car_cars_card_1_ar')->nullable();
            // $table->string('why_code_car_cars_card_1_en')->nullable();
            // $table->string('why_code_car_cars_card_2_ar')->nullable();
            // $table->string('why_code_car_cars_card_2_en')->nullable();
            // $table->string('why_code_car_cars_card_3_ar')->nullable();
            // $table->string('why_code_car_cars_card_3_en')->nullable();
            // $table->string('footer_text_ar')->nullable();
            // $table->string('footer_text_en')->nullable();
            // $table->string('who_code_car_photo')->nullable();
            // $table->string('purchase_section_photo')->nullable();
            // $table->string('contact_us_section_photo')->nullable();
            // $table->string('logo')->nullable();
            // $table->string('favicon')->nullable();
            // $table->string('currency')->nullable();
            $table->string('option_name');
            $table->text('option_value')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
