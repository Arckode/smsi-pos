<template>


    <header id="header" class="d-flex align-items-center fixed-top" style="background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px;">
        <!-- <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <img :src="asset('ap/assets/img/logo.png')" alt="">
                <h1 class="sitename">Append</h1><span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.html#hero" class="active">Home</a></li>
                    <li><a href="index.html#about">About</a></li>
                    <li><a href="index.html#services">Services</a></li>
                    <li><a href="index.html#portfolio">Portfolio</a></li>
                    <li><a href="index.html#pricing">Pricing</a></li>
                    <li><a href="index.html#team">Team</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li>
                    <li><a href="index.html#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="index.html#about">Get Started</a>

        </div> -->

        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="content px-xl-5">
                <h5 class="text-muted mb-0"><span>Formulir Aplikasi Kredit</span></h5>
                <h3 class="mb-0"><strong>CORPORATE BENEFIT PROGRAM</strong></h3>
                <h4 class="text-warning"><strong>PT. BANK KB INDONESIA, TBK.</strong></h4>
            </div>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="faq" class="hero faq section" style="padding-top: 200px; padding-bottom: 0">

            <!-- <img :src="asset('ap/img/hero-bg.jpg')" alt="" data-aos="fade-in"> -->

            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <div class="row gy-4">

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
                                                    name="tanggal_lahir" class="form-control" placeholder=""
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 m-auto">
                                                <label>Agama</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select v-model="model.data_pemohon.agama" class="form-select"
                                                    name="agama" required>
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
                                                        class="form-control" name="phone"
                                                        aria-describedby="basic-addon1">
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
                                                <input type="text" v-model="model.data_pekerjaan.position"
                                                    name="position" class="form-control" placeholder="" required="">
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
                                                <input type="number" name="thn_kerja" class="form-control"
                                                    placeholder="" required=""></input>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 m-auto">
                                                <label>Penghasilan Bulanan (THP)</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="number" name="thn_kerja" class="form-control"
                                                    placeholder="" required=""></input>
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
                                                <textarea type="text" name="alamat_ktp" class="form-control"
                                                    placeholder="" required=""></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 m-auto mt-0">
                                                <label>Alamat Domisili</label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea v-model="model.data_pasangan.couple_alamat_domisili"
                                                    type="text" name="couple_alamat_domisili" class="form-control"
                                                    placeholder="" required=""></textarea>
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
                                                    <option value="Kebutuhan Rumah Tangga">Kebutuhan Rumah Tangga
                                                    </option>
                                                    <option value="Pendidikan">Pendidikan</option>
                                                    <option value="Pembelian Kendaraan/Barang">Pembelian
                                                        Kendaraan/Barang
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
                                                    <input type="text" v-model="model.data_pengajuan.plafond"
                                                        name="plafond" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 m-auto">
                                                <label>Jangka Waktu Kredit</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="number" v-model="model.data_pengajuan.tenor"
                                                        name="tenor" class="form-control" min="1" required>
                                                    <span class="input-group-text">bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 m-auto">
                                                <label>Suka Bunga Kredit</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select v-model="model.data_pengajuan.rate" name="rate"
                                                    class="form-select" required>
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
                                                <select v-model="model.data_rekening.jenis_rekening"
                                                    name="jenis_rekening" class="form-select" required>
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
                                                <select v-model="model.data_jaminan.jenis_kendaraan"
                                                    name="jenis_kendaraan" class="form-select">
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
                                                <input type="text" v-model="model.data_jaminan.nomor_bpkb"
                                                    name="nomor_bpkb" class="form-control">
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
                                                <input type="text" v-model="model.data_kontak.nama_lengkap"
                                                    name="nama_lengkap" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 m-auto">
                                                <label>Hubungan dengan pemohon</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" v-model="model.data_kontak.hubungan" name="hubungan"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 m-auto">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" v-model="model.data_kontak.alamat" name="alamat"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-5 mb-5">
                                    <a type="submit" class="btn btn-primary" @click.prevent="confirmStore">Submit
                                        Application</a>
                                </div>
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

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <!-- <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p>United States</p> -->
                    <p class="mt-2"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>

            </div>
        </div>

        <!-- <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="sitename">Append</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div> -->

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <!-- <div id="preloader"></div> -->


</template>

<script>
import $ from "jquery";
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
        // Attach FAQ toggle handlers when this component is mounted
        this._faqToggleHandler = (e) => {
            // Toggle the active class on the clicked faq-item
            const item = e.currentTarget || e.target.closest('.faq-item');
            if (item) item.classList.toggle('faq-active');
        };

        document.querySelectorAll('#faq .faq-item').forEach(item => {
            item.addEventListener('click', this._faqToggleHandler);
        });

        // Re-initialize PureCounter for SPA-rendered elements
        // In the original static template PureCounter is started in `public/ap/js/main.js`,
        // but for Vue SPA rendering the counters may be inserted after that script runs.
        // Calling a new instance here ensures counters animate when this component is mounted.
        try {
            if (typeof PureCounter === 'function') {
                new PureCounter();
            } else if (window && typeof window.PureCounter === 'function') {
                new window.PureCounter();
            }
        } catch (err) {
            console.warn('PureCounter init failed in Vue mounted()', err);
        }
    },
    destroyed() {
        // Clean up FAQ handlers to avoid leaks
        if (this._faqToggleHandler) {
            document.querySelectorAll('#faq .faq-item').forEach(item => {
                item.removeEventListener('click', this._faqToggleHandler);
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
        }
    }
}

</script>