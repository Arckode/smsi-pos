<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Dokumen Pengajuan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS rules to guarantee clean page breaks and print optimization for your PDF */
        @page {
            size: A4;
            margin: 0;
        }
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 p-8">

    <div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden p-8">
        <div class="flex justify-between items-center border-b border-gray-100 pb-6 mb-6">
            <div>
                <span class="px-3 py-1 text-xs font-semibold tracking-wider text-indigo-700 bg-indigo-50 rounded-full uppercase">
                    Dokumen Pengajuan Resmi
                </span>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Data Registrasi Nasabah</h1>
                <p class="text-xs text-gray-500 mt-1">ID Pengajuan Virtual: #{{ $data->id ?? '0000' }}</p>
            </div>
            <div class="text-right">
                <div class="text-xl font-black text-indigo-600 tracking-tight">Edoc<span class="text-gray-400 font-normal">Tracking</span></div>
                <p class="text-xs text-gray-400 mt-1">Tanggal: {{ date('d M Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-100 mb-6">
            <div>
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider">Nama Nasabah</label>
                <p class="text-base font-semibold text-gray-800 mt-1">{{ $data->nama ?? 'Nama Tidak Ditemukan' }}</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider">Email Terdaftar</label>
                <p class="text-base font-semibold text-gray-800 mt-1">{{ $data->email ?? 'email@domain.com' }}</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider">Status Verifikasi</label>
                <div class="mt-1 flex items-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Verified & Approved
                    </span>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider">Instansi / Affiliasi</label>
                <p class="text-base font-semibold text-gray-800 mt-1">{{ $data->affiliasi ?? 'Umum / Mandiri' }}</p>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6 text-center">
            <p class="text-xs text-gray-400 leading-relaxed">
                Dokumen ini sah dikeluarkan secara digital oleh platform tracking dan tidak memerlukan tanda tangan basah fisik. Seluruh riwayat mutasi data ini terekam aman dalam pelacakan audit log sistem.
            </p>
        </div>
    </div>

</body>
</html>