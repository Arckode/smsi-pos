<template>
    <div>
        <!-- offcanvas Add New Document -->
        <div class="offcanvas offcanvas-end responsive-offcanvas p-6" tabindex="-1" id="offcanvasEditRight"
            data-bs-keyboard="false" aria-labelledby="offcanvasEditRightLabel">

        <div class="offcanvas-header">
            <h5 id="offcanvasEditRightLabel">Edit Data Nasabah</h5>
            <button type="button" class="btn-close btn-close-white" @click.prevent="closeComponent" aria-label="Close">
            </button>
        </div>
        <div class="offcanvas-body p-5 pt-0 mx-3 border rounded-3 overflowy-hidden-style">

            <ul class="nav nav-tabs sticky-sm-top bg-white pt-6" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pengajuan-tab" data-bs-toggle="tab" data-bs-target="#pengajuan"
                        type="button" role="tab" aria-controls="pengajuan" aria-selected="true">Data Pengajuan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="docs-tab" data-bs-toggle="tab" data-bs-target="#docs" type="button"
                        role="tab" aria-controls="docs" aria-selected="false">Dokumen Pendukung</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history"
                        type="button" role="tab" aria-controls="history" aria-selected="false">History Status</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active p-3" id="pengajuan" role="tabpanel"
                    aria-labelledby="pengajuan-tab">

                    <div class="entry-content">
                        <ol>
                            <li id="data-pemohon" :class="data_model_data_pemohon">
                                <div class="accordion" id="accordionFlush-data-pemohon">
                                    <div class="accordion-item card shadow-md border-3 rounded-3 p-3"
                                        :class="data_model_data_pemohon == 'kosong' ? 'border-danger' : data_model_data_pemohon == 'lengkap' ? 'border-info' : 'border-warning'">
                                        <h2 class="accordion-header" id="flush-heading-data-pemohon">
                                            <button class="accordion-button collapsed mb-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-data-pemohon"
                                                aria-expanded="false" aria-controls="flush-collapse-data-pemohon">
                                                <h5 class="text-xl mb-0"
                                                    :class="data_model_data_pemohon == 'kosong' ? 'text-danger' : data_model_data_pemohon == 'lengkap' ? 'text-info' : 'text-warning'">
                                                    Data Pemohon
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse-data-pemohon" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading-data-pemohon"
                                            data-bs-parent="#accordionFlush-data-pemohon">
                                            <hr class="border border-bottom border-primary mt-0 pt-0 mx-3">
                                            <div class="accordion-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Nama Lengkap</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="model.data_pemohon.nama_lengkap"
                                                            name="name" class="form-control" placeholder="" required="">
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
                                                            name="tempat_lahir" class="form-control" placeholder=""
                                                            required="">
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
                                                            <option value="Aliran Kepercayaan">Aliran Kepercayaan
                                                            </option>
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
                                                        <textarea v-model="model.data_pemohon.alamat_domisili"
                                                            type="text" name="alamat_domisili" class="form-control"
                                                            placeholder="" required=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Jenis Kelamin</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select v-model="model.data_pemohon.jenis_kelamin"
                                                            class="form-select" name="kelamin" required>
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
                                                            <input type="text" v-model="model.data_pemohon.no_hp"
                                                                class="form-control" name="no_hp"
                                                                aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Status</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select v-model="model.data_pemohon.status_perkawinan"
                                                            class="form-select" name="status" required>
                                                            <option value="">Pilih Status Perkawinan</option>
                                                            <option value="Belum Kawin">Belum Kawin</option>
                                                            <option value="Kawin">Kawin</option>
                                                            <option value="Duda/Janda">Duda/Janda</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li id="data-pekerjaan" :class="data_model_data_pekerjaan">
                                <div class="accordion" id="accordionFlush-data-pekerjaan">
                                    <div class="accordion-item card shadow-md border-3 rounded-3 p-3"
                                        :class="data_model_data_pekerjaan == 'kosong' ? 'border-danger' : data_model_data_pekerjaan == 'lengkap' ? 'border-info' : 'border-warning'">
                                        <h2 class="accordion-header" id="flush-heading-data-pekerjaan">
                                            <button class="accordion-button collapsed mb-0" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse-data-pekerjaan" aria-expanded="false"
                                                aria-controls="flush-collapse-data-pekerjaan">
                                                <h5 class="text-xl text-primary mb-0"
                                                    :class="data_model_data_pekerjaan == 'kosong' ? 'text-danger' : data_model_data_pekerjaan == 'lengkap' ? 'text-info' : 'text-warning'">
                                                    Data Pekerjaan
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse-data-pekerjaan" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading-data-pekerjaan"
                                            data-bs-parent="#accordionFlush-data-pekerjaan">
                                            <hr class="border border-bottom border-primary mt-0 pt-0 mx-3">
                                            <div class="accordion-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Nama Perusahaan / Instansi</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select v-model="model.data_pekerjaan.affiliasi_id"
                                                            name="affiliasi_id" class="form-select" required>
                                                            <option value="" selected>Pilih Nama Perusahaan / Instansi
                                                            </option>
                                                            <option v-for="item in collections.affiliasi" :key="item.id"
                                                                :value="item.id">
                                                                {{ item.nama_affiliasi }}
                                                            </option>
                                                        </select>
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
                                                        <label>No. NPWP</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="model.data_pekerjaan.npwp"
                                                            name="npwp" class="form-control" placeholder="" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>No. BPJS Tenaga Kerja</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="model.data_pekerjaan.no_bpjs"
                                                            name="bpjs" class="form-control" placeholder="" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Jabatan / Posisi</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="model.data_pekerjaan.jabatan"
                                                            name="position" class="form-control" placeholder=""
                                                            required="">
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
                                                        <label>Pendidikan Terakhir</label>
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
                                                            placeholder="" required=""
                                                            v-model="model.data_pekerjaan.tahun_kerja"></input>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Penghasilan Bulanan (THP)</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="number" name="thp" class="form-control"
                                                            placeholder="" required=""
                                                            v-model="model.data_pekerjaan.thp"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li id="data-pasangan" :class="data_model_data_pasangan">
                                <div class="accordion" id="accordionFlush-data-pasangan">
                                    <div class="accordion-item card shadow-md border-3 rounded-3 p-3"
                                        :class="data_model_data_pasangan == 'kosong' ? 'border-danger' : data_model_data_pasangan == 'lengkap' ? 'border-info' : 'border-warning'">
                                        <h2 class="accordion-header" id="flush-heading-data-pasangan">
                                            <button class="accordion-button collapsed mb-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-data-pasangan"
                                                aria-expanded="false" aria-controls="flush-collapse-data-pasangan">
                                                <h5 class="text-xl text-primary mb-0"
                                                    :class="data_model_data_pasangan == 'kosong' ? 'text-danger' : data_model_data_pasangan == 'lengkap' ? 'text-info' : 'text-warning'">
                                                    Data Pasangan
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse-data-pasangan" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading-data-pasangan"
                                            data-bs-parent="#accordionFlush-data-pasangan">
                                            <hr class="border border-bottom border-primary mt-0 pt-0 mx-3">
                                            <div class="accordion-body">

                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Nama Pasangan</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="model.data_pasangan.nama_pasangan"
                                                            name="couple_name" class="form-control" placeholder=""
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Status Pasangan</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select v-model="model.data_pasangan.status_pasangan"
                                                            class="form-select" name="couple_status" required>
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
                                                        <input type="text" v-model="model.data_pasangan.nik_pasangan"
                                                            name="couple_nik" class="form-control" placeholder=""
                                                            required="">
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
                                                        <textarea v-model="model.data_pasangan.alamat_pasangan"
                                                            type="text" name="alamat_domisili" class="form-control"
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
                                                            <input type="text"
                                                                v-model="model.data_pasangan.no_hp_pasangan"
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
                                                        <input type="number" v-model="model.data_pasangan.jumlah_anak"
                                                            name="anak" class="form-control" placeholder="" required="">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li id="data-pengajuan-kredit" :class="data_model_data_pengajuan_kredit">
                                <div class="accordion" id="accordionFlush-data-pengajuan-kredit">
                                    <div class="accordion-item card shadow-md border-3 rounded-3 p-3"
                                        :class="data_model_data_pengajuan_kredit == 'kosong' ? 'border-danger' : data_model_data_pengajuan_kredit == 'lengkap' ? 'border-info' : 'border-warning'">
                                        <h2 class="accordion-header" id="flush-heading-data-pengajuan-kredit">
                                            <button class="accordion-button collapsed mb-0" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse-data-pengajuan-kredit"
                                                aria-expanded="false"
                                                aria-controls="flush-collapse-data-pengajuan-kredit">
                                                <h5 class="text-xl text-primary mb-0"
                                                    :class="data_model_data_pengajuan_kredit == 'kosong' ? 'text-danger' : data_model_data_pengajuan_kredit == 'lengkap' ? 'text-info' : 'text-warning'">
                                                    Data Pengajuan Kredit
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse-data-pengajuan-kredit"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading-data-pengajuan-kredit"
                                            data-bs-parent="#accordionFlush-data-pengajuan-kredit">
                                            <hr class="border border-bottom border-primary mt-0 pt-0 mx-3">
                                            <div class="accordion-body">

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
                                                        <select v-model="model.data_pengajuan.tujuan_penggunaan"
                                                            name="penggunaan_kredit" class="form-select" required>
                                                            <option value="" selected>Pilih Tujuan Kredit</option>
                                                            <option value="Kebutuhan Rumah Tangga">Kebutuhan Rumah
                                                                Tangga
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
                                                            <input type="text"
                                                                v-model="model.data_pengajuan.plafond_kredit"
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
                                                            <input type="number"
                                                                v-model="model.data_pengajuan.tenor_bulan" name="tenor"
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
                                                        <select v-model="model.data_pengajuan.jenis_bunga" name="rate"
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
                                    </div>
                                </div>
                            </li>

                            <li id="data-rekening" :class="data_model_data_rekening">
                                <div class="accordion" id="accordionFlush-data-rekening">
                                    <div class="accordion-item card shadow-md border-3 rounded-3 p-3"
                                        :class="data_model_data_rekening == 'kosong' ? 'border-danger' : data_model_data_rekening == 'lengkap' ? 'border-info' : 'border-warning'">
                                        <h2 class="accordion-header" id="flush-heading-data-rekening">
                                            <button class="accordion-button collapsed mb-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-data-rekening"
                                                aria-expanded="false" aria-controls="flush-collapse-data-rekening">
                                                <h5 class="text-xl text-primary mb-0"
                                                    :class="data_model_data_rekening == 'kosong' ? 'text-danger' : data_model_data_rekening == 'lengkap' ? 'text-info' : 'text-warning'">
                                                    Data Rekening KBI Pemohon
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse-data-rekening" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading-data-rekening"
                                            data-bs-parent="#accordionFlush-data-rekening">
                                            <hr class="border border-bottom border-primary mt-0 pt-0 mx-3">
                                            <div class="accordion-body">

                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Bank Penerbit</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="bank_penerbit" class="form-control"
                                                            value="PT. BANK KB INDONESIA, TBK." disabled>
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
                                                            <option value="Tabungan Kerjasama">Tabungan Kerjasama
                                                            </option>
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
                                                        <input type="text" v-model="model.data_rekening.nomor_rekening"
                                                            name="norek" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Atas Nama</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text"
                                                            v-model="model.data_rekening.atas_nama_rekening"
                                                            name="an_rekening" class="form-control" required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li id="data-jaminan" :class="data_model_data_jaminan">
                                <div class="accordion" id="accordionFlush-data-jaminan">
                                    <div class="accordion-item card shadow-md border-3 rounded-3 p-3"
                                        :class="data_model_data_jaminan == 'kosong' ? 'border-danger' : data_model_data_jaminan == 'lengkap' ? 'border-info' : 'border-warning'">
                                        <h2 class="accordion-header" id="flush-heading-data-jaminan">
                                            <button class="accordion-button collapsed mb-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-data-jaminan"
                                                aria-expanded="false" aria-controls="flush-collapse-data-jaminan">
                                                <h5 class="text-xl text-primary mb-0"
                                                    :class="data_model_data_jaminan == 'kosong' ? 'text-danger' : data_model_data_jaminan == 'lengkap' ? 'text-info' : 'text-warning'">
                                                    Data Jaminan Kredit (Khusus Kredit Kendaraan Bermotor)
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse-data-jaminan" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading-data-jaminan"
                                            data-bs-parent="#accordionFlush-data-jaminan">
                                            <hr class="border border-bottom border-primary mt-0 pt-0 mx-3">
                                            <div class="accordion-body">

                                                <div class="row mb-3">
                                                    <div class="col-md-3 mt-1 m-auto">
                                                        <label>Jenis Kendaraan</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select v-model="model.data_jaminan.jenis_kendaraan"
                                                            name="jenis_kendaraan" class="form-select">
                                                            <option value="" selected>Pilih Jenis Kendaraan</option>
                                                            <option value="Roda 4">Roda 4</option>
                                                            <option value="Roda 2">Roda 2 (**)</option>
                                                        </select>
                                                        <small class="text-warning">(**) Hanya kendaraan baru
                                                            saja</small>
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
                                                        <select v-model="model.data_jaminan.tujuan_kredit_kendaraan"
                                                            name="tujuan_kredit" class="form-select">
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
                                                        <input type="number"
                                                            v-model="model.data_jaminan.tahun_pembuatan"
                                                            name="tahun_pembuatan" class="form-control" min="1900"
                                                            max="2099">
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
                                                        <input type="text"
                                                            v-model="model.data_jaminan.atas_nama_kendaraan"
                                                            name="an_kendaraan" class="form-control">
                                                        <small class="text-muted">*Khusus Used Vehicle</small>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li id="data-kontak-darurat" :class="data_model_data_kontak">
                                <div class="accordion" id="accordionFlush-data-darurat">
                                    <div class="accordion-item card shadow-md border-3 rounded-3 p-3"
                                        :class="data_model_data_kontak == 'kosong' ? 'border-danger' : data_model_data_kontak == 'lengkap' ? 'border-info' : 'border-warning'">
                                        <h2 class="accordion-header" id="flush-heading-data-darurat">
                                            <button class="accordion-button collapsed mb-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-data-darurat"
                                                aria-expanded="false" aria-controls="flush-collapse-data-darurat">
                                                <h5 class="text-xl text-primary mb-0"
                                                    :class="data_model_data_kontak == 'kosong' ? 'text-danger' : data_model_data_kontak == 'lengkap' ? 'text-info' : 'text-warning'">
                                                    Data Kontak Darurat
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse-data-darurat" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading-data-darurat"
                                            data-bs-parent="#accordionFlush-data-darurat">
                                            <hr class="border border-bottom border-primary mt-0 pt-0 mx-3">
                                            <div class="accordion-body">

                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Nama</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text"
                                                            v-model="model.data_kontak.nama_kontak_darurat"
                                                            name="nama_lengkap" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Hubungan dengan pemohon</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text"
                                                            v-model="model.data_kontak.hubungan_kontak_darurat"
                                                            name="hubungan" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>Alamat</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text"
                                                            v-model="model.data_kontak.alamat_kontak_darurat"
                                                            name="alamat" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 m-auto">
                                                        <label>No. HP</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">+62</span>
                                                            <input type="text"
                                                                v-model="model.data_kontak.no_hp_kontak_darurat"
                                                                class="form-control" name="couple_phone"
                                                                aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>

                </div>

                <div class="tab-pane fade" id="docs" role="tabpanel" aria-labelledby="docs-tab">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Dokumen Pendukung</h5>
                                <small class="text-muted">Kelola semua file nasabah dengan preview, upload, dan riwayat unggahan.</small>
                            </div>
                            <span class="badge bg-light text-dark border">
                                {{ documentRows.length }} file
                            </span>
                        </div>

                        <div class="row g-3">
                            <div v-for="documentType in documentDefinitions" :key="documentType.key" class="col-xl-6 col-lg-12">
                                <div class="card shadow-sm border rounded-3 h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h6 class="mb-1">{{ documentType.label }}</h6>
                                                <small class="text-muted">{{ documentType.description }}</small>
                                            </div>
                                            <span v-if="getDocumentLatest(documentType.key)"
                                                class="badge bg-success-subtle text-success border border-success-subtle">uploaded</span>
                                            <span v-else class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">empty</span>
                                        </div>

                                        <div class="mb-3 d-flex justify-content-center align-items-center border rounded-3 bg-light" style="min-height: 180px; overflow: hidden;">
                                            <img v-if="getDocumentLatest(documentType.key)"
                                                class="img-fluid" alt="preview"
                                                :src="asset(`/storage/${getDocumentLatest(documentType.key).location_url}`)"
                                                style="max-height: 180px; width: 100%; object-fit: contain;">
                                            <img v-else class="img-fluid opacity-50" alt="no document"
                                                :src="asset('/images/no_content.jpg')"
                                                style="max-height: 120px; width: auto; object-fit: contain;">
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-primary"
                                                :disabled="!getDocumentLatest(documentType.key)"
                                                @click.prevent="previewDocument(documentType.key)">
                                                <i class="fas fa-expand me-1"></i>Preview
                                            </button>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-info"
                                                :disabled="!getDocumentLatest(documentType.key)"
                                                @click.prevent="downloadDocument(getDocumentLatest(documentType.key))">
                                                <i class="fas fa-download me-1"></i>Download
                                            </button>
                                        </div>

                                        <div class="mb-2">
                                            <input class="form-control form-control-sm" type="file" accept="image/*,.pdf"
                                                @change="handleDocumentFileChange($event, documentType.key)">
                                        </div>

                                        <button type="button" class="btn btn-primary btn-sm w-100"
                                            :disabled="!pendingUploads[documentType.key]"
                                            @click.prevent="uploadDocument(documentType.key)">
                                            <i class="fas fa-upload me-1"></i>Upload File
                                        </button>

                                        <div v-if="getDocumentHistory(documentType.key).length" class="mt-3 pt-3 border-top">
                                            <small class="text-uppercase text-muted fw-semibold">Riwayat upload</small>
                                            <ul class="list-unstyled mb-0 mt-2 small">
                                                <li v-for="historyItem in getDocumentHistory(documentType.key)" :key="historyItem.id" class="d-flex justify-content-between align-items-center gap-2 py-1 border-bottom border-light">
                                                    <span class="text-secondary">
                                                        {{ formatDateTime(historyItem.created_at) }}
                                                    </span>
                                                    <span class="badge text-bg-light border" :class="historyItem.status ? 'text-success' : 'text-muted'">
                                                        {{ historyItem.status ? 'active' : 'previous' }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div v-else class="mt-3 pt-3 border-top text-muted small">
                                            Belum ada file yang diunggah untuk dokumen ini.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">...</div>

            </div>



        </div>
        <div class="offcanvas-footer d-flex justify-content-end p-3">
            <button class="btn btn-warning me-3" @click.prevent="closeComponent">Cancel</button>
            <button class="btn btn-primary" @click.prevent="confirmUpdate">Submit</button>
        </div>
    </div>

    <div class="modal fade" id="previewImageModal" ref="previewModal" tabindex="-1"
        aria-labelledby="previewImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewImageModalLabel">Preview {{ file_management.label }}</h5>
                    <button type="button" class="btn-close" @click.prevent="closePreview" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center p-0">
                    <img v-if="file_management.preview_src" :src="previewImageUrl"
                        class="img-fluid" alt="Preview image" style="max-height: 80vh; width: auto;" />
                    <p v-else class="text-center text-muted p-4 mb-0">No image selected.</p>
                </div>
            </div>
        </div>
    </div></div>
</template>

<script>
import { VMoney } from 'v-money'
import $, { data } from "jquery";
import Swal from "sweetalert2";
import QRCode from "qrcode";
import { emitter } from '../../../../../../eventEmitter.js';
import html2pdf from "html2pdf.js";
import ExcelJS from 'exceljs';
import html2canvas from 'html2canvas';
export default {
    directives: { money: VMoney },
    name: "EditNasabahOffcanvas",
    data() {
        return {
            modalEdit: "",
            modalPreview: null,
            loading: false,
            componentload: false,
            file_management: {
                selected_docs_section: 'dokumen_ktp',
                label: 'KTP',
                changeFileToggle: 0,
                selected_preview: null,
                preview_src: null,
                attach_file: null,
            },
            userid: null,
            documentDefinitions: [
                {
                    key: 'dokumen_ktp',
                    label: 'KTP',
                    description: 'Dokumen pendukung KTP nasabah',
                },
                {
                    key: 'dokumen_kartu_keluarga',
                    label: 'Kartu Keluarga',
                    description: 'Dokumen pendukung kartu keluarga',
                },
                {
                    key: 'dokumen_npwp',
                    label: 'NPWP',
                    description: 'Dokumen pendukung NPWP',
                },
                {
                    key: 'dokumen_ktp_pasangan',
                    label: 'KTP Pasangan',
                    description: 'Dokumen pendukung KTP pasangan',
                },
                {
                    key: 'dokumen_asuransi',
                    label: 'Asuransi',
                    description: 'Dokumen pendukung asuransi',
                },
                {
                    key: 'dokumen_id_card_perusahaan',
                    label: 'ID Card Perusahaan',
                    description: 'Dokumen pendukung ID card perusahaan',
                },
                {
                    key: 'dokumen_selfie',
                    label: 'Selfie',
                    description: 'Dokumen pendukung selfie',
                },
                {
                    key: 'dokumen_surat_pernyataan',
                    label: 'Surat Pernyataan',
                    description: 'Dokumen pendukung surat pernyataan',
                },
            ],
            documentRows: [],
            pendingUploads: {},
            collections: {
                affiliasi: [],
            },
            model: {
                // Section A: Data Pemohon
                data_pemohon: {
                    nama_lengkap: '',
                    nik: '',
                    tempat_lahir: '',
                    tanggal_lahir: '',
                    agama: '',
                    alamat_ktp: '',
                    alamat_domisili: '',
                    jenis_kelamin: '',
                    no_hp: '',
                    status_perkawinan: '',
                },
                // Section B: Data Pekerjaan
                data_pekerjaan: {
                    affiliasi_id: '',
                    nip: '',
                    npwp: '',
                    no_bpjs: '',
                    jabatan: '',
                    status_kepegawaian: '',
                    pendidikan_terakhir: '',
                    departemen: '',
                    tahun_kerja: '',
                    thp: '',
                },
                // Section C: Data Pasangan Pemohon
                data_pasangan: {
                    nama_pasangan: '',
                    status_pasangan: '',
                    nik_pasangan: '',
                    alamat_pasangan: '',
                    no_hp_pasangan: '',
                    jumlah_anak: '',
                },
                // Section D: Data Pengajuan Kredit
                data_pengajuan: {
                    fasilitas_kredit: '',
                    tujuan_penggunaan: '',
                    plafond_kredit: '',
                    tenor_bulan: '',
                    jenis_bunga: '',
                    sistem_pembayaran: '',
                },
                // Section E: Data Rekening KBI Pemohon
                data_rekening: {
                    bank_penerbit: 'PT. BANK KB INDONESIA, TBK.',
                    jenis_rekening: '',
                    nomor_rekening: '',
                    atas_nama_rekening: '',
                },
                // Section F: Jaminan Kredit
                data_jaminan: {
                    jenis_kendaraan: '',
                    kondisi_kendaraan: '',
                    tujuan_kredit_kendaraan: '',
                    brand_kendaraan: '',
                    tipe_kendaraan: '',
                    tahun_pembuatan: '',
                    nomor_bpkb: '',
                    nomor_mesin: '',
                    nomor_rangka: '',
                    atas_nama_kendaraan: '',
                },
                // Section G: Kontak Darurat
                data_kontak: {
                    nama_kontak_darurat: '',
                    hubungan_kontak_darurat: '',
                    alamat_kontak_darurat: '',
                    no_hp_kontak_darurat: '',
                },
                // Section H: Dokumen Pendukung
                data_dokumen: {
                    dokumen_ktp: null,
                    dokumen_kartu_keluarga: null,
                    dokumen_npwp: null,
                    dokumen_ktp_pasangan: null,
                    dokumen_asuransi: null,
                    dokumen_id_card_perusahaan: null,
                    dokumen_selfie: null,
                    dokumen_surat_pernyataan: null,
                },
            },
            data_model_data_pemohon: 'kosong',
            data_model_data_pekerjaan: 'kosong',
            data_model_data_pasangan: 'kosong',
            data_model_data_pengajuan_kredit: 'kosong',
            data_model_data_rekening: 'kosong',
            data_model_data_jaminan: 'kosong',
            data_model_data_kontak: 'kosong',
            previews: {
                dokumen_ktp: null,
                dokumen_kartu_keluarga: null,
                dokumen_npwp: null,
                dokumen_ktp_pasangan: null,
                dokumen_asuransi: null,
                dokumen_id_card_perusahaan: null,
                dokumen_selfie: null,
                dokumen_surat_pernyataan: null,
            },
        };
    },

    mounted() {
        emitter.on("EditNasabah", async ([authorized, id]) => {
            console.log('EditUser event received with authorized:', authorized, 'and id:', id);
            if (authorized) {
                this.modalEdit = new bootstrap.Offcanvas("#offcanvasEditRight", {
                    backdrop: false,
                    keyboard: false,
                });
                this.modalPreview = new bootstrap.Modal(this.$refs.previewModal, {
                    backdrop: true,
                });
                this.userid = id;
                this.componentload = true;
                await this.fetchRoles();
                await this.fetchAffiliasi();
                await this.fetchUnits();
                await this.fetchNasabah(this.userid);
                await this.openModal();
                this.componentload = false;
            }

        });
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`;
        },
        async fetchAffiliasi() {
            let endpoint = `${BASEURL}/api/affiliasi/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collections.affiliasi = response.data.data;
            } catch (error) {
                console.error("Error fetching affiliasi: ", error);
            }
        },
        selectedDocs(e) {
            this.file_management.selected_docs_section = e;
            const found = this.documentDefinitions.find(item => item.key === e);
            if (found) {
                this.file_management.label = found.label;
            }
            this.file_management.selected_preview = this.model.data_dokumen[e] || null;
        },
        getDocumentLabel(key) {
            const found = this.documentDefinitions.find(item => item.key === key);
            return found ? found.label : key;
        },
        getDocumentLatest(key) {
            return [...this.documentRows]
                .filter(doc => doc.doc_type === key)
                .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))[0] || null;
        },
        getDocumentHistory(key) {
            return [...this.documentRows]
                .filter(doc => doc.doc_type === key)
                .sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        },
        formatDateTime(value) {
            if (!value) return '-';
            const date = new Date(value);
            if (Number.isNaN(date.getTime())) return value;
            return date.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            });
        },
        handleDocumentFileChange(event, key) {
            const file = event.target.files && event.target.files[0];
            if (!file) {
                delete this.pendingUploads[key];
                return;
            }

            this.pendingUploads[key] = file;
            this.file_management.selected_docs_section = key;
            this.file_management.label = this.getDocumentLabel(key);
        },
        async uploadDocument(key) {
            const file = this.pendingUploads[key];
            if (!file) {
                Swal.fire('Perhatian!', 'Pilih file terlebih dahulu sebelum upload.', 'warning');
                return;
            }

            const formData = new FormData();
            formData.append('id', this.userid);
            formData.append('jenis_dokumen', key);
            formData.append('file', file);

            try {
                await axios.post(`${BASEURL}/api/nasabah/upload`, formData, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    },
                });

                delete this.pendingUploads[key];
                await this.fetchDocuments(this.userid);
                Swal.fire('Saved!', 'File nasabah berhasil diupload.', 'success');
            } catch (error) {
                console.error(`Error uploading ${key}:`, error);
                Swal.fire('Error!', `Gagal mengupload ${this.getDocumentLabel(key)}.`, 'error');
            }
        },
        previewDocument(key) {
            const latest = this.getDocumentLatest(key);
            if (!latest || !latest.location_url) {
                return;
            }

            this.file_management.selected_docs_section = key;
            this.file_management.label = this.getDocumentLabel(key);
            this.file_management.preview_src = latest.location_url;
            this.file_management.selected_preview = latest.location_url;

            if (!this.modalPreview) {
                this.modalPreview = new bootstrap.Modal(this.$refs.previewModal, {
                    backdrop: true,
                });
            }

            this.modalPreview.show();
        },
        async downloadDocument(documentItem) {
            if (!documentItem || !documentItem.location_url) {
                return;
            }

            await this.download(documentItem.location_url);
        },
        async fetchDocuments(id) {
            let endpoint = `${BASEURL}/api/nasabah/${id}/documents`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });

                const documents = response.data.data || [];
                this.documentRows = documents;

                const docsMap = {};
                documents
                    .filter(doc => doc.status !== false)
                    .forEach((doc) => {
                        docsMap[doc.doc_type] = doc.location_url;
                    });

                this.model.data_dokumen = {
                    ...this.model.data_dokumen,
                    ...docsMap,
                };

                this.file_management.selected_preview = this.model.data_dokumen[this.file_management.selected_docs_section] || null;
            } catch (error) {
                console.error('Error fetching nasabah documents:', error);
            }
        },
        async fetchNasabah(id) {
            let endpoint = `${BASEURL}/api/nasabah/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.model.data_pemohon.nama_lengkap = response.data.data.nama_lengkap
                this.model.data_pemohon.nik = response.data.data.nik
                this.model.data_pemohon.tempat_lahir = response.data.data.tempat_lahir
                this.model.data_pemohon.tanggal_lahir = response.data.data.tanggal_lahir
                this.model.data_pemohon.agama = response.data.data.agama
                this.model.data_pemohon.alamat_ktp = response.data.data.alamat_ktp
                this.model.data_pemohon.alamat_domisili = response.data.data.alamat_domisili
                this.model.data_pemohon.jenis_kelamin = response.data.data.jenis_kelamin
                this.model.data_pemohon.no_hp = response.data.data.no_hp
                this.model.data_pemohon.status_perkawinan = response.data.data.status_perkawinan

                this.model.data_pekerjaan.affiliasi_id = response.data.data.affiliasi_id
                this.model.data_pekerjaan.nip = response.data.data.nip
                this.model.data_pekerjaan.npwp = response.data.data.npwp
                this.model.data_pekerjaan.no_bpjs = response.data.data.no_bpjs
                this.model.data_pekerjaan.jabatan = response.data.data.jabatan
                this.model.data_pekerjaan.status_kepegawaian = response.data.data.status_kepegawaian
                this.model.data_pekerjaan.pendidikan_terakhir = response.data.data.pendidikan_terakhir
                this.model.data_pekerjaan.departemen = response.data.data.departemen
                this.model.data_pekerjaan.tahun_kerja = response.data.data.tahun_kerja
                this.model.data_pekerjaan.thp = response.data.data.thp

                this.model.data_pasangan.nama_pasangan = response.data.data.nama_pasangan
                this.model.data_pasangan.status_pasangan = response.data.data.status_pasangan
                this.model.data_pasangan.nik_pasangan = response.data.data.nik_pasangan
                this.model.data_pasangan.alamat_pasangan = response.data.data.alamat_pasangan
                this.model.data_pasangan.no_hp_pasangan = response.data.data.no_hp_pasangan
                this.model.data_pasangan.jumlah_anak = response.data.data.jumlah_anak

                this.model.data_pengajuan.fasilitas_kredit = response.data.data.fasilitas_kredit
                this.model.data_pengajuan.tujuan_penggunaan = response.data.data.tujuan_penggunaan
                this.model.data_pengajuan.plafond_kredit = response.data.data.plafond_kredit
                this.model.data_pengajuan.tenor_bulan = response.data.data.tenor_bulan
                this.model.data_pengajuan.jenis_bunga = response.data.data.jenis_bunga
                this.model.data_pengajuan.sistem_pembayaran = response.data.data.sistem_pembayaran

                this.model.data_rekening.bank_penerbit = response.data.data.bank_penerbit
                this.model.data_rekening.jenis_rekening = response.data.data.jenis_rekening
                this.model.data_rekening.nomor_rekening = response.data.data.nomor_rekening
                this.model.data_rekening.atas_nama_rekening = response.data.data.atas_nama_rekening

                this.model.data_jaminan.jenis_kendaraan = response.data.data.jenis_kendaraan
                this.model.data_jaminan.kondisi_kendaraan = response.data.data.kondisi_kendaraan
                this.model.data_jaminan.tujuan_kredit_kendaraan = response.data.data.tujuan_kredit_kendaraan
                this.model.data_jaminan.brand_kendaraan = response.data.data.brand_kendaraan
                this.model.data_jaminan.tipe_kendaraan = response.data.data.tipe_kendaraan
                this.model.data_jaminan.tahun_pembuatan = response.data.data.tahun_pembuatan
                this.model.data_jaminan.nomor_bpkb = response.data.data.nomor_bpkb
                this.model.data_jaminan.nomor_mesin = response.data.data.nomor_mesin
                this.model.data_jaminan.nomor_rangka = response.data.data.nomor_rangka
                this.model.data_jaminan.atas_nama_kendaraan = response.data.data.atas_nama_kendaraan

                this.model.data_kontak.nama_kontak_darurat = response.data.data.nama_kontak_darurat
                this.model.data_kontak.hubungan_kontak_darurat = response.data.data.hubungan_kontak_darurat
                this.model.data_kontak.alamat_kontak_darurat = response.data.data.alamat_kontak_darurat
                this.model.data_kontak.no_hp_kontak_darurat = response.data.data.no_hp_kontak_darurat

                await this.fetchDocuments(id);
                this.selectedDocs('dokumen_ktp')

                console.log('Nasabah data:', this.model);
            } catch (error) {
                console.error("Error fetching nasabah data: ", error);
            }
        },
        async fetchRoles() {
            let endpoint = `${BASEURL}/api/role/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collections.roles = response.data.data
                console.log('Role list:', this.collections.roles);
            } catch (error) {
                console.error("Error fetching role list: ", error);
            }
        },
        show_preview(file) {
            if (!file) {
                return;
            }
            this.file_management.preview_src = file;
            if (!this.modalPreview) {
                this.modalPreview = new bootstrap.Modal(this.$refs.previewModal, {
                    backdrop: true,
                });
            }
            this.modalPreview.show();
        },
        closePreview() {
            if (this.modalPreview) {
                this.modalPreview.hide();
            }
            this.file_management.preview_src = null;
        },
        async download(file) {
            if (!file) {
                return;
            }

            const isLocalPath = typeof file === 'string' && !file.startsWith('blob:') && !file.startsWith('data:') && !file.startsWith('http');
            const url = isLocalPath ? this.asset(`/storage/${file}`) : file;
            const filename = typeof file === 'string'
                ? file.split('/').pop().split('?')[0] || 'download'
                : 'download';

            try {
                if (url.startsWith('data:') || url.startsWith('blob:')) {
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    return;
                }

                const response = await fetch(url, { mode: 'cors' });
                if (!response.ok) {
                    throw new Error(`Network response was not ok: ${response.statusText}`);
                }
                const blob = await response.blob();
                const blobUrl = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = blobUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(blobUrl);
                document.body.removeChild(a);
            } catch (error) {
                console.error('Error downloading image:', error);
                Swal.fire('Error!', 'Unable to download the image.', 'error');
            }
        },
        async fetchUnits() {
            let endpoint = `${BASEURL}/api/unit/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collections.units = response.data.data
                console.log('Unit list:', this.collections.units);
            } catch (error) {
                console.error("Error fetching unit list: ", error);
            }
        },
        confirmUpdate() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.update()
                }
            })
        },
        async update() {
            this.loading = true

            let endpoint = `${BASEURL}/api/nasabah/${this.userid}`;
            try {
                let response = await axios.put(endpoint, this.model, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                console.log('Update response:', response);
                Swal.fire(
                    'Saved!',
                    'User has been saved.',
                    'success'
                )
                this.closeComponent()
            } catch (error) {
                console.error("Error updating user: ", error);
                Swal.fire(
                    'Error!',
                    'There was an error saving the user.',
                    'error'
                )
            } finally {
                this.loading = false
            }
        },


        // async upload(type) {
        //     let endpoint = `${BASEURL}/api/nasabah/upload/`;
        //     try {
        //         let payload = {
        //             id: this.userid,
        //             jenis_dokumen: type,
        //             file: this.model.data_dokumen[`dokumen_${type}`],
        //         }
        //         console.log('Uploading with payload:', payload);
        //         let response = await axios.post(endpoint, payload, {
        //             headers: {
        //                 Authorization: 'Bearer ' + this.$token(),
        //                 'Content-Type': 'multipart/form-data',
        //             },
        //         });
        //         console.log('Update response:', response);
        //         Swal.fire(
        //             'Saved!',
        //             'User has been saved.',
        //             'success'
        //         )
        //     } catch (error) {
        //         console.error(`Error uploading ${type}: `, error);
        //         Swal.fire(
        //             'Error!',
        //             `There was an error uploading the ${type}.`,
        //             'error'
        //         )
        //     }
        // },
        async openModal() {
            this.modalEdit.show();
        },
        closeComponent() {
            this.modalEdit.hide()
            this.resetForm()
            emitter.emit("fetchNasabahList")
        },
        resetForm() {
            this.model.name = ""
            this.model.email = ""
            this.model.password = ""
            this.model.role_id = null
            this.model.unit_id = null
        },
        initSelect2Filters() {
            const selectElements = $(this.$el).find('select.select2-filter');
            if (!selectElements.length || typeof $.fn.select2 !== 'function') {
                return;
            }
            selectElements.select2({
                theme: 'bootstrap-5',
                width: '100%',
                // placeholder: 'All',
                allowClear: true,
                // minimumResultsForSearch: 0,
                // dropdownParent: $(this.$el),
            });
        },
        destroySelect2() {
            const selectElements = $(this.$el).find('select.select2-filter');
            if (!selectElements.length) {
                return;
            }

            selectElements.each(function () {
                if ($(this).data('select2')) {
                    $(this).select2('destroy');
                }
            });
        },
    },
    computed: {
        previewImageUrl() {
            const src = this.file_management.preview_src;
            if (!src) {
                return '';
            }
            if (typeof src !== 'string') {
                return src;
            }
            if (src.startsWith('blob:') || src.startsWith('data:') || src.startsWith('http')) {
                return src;
            }
            return this.asset(`/storage/${src}`);
        },
    },
    watch: {
        'model.data_pemohon': {
            handler(newVal) {
                const values = Object.values(newVal);
                const filledCount = values.filter(v => {
                    if (typeof v === 'string') return v.trim() !== '';
                    return v !== null && v !== undefined;
                }).length;

                if (filledCount === 0) {
                    this.data_model_data_pemohon = 'kosong';
                } else if (filledCount === values.length) {
                    this.data_model_data_pemohon = 'lengkap';
                } else {
                    this.data_model_data_pemohon = 'partial';
                }
            },
            deep: true,
            immediate: true,
        },
        'model.data_pekerjaan': {
            handler(newVal) {
                const values = Object.values(newVal);
                const filledCount = values.filter(v => {
                    if (typeof v === 'string') return v.trim() !== '';
                    return v !== null && v !== undefined;
                }).length;

                if (filledCount === 0) {
                    this.data_model_data_pekerjaan = 'kosong';
                } else if (filledCount === values.length) {
                    this.data_model_data_pekerjaan = 'lengkap';
                } else {
                    this.data_model_data_pekerjaan = 'partial';
                }
            },
            deep: true,
            immediate: true,
        },
        'model.data_pasangan': {
            handler(newVal) {
                const values = Object.values(newVal);
                const filledCount = values.filter(v => {
                    if (typeof v === 'string') return v.trim() !== '';
                    return v !== null && v !== undefined;
                }).length;

                if (filledCount === 0) {
                    this.data_model_data_pasangan = 'kosong';
                } else if (filledCount === values.length) {
                    this.data_model_data_pasangan = 'lengkap';
                } else {
                    this.data_model_data_pasangan = 'partial';
                }
            },
            deep: true,
            immediate: true,
        },
        'model.data_pengajuan': {
            handler(newVal) {
                const values = Object.values(newVal);
                const filledCount = values.filter(v => {
                    if (typeof v === 'string') return v.trim() !== '';
                    return v !== null && v !== undefined;
                }).length;

                if (filledCount === 0) {
                    this.data_model_data_pengajuan_kredit = 'kosong';
                } else if (filledCount === values.length) {
                    this.data_model_data_pengajuan_kredit = 'lengkap';
                } else {
                    this.data_model_data_pengajuan_kredit = 'partial';
                }
            },
            deep: true,
            immediate: true,
        },
        'model.data_rekening': {
            handler(newVal) {
                const values = Object.values(newVal);
                const filledCount = values.filter(v => {
                    if (typeof v === 'string') return v.trim() !== '';
                    return v !== null && v !== undefined;
                }).length;

                if (filledCount === 0) {
                    this.data_model_data_rekening = 'kosong';
                } else if (filledCount === values.length) {
                    this.data_model_data_rekening = 'lengkap';
                } else {
                    this.data_model_data_rekening = 'partial';
                }
            },
            deep: true,
            immediate: true,
        },
        'model.data_jaminan': {
            handler(newVal) {
                const values = Object.values(newVal);
                const filledCount = values.filter(v => {
                    if (typeof v === 'string') return v.trim() !== '';
                    return v !== null && v !== undefined;
                }).length;

                if (filledCount === 0) {
                    this.data_model_data_jaminan = 'kosong';
                } else if (filledCount === values.length) {
                    this.data_model_data_jaminan = 'lengkap';
                } else {
                    this.data_model_data_jaminan = 'partial';
                }
            },
            deep: true,
            immediate: true,
        },
        'model.data_kontak': {
            handler(newVal) {
                const values = Object.values(newVal);
                const filledCount = values.filter(v => {
                    if (typeof v === 'string') return v.trim() !== '';
                    return v !== null && v !== undefined;
                }).length;

                if (filledCount === 0) {
                    this.data_model_data_kontak = 'kosong';
                } else if (filledCount === values.length) {
                    this.data_model_data_kontak = 'lengkap';
                } else {
                    this.data_model_data_kontak = 'partial';
                }
            },
            deep: true,
            immediate: true,
        },
    },
};
</script>

<style scoped>
.responsive-offcanvas {
    width: 100%;
}

@media (min-width: 768px) {
    .responsive-offcanvas {
        width: 100%;
    }
}


/* Hide scrollbar for Chrome, Safari and Opera */
.overflowy-hidden-style::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.overflowy-hidden-style {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}

.list-docs {
    height: 50vh;
    overflow-y: auto;
}

.entry-content h3 {
    margin: 0;
}

.entry-content {
    counter-reset: li;
    padding: 1rem;
}

.entry-content>ol>li {
    position: relative;
}

.entry-content>ol>li::before {
    /* background: green; */
    opacity: 0.95;
    content: "";
    position: absolute;
    top: 0;
    left: -15px;
    width: 10px;
    height: 100%;
}

.entry-content>ol {
    list-style: decimal;
    padding: 0 0 0 2rem;
    margin: 0;
}

.entry-content>ol>ol {
    margin: 0 0 0 1em;
}

.entry-content>ol>li {
    position: relative;
    display: block;
    padding: 0.5rem 0.5rem 1rem;
    margin: 0;
    color: #000;
    text-decoration: none;
    border-radius: 1em;
    transition: all 0.2s ease-in-out;
    line-height: 1.4em;
}

.entry-content>ol>li:hover {
    text-decoration: none;
}

.entry-content>ol>li:before {
    content: counter(li);
    counter-increment: li;
    position: absolute;
    z-index: 1;
    left: -3rem;
    top: 50%;
    transform: translateY(-50%);
    background: #774dd3;
    width: 2em;
    height: 2em;
    display: grid;
    place-content: center;
    line-height: 1;
    border: 2px solid #774dd3;
    text-align: center;
    font-weight: bold;
    border-radius: 100%;
    color: #ffffff;
}

/* When kosong */
.entry-content>ol>li.kosong:before {
    background: rgb(234, 78, 61);
    border-color: rgb(234, 78, 61);
}

/* When partial */
.entry-content>ol>li.partial:before {
    background: rgb(241, 153, 55);
    border-color: rgb(241, 153, 55);
}

/* When lengkap */
.entry-content>ol>li.lengkap:before {
    background: rgb(85, 166, 248);
    border-color: rgb(85, 166, 248);
}

.entry-content>ol>li:after {
    content: "";
    position: absolute;
    top: 0;
    bottom: -5px;
    left: -2rem;
    width: 0.1rem;
    background: #774dd3;
    z-index: 0;
}

.entry-content>ol>li:first-child:after {
    top: 50%;
}

.entry-content>ol>li:last-child:after {
    top: 0;
    bottom: 50%;
}
</style>