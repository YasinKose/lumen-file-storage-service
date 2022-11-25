<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->efficientUuid('uuid')
                ->index();
            $table
                ->foreignId('domain_id')
                ->constrained("domains");
            $table->string('original_name');
            $table->string('mime_type');
            $table->string('extension');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
