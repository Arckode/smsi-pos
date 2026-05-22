<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NasabahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            // Section A: Data Pemohon
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'agama' => ['nullable', Rule::in(['Islam', 'Katolik', 'Kristen', 'Hindu', 'Budha', 'Konghuchu', 'Aliran Kepercayaan'])],
            'alamat_ktp' => 'nullable|string',
            'alamat_domisili' => 'nullable|string',
            'jenis_kelamin' => ['nullable', Rule::in(['L', 'P'])],
            'no_hp' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',

            // Section B: Data Pekerjaan
            'temp_affiliasi' => 'nullable|string|max:255',
            'affiliasi_id' => 'nullable|integer|exists:affiliasi,id',
            'nip' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'no_bpjs' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'status_kepegawaian' => ['nullable', Rule::in(['Tetap', 'Kontrak', 'Outsourcing'])],
            'pendidikan_terakhir' => ['nullable', Rule::in(['SMA', 'D3', 'S1', 'S2', 'S3'])],
            'departemen' => 'nullable|string|max:255',
            'tahun_kerja' => 'nullable|integer',
            'thp' => 'nullable|numeric',

            // Section C: Data Pasangan Pemohon
            'nama_pasangan' => 'nullable|string|max:255',
            'status_pasangan' => ['nullable', Rule::in(['Suami', 'Istri'])],
            'nik_pasangan' => 'nullable|string|max:255',
            'alamat_pasangan' => 'nullable|string',
            'no_hp_pasangan' => 'nullable|string|max:255',
            'jumlah_anak' => 'nullable|integer',

            // Section D: Data Pengajuan Kredit
            'fasilitas_kredit' => ['nullable', Rule::in(['KKB', 'KSG'])],
            'tujuan_penggunaan' => 'nullable|string|max:255',
            'plafond_kredit' => 'nullable|numeric',
            'tenor_bulan' => 'nullable|integer',
            'jenis_bunga' => ['nullable', Rule::in(['Fixed Rate', 'Floating Rate'])],
            'sistem_pembayaran' => ['nullable', Rule::in(['Potong Gaji', 'Payroll'])],

            // Section E: Data Rekening KBI Pemohon
            'bank_penerbit' => 'nullable|string|max:255',
            'jenis_rekening' => 'nullable|string|max:255',
            'nomor_rekening' => 'nullable|string|max:255',
            'atas_nama_rekening' => 'nullable|string|max:255',

            // Section F: Jaminan Kredit (Kendaraan)
            'jenis_kendaraan' => ['nullable', Rule::in(['Roda 2', 'Roda 4'])],
            'kondisi_kendaraan' => ['nullable', Rule::in(['New', 'Used'])],
            'tujuan_kredit_kendaraan' => ['nullable', Rule::in(['Pembelian', 'Refinancing'])],
            'brand_kendaraan' => 'nullable|string|max:255',
            'tipe_kendaraan' => 'nullable|string|max:255',
            'tahun_pembuatan' => 'nullable|integer',
            'nomor_bpkb' => 'nullable|string|max:255',
            'nomor_mesin' => 'nullable|string|max:255',
            'nomor_rangka' => 'nullable|string|max:255',
            'atas_nama_kendaraan' => 'nullable|string|max:255',

            // section G: Kontak Darurat
            'nama_kontak_darurat' => 'nullable|string|max:255',
            'hubungan_kontak_darurat' => 'nullable|string|max:255',
            'no_hp_kontak_darurat' => 'nullable|string|max:255',
            'alamat_kontak_darurat' => 'nullable|string',

            // // Status dan tracking
            'status_pengajuan' => ['nullable', Rule::in(['Draft', 'Submitted', 'User Review', 'Approved', 'Rejected'])],
            'catatan' => 'nullable|string|max:255',
        ];
    }
}
