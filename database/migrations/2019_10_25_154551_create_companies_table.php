<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('name')->default('');
            $table->string('street')->default('');
            $table->string('city')->default('');
            $table->string('zip')->default('');
            $table->string('number')->default('');
            $table->string('vat')->default('');
            $table->boolean('is_vat')->default(0);
            $table->string('registration')->default('');
            $table->string('phone')->default('');
            $table->string('email')->default('');
            $table->string('bank_name')->default('');
            $table->string('bank_number')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
