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
        Schema::table('menus', function (Blueprint $table) {
            $table->string('slug', 64)->nullable()->after('id');
            $table->string('url', 500)->nullable()->after('menu_name');
            $table->unsignedTinyInteger('sort_order')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['slug', 'url', 'sort_order']);
        });
    }
};
