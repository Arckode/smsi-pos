@php
    // Helper function untuk mencetak kotak-kotak karakter form dengan border presisi (tanpa border ganda)
    if (!function_exists('renderSpajBoxes')) {
        function renderSpajBoxes($value, $totalBoxes) {
            $cleanValue = strtoupper(strval($value));
            $htmlOutput = '<div class="flex">';
            
            for ($i = 0; $i < $totalBoxes; $i++) {
                $char = isset($cleanValue[$i]) ? $cleanValue[$i] : '';
                // Menghindari border ganda di antara kotak
                $borderClass = ($i === $totalBoxes - 1) ? 'border border-black' : 'border border-black border-r-0';
                
                $htmlOutput .= '<div class="w-[11.5px] h-[14px] flex items-center justify-center text-[9px] font-mono font-bold text-black ' . $borderClass . ' bg-white shrink-0">';
                $htmlOutput .= htmlspecialchars($char);
                $htmlOutput .= '</div>';
            }
            $htmlOutput .= '</div>';
            return $htmlOutput;
        }
    }

    // Helper untuk memecah tanggal
    $getDateTimePart = function($dateString, $format) {
        if (empty($dateString)) return '';
        try { return date($format, strtotime($dateString)); } catch (\Exception $e) { return ''; }
    };
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPAJ AJK Bank Bukopin 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pengaturan Cetak Standar A4 */
        @media print {
            body { background-color: #fff; margin: 0; padding: 0; display: flex; justify-content: center; }
            .no-print { display: none; }
            .page-container { border: none !important; box-shadow: none !important; margin: 0; width: 210mm; height: 297mm; page-break-after: always; }
        }
        body { font-family: 'Arial', sans-serif; background-color: #e2e8f0; display: flex; flex-direction: column; align-items: center; padding: 20px; }
        
        /* Kotak Checkbox Kustom bergaya Cetak Form */
        .print-checkbox {
            appearance: none;
            width: 10px;
            height: 10px;
            border: 1px solid black;
            background-color: white;
            display: inline-block;
            position: relative;
            cursor: pointer;
            margin-right: 4px;
        }
        .print-checkbox:checked::after {
            content: '✔';
            font-size: 10px;
            font-weight: bold;
            position: absolute;
            top: -3px;
            left: 0.5px;
            color: black;
        }
    </style>
</head>
<body>

    <div class="page-container w-[210mm] h-[297mm] bg-white p-[8mm] text-[8px] text-black shadow-2xl relative overflow-hidden box-border flex flex-col leading-tight">
        
        <div class="flex justify-between items-start border-b-[3px] border-red-600 pb-1 mb-1 shrink-0">
            <div class="flex items-start gap-1">
                <div class="leading-none mt-1">
                    <span class="text-[9px] font-normal tracking-widest lowercase text-black block">asuransi</span>
                    <h1 class="text-xl font-black tracking-tighter text-red-600 uppercase leading-none m-0">simas jiwa</h1>
                    <p class="text-[7.5px] font-bold mt-1">PT Asuransi Simas Jiwa</p>
                    <p class="text-[6.5px] leading-tight max-w-[280px]">
                        Jl. Lombok No. 73, Jakarta Pusat, 10350<br>
                        Call Center: (021) 2854 7999 Fax: (021) 2139 3319 E-mail: CS@Simasjiwa.co.id
                    </p>
                </div>
            </div>
            <div class="text-right flex flex-col items-end pt-1">
                <h2 class="text-[12px] font-bold uppercase tracking-tight text-black">Surat Pengajuan Asuransi Jiwa Kredit</h2>
                <div class="mt-1 flex items-center gap-1">
                    <span class="font-bold text-[8px]">DCIF:</span>
                    {!! renderSpajBoxes($data->dcif ?? '', 10) !!}
                </div>
            </div>
        </div>

        <div class="border-[1px] border-black">

            <div class="bg-red-600 text-white font-bold px-1 py-[2px] text-center text-[9px] uppercase mb-1 border border-black shrink-0">
                I. DATA PESERTA
            </div>
    
            <div class="flex flex-col gap-[3px] mb-1 shrink-0">
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 leading-none">
                        <span class="font-bold block">1. Nama Lengkap</span>
                        <span class="text-[7px] block italic">(sesuai KTP)</span>
                    </div>
                    <div class="flex-1">{!! renderSpajBoxes($data->nama_lengkap ?? '', 38) !!}</div>
                </div>
    
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 font-bold">2. Jenis Kelamin</div>
                    <div class="flex-1 flex items-center gap-6">
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox" {{ ($data->jenis_kelamin ?? '') == 'Pria' ? 'checked' : '' }}> Pria</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox" {{ ($data->jenis_kelamin ?? '') == 'Wanita' ? 'checked' : '' }}> Wanita</label>
                    </div>
                </div>
    
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 font-bold">3. Tempat Tanggal Lahir</div>
                    <div class="flex-1 flex items-center gap-2">
                        {!! renderSpajBoxes($data->tempat_lahir ?? '', 14) !!}
                        <div class="flex items-center gap-1">
                            <span>Tanggal</span> {!! renderSpajBoxes($getDateTimePart($data->tanggal_lahir ?? '', 'd'), 2) !!}
                            <span>Bulan</span> {!! renderSpajBoxes($getDateTimePart($data->tanggal_lahir ?? '', 'm'), 2) !!}
                            <span>Tahun</span> {!! renderSpajBoxes($getDateTimePart($data->tanggal_lahir ?? '', 'Y'), 4) !!}
                        </div>
                    </div>
                </div>
    
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 leading-none">
                        <span class="font-bold block">4. Bukti Identitas</span>
                        <span class="text-[7px] block">Nomor Bukti Identitas</span>
                    </div>
                    <div class="flex-1 flex items-center gap-2">
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox" {{ ($data->bukti_identitas ?? '') == 'KTP' ? 'checked' : '' }}> E-KTP</label>
                        <label class="flex items-center mr-1"><input type="checkbox" class="print-checkbox" {{ ($data->bukti_identitas ?? '') == 'Passport' ? 'checked' : '' }}> Passport/WNA</label>
                        {!! renderSpajBoxes($data->nomor_identitas ?? '', 16) !!}
                    </div>
                </div>
    
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 font-bold">5. No. NPWP <span class="font-normal">(wajib diisi)</span></div>
                    <div class="flex-1">{!! renderSpajBoxes($data->npwp ?? '', 15) !!}</div>
                </div>
    
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 font-bold">6. Status</div>
                    <div class="flex-1 flex justify-between pr-4">
                        <div class="flex items-center gap-4">
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox" {{ ($data->status ?? '') == 'Menikah' ? 'checked' : '' }}> Menikah</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox" {{ ($data->status ?? '') == 'Belum Menikah' ? 'checked' : '' }}> Belum Menikah</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox" {{ ($data->status ?? '') == 'Janda/Duda' ? 'checked' : '' }}> Janda/Duda</label>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-bold">7. Warga Negara</span>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox" {{ ($data->warga_negara ?? '') == 'Indonesia' ? 'checked' : '' }}> Indonesia</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox" {{ ($data->warga_negara ?? '') == 'Asing' ? 'checked' : '' }}> Asing</label>
                        </div>
                    </div>
                </div>
    
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 font-bold">8. Agama</div>
                    <div class="flex-1 flex justify-between pr-2">
                        {!! renderSpajBoxes($data->agama ?? '', 12) !!}
                        <div class="flex items-center gap-2">
                            <span class="font-bold">9. Pendidikan</span>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> SD</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> SMP</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> SMU</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> D1-D3</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> S1</label>
                            <label class="flex items-center">Lainnya: <span class="inline-block w-12 border-b border-black"></span></label>
                        </div>
                    </div>
                </div>
    
                <div class="flex items-start mt-0.5">
                    <div class="w-[130px] shrink-0 font-bold">10. Alamat Rumah</div>
                    <div class="flex-1 flex flex-col gap-[3px]">
                        {!! renderSpajBoxes($data->alamat_rumah ?? '', 38) !!}
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">Kode Pos: {!! renderSpajBoxes($data->kode_pos ?? '', 5) !!}</div>
                            <div class="flex items-center gap-1">Telepon: {!! renderSpajBoxes($data->telepon_rumah ?? '', 12) !!}</div>
                        </div>
                    </div>
                </div>
    
                <div class="flex items-start mt-0.5">
                    <div class="w-[130px] shrink-0 font-bold">11. Alamat Korespondensi</div>
                    <div class="flex-1 flex flex-col gap-[3px]">
                        {!! renderSpajBoxes($data->alamat_korespondensi ?? '', 38) !!}
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">Kode Pos: {!! renderSpajBoxes($data->kode_pos_korespondensi ?? '', 5) !!}</div>
                            <div class="flex items-center gap-1">Telepon: {!! renderSpajBoxes($data->telepon_korespondensi ?? '', 12) !!}</div>
                        </div>
                    </div>
                </div>
    
                <div class="flex items-start mt-0.5">
                    <div class="w-[130px] shrink-0 font-bold">12. Pekerjaan</div>
                    <div class="flex-1 flex flex-col gap-[3px]">
                        <div class="grid grid-cols-2 gap-x-2 gap-y-1">
                            <div class="flex justify-between items-center">Bagian {!! renderSpajBoxes($data->pekerjaan_bagian ?? '', 14) !!}</div>
                            <div class="flex justify-between items-center">Aktifitas yang dilakukan {!! renderSpajBoxes($data->pekerjaan_aktifitas ?? '', 12) !!}</div>
                            <div class="flex justify-between items-center">Nama Perusahaan {!! renderSpajBoxes($data->nama_perusahaan ?? '', 14) !!}</div>
                            <div class="flex justify-between items-center">Jenis Usaha {!! renderSpajBoxes($data->jenis_usaha ?? '', 12) !!}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="w-[60px]">Alamat Kantor</span> {!! renderSpajBoxes($data->alamat_kantor ?? '', 31) !!}
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">Kode Pos: {!! renderSpajBoxes($data->kode_pos_kantor ?? '', 5) !!}</div>
                            <div class="flex items-center gap-1">Telepon: {!! renderSpajBoxes($data->telepon_kantor ?? '', 12) !!}</div>
                        </div>
                    </div>
                </div>
    
                <div class="flex items-center mt-0.5">
                    <div class="w-[130px] shrink-0 font-bold">13. No. Handphone</div>
                    <div class="flex-1 flex justify-between items-center">
                        {!! renderSpajBoxes($data->no_hp ?? '', 14) !!}
                        <div class="flex items-center gap-2">
                            <span class="font-bold">14. Alamat E-mail</span>
                            {!! renderSpajBoxes($data->email ?? '', 20) !!}
                        </div>
                    </div>
                </div>
    
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 font-bold">15. Sumber Penghasilan</div>
                    <div class="flex-1 flex gap-3">
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Gaji</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Hasil Usaha</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Hasil Investasi</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Warisan</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Lainnya: <span class="inline-block w-10 border-b border-black"></span></label>
                    </div>
                </div>
    
                <div class="flex items-start">
                    <div class="w-[130px] shrink-0 font-bold mt-0.5">16. Penghasilan Per Tahun</div>
                    <div class="flex-1 flex flex-col">
                        <div class="flex gap-4 mb-[2px]">
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> &lt; Rp 25 Juta</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> &gt; Rp 25 Juta - Rp 100 Juta</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> &gt; Rp 100 Juta - Rp 250 Juta</label>
                        </div>
                        <div class="flex gap-4">
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> &gt; Rp 250 Juta - Rp 500 Juta</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Rp 500 Juta - Rp 1 Milyar</label>
                            <label class="flex items-center"><input type="checkbox" class="print-checkbox"> &gt; Rp 1 Milyar</label>
                        </div>
                    </div>
                </div>
    
                <div class="flex items-center">
                    <div class="w-[130px] shrink-0 font-bold">17. Sumber Dana Pembelian Asuransi</div>
                    <div class="flex-1 flex gap-3">
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Gaji</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Hasil Usaha</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Hasil Investasi</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Warisan</label>
                        <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Lainnya: <span class="inline-block w-10 border-b border-black"></span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-red-600 text-white font-bold px-1 py-[2px] text-center text-[9px] uppercase mb-1 border border-black shrink-0">
            II. DATA ASURANSI
        </div>

        <div class="flex flex-col gap-[3px] mb-1 shrink-0">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <span class="w-[110px] font-bold">1. Uang Pertanggungan</span>
                    <span>: Menurun, Rp <span class="font-bold">{{ number_format($data->up ?? 0, 0, ',', '.') }}</span></span>
                </div>
                <div class="flex items-center">
                    <span class="w-[110px] font-bold">4. Besar Premi</span>
                    <span>: Rp <span class="font-bold">{{ number_format($data->premi ?? 0, 0, ',', '.') }}</span></span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <span class="w-[110px] font-bold">2. Masa Asuransi</span>
                    <div class="flex items-center gap-1">
                        : {!! renderSpajBoxes($data->masa_asuransi_tahun ?? '', 2) !!} Tahun dan
                        {!! renderSpajBoxes($data->masa_asuransi_bulan ?? '', 2) !!} Bulan
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="w-[110px] font-bold">5. Cara Pembayaran</span>
                    <span>: Sekaligus</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <span class="w-[110px] font-bold">3. Periode Asuransi</span>
                    <div class="flex items-center gap-1">
                        : Tanggal {!! renderSpajBoxes($data->start_tgl ?? '', 2) !!} 
                        Bulan {!! renderSpajBoxes($data->start_bln ?? '', 2) !!} 
                        Tahun {!! renderSpajBoxes($data->start_thn ?? '', 4) !!}
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="w-[110px] text-center font-bold">s/d</span>
                    <div class="flex items-center gap-1">
                        Tanggal {!! renderSpajBoxes($data->end_tgl ?? '', 2) !!} 
                        Bulan {!! renderSpajBoxes($data->end_bln ?? '', 2) !!} 
                        Tahun {!! renderSpajBoxes($data->end_thn ?? '', 4) !!}
                    </div>
                </div>
            </div>

            <div class="flex items-center">
                <div class="w-[110px] font-bold">6. Jenis Kredit</div>
                <div class="flex gap-4">
                    <label class="flex items-center"><input type="checkbox" class="print-checkbox"> KPR Karyawan</label>
                    <label class="flex items-center"><input type="checkbox" class="print-checkbox"> KPR Nasabah</label>
                    <label class="flex items-center"><input type="checkbox" class="print-checkbox"> KPM Karyawan</label>
                    <label class="flex items-center"><input type="checkbox" class="print-checkbox"> KPM Nasabah</label>
                    <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Lainnya: <span class="inline-block w-12 border-b border-black"></span></label>
                </div>
            </div>

            <div class="flex items-center">
                <div class="w-[110px] font-bold">7. Uang Pertanggungan</div>
                <div class="flex gap-4">
                    <label class="flex items-center"><input type="checkbox" class="print-checkbox"> Tetap</label>
                    <label class="flex items-center"><input type="checkbox" class="print-checkbox" checked> Menurun</label>
                </div>
            </div>

            <div class="flex items-start">
                <div class="w-[150px] font-bold">8. Yang Berhak Menerima Manfaat Asuransi:</div>
                <div class="flex-1 flex flex-col gap-1">
                    <div class="flex items-center gap-2">
                        <span class="w-[60px]">a. Kreditur</span>
                        <span class="border-b border-black flex-1 h-3 font-bold">{{ $data->kreditur_nama ?? 'PT BANK KB BUKOPIN Tbk' }}</span>
                        <span>Cabang</span>
                        <span class="border-b border-black w-24 h-3">{{ $data->kreditur_cabang ?? '' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-[60px]">b. Yang Ditunjuk</span>
                        <span class="border-b border-black flex-1 h-3"></span>
                        <span>Hubungan dengan Peserta:</span>
                        <span class="border-b border-black w-24 h-3"></span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col mt-0.5">
                <div class="text-justify leading-tight font-bold">9. Apakah Anda sudah mempunyai atau sedang mengajukan atau pernah mengajukan Polis Asuransi Jiwa/Kecelakaan/Kesehatan baik di PT Asuransi Simas Jiwa maupun di Perusahaan Asuransi lain? <span class="font-normal">(Jika "Ya" di Perusahaan Asuransi mana, apakah dikenakan Ekstra Premi/Ditolak/Ditunda, dan alasannya) atau pernahkan Anda mengajukan klaim terhadap polis Anda?</span></div>
                <div class="flex gap-6 mt-0.5">
                    <label class="flex items-center"><input type="checkbox" class="print-checkbox" checked> Tidak</label>
                    <label class="flex items-center gap-1"><input type="checkbox" class="print-checkbox"> Ya, jelaskan: <span class="inline-block w-[300px] border-b border-black h-3"></span></label>
                </div>
            </div>
        </div>

        <div class="bg-red-600 text-white font-bold px-1 py-[2px] text-center text-[9px] uppercase mb-1 border border-black shrink-0">
            III. DATA KESEHATAN
        </div>

        <table class="w-full border-collapse border border-black text-[7.5px] leading-tight mb-1 shrink-0">
            <thead>
                <tr class="font-bold text-center">
                    <th class="border border-black p-0.5 w-[15px]">No</th>
                    <th class="border border-black p-0.5 text-left">Pertanyaan Medis / Kesehatan</th>
                    <th class="border border-black p-0.5 w-[30px]">Ya</th>
                    <th class="border border-black p-0.5 w-[30px]">Tidak</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-black p-0.5 text-center font-bold">1</td>
                    <td class="border border-black p-0.5">Apakah Anda dalam keadaan sehat? Jika "Tidak", jelaskan: <span class="border-b border-black inline-block w-40"></span></td>
                    <td class="border border-black p-0.5 text-center"><input type="checkbox" class="print-checkbox" {{ ($data->sehat ?? '') == 'Ya' ? 'checked' : '' }}></td>
                    <td class="border border-black p-0.5 text-center"><input type="checkbox" class="print-checkbox" {{ ($data->sehat ?? '') == 'Tidak' ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td class="border border-black p-0.5 text-center font-bold align-top">2</td>
                    <td class="border border-black p-0.5">
                        a. Berat Badan: <span class="font-bold border-b border-black px-1">{{ $data->bb ?? '   ' }}</span> Kg &nbsp; Tinggi Badan: <span class="font-bold border-b border-black px-1">{{ $data->tb ?? '   ' }}</span> cm <br>
                        b. Apakah berat badan Anda berubah dalam 12 bulan terakhir? Jika "Ya", jelaskan berapa kilogram penurunan/kenaikan dan penyebabnya: <span class="border-b border-black inline-block w-32"></span>
                    </td>
                    <td class="border border-black p-0.5 text-center align-bottom"><input type="checkbox" class="print-checkbox"></td>
                    <td class="border border-black p-0.5 text-center align-bottom"><input type="checkbox" class="print-checkbox" checked></td>
                </tr>
                <tr>
                    <td class="border border-black p-0.5 text-center font-bold align-top">3</td>
                    <td class="border border-black p-0.5 text-justify">
                        Apakah Anda pernah menderita salah satu dari penyakit, gejala penyakit / kelainan atau melakukan investigasi atau pemeriksaan medis, konsultasi, perawatan medis, atau menjalani pembedahan atau rawat inap di Rumah Sakit yang berhubungan dengan penyakit jantung atau pembuluh darah, hipertensi, TBC, asma bronchial atau penyakit paru lainnya, nyeri lambung, infeksi pankreas, kelainan kandung empedu, hepatitis, wasir (hemoroid), penyakit ginjal, penyakit saluran kemih, kandung kemih, atau prostat, usus, penyakit menular seksual, penyakit thyroid, stroke, mini stroke (TIA), kelumpuhan, epilepsi, kelainan sistem saraf atau otak, kelainan mental, depresi, penurunan penglihatan, penurunan pendengaran, rheumatik, kelainan sendi, nyeri tulang belakang, penyakit herediter atau kongenital, atau kelumpuhan, diabetes, peningkatan kolesterol, asam urat, leukimia, atau kelainan darah lainnya, pertumbuhan abnormal, kista, tumor, kanker, penyakit pembuluh darah limfe, penyakit autoimmune, HIV/AIDS? Jika "YA", jelaskan nama penyakit, kapan, obat yang diberikan, nama dan alamat dokter (serta lampirkan fotokopi hasil pemeriksaan).
                    </td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox"></td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox" checked></td>
                </tr>
                <tr>
                    <td class="border border-black p-0.5 text-center font-bold align-top">4</td>
                    <td class="border border-black p-0.5 text-justify">
                        Apakah Anda sedang atau pernah menjalani konsultasi/rawat inap/operasi/biopsi/pemeriksaan laboratorium/rontgen/EKG/Treadmill Echocardiography/USG/CT Scan/MRI/Papsmear/Mamografi atau pemeriksaan lainnya? Jika "YA", jelaskan pemeriksaan atau pengobatan apa, kapan dan dimana dilakukan, alasan dilakukan, pemeriksaan atau pengobatan tersebut (serta lampirkan fotokopi hasil pemeriksaan).
                    </td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox"></td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox" checked></td>
                </tr>
                <tr>
                    <td class="border border-black p-0.5 text-center font-bold align-top">5</td>
                    <td class="border border-black p-0.5 text-justify">
                        Apakah Anda memiliki aktifitas atau hobi yang berbahaya seperti surfing, berlayar, menyelam, hiking, mendaki gunung, balapan, reli, motor cross, parasut, para layang dan kegiatan atau hobi yang berbahaya atau ekstrem lainnya? Apabila ada, sebutkan dan jelaskan seberapa sering kegiatan tersebut?
                    </td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox"></td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox" checked></td>
                </tr>
                <tr>
                    <td class="border border-black p-0.5 text-center font-bold align-top">6</td>
                    <td class="border border-black p-0.5 text-justify">
                        Apakah Anda pernah atau memiliki kebiasaan mengkonsumsi:<br>
                        a. Merokok: <span class="border-b border-black w-8 inline-block"></span> batang/hari selama <span class="border-b border-black w-8 inline-block"></span> tahun. &nbsp; ( Ya <input type="checkbox" class="print-checkbox ml-1"> / Tidak <input type="checkbox" class="print-checkbox ml-1" checked> )<br>
                        b. Alcohol: <span class="border-b border-black w-8 inline-block"></span> gelas/minggu selama <span class="border-b border-black w-8 inline-block"></span> tahun.<br>
                        c. Narkotika atau zat adiktif lainnya: jenis narkoba <span class="border-b border-black w-16 inline-block"></span> selama <span class="border-b border-black w-6 inline-block"></span> tahun, dan terakhir memakai adalah <span class="border-b border-black w-16 inline-block"></span>
                    </td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox"></td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox" checked></td>
                </tr>
                <tr>
                    <td class="border border-black p-0.5 text-center font-bold align-top">7</td>
                    <td class="border border-black p-0.5 text-justify">
                        Khusus untuk Wanita: Apakah Anda memiliki abnormalitas pada payudara, menstruasi, uterus, atau riwayat persalinan seperti keguguran? Apakah Anda saat ini sedang hamil? Apabila "Iya" sudah berapa minggu usia kehamilan Anda?
                    </td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox"></td>
                    <td class="border border-black p-0.5 text-center align-top"><input type="checkbox" class="print-checkbox" checked></td>
                </tr>
            </tbody>
        </table>

        <div class="bg-red-600 text-white font-bold px-1 py-[2px] text-[9px] uppercase mb-0.5 border border-black shrink-0">
            IV. PERNYATAAN DAN PERSETUJUAN
        </div>
        
        <div class="text-[7.2px] text-justify leading-tight flex-1">
            1. Saya/Kami memahami bahwa Saya/Kami memiliki kewajiban untuk bertindak dengan itikad terbaik (utmost good faith) dalam setiap pengajuan/permohonan asuransi. Oleh karena itu, Saya/Kami memahami bahwa Saya/Kami wajib mengungkapkan secara benar dan lengkap semua fakta material, yaitu data, informasi, jawaban, keterangan, keadaan, pernyataan dan fakta ("Informasi Konsumen") yang dapat mempengaruhi pertimbangan PT Asuransi Simas Jiwa dalam menerima atau menolak pengajuan tersebut dan/atau menetapkan jumlah premi.<br>
            2. Saya/Kami menyatakan dan menjamin bahwa semua Informasi Konsumen yang Saya/Kami berikan dalam SPAJ ini, serta setiap formulir dan dokumen lainnya yang disyaratkan oleh PT Asuransi Simas Jiwa ("Dokumen Permohonan") sebagai bagian dari pengajuan/permohonan asuransi adalah lengkap, benar, akurat, terkini, sesuai dengan kenyataan sebenarnya dan konsisten antara satu dengan lainnya, dan tidak ada Informasi Konsumen Saya/Kami sembunyikan, dengan menandatangani SPAJ ini, Saya SEPAKAT dan MENYETUJUI jika PT Asuransi Simas jiwa melakukan hal-hal berikut:
            a. Menolak setiap klaim Manfaat Asuransi yang diajukan dan tidak membayarkan seluruh atau sebagian Manfaat Asuransi;
            b. Membatalkan Polis dengan pengembalian Premi yang telah dibayarkan setelah dikurangi dengan biaya internal pemeriksaan kesehatan, Manfaat asuransi yang telah dibayarkan dan biaya-biaya yang timbul pada saat penerbitan Polis (jika ada);
            c. Mengakhiri Polis tanpa kewajiban untuk mengembalikan premi dan/atau Biaya Asuransi, apabila terdapat unsur penipuan, pemalsuan, atau kesalahan yang disengaja dalam pemberian setiap Informasi Konsumen.
        </div>

        <div class="absolute bottom-1 right-2 text-[6.5px] text-black">
            <span>SPAJ/AJK/KB BUKOPIN/06/2025/Ver-1</span>
        </div>

    </div>

    <div class="no-print mt-4">
        <button onclick="window.print()" class="bg-red-600 text-white font-bold px-6 py-2 rounded shadow text-sm">Cetak A4 SPAJ</button>
    </div>

</body>
</html>