<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('property_id')->nullable();
            $table->string('property_name')->nullable();            
            $table->string('dates_timmings')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('rate')->nullable();
            $table->string('cleaning_price')->nullable();
            $table->string('additional_notes')->nullable();
            $table->string('host_notes')->nullable();
            $table->string('checklist_id')->nullable();
            $table->string('status')->nullable();
            $table->string('publish_project')->nullable();
            $table->string('restrict_cleaner')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
