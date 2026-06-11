<?php

namespace App\Http\Controllers\Api;

use App\Models\PengajuanKredit;
use App\Http\Controllers\Controller;
use App\Http\Traits\DatabaseTrait;
use App\Http\Traits\LogTrait;
use App\Models\AngsuranPinjaman;
use App\Models\AngsuranPinjamanDetail;
use App\Models\Nasabah;
use App\Models\Penghasilan;
use App\Models\PenghasilanTransactions;
use App\Models\Edocs\LogEdocs;
use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PengajuanKreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $pengajuanKredit = PengajuanKredit::recent()
                ->paginate(15);

            return response()->json([
                'success' => true,
                'message' => 'Data pengajuan kredit berhasil diambil',
                'data' => $pengajuanKredit,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'nik' => 'nullable|string|max:255',
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'agama' => 'nullable|string|max:255',
                'alamat_ktp' => 'nullable|string|max:255',
                'alamat_domisili' => 'nullable|string|max:255',
                'jenis_kelamin' => 'nullable|string|max:255',
                'no_hp' => 'nullable|string|max:255',
                'status_perkawinan' => 'nullable|string|max:255',
                'affiliasi_id' => 'nullable|integer|max:255',
                'nip' => 'nullable|string|max:255',
                'npwp' => 'nullable|string|max:255',
                'no_bpjs' => 'nullable|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'status_kepegawaian' => 'nullable|string|max:255',
                'pendidikan_terakhir' => 'nullable|string|max:255',
                'departemen' => 'nullable|string|max:255',
                'tahun_kerja' => 'nullable|integer',
                'thp' => 'nullable|numeric',
                'nama_pasangan' => 'nullable|string|max:255',
                'status_pasangan' => 'nullable|string|max:255',
                'nik_pasangan' => 'nullable|string|max:255',
                'alamat_pasangan' => 'nullable|string|max:255',
                'no_hp_pasangan' => 'nullable|string|max:255',
                'jumlah_anak' => 'nullable|integer',
                'fasilitas_kredit' => 'nullable|string|max:255',
                'tujuan_penggunaan' => 'nullable|string|max:255',
                'plafond_kredit' => 'nullable|numeric',
                'tenor_bulan' => 'nullable|integer',
                'jenis_bunga' => 'nullable|string|max:255',
                'sistem_pembayaran' => 'nullable|string|max:255',
                'bank_penerbit' => 'nullable|string|max:255',
                'jenis_rekening' => 'nullable|string|max:255',
                'nomor_rekening' => 'nullable|string|max:255',
                'atas_nama_rekening' => 'nullable|string|max:255',
                'jenis_kendaraan' => 'nullable|string|max:255',
                'kondisi_kendaraan' => 'nullable|string|max:255',
                'tujuan_kredit_kendaraan' => 'nullable|string|max:255',
                'brand_kendaraan' => 'nullable|string|max:255',
                'tipe_kendaraan' => 'nullable|string|max:255',
                'tahun_pembuatan' => 'nullable|integer',
                'nomor_bpkb' => 'nullable|string|max:255',
                'nomor_mesin' => 'nullable|string|max:255',
                'nomor_rangka' => 'nullable|string|max:255',
                'atas_nama_kendaraan' => 'nullable|string|max:255',
                'nama_kontak_darurat' => 'nullable|string|max:255',
                'hubungan_kontak_darurat' => 'nullable|string|max:255',
                'alamat_kontak_darurat' => 'nullable|string|max:255',
                'no_hp_kontak_darurat' => 'nullable|string|max:255',
            ]);

            $validatedData['created_by'] = auth()->id();
            $validatedData['status_pengajuan'] = 'Draft';

            $pengajuanKredit = Nasabah::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan kredit berhasil dibuat',
                'data' => $pengajuanKredit,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $pengajuanKredit = PengajuanKredit::with('nasabah')->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data pengajuan kredit berhasil diambil',
                'data' => $pengajuanKredit,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengajuan kredit tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $pengajuanKredit = PengajuanKredit::findOrFail($id);

            $validated = $request->validate([
                // Section A
                'nama_lengkap' => 'sometimes|required|string|max:255',
                'nik' => 'nullable|string|max:16|unique:pengajuan_kredit,nik,' . $id,
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'agama' => 'nullable|string',
                'alamat_ktp' => 'nullable|string',
                'alamat_domisili' => 'nullable|string',
                'jenis_kelamin' => 'nullable|in:L,P',
                'no_hp' => 'nullable|string|max:20',
                'status_perkawinan' => 'nullable|string',
                
                // Section B
                'nama_perusahaan' => 'nullable|string|max:255',
                'nip' => 'nullable|string|max:255',
                'no_bpjs' => 'nullable|string|max:20',
                'jabatan' => 'nullable|string|max:255',
                'status_kepegawaian' => 'nullable|string',
                'pendidikan_terakhir' => 'nullable|string',
                'departemen' => 'nullable|string|max:255',
                'tahun_kerja' => 'nullable|integer|min:0',
                
                // Section C
                'nama_pasangan' => 'nullable|string|max:255',
                'status_pasangan' => 'nullable|string',
                'nik_pasangan' => 'nullable|string|max:16',
                'alamat_pasangan' => 'nullable|string',
                'no_hp_pasangan' => 'nullable|string|max:20',
                'jumlah_anak' => 'nullable|integer|min:0',
                
                // Section D
                'fasilitas_kredit' => 'nullable|string',
                'tujuan_penggunaan' => 'nullable|string',
                'plafond_kredit' => 'nullable|numeric|min:0',
                'tenor_bulan' => 'nullable|integer|min:1',
                'jenis_bunga' => 'nullable|string',
                'sistem_pembayaran' => 'nullable|string',
                
                // Section E
                'bank_penerbit' => 'nullable|string',
                'jenis_rekening' => 'nullable|string',
                'nomor_rekening' => 'nullable|string|max:255',
                'atas_nama_rekening' => 'nullable|string|max:255',
                
                // Section F
                'jenis_kendaraan' => 'nullable|string',
                'kondisi_kendaraan' => 'nullable|string',
                'tujuan_kredit_kendaraan' => 'nullable|string',
                'brand_kendaraan' => 'nullable|string|max:255',
                'tipe_kendaraan' => 'nullable|string|max:255',
                'tahun_pembuatan' => 'nullable|integer|min:1900',
                'nomor_bpkb' => 'nullable|string|max:255',
                'nomor_mesin' => 'nullable|string|max:255',
                'nomor_rangka' => 'nullable|string|max:255',
                'atas_nama_kendaraan' => 'nullable|string|max:255',
                
                'status_pengajuan' => 'nullable|in:draft,submitted,approved,rejected,processing',
                'catatan' => 'nullable|string',
                'nasabah_id' => 'nullable|exists:nasabah,id',
            ]);

            $validated['updated_by'] = auth()->id();
            $pengajuanKredit->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan kredit berhasil diperbarui',
                'data' => $pengajuanKredit,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengajuan kredit tidak ditemukan',
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $pengajuanKredit = PengajuanKredit::findOrFail($id);
            $pengajuanKredit->deleted_by = auth()->id();
            $pengajuanKredit->save();
            $pengajuanKredit->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan kredit berhasil dihapus',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengajuan kredit tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get applications by status
     */
    public function getByStatus($status): JsonResponse
    {
        try {
            $pengajuanKredit = PengajuanKredit::byStatus($status)
                ->with('nasabah')
                ->recent()
                ->paginate(15);

            return response()->json([
                'success' => true,
                'message' => 'Data pengajuan kredit berhasil diambil',
                'data' => $pengajuanKredit,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update status of application
     */
    public function updateStatus(Request $request, $id): JsonResponse
    {
        try {
            $pengajuanKredit = PengajuanKredit::findOrFail($id);

            $validated = $request->validate([
                'status_pengajuan' => 'required|in:draft,submitted,approved,rejected,processing',
                'catatan' => 'nullable|string',
            ]);

            $pengajuanKredit->updateStatus(
                $validated['status_pengajuan'],
                $validated['catatan'] ?? null
            );
            $pengajuanKredit->updated_by = auth()->id();
            $pengajuanKredit->save();

            return response()->json([
                'success' => true,
                'message' => 'Status pengajuan berhasil diperbarui',
                'data' => $pengajuanKredit,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengajuan kredit tidak ditemukan',
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
