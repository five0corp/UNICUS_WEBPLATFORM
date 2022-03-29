<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('community_categories')) {
            Schema::create('community_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name', 120)->default('');
                $table->tinyInteger('status')->default(1)->comment('Enable : 1, Disable : 0');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_category');
    }
}
