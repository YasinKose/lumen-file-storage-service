<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('temporary_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("slug");
            $table->foreignId("file_id")->constrained("files");
            $table->timestamp("created_at");
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('temporary_urls');
    }
}
