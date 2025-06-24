<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('requests', function (Blueprint $table) {

            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');

            $table->foreignId('category_id')->after('user_id')->constrained()->onDelete('restrict');

            $table->string('tel', 15)->nullable()->change();
            $table->softDeletes();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            // 巻き戻し用：post_id を復元
            $table->foreignId('post_id')->constrained()->onDelete('cascade');

            // category_id を削除
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('title');
            $table->dropSoftDeletes();
        });
    }
};
