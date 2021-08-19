<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->smallInteger('caffeine_total');
            $table->timestamps();
        });

        DB::table('drinks')->insert([
            [
                'name' => 'Monster Ultra Sunrise',
                'description' => 'A refreshing orange beverage that has 75mg of caffeine per serving. Every can has two servings.',
                'caffeine_total' => 75
            ]
        ]);

        DB::table('drinks')->insert([
            [
                'name' => 'Black Coffee',
                'description' => 'The classic, the average 8oz. serving of black coffee has 95mg of caffeine.',
                'caffeine_total' => '95'
            ]
        ]);

        DB::table('drinks')->insert([
            [
                'name' => 'Americano',
                'description' => 'Sometimes you need to water it down a bit... and in comes the americano with an average of 77mg. of caffeine per serving.',
                'caffeine_total' => '77'
            ]
        ]);

        DB::table('drinks')->insert([
            [
                'name' => 'Sugar-Free NOS',
                'description' => 'Another orange delight without the sugar. It has 130 mg. per serving and each can has two servings.',
                'caffeine_total' => '130'
            ]
        ]);

        DB::table('drinks')->insert([
            [
                'name' => '5 Hour Energy',
                'description' => 'An amazing shot of get up and go! Each 2 fl. oz. container has 200mg of caffeine to get you going.',
                'caffeine_total' => '200'
            ]
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drinks');
    }
}
