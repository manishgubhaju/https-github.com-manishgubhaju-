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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prefixname')->nullable();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffixname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->text('password');
            $table->text('photo')->nullable();
            $table->string('type')->nullable()->multiple()->default('user');
            $table->string('remember_token')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->string('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('deleted_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
