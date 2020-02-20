<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobidToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('files', 'job_id')) {
            Schema::table('files', function (Blueprint $table) {
                $table->string('job_id')->nullable()->after('processed');
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
        if (Schema::hasColumn('files', 'job_id')) {
            Schema::table('files', function (Blueprint $table) {
                $table->dropColumn('job_id');
            });
        }
    }
}
