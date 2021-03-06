<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('property_ids')->nullable();
            $table->string('invitation_type');
            $table->string('cleaner_name');
            $table->string('details');
            $table->string('invitation_message')->nullable();       
            $table->string('status')->default(0);           
            $table->string('action')->default(0);
            $table->string('invitation_code');         
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
        Schema::dropIfExists('invites');
    }
}
