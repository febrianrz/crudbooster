<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsSyncTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_sync_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name');
            $table->string('column_key');
            $table->unsignedInteger('approach')->default(2);
            $table->boolean('is_active')->default(false);
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
        Schema::table('cms_sync_tables', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
