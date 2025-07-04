<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('forum_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->timestamps();
        });
        Schema::table('forums', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('forum_categories')->nullOnDelete();
            $table->boolean('sticky')->default(false);
            $table->string('image')->nullable();
        });
        Schema::table('forum_replies', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }
    public function down()
    {
        Schema::table('forums', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'sticky', 'image']);
        });
        Schema::table('forum_replies', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::dropIfExists('forum_categories');
    }
}; 