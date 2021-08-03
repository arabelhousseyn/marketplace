<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('attribute');
            $table->string('value');
            $table->unsignedBigInteger('listing_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('listing_id')->references('id')->on('listings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_attributes');
    }
}
