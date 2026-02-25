<?php

use App\Enum\ProductStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_bn');
            $table->foreignId('created_by')->constrained('admins');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('unit_id')->constrained();
            $table->text('short_text')->nullable();
            $table->string('code')->unique()->nullable();
            $table->unsignedDecimal('buy_price', 10,2);
            $table->unsignedDecimal('sale_price', 10,2);
            $table->unsignedDecimal('alert_quantity')->default(0);
            $table->string('discount_type')->nullable();
            $table->unsignedDecimal('discount_price')->default(0);
            $table->unsignedDecimal('min_purchase_quantity')->default(0);
            $table->unsignedDecimal('stock_quantity')->default(0);
            $table->unsignedDecimal('point')->default(0);
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('status')->default(ProductStatus::Active);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
