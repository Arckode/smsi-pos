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
        data-bs-keyboard="false" aria-labelledby="offcanvasDetailRightLabel" style="background-color: whitesmoke;">
        <div class="offcanvas-header p-0 mx-6 mt-5 pb-3 border-bottom border-1">
            <h5 id="offcanvasDetailRightLabel m-0">Detail Nasabah</h5>
            <button type="button" class="btn-close btn-close-white" @click="closeComponent" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-6 pt-4">
            <form>
                <div class="accordion" id="accordionDocumentLabels">
                    <div class="accordion-item mb-3 border border-1 rounded-3" style="background-color: white;">
                        <h5 class="accordion-header" id="headingOne">
                            <button class="accordion-button border-bottom font-weight-bold collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne" style="border-bottom: 0 !important;">
                                <div class="m-0 flex-grow-1">
                                    <h6 class="m-0">Biodata</h6>
                                    <p class="m-0 text-sm">Informasi mengenai nasabah</p>
                                </div>
                                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                            </button>
                        </h5>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionDocumentLabels">
                            <div class="accordion-body text-sm border-top p-6">
                                <div class="d-flex">
                                    <div class="d-grid d-flex align-items-center justify-content-md-center">
                                        <div class="cards shadow-none" :data-animation="isEditingNasabah ? 'true' : 'false'">
                                            <!-- <div class="d-flex justify-content-center">
                                                <h6 class="mt-3">
                                                    Foto Nasabah
                                                </h6>
                                            </div> -->
                                            <div class="cards-header p-0 position-relative mx-3 z-index-2">
                                                <a class="d-block blur-shadow-image">
                                                    <img v-if="model.nasabah.foto_profil_preview"
                                                        :src="asset(`/storage/${model.nasabah.foto_profil_preview}`)"
                                                        class="rounded-3 img-fluid" alt="Foto Nasabah"
                                                        style="width: auto; height: 300px; object-fit: cover;">
                                                </a>
                                            </div>
                                            <div class="cards-body text-center">
                                                <div v-if="isEditingNasabah" class="d-flex mt-n6 mx-auto">
                                                    <a class="btn btn-link text-primary ms-auto border-0"
                                                        @click="confirmDeleteCarousel" title="Refresh">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <button class="btn btn-link text-info me-auto border-0"
                                                        data-bs-toggle="modal" data-bs-target="#editCarouselModal"
                                                        title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid d-flex align-items-center justify-content-md-center">
                                        <div class="cards shadow-none" :data-animation="isEditingNasabah ? 'true' : 'false'">
                                            <!-- <div class="d-flex justify-content-center">
                                                <h6 class="mt-3">
                                                    KTP
                                                </h6>
                                            </div> -->
                                            <div class="cards-header p-0 position-relative mx-3 z-index-2">
                                                <a class="d-block blur-shadow-image">
                                                    <img v-if="model.nasabah.foto_ktp_preview"
                                                        :src="asset(`/storage/${model.nasabah.foto_ktp_preview}`)"
                                                        class="rounded-2 img-fluid" alt="Foto KTP"
                                                        style="width: auto; height: 300px; object-fit: cover;">
                                                </a>
                                            </div>
                                            <div class="cards-body text-center">
                                                <div v-if="isEditingNasabah" class="d-flex mt-n6 mx-auto">
                                                    <a class="btn btn-link text-primary ms-auto border-0"
                                                        @click="confirmDeleteCarousel" title="Refresh">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <button class="btn btn-link text-info me-auto border-0"
                                                        data-bs-toggle="modal" data-bs-target="#editCarouselModal"
                                                        title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="d-flex justify-content-between align-items-center p-3 bluish rounded-3">
                                    <div class="form-check form-switch ms-1 mb-0">
                                        <input class="form-check-input d-flex align-items-center" style="height: 20px;"
                                            type="checkbox" id="flexSwitchCheckCheckedx"
                                            v-model="model.nasabah.is_executing" true-value="1" false-value="0"
                                            :disabled="!isEditingNasabah">
                                        <label class="form-check-label mb-0 ms-0 text-white"
                                            for="flexSwitchCheckCheckedx">{{
                                                model.nasabah.is_executing
                                                    ? 'Executing' : 'Channeling' }}</label>
                                    </div>

                                    <div>
                                        <button v-if="!loading && !isEditingNasabah" type="button"
                                            class="btn btn-warning rounded-1 mb-0" @click.prevent="editForm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button v-if="!loading && isEditingNasabah" type="button"
                                            class="btn btn-light rounded-1 me-3 mb-0" @click.prevent="cancelEdit">
                                            Cancel
                                        </button>
                                        <button v-if="!loading && isEditingNasabah" type="button"
                                            class="btn btn-success rounded-1 mb-0" @click.prevent="confirmUpdate">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button v-if="loading" class="btn btn-primary mb-0" type="button" disabled>
                                            <span class="spinner-grow spinner-grow-sm" role="status"
                                                aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-4 g-3">
                                    <div class="col-sm border border-1 rounded-3 p-3 mx-2">
                                        <div class="row g-2 mb-3">
                                            <div class="col-md">
                                                <div class="form-floating mb-3">
                                                    <input type="text" :disabled="!isEditingNasabah"
                                                        :class="!isEditingNasabah ? 'text-lg form-control border-0 bg-transparent shadow-none' : 'text-lg form-control'"
                                                        id="floatingLabel" placeholder="Judul Document"
                                                        v-model="model.nasabah.nama_lengkap" />
                                                    <label class="ms-0" for="floatingLabel">Nama Lengkap<span class="text-danger">
                                                            *</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating mb-3">
                                                    <input type="text" :disabled="!isEditingNasabah"
                                                        :class="!isEditingNasabah ? 'text-lg form-control border-0 bg-transparent shadow-none' : 'text-lg form-control'"
                                                        id="floatingLabel" placeholder="Judul Document"
                                                        v-model="model.nasabah.nik" />
                                                    <label for="floatingLabel">NIK<span class="text-danger">
                                                            *</span></label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row g-2 mb-3">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="text" :disabled="!isEditingNasabah"
                                                        :class="!isEditingNasabah ? 'text-lg form-control border-0 bg-transparent shadow-none' : 'text-lg form-control'"
                                                        id="floatingLabel" placeholder="Kota lahir"
                                                        v-model="model.nasabah.tempat_lahir">
                                                    <label for="floatingInputGrid">Kota<span class="text-danger">
                                                            *</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="date" :disabled="!isEditingNasabah"
                                                        :class="!isEditingNasabah ? 'text-lg form-control border-0 bg-transparent shadow-none' : 'text-lg form-control'"
                                                        id="floatingInputGrid" placeholder="Tanggal Lahir"
                                                        v-model="model.nasabah.tanggal_lahir">
                                                    <label for="floatingSelectGrid">Tanggal Lahir<span
                                                            class="text-danger">
                                                            *</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" :disabled="!isEditingNasabah"
                                                :class="!isEditingNasabah ? 'text-lg form-control border-0 bg-transparent shadow-none' : 'text-lg form-control'"
                                                id="floatingLabel" placeholder="Judul Document"
                                                v-model="model.nasabah.no_telepon" />
                                            <label for="floatingLabel">Nomor Telfon<span class="text-danger">
                                                    *</span></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea :disabled="!isEditingNasabah"
                                                :class="!isEditingNasabah ? 'text-lg form-control border-0 bg-transparent shadow-none' : 'text-lg form-control'"
                                                placeholder="Leave a comment here" id="adddoclistfloatingDescription"
                                                style="height: 100px" v-model="model.nasabah.alamat"></textarea>
                                            <label for="adddoclistfloatingDescription">Alamat<span class="text-danger">
                                                    *</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md border border-1 rounded-3 p-3 mx-2">
                                        <div class="ms-1 mb-3">
                                            <label>Pensiunan<span class="text-danger"> *</span></label>
                                            <br>
                                            <div class="form-check form-check-inline text-lg">
                                                <input :disabled="!isEditingNasabah"
                                                    class="form-check-input d-flex align-items-center justify-content-center mt-0"
                                                    type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                                    value="Taspen" v-model="model.nasabah.pensiun">
                                                <label class="form-check-label text-lg" for="inlineRadio1">Taspen</label>
                                            </div>
                                            <div class="form-check form-check-inline text-lg">
                                                <input :disabled="!isEditingNasabah"
                                                    class="form-check-input d-flex align-items-center justify-content-center mt-0"
                                                    type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                                    value="Asabri" v-model="model.nasabah.pensiun">
                                                <label class="form-check-label text-lg" for="inlineRadio2">Asabri</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-check form-switch ms-1">
                                                <input :disabled="!isEditingNasabah"
                                                    class="form-check-input d-flex align-items-center"
                                                    style="height: 20px;" type="checkbox" id="flexSwitchCheckCheckedx"
                                                    v-model="model.nasabah.flagging">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckCheckedx">Flagging</label>
                                            </div>
                                            <div class="form">
                                                <input :disabled="!isEditingNasabah" class="form-control"
                                                    id="floatingInputGrid" placeholder="Nominal Flagging"
                                                    v-model.lazy="model.nasabah.flagging_nominal" v-money="money">
                                            </div>
                                        </div>
                                        <!-- <div class="d-grid d-flex align-items-center justify-content-md-center">
                                            <div class="cards shadow-none"
                                                :data-animation="isEditing ? 'true' : 'false'">
                                                <div class="d-flex justify-content-center">
                                                    <h6 class="mt-3">
                                                        Foto Nasabah
                                                    </h6>
                                                </div>
                                                <div class="cards-header p-0 position-relative mx-3 z-index-2">
                                                    <a class="d-block blur-shadow-image">
                                                        <img v-if="model.nasabah.foto_profil_preview"
                                                            :src="asset(`/storage/${model.nasabah.foto_profil_preview}`)"
                                                            class="rounded-2 img-fluid" alt="Foto Nasabah"
                                                            style="width: auto; height: 300px; object-fit: cover;">
                                                    </a>
                                                </div>
                                                <div class="cards-body text-center">
                                                    <div v-if="isEditing" class="d-flex mt-n6 mx-auto">
                                                        <a class="btn btn-link text-primary ms-auto border-0"
                                                            @click="confirmDeleteCarousel" title="Refresh">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <button class="btn btn-link text-info me-auto border-0"
                                                            data-bs-toggle="modal" data-bs-target="#editCarouselModal"
                                                            title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid d-flex align-items-center justify-content-md-center">
                                            <div class="cards shadow-none"
                                                :data-animation="isEditing ? 'true' : 'false'">
                                                <div class="d-flex justify-content-center">
                                                    <h6 class="mt-3">
                                                        KTP
                                                    </h6>
                                                </div>
                                                <div class="cards-header p-0 position-relative mx-3 z-index-2">
                                                    <a class="d-block blur-shadow-image">
                                                        <img v-if="model.nasabah.foto_ktp_preview"
                                                            :src="asset(`/storage/${model.nasabah.foto_ktp_preview}`)"
                                                            class="rounded-2 img-fluid" alt="Foto KTP"
                                                            style="width: auto; height: 300px; object-fit: cover;">
                                                    </a>
                                                </div>
                                                <div class="cards-body text-center">
                                                    <div v-if="isEditing" class="d-flex mt-n6 mx-auto">
                                                        <a class="btn btn-link text-primary ms-auto border-0"
                                                            @click="confirmDeleteCarousel" title="Refresh">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <button class="btn btn-link text-info me-auto border-0"
                                                            data-bs-toggle="modal" data-bs-target="#editCarouselModal"
                                                            title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- <div v-if="model.angsuran.schedule_angsuran_created" class="accordion mt-0 mb-6" -->
                <div class="accordion mt-4" id="accordionDocumentDetails" v-if="model.angsuran.length != 0">
                    <div class="accordion-item border border-1 rounded-3" style="background-color: white;">
                        <h5 class="accordion-header" id="headingOne1">
                            <button
                                class="accordion-button border-bottom font-weight-bold collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1"
                                aria-controls="collapseOne1" style="border-bottom: 0 !important;">
                                <div class="m-0 flex-grow-1">
                                    <h6 class="m-0">Angsuran Pinjaman</h6>
                                    <p class="m-0 text-sm">Detail Jadwal Angsuran Pinjaman</p>
                                </div>
                                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                            </button>
                        </h5>
                        <div id="collapseOne1" class="accordion-collapse collapse show" aria-labelledby="headingOne1"
                            data-bs-parent="#accordionDocumentDetails">
                            <div class="accordion-body m-4 mt-0 p-0 text-sm">

                                <div v-if="model.angsuran.length > 0">
                                    <div v-for="(detail, index) in model.angsuran" :key="index">
                                        <div class="accordion mt-0" :id="`accordionDocumentDetails-${index}`">
                                            <div class="accordion-item border border-info">
                                                <h5 class="accordion-header p-1 bluish" :id="`headingOne1-${index}`">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button
                                                            class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center"
                                                            type="button" data-bs-toggle="collapse"
                                                            :data-bs-target="`#collapseOne1-${index}`" aria-expanded="false"
                                                            aria-controls="collapseOne1-{{index}}"
                                                            style="border-bottom: 0 !important;">
                                                            <div class="m-0 flex-grow-1">
                                                                <a class="m-0 text-sm text-white">{{ detail.nomor_pensiunan }}</a>
                                                            </div>
                                                        </button>
                                                        <a class="btn btn-warning border-0 mb-0 me-3"
                                                            v-if="!isEditingNasabah"
                                                            @click.prevent="openEditPinjaman(detail.id)">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </div>
                                                </h5>
                                                <div :id="`collapseOne1-${index}`" class="accordion-collapse collapse p-4"
                                                    aria-labelledby="`headingOne1-${index}`"
                                                    :data-bs-parent="`#accordionDocumentDetails-${index}`">
                                                    <div class="accordion-body pt-0">

                                                        <div class="row g-2">
                                                            <div class="col-md border rounded-3 mb-3 mx-2">
                                                                <p class="mb-3 mt-3 fs-5 text-dark text-center text-bold">
                                                                    Data Debitur
                                                                </p>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" disabled
                                                                        class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                        id="floatingLabel" placeholder="Judul Document"
                                                                        v-model="model.nasabah.nama_lengkap" />
                                                                    <label for="floatingLabel">Nama Nasabah</label>
                                                                </div>
                                                                <div class="row g-2">
                                                                    <div class="col-md">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text"
                                                                                class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                                id="floatingLabel"
                                                                                placeholder="Judul Document"
                                                                                v-model="model.age_text_start"
                                                                                disabled />
                                                                            <label for="floatingLabel">Umur Awal</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text"
                                                                                class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                                id="floatingLabel"
                                                                                placeholder="Judul Document"
                                                                                v-model="model.age_text_end" disabled />
                                                                            <label for="floatingLabel">Umur
                                                                                Akhir</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" disabled
                                                                        class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                        id="floatingLabel" placeholder="Judul Document"
                                                                        v-model="detail.norek" />
                                                                    <label for="floatingLabel">Norek<span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                </div>F
                                                                <div class="row g-2">
                                                                    <div class="col-md">
                                                                        <div class="form-floating mb-3">
                                                                            <select disabled
                                                                                class="form-select form-select-lg border-0 bg-transparent shadow-none text-lg"
                                                                                id="floatingCategory"
                                                                                aria-label="Floating label select example"
                                                                                v-model="detail.unit">
                                                                                <option disabled value="">Unit Layanan
                                                                                </option>
                                                                                <option
                                                                                    v-for="(row, index) in collections.unit_id"
                                                                                    :key="index" :value="row.code">
                                                                                    {{ row.name }}
                                                                                </option>
                                                                            </select>
                                                                            <label for="floatingCategory">KNS Unit
                                                                                Layanan<span class="text-danger">
                                                                                    *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-floating mb-3">
                                                                            <select disabled
                                                                                class="form-select form-select-lg border-0 bg-transparent shadow-none text-lg"
                                                                                id="floatingCategory"
                                                                                aria-label="Floating label select example"
                                                                                v-model="detail.fasilitas_id">
                                                                                <option disabled value="">Pilih
                                                                                    Fasilitas
                                                                                </option>
                                                                                <option
                                                                                    v-for="(row, index) in collections.facilities"
                                                                                    :key="index" :value="row.code">
                                                                                    {{ row.name }}
                                                                                </option>
                                                                            </select>
                                                                            <label
                                                                                for="floatingCategory">Fasilitas</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    <div class="row g-2">
                                                                        <div class="col-md">
                                                                            <div class="form-floating mb-3">
                                                                                <input disabled
                                                                                    class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                                    placeholder="Nominal"
                                                                                    id="floatingLabel"
                                                                                    v-model="detail.provisi_percentage" />
                                                                                <label for="floatingLabel">Provisi
                                                                                    (%)<span class="text-danger">
                                                                                        *</span></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md">
                                                                            <div class="form-floating mb-3">
                                                                                <input
                                                                                    class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                                    placeholder="Nominal"
                                                                                    id="floatingLabel"
                                                                                    v-model.lazy="detail.provisi_nominal"
                                                                                    v-money="money" disabled />
                                                                                <label for="floatingLabel">Nominal
                                                                                    Provisi<span class="text-danger">
                                                                                        *</span></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <div class="row g-2">
                                                                    <div class="col-md">
                                                                        <div class="form-floating mb-3">
                                                                            <input disabled
                                                                                class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                                placeholder="Nominal" id="floatingLabel"
                                                                                v-model.lazy="detail.biaya_admin"
                                                                                v-money="money" />
                                                                            <label for="floatingLabel">Biaya Admin<span
                                                                                    class="text-danger">
                                                                                    *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-floating mb-3">
                                                                            <input disabled
                                                                                class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                                placeholder="Nominal" id="floatingLabel"
                                                                                v-model.lazy="detail.biaya_lain"
                                                                                v-money="money" />
                                                                            <label for="floatingLabel">Biaya Lain<span
                                                                                    class="text-danger">
                                                                                    *</span></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md border rounded-3 mb-3 mx-2">
                                                                <p class="mb-3 mt-3 fs-5 text-dark text-center text-bold">
                                                                    Data
                                                                    Pembiayaan</p>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" disabled
                                                                        class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                        id="floatingLabel" placeholder="Judul Document"
                                                                        v-model="detail.nomor_pensiunan" />
                                                                    <label for="floatingLabel">Nomor Pensiunan<span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input disabled
                                                                        class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                        placeholder="Nominal" id="floatingLabel"
                                                                        v-model.lazy="detail.nilai_plafond"
                                                                        v-money="money" />
                                                                    <label for="floatingLabel">Plafond Pembiayaan<span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" min="0" step="0.01" disabled
                                                                        class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                        id="floatingLabel" placeholder="Judul Document"
                                                                        v-model="detail.rate_bunga" />
                                                                    <label for="floatingLabel">Suku Bunga Eff/pa
                                                                        (%)<span class="text-danger">
                                                                            *</span></label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" min="0" :disabled="!isEditingNasabah"
                                                                        disabled
                                                                        class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                        id="floatingLabel" placeholder="Judul Document"
                                                                        v-model="detail.tenor" />
                                                                    <label for="floatingLabel">Jangka Waktu (Bulan)<span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="date" disabled
                                                                        class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                        id="floatingLabel" placeholder="Judul Document"
                                                                        v-model="detail.tanggal_mulai" />
                                                                    <label for="floatingLabel">Tanggal PK / Akad<span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                </div>
                                                                <div class="input-group mb-3 shadow-none">
                                                                    <div class="form-floating flex-grow-1">
                                                                        <input type="text" disabled
                                                                            class="form-control border-0 bg-transparent shadow-none text-lg"
                                                                            name="floatingLabel" placeholder="Nominal"
                                                                            v-model="detail.nilai_angsuran"
                                                                            v-money="money">
                                                                        <label for="floatingLabel">Angsuran
                                                                            per-bulan</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="border border-1 p-4 mt-3">
                                                            <li
                                                                class="nav-item dropdown pe-2 d-flex align-items-center float-end">
                                                                <a href="javascript:;" class="nav-link text-body p-0"
                                                                    id="dropdownMenuButtonProfile"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                                                                    Jadwal Angsuran Pinjaman
                                                                </p>
                                                                <p class="mb-0 text-dark text-center text-md">Nama: {{
                                                                    model.nasabah.nama_lengkap }}</p>
                                                                <div class="table-responsive w-100" style="height: 600px; overflow-y: auto;">
                                                                    <table
                                                                        class="table table-dark table-striped table-hover table-bordered mt-3 mb-0">
                                                                        <thead class="table-dark sticky-header-table">
                                                                            <tr>
                                                                                <th width="5%" class="text-center">Periode
                                                                                </th>
                                                                                <th>Tanggal Bayar</th>
                                                                                <th class="text-end">Angsuran</th>
                                                                                <th class="text-end">Cicilan Pokok</th>
                                                                                <th class="text-end">Cicilan Bunga</th>
                                                                                <th class="text-end">Sisa Pokok</th>
                                                                                <th class="text-end">Outstanding</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="border-dark">
                                                                                <td></td>
                                                                                <td class=" ps-4 align-middle text-lg">
                                                                                    {{ new
                                                                                        Date(detail.tanggal_mulai).toLocaleString('en-GB',
                                                                                            {
                                                                                                day: 'numeric', month: 'long',
                                                                                                year: 'numeric'
                                                                                            }) }}
                                                                                </td>
                                                                                <td class="text-end ps-4 align-middle text-lg"
                                                                                    colspan="4">
                                                                                    {{ detail.nilai_plafond }}
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr v-for="(det, n) in detail.angsuran_pinjaman_detail"
                                                                                :key="n" class="align-items-center">
                                                                                <td
                                                                                    class="text-center align-middle text-lg p-3">
                                                                                    {{ det.periode_ke }}
                                                                                </td>
                                                                                <td class="ps-4 align-middle text-lg">
                                                                                    {{ new
                                                                                        Date(det.tanggal_jatuh_tempo).toLocaleString('en-GB',
                                                                                            {
                                                                                                day: 'numeric', month: 'long',
                                                                                                year: 'numeric'
                                                                                            }) }}
                                                                                </td>
                                                                                <td
                                                                                    class="text-end align-middle text-lg">
                                                                                    {{ formatRupiah(det.nilai_angsuran)
                                                                                    }}
                                                                                </td>
                                                                                <td
                                                                                    class="text-end align-middle text-lg">
                                                                                    {{ formatRupiah(det.cicilan_pokok)
                                                                                    }}
                                                                                </td>
                                                                                <td
                                                                                    class="text-end align-middle text-lg">
                                                                                    {{ formatRupiah(det.cicilan_bunga)
                                                                                    }}
                                                                                </td>
                                                                                <td
                                                                                    class="text-end align-middle text-lg">
                                                                                    {{ formatRupiah(det.nilai_pokok) }}
                                                                                </td>
                                                                                <td
                                                                                    class="text-end align-middle text-lg">
                                                                                    {{
                                                                                        formatRupiah(det.outstanding_angsuran)
                                                                                    }}
                                                                                </td>
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
                    </div>
                </div>
                <div>
                    <div class="form-floating mt-3 text-center" v-show="!createdSchedule">
                        <a class="btn text-center w-100" :class="createdSchedule ? 'btn-success' : 'btn-warning'"
                            @click.prevent="openCreatePinjaman">Buat Angsuran Pinjaman Baru</a>
                    </div>
                </div>

                <!-- <div class="position-absolute end-0 bottom-0 me-3 z-index-3">
                    <button v-if="!loading && !isEditing" type="button" class="btn btn-secondary rounded-1 me-3"
                        @click.prevent="closeComponent">
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
                </div> -->
            </form>
        </div>
    </div>
</template>

<script>
import { VMoney } from 'v-money'
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../../../eventEmitter.js';
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
                precision: 2,
                masked: false
            },
            collections: {
                categories: []
            },
            model: {
                nasabah: {
                    is_executing: false,
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
                    nomor_pensiunan: '',
                    norek: '',
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
            age_text_start: '',
            age_text_end: '',
            currentQrcode: '',
            preview: '',
            offcanvasDetail: '',
            isEditingNasabah: false,
            loading: false,
        };
    },
    mounted() {
        emitter.on('detailNasabah', (id) => {
            this.offcanvasDetail = new bootstrap.Offcanvas('#offcanvasDetailRight', {
                backdrop: false,
                keyboard: false,
            })
            this.fetchNasabah(id);
        });
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        getImageUrl(imagePath) {
            if (!imagePath) {
                return null; // Or a default image path
            }
            return '/public/' + imagePath; // Construct the correct URL
        },
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                currencyDisplay: 'symbol',
                maximumFractionDigits: 0
            }).format(value);
        },
        calculateAge(birthDate) {
            let today = new Date();
            let birth = new Date(birthDate);

            let years = today.getFullYear() - birth.getFullYear();
            let months = today.getMonth() - birth.getMonth();
            let days = today.getDate() - birth.getDate();

            if (days < 0) {
                months--;
                let lastDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
                days += lastDayOfMonth;
            }

            if (months < 0) {
                years--;
                months += 12;
            }

            this.model.nasabah.age_year = years;
            this.model.nasabah.age_month = months;
            this.model.nasabah.age_day = days;

            this.model.age_text_start = `${this.model.nasabah.age_year} Tahun, ${this.model.nasabah.age_month} bulan, ${this.model.nasabah.age_day} hari`;
        },
        addMonths() {
            let newDate = new Date(this.model.nasabah.tanggal_lahir);
            let birthDate = new Date(this.model.nasabah.tanggal_lahir);
            newDate.setMonth(newDate.getMonth() + this.model.angsuran[0] ? this.model.angsuran[0].tenor : 0);

            let newYears = newDate.getFullYear() - birthDate.getFullYear();
            let newMonths = newDate.getMonth() - birthDate.getMonth();
            let newDays = newDate.getDate() - birthDate.getDate();
            if (newDays < 0) {
                newMonths--;
                let lastDayOfMonth = new Date(newDate.getFullYear(), newDate.getMonth(), 0).getDate();
                newDays += lastDayOfMonth;
            }

            if (newMonths < 0) {
                newYears--;
                newMonths += 12;
            }

            this.model.age_text_end = `${newYears + this.model.nasabah.age_year} Tahun, ${newMonths} bulan, ${newDays} hari`;
        },
        async fetchNasabah(id) {
            let endpoint = `${BASEURL}/api/nasabah/${id}`
            try {
                Swal.showLoading();
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.model = response.data.data
                // console.log(this.model, "model nasabah")
                this.model.nasabah.foto_profil_preview = this.model.nasabah.foto_profil
                this.model.nasabah.foto_ktp_preview = this.model.nasabah.foto_ktp
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
        async fetchCategories() {
            let endpoint = `${BASEURL}/api/edoc/category/options`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.collections.categories = response.data.data.options
                $('#editfloatingCategory').val(this.model.category_id).trigger('change');
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },

        confirmUpdate() {
            if (this.model.nasabah.alamat == '') {
                Swal.fire('Kesalahan', 'Alamat nasabah harus diisi.', 'error')
                return false
            }
            if (this.model.nasabah.jenis_kelamin == '') {
                Swal.fire('Kesalahan', 'Jenis kelamin nasabah harus diisi.', 'error')
                return false
            }
            if (this.model.nasabah.nama_lengkap == '') {
                Swal.fire('Kesalahan', 'Nama nasabah harus diisi.', 'error')
                return false
            }
            if (this.model.nasabah.nik == '') {
                Swal.fire('Kesalahan', 'NIK nasabah harus diisi.', 'error')
                return false
            }
            if (this.model.nasabah.no_telepon == '') {
                Swal.fire('Kesalahan', 'No telepon nasabah harus diisi.', 'error')
                return false
            }
            if (this.model.nasabah.tanggal_lahir == '') {
                Swal.fire('Kesalahan', 'Tanggal lahir nasabah harus diisi.', 'error')
                return false
            }
            if (this.model.nasabah.tempat_lahir == '') {
                Swal.fire('Kesalahan', 'Tempat lahir nasabah harus diisi.', 'error')
                return false
            }

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
            let endpoint = `${BASEURL}/api/nasabah/${this.model.nasabah.id}?_method=PUT`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    text: 'Sedang diproses, mohon ditunggu..',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.post(endpoint, this.model.nasabah, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
                Swal.close()
                if (response) {
                    this.loading = false
                    Swal.fire({
                        title: 'Perubahan Berhasil Disimpan',
                        // text: "Apakah anda ingin print qrcode sekarang?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Close'
                    }).then((result) => {
                        if (result.value) {
                            this.closeComponent()
                        } else {
                            this.cancelEdit()
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
        editForm() {
            this.isEditingNasabah = true
        },
        cancelEdit() {
            this.isEditingNasabah = false
            this.fetchNasabah(id)
        },
        closeComponent() {
            this.offcanvasDetail.hide()
            this.resetForm()
            emitter.emit("fetchNasabahList")
        },
        resetForm() {
            // let closeOffcanvas = document.querySelector('#offcanvasDetailRight [data-bs-dismiss="offcanvas"]');
            // closeOffcanvas.click();
            this.model = {
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
            };
            this.offcanvasDetail = '';
            this.isEditing = false;
            this.loading = false;
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

        openEditPinjaman(id) {
            const routeData = this.$router.resolve({ name: 'admin.pinjamanlist', query: { editId: id } });
            window.open(routeData.href, '_blank');
        },

        openCreatePinjaman() {
            const routeData = this.$router.resolve({ name: 'admin.pinjamanlist', query: { nasabahId: this.model.nasabah.id } });
            window.open(routeData.href, '_blank');
        }
    },
    watch: {
        'model.nasabah.tanggal_lahir': function (val) {
            this.calculateAge(val)
            this.addMonths()
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

.cards {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.cards[data-animation="true"] .cards-header {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    -webkit-transition: all 300ms cubic-bezier(0.34, 1.61, 0.7, 1);
    -moz-transition: all 300ms cubic-bezier(0.34, 1.61, 0.7, 1);
    -o-transition: all 300ms cubic-bezier(0.34, 1.61, 0.7, 1);
    -ms-transition: all 300ms cubic-bezier(0.34, 1.61, 0.7, 1);
    transition: all 300ms cubic-bezier(0.34, 1.61, 0.7, 1);
}

.cards:hover[data-animation="true"] .cards-header {
    -webkit-transform: translate3d(0, -50px, 0);
    -moz-transform: translate3d(0, -50px, 0);
    -o-transform: translate3d(0, -50px, 0);
    -ms-transform: translate3d(0, -50px, 0);
    transform: translate3d(0, -50px, 0);
}

.cards .cards-header {
    padding: 1.5rem;
}

.cards .cards-body {
    font-family: "Roboto", Helvetica, Arial, sans-serif;
    padding: 1.5rem;
}

.cards .cards-footer {
    padding: 1.5rem;
    background-color: transparent;
}

.offcanvas-body {
    position: relative;
    flex: 1 1 auto;
    padding: 1rem;
    overflow-y: scroll;
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.offcanvas-body::-webkit-scrollbar {
    display: none;
}

.bluish {
    background: #2A7B9B;
    background: linear-gradient(90deg, rgba(42, 123, 155, 1) 0%, rgba(87, 171, 199, 1) 50%, rgba(40, 52, 92, 1) 100%);
}

.sticky-header-table {
        position: sticky;
        top: 0;
        z-index: 1;
    }
</style>