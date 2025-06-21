<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_attendance_to_ucapans_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ucapan_t', function (Blueprint $table) {
            $table->string('attendance')->nullable()->after('ucapan'); // Atau ENUM jika database mendukung
        });
    }

    public function down()
    {
        Schema::table('ucapan_t', function (Blueprint $table) {
            $table->dropColumn('attendance');
        });
    }
};