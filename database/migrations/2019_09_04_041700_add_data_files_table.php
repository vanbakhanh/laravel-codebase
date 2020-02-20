<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('files', 'data')) {
            Schema::table('files', function (Blueprint $table) {
                $table->string('data')->nullable()->after('processed');
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
        if (Schema::hasColumn('files', 'data')) {
            Schema::table('files', function (Blueprint $table) {
                $table->dropColumn('data');
            });
        }
    }
}
