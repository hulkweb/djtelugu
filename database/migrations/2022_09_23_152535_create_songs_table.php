<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->default(null);
            $table->mediumText('description')->nullable()->default(null);
            $table->string('image_file')->nullable()->default(null);
            $table->string('image_file_size')->nullable()->default(null);
            $table->string('image_file_extension')->nullable()->default(null);

            $table->string('audio_file')->nullable()->default(null);
            $table->string('audio_file_size')->nullable()->default(null);
            $table->string('audio_file_extension')->nullable()->default(null);

            $table->string('video_id')->nullable()->default(null);
            $table->string('video_file')->nullable()->default(null);
            $table->string('video_file_size')->nullable()->default(null);
            $table->string('video_file_extension')->nullable()->default(null);

            $table->bigInteger('views')->nullable()->default(0);
            $table->bigInteger('downloads')->nullable()->default(0);
            $table->bigInteger('likes')->nullable()->default(0);
            $table->string('duration')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->bigInteger('category_id')->unsigned()->nullable()->default(null);
            $table->index('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->softDeletes();
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
        Schema::dropIfExists('songs');
    }
};
