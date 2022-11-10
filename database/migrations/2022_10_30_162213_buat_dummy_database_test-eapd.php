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

        /** 
         * Migration dummy database untuk keperluan testing
         * 
         * pastikan DB_DATABASE di file .env tidak menggunakan nama db asli!
         * ganti menjadi DB_DATABASE = test-eapd misalnya untuk membuat database baru untuk dummy
         * lalu jalankan perintah ini di terminal : php artisan migrate --seed
         * agar artisan membuat database dummy dan mengisinya dengan data dummy dari seeders/DatabaseSeeder.php
         * 
         * untuk menghapus database dummy, dapat dilakukan secara manual
         * atau dengan perintah php artisan migrate:reset
         */

        if (!Schema::hasTable('user')) {

            Schema::create('user', function (Blueprint $table) {
                $table->id();
                $table->string('nrk', 10);
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('jabatan')) {
            Schema::create('jabatan', function (Blueprint $t) {
                $t->string('id_jabatan', 8)->primary();
                $t->text('nama_jabatan');
                $t->text('tipe_jabatan');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('wilayah')) {
            Schema::create('wilayah', function (Blueprint $t) {
                $t->string('id_wilayah', 4)->primary();
                $t->text('nama_wilayah');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('penempatan')) {
            Schema::create('penempatan', function (Blueprint $t) {
                $t->string('id_penempatan', 10)->primary();
                $t->text('nama_penempatan');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('grup')) {
            Schema::create('grup', function (Blueprint $t) {
                $t->string('id_grup', 2)->primary();
                $t->text('nama_grup');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('pegawai')) {
            Schema::create('pegawai', function (Blueprint $table) {
                $table->id();
                $table->string('nrk', 10);
                $table->string('nip', 20)->nullable();
                $table->text('nama');
                $table->text('foto')->nullable();
                $table->string('no_telp', 20)->nullable();
                $table->text('email')->nullable();
                $table->string('id_jabatan', 8);
                $table->string('id_wilayah', 4);
                $table->string('id_penempatan', 10);
                $table->string('id_grup', 2);
                $table->integer('kurang', 2)->autoIncrement(false)->nullable()->default(0)->comment('berapa apd yang belum diinput');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('jenis_item')) {
            Schema::create('jenis_item', function (Blueprint $t) {
                $t->string('id_jenis', 4);
                $t->text('nama_jenis');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('list_item')) {
            Schema::create('list_item', function (Blueprint $t) {
                $t->string('id_item', 4)->primary();
                $t->string('id_jenis', 4);
                $t->text('nama_item');
                $t->text('image')->nullable();
                $t->text('merk')->nullable();
                $t->boolean('ingub', 1)->default(0)->comment('apakah apd sudah sesuai ingub');
                $t->text('pengadaan')->nullable()->default('Sebelum 2022');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('master_kondisi')) {
            Schema::create('master_kondisi', function (Blueprint $t) {
                $t->string('id_kondisi', 4)->primary();
                $t->text('keterangan')->nullable();
                $t->text('list')->nullable();
            });
        }

        if (!Schema::hasTable('master_size')) {
            Schema::create('master_size', function (Blueprint $t) {
                $t->string('id_size', 4)->primary();
                $t->text('keterangan')->nullable();
                $t->text('list')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('daftar_input_apd')) {
            Schema::create('daftar_input_apd', function (Blueprint $t) {
                $t->id();
                $t->string('nrk', 10);
                $t->string('id_jenis', 4);
                $t->string('id_item', 4);
                $t->text('size')->nullable();
                $t->text('status_barang')->nullable();
                $t->text('kondisi')->nullable();
                $t->text('keterangan')->nullable();
                $t->text('foto')->nullable();
                $t->text('periode_input')->nullable();
                $t->timestamps();
                $t->string('verified_by', 10)->nullable()->comment('diisi nrk verifikator');
                $t->timestamp('verified_at')->nullable();
            });
        }

        if (!Schema::hasTable('daftar_input_apd_non-pegawai')) {
            Schema::create('daftar_input_apd_non-pegawai', function (Blueprint $t) {
                $t->id();
                $t->string('nrk', 10);
                $t->string('id_jenis', 4);
                $t->string('id_item', 4);
                $t->text('size')->nullable();
                $t->text('status_barang')->nullable();
                $t->text('kondisi')->nullable();
                $t->text('keterangan')->nullable();
                $t->text('foto')->nullable();
                $t->text('periode_input')->nullable();
                $t->timestamps();
                $t->string('verified_by', 10)->nullable()->comment('diisi nrk verifikator');
                $t->timestamp('verified_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('wilayah');
        Schema::dropIfExists('penempatan');
        Schema::dropIfExists('grup');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('jenis_item');
        Schema::dropIfExists('list_item');
        Schema::dropIfExists('master_kondisi');
        Schema::dropIfExists('master_size');
        Schema::dropIfExists('daftar_input_apd');
        Schema::dropIfExists('daftar_input_apd_non-pegawai');
    }
};
