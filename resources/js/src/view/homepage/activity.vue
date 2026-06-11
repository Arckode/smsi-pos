<template>
    <main class="main">
        <section id="faq" class="faq section" style="height: 100vh; overflow-y: auto;">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="content px-xl-5">
                            <!-- <h3><span>Frequently Asked </span><strong>Questions</strong></h3> -->
                            <h5 class="text-muted mb-0"><span>Formulir Aplikasi Kredit</span></h5>
                            <h3 class="mb-0"><strong>CORPORATE BENEFIT PROGRAM</strong></h3>
                            <h4 class="text-warning"><strong>PT. BANK KB INDONESIA, TBK.</strong></h4>
                            <!-- <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                            </p> -->
                        </div>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="200">
                        <div class="faq-container">

                            <div class="faq-item private-data">
                                <div class="btn-toggle mt-3">
                                    <h3><span class="num">A. </span> <span>Data Pemohon</span></h3>
                                    <i class="faq-toggle bi bi-chevron-right mt-3"></i>
                                    <!-- <i class="faq-toggle bi bi-x-lg mt-3"></i> -->
                                </div>
                                <div class="faq-content p-3 pb-0">
                                    <section id="services" class="services section p-0">
                                        <div class="service-item d-flex"></div>
                                    </section>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nama Lengkap</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pemohon.name" name="name"
                                                class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>NIK / No. KTP</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pemohon.nik" name="nik"
                                                class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Tempat Lahir</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pemohon.tempat_lahir"
                                                name="tempat_lahir" class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Tanggal Lahir</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="date" v-model="model.data_pemohon.tanggal_lahir"
                                                name="tanggal_lahir" class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Agama</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pemohon.agama" class="form-select" name="agama"
                                                required>
                                                <option value="" selected>Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Konghuchu">Konghuchu</option>
                                                <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto mt-0">
                                            <label>Alamat KTP</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea v-model="model.data_pemohon.alamat_ktp" type="text"
                                                name="alamat_ktp" class="form-control" placeholder=""
                                                required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto mt-0">
                                            <label>Alamat Domisili</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea v-model="model.data_pemohon.alamat_domisili" type="text"
                                                name="alamat_domisili" class="form-control" placeholder=""
                                                required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pemohon.kelamin" class="form-select"
                                                name="kelamin" required>
                                                <option value="" selected>Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>No. HP</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">+62</span>
                                                <input type="text" v-model="model.data_pemohon.phone"
                                                    class="form-control" name="phone" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Status</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pemohon.status" class="form-select"
                                                name="status" required>
                                                <option value="">Pilih Status Perkawinan</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                                <option value="Kawin">Kawin</option>
                                                <option value="Duda/Janda">Duda/Janda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="faq-item job-data">
                                <div class="btn-toggle mt-3">
                                    <h3><span class="num">B. </span> <span>Data Pekerjaan</span></h3>
                                    <i class="faq-toggle bi bi-chevron-right mt-3"></i>
                                </div>
                                <div class="faq-content p-3 pb-0">
                                    <section id="services" class="services section p-0">
                                        <div class="service-item d-flex"></div>
                                    </section>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nama Perusahaan / Instansi</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pekerjaan.name_pt" name="name_pt"
                                                class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>No. Pegawai / ID Karyawan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pekerjaan.nip" name="nip"
                                                class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>No. BPJS Tenaga Kerja</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pekerjaan.bpjs" name="bpjs"
                                                class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Jabatan / Posisi</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pekerjaan.position" name="position"
                                                class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Status Kepegawaian</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pekerjaan.status_kepegawaian"
                                                class="form-select" name="status_kepegawaian" required>
                                                <option value="" selected>Pilih Status Kepegawaian</option>
                                                <option value="Tetap">Tetap</option>
                                                <option value="Kontrak">Kontrak</option>
                                                <option value="Outsourcing">Outsourcing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Status Kepegawaian</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pekerjaan.pendidikan_terakhir"
                                                class="form-select" name="pendidikan_terakhir" required>
                                                <option value="" selected>Pilih Pendidikan Terakhir</option>
                                                <option value="SMA">SMA</option>
                                                <option value="D3">D3</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Bagian/Departemen/Divisi</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pekerjaan.departemen"
                                                name="departemen" class="form-control" placeholder=""
                                                required=""></input>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Lama Bekerja (tahun)</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" name="thn_kerja" class="form-control" placeholder=""
                                                required=""></input>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Penghasilan Bulanan (THP)</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" name="thn_kerja" class="form-control" placeholder=""
                                                required=""></input>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="faq-item couple-data">
                                <div class="btn-toggle mt-3">
                                    <h3><span class="num">C. </span> <span>Data Pasangan Pemohon</span></h3>
                                    <i class="faq-toggle bi bi-chevron-right mt-3"></i>
                                </div>
                                <div class="faq-content p-3 pb-0">
                                    <section id="services" class="services section p-0">
                                        <div class="service-item d-flex"></div>
                                    </section>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nama Pasangan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pasangan.couple_name"
                                                name="couple_name" class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Status Pasangan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pasangan.couple_status" class="form-select"
                                                name="couple_status" required>
                                                <option value="" selected>Pilih Status Pasangan</option>
                                                <option value="Suami">Suami</option>
                                                <option value="Istri">Istri</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nomor KTP Pasangan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_pasangan.couple_nik"
                                                name="couple_nik" class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto mt-0">
                                            <label>Alamat KTP</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea type="text" name="alamat_ktp" class="form-control" placeholder=""
                                                required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto mt-0">
                                            <label>Alamat Domisili</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea v-model="model.data_pasangan.couple_alamat_domisili" type="text"
                                                name="couple_alamat_domisili" class="form-control" placeholder=""
                                                required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>No. HP</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">+62</span>
                                                <input type="text" v-model="model.data_pasangan.couple_phone"
                                                    class="form-control" name="couple_phone"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Jumlah Anak</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" v-model="model.data_pasangan.anak" name="anak"
                                                class="form-control" placeholder="" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- start here -->
                            <div class="faq-item loan-data">
                                <div class="btn-toggle mt-3">
                                    <h3><span class="num">D. </span> <span>Data Pengajuan Kredit</span></h3>
                                    <i class="faq-toggle bi bi-chevron-right mt-3"></i>
                                </div>
                                <div class="faq-content p-3 pb-0">
                                    <section id="services" class="services section p-0">
                                        <div class="service-item d-flex"></div>
                                    </section>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Fasilitas Kredit</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pengajuan.fasilitas_kredit"
                                                name="fasilitas_kredit" class="form-select" required>
                                                <option value="" selected>Pilih Fasilitas Kredit</option>
                                                <option value="KKB">KKB</option>
                                                <option value="KSG">KSG</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Tujuan Penggunaan Kredit</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pengajuan.penggunaan_kredit"
                                                name="penggunaan_kredit" class="form-select" required>
                                                <option value="" selected>Pilih Tujuan Kredit</option>
                                                <option value="Kebutuhan Rumah Tangga">Kebutuhan Rumah Tangga</option>
                                                <option value="Pendidikan">Pendidikan</option>
                                                <option value="Pembelian Kendaraan/Barang">Pembelian Kendaraan/Barang
                                                </option>
                                                <option value="Konsumtif Lainnya">Konsumtif Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Plafond Kredit</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" v-model="model.data_pengajuan.plafond" name="plafond"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Jangka Waktu Kredit</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="number" v-model="model.data_pengajuan.tenor" name="tenor"
                                                    class="form-control" min="1" required>
                                                <span class="input-group-text">bulan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Suka Bunga Kredit</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pengajuan.rate" name="rate" class="form-select"
                                                required>
                                                <option value="" selected>Pilih Jenis Bunga</option>
                                                <option value="Fixed Rate">Fixed Rate</option>
                                                <option value="Floating Rate">Floating Rate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Sistem Pembayaran</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_pengajuan.sistem_pembayaran"
                                                name="sistem_pembayaran" class="form-select" required>
                                                <option value="" selected>Pilih Sistem Pembayaran</option>
                                                <option value="Potong Gaji">Potong Gaji</option>
                                                <option value="Payroll">Payroll</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="faq-item account-data">
                                <div class="btn-toggle mt-3">
                                    <h3><span class="num">E. </span> <span>Data Rekening KBI Pemohon</span></h3>
                                    <i class="faq-toggle bi bi-chevron-right mt-3"></i>
                                </div>
                                <div class="faq-content p-3 pb-0">
                                    <section id="services" class="services section p-0">
                                        <div class="service-item d-flex"></div>
                                    </section>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Bank Penerbit</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="bank_penerbit" class="form-control"
                                                value="PT. BANK KB INDONESIA, TBK." readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Jenis Rekening</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_rekening.jenis_rekening" name="jenis_rekening"
                                                class="form-select" required>
                                                <option value="" selected>Pilih Jenis Rekening</option>
                                                <option value="Tabungan Umum">Tabungan Umum</option>
                                                <option value="Tabungan Kerjasama">Tabungan Kerjasama</option>
                                                <option value="Digital KB Star">Digital KB Star</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nomor Rekening</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_rekening.norek" name="norek"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Atas Nama</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_rekening.an_rekening"
                                                name="an_rekening" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="faq-item vehicle-data">
                                <div class="btn-toggle mt-3">
                                    <h3><span class="num">F. </span> <span>Jaminan Kredit (Khusus Kredit Kendaraan
                                            Bermotor)</span></h3>
                                    <i class="faq-toggle bi bi-chevron-right mt-3"></i>
                                </div>
                                <div class="faq-content p-3 pb-0">
                                    <section id="services" class="services section p-0">
                                        <div class="service-item d-flex"></div>
                                    </section>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Jenis Kendaraan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_jaminan.jenis_kendaraan" name="jenis_kendaraan"
                                                class="form-select">
                                                <option value="" selected>Pilih Jenis Kendaraan</option>
                                                <option value="Roda 4">Roda 4</option>
                                                <option value="Roda 2">Roda 2 (**)</option>
                                            </select>
                                            <small class="text-warning">(**) Hanya kendaraan baru saja</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Kondisi Kendaraan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_jaminan.kondisi_kendaraan"
                                                name="kondisi_kendaraan" class="form-select">
                                                <option value="">Pilih Kondisi Kendaraan</option>
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Tujuan Kredit</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select v-model="model.data_jaminan.tujuan_kredit" name="tujuan_kredit"
                                                class="form-select">
                                                <option value="" selected>Pilih Tujuan Kredit</option>
                                                <option value="Pembelian">Pembelian</option>
                                                <option value="Refinancing">Refinancing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Brand Kendaraan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_jaminan.brand_kendaraan"
                                                name="brand_kendaraan" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Tipe Kendaraan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_jaminan.tipe_kendaraan"
                                                name="tipe_kendaraan" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Tahun Pembuatan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" v-model="model.data_jaminan.tahun_pembuatan"
                                                name="tahun_pembuatan" class="form-control" min="1900" max="2099">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nomor BPKB*</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_jaminan.nomor_bpkb" name="nomor_bpkb"
                                                class="form-control">
                                            <small class="text-muted">*Khusus Used Vehicle</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nomor Mesin*</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_jaminan.nomor_mesin"
                                                name="nomor_mesin" class="form-control">
                                            <small class="text-muted">*Khusus Used Vehicle</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nomor Rangka*</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_jaminan.nomor_rangka"
                                                name="nomor_rangka" class="form-control">
                                            <small class="text-muted">*Khusus Used Vehicle</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Atas Nama Kendaraan*</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_jaminan.an_kendaraan"
                                                name="an_kendaraan" class="form-control">
                                            <small class="text-muted">*Khusus Used Vehicle</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="faq-item urgent-contact">
                                <div class="btn-toggle mt-3">
                                    <h3><span class="num">G. </span> <span>Kontak Darurat</span></h3>
                                    <i class="faq-toggle bi bi-chevron-right mt-3"></i>
                                </div>
                                <div class="faq-content p-3 pb-0">
                                    <section id="services" class="services section p-0">
                                        <div class="service-item d-flex"></div>
                                    </section>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_kontak.nama_lengkap" name="nama_lengkap" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Hubungan dengan pemohon</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_kontak.hubungan" name="hubungan" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 m-auto">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" v-model="model.data_kontak.alamat" name="alamat" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center my-4">
                                <a type="submit" class="btn btn-primary" @click.prevent="confirmStore">Submit
                                    Application</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer position-relative light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Append</span>
                    </a>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita
                        valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p>United States</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="sitename">Append</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>
</template>

<script>
import $ from "jquery";
import Swal from 'sweetalert2';
window.BASEURL = ''
export default {
    name: "home",
    data() {
        return {
            menuItems: [
                { label: 'Beranda', route: 'home' },
                { label: 'Kegiatan', route: 'activity' },
                { label: 'Tentang Kami', route: 'about' },
                { label: 'Kontak', route: 'contact' },
            ],
            model: {
                // Section A: Data Pemohon
                data_pemohon: {
                    name: '',
                    nik: '',
                    tempat_lahir: '',
                    tanggal_lahir: '',
                    agama: '',
                    alamat_ktp: '',
                    alamat_domisili: '',
                    kelamin: '',
                    phone: '',
                    status: '',
                },
                // Section B: Data Pekerjaan
                data_pekerjaan: {
                    name_pt: '',
                    nip: '',
                    bpjs: '',
                    position: '',
                    status_kepegawaian: '',
                    pendidikan_terakhir: '',
                    departemen: '',
                    thn_kerja: '',
                },
                // Section C: Data Pasangan Pemohon
                data_pasangan: {
                    couple_name: '',
                    couple_status: '',
                    couple_nik: '',
                    couple_alamat_domisili: '',
                    couple_phone: '',
                    anak: '',
                },
                // Section D: Data Pengajuan Kredit
                data_pengajuan: {
                    fasilitas_kredit: '',
                    penggunaan_kredit: '',
                    plafond: '',
                    tenor: '',
                    rate: '',
                    sistem_pembayaran: '',
                },
                // Section E: Data Rekening KBI Pemohon
                data_rekening: {
                    bank_penerbit: 'PT. BANK KB INDONESIA, TBK.',
                    jenis_rekening: '',
                    norek: '',
                    an_rekening: '',
                },
                // Section F: Jaminan Kredit
                data_jaminan: {
                    jenis_kendaraan: '',
                    kondisi_kendaraan: '',
                    tujuan_kredit: '',
                    brand_kendaraan: '',
                    tipe_kendaraan: '',
                    tahun_pembuatan: '',
                    nomor_bpkb: '',
                    nomor_mesin: '',
                    nomor_rangka: '',
                    an_kendaraan: '',
                },
                // Section G: Kontak Darurat
                data_kontak: {
                    nama_lengkap: '',
                    hubungan: '',
                    alamat: '',
                    no_hp: '',
                },
                // Section H: Dokumen Pendukung
                data_dokumen: {
                    ktp: null,
                    kartu_keluarga: null,
                    npwp: null,
                    ktp_pasangan: null,
                    asuransi: null,
                    id_card_perusahaan: null,
                    selfie: null,
                    surat_pernyataan: null,
                },
            },
        }
    },
    mounted() {
        this._faqToggleHandler = (e) => {
            const faqItem = e.currentTarget.closest('.faq-item');
            if (faqItem) faqItem.classList.toggle('faq-active');
        };

        document.querySelectorAll('#faq .btn-toggle').forEach(toggle => {
            toggle.addEventListener('click', this._faqToggleHandler);
        });
    },
    destroyed() {
        // Clean up FAQ handlers to avoid leaks
        if (this._faqToggleHandler) {
            document.querySelectorAll('#faq .btn-toggle').forEach(toggle => {
                toggle.removeEventListener('click', this._faqToggleHandler);
            });
            this._faqToggleHandler = null;
        }
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        navigateToDashboard(route) {
            this.$router.push({ name: route }).then(() => {
                this.$router.go(0);
            });
        },
        confirmStore() {
            Swal.fire({
                title: 'Data Akan Diprosess',
                text: 'Pastikan Data Anda Sudah Sesuai ',
                icon: 'info',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Oke',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    this.store()
                }
            })
        },
        async store(){
            try {
                const payload = {
                    // Section A: Data Pemohon
                    nama_lengkap: this.model.data_pemohon.name,
                    nik: this.model.data_pemohon.nik,
                    tempat_lahir: this.model.data_pemohon.tempat_lahir,
                    tanggal_lahir: this.model.data_pemohon.tanggal_lahir,
                    agama: this.model.data_pemohon.agama,
                    alamat_ktp: this.model.data_pemohon.alamat_ktp,
                    alamat_domisili: this.model.data_pemohon.alamat_domisili,
                    jenis_kelamin: this.model.data_pemohon.kelamin,
                    no_hp: this.model.data_pemohon.phone,
                    status_perkawinan: this.model.data_pemohon.status,
                    
                    // Section B: Data Pekerjaan
                    nama_perusahaan: this.model.data_pekerjaan.name_pt,
                    nip: this.model.data_pekerjaan.nip,
                    no_bpjs: this.model.data_pekerjaan.bpjs,
                    jabatan: this.model.data_pekerjaan.position,
                    status_kepegawaian: this.model.data_pekerjaan.status_kepegawaian,
                    pendidikan_terakhir: this.model.data_pekerjaan.pendidikan_terakhir,
                    departemen: this.model.data_pekerjaan.departemen,
                    tahun_kerja: this.model.data_pekerjaan.thn_kerja,
                    
                    // Section C: Data Pasangan Pemohon
                    nama_pasangan: this.model.data_pasangan.couple_name,
                    status_pasangan: this.model.data_pasangan.couple_status,
                    nik_pasangan: this.model.data_pasangan.couple_nik,
                    alamat_pasangan: this.model.data_pasangan.couple_alamat_domisili,
                    no_hp_pasangan: this.model.data_pasangan.couple_phone,
                    jumlah_anak: this.model.data_pasangan.anak,
                    
                    // Section D: Data Pengajuan Kredit
                    fasilitas_kredit: this.model.data_pengajuan.fasilitas_kredit,
                    tujuan_penggunaan: this.model.data_pengajuan.penggunaan_kredit,
                    plafond_kredit: this.model.data_pengajuan.plafond,
                    tenor_bulan: this.model.data_pengajuan.tenor,
                    jenis_bunga: this.model.data_pengajuan.rate,
                    sistem_pembayaran: this.model.data_pengajuan.sistem_pembayaran,
                    
                    // Section E: Data Rekening KBI Pemohon
                    bank_penerbit: this.model.data_rekening.bank_penerbit,
                    jenis_rekening: this.model.data_rekening.jenis_rekening,
                    nomor_rekening: this.model.data_rekening.norek,
                    atas_nama_rekening: this.model.data_rekening.an_rekening,
                    
                    // Section F: Jaminan Kredit
                    jenis_kendaraan: this.model.data_jaminan.jenis_kendaraan,
                    kondisi_kendaraan: this.model.data_jaminan.kondisi_kendaraan,
                    tujuan_kredit_kendaraan: this.model.data_jaminan.tujuan_kredit,
                    brand_kendaraan: this.model.data_jaminan.brand_kendaraan,
                    tipe_kendaraan: this.model.data_jaminan.tipe_kendaraan,
                    tahun_pembuatan: this.model.data_jaminan.tahun_pembuatan,
                    nomor_bpkb: this.model.data_jaminan.nomor_bpkb,
                    nomor_mesin: this.model.data_jaminan.nomor_mesin,
                    nomor_rangka: this.model.data_jaminan.nomor_rangka,
                    atas_nama_kendaraan: this.model.data_jaminan.an_kendaraan,

                    // Section G: Kontak Darurat
                    nama_kontak_darurat: this.model.data_kontak.nama_lengkap,
                    hubungan_kontak_darurat: this.model.data_kontak.hubungan,
                    alamat_kontak_darurat: this.model.data_kontak.alamat,
                    no_hp_kontak_darurat: this.model.data_kontak.no_hp,
                    
                    // Section H: Dokumen Pendukung
                    // Note: File uploads would typically require FormData and special handling
                    // Here we just send null or placeholder values
                    dokumen_ktp: null,
                    dokumen_kartu_keluarga: null,
                    dokumen_npwp: null,
                    dokumen_ktp_pasangan: null,
                    dokumen_asuransi: null,
                    dokumen_id_card_perusahaan: null,
                    dokumen_selfie: null,
                    dokumen_surat_pernyataan: null,

                    status_pengajuan: 'Draft'
                };
                
                const response = await axios.post('/api/public/pengajuan-kredit', payload);
                
                if (response.data.success) {
                    this.resetForm();
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Pengajuan kredit berhasil disimpan',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    // Reset form after successful save
                    
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.data.message || 'Terjadi kesalahan saat menyimpan data',
                        icon: 'error'
                    });
                }
            } catch (error) {
                console.log('Store error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: error.response?.data?.message || 'Terjadi kesalahan saat menyimpan data',
                    icon: 'error'
                });
            }
        },
        resetForm() {
            this.model = {
                data_pemohon: {
                    name: '',
                    nik: '',
                    tempat_lahir: '',
                    tanggal_lahir: '',
                    agama: '',
                    alamat_ktp: '',
                    alamat_domisili: '',
                    kelamin: '',
                    phone: '',
                    status: '',
                },
                data_pekerjaan: {
                    name_pt: '',
                    nip: '',
                    bpjs: '',
                    position: '',
                    status_kepegawaian: '',
                    pendidikan_terakhir: '',
                    departemen: '',
                    thn_kerja: '',
                },
                data_pasangan: {
                    couple_name: '',
                    couple_status: '',
                    couple_nik: '',
                    couple_alamat_domisili: '',
                    couple_phone: '',
                    anak: '',
                },
                data_pengajuan: {
                    fasilitas_kredit: '',
                    penggunaan_kredit: '',
                    plafond: '',
                    tenor: '',
                    rate: '',
                    sistem_pembayaran: '',
                },
                data_rekening: {
                    bank_penerbit: 'PT. BANK KB INDONESIA, TBK.',
                    jenis_rekening: '',
                    norek: '',
                    an_rekening: '',
                },
                data_jaminan: {
                    jenis_kendaraan: '',
                    kondisi_kendaraan: '',
                    tujuan_kredit: '',
                    brand_kendaraan: '',
                    tipe_kendaraan: '',
                    tahun_pembuatan: '',
                    nomor_bpkb: '',
                    nomor_mesin: '',
                    nomor_rangka: '',
                    an_kendaraan: '',
                },
                data_kontak: {
                    nama_lengkap: '',
                    hubungan: '',
                    alamat: '',
                    no_hp: '',
                },
            };
        }
    }
}

</script>