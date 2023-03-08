<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tanggapans', function (Blueprint $table) {
            $table->foreign('pengaduan_id', 'fk_tanggapans_to_pengaduans')->references('id')->on('pengaduans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('petugas_id', 'fk_tanggapans_to_petugas')->references('id')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tanggapans', function (Blueprint $table) {
            $table->dropForeign('fk_tanggapans_to_pengaduans');
            $table->dropForeign('fk_tanggapans_to_petugas');
        });
    }
};
