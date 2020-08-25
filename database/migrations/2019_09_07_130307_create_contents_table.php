<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('system')->default('0');
            $table->boolean('active');
            $table->boolean('protected')->nullable();
            $table->string('title');
            $table->longText('body')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_title')->nullable();
            $table->bigInteger('create_admin_id');
            $table->bigInteger('update_admin_id');
            $table->longText('backup')->nullable();
            $table->timestamp('backup_created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
