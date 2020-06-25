<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('property_name')->nullable();
            $table->string('property_address')->nullable();
            $table->string('unit')->nullable();
            $table->string('access_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('currency')->nullable();
            $table->string('property_type')->nullable();
            $table->string('property_color')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('unit_of_measurement')->nullable();
            $table->string('size')->nullable();
            $table->longText('property_description')->nullable();
            $table->string('property_image')->nullable();
            $table->string('property_image2')->nullable();
            $table->string('property_image3')->nullable();
            $table->string('property_image4')->nullable();
            $table->string('property_image5')->nullable();
            $table->string('checklist_id')->nullable();
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->string('status')->nullable();
            // $table->string('bid')->nullable();
            // $table->string('active')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
