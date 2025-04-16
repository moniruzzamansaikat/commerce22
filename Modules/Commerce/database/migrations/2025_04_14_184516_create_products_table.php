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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_desc')->comment('')->nullable();
            $table->text('desc')->comment('')->nullable();
            $table->string('sku')->nullable()->comment('stock keeping unit');
            $table->boolean('is_published')->default(1)->comment('Published or not for shop');
            $table->boolean('status')->default(1)->comment('active=1,inactive=0');
            $table->boolean('is_new')->default(false)->comment('Mark this product as new for promotion');
            $table->text('admin_comment')->nullable()->comment('Admin comment for internal use');
            $table->decimal('price', 28, 8)->default(0);    
            $table->decimal('old_price', 28, 8)->default(0)->nullable()->comment('Use this to show a differnce between price');
            $table->decimal('cost', 28, 8)->default(0)->nullable()->comment('Product cost for internal usecase');
            $table->integer('tax_category_id')->default(0)->nullable()->comment('Tax category for this product');
            $table->boolean('non_returnable')->default(false)->nullable()->comment('This product is not returnable');
            $table->boolean('is_downloadable')->default(false)->nullable()->comment('Digital product that can be downloaded');
            $table->text('download_link')->nullable()->comment('Set the link manullay here');
            $table->boolean('unlimited_download')->default(true)->comment('Unlimited download');
            $table->integer('total_download_limit')->nullable()->comment('Download limit');
            $table->boolean('is_rental')->default(false)->nullable()->comment('Rental product, will work period like 1 day or 1 week or 2days. Inventory does not work for this.');
            $table->tinyInteger('rental_period')->nullable()->comment('1=day,2=week,3=month,4=year');
            $table->integer('rental_period_length')->nullable()->comment('Rental period lenght associated with period');
            $table->string('meta_title')->nullable()->comment('Default to product title, you can override it');
            $table->text('meta_keywords')->nullable()->comment('Meta keywords for seo of this product');
            $table->text('meta_description')->nullable()->comment('Meta descriptoin for seo of this product');
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
