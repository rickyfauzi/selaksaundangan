<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGambarToNamaTabelAndaTable extends Migration // Ganti nama kelas ini jika Anda mengubah nama file
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amplopdigital_t', function (Blueprint $table) { // Ganti 'nama_tabel_anda'
            // Tambahkan kolom 'gambar'
            // Biasanya gambar disimpan sebagai path/string ke file, bukan blob langsung di database.
            // varchar(255) cukup untuk path.
            // Buat nullable karena mungkin tidak semua entri memiliki gambar.
            // Anda bisa menempatkannya setelah kolom tertentu jika diinginkan, misal setelah 'noakun'.
            $table->string('gambar', 255)->nullable()->after('noakun');
            // Jika Anda hanya ingin menambahkannya di akhir tabel, Anda bisa menghapus ->after('noakun')
            // $table->string('gambar', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amplopdigital_t', function (Blueprint $table) { // Ganti 'nama_tabel_anda'
            // Hapus kolom 'gambar' jika migrasi di-rollback
            $table->dropColumn('gambar');
        });
    }
}