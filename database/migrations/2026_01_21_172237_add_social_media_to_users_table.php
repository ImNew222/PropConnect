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
        Schema::table('users', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('phone');
            $table->string('facebook')->nullable()->after('whatsapp');
            $table->string('viber')->nullable()->after('facebook');
            $table->string('telegram')->nullable()->after('viber');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'facebook', 'viber', 'telegram']);
        });
    }
};
