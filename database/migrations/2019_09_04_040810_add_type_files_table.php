<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('files', 'type')) {
            Schema::table('files', function (Blueprint $table) {
                $table->tinyInteger('type')->after('processed');
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
        if (Schema::hasColumn('files', 'type')) {
            Schema::table('files', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
}
