<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';

    protected $primaryKey = 'id'; // Specify the primary key

    protected $fillable = [
        // Section A: Data Pemohon
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat_ktp',
        'alamat_domisili',
        'jenis_kelamin',
        'no_hp',
        'status_perkawinan',

        // Section B: Data Pekerjaan
        'affiliasi_id',
        'nip',
        'no_bpjs',
        'jabatan',
        'status_kepegawaian',
        'pendidikan_terakhir',
        'departemen',
        'tahun_kerja',
        'thp',

        // Section C: Data Pasangan Pemohon
        'nama_pasangan',
        'status_pasangan',
        'nik_pasangan',
        'alamat_pasangan',
        'no_hp_pasangan',
        'jumlah_anak',

        // Section D: Data Pengajuan Kredit
        'fasilitas_kredit',
        'tujuan_penggunaan',
        'plafond_kredit',
        'tenor_bulan',
        'jenis_bunga',
        'sistem_pembayaran',

        // Section E: Data Rekening KBI Pemohon
        'bank_penerbit',
        'jenis_rekening',
        'nomor_rekening',
        'atas_nama_rekening',

        // Section F: Data Jaminan Kredit (Kendaraan)
        'jenis_kendaraan',
        'kondisi_kendaraan',
        'tujuan_kredit_kendaraan',
        'brand_kendaraan',
        'tipe_kendaraan',
        'tahun_pembuatan',
        'nomor_bpkb',
        'nomor_mesin',
        'nomor_rangka',
        'atas_nama_kendaraan',

        // Section G: Data Kontak Darurat
        'nama_kontak_darurat',
        'hubungan_kontak_darurat',
        'alamat_kontak_darurat',
        'no_hp_kontak_darurat',

        // Section H: Data Dokumen Pendukung
        'dokumen_ktp',
        'is_dokumen_ktp',
        'uploader_dokumen_ktp',

        'dokumen_kartu_keluarga',
        'is_dokumen_kartu_keluarga',
        'uploader_dokumen_kartu_keluarga',
        
        'dokumen_npwp',
        'is_dokumen_npwp',
        'uploader_dokumen_npwp',
        
        'dokumen_ktp_pasangan',
        'is_dokumen_ktp_pasangan',
        'uploader_dokumen_ktp_pasangan',
        
        'dokumen_asuransi',
        'is_dokumen_asuransi',
        'uploader_dokumen_asuransi',
        
        'dokumen_id_card_perusahaan',
        'is_dokumen_id_card_perusahaan',
        'uploader_dokumen_id_card_perusahaan',
        
        'dokumen_selfie',
        'is_dokumen_selfie',
        'uploader_dokumen_selfie',
        
        'dokumen_surat_pernyataan',
        'is_dokumen_surat_pernyataan',
        'uploader_dokumen_surat_pernyataan',
        
        'status_pengajuan',
        'catatan',
        'status_nasabah',
    ];

}
