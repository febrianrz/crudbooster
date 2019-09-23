<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsCronHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_cron_histories', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cms_cron_id');
            $table->datetime('start_at');
            $table->datetime('end_at')->nullable();
            $table->boolean('is_success')->default(false);
            $table->text('response')->nullable();
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
        
    }
}
