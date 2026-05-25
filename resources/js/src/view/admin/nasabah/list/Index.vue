<template>

    <!-- Modal Add -->
    <add-modal ref="addUser"></add-modal>

    <!-- Modal Edit -->
    <edit-modal ref="editNasabah"></edit-modal>

    <!-- Modal Add Batch -->
    <add-batch-modal ref="addBatch"></add-batch-modal>

    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">

                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item border-1 rounded-1" role="presentation">
                        <button class="nav-link p-4 m-0" :class="{ active: meta.currentTab === 'notValidated' }"
                            @click.prevent="switchTab('notValidated')" type="button" role="tab">
                            <div class="d-flex flex-column align-items-start text-start">
                                <h5 class="text-xs">Validasi Nasabah</h5>
                                <p class="text-xxs text-muted">List pengajuan <b class="text-warning">Online & Belum
                                        terverifikasi</b></p>
                                <div class="progress w-100">
                                    <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-xxs text-end mt-3 mb-0">100 Nasabah</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item border-1 rounded-1" role="presentation">
                        <button class="nav-link p-4 m-0" :class="{ active: meta.currentTab === 'draft' }"
                            @click.prevent="switchTab('draft')" type="button" role="tab">
                            <div class="d-flex flex-column align-items-start text-start">
                                <h5 class="text-xs">Drafting</h5>
                                <p class="text-xxs text-muted">List nasabah yang <b class="text-danger">Belum Pengajuan
                                        BI
                                        Checking</b></p>
                                <div class="progress w-100">
                                    <div class="progress-bar bg-primary w-50" role="progressbar" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h6 class="text-xxs text-muted mt-3 mb-0">Total : 50 nasabah</h6>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item border-1 rounded-1" role="presentation">
                        <button class="nav-link p-4 m-0" :class="{ active: meta.currentTab === 'submitted' }"
                            @click.prevent="switchTab('submitted')" type="button" role="tab">
                            <div class="d-flex flex-column align-items-start text-start">
                                <h5 class="text-xs">Submitted</h5>
                                <p class="text-xxs text-muted">List nasabah yang <b class="text-info">Sudah Pengajuan / Menerima BI
                                        Checking</b></p>
                                <div class="progress w-100">
                                    <div class="progress-bar bg-primary w-50" role="progressbar" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h6 class="text-xxs text-muted mt-3 mb-0">Total : 50 nasabah</h6>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item border-1 rounded-1" role="presentation">
                        <button class="nav-link p-4 m-0" :class="{ active: meta.currentTab === 'rejected' }"
                            @click.prevent="switchTab('rejected')" type="button" role="tab">
                            <div class="d-flex flex-column align-items-start text-start">
                                <h5 class="text-xs">Rejected</h5>
                                <p class="text-xxs text-muted">List nasabah yang <b class="text-danger">Menolak Proposal
                                        KB Bank</b></p>
                                <div class="progress w-100">
                                    <div class="progress-bar bg-primary w-50" role="progressbar" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h6 class="text-xxs text-muted mt-3 mb-0">Total : 50 nasabah</h6>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item border-1 rounded-1" role="presentation">
                        <button class="nav-link p-4 m-0" :class="{ active: meta.currentTab === 'accepted' }"
                            @click.prevent="switchTab('accepted')" type="button" role="tab">
                            <div class="d-flex flex-column align-items-start text-start">
                                <h5 class="text-xs">Accepted</h5>
                                <p class="text-xxs text-muted">List nasabah yang <b class="text-success">Menerima
                                        Proposal KB Bank</b></p>
                                <div class="progress w-100">
                                    <div class="progress-bar bg-primary w-50" role="progressbar" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h6 class="text-xxs text-muted mt-3 mb-0">Total : 50 nasabah</h6>
                            </div>
                        </button>
                    </li>
                </ul>

                <div class="d-flex justify-content-center my-4 align-items-center">
                    <hr class="ms-6 w-50">
                    <!-- <a class="btn btn-white text-xxs mb-0 py-1">
                        <span
                            class="text-xxs text-muted mb-0 fw-normal flex-shrink-0 d-flex align-items-center justify-content-center gap-1">
                            <i class="fas fa-search text-info"></i>
                            <p class="mb-0 text-info text-xxs fw-normal flex-shrink-0">Find Nasabah</p>
                        </span>
                    </a> -->
                    <div
                        class="input-group mb-0 text-xxs w-auto d-flex align-items-center flex-row flex-shrink-0 gap-2 shadow-none">
                        <a @click.prevent="showGlobalSearch"
                            class="btn btn-white rounded-2 mb-0 d-flex align-items-center">
                            <span class="text-xxs me-0" id="basic-addon1">
                                <i class="fas fa-search"></i>
                            </span>
                        </a>
                        <transition name="global-search">
                            <div v-if="showGlobalSearchActive" class="search-input-wrapper width-100 position-relative">
                                <input ref="globalInput" type="text" class="form-control text-xxs rounded-2"
                                    placeholder="Find Nasabah" aria-label="Username" id="global-searching"
                                    aria-describedby="basic-addon1" v-model="meta.search.global"
                                    @input="onGlobalSearchInput" autocomplete="off"
                                    style="width: 250px; margin-left: 8px;">

                                <ul v-if="showSuggestions && suggestions.length"
                                    class="suggestions-list list-unstyled p-0 py-3 shadow bg-white">
                                    <li v-for="item in suggestions" :key="item.id" class="suggestion-item"
                                        @click="selectSuggestion(item)">
                                        <div class="card border border-1 rounded-1 mb-0">
                                            <div class="card-body my-1">
                                                <h5 class="card-title text-xxs">{{ item.nama_lengkap }}</h5>
                                                <p class="card-text text-xxs">{{ item.nama_affiliasi ?
                                                    item.nama_affiliasi : '-' }}</p>
                                                <a class="btn btn-primary text-xxs">{{ item.validation ? 'Validated' :
                                                    'Not Validated' }} - {{ item.status_pengajuan }}</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </transition>
                    </div>
                    <hr class="me-6 w-50">
                </div>



                <div class="tab-content mt-4" id="pills-tabContent">

                    <div v-show="meta.currentTab === 'notValidated'" class="tab-pane fade show"
                        :class="meta.currentTab === 'notValidated' ? 'active' : ''" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="text-sm mb-0">Validasi Nasabah</h6>
                                <p class="text-xxs text-muted mb-0">List pengajuan online yang belum terverifikasi.</p>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" class="form-control text-xxs"
                                placeholder="Search nasabah yang belum terverifikasi"
                                v-model="meta.search.notValidated">
                        </div>

                        <div v-if="loadContentUnvalidated" class="d-flex justify-content-center p-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div v-else class="table-responsive" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                            <table class="table table-hover align-items-center mb-0" style="background-color: white;">
                                <thead class="bg-white-100">
                                    <tr>
                                        <th class="text-xxs font-weight-bold">Nama Nasabah<br>Affiliasi</th>
                                        <th class="text-xxs font-weight-bold">Tanggal Pengajuan</th>
                                        <th class="text-xxs font-weight-bold text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="collection.nasabah.notValidated.data.length > 0">
                                        <tr v-for="item in collection.nasabah.notValidated.data" :key="item.id">
                                            <td class="text-xxs">
                                                <div class="d-flex flex-column align-items-start ms-3">
                                                    <a class="mb-0 text-xxs font-weight-semibold text-primary text-bold"
                                                        @click.prevent="editNasabah(item.id)">
                                                        {{ item.nama_lengkap }}
                                                    </a>
                                                    <p class="text-xxs text-start text-secondary mb-0">
                                                        {{ item.temp_affiliasi ? item.temp_affiliasi : '-' }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-start text-lg">
                                                <p class="text-xxs text-secondary mb-0 ms-3">
                                                    {{ item.created_at ? new
                                                        Date(item.created_at).toLocaleDateString('id-ID', {
                                                            day: '2-digit',
                                                            month: 'long',
                                                            year: 'numeric'
                                                        }) : '-' }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-xxs">
                                                <a class="btn btn-sm mb-0 btn-secondary text-xxs"
                                                    @click="confirmValidation(item.id)">
                                                    Validate
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="collection.nasabah.notValidated.data?.length > 0"
                                class="d-flex justify-content-between px-3 py-3 align-items-center flex-wrap"
                                style="background-color: white;">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-semibold mb-0 pb-0 text-dark text-xxs">Halaman {{
                                        meta.page.notValidated.current_page }} / {{
                                            meta.page.notValidated.last_page }}
                                    </p>
                                    <p class="font-weight-semibold mb-0 pt-0 text-secondary text-xxs">
                                        Total: {{ meta.total.notValidated }} Data
                                    </p>
                                </div>
                                <div>
                                    <button v-if="collection.nasabah.notValidated?.links"
                                        v-for="(link, index) in collection.nasabah.notValidated.links" :key="index"
                                        @click="changePageUnvalidatedNasabahList(link.url)"
                                        class="btn btn-sm rounded-2 btn-white mb-0 text-xxs ms-1"
                                        :disabled="link.active">
                                        <span v-if="index === 0"><i class="fas fa-chevron-left"></i></span>
                                        <span
                                            v-else-if="index === (collection.nasabah.notValidated?.links?.length - 1)"><i
                                                class="fas fa-chevron-right"></i></span>
                                        <span v-else>{{ link.label }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="meta.currentTab === 'draft'" class="tab-pane fade show"
                        :class="meta.currentTab === 'draft' ? 'active' : ''" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="text-sm mb-0">Drafting</h6>
                                <p class="text-xxs text-muted mb-0">List nasabah yang belum BI Checking.</p>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="ms-auto d-flex gap-2">
                                    <button @click.prevent="addUser"
                                        class="btn btn-sm btn-primary d-flex align-items-center text-xxs fw-normal mb-0"
                                        type="button" :disabled="loadContentDrafted">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 448 512" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                                            </svg>
                                        </span>
                                        Nasabah Baru
                                    </button>
                                </div>
                                <div class="ms-auto d-flex gap-2">
                                    <button @click.prevent="createBatch"
                                        class="btn btn-sm btn-info d-flex align-items-center text-xxs fw-normal mb-0"
                                        type="button" :disabled="loadContentDrafted">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 448 512" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                                            </svg>
                                        </span>
                                        Batch Pengajuan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" class="form-control text-xxs" placeholder="Search nama nasabah"
                                v-model="meta.search.draft">
                        </div>
                        <div v-if="loadContentDrafted" class="d-flex justify-content-center p-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div v-else class="table-responsive" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                            <table class="table table-hover align-items-center mb-0" style="background-color: white;">
                                <thead class="bg-white-100">
                                    <tr>
                                        <th class="text-xxs font-weight-bold">Nama Nasabah<br>Affiliasi</th>
                                        <th class="text-xxs font-weight-bold">Tanggal Pengajuan</th>
                                        <th class="text-xxs font-weight-bold text-center">Kelengkapan Dokumen</th>
                                        <th class="text-xxs font-weight-bold text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="collection.nasabah.drafted.data?.length > 0">
                                        <tr v-for="item in collection.nasabah.drafted.data" :key="item.id">
                                            <td class="align-middle text-lg">
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-start ms-1">
                                                        <a class="mb-0 text-xxs font-weight-semibold text-primary text-bold"
                                                            @click.prevent="editNasabah(item.id)">
                                                            {{ item.nama_lengkap }}
                                                        </a>
                                                        <p class="text-xxs text-secondary mb-0">
                                                            {{ item.affiliasi ? item.affiliasi.nama_affiliasi : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-start text-lg">
                                                <p class="text-xxs text-secondary mb-0 ms-3">
                                                    {{ item.created_at ? new
                                                        Date(item.created_at).toLocaleDateString('id-ID', {
                                                            day: '2-digit',
                                                            month: 'long',
                                                            year: 'numeric'
                                                        }) : '-' }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-lg">
                                                <div id="content">
                                                    <div id="horz-list">
                                                        <ul class="d-flex flex-row justify-content-center">
                                                            <li>
                                                                <div class="d-flex flex-column">
                                                                    <p class="text-xxs text-secondary mb-0 fw-bold">KTP
                                                                    </p>
                                                                    <i
                                                                        :class="item.dokumen_ktp ? 'fas fa-check-circle text-primary' : 'fas fa-times-circle text-danger'"></i>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex flex-column">
                                                                    <p class="text-xxs text-secondary mb-0 fw-bold">KK
                                                                    </p>
                                                                    <i
                                                                        :class="item.dokumen_kartu_keluarga ? 'fas fa-check-circle text-primary' : 'fas fa-times-circle text-danger'"></i>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex flex-column">
                                                                    <p class="text-xxs text-secondary mb-0 fw-bold">NPWP
                                                                    </p>
                                                                    <i
                                                                        :class="item.dokumen_npwp ? 'fas fa-check-circle text-primary' : 'fas fa-times-circle text-danger'"></i>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex flex-column">
                                                                    <p class="text-xxs text-secondary mb-0 fw-bold">KTP
                                                                        Pasangan
                                                                    </p>
                                                                    <i
                                                                        :class="item.dokumen_ktp_pasangan ? 'fas fa-check-circle text-primary' : 'fas fa-times-circle text-danger'"></i>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex flex-column">
                                                                    <p class="text-xxs text-secondary mb-0 fw-bold">
                                                                        Asuransi
                                                                    </p>
                                                                    <i
                                                                        :class="item.dokumen_asuransi ? 'fas fa-check-circle text-primary' : 'fas fa-times-circle text-danger'"></i>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex flex-column">
                                                                    <p class="text-xxs text-secondary mb-0 fw-bold">ID
                                                                        Card
                                                                    </p>
                                                                    <i
                                                                        :class="item.dokumen_id_card_perusahaan ? 'fas fa-check-circle text-primary' : 'fas fa-times-circle text-danger'"></i>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex flex-column">
                                                                    <p class="text-xxs text-secondary mb-0 fw-bold">
                                                                        Selfie
                                                                    </p>
                                                                    <i
                                                                        :class="item.dokumen_selfie ? 'fas fa-check-circle text-primary' : 'fas fa-times-circle text-danger'"></i>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex flex-column">
                                                                    <p class="text-xxs text-secondary mb-0 fw-bold">
                                                                        Pernyataan
                                                                    </p>
                                                                    <i
                                                                        :class="item.dokumen_surat_pernyataan ? 'fas fa-check-circle text-primary' : 'fas fa-times-circle text-danger'"></i>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-lg">
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <a class="btn btn-sm mb-0 mx-1 btn-success text-xxs"
                                                        v-show="email_integration" @click="sendPengajuanEmail(item.id)">
                                                        Kirim Email
                                                    </a>
                                                    <a v-if="!loadDownloadPdfPengajuan"
                                                        class="btn btn-sm mb-0 mx-1 btn-info text-xxs"
                                                        @click.prevent="downloadPreview(item.id, item.nama_lengkap)">
                                                        <span>PDF Pengajuan</span>
                                                    </a>
                                                    <button v-else
                                                        class="btn btn-info btn-sm m-0 py-2 text-xxs text-white"
                                                        type="button" disabled>
                                                        <span class="spinner-border spinner-border-sm text-white"
                                                            role="status" aria-hidden="true"></span>
                                                        Loading...
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="collection.nasabah.drafted.data?.length > 0"
                                class="d-flex justify-content-between px-3 py-3 align-items-center flex-wrap"
                                style="background-color: white;">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-semibold mb-0 pb-0 text-dark text-xxs">Halaman {{
                                        meta.page.drafted.current_page }} / {{
                                            meta.page.drafted.last_page }}
                                    </p>
                                    <p class="font-weight-semibold mb-0 pt-0 text-secondary text-xxs">
                                        Total: {{ meta.total.drafted }} Data
                                    </p>
                                </div>
                                <div>
                                    <button v-if="collection.nasabah.drafted?.links"
                                        v-for="(link, index) in collection.nasabah.drafted.links" :key="index"
                                        @click="changePageDraftNasabahList(link.url)"
                                        class="btn btn-sm rounded-2 btn-white mb-0 text-xxs ms-1"
                                        :disabled="link.active">
                                        <span v-if="index === 0"><i class="fas fa-chevron-left"></i></span>
                                        <span v-else-if="index === (collection.nasabah.drafted?.links?.length - 1)"><i
                                                class="fas fa-chevron-right"></i></span>
                                        <span v-else>{{ link.label }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="meta.currentTab === 'submitted'" class="tab-pane fade show"
                        :class="meta.currentTab === 'submitted' ? 'active' : ''" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="text-sm mb-0">Submitted</h6>
                                <p class="text-xxs text-muted mb-0">List nasabah yang sudah pengajuan/menerima BI
                                    Checking.
                                </p>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" class="form-control text-xxs"
                                placeholder="Search nasabah yang sudah pengajuan/menerima BI Checking"
                                v-model="meta.search.submitted">
                        </div>
                        <div v-if="loadContentSubmitted" class="d-flex justify-content-center p-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div v-else class="table-responsive" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                            <table class="table table-hover align-items-center mb-0" style="background-color: white;">
                                <thead class="bg-white-100">
                                    <tr>
                                        <th class="text-xxs font-weight-bold">Nama Nasabah<br>Affiliasi</th>
                                        <th class="text-xxs font-weight-bold">Tanggal Pengajuan</th>
                                        <th class="text-xxs font-weight-bold text-center">Status</th>
                                        <th class="text-xxs font-weight-bold text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="collection.nasabah.submitted.data?.length > 0">
                                        <tr v-for="item in collection.nasabah.submitted.data" :key="item.id">
                                            <td class="align-middle text-lg">
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-start ms-1">
                                                        <a class="mb-0 text-xxs font-weight-semibold text-primary text-bold"
                                                            @click.prevent="editNasabah(item.id)">
                                                            {{ item.nama_lengkap }}
                                                        </a>
                                                        <p class="text-xxs text-secondary mb-0">
                                                            {{ item.affiliasi ? item.affiliasi.nama_affiliasi : '-'
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-xxs">
                                                {{ item.created_at ? new
                                                    Date(item.created_at).toLocaleDateString('id-ID', {
                                                        day: '2-digit',
                                                        month: 'long',
                                                        year: 'numeric'
                                                }) : '-' }}
                                            </td>
                                            <td class="align-middle text-center text-lg">
                                                <a class="btn btn-sm mb-0 text-xxs" :class="item.status_pengajuan == 'Submitted' ? 'btn-white' : 'btn-info'">
                                                    {{ item.status_pengajuan }}
                                                </a>
                                            </td>
                                            <td class="align-middle text-center text-lg">
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a class="btn btn-sm mb-0 btn-warning text-xxs"
                                                        @click.prevent="confirmRejectForm(item.id)">
                                                        <span>Reject</span>
                                                    </a>
                                                    <a class="btn btn-sm mb-0 btn-success text-xxs"
                                                        @click.prevent="confirmAcceptForm(item.id)">
                                                        <span>Accept</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="collection.nasabah.drafted.data?.length > 0"
                                class="d-flex justify-content-between px-3 py-3 align-items-center flex-wrap"
                                style="background-color: white;">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-semibold mb-0 pb-0 text-dark text-xxs">Halaman {{
                                        meta.page.drafted.current_page }} / {{
                                            meta.page.drafted.last_page }}
                                    </p>
                                    <p class="font-weight-semibold mb-0 pt-0 text-secondary text-xxs">
                                        Total: {{ meta.total.drafted }} Data
                                    </p>
                                </div>
                                <div>
                                    <button v-if="collection.nasabah.drafted?.links"
                                        v-for="(link, index) in collection.nasabah.submitted.links" :key="index"
                                        @click="changePageSubmittedNasabahList(link.url)"
                                        class="btn btn-sm rounded-2 btn-white mb-0 text-xxs ms-1"
                                        :disabled="link.active">
                                        <span v-if="index === 0"><i class="fas fa-chevron-left"></i></span>
                                        <span v-else-if="index === (collection.nasabah.submitted?.links?.length - 1)"><i
                                                class="fas fa-chevron-right"></i></span>
                                        <span v-else>{{ link.label }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="meta.currentTab === 'rejected'" class="tab-pane fade show"
                        :class="meta.currentTab === 'rejected' ? 'active' : ''" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="text-sm mb-0">Rejected</h6>
                                <p class="text-xxs text-muted mb-0">List nasabah yang menolak Proposal KB
                                    Bank.</p>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" class="form-control text-xxs"
                                placeholder="Search nasabah yang sudah pengajuan/menerima BI Checking"
                                v-model="meta.search.rejected">
                        </div>
                        <div v-if="loadContentRejected" class="d-flex justify-content-center p-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div v-else class="table-responsive" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                            <table class="table table-hover align-items-center mb-0" style="background-color: white;">
                                <thead class="bg-white-100">
                                    <tr>
                                        <th class="text-xxs font-weight-bold">Nama Nasabah<br>Affiliasi</th>
                                        <th class="text-xxs font-weight-bold">Status</th>
                                        <th class="text-xxs font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="collection.nasabah.rejected.data?.length > 0">
                                        <tr v-for="item in collection.nasabah.rejected.data" :key="item.id">
                                            <td class="align-middle text-lg">
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-start ms-1">
                                                        <a class="mb-0 text-xxs font-weight-semibold text-primary text-bold"
                                                            @click.prevent="editNasabah(item.id)">
                                                            {{ item.nama_lengkap }}
                                                        </a>
                                                        <p class="text-xxs text-secondary mb-0">
                                                            {{ item.affiliasi ?
                                                                item.affiliasi.nama_affiliasi : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-lg">
                                                <a class="btn btn-sm mb-0 btn-danger">
                                                    {{ item.status_pengajuan }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a class="btn btn-sm mb-0 btn-info"
                                                        @click.prevent="downloadPreview(item.id, item.nama_lengkap)">
                                                        <span>PDF</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="collection.nasabah.rejected.data?.length > 0"
                                class="d-flex justify-content-between px-3 py-3 align-items-center flex-wrap"
                                style="background-color: white;">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-semibold mb-0 pb-0 text-dark text-xxs">Halaman {{
                                        meta.page.rejected.current_page }} / {{
                                            meta.page.rejected.last_page }}
                                    </p>
                                    <p class="font-weight-semibold mb-0 pt-0 text-secondary text-xxs">
                                        Total: {{ meta.total.rejected }} Data
                                    </p>
                                </div>
                                <div>
                                    <button v-if="collection.nasabah.rejected?.links"
                                        v-for="(link, index) in collection.nasabah.rejected.links" :key="index"
                                        @click="changePageRejectedNasabahList(link.url)"
                                        class="btn btn-sm rounded-2 btn-white mb-0 text-xxs ms-1"
                                        :disabled="link.active">
                                        <span v-if="index === 0"><i class="fas fa-chevron-left"></i></span>
                                        <span v-else-if="index === (collection.nasabah.rejected?.links?.length - 1)"><i
                                                class="fas fa-chevron-right"></i></span>
                                        <span v-else>{{ link.label }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                      <div v-show="meta.currentTab === 'accepted'" class="tab-pane fade show"
                        :class="meta.currentTab === 'accepted' ? 'active' : ''" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="text-sm mb-0">Accepted</h6>
                                <p class="text-xxs text-muted mb-0">List nasabah yang menerima Proposal KB Bank.
                                </p>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" class="form-control text-xxs"
                                placeholder="Search nasabah yang sudah pengajuan/menerima BI Checking"
                                v-model="meta.search.accepted">
                        </div>
                        <div v-if="loadContentAccepted" class="d-flex justify-content-center p-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div v-else class="table-responsive" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                            <table class="table table-hover align-items-center mb-0" style="background-color: white;">
                                <thead class="bg-white-100">
                                    <tr>
                                        <th class="text-xxs font-weight-bold">Nama Nasabah<br>Affiliasi</th>
                                        <th class="text-xxs font-weight-bold">Status</th>
                                        <th class="text-xxs font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="collection.nasabah.accepted.data?.length > 0">
                                        <tr v-for="item in collection.nasabah.accepted.data" :key="item.id">
                                            <td class="align-middle text-lg">
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-start ms-1">
                                                        <a class="mb-0 text-xxs font-weight-semibold text-primary text-bold"
                                                            @click.prevent="editNasabah(item.id)">
                                                            {{ item.nama_lengkap }}
                                                        </a>
                                                        <p class="text-xxs text-secondary mb-0">
                                                            {{ item.affiliasi ? item.affiliasi.nama_affiliasi :
                                                                '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-lg">
                                                <a class="btn btn-sm mb-0 btn-success">
                                                    {{ item.status_pengajuan }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a class="btn btn-sm mb-0 btn-info"
                                                        @click.prevent="downloadPreview(item.id, item.nama_lengkap)">
                                                        <span>PDF</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="collection.nasabah.accepted.data?.length > 0"
                                class="d-flex justify-content-between px-3 py-3 align-items-center flex-wrap"
                                style="background-color: white;">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-semibold mb-0 pb-0 text-dark text-xxs">Halaman {{
                                        meta.page.accepted.current_page }} / {{
                                            meta.page.accepted.last_page }}
                                    </p>
                                    <p class="font-weight-semibold mb-0 pt-0 text-secondary text-xxs">
                                        Total: {{ meta.total.accepted }} Data
                                    </p>
                                </div>
                                <div>
                                    <button v-if="collection.nasabah.accepted?.links"
                                        v-for="(link, index) in collection.nasabah.accepted.links" :key="index"
                                        @click="changePageAcceptedNasabahList(link.url)"
                                        class="btn btn-sm rounded-2 btn-white mb-0 text-xxs ms-1"
                                        :disabled="link.active">
                                        <span v-if="index === 0"><i class="fas fa-chevron-left"></i></span>
                                        <span v-else-if="index === (collection.nasabah.accepted?.links?.length - 1)"><i
                                                class="fas fa-chevron-right"></i></span>
                                        <span v-else>{{ link.label }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AddUserModal from './component/Add.vue';
import EditNasabahModal from './component/Edit.vue';
import AddBatchModal from './component/Batch.vue';
import { emitter } from '../../../../../eventEmitter.js';
import $ from 'jquery';
window.$ = window.jQuery = $;
import 'select2/dist/js/select2.full.min.js';
import 'select2/dist/css/select2.min.css';
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
window.BASEURL = ''

export default {
    created() {
        emitter.on('fetchUnvalidatedList', this.fetchUnvalidatedNasabahList);
        emitter.on('fetchDraftedList', this.fetchDraftedNasabahList);


    },
    name: "UserList.Index",
    components: {
        'add-modal': AddUserModal,
        'edit-modal': EditNasabahModal,
        'add-batch-modal': AddBatchModal,
    },
    data() {
        return {
            loadContent: true,
            loadContentUnvalidated: true,
            loadContentDrafted: true,
            loadContentSubmitted: true,
            loadContentAccepted: true,
            loadContentRejected: true,
            filterisHidden: false,
            email_integration: false,
            loadDownloadPdfPengajuan: false,
            meta: {
                user: '',
                page: {
                    notValidated: { current_page: 1, last_page: 1 },
                    drafted: { current_page: 1, last_page: 1 },
                    submitted: { current_page: 1, last_page: 1 },
                    accepted: { current_page: 1, last_page: 1 },
                    rejected: { current_page: 1, last_page: 1 },
                },
                search: {
                    notValidated: '',
                    drafted: '',
                    submitted: '',
                    accepted: '',
                    rejected: '',
                },
                role: '',
                unit: '',
                status: '',
                requestStatus: '',
                currentTab: 'notValidated',
                total: {
                    notValidated: 0,
                    drafted: 0,
                    submitted: 0,
                    accepted: 0,
                    rejected: 0,
                },
                accesses: [],
            },
            collection: {
                documents: '',
                nasabah: {
                    notValidated: { data: [], current_page: 1, last_page: 1 },
                    drafted: { data: [], current_page: 1, last_page: 1 },
                    submitted: { data: [], current_page: 1, last_page: 1 },
                    accepted: { data: [], current_page: 1, last_page: 1 },
                    rejected: { data: [], current_page: 1, last_page: 1 },
                },
            },
            dataTable: null,
            requestCounter: 0,
            searchTimer: null,
            suggestionTimer: null,
            suggestions: [],
            showSuggestions: false,
            qrcode: '',
            qrCodeImage: '',
            currentPrintDet: '',
            accessDenied: false,
            showGlobalSearchActive: false,
        }
    },

    async mounted() {
        await this.fetchCurrentUser();

        if (this.canReadNasabah) {
            this.accessDenied = false;
            await this.fetchRoleList();
            await this.fetchUnitList();
            await this.fetchAffiliasi();
            // await this.fetchUserListByStatus(this.meta.currentTab);
            await this.fetchUnvalidatedNasabahList();
            await this.fetchDraftedNasabahList();
            await this.fetchSubmittedNasabahList();
            await this.fetchRejectedNasabahList();
            await this.fetchAcceptedNasabahList();
            this.loadContent = false;
        } else {
            this.loadContent = false;
            this.accessDenied = true;
        }

        $(document).ready(function () {

            $(".fa-search").click(function () {
                $(".wrap, .input-search").toggleClass("active");
                $("input[type='text']").focus();
            });

        });
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        addUser() {
            emitter.emit('AddNasabah', this.canCreateNasabah);
        },
        createBatch() {
            emitter.emit('AddBatch', this.canCreateNasabah);
        },
        editNasabah(id) {
            emitter.emit('EditNasabah', [this.canUpdateNasabah, id]);
        },
        filtertoggleSidebar() {
            this.filterisHidden = !this.filterisHidden;
        },
        showGlobalSearch() {
            this.showGlobalSearchActive = !this.showGlobalSearchActive;
            if (this.showGlobalSearchActive) {
                this.$nextTick(() => {
                    if (this.$refs.globalInput) this.$refs.globalInput.focus();
                });
            } else {
                this.showSuggestions = false;
            }
        },
        async fetchNasabahSuggestions() {
            const q = this.meta.search.global && this.meta.search.global.trim();
            if (!q || q.length < 2) {
                this.suggestions = [];
                this.showSuggestions = false;
                return;
            }

            try {
                const endpoint = `${BASEURL}/api/nasabah/options`;
                const response = await axios.get(endpoint, {
                    headers: { Authorization: 'Bearer ' + this.$token() },
                    params: { search: q },
                });

                const data = response.data?.data ?? response.data ?? [];
                this.suggestions = Array.isArray(data) ? data : [];
                this.showSuggestions = this.suggestions.length > 0;
            } catch (err) {
                console.error('Suggestion fetch error', err);
                this.suggestions = [];
                this.showSuggestions = false;
            }
        },

        onGlobalSearchInput() {
            if (this.suggestionTimer) {
                clearTimeout(this.suggestionTimer);
            }
            this.suggestionTimer = setTimeout(() => {
                this.fetchNasabahSuggestions();
            }, 300);
        },

        selectSuggestion(item) {
            const name = item.nama_lengkap;
            this.meta.search.global = name;
            this.showSuggestions = false;
        },
        async fetchCurrentUser() {
            let endpoint = `${BASEURL}/api/current-user`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })

                if (response.data) {
                    this.meta.user = response.data.user || response.data;
                    console.log('User accesses:', response.data.accesses);
                    this.meta.accesses = response.data.accesses ?? [];
                }
            } catch (error) {
                console.log('User error: ', error)
            }
        },
        async fetchAffiliasi() {
            let endpoint = `${BASEURL}/api/affiliasi/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collection.affiliasi = response.data.data;
            } catch (error) {
                console.error("Error fetching affiliasi: ", error);
            }
        },
        async preview(id) {
            let endpoint = `${BASEURL}/api/preview/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: { Authorization: 'Bearer ' + this.$token() }
                });

                const blob = new Blob([response.data], { type: 'text/html' });

                const url = URL.createObjectURL(blob);

                // Open the URL in a new tab (optional, if you want to show the preview before downloading)
                window.open(url, '_blank');

                setTimeout(() => URL.revokeObjectURL(url), 100);

            } catch (error) {
                console.error('Preview error: ', error);
            }
        },
        async preview_asuransi(id) {
            let endpoint = `${BASEURL}/api/asuransi/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: { Authorization: 'Bearer ' + this.$token() }
                });

                const blob = new Blob([response.data], { type: 'text/html' });

                const url = URL.createObjectURL(blob);

                // Open the URL in a new tab (optional, if you want to show the preview before downloading)
                window.open(url, '_blank');

                setTimeout(() => URL.revokeObjectURL(url), 100);

            } catch (error) {
                console.error('Preview error: ', error);
            }
        },

        async downloadPreview(id, name) {
            this.loadDownloadPdfPengajuan = true;
            let endpoint = `${BASEURL}/api/preview-pdf/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: { Authorization: 'Bearer ' + this.$token() },
                    responseType: 'blob',
                });

                const blob = new Blob([response.data], { type: 'application/pdf' });
                const url = URL.createObjectURL(blob);
                const anchor = document.createElement('a');
                const safeName = name ? name.replace(/[^a-zA-Z0-9-_]/g, '_') : 'nasabah';
                anchor.href = url;
                anchor.download = `preview_nasabah_${safeName}_${id}.pdf`;
                document.body.appendChild(anchor);
                anchor.click();
                document.body.removeChild(anchor);
                setTimeout(() => URL.revokeObjectURL(url), 100);
                this.loadDownloadPdfPengajuan = false;
            } catch (error) {
                console.error('Download preview error: ', error);
                this.loadDownloadPdfPengajuan = false;
            }
        },

        async sendPengajuanEmail(nasabahId) {
            // Show a loading indicator here if you want (e.g., changing button text to "Sending...")
            console.log("Sending email for Nasabah ID: " + nasabahId);

            try {
                const response = await fetch(`/api/nasabah/${nasabahId}/send-pengajuan`, {
                    method: 'POST',
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.status) {
                    alert('Success: ' + data.message);
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An unexpected error occurred.');
            }
        },

        async fetchRoleList() {
            let endpoint = `${BASEURL}/api/role/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collection.roles = response.data.data
                console.log('Role list:', this.collection.roles);
            } catch (error) {
                console.error("Error fetching role list: ", error);
            }
        },

        async fetchUnitList() {
            let endpoint = `${BASEURL}/api/unit/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collection.units = response.data.data
                console.log('Unit list:', this.collection.units);
            } catch (error) {
                console.error("Error fetching unit list: ", error);
            }
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

        destroyDataTable() {
            this.destroySelect2();

            if (this.dataTable) {
                this.dataTable.destroy();
                this.dataTable = null;
            }
        },

        debounceSearchFetch() {
            if (this.searchTimer) {
                clearTimeout(this.searchTimer);
            }
            this.searchTimer = setTimeout(() => {
                // this.fetchUserListByStatus(this.meta.currentTab);
            }, 400);
        },

        switchTab(status) {
            this.meta.currentTab = status;
            // this.fetchUserListByStatus(status);
        },

        // async fetchUserListByStatus(status) {
        //     this.destroyDataTable();
        //     this.loadContent = true;
        //     const requestId = ++this.requestCounter;
        //     let endpoint = `${BASEURL}/api/nasabah`;
        //     try {
        //         let response = await axios.get(endpoint, {
        //             headers: {
        //                 Authorization: 'Bearer ' + this.$token(),
        //             },
        //             params: {
        //                 'search': this.meta.search,
        //                 'status': status,
        //             }
        //         });

        //         if (requestId !== this.requestCounter) {
        //             return;
        //         }

        //         // API returns paginated data - ensure proper structure
        //         const paginatedData = response.data;
        //         console.log(`${status} raw response:`, paginatedData);

        //         // Maintain collection structure with data/pagination properties
        //         this.collection.users[status] = {
        //             data: paginatedData.data || paginatedData,
        //             current_page: paginatedData.current_page || 1,
        //             last_page: paginatedData.last_page || 1,
        //             links: paginatedData.links || [],
        //             total: paginatedData.total || 0,
        //         };

        //         console.log(`${status} processed:`, this.collection.users[status]);
        //         this.meta.total = this.collection.users[status].total;
        //         this.meta.page[status].current_page = this.collection.users[status].current_page;
        //         this.meta.page[status].last_page = this.collection.users[status].last_page;
        //         this.loadContent = false;
        //     } catch (error) {
        //         console.error(`Error fetching ${status} list:`, error);
        //         if (requestId === this.requestCounter) {
        //             this.loadContent = false;
        //         }
        //     }
        // },

        // async fetchUserList() {
        //     await this.fetchUserListByStatus(this.meta.currentTab);
        // },
        async changeStatus(id) {
            let endpoint = `${BASEURL}/api/change/status/${id}`;
            try {
                let response = await axios.post(endpoint, {}, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                });
                Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: response.data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                this.fetchUserList();
            } catch (error) {
                console.log(error.response.data.message);
                this.$swal.fire('Failed!', error.response.data.message, 'error');
            }
        },


        async fetchUnvalidatedNasabahList() {
            this.loadContentUnvalidated = true;
            let endpoint = `${BASEURL}/api/nasabah/unvalidated`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search.notValidated,
                        'role': this.meta.role,
                        'unit': this.meta.unit,
                    }
                });
                this.collection.nasabah.notValidated = response.data.data || response.data;
                this.meta.total.notValidated = this.collection.nasabah.notValidated.total || 0;
                this.meta.page.notValidated.current_page = this.collection.nasabah.notValidated.current_page || 1;
                this.meta.page.notValidated.last_page = this.collection.nasabah.notValidated.last_page || 1;
                console.log('Unvalidated nasabah list:', this.collection.nasabah.notValidated);
                this.loadContentUnvalidated = false;
            } catch (error) {
                console.error("Error fetching unvalidated nasabah list: ", error);
                this.loadContentUnvalidated = false;
            }
        },
        confirmValidation(id) {
            if (!Array.isArray(this.collection.affiliasi) || !this.collection.affiliasi.length) {
                return Swal.fire({
                    icon: 'warning',
                    title: 'Affiliasi belum tersedia',
                    text: 'Tidak ada opsi affiliasi untuk dipilih.',
                });
            }

            const optionsHtml = this.collection.affiliasi
                .map((aff) => `<option value="${aff.id}">${aff.nama ?? aff.name ?? aff.nama_affiliasi ?? aff.namaAffiliasi ?? aff.affiliasi ?? 'Affiliasi'}</option>`)
                .join('');

            Swal.fire({
                html: `
                    <label for="swal-affiliasi" class="form-label text-start w-100 mb-2 text-md">Pilih Affiliasi Nasabah</label>
                    <select id="swal-affiliasi" class="form-select">
                        <option value="">Pilih affiliasi</option>
                        ${optionsHtml}
                    </select>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Validate',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const selected = Swal.getPopup().querySelector('#swal-affiliasi');
                    const selectedValue = selected ? selected.value : null;
                    if (!selectedValue) {
                        Swal.showValidationMessage('Silakan pilih affiliasi terlebih dahulu');
                    }
                    return selectedValue;
                },
                didOpen: () => {
                    const select = Swal.getPopup().querySelector('#swal-affiliasi');
                    if (select) {
                        select.focus();
                    }
                },
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.isConfirmed) {
                    this.validation(id, result.value);
                }
            });
        },
        async validation(id, affiliasiId) {
            let endpoint = `${BASEURL}/api/nasabah/validation/${id}/${affiliasiId}`;
            try {
                let response = await axios.post(endpoint, {}, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: response.data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                this.fetchUnvalidatedNasabahList();
            } catch (error) {
                console.log(error.response?.data?.message || error.message);
                this.$swal.fire('Failed!', error.response?.data?.message || 'Terjadi kesalahan', 'error');
            }
        },
        confirmRejectForm(id) {
            Swal.fire({
                title: 'Apakah Nasabah menolak pengajuan ini?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.rejectStore(id)
                }
            })
        },
        async rejectStore(id) {
            this.loading = true
            let endpoint = `${BASEURL}/api/nasabah/store/rejected/${id}`;
            try {
                let response = await axios.post(endpoint, {}, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                console.log('Store response:', response);
                Swal.fire(
                    'Saved!',
                    'User has been saved.',
                    'success'
                )
            } catch (error) {
                console.error("Error storing user: ", error);
                Swal.fire(
                    'Error!',
                    'There was an error saving the user.',
                    'error'
                )
            } finally {
                this.loading = false
            }
        },
        confirmAcceptForm(id) {
            Swal.fire({
                title: 'Apakah Nasabah menerima pengajuan ini?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.acceptStore(id)
                }
            })
        },
        async acceptStore(id) {
            this.loading = true
            let endpoint = `${BASEURL}/api/nasabah/store/accepted/${id}`;
            try {
                let response = await axios.post(endpoint, {}, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                console.log('Store response:', response);
                Swal.fire(
                    'Saved!',
                    'User has been saved.',
                    'success'
                )
            } catch (error) {
                console.error("Error storing user: ", error);
                Swal.fire(
                    'Error!',
                    'There was an error saving the user.',
                    'error'
                )
            } finally {
                this.loading = false
            }
        },
        async changePageUnvalidatedNasabahList(url) {
            if (url == null) {
                return false
            }
            try {
                Swal.fire({
                    background: '#ffffff00',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.get(url, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                });
                this.collection.nasabah.notValidated = response.data.data;
                this.meta.page.notValidated.current_page = this.collection.nasabah.notValidated.current_page;
                this.meta.page.notValidated.last_page = this.collection.nasabah.notValidated.last_page;
                Swal.close()
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },


        async fetchDraftedNasabahList() {
            this.loadContentDrafted = true;
            let endpoint = `${BASEURL}/api/nasabah/drafted`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search.drafted,
                        'role': this.meta.role,
                        'unit': this.meta.unit,
                    }
                });
                this.collection.nasabah.drafted = response.data.data || response.data;
                this.meta.total.drafted = this.collection.nasabah.drafted.total || 0;
                this.meta.page.drafted.current_page = this.collection.nasabah.drafted.current_page || 1;
                this.meta.page.drafted.last_page = this.collection.nasabah.drafted.last_page || 1;
                this.loadContentDrafted = false;
            } catch (error) {
                console.error("Error fetching drafted nasabah list: ", error);
                this.loadContentDrafted = false;
            }
        },
        async fetchSubmittedNasabahList() {
            this.loadContentSubmitted = true;
            let endpoint = `${BASEURL}/api/nasabah/submitted`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search.submitted,
                        'role': this.meta.role,
                        'unit': this.meta.unit,
                    }
                });
                this.collection.nasabah.submitted = response.data.data || response.data;
                this.meta.total.submitted = this.collection.nasabah.submitted.total || 0;
                this.meta.page.submitted.current_page = this.collection.nasabah.submitted.current_page || 1;
                this.meta.page.submitted.last_page = this.collection.nasabah.submitted.last_page || 1;
                this.loadContentSubmitted = false;
            } catch (error) {
                console.error("Error fetching submitted nasabah list: ", error);
                this.loadContentSubmitted = false;
            }
        },
        async fetchAcceptedNasabahList() {
            this.loadContentAccepted = true;
            let endpoint = `${BASEURL}/api/nasabah/accepted`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search.accepted,
                        'role': this.meta.role,
                        'unit': this.meta.unit,
                    }
                });
                this.collection.nasabah.accepted = response.data.data || response.data;
                this.meta.total.accepted = this.collection.nasabah.accepted.total || 0;
                this.meta.page.accepted.current_page = this.collection.nasabah.accepted.current_page || 1;
                this.meta.page.accepted.last_page = this.collection.nasabah.accepted.last_page || 1;
                this.loadContentAccepted = false;
            } catch (error) {
                console.error("Error fetching accepted nasabah list: ", error);
                this.loadContentAccepted = false;
            }
        },
        async fetchRejectedNasabahList() {
            this.loadContentRejected = true;
            let endpoint = `${BASEURL}/api/nasabah/rejected`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search.rejected,
                        'role': this.meta.role,
                        'unit': this.meta.unit,
                    }
                });
                this.collection.nasabah.rejected = response.data.data || response.data;
                this.meta.total.rejected = this.collection.nasabah.rejected.total || 0;
                this.meta.page.rejected.current_page = this.collection.nasabah.rejected.current_page || 1;
                this.meta.page.rejected.last_page = this.collection.nasabah.rejected.last_page || 1;
                this.loadContentRejected = false;
            } catch (error) {
                console.error("Error fetching rejected nasabah list: ", error);
                this.loadContentRejected = false;
            }
        },


        getSubmoduleAccessByUrl(url) {
            console.log('Checking access for URL:', this.meta.accesses);
            if (!Array.isArray(this.meta.accesses)) {
                return null;
            }

            for (const module of this.meta.accesses) {
                if (!Array.isArray(module.submodules)) {
                    continue;
                }

                const subModule = module.submodules.find(sub => sub.url === url);
                if (subModule) {
                    return subModule;
                }
            }

            return null;
        },

        canPerformAction(action) {
            console.log('Checking access for action:', action, this.userSubmoduleAccess?.actions?.includes(action) ?? false);
            return this.userSubmoduleAccess?.actions?.includes(action) ?? false;
        },
    },
    beforeUnmount() {
        if (this.searchTimer) {
            clearTimeout(this.searchTimer);
            this.searchTimer = null;
        }
        this.destroyDataTable();
    },
    computed: {
        userSubmoduleAccess() {
            return this.getSubmoduleAccessByUrl('/nasabah/lists');
        },

        canCreateNasabah() {
            return this.canPerformAction('create');
        },

        canReadNasabah() {
            return this.canPerformAction('read');
        },

        canUpdateNasabah() {
            return this.canPerformAction('update');
        },

        canDeleteNasabah() {
            return this.canPerformAction('delete');
        },
    },

    watch: {
        'meta.search': 'debounceSearchFetch',
        'meta.search.notValidated': 'fetchUnvalidatedNasabahList',
        'meta.search.global': function (newVal) {
            if (this.suggestionTimer) clearTimeout(this.suggestionTimer);
            this.suggestionTimer = setTimeout(() => this.fetchNasabahSuggestions(), 300);
        },
        // 'meta.role': 'fetchUserList',
        // 'meta.unit': 'fetchUserList',
        // 'meta.status': 'fetchUserList',
        // 'meta.requestStatus': function (newVal, oldVal) {
        //     this.fetchUserList();
        // },
        // 'meta.currentTab': function (newTab) {
        //     this.fetchUserListByStatus(newTab);
        // },
    },
}
</script>

<style scoped>
/* Global search label hide animation */
.hide-onclick {
    transition: opacity .22s ease, transform .22s ease;
    display: inline-block;
}

.hidden-text {
    opacity: 0;
    transform: translateX(-6px);
    pointer-events: none;
    width: 0;
    margin-left: 0 !important;
    overflow: hidden;
}

/* Search input transition and wrapper to avoid whitespace when hidden */
.search-input-wrapper {
    display: inline-block;
    vertical-align: middle;
    overflow: visible;
}

.search-input-wrapper input {
    /* width: 100%;
    max-width: 520px; */
    box-sizing: border-box;
    transition: width .32s ease, opacity .22s ease;
}

/* Vue transition classes */
.global-search-enter-from,
.global-search-leave-to {
    width: 0;
    opacity: 0;
}

.global-search-enter-to,
.global-search-leave-from {
    width: 250px;
    opacity: 1;
}

.global-search-enter-active,
.global-search-leave-active {
    transition: width .32s ease, opacity .22s ease;
    display: inline-block;
    overflow: hidden;
}

/* Small visual polish to keep the search aligned */
.input-group .input-group-text {
    cursor: pointer;
    /* margin-right: 8px; */
}

.suggestions-list {
    position: absolute;
    top: calc(100% + 6px);
    left: 0;
    right: 0;
    z-index: 50;
    max-height: 260px;
    overflow: auto;
    border-radius: 6px;
}

.suggestion-item {
    cursor: pointer;
}

.suggestion-item:hover {
    background: #f1f5f9;
}
</style>

<style scoped>
.badge.bg-primary {
    background: rgb(119, 77, 211) !important;
}

.list-doc li,
.list-doc li p {
    white-space: normal;
    float: left;
    width: 100%;
    height: auto;
    word-wrap: break-word;
}

.responsive-description {
    vertical-align: middle;
    word-wrap: break-word;
    min-width: 160px;
    max-width: 100%;
    white-space: normal;
    padding-right: 20px;
}

@media (min-width: 768px) {
    .responsive-description {
        min-width: 200px;
        max-width: 300px;
    }
}

.nav-pills {
    display: flex;
    flex-wrap: nowrap;
    text-align: start;
    width: 100%;
    overflow-x: auto;
}

.nav-pills .nav-item {
    margin: 0 0.25rem;
    width: 250px;
    /* overflow: hidden; */
}

.nav-pills .nav-link {
    border: 1px solid #dee2e6;
    background-color: #ffffff;
    /* border-radius: 0.75rem; */
    /* color: #495057; */
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

.nav-pills .nav-link:hover {
    background-color: #f8f9fa;
    border-color: #ced4da;
    color: #212529;
}

.nav-pills .nav-link.active {
    background-color: #4d7cff09;
    border-color: #4d7cff;
    /* box-shadow: 0 0 0 0.15rem rgba(77, 124, 255, 0.25); */
}

@media (max-width: 425px) {
    .responsive-description {
        min-width: 150px;
        max-width: 200px;
    }
}

@media (min-width: 1024px) {
    .responsive-description {
        min-width: 250px;
        max-width: 400px;
    }
}

.overflow-x {
    -ms-overflow-style: none;
    scrollbar-width: none;
    overflow-x: scroll;
}

.filter-toolbar input.form-control-sm,
.filter-toolbar select.form-select-sm {
    min-width: 120px;
    width: 100%;
}

.filter-wrapper {
    display: flex;
    overflow: hidden;
}

.filter-sidebar {
    width: 100%;
    transition: margin 0.8s ease-in-out;
}

.filter-sidebar.hidden {
    margin-left: -90%;
    transition: margin 1s ease-in-out;
}

#filter-toggleBtn {
    width: 100px;
}

#horz-list ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
    text-align: center;
}

#horz-list ul li {
    display: inline;
}

#horz-list ul li {
    text-decoration: none;
    margin: 10px;
    width: 60px;
    /* border-right: 1px solid rgba(170, 54, 216, 0.8); */
    /* margin: 0 0 0 -6px; */
}

/* #horz-list ul li a:hover {
  background: rgba(255, 255, 255, 0.8);
  color: #1a1a1a;
} */
</style>