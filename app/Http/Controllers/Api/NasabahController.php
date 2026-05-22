<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccessRequest;
use App\Models\Nasabah;
use App\Models\NasabahLog;
use App\Models\NasabahStatusLog;
use App\Models\MenuModule;
use App\Models\MenuSubmodule;
use App\Models\User;
use App\Models\MenuUserAccess;
use App\Models\MenuUserSubmodulePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Mail\PengajuanMail;
use Illuminate\Support\Facades\Mail;
use Spatie\Browsershot\Browsershot;

class NasabahController extends Controller
{
    // protected const SUBMODULE_URL = '/nasabah';

    // protected function authorizeSubmoduleAction(string $action): void
    // {
    //     $subModule = MenuSubmodule::where('url', self::SUBMODULE_URL)->first();

    //     if (! $subModule) {
    //         abort(403, 'Bookstore asset submodule is not configured.');
    //     }

    //     $user = auth()->user();
    //     if (! $user) {
    //         abort(403, 'Unauthorized.');
    //     }

    //     $permission = $user->submodulePermissions()
    //         ->where('sub_module_id', $subModule->sub_module_id)
    //         ->first();

    //     if (! $permission || ! $permission->hasAction($action)) {
    //         abort(403, 'You do not have permission to perform this action.');
    //     }
    // }
    public function unvalidated()
    {
        // $this->authorizeSubmoduleAction('read');
        $relations = [
            'affiliasi:id,nama_affiliasi',
            // 'role:id,name'
        ];

        $data = Nasabah::with($relations)->where('validation', false)
            ->when(
                request()->has('search') && request()->search != '',
                function ($q) {
                    $q->where('nama_lengkap', 'like', '%' . request()->search . '%')
                        ->orWhere('nik', 'like', '%' . request()->search . '%');
                }
            )
            // ->when(
            //     request()->has('affiliasi') && request()->affiliasi != '',
            //     function ($q) {
            //         $q->orWhereHas('affiliasi', function ($q1) {
            //             $q1->where('name', 'like', '%' . request()->affiliasi . '%');
            //         });
            //     }
            // )
            ->paginate(15);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }


    public function validation(int $id, int $affiliasiId)
    {
        try {
            DB::beginTransaction();

            $nasabah = Nasabah::findOrFail($id);
            $nasabah->affiliasi_id = $affiliasiId;
            $nasabah->validation = true;
            $nasabah->validated_by = auth()->user()->id;
            $nasabah->save();

            NasabahLog::create([
                'action' => 'Validasi',
                'nasabah_id' => $nasabah->id,
                'payload_before' => json_encode($nasabah->getOriginal()),
                'payload_after' => json_encode($nasabah->toArray()),
                'created_by' => auth()->user()->id,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Nasabah has been validated successfully.',
                'data' => $nasabah,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to validate nasabah: ' . $e->getMessage(),
            ], 500);
        }   

    }

    public function index()
    {
        // $this->authorizeSubmoduleAction('read');
        $relations = [
            'affiliasi:id,nama_affiliasi',
            // 'role:id,name'
        ];

        $data = Nasabah::with($relations)->where('validation', true)
            ->when(
                request()->has('search') && request()->search != '',
                function ($q) {
                    $q->where('nama_lengkap', 'like', '%' . request()->search . '%')
                        ->orWhere('nik', 'like', '%' . request()->search . '%');
                }
            )
            // ->when(
            //     request()->has('affiliasi') && request()->affiliasi != '',
            //     function ($q) {
            //         $q->orWhereHas('affiliasi', function ($q1) {
            //             $q1->where('name', 'like', '%' . request()->affiliasi . '%');
            //         });
            //     }
            // )
            ->paginate(15);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    // public function changeStatus(int $id)
    // {
    //     $this->authorizeSubmoduleAction('update');

    //     $user = User::findOrFail($id);
    //     $user->is_active = ! $user->is_active;
    //     $user->save();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'User status has been updated successfully.',
    //         'data' => $user,
    //     ]);
    // }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // dd('masuk',$request->data_pemohon);
            // $this->authorizeSubmoduleAction('create');

            // $request->merge([
            //     'password' => 'password',
            //     'is_active' => 1
            // ]);

            $validatedData = $request->validate([
                'data_pemohon.nama_lengkap' => 'required|string|max:255',
                'data_pemohon.nik' => 'nullable|string|max:255',
                'data_pemohon.tempat_lahir' => 'nullable|string|max:255',
                'data_pemohon.tanggal_lahir' => 'nullable|date',
                'data_pemohon.agama' => 'nullable|string|max:255',
                'data_pemohon.alamat_ktp' => 'nullable|string|max:255',
                'data_pemohon.alamat_domisili' => 'nullable|string|max:255',
                'data_pemohon.jenis_kelamin' => 'nullable|string|max:255',
                'data_pemohon.no_hp' => 'nullable|string|max:255',
                'data_pemohon.status_perkawinan' => 'nullable|string|max:255',
                'data_pekerjaan.affiliasi_id' => 'nullable|integer|max:255',
                'data_pekerjaan.nip' => 'nullable|string|max:255',
                'data_pekerjaan.npwp' => 'nullable|string|max:255',
                'data_pekerjaan.no_bpjs' => 'nullable|string|max:255',
                'data_pekerjaan.jabatan' => 'nullable|string|max:255',
                'data_pekerjaan.status_kepegawaian' => 'nullable|string|max:255',
                'data_pekerjaan.pendidikan_terakhir' => 'nullable|string|max:255',
                'data_pekerjaan.departemen' => 'nullable|string|max:255',
                'data_pekerjaan.tahun_kerja' => 'nullable|integer',
                'data_pekerjaan.thp' => 'nullable|numeric',
                'data_pasangan.nama_pasangan' => 'nullable|string|max:255',
                'data_pasangan.status_pasangan' => 'nullable|string|max:255',
                'data_pasangan.nik_pasangan' => 'nullable|string|max:255',
                'data_pasangan.alamat_pasangan' => 'nullable|string|max:255',
                'data_pasangan.no_hp_pasangan' => 'nullable|string|max:255',
                'data_pasangan.jumlah_anak' => 'nullable|integer',
                'data_pengajuan.fasilitas_kredit' => 'nullable|string|max:255',
                'data_pengajuan.tujuan_penggunaan' => 'nullable|string|max:255',
                'data_pengajuan.plafond_kredit' => 'nullable|numeric',
                'data_pengajuan.tenor_bulan' => 'nullable|integer',
                'data_pengajuan.jenis_bunga' => 'nullable|string|max:255',
                'data_pengajuan.sistem_pembayaran' => 'nullable|string|max:255',
                'data_rekening.bank_penerbit' => 'nullable|string|max:255',
                'data_rekening.jenis_rekening' => 'nullable|string|max:255',
                'data_rekening.nomor_rekening' => 'nullable|string|max:255',
                'data_rekening.atas_nama_rekening' => 'nullable|string|max:255',
                'data_jaminan.jenis_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.kondisi_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.tujuan_kredit_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.brand_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.tipe_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.tahun_pembuatan' => 'nullable|integer',
                'data_jaminan.nomor_bpkb' => 'nullable|string|max:255',
                'data_jaminan.nomor_mesin' => 'nullable|string|max:255',
                'data_jaminan.nomor_rangka' => 'nullable|string|max:255',
                'data_jaminan.atas_nama_kendaraan' => 'nullable|string|max:255',
                'data_kontak.nama_kontak_darurat' => 'nullable|string|max:255',
                'data_kontak.hubungan_kontak_darurat' => 'nullable|string|max:255',
                'data_kontak.alamat_kontak_darurat' => 'nullable|string|max:255',
                'data_kontak.no_hp_kontak_darurat' => 'nullable|string|max:255',
            ]);

            $flattenedData = [];
            foreach ($validatedData as $section => $data) {
                foreach ($data as $key => $value) {
                    $flattenedData[$key] = $value;
                }
            }
            $flattenedData['created_by'] = auth()->user()->id;

            $validatedData = $flattenedData;
            $user = Nasabah::create($validatedData);

            $logData = [
                'action' => 'Create',
                'nasabah_id' => $user->id,
                'payload_before' => null,
                'payload_after' => json_encode($validatedData),
                'created_by' => auth()->user()->id,
            ];

            NasabahLog::create($logData);
            NasabahStatusLog::create([
                'nasabah_id' => $user->id,
                'status_before' => null,
                'status_after' => $user->status,
                'status_changed_at' => now(),
                'created_by' => auth()->user()->id,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User has been created successfully.',
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to create user: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show(int $id)
    {
        // $this->authorizeSubmoduleAction('read');

        $user = Nasabah::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $user,
        ]);
    }

    public function update(Request $request, int $id)
    {
        // $this->authorizeSubmoduleAction('update');
        try {

            DB::beginTransaction();

            $user = Nasabah::findOrFail($id);

            $validatedData = $request->validate([
                'data_pemohon.nama_lengkap' => 'required|string|max:255',
                'data_pemohon.nik' => 'nullable|string|max:255',
                'data_pemohon.tempat_lahir' => 'nullable|string|max:255',
                'data_pemohon.tanggal_lahir' => 'nullable|date',
                'data_pemohon.agama' => 'nullable|string|max:255',
                'data_pemohon.alamat_ktp' => 'nullable|string|max:255',
                'data_pemohon.alamat_domisili' => 'nullable|string|max:255',
                'data_pemohon.jenis_kelamin' => 'nullable|string|max:255',
                'data_pemohon.no_hp' => 'nullable|string|max:255',
                'data_pemohon.status_perkawinan' => 'nullable|string|max:255',
                'data_pekerjaan.affiliasi_id' => 'nullable|max:255',
                'data_pekerjaan.nip' => 'nullable|string|max:255',
                'data_pekerjaan.no_bpjs' => 'nullable|string|max:255',
                'data_pekerjaan.jabatan' => 'nullable|string|max:255',
                'data_pekerjaan.status_kepegawaian' => 'nullable|string|max:255',
                'data_pekerjaan.pendidikan_terakhir' => 'nullable|string|max:255',
                'data_pekerjaan.departemen' => 'nullable|string|max:255',
                'data_pekerjaan.tahun_kerja' => 'nullable|integer',
                'data_pekerjaan.thp' => 'nullable|numeric',
                'data_pasangan.nama_pasangan' => 'nullable|string|max:255',
                'data_pasangan.status_pasangan' => 'nullable|string|max:255',
                'data_pasangan.nik_pasangan' => 'nullable|string|max:255',
                'data_pasangan.alamat_pasangan' => 'nullable|string|max:255',
                'data_pasangan.no_hp_pasangan' => 'nullable|string|max:255',
                'data_pasangan.jumlah_anak' => 'nullable|integer',
                'data_pengajuan.fasilitas_kredit' => 'nullable|string|max:255',
                'data_pengajuan.tujuan_penggunaan' => 'nullable|string|max:255',
                'data_pengajuan.plafond_kredit' => 'nullable|numeric',
                'data_pengajuan.tenor_bulan' => 'nullable|integer',
                'data_pengajuan.jenis_bunga' => 'nullable|string|max:255',
                'data_pengajuan.sistem_pembayaran' => 'nullable|string|max:255',
                'data_rekening.bank_penerbit' => 'nullable|string|max:255',
                'data_rekening.jenis_rekening' => 'nullable|string|max:255',
                'data_rekening.nomor_rekening' => 'nullable|string|max:255',
                'data_rekening.atas_nama_rekening' => 'nullable|string|max:255',
                'data_jaminan.jenis_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.kondisi_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.tujuan_kredit_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.brand_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.tipe_kendaraan' => 'nullable|string|max:255',
                'data_jaminan.tahun_pembuatan' => 'nullable|integer',
                'data_jaminan.nomor_bpkb' => 'nullable|string|max:255',
                'data_jaminan.nomor_mesin' => 'nullable|string|max:255',
                'data_jaminan.nomor_rangka' => 'nullable|string|max:255',
                'data_jaminan.atas_nama_kendaraan' => 'nullable|string|max:255',
                'data_kontak.nama_kontak_darurat' => 'nullable|string|max:255',
                'data_kontak.hubungan_kontak_darurat' => 'nullable|string|max:255',
                'data_kontak.alamat_kontak_darurat' => 'nullable|string|max:255',
                'data_kontak.no_hp_kontak_darurat' => 'nullable|string|max:255',
            ]);

            $flattenedData = [];
            foreach ($validatedData as $section => $data) {
                foreach ($data as $key => $value) {
                    $flattenedData[$key] = $value;
                }
            }
            $flattenedData['updated_by'] = auth()->user()->id;

            $validatedData = $flattenedData;

            $logData = [
                'action' => 'Update Data',
                'nasabah_id' => $user->id,
                'status_changed_at' => now(),
                'payload_before' => json_encode($user->toArray()),
                'payload_after' => json_encode($validatedData),
                'created_by' => auth()->user()->id,
            ];

            // model belum dibuat & perlu migrate karena penambahan action di log ulang
            NasabahLog::create($logData);

            $user->update($validatedData);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User has been updated successfully.',
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to update user: ' . $e->getMessage(),
            ], 500);
        }
    }

    // untuk pdf pengajuan kredit, sementara di handle di controller biasa karena butuh view untuk generate pdf, kalau di api resource kan return json, jadi buat controller biasa saja untuk handle preview pdf nya, nanti kalau sudah jadi baru dipindah ke api resource controller nya
    public function showPreview(int $id)
    {
        $nasabah = Nasabah::findOrFail($id);

        return view('preview', ['data' => $nasabah]);
    }

    private function getBrowsershotExecutablePath(): ?string
    {
        $customPath = env('BROWSERSHOT_CHROME_PATH');
        if ($customPath && file_exists($customPath)) {
            return $customPath;
        }

        $paths = [
            'C:\Program Files\Google\Chrome\Application\chrome.exe',
            'C:\Program Files (x86)\Google\Chrome\Application\chrome.exe',
            '/usr/bin/google-chrome',
            '/usr/bin/chromium-browser',
            '/usr/bin/chromium',
            '/usr/bin/chrome',
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        return null;
    }

    public function downloadPreviewPdf(int $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $html = view('preview', ['data' => $nasabah])->render();

        $browserShot = Browsershot::html($html)
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->showBackground();

        if ($chromePath = $this->getBrowsershotExecutablePath()) {
            $browserShot->setChromePath($chromePath);
        }

        $pdfRawBytes = $browserShot->pdf();

        $fileName = 'Pengajuan_nasabah_' . preg_replace('/[^a-zA-Z0-9-_]/', '_', $nasabah->nama_lengkap ?? 'nasabah') . '.pdf';

        return response($pdfRawBytes, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function showAsuransi(int $id)
    {
        $nasabah = Nasabah::findOrFail($id);

        return view('asuransi', ['data' => $nasabah]);
    }

    public function upload(Request $request)
    {
        try {

            DB::beginTransaction();

            $nasabah = Nasabah::findOrFail($request->input('id'));

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = date('dmY_Hi') . '_' . str_replace(' ', '', $nasabah->nama_lengkap) . '_' . $request->input('jenis_dokumen') . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads', $filename, 'public');

                $column = 'dokumen_' . $request->input('jenis_dokumen');
                $nasabah->$column = $filePath;

                $logData = [
                    'action' => 'Upload Document',
                    'nasabah_id' => $nasabah->id,
                    'payload_before' => json_encode($nasabah->getOriginal($column)),
                    'payload_after' => json_encode([$column => $filePath]),
                    'created_by' => auth()->user()->id,
                ];

                // NasabahLog::create($logData);

                $nasabah->save();

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'File uploaded successfully.',
                    'data' => $nasabah,
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'No file uploaded.',
                ], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to upload file: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function sendPengajuan(Int $id)
    {
        try {

            // 1. Fetch your data
            $nasabah = Nasabah::findOrFail($id);

            // 2. Compile your Blade template into raw HTML string
            $html = view('preview', ['data' => $nasabah])->render();

            // 3. Use Browsershot to render modern CSS (Tailwind, Flexbox, Grid, etc.)
            $browserShot = Browsershot::html($html)
                ->format('A4')
                ->margins(10, 10, 10, 10) // top, right, bottom, left in mm
                ->showBackground();        // Critical if you use Tailwind background colors!

            if ($chromePath = $this->getBrowsershotExecutablePath()) {
                $browserShot->setChromePath($chromePath);
            }

            $pdfRawBytes = $browserShot->pdf();                  // Returns the raw binary string
            // 4. Send using your existing Mailable fromData structure
            Mail::to('rizalkh.arnanda@gmail.com')->send(new PengajuanMail($pdfRawBytes));

            return response()->json([
                'status' => true,
                'message' => 'mail has been sent.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send invoice: ' . $e->getMessage(),
            ], 500);
        }
    }
}
