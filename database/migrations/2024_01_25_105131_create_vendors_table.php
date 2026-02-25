<?php

use App\Enum\VendorStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained();
            $table->string('shop_name');
            $table->string('image')->nullable();
            $table->string('image_cover')->nullable();
            $table->string('nid')->nullable();
            $table->string('trade_licence')->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('status')->default(VendorStatus::Active);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
