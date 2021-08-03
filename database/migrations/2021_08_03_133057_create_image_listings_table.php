<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_listing', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('image_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('listing_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_listings');
    }
}
