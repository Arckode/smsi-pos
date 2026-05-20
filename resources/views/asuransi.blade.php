<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permintaan Asuransi (SPA) - Page 1</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            background-color: #525659;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .pdf-page {
            width: 210mm;
            background-color: #ffffff;
            padding: 12mm 15mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            color: #000;
            font-size: 10px;
            line-height: 1.3;
        }
        
        /* Header Section */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 5px;
        }
        .brand-logo {
            font-size: 32px;
            font-weight: bold;
            color: #002c38;
            line-height: 1;
        }
        .brand-tagline {
            font-size: 9px;
            color: #00A99D;
            font-style: italic;
        }
        .company-name {
            font-weight: bold;
            font-size: 11px;
            text-align: right;
        }
        
        /* Document Title */
        .title-container {
            text-align: center;
            margin: 10px 0;
            position: relative;
        }
        .title-main {
            font-weight: bold;
            font-size: 11.5px;
            line-height: 1.4;
        }
        .page-badge {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 11px;
            font-weight: bold;
        }

        /* 6-Column Grid Layout Engine */
        .grid-6 {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 4px 8px;
            align-items: center;
            width: 100%;
            margin-bottom: 4px;
        }
        .span-1 { grid-column: span 1; }
        .span-2 { grid-column: span 2; }
        .span-3 { grid-column: span 3; }
        .span-4 { grid-column: span 4; }
        .span-5 { grid-column: span 5; }
        .span-6 { grid-column: span 6; }

        /* Section Headings */
        .section-banner {
            background-color: #00A99D;
            color: #ffffff;
            font-weight: bold;
            padding: 4px 8px;
            font-size: 11px;
            margin-top: 10px;
            margin-bottom: 6px;
            grid-column: span 6;
            display: flex;
            justify-content: space-between;
        }
        .section-banner-right {
            display: flex;
            gap: 25px;
            padding-right: 15px;
        }

        /* Input Elements & Form Controls */
        .field-container {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .field-label {
            white-space: nowrap;
            padding-right: 4px;
        }
        .field-input {
            border: 1px solid #000;
            height: 18px;
            flex-grow: 1;
            padding: 0 4px;
            font-size: 10px;
            outline: none;
        }
        .checkbox-item {
            display: inline-flex;
            align-items: center;
            margin-right: 12px;
            white-space: nowrap;
        }
        .square-box {
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin-right: 4px;
            display: inline-block;
            background: #fff;
        }
        .circle-box {
            width: 13px;
            height: 13px;
            border: 1px solid #000;
            border-radius: 50%;
            display: inline-block;
        }

        /* Medical Layout Grid */
        .medical-list-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3px 10px;
            margin-top: 5px;
            padding-left: 15px;
        }
        .medical-item {
            display: flex;
            align-items: flex-start;
            font-size: 9.5px;
        }
        .medical-item .square-box {
            margin-top: 2px;
            flex-shrink: 0;
        }

        /* Question Blocks */
        .question-row {
            display: flex;
            border-bottom: 1px solid #ccc;
            padding: 6px 0;
            align-items: flex-start;
        }
        .question-text {
            width: 85%;
            padding-right: 15px;
        }
        .question-actions {
            width: 15%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding-top: 2px;
        }

        /* Explicit Data Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }
        .data-table th, .data-table td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 9.5px;
            text-align: center;
        }
        .data-table th {
            font-weight: normal;
            background-color: #fff;
        }
        .data-table td {
            height: 22px;
        }

        /* Footer System */
        .footer-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 9px;
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 4px;
        }
    </style>
</head>
<body>

<div class="pdf-page">
    <div class="header-container">
        <div>
            <div class="brand-logo">Sequís</div>
            <div class="brand-tagline">Your Better Tomorrow</div>
        </div>
        <div class="company-name">PT Asuransi Jiwa Sequis Life</div>
    </div>
    
    <div class="title-container">
        <div class="title-main">
            SURAT PERMINTAAN ASURANSI (SPA) UNTUK CALON TERTANGGUNG ASURANSI JIWA KREDIT<br>
            PT BANK KB INDONESIA Tbk
        </div>
        <div class="page-badge">3 Lembar</div>
    </div>

    <div class="grid-6">
        <div class="section-banner">I. DATA PRIBADI</div>
        
        <div class="span-1 class-label">1. Nama Lengkap</div>
        <div class="span-5 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>

        <div class="span-1">2. No. E-KTP</div>
        <div class="span-3 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>
        <div class="span-2" style="text-align: right; padding-right: 10px;">
            <span class="field-label">3. Jenis Kelamin : L</span>
            <span class="square-box" style="vertical-align: middle;"></span>
            <span class="field-label" style="margin-left: 10px;">P</span>
            <span class="square-box" style="vertical-align: middle;"></span>
        </div>

        <div class="span-1">4. Tempat / Tgl. Lahir</div>
        <div class="span-3 field-container">
            <span class="field-label">:</span>
            <div class="field-input" style="margin-right: 5px;"></div>
            <span class="field-label">Tgl:</span>
            <div class="field-input" style="max-width: 35px; margin-right: 5px;"></div>
            <span class="field-label">Bln:</span>
            <div class="field-input" style="max-width: 35px; margin-right: 5px;"></div>
            <span class="field-label">Thn:</span>
            <div class="field-input" style="max-width: 45px;"></div>
        </div>
        <div class="span-2 field-container" style="padding-left: 15px;">
            <span class="field-label">5. Umur :</span>
            <div class="field-input" style="max-width: 45px; margin-right: 5px;"></div>
            <span class="field-label">tahun</span>
        </div>

        <div class="span-1">6. Status Perkawinan</div>
        <div class="span-5 field-container">
            <span class="field-label">:</span>
            <div class="checkbox-item"><span class="square-box"></span> Belum Menikah</div>
            <div class="checkbox-item"><span class="square-box"></span> Menikah</div>
            <div class="checkbox-item"><span class="square-box"></span> Janda/Duda</div>
        </div>

        <div class="span-1">7. Kewarganegaraan</div>
        <div class="span-2 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>
        <div class="span-1" style="padding-left: 15px;">8. Pekerjaan</div>
        <div class="span-2 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>

        <div class="span-1">9. Alamat Rumah saat ini</div>
        <div class="span-5 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>

        <div class="span-1"></div>
        <div class="span-5 field-container" style="justify-content: flex-start; gap: 0 15px;">
            <div class="field-container" style="max-width: 140px;"><span class="field-label">Kode Pos :</span><div class="field-input"></div></div>
            <div class="field-container" style="max-width: 240px;"><span class="field-label">No.HP & WA :</span><div class="field-input"></div></div>
            <div class="field-container" style="max-width: 200px;"><span class="field-label">No.Telp :</span><div class="field-input"></div></div>
        </div>

        <div class="span-1">10. Nama & Alamat Kantor</div>
        <div class="span-5 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>

        <div class="span-1"></div>
        <div class="span-5 field-container" style="justify-content: flex-end;">
            <div class="field-container" style="max-width: 200px;"><span class="field-label">No.Telp :</span><div class="field-input"></div></div>
        </div>

        <div class="span-1" style="margin-top:-14px;"></div>
        <div class="span-5 field-container" style="justify-content: flex-start; gap: 0 15px; margin-top:-14px;">
            <div class="field-container" style="max-width: 140px;"><span class="field-label">Kode Pos :</span><div class="field-input"></div></div>
            <div class="field-container" style="max-width: 320px;"><span class="field-label">Email :</span><div class="field-input"></div></div>
        </div>

        <div class="span-1">11. Jenis Usaha / Instansi</div>
        <div class="span-2 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>
        <div class="span-1" style="padding-left: 15px;">Jabatan & Tugas</div>
        <div class="span-2 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>

        <div class="span-1">12. No. NPWP</div>
        <div class="span-2 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>
        <div class="span-1" style="padding-left: 15px; white-space: nowrap;">Nama Gadis Ibu Kandung</div>
        <div class="span-2 field-container">
            <span class="field-label">:</span>
            <div class="field-input"></div>
        </div>

        <div class="span-1">13. Sumber Dana</div>
        <div class="span-5 field-container">
            <span class="field-label">:</span>
            <div class="checkbox-item"><span class="square-box"></span> Pekerjaan</div>
            <div class="checkbox-item" style="flex-grow: 1;"><span class="square-box"></span> Lainnya : <div class="field-input" style="margin-left:5px; height:16px;"></div></div>
        </div>

        <div class="span-2">14. Penghasilan rata-rata per tahun:</div>
        <div class="span-4 field-container" style="flex-wrap: wrap; gap: 2px 0;">
            <div class="checkbox-item" style="width: 22%;"><span class="square-box"></span> &lt; Rp60 Juta</div>
            <div class="checkbox-item" style="width: 38%;"><span class="square-box"></span> Rp60 Juta - Rp180 Juta</div>
            <div class="checkbox-item" style="width: 40%;"><span class="square-box"></span> &gt; Rp180 Juta - Rp360 Juta</div>
            <div class="checkbox-item" style="width: 38%;"><span class="square-box"></span> &gt; Rp360 Juta - Rp600 Juta</div>
            <div class="checkbox-item" style="width: 40%;"><span class="square-box"></span> &gt; Rp600 Juta</div>
        </div>

        <div class="span-6" style="font-weight: bold; font-size: 9.5px; margin-top: 4px;">15. Wajib diisi apabila Pemegang Polis memiliki kewajiban perpajakan terhadap negara lain:</div>
        
        <div class="span-3" style="padding-left: 12px;">a. Nomor Pokok Wajib Pajak/ <i>Tax Identification Number (TIN)</i></div>
        <div class="span-3 field-container"><span class="field-label">:</span><div class="field-input"></div></div>
        
        <div class="span-3" style="padding-left: 12px;">b. Negara/Yurisdiksi Domisili Wajib Pajak</div>
        <div class="span-3 field-container"><span class="field-label">:</span><div class="field-input"></div></div>

        <div class="span-3" style="padding-left: 12px;">c. Alamat Domisili di Negara Asal</div>
        <div class="span-3 field-container"><span class="field-label">:</span><div class="field-input"></div></div>
    </div>

    <div class="grid-6" style="margin-top: 5px;">
        <div class="section-banner">II. DATA ASURANSI</div>

        <div class="span-1">1. Jenis Pinjaman</div>
        <div class="span-5 field-container">
            <span class="field-label">:</span>
            <div class="checkbox-item"><span class="square-box"></span> KPR</div>
            <div class="checkbox-item"><span class="square-box"></span> KMG</div>
            <div class="checkbox-item"><span class="square-box"></span> KPM</div>
            <div class="checkbox-item"><span class="square-box"></span> MIKRO</div>
            <div class="checkbox-item" style="flex-grow:1;"><span class="square-box"></span> Lain-lain; sebutkan: <div class="field-input" style="margin-left: 5px; height:16px;"></div></div>
        </div>

        <div class="span-1">2. Jenis Asuransi</div>
        <div class="span-5 field-container">
            <span class="field-label">:</span>
            <div class="checkbox-item"><span class="square-box"></span> Life Only</div>
            <div class="checkbox-item"><span class="square-box"></span> Life & TPD</div>
            <div class="checkbox-item" style="flex-grow:1;"><span class="square-box"></span> Lain-lain; sebutkan: <div class="field-input" style="margin-left: 5px; height:16px;"></div></div>
        </div>

        <div class="span-1">3. Uang Pertanggungan</div>
        <div class="span-2 field-container">
            <span class="field-label">: Rp.</span>
            <div class="field-input"></div>
        </div>
        <div class="span-2" style="padding-left: 20px;">5. Masa Pertanggungan :</div>
        <div class="span-1 field-container">
            <div class="field-input" style="max-width: 50px; margin-right: 5px;"></div>
            <span class="field-label">tahun</span>
        </div>

        <div class="span-1">4. Suku Bunga Pinjaman</div>
        <div class="span-2 field-container">
            <span class="field-label">:</span>
            <div class="field-input" style="max-width: 60px; margin-right: 5px;"></div>
            <span class="field-label">%</span>
            <div style="flex-grow: 1;"></div>
        </div>
        <div class="span-2" style="padding-left: 20px;">6. Mulai Asuransi :</div>
        <div class="span-1 field-container">
            <div class="field-input" style="margin-right: 4px;"></div>
            <span class="field-label" style="color: #555; font-size: 8.5px;">(Tgl, Bln, Thn)</span>
        </div>
    </div>

    <div style="margin-top: 5px;">
        <div class="section-banner">
            <span>III. KETERANGAN KESEHATAN (WAJIB DIISI OLEH CALON TERTANGGUNG)</span>
            <div class="section-banner-right">
                <span>Ya</span>
                <span>Tidak</span>
            </div>
        </div>

        <div class="question-row">
            <div class="question-text">
                <div class="field-container">
                    <span class="field-label">1. Tinggi Badan :</span>
                    <div class="field-input" style="max-width: 50px; margin-right: 5px;"></div>
                    <span class="field-label" style="margin-right: 20px;">cm</span>
                    <span class="field-label">Berat Badan :</span>
                    <div class="field-input" style="max-width: 50px; margin-right: 5px;"></div>
                    <span class="field-label">kg</span>
                </div>
            </div>
            <div class="question-actions">
                <span class="circle-box"></span>
                <span class="circle-box"></span>
            </div>
        </div>

        <div class="question-row">
            <div class="question-text" style="line-height: 1.3;">
                2. Apakah anda sedang/pernah menggunakan narkotika/atau obat-obatan sejenis, akan/sedang/pernah dalam konsultasi dan/atau perawatan, di Rumah sakit, Klinik atau Dokter untuk penyakit termasuk tetapi tidak terbatas pada:
                
                <div class="medical-list-container">
                    <div class="medical-item"><span class="square-box"></span> Panca Indera</div>
                    <div class="medical-item"><span class="square-box"></span> Hormonal (Thyroid, Diabetes)</div>
                    <div class="medical-item"><span class="square-box"></span> Kanker, Tumor, Kista, Pembesaran Kelenjar</div>
                    
                    <div class="medical-item"><span class="square-box"></span> Otak, Saraf, Stroke, Epilepsi, Kelumpuhan, Gangguan Jiwa</div>
                    <div class="medical-item"><span class="square-box"></span>專 Metabolisme (Kolesterol, Asam Urat)</div>
                    <div class="medical-item"><span class="square-box"></span> AIDS atau HIV</div>
                    
                    <div class="medical-item"><span class="square-box"></span> Saluran Pernapasan, Paru, TBC, Asma</div>
                    <div class="medical-item"><span class="square-box"></span> Ginjal, Saluran Kemih, Kelamin</div>
                    <div class="medical-item"><span class="square-box"></span> Kelainan Bawaan dan/atau Penyakit Keturunan</div>
                    
                    <div class="medical-item"><span class="square-box"></span> Jantung, Pembuluh Darah, Darah Tinggi</div>
                    <div class="medical-item"><span class="square-box"></span> Kelainan Tulang, Otot, Sendi</div>
                    <div class="medical-item"><span class="square-box"></span> Hernia, Wasir, Fistula, Hydrocele, Varicocele</div>
                    
                    <div class="medical-item"><span class="square-box"></span> Saluran Pencernaan, Hati, Empedu, Pankreas, Limpa</div>
                    <div class="medical-item"><span class="square-box"></span> Anemia, Penyakit Darah Lainnya</div>
                    <div class="medical-item"><span class="square-box"></span> Penyakit lainnya yang tidak disebutkan di atas</div>
                </div>
            </div>
            <div class="question-actions" style="align-self: center;">
                <span class="circle-box"></span>
                <span class="circle-box"></span>
            </div>
        </div>

        <div class="question-row">
            <div class="question-text">
                3. Apakah Anda akan/sedang/pernah dalam konsultasi, pengobatan dan/atau menjalani perawatan di rumah sakit, klinik atau Dokter untuk berbagai penyakit, tes diagnosa termasuk tetapi tidak terbatas pada pemeriksaan rontgen, darah, urine, CT Scan, biopsi, EKG, mamografi, ultrasonografi atau pap smear, pengobatan dan/atau operasi yang tidak dinyatakan dalam pertanyaan sebelumnya?
            </div>
            <div class="question-actions" style="align-self: center;">
                <span class="circle-box"></span>
                <span class="circle-box"></span>
            </div>
        </div>

        <div style="padding: 6px 0;">
            <div style="font-size: 9.5px; font-weight: bold; margin-bottom: 2px;">
                Penjelasan jawaban "Ya", untuk pertanyaan 2 dan 3. Sebutkan: a) Kapan, b) Jenis penyakit, narkotika atau obat-obatan c) Lama perawatan d) Nama, Alamat, No Telp Dokter/Rumah Sakit e) Hasil pengobatan
            </div>
            <div style="border: 1px solid #000; height: 35px; width: 100%;"></div>
        </div>

        <div class="question-row" style="border-bottom: none;">
            <div class="question-text">
                4. Jika calon tertanggung seorang wanita, apakah sedang dalam keadaan hamil ?<br>
                <span style="font-size: 9px; font-style: italic; color: #444;">Jika "Ya", wajib melampirkan Form Hasil Pemeriksaan Kehamilan/Kandungan yang dilengkapi oleh Dokter Kandungan.</span>
            </div>
            <div class="question-actions">
                <span class="circle-box"></span>
                <span class="circle-box"></span>
            </div>
        </div>
    </div>

    <div style="margin-top: 5px;">
        <div class="section-banner">
            <span>IV. DATA-DATA LAIN (WAJIB DIISI OLEH CALON TERTANGGUNG)</span>
            <div class="section-banner-right">
                <span>Ya</span>
                <span>Tidak</span>
            </div>
        </div>

        <div class="question-row">
            <div class="question-text">1. Pernahkah permintaan pertanggungan Asuransi Jiwa anda ditolak/ditangguhkan/diterima dengan tambahan premi?</div>
            <div class="question-actions"><span class="circle-box"></span><span class="circle-box"></span></div>
        </div>
        <div class="question-row" style="border-bottom: none;">
            <div class="question-text">2. Pernahkah anda mengajukan klaim asuransi kecelakaan, kesehatan, penyakit kritis atau kecacatan ?</div>
            <div class="question-actions"><span class="circle-box"></span><span class="circle-box"></span></div>
        </div>

        <div style="padding-top: 4px;">
            <div style="font-size: 9.5px; font-weight: bold; margin-bottom: 4px;">Penjelasan jawaban "Ya", untuk pertanyaan 1 dan 2, sebutkan:</div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Nama Perusahaan / Kapan Ditolak / ditangguhkan / Tambahan Premi / Pengecualian</th>
                        <th style="width: 180px;">Jenis Klaim</th>
                        <th style="width: 180px;">Penyebab</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer-container">
        <div>LIFE HEALTH INVESTMENT.</div>
        <div style="font-weight: normal; color: #444;">Form/FSC/03/17/Rev.01</div>
        <div>Halaman 1 dari 3</div>
    </div>
</div>

</body>
</html>