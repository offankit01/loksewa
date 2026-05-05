<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('notify_email_newsletter')->default(true);
            $table->boolean('notify_mock_tests')->default(true);
            $table->string('theme_preference')->default('light');
            $table->boolean('two_fa_enabled')->default(false);
            $table->string('two_fa_secret')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'notify_email_newsletter',
                'notify_mock_tests',
                'theme_preference',
                'two_fa_enabled',
                'two_fa_secret',
            ]);
        });
    }
};
