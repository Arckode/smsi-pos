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
        Schema::create('nasabah', function (Blueprint $table) {

            $table->id();

            // Section A: Data Pemohon
            $table->string('nama_lengkap')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('agama', ['Islam', 'Katolik', 'Kristen', 'Hindu', 'Budha', 'Konghuchu', 'Aliran Kepercayaan'])->nullable();
            $table->text('alamat_ktp')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('no_hp')->nullable();
            $table->string('status_perkawinan')->nullable();

            // Section B: Data Pekerjaan
            $table->string('temp_affiliasi')->nullable();
            $table->integer('affiliasi_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('npwp')->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('jabatan')->nullable();
            $table->enum('status_kepegawaian', ['Tetap', 'Kontrak', 'Outsourcing'])->nullable();
            $table->enum('pendidikan_terakhir', ['SMA', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('departemen')->nullable();
            $table->integer('tahun_kerja')->nullable();
            $table->decimal('thp', 15, 2)->nullable();

            // Section C: Data Pasangan Pemohon
            $table->string('nama_pasangan')->nullable();
            $table->enum('status_pasangan', ['Suami', 'Istri'])->nullable();
            $table->string('nik_pasangan')->nullable();
            $table->text('alamat_pasangan')->nullable();
            $table->string('no_hp_pasangan')->nullable();
            $table->integer('jumlah_anak')->nullable();

            // Section D: Data Pengajuan Kredit
            $table->enum('fasilitas_kredit', ['KKB', 'KSG'])->nullable();
            $table->string('tujuan_penggunaan')->nullable();
            $table->decimal('plafond_kredit', 15, 2)->nullable();
            $table->integer('tenor_bulan')->nullable();
            $table->enum('jenis_bunga', ['Fixed Rate', 'Floating Rate'])->nullable();
            $table->enum('sistem_pembayaran', ['Potong Gaji', 'Payroll'])->nullable();

            // Section E: Data Rekening KBI Pemohon
            $table->string('bank_penerbit')->default('PT. BANK KB INDONESIA, TBK.');
            $table->string('jenis_rekening')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('atas_nama_rekening')->nullable();

            // Section F: Jaminan Kredit (Kendaraan)
            $table->enum('jenis_kendaraan', ['Roda 2', 'Roda 4'])->nullable();
            $table->enum('kondisi_kendaraan', ['New', 'Used'])->nullable();
            $table->enum('tujuan_kredit_kendaraan', ['Pembelian', 'Refinancing'])->nullable();
            $table->string('brand_kendaraan')->nullable();
            $table->string('tipe_kendaraan')->nullable();
            $table->integer('tahun_pembuatan')->nullable();
            $table->string('nomor_bpkb')->nullable();
            $table->string('nomor_mesin')->nullable();
            $table->string('nomor_rangka')->nullable();
            $table->string('atas_nama_kendaraan')->nullable();

            // section G: Kontak Darurat
            $table->string('nama_kontak_darurat')->nullable();
            $table->string('hubungan_kontak_darurat')->nullable();
            $table->string('alamat_kontak_darurat')->nullable();
            $table->string('no_hp_kontak_darurat')->nullable();

            // Section H: Dokumen Pendukung (Menyimpan path/file name)
            $table->string('dokumen_ktp')->nullable();
            $table->integer('uploader_dokumen_ktp')->nullable();

            $table->string('dokumen_kartu_keluarga')->nullable();
            $table->integer('uploader_dokumen_kartu_keluarga')->nullable();

            $table->string('dokumen_npwp')->nullable();
            $table->integer('uploader_dokumen_npwp')->nullable();
            
            $table->string('dokumen_ktp_pasangan')->nullable();
            $table->integer('uploader_dokumen_ktp_pasangan')->nullable();

            $table->string('dokumen_asuransi')->nullable();
            $table->integer('uploader_dokumen_asuransi')->nullable();

            $table->string('dokumen_id_card_perusahaan')->nullable();
            $table->integer('uploader_dokumen_id_card_perusahaan')->nullable();

            $table->string('dokumen_selfie')->nullable();
            $table->integer('uploader_dokumen_selfie')->nullable();

            $table->string('dokumen_surat_pernyataan')->nullable();
            $table->integer('uploader_dokumen_surat_pernyataan')->nullable();

            // Status dan tracking
            $table->enum('status_pengajuan', ['Draft', 'Submitted', 'User Review', 'Approved', 'Rejected'])->default('Draft');
            $table->boolean('validation')->default(false)->nullable();
            $table->integer('validated_by')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            
            $table->boolean('status_nasabah')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah');
    }
};
