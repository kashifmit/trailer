<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkyBizTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skybiz_tracking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TrailerNo', 100)->nullable();
            $table->string('TrailerUnitNo', 30)->nullable();
            $table->string('Latitude', 30)->nullable();
            $table->string('Longitude', 30)->nullable();
            $table->string('ClosestLandMark', 80)->nullable();
            $table->string('State', 10)->nullable();
            $table->string('Country', 10)->nullable();
            $table->string('DistanceFromLandmark', 10)->nullable();
            $table->string('BatteryStatus', 10)->nullable();
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
        Schema::dropIfExists('skybiz_tracking');
    }
}
