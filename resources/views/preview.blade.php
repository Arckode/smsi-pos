<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Aplikasi Kredit CBP</title>
    <style>
        /* Print & Page Setup */
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 8px;
            margin: 0;
            padding: 0;
            background-color: #525659; /* PDF viewer background */
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 12mm 15mm;
            margin: 10mm 0;
            background: white;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            position: relative;
        }
        .page-break {
            page-break-after: always;
        }

        /* Header Styles */
        .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .logo-area { width: 100%; }
        .logo-main { font-size: 24px; color: #EAB308; display: inline-block; font-weight: bold; line-height: 1; margin-bottom: 3px; }
        .logo-star { font-size: 24px; color: #EAB308; vertical-align: bottom; }
        .logo-sub { font-size: 8px; font-weight: bold; display: block; color: #666; }
        .address-text { font-size: 6.5px; color: #666; line-height: 1.2; margin-top: 2px; }

        /* Typography & Structure */
        .form-title { text-align: center; font-size: 10px; font-weight: bold; margin: 15px 0 8px 0; border-top: 1px solid #000; padding-top: 8px; }
        .section-title { background-color: #FFC000; font-weight: bold; font-size: 8.5px; padding: 3px 5px; border: 1px solid #000; margin-bottom: -1px;}
        
        /* Tables */
        table { width: 100%; border-collapse: collapse; table-layout: fixed; margin-bottom: 10px; }
        td { border: 1px solid #000; padding: 3px 5px; vertical-align: top; }
        .bg-yellow { background-color: #FFC000; font-weight: bold; font-size: 8.5px; }
        
        /* Column Widths */
        .label { width: 18%; font-weight: bold; }
        .value { width: 32%; }
        
        /* Checkboxes & Form Elements */
        .cb-container { display: flex; flex-wrap: wrap; gap: 2px; }
        .cb-item { display: flex; align-items: center; width: 45%; margin-bottom: 2px; }
        .cb-item.full { width: 100%; }
        .box { width: 7px; height: 7px; border: 1px solid #000; margin-right: 4px; display: inline-block; flex-shrink: 0; }
        
        /* Specific Page 2 Styles */
        .text-red-italic { color: #d00; font-style: italic; font-size: 8.5px; text-align: justify; line-height: 1.4; margin-top: 15px; }
        .mandatory-text { font-weight: bold; font-size: 8px; }
        .sub-text { font-weight: bold; font-size: 7px; }

        .footer-note { font-size: 7px; color: #000; margin-top: -5px; margin-bottom: 10px; }

        @media print {
            body { background-color: white; }
            .page { margin: 0; box-shadow: none; border: none; padding: 10mm; }
        }
    </style>
</head>
<body>

    {{-- <pre>@php print_r($data) @endphp</pre> --}}
    <div class="page">
        <div class="header">
            <div class="logo-area">
                <span class="logo-star">✳</span> <span class="logo-main">KB Bank</span>
                <span class="logo-sub">PT Bank KB Indonesia Tbk</span>
                <div class="address-text">
                    KB Bank Head Office, Jl. MT. Haryono Kav. 50-51 Jakarta Selatan - Indonesia 12770<br>
                    P. (+62)21 7988266, 7989837<br>
                    www.kbbank.co.id
                </div>
            </div>
        </div>

        <div class="form-title" style="border: none; font-size: 14px; margin-bottom: 15px">FORMULIR APLIKASI KREDIT CORPORATE BENEFIT PROGRAM<br>PT. BANK KB INDONESIA, TBK.</div>
        <table style="margin-bottom: 0;">
            <tr>
                <td colspan="2" class="bg-yellow">A. DATA PEMOHON</td>
                <td colspan="2" class="bg-yellow">B. DATA PEKERJAAN</td>
            </tr>
            
            <tr>
                <td class="label">Nama Lengkap</td><td class="value">{{$data['nama_lengkap'] ? $data['nama_lengkap'] : ''}}</td>
                <td class="label">Nama Perusahaan / Instansi</td><td class="value"></td>
            </tr>
            
            <tr>
                <td class="label">NIK / No. KTP</td><td class="value">{{$data['nik']? $data['nik'] : ''}}</td>
                <td class="label">No. Pegawai / ID Karyawan</td><td class="value">{{$data['nip']? $data['nip'] : ''}}</td>
            </tr>
            
            <tr>
                <td class="label">NPWP Pemohon</td><td class="value">{{$data['npwp']? $data['npwp'] : ''}}</td>
                <td class="label">No. BPJS Tenaga Kerja</td><td class="value">{{$data['no_bpjs']}}</td>
            </tr>
            
            <tr>
                <td class="label">Tempat & Tgl Lahir</td><td class="value">{{$data['tempat_lahir'] && $data['tanggal_lahir'] ? $data['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($data['tanggal_lahir'])) : ''}}</td>
                <td class="label">Jabatan / Posisi</td><td class="value">{{$data['jabatan']? $data['jabatan'] : ''}}</td>
            </tr>
            
            <tr>
                <td class="label">Agama</td>
                <td class="value">
                    <div class="cb-container">
                        <div class="cb-item"><input type="checkbox" class="box">Islam</div>
                        <div class="cb-item"><input type="checkbox" class="box">Kristen</div>
                        <div class="cb-item"><input type="checkbox" class="box">Katolik</div>
                        <div class="cb-item"><input type="checkbox" class="box">Hindu</div>
                        <div class="cb-item"><input type="checkbox" class="box">Budha</div>
                        <div class="cb-item"><input type="checkbox" class="box">Konghuchu</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Aliran Kepercayaan</div>
                    </div>
                </td>
                <td class="label">Status Kepegawaian</td>
                <td class="value">
                    <div class="cb-container">
                        <div class="cb-item full"><input type="checkbox" class="box">Tetap</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Kontrak</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Outsourcing</div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="margin: 0; padding: 0; height: 100%">
                    <table style="margin: 0; padding: 0; height: 100%">
                        <tr style="height: 40px">
                            <td class="label" style="border: none ; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 50%;">
                                Alamat KTP
                            </td>
                            <td class="value" style="border: none ; border-bottom: 1px solid #000; width: 50%;">{{$data['alamat_ktp']? $data['alamat_ktp'] : ''}}</td>
                        </tr>
                        <tr style="height: 40px">
                            <td class="label" style="border: none; border-right: 1px solid #000">
                                Alamat Domisili
                            </td>
                            <td class="value" style="border: none">{{$data['alamat_domisili']? $data['alamat_domisili'] : ''}}</td>
                        </tr>
                    </table>
                </td>
                <td class="label">Pendidikan Terakhir</td>
                <td class="value">
                    <div class="cb-container">
                        <div class="cb-item"><input type="checkbox" class="box">&lt;SMA</div>
                        <div class="cb-item"><input type="checkbox" class="box">SMA</div>
                        <div class="cb-item"><input type="checkbox" class="box">D3</div>
                        <div class="cb-item"><input type="checkbox" class="box">S1</div>
                        <div class="cb-item"><input type="checkbox" class="box">S2</div>
                        <div class="cb-item"><input type="checkbox" class="box">S3</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="value"><input type="checkbox" class="box">Laki-laki &nbsp;&nbsp;&nbsp; <input type="checkbox" class="box">Perempuan</td>
                <td class="label">Bagian/Departemen/Divisi</td><td class="value">{{$data['departemen']? $data['departemen'] : ''}}</td>
            </tr>
            <tr>
                <td class="label">No. Telepon / HP</td><td class="value"></td>
                <td class="label">Lama Bekerja</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Status Perkawinan</td>
                <td class="value">
                    <div class="cb-container">
                        <div class="cb-item full"><input type="checkbox" class="box">Belum Kawin</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Kawin</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Duda/Janda</div>
                    </div>
                </td>
                <td class="label">Penghasilan Bulanan<br>(Take Home Pay)</td><td class="value"><strong>Rp</strong></td>
            </tr>
            <tr>
                <td colspan="4" class="bg-yellow">C. DATA PASANGAN PEMOHON</td>
            </tr>
            <tr>
                <td class="label">Nama Pasangan</td><td class="value"></td>
                <td class="label">Alamat Domisili</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Status Pasangan</td>
                <td class="value"><input type="checkbox" class="box">Suami &nbsp;&nbsp;&nbsp; <input type="checkbox" class="box">Istri</td>
                <td class="label">No. Telepon</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Nomor KTP Pasangan</td><td class="value"></td>
                <td class="label">Jumlah Anak</td><td class="value"></td>
            </tr>
        </table>

        <table style="margin-top: 10px">
            <tr>
                <td colspan="2" class="bg-yellow">D. DATA PENGAJUAN KREDIT</td>
                <td colspan="2" class="bg-yellow">E. DATA REKENING KBI PEMOHON</td>
            </tr>
            <tr>
                <td class="label">Fasilitas Kredit</td>
                <td class="value"><input type="checkbox" class="box">KKB &nbsp;&nbsp;&nbsp; <input type="checkbox" class="box">KSG</td>
                <td class="label">Bank Penerbit</td><td class="value">PT. BANK KB INDONESIA, TBK.</td>
            </tr>
            <tr>
                <td class="label">Tujuan Penggunaan<br>Kredit</td>
                <td class="value">
                    <div class="cb-container">
                        <div class="cb-item full"><input type="checkbox" class="box">Kebutuhan Rumah Tangga</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Pendidikan</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Pembelian Kendaraan/Barang</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Konsumtif Lainnya</div>
                    </div>
                </td>
                <td class="label">Jenis Rekening</td>
                <td class="value">
                    <div class="cb-container">
                        <div class="cb-item full"><input type="checkbox" class="box">Tabungan Umum</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Tabungan Kerjasama</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Digital KB Star</div>
                        <div class="cb-item full"><input type="checkbox" class="box">Lainnya: ________________</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">Plafond Kredit</td><td class="value"><strong>Rp</strong></td>
                <td class="label">Nomor Rekening</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Jangka Waktu Kredit</td><td class="value">________________ bulan</td>
                <td class="label">Atas Nama</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Suka Bunga Kredit</td>
                <td class="value"><input type="checkbox" class="box">Fixed Rate &nbsp;&nbsp;&nbsp; <input type="checkbox" class="box">Floating Rate</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td class="label">Sistem Pembayaran</td>
                <td class="value"><input type="checkbox" class="box">Potong Gaji &nbsp;&nbsp;&nbsp; <input type="checkbox" class="box">Payroll</td>
                <td colspan="2"></td>
            </tr>
        </table>

        <table style="margin-top: 10px">
            <tr>
                <td colspan="4" class="bg-yellow">F. JAMINAN KREDIT (KHUSUS KREDIT KENDARAAN BERMOTOR)</td>
            </tr>
            <tr>
                <td class="label">Jenis Kendaraan</td>
                <td class="value"><input type="checkbox" class="box">Roda 4 &nbsp;&nbsp;&nbsp; <input type="checkbox" class="box">Roda 2**</td>
                <td class="label">Tahun Pembuatan</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Kondisi Kendaraan</td>
                <td class="value"><input type="checkbox" class="box">New &nbsp;&nbsp;&nbsp; <input type="checkbox" class="box">Used</td>
                <td class="label">Nomor BPKB*</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Tujuan Kredit</td>
                <td class="value"><input type="checkbox" class="box">Pembelian &nbsp;&nbsp;&nbsp; <input type="checkbox" class="box">Refinancing</td>
                <td class="label">Nomor Mesin*</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Brand Kendaraan</td><td class="value"></td>
                <td class="label">Nomor Rangka*</td><td class="value"></td>
            </tr>
            <tr>
                <td class="label">Tipe Kendaraan</td><td class="value"></td>
                <td class="label">Atas Nama Kendaraan*</td><td class="value"></td>
            </tr>
        </table>
        <div class="footer-note" style="display: flex; justify-content: end; color: red; font-weight: bold; font-size: 8px; text-align: right">*Khusus Used Vehicle<br>**Hanya kendaraan baru saja</div>
    </div>

    <div class="page page-break">
        <div class="header">
            <div class="logo-area">
                <span class="logo-star">✳</span> <span class="logo-main">KB Bank</span>
                <span class="logo-sub">PT Bank KB Indonesia Tbk</span>
                <div class="address-text">
                    KB Bank Head Office, Jl. MT. Haryono Kav. 50-51 Jakarta Selatan - Indonesia 12770<br>
                    P. (+62)21 7988266, 7989837<br>
                    www.kbbank.co.id
                </div>
            </div>
        </div>

        <div class="section-title" style="margin-top: 15px;">F. KONTAK DARURAT</div>
        <table>
            <tr>
                <td class="label" style="width: 25%;">Nama</td><td class="value" style="width: 25%;"></td>
                <td class="label" style="width: 25%;">Alamat</td><td class="value" style="width: 25%;"></td>
            </tr>
            <tr>
                <td class="label">Hubungan Dengan Pemohon</td><td class="value"></td>
                <td class="label">Nomor Telepon</td><td class="value"></td>
            </tr>
        </table>

        <div class="section-title">G. DOKUMEN PENDUKUNG</div>
        <table>
            <tr>
                <td style="width: 25%;"><input type="checkbox" class="box">KTP Pemohon</td>
                <td style="width: 25%;" class="mandatory-text">Mandatori</td>
                <td style="width: 25%;"><input type="checkbox" class="box">Formulir Asuransi</td>
                <td style="width: 25%;" class="mandatory-text">Mandatori</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="box">NPWP Pemohon</td>
                <td class="mandatory-text">Mandatori</td>
                <td><input type="checkbox" class="box">Foto ID Card Karyawan</td>
                <td class="mandatory-text">Mandatori</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="box">Kartu Keluarga</td>
                <td class="mandatory-text">Mandatori</td>
                <td><input type="checkbox" class="box">Foto Selfie Karyawan</td>
                <td class="mandatory-text">Mandatori</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="box">KTP Pasangan</td>
                <td class="sub-text">Apabila sudah menikah / bila sudah bercerai lampirkan Surat Cerai</td>
                <td><input type="checkbox" class="box">Surat Pernyataan & Kuasa Potong Gaji</td>
                <td class="mandatory-text">Mandatori</td>
            </tr>
        </table>

        <div class="text-red-italic" style="margin-top: 20px">
            Saya yang bertanda tangan di bawah ini, dengan ini memberikan persetujuan kepada PT Bank KB Indonesia, Tbk untuk mengumpulkan, menyimpan, mengolah, menggunakan, serta membagikan data pribadi saya kepada pihak-pihak yang bekerja sama dengan Bank, sepanjang diperlukan untuk proses analisis, persetujuan, dan pengelolaan fasilitas kredit yang saya ajukan. Saya memahami bahwa data pribadi yang saya serahkan meliputi namun tidak terbatas pada data identitas, data keuangan, data pekerjaan, dan informasi lain yang relevan dengan proses pemberian kredit. Saya juga memahami bahwa Bank akan melindungi kerahasiaan data pribadi saya sesuai dengan peraturan perundang-undangan yang berlaku, termasuk Undang-Undang Nomor 27 Tahun 2022 tentang Perlindungan Data Pribadi, serta hanya akan menggunakan data tersebut untuk tujuan yang sah dan sesuai dengan kepentingan pemberian fasilitas kredit.
        </div>

        <table style="width: 200px; margin-top: 20px;">
            <tr>
                <td style="text-align: center; height: 25px; vertical-align: bottom; color: #ccc">
                    (Kota, Tgl-Bln-Thn)
                </td>
            </tr>
            <tr>
                <td style="text-align: center; height: 85px; border-bottom: none">
                    Pemohon
                </td>
            </tr>
            <tr>
                <td style="text-align: center; height: 15px; vertical-align: bottom; padding: 5px">
                    Nama Lengkap
                </td>
            </tr>
        </table>

    </div>

</body>
</html>