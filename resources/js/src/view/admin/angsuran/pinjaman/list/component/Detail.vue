<template>
    <!-- modal current qrcode -->
    <div class="modal fade" id="viewCurrentDetQrCode" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5" id="printCurrentEdittedQrCode">
                    <h3 class="m-0 font-weight-normal">{{ currentQrcode }}</h3>
                    <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="currentdetQrSvg"></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for file preview -->
    <div class="modal fade" id="exampledetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-keyboard="false" @contextmenu.prevent>
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ preview.label }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p v-if="preview.isPdf" class="mb-1 me-2 text-danger text-end text-sm fw-800" style="opacity: 0.8;">
                        *gunakan scrollbar
                    </p>
                    <div v-if="preview.isImage">
                        <img :src="preview.filePreview" alt="Preview" class="img-fluid" />
                    </div>
                    <div class="wrapper" v-if="preview.isPdf" style="height: 100%;">
                        <embed :src="preview.filePreview + '#toolbar=0&navpanes=0&scrollbar=0'" height="100%"
                            width="100%" />
                        <div class="embed-cover"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        @click.prevent="downloadFile(preview.filePreview, preview.id)">Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- offcanvas detail Document -->
    <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasDetailRight"
        data-bs-keyboard="false" aria-labelledby="offcanvasDetailRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasDetailRightLabel">Detail Angsuran</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form>
                <!-- <div class="accordion" id="accordionDocumentLabels">
                    <div class="accordion-item mb-3">
                        <h5 class="accordion-header" id="headingOne">
                            <button class="accordion-button border-bottom font-weight-bold collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne">
                                <div class="m-0 flex-grow-1">
                                    <h6 class="m-0">Biodata</h6>
                                    <p class="m-0 text-sm">Informasi mengenai nasabah</p>
                                </div>
                                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                            </button>
                        </h5>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionDocumentLabels">
                            <div class="accordion-body text-sm">
                                <div class="form-floating mb-3">
                                    <input type="text" disabled class="form-control border-0 bg-transparent shadow-none"
                                        id="floatingLabel" placeholder="Judul Document" v-model="model.nasabah.nik" />
                                    <label for="floatingLabel">NIK<span class="text-danger"> *</span></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" disabled class="form-control border-0 bg-transparent shadow-none"
                                        id="floatingLabel" placeholder="Judul Document"
                                        v-model="model.nasabah.nama_lengkap" />
                                    <label for="floatingLabel">Nama Lengkap<span class="text-danger"> *</span></label>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="email" disabled
                                                class="form-control border-0 bg-transparent shadow-none"
                                                id="floatingLabel" placeholder="Kota lahir"
                                                v-model="model.nasabah.tempat_lahir">
                                            <label for="floatingInputGrid">Tempat Lahir<span class="text-danger">
                                                    *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="date" disabled
                                                class="form-control border-0 bg-transparent shadow-none"
                                                id="floatingInputGrid" placeholder="Tanggal Lahir"
                                                v-model="model.nasabah.tanggal_lahir">
                                            <label for="floatingSelectGrid">Tanggal Lahir<span class="text-danger">
                                                    *</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" disabled class="form-control border-0 bg-transparent shadow-none"
                                        id="floatingLabel" placeholder="Judul Document"
                                        v-model="model.nasabah.no_telepon" />
                                    <label for="floatingLabel">Nomor Telfon<span class="text-danger"> *</span></label>
                                </div>
                                <div class="ms-1 mb-3">
                                    <label>Pensiun<span class="text-danger"> *</span></label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input d-flex align-items-center justify-content-center"
                                            type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Taspen"
                                            v-model="model.nasabah.pensiun" disabled>
                                        <label class="form-check-label" for="inlineRadio1">Taspen</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input d-flex align-items-center justify-content-center"
                                            type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Asabri"
                                            v-model="model.nasabah.pensiun" disabled>
                                        <label class="form-check-label" for="inlineRadio2">Asabri</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-check form-switch ms-1">
                                        <input class="form-check-input d-flex align-items-center" style="height: 20px;"
                                            type="checkbox" id="flexSwitchCheckCheckedx"
                                            v-model="model.nasabah.flagging" disabled>
                                        <label class="form-check-label" for="flexSwitchCheckCheckedx">Flagging</label>
                                    </div>
                                    <div class="form">
                                        <input class="form-control" id="floatingInputGrid"
                                            placeholder="Nominal Flagging" v-model.lazy="model.nasabah.flagging_nominal"
                                            v-money="money" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->


                <!-- <div v-if="model.angsuran.schedule_angsuran_created" class="accordion mt-0 mb-6" -->
                <div class="accordion mt-0 mb-6" id="accordionDocumentDetails">
                    <div class="accordion-item mb-3">
                        <h5 class="accordion-header" id="headingOne1">
                            <button
                                class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center pt-0"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1"
                                aria-expanded="false" aria-controls="collapseOne1">
                                <div class="m-0 flex-grow-1">
                                    <h6 class="m-0">Angsuran Pinjaman</h6>
                                    <p class="m-0 text-sm">Detail Jadwal Angsuran Pinjaman</p>
                                </div>
                                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                            </button>
                        </h5>
                        <div id="collapseOne1" class="accordion-collapse collapse show" aria-labelledby="headingOne1"
                            data-bs-parent="#accordionDocumentDetails">
                            <div class="accordion-body text-sm">

                                <div class="accordion mt-0 mb-3" id="accordionDocumentDetailsx">
                                    <div class="accordion-item mb-3 border border-info">
                                        <h5 class="accordion-header mt-3" id="headingOne1x">
                                            <button
                                                class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center pt-0"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1x"
                                                aria-expanded="false" aria-controls="collapseOne1x">
                                                <div class="m-0 flex-grow-1">
                                                    <a class="m-0 text-sm">{{ model.angsuran.kode_pinjaman }}</a>
                                                </div>
                                                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                                            </button>
                                        </h5>
                                        <div id="collapseOne1x" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne1" data-bs-parent="#accordionDocumentDetailsx">
                                            <div class="accordion-body text-sm">
                                                <!-- <div
                                                            class="form-check d-grid d-flex align-items-center justify-content-md-end mt-3 ms-3 mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                v-model="model.angsuranangsuran_accepted"
                                                                id="flexCheckDefault" disabled>
                                                            <label class="form-check-label mb-0 ms-2 text-bold"
                                                                for="flexCheckDefault"
                                                                :class="model.angsuranangsuran_accepted ? 'text-success' : 'text-danger'">
                                                                Plafond Accepted
                                                            </label>
                                                        </div> -->
                                                <div class="row g-2">
                                                    <div class="col-md">
                                                        <p class="mb-3 fs-5 text-dark text-center text-bold">
                                                            Data
                                                            Debitur</p>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" disabled
                                                                class="form-control border-0 bg-transparent shadow-none"
                                                                id="floatingLabel" placeholder="Judul Document"
                                                                v-model="model.nasabah.nama_lengkap" />
                                                            <label for="floatingLabel">Nama Nasabah</label>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text"
                                                                        class="form-control border-0 bg-transparent shadow-none"
                                                                        id="floatingLabel" placeholder="Judul Document"
                                                                        v-model="model.age_text_start" disabled />
                                                                    <label for="floatingLabel">Umur Awal</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text"
                                                                        class="form-control border-0 bg-transparent shadow-none"
                                                                        id="floatingLabel" placeholder="Judul Document"
                                                                        v-model="model.age_text_end" disabled />
                                                                    <label for="floatingLabel">Umur Akhir</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" disabled
                                                                class="form-control border-0 bg-transparent shadow-none"
                                                                id="floatingLabel" placeholder="Judul Document"
                                                                v-model="model.angsuran.norek" />
                                                            <label for="floatingLabel">Norek<span class="text-danger">
                                                                    *</span></label>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <select disabled
                                                                        class="form-select form-select-lg border-0 bg-transparent shadow-none"
                                                                        id="floatingCategory"
                                                                        aria-label="Floating label select example"
                                                                        v-model="model.angsuran.unit">
                                                                        <option disabled value="">Unit Layanan</option>
                                                                        <option
                                                                            v-for="(row, index) in collections.unit_id"
                                                                            :key="index" :value="row.code">
                                                                            {{ row.name }}
                                                                        </option>
                                                                    </select>
                                                                    <label for="floatingCategory">KNS Unit Layanan<span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <select disabled
                                                                        class="form-select form-select-lg border-0 bg-transparent shadow-none"
                                                                        id="floatingCategory"
                                                                        aria-label="Floating label select example"
                                                                        v-model="model.angsuran.fasilitas_id">
                                                                        <option disabled value="">Pilih Fasilitas
                                                                        </option>
                                                                        <option
                                                                            v-for="(row, index) in collections.facilities"
                                                                            :key="index" :value="row.code">
                                                                            {{ row.name }}
                                                                        </option>
                                                                    </select>
                                                                    <label for="floatingCategory">Fasilitas</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col-md-3">
                                                                <div class="form-floating mb-3">
                                                                    <input :disabled="!isEditing"
                                                                        :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'form-control'"
                                                                        placeholder="Nominal" id="floatingLabel"
                                                                        v-model="model.angsuran.provisi_percentage" />
                                                                    <label for="floatingLabel">Provisi (%)<span
                                                                            class="text-danger"> *</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm">
                                                                <div class="form-floating mb-3">
                                                                    <input :disabled="!isEditing"
                                                                        :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'form-control'"
                                                                        placeholder="Nominal" id="floatingLabel"
                                                                        v-model.lazy="model.angsuran.provisi_nominal"
                                                                        v-money="money" disabled />
                                                                    <label for="floatingLabel">Nominal Provisi<span
                                                                            class="text-danger"> *</span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <input :disabled="!isEditing"
                                                                        :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'form-control'"
                                                                        placeholder="Nominal" id="floatingLabel"
                                                                        v-model.lazy="model.angsuran.biaya_admin"
                                                                        v-money="money" />
                                                                    <label for="floatingLabel">Biaya Admin<span
                                                                            class="text-danger"> *</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <input :disabled="!isEditing"
                                                                        :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'form-control'"
                                                                        placeholder="Nominal" id="floatingLabel"
                                                                        v-model.lazy="model.angsuran.biaya_lain"
                                                                        v-money="money" />
                                                                    <label for="floatingLabel">Biaya Lain<span
                                                                            class="text-danger"> *</span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <p class="mb-3 fs-5 text-dark text-center text-bold">
                                                            Data
                                                            Pembiayaan</p>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" disabled
                                                                class="form-control border-0 bg-transparent shadow-none"
                                                                id="floatingLabel" placeholder="Judul Document"
                                                                v-model="model.angsuran.nomor_pensiunan" />
                                                            <label for="floatingLabel">Nomor Pensiunan<span class="text-danger">
                                                                    *</span></label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input :disabled="!isEditing"
                                                                :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'form-control'"
                                                                placeholder="Nominal" id="floatingLabel"
                                                                v-model.lazy="model.angsuran.nilai_plafond"
                                                                v-money="money" />
                                                            <label for="floatingLabel">Plafond Pembiayaan<span
                                                                    class="text-danger">
                                                                    *</span></label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="number" min="0" step="0.01"
                                                                :disabled="!isEditing"
                                                                :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'form-control'"
                                                                id="floatingLabel" placeholder="Judul Document"
                                                                v-model="model.angsuran.rate_bunga" />
                                                            <label for="floatingLabel">Suku Bunga Eff/pa
                                                                (%)<span class="text-danger">
                                                                    *</span></label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="number" min="0" :disabled="!isEditing"
                                                                :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'form-control'"
                                                                id="floatingLabel" placeholder="Judul Document"
                                                                v-model="model.angsuran.tenor" />
                                                            <label for="floatingLabel">Jangka Waktu (Bulan)<span
                                                                    class="text-danger">
                                                                    *</span></label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="date" :disabled="!isEditing"
                                                                :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'form-control'"
                                                                id="floatingLabel" placeholder="Judul Document"
                                                                v-model="model.angsuran.tanggal_mulai" />
                                                            <label for="floatingLabel">Tanggal PK / Akad<span
                                                                    class="text-danger">
                                                                    *</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 shadow-none">
                                                            <div class="form-floating flex-grow-1">
                                                                <input type="text" disabled
                                                                    :class="!isEditing ? 'form-control border-0 bg-transparent shadow-none' : 'bg-transparent form-control'"
                                                                    name="floatingLabel" placeholder="Nominal"
                                                                    v-model="displayedAngsuran" v-money="money">
                                                                <label for="floatingLabel">Angsuran per-bulan</label>
                                                            </div>
                                                            <a class="input-group-text btn mb-0 vertical-center"
                                                                :disabled="refreshAngsuranBtn"
                                                                :class="refreshAngsuranBtn ? 'btn-success' : 'btn-danger'"
                                                                v-show="isEditing" @click.prevent="calculateAngsuran"
                                                                style="z-index: 0;"><i
                                                                    class="fas fa-sync p-2 vertical-center"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-floating mb-3 text-center mt-3" v-show="isEditing">
                                                    <a class="btn text-center w-100" v-show="refreshAngsuranBtn"
                                                        :class="createdSchedule ? 'btn-success' : 'btn-warning'"
                                                        :disabled="createdSchedule"
                                                        @click.prevent="createScedule">Buat Jadwal Angsuran</a>
                                                </div>

                                                <div class="border border-1 border-primary rounded-top p-4">
                                                    <li
                                                        class="nav-item dropdown pe-2 d-flex align-items-center float-end">
                                                        <a href="javascript:;" class="nav-link text-body p-0"
                                                            id="dropdownMenuButtonProfile" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fas fa-download text-dark"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 shadow-lg"
                                                            aria-labelledby="dropdownMenuButtonProfile">
                                                            <li class="m-3">
                                                                <a class="text-dark text-sm" href="#"
                                                                    @click.prevent="convertToExcel">
                                                                    Excel
                                                                </a>
                                                            </li>
                                                            <li class="m-3">
                                                                <a class="text-dark" href="#"
                                                                    @click.prevent="convertToPDF">
                                                                    PDF
                                                                </a>
                                                            </li>
                                                            <li class="m-3">
                                                                <a class="text-dark" href="#"
                                                                    @click.prevent="convertToImg">
                                                                    Image
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <div id="table-angsuran">
                                                        <p class="mb-0 fs-5 text-dark text-center text-bold">
                                                            Jadwal
                                                            Angsuran Pinjaman
                                                        </p>
                                                        <p class="mb-0 text-sm text-dark text-center">Nama: {{
                                                            model.nasabah.nama_lengkap }}</p>
                                                        <div class="table-responsive w-100">
                                                            <table class="table table-hover table-bordered mt-3 mb-0">
                                                                <thead class="table-dark">
                                                                    <tr>
                                                                        <th width="5%" class="text-center">No
                                                                        </th>
                                                                        <th>Tanggal Bayar</th>
                                                                        <th class="text-end">Angsuran</th>
                                                                        <th class="text-end">Cicilan Pokok</th>
                                                                        <th class="text-end">Cicilan Bunga</th>
                                                                        <th class="text-end">Sisa Pokok</th>
                                                                        <th v-if="!isEditing" class="text-end">Outstanding</th>
                                                                        <!-- <th class="text-center">Status
                                                                            Pembayaran</th> -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr
                                                                        style="background-color: cadetblue; border-color: cadetblue; color: white;">
                                                                        <td></td>
                                                                        <td class="ps-4 align-middle text-xs py-3">
                                                                            {{ new
                                                                                Date(model.angsuran.tanggal_mulai).toLocaleString('en-GB',
                                                                                    {
                                                                                        day: 'numeric', month:
                                                                                            'long', year: 'numeric'
                                                                                    }) }}
                                                                        </td>
                                                                        <td class="text-end ps-4 align-middle text-xs"
                                                                            colspan="4">
                                                                            {{ model.angsuran.nilai_plafond }}
                                                                        </td>
                                                                        <td class="text-end ps-4 align-middle text-xs" v-if="!isEditing"></td>
                                                                    </tr>
                                                                    <tr v-for="(det, n) in model.angsuran.angsuran_pinjaman_detail"
                                                                        :key="n" class="align-items-center">
                                                                        <td
                                                                            class="text-center align-middle text-xs p-3">
                                                                            {{ det.periode_ke }}
                                                                        </td>
                                                                        <td class="ps-4 align-middle text-xs">
                                                                            {{ new
                                                                                Date(det.tanggal_jatuh_tempo).toLocaleString('en-GB',
                                                                                    {
                                                                                        day: 'numeric', month:
                                                                                            'long', year: 'numeric'
                                                                                    }) }}
                                                                        </td>
                                                                        <td class="text-end align-middle text-xs">
                                                                            {{ formatRupiah(det.nilai_angsuran) }}
                                                                        </td>
                                                                        <td class="text-end align-middle text-xs">
                                                                            {{ formatRupiah(det.cicilan_pokok)
                                                                            }}
                                                                        </td>
                                                                        <td class="text-end align-middle text-xs">
                                                                            {{ formatRupiah(det.cicilan_bunga)
                                                                            }}
                                                                        </td>
                                                                        <td class="text-end align-middle text-xs">
                                                                            {{ formatRupiah(det.nilai_pokok)
                                                                            }}
                                                                        </td>
                                                                        <td v-if="!isEditing" class="text-end align-middle text-xs">
                                                                            {{ formatRupiah(det.outstanding_angsuran)
                                                                            }}
                                                                        </td>
                                                                        <!-- <td class="text-center align-middle text-xs">
                                                                            -
                                                                        </td> -->
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-absolute end-0 bottom-0 me-3 z-index-3">
                    <button v-if="!loading && !isEditing" type="button" class="btn btn-secondary rounded-1 me-3"
                        @click.prevent="resetForm">
                        Close
                    </button>
                    <button v-if="!loading && !isEditing" type="button" class="btn btn-warning rounded-1"
                        @click.prevent="editForm">
                        Edit
                    </button>
                    <button v-if="!loading && isEditing" type="button" class="btn btn-warning rounded-1 me-3"
                        @click.prevent="cancelEdit">
                        Cancel
                    </button>
                    <button v-if="!loading && isEditing" type="button" class="btn btn-primary rounded-1"
                        @click.prevent="confirmUpdate">
                        Save
                    </button>
                    <button v-if="loading" class="btn btn-primary" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { VMoney } from 'v-money'
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../../../../eventEmitter.js';
import ExcelJS from 'exceljs';
import html2canvas from 'html2canvas';
export default {
    directives: { money: VMoney },
    data() {
        return {
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'Rp. ',
                suffix: '',
                precision: 0,
                masked: false
            },
            role: '',
            collections: {
                categories: []
            },
            model: {
                nasabah: {
                    nik: '',
                    nama_lengkap: '',
                    tempat_lahir: '',
                    tanggal_lahir: '',
                    jenis_kelamin: '',
                    alamat: '',
                    no_telepon: '',
                    foto_profil: '',
                    foto_ktp: '',
                    foto_profil_preview: '',
                    foto_ktp_preview: '',
                },
                angsuran: {
                    schedule_angsuran_created: false,
                    angsuran_accepted: false,
                    unit_id: '',
                    fasilitas_id: '',
                    nilai_plafond: 0,
                    rate_bunga: 0,
                    tenor: 0,
                    tanggal_mulai: '',
                    nilai_angsuran: 0,
                    details: [],
                },
            },
            displayedAngsuran: 0,
            createdSchedule: true,
            currentQrcode: '',
            preview: '',
            modalDetailPreview: '',
            offcanvasDetail: '',
            isEditing: false,
            loading: false,
            refreshAngsuranBtn: false
        };
    },
    mounted() {
        emitter.on('detailPinjaman', ([id, role]) => {
            console.log('oke')
            this.role = role
            this.modalDetailPreview = new bootstrap.Modal('#exampledetailModal', {
                backdrop: false,
                keyboard: false,
            })
            this.offcanvasDetail = new bootstrap.Offcanvas('#offcanvasDetailRight', {
                backdrop: false,
                keyboard: false,
            })
            this.fetchPinjaman(id);
            // this.fetchCategories();
        });

        emitter.on('moveToDetailEdit', (id) => {
            this.offcanvasDetail = new bootstrap.Offcanvas('#offcanvasDetailRight', {
                backdrop: false,
                keyboard: false,
            })
            this.fetchPinjaman(id);
            this.editForm();
        });
    },
    methods: {
        confirmUpdate() {
            // if (this.model.nasabah.alamat == '') {
            //     Swal.fire('Kesalahan', 'Alamat nasabah harus diisi.', 'error')
            //     return false
            // }
            console.log('confirm', this.model)
            Swal.fire({
                title: 'Simpan perubahan data nasabah?',
                text: "Pastikan data yang anda simpan sudah benar",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Simpan'
            }).then((result) => {
                if (result.value) {
                    this.update()
                }
            })
        },
        async update() {
            this.loading = true
            let endpoint = `${BASEURL}/api/angsuran-pinjaman/${this.model.angsuran.id}?_method=PUT`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    text: 'Sedang diproses, mohon ditunggu..',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.post(endpoint, this.model.angsuran, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
                Swal.close()
                if (response) {
                    this.loading = false
                    Swal.fire({
                        title: 'Perubahan Berhasil Disimpan. Print?',
                        text: "Apakah anda ingin print qrcode sekarang?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Print'
                    }).then((result) => {
                        if (result.value) {
                            this.viewCurrentQRCode(this.model.number)
                        } else {
                            this.closeComponent()
                        }
                    })
                }
            } catch (error) {
                this.loading = false
                console.error("Error store docs: ", error);
                let errormsg = ''
                if (error.response && error.response.data && typeof error.response.data.message === 'object') {
                    Object.keys(error.response.data.message).forEach(key => {
                        errormsg += `${key}: ${error.response.data.message[key]} \n`;
                    });
                } else {
                    errormsg = error.response.data.message || 'An unknown error occurred.';
                }
                this.$swal.fire({
                    title: 'Failed!',
                    text: errormsg,
                    icon: 'error'
                })
            }
        },
        async calculateAngsuran() {
            if (
                this.model.angsuran.nilai_plafond !== 0 &&
                this.model.angsuran.rate_bunga !== 0 &&
                this.model.angsuran.rate_bunga !== '' &&
                this.model.angsuran.tenor !== 0 &&
                this.model.angsuran.tenor !== ''
            ) {
                const annualInterestRate = this.model.angsuran.rate_bunga / 100;
                const months = this.model.angsuran.tenor;
                const principal = parseFloat(this.model.angsuran.nilai_plafond.replace(/Rp\.|\./g, ''));

                const monthlyInterestRate = annualInterestRate / 12;

                this.model.angsuran.nilai_angsuran = principal * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, months) / (Math.pow(1 + monthlyInterestRate, months) - 1);
                this.displayedAngsuran = Math.round(this.model.angsuran.nilai_angsuran);
                this.model.angsuran.nilai_angsuran = parseFloat(this.model.angsuran.nilai_angsuran);

                this.refreshAngsuranBtn = true
            }
        },
        async createScedule() {
            console.log(this.refreshAngsuranBtn)
            if (this.refreshAngsuranBtn) {
                this.model.angsuran.angsuran_pinjaman_detail = []
                let endpoint = `${BASEURL}/api/simulation`;
                let response = await axios.post(endpoint, this.model.angsuran, {
                    headers: {
                        Authorization: "Bearer " + this.$token(),
                        "Content-Type": "multipart/form-data",
                    },
                });
                console.log(response.data.simulation);
                this.model.angsuran.angsuran_pinjaman_detail = response.data.simulation;
                this.createdSchedule = true
            }
        },
        editForm() {
            this.isEditing = true
        },
        cancelEdit() {
            this.isEditing = false
            this.fetchPinjaman(this.model.angsuran.id)
        },
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                currencyDisplay: 'symbol',
                maximumFractionDigits: 0
            }).format(value);
        },
        async fetchPinjaman(id) {
            let endpoint = `${BASEURL}/api/angsuran-pinjaman/${id}`
            try {
                Swal.showLoading();
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.model = response.data.data
                this.model.angsuran.nilai_angsuran = parseInt(this.model.angsuran.nilai_angsuran)
                this.model.angsuran.nilai_plafond = parseInt(this.model.angsuran.nilai_plafond)
                this.model.angsuran.biaya_admin = parseInt(this.model.angsuran.biaya_admin)
                this.model.angsuran.provisi_nominal = parseInt(this.model.angsuran.provisi_nominal)
                this.model.angsuran.biaya_lain = parseInt(this.model.angsuran.biaya_lain)
                this.displayedAngsuran = this.model.angsuran.nilai_angsuran
                this.refreshAngsuranBtn = true
                this.createdSchedule = true
                Swal.close()
                this.offcanvasDetail.show()
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
                return false
            }
        },
        showFilePreview(index) {
            if (this.model.details[index].file) {
                this.preview = this.model.details[index]
                this.modalDetailPreview.show()
            }
        },
        formatDate(dateString) {
            const date = new Date(dateString);

            const options = {
                weekday: 'long',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            };

            return date.toLocaleString('id-ID', options);
        },
        resetForm() {
            let closeOffcanvas = document.querySelector('#offcanvasDetailRight [data-bs-dismiss="offcanvas"]');
            closeOffcanvas.click();
            this.isEditing = false
            this.model.details = []
            this.model.number = ''
            this.model.label = ''
            this.model.category_id = ''
            this.model.description = ''
        },
        refreshAngsuran() {
            this.refreshAngsuranBtn = false
            this.createdSchedule = false
        }
    },
    watch: {
        'model.angsuran.nilai_plafond': function () {
            this.refreshAngsuran()
        },
        'model.angsuran.rate_bunga': function () {
            this.refreshAngsuran()
        },
        'model.angsuran.tenor': function () {
            this.refreshAngsuran()
        },
        'model.angsuran.tanggal_mulai': function () {
            this.refreshAngsuran()
        },
    },
}
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

ul.timeline {
    list-style-type: none;
    position: relative;
}

ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    /* left: 29px; */
    width: 2px;
    height: 100%;
    z-index: 400;
}

ul.timeline>li {
    /* margin: 20px 0; */
    padding-left: 20px;
}

ul.timeline>li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 3px;
    /* left: 20px; */
    width: 20px;
    height: 20px;
    z-index: 400;
}

.embed-cover {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: calc(100% - 15px);
    opacity: 0;
    background-color: red;
}

.wrapper {
    position: relative;
    overflow: hidden;
}
</style>