<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTempletesTableColumnRarityId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // カラム名を変更
        Schema::table('templetes', function (Blueprint $table) {
            $table->renameColumn('rarity_id', 'rarity_name');
        });
        
        // 型を変更
        Schema::table('templetes', function (Blueprint $table) {
            $table->string('rarity_name')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 型を戻す
        Schema::table('templetes', function (Blueprint $table) {
            $table->integer('rarity_id')->change();
        });
        
        Schema::table('templetes', function (Blueprint $table) {
            $table->renameColumn('rarity_name', 'rarity_id');
        });
    }
}
