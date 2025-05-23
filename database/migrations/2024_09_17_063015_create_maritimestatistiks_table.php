<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maritimestatistiks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_listing');
            $table->bigInteger('post_id_cat');
            $table->date('listing_date')->nullable();
            $table->string('post_title');
            $table->text('address');
            $table->string('sea_ocean')->nullable();
            $table->string('country')->nullable();
            $table->string('area')->nullable();
            $table->string('location')->nullable();
            $table->string('region')->nullable();
            $table->string('coordinate');
            $table->string('main_incident');
            $table->string('incident_category')->nullable();
            $table->string('actor')->nullable();
            $table->string('perpetrators')->nullable();
            $table->string('time_of_incident')->nullable();
            $table->string('night_type')->nullable();
            $table->string('timeofincidenttype')->nullable();
            $table->string('flag_of_ship_actor')->nullable();
            $table->string('flag_of_ship_target')->nullable();
            $table->string('type_of_ship')->nullable();
            $table->string('type_of_ship_actor')->nullable();
            $table->string('vessel_loss')->nullable();
            $table->string('property_loss')->nullable();
            $table->string('treatment_of_crew')->nullable();
            $table->string('injury')->nullable();
            $table->string('fatality')->nullable();
            $table->string('assaulted_type')->nullable();
            $table->string('weapons')->nullable();
            $table->integer('number_of_incident');
            $table->integer('number_of_injuries');
            $table->integer('number_of_fatalities');
            $table->text('article_link')->nullable();
            $table->text('additional_info');
            $table->string('url');
            $table->date('date_posting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maritimestatistiks');
    }
};
