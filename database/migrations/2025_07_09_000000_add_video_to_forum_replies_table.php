<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('forum_replies', function (Blueprint $table) {
            $table->string('video')->nullable()->after('isi');
        });
    }
    public function down()
    {
        Schema::table('forum_replies', function (Blueprint $table) {
            $table->dropColumn('video');
        });
    }
}; 