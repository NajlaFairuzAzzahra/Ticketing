<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('attachment')->nullable()->after('description'); // Kolom untuk file lampiran
            $table->string('link')->nullable()->after('attachment'); // Kolom untuk link
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['attachment', 'link']); // Hapus kolom saat rollback
        });
    }
};
