<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('system'); // ✅ Tambahkan ini
            $table->string('sub_system'); // ✅ Tambahkan ini
            $table->string('wo_type'); // ✅ Tambahkan ini
            $table->string('scope')->nullable();
            $table->text('description');
            $table->date('request_date');
            $table->string('organization');
            $table->string('requester');
            $table->string('status')->default('Open');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
