<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Hapus kolom status lama jika sudah ada
            $table->dropColumn('status');

            // Tambahkan kolom status baru sebagai ENUM agar lebih aman
            $table->enum('status', ['Open', 'In Progress', 'Closed'])->default('Open')->after('description');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->string('status')->default('Open'); // Balik ke string jika rollback
        });
    }
};
