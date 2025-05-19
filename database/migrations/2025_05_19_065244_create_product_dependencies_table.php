<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDependenciesTable extends Migration
{
    public function up()
    {
        Schema::create('product_dependencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            $table->foreignId('depends_on_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'depends_on_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_dependencies');
    }
}

