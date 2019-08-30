<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPrintoutTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_printout_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name');
            $table->string('file_name')->nullable();
            $table->string('file_type')->default('word');
            $table->string('key');
            $table->string('type')->comment('single data / batch data');
            $table->string('description')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
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
        Schema::table('cms_printout_templates', function (Blueprint $table) {
            
        });
    }
}
