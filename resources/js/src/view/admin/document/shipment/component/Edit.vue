<template>
    <!-- modal current qrcode -->
    <div class="modal fade" id="viewEditCurrentQrCode" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button @click="printCurrentQRCode" class="btn btn-primary m-0 font-weight-normal"><i
                            class="fa-solid fa-print"></i> Print</button> -->
                    <button class="btn btn-primary m-0 font-weight-normal" @click="generatePDFBatchEdit"> <i class="fas fa-print"></i> Print QR Code</button>
                    <button type="button" class="btn-close btn-close-white m-0" @click="closeComponent"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5" id="printEditCurrentQrCode">
                    <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="currentQrSvgEdit"></svg>
                    <h3 class="m-0 font-weight-normal">{{ currentQrcode }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Download QR PDF -->
    <div v-if="this.model.details != ''" style="display: none;">
        <div id="pdfContentBatchEdit" class="m-4">
            <div style="display: flex; flex-direction: row; width: 100%;">
                <div style="border: 1px solid black;">
                    <img :src="qrCodeImageBatchEdit" alt="QR Code" id="qrCodeImagePdfBatchEdit"
                        style="width: 250px; height: 250px;" />
                </div>
                <div class="p-4" style="border: 1px solid black; width: 100%;">
                    <p style="font-size: 20px; font-weight: 600; margin-bottom: 0; color: black;">EDOC-TRACKING</p>
                    <table style="width:100%;">
                        <tr>
                            <td style="width: 100px;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">
                                    QR Code
                                </p>
                            </td>
                            <td>
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">
                                    : {{ currentQrcode }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">Label</p>
                            </td>
                            <td>
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">
                                    : {{ this.model.label }}
                                </p>
                            </td>
                        </tr>
                    </table>
                    <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black; margin-top: 12px;">
                        Dengan dokumen terlampir sebanyak : {{ this.model.details.length }} Dokumen
                    </p>
                    <p style="font-size: 14px; font-weight: 500; margin-bottom: 0; color: black;">
                        {{ toText }}
                    </p>
                </div>
            </div>
            <p style="font-size: 14px; font-weight: 600; margin-bottom: 0; color: black; margin-top: 12px;">
                <strong>List dokumen :</strong>
            </p>
            <ul class="list-doc" style="columns: 2;">
                <li v-for="bdet in arraydet" :key="bdet.id">
                    <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                        {{ bdet.label }} (<strong>{{ bdet.unit.name }}</strong>)
                    </p>
                </li>
            </ul>
            <p style="font-size: 14px; font-weight: 600; margin-bottom: 0; color: black;"><strong>Cara Penggunaan
                    :</strong></p>
            <p style="font-size: 14px; font-weight: 600; margin-bottom: 4px; color: black;">Buka website kami
                <strong>https://docs.erp-sistem.com/</strong>
            </p>
            <div style="display: flex; border: 1px solid black;">
                <div style="padding: 8px;">
                    <h6>Prosedur Penerimaan Batch / Dokumen</h6>
                    <ol>
                        <li style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                                Scan QR code yang tertempel pada batch pengiriman / tiap dokumen didalam batch.
                                <br>Untuk alternatif, anda dapat menginputkan angka QR code yang tertera ke kolom input
                                yang telah kami sediakan dibagian bawah layar.
                            </p>
                        </li>
                        <li style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                                Setelah itu akan muncul informasi dari batch pengiriman / dokumen yang telah discan.
                                <br>Untuk melakukan konfirmasi bahwa yang discan sudah sesuai, anda dapat menekan tombol
                                'Confirm'.
                            </p>
                        </li>
                        <li style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                                Proses penerimaan batch pengiriman / dokumen telah selesai.
                            </p>
                        </li>
                    </ol>
                </div>
                <div style="border-left: 1px solid black; padding: 8px;">
                    <h6>Prosedur Pengiriman Dokumen</h6>
                    <ol>
                        <li style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                                Scan QR code yang tertempel pada tiap dokumen yang akan dikirim.
                                <br>Untuk alternatif, anda dapat menginputkan angka QR code yang tertera ke kolom input
                                yang telah kami sediakan dibagian bawah layar.
                            </p>
                        </li>
                        <li style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                                Setelah itu akan muncul informasi dari dokumen yang telah discan.
                                <br>Untuk melakukan konfirmasi bahwa yang discan sudah sesuai, anda dapat menekan tombol
                                'Confirm'
                                <br>*Jika dokumen yang dikirim lebih dari 1, anda dapan mengulangi step pertama.
                            </p>
                        </li>
                        <li style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                                Akan muncul icon pengiriman di kanan atas layar, dengan jumlah dokumen yang telah discan
                                untuk dikirim.<br>
                                Klik icon tersebut dan klik tombol 'Lanjutkan'.
                            </p>
                        </li>
                        <li style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">
                                Muncul layar baru, isi kolom resi dan deskripsi jika diperlukan.<br>
                                Tekan tombol 'Save' untuk menyimpan dan proses pengiriman dokumen telah selesai.
                            </p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- modal send batch -->
    <div class="modal fade" id="sendBatch">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="alert alert-warning fade show m-0" role="alert">
                    <div class=" d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 me-2">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <h5 class="alert-heading m-0">Pengiriman Batch Dokumen</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white m-0" @click="closeComponent"
                            aria-label="Close"></button>
                    </div>
                    <h6 class="alert-heading mt-3"><strong>Pastikan</strong> berikut informasi mengenai batch yang
                        <strong>telah terkirim</strong> :
                    </h6>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Nomor Qrcode</dt>
                        <dd class="col-sm-9">{{ model.number }}</dd>
                        <dt class="col-sm-3">Label</dt>
                        <dd class="col-sm-9">
                            {{ model.label ? model.label : '-' }}
                        </dd>
                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">
                            {{ model.description ? model.description : '-' }}
                        </dd>

                        <dt class="col-sm-3">Details</dt>
                        <dd class="col-sm-9">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start border-0 bg-transparent ps-0"
                                    v-for="det in details" :key="det.id">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ det.edoc.unit.name }} | {{ det.edoc.label }}</div>
                                        {{ det.edoc.description }}
                                    </div>
                                </li>
                            </ol>
                        </dd>
                    </dl>
                    <div class="input-group" style="width: 100%;">
                        <div class="form-floating flex-grow-1" aria-describedby="basic-addon2">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Resi"
                                v-model="model.resi">
                            <label for="floatingInput" class="text-secondary">Input Nomor Resi</label>
                        </div>
                        <button @click.prevent="confirmBatchShipment()" class="input-group-text btn btn-primary m-0"
                            id="basic-addon2"><i class="fa-sharp-duotone fa-solid fa-right-to-bracket"></i>
                            Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal recieve batch -->
    <div class="modal fade" id="receiveBatch">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="alert alert-warning fade show m-0" role="alert">
                    <div class=" d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 me-2">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <h5 class="alert-heading m-0">Penerimaan Batch Dokumen</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white m-0" @click="closeComponent"
                            aria-label="Close"></button>
                    </div>
                    <h6 class="alert-heading mt-3"><strong>Pastikan</strong> berikut informasi mengenai batch yang
                        <strong>telah diterima BLD</strong> :
                    </h6>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Nomor Resi</dt>
                        <dd class="col-sm-9">{{ model.resi ? model.resi : '-' }}</dd>
                        <dt class="col-sm-3">Nomor Qrcode</dt>
                        <dd class="col-sm-9">{{ model.number }}</dd>
                        <dt class="col-sm-3">Label</dt>
                        <dd class="col-sm-9">
                            {{ model.label ? model.label : '-' }}
                        </dd>
                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">
                            {{ model.description ? model.description : '-' }}
                        </dd>

                        <dt class="col-sm-3">Details</dt>
                        <dd class="col-sm-9">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start border-0 bg-transparent ps-0"
                                    v-for="det in details" :key="det.id">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ det.edoc.unit.name }} | {{ det.edoc.label }}</div>
                                        {{ det.edoc.description }}
                                    </div>
                                </li>
                            </ol>
                        </dd>
                    </dl>
                    <div class="text-end m-0">
                        <a class="btn btn-primary m-0" @click="receiveBatch()">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- offcanvas Edit New Document Shipping -->
    <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasEditShipmentRight"
        aria-labelledby="offcanvasEditShipmentRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEditShipmentRightLabel">Edit New Document Shipping</h5>
            <button type="button" class="btn-close btn-close-white" @click="closeComponent" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="label" id="floatingLabel"
                        v-model="model.label">
                    <label for="floatingLabel">Label <span class="text-danger"> *</span></label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingDescription"
                        style="height: 100px" v-model="model.description"></textarea>
                    <label for="floatingDescription">Description</label>
                </div>
                <hr>
                <div class="mb-3 d-flex flex-column">
                    <label class="form-label">Document Lists <span class="text-danger"> *</span></label>
                    <div class="btn-group mb-1" role="group">
                        <template v-for="category in collections.categories">
                            <input type="radio" class="btn-check" :name="'btnradiotable' + category.code"
                                :id="'btnradiotable' + category.code" v-model="meta.category" :value="category.code">
                            <label :for="'btnradiotable' + category.code" class="btn btn-white px-3 mb-0">{{
                                category.name }}</label>
                        </template>
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
                        <input type="text" class="form-control" v-model="meta.search" placeholder="Search">
                    </div>
                    <div class="table-responsive p-0 mb-2">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center text-sm font-weight-semibold">Nomor Memo</th>
                                    <th class="text-center text-sm font-weight-semibold">Judul</th>
                                    <th class="text-center text-sm font-weight-semibold">Unit</th>
                                    <th class="text-center text-sm font-weight-semibold">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in meta.selected ? selectedDetails : filteredItems" :key="item.id"
                                    @click="toggleCheckbox(item.id)">
                                    <td class="text-center text-sm font-weight-semibold">
                                        <input type="checkbox" v-model="model.details" :value="item.id">
                                    </td>
                                    <td class="text-sm font-weight-semibold">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-start ms-1">
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ item.label }}</h6>
                                                <p class="text-sm text-secondary mb-0">{{ item.number }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm font-weight-semibold"
                                        style="vertical-align: middle; word-wrap: break-word; min-width: 160px; max-width: 160px; white-space:normal;">
                                        {{ item.description }}
                                    </td>
                                    <td class="text-center text-sm font-weight-semibold"
                                        style="vertical-align: middle;">
                                        {{ item.unit.name }}
                                    </td>
                                    <td class="text-center text-lg font-weight-semibold m-0"
                                        style="vertical-align: middle;">
                                        <span v-if="item.category.id == 1"
                                            class="badge badge-sm border border-warning text-warning bg-warning">
                                            Reguler
                                        </span>
                                        <span v-if="item.category.id == 2"
                                            class="badge badge-sm border border-danger text-danger bg-danger">
                                            Semi-Urgent
                                        </span>
                                        <span v-if="item.category.id == 3"
                                            class="badge badge-sm border border-info text-info bg-info">
                                            Urgent
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-check form-switch mb-8">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                            v-model="meta.selected">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Show Selected</label>
                    </div>
                </div>
                <div class="position-absolute end-0 bottom-0 me-3">
                    <div class="d-flex">
                        <h6 class="text-sm me-3">{{ model.details.length }} Document terpilih <span class="text-danger">
                                *</span></h6>
                        <button type="button" class="btn btn-primary rounded-1"
                            @click.prevent="confirmUpdate">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../../../eventEmitter.js';
import html2pdf from 'html2pdf.js';
export default {
    data() {
        return {
            modalEdit: '',
            modalPreview: '',
            modalSendBatch: '',
            modalReceiveBatch: '',
            meta: {
                category: '',
                search: '',
                selected: false
            },
            collections: {
                categories: [],
                items: []
            },
            model: {
                id: '',
                number: '',
                label: '',
                description: '',
                details: [],
                status_id: 1,
            },
            resi: '',
            currentQrcode: '',
            selectedDetails: [],
            qrCodeImageBatchEdit: '',
            arraydet: [],
            toText: '',
            details: '',
        }
    },

    mounted() {
        this.modalSendBatch = new bootstrap.Modal('#sendBatch', {
            backdrop: false,
            keyboard: false,
        })
        this.modalReceiveBatch = new bootstrap.Modal('#receiveBatch', {
            backdrop: false,
            keyboard: false,
        })
        this.modalEdit = new bootstrap.Offcanvas('#offcanvasEditShipmentRight', {
            backdrop: false,
            keyboard: false,
        })
        this.modalPreview = new bootstrap.Modal('#viewEditCurrentQrCode', {
            backdrop: false,
            keyboard: false,
        })
        emitter.on('editShipment', async (id) => {
            await this.fetchCategory()
            await this.fetchAvailDocumentList()
            await this.fetchShipment(id)
            await this.openEditOffCanvas()
        });

        emitter.on('sendBatch', async (id) => {
            await this.fetchShipment(id)
            this.openModalSendBatch()
        });

        emitter.on('receiveBatch', async (id) => {
            await this.fetchShipment(id)
            this.confirmReceiveBatch()
        });
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async openEditOffCanvas() {
            this.modalEdit.show()
        },
        openPreviewModal() {
            this.modalPreview.show()
        },
        async fetchCategory() {
            let endpoint = `${BASEURL}/api/edoc/category/options`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                let fetchedCategories = response.data.data.options;

                this.collections.categories = [
                    { code: '', name: 'All' },
                    ...fetchedCategories.map(category => ({
                        code: category.code,
                        name: category.name.toLowerCase().replace(/_/g, ' ').replace(/^\w/, c => c.toUpperCase())
                    }))
                ];
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        async fetchAvailDocumentList() {
            let endpoint = `${BASEURL}/api/secretary/edocs/available`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.collections.items = response.data.data.edocs
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        async fetchShipment(id) {
            let endpoint = `${BASEURL}/api/batches/${id}`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.model.id = id
                this.model.number = response.data.data.number
                this.model.resi = response.data.data.resi
                this.model.label = response.data.data.label
                this.model.description = response.data.data.description
                this.details = response.data.data.details
                this.model.details = this.details.map(item => item.edoc.id)

                let modifiedEdocs = []
                response.data.data.details.forEach((item) => {
                    let edoc = item.edoc
                    edoc.category = { id: edoc.category }
                    modifiedEdocs.push(edoc)
                })

                this.collections.items.unshift(...modifiedEdocs)
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        async confirmUpdate() {
            Swal.fire({
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
            if (this.model.label == '') {
                Swal.fire('Kesalahan', 'Label document harus diisi.', 'error')
                return false
            }

            if (this.model.details.length == 0) {
                Swal.fire('Kesalahan', 'List document harus ada yang dipilih', 'error')
                return false
            }

            Swal.close()

            Swal.fire({
                title: 'Simpan?',
                text: "Pastikan data yang anda edit sudah benar",
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
            let endpoint = `${BASEURL}/api/batches/${this.model.id}`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let formData = new FormData()
                Object.keys(this.model).forEach(key => {
                    if (key != 'description' && key != 'resi') {
                        if (Array.isArray(this.model[key]) || typeof this.model[key] === 'object') {
                            formData.append(key, JSON.stringify(this.model[key]))
                        } else {
                            formData.append(key, this.model[key])
                        }
                    }
                })
                if (this.model.description) {
                    formData.append('description', this.model.description)
                }
                if (this.model.resi != '' && this.model.resi != null) {
                    formData.append('resi', this.model.resi)
                }
                formData.append('_method', 'put')

                let response = await axios.post(endpoint, formData, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
                Swal.close()
                if (response) {
                    Swal.fire({
                        title: 'Penyimpanan Berhasil. Print?',
                        text: "Apakah anda ingin print qrcode sekarang?",
                        icon: 'success',
                        showCancelButton: true,
                        allowOutsideClick: false,
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
                console.error("Error update batch: ", error);
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
                });
            }
        },
        async openModalSendBatch() {
            this.model.status_id = 2
            this.modalSendBatch.show()
        },
        async confirmBatchShipment() {
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                if (this.model.resi != '' && this.model.resi != null) {
                    await this.storeResi()
                }
                await this.sendBatch()
                Swal.close()
                Swal.fire({
                    title: 'Berhasil',
                    text: "Update status pengiriman berhasil disimpan",
                    icon: 'success',
                    allowOutsideClick: false,
                    showCancelButton: false,
                }).then((result) => {
                    if (result.value) {
                        this.closeComponent()
                    }
                })

            } catch (error) {
                console.error("Error update pengiriman batch: ", error);
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
                });
            }
        },
        async storeResi() {
            let endpoint = `${BASEURL}/api/batch/shipment-number/${this.model.id}`

            try {
                let response = await axios.post(endpoint,
                    {
                        'resi': this.model.resi
                    }, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token()
                    }
                })
            } catch (error) {
                console.error("Error store resi: ", error);
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
                });
            }
        },
        async sendBatch() {
            let endpoint = `${BASEURL}/api/batches/${this.model.id}`
            try {
                let formData = new FormData()
                Object.keys(this.model).forEach(key => {
                    if (key != 'description' && key != 'resi') {
                        if (Array.isArray(this.model[key]) || typeof this.model[key] === 'object') {
                            formData.append(key, JSON.stringify(this.model[key]))
                        } else {
                            formData.append(key, this.model[key])
                        }
                    }
                })
                if (this.model.description) {
                    formData.append('description', this.model.description)
                }
                if (this.model.resi != '' && this.model.resi != null) {
                    formData.append('resi', this.model.resi)
                }
                formData.append('_method', 'put')
                let response = await axios.post(endpoint, formData, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
            } catch (error) {
                console.error("Error update pengiriman batch: ", error);
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
                });
            }
        },
        async confirmReceiveBatch() {
            this.model.status_id = 3
            this.modalReceiveBatch.show()
        },
        async receiveBatch() {
            let endpoint = `${BASEURL}/api/batches/${this.model.id}`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    text: 'Sedang diproses, mohon ditunggu..',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let formData = new FormData()
                Object.keys(this.model).forEach(key => {
                    if (key != 'description' && key != 'resi') {
                        if (Array.isArray(this.model[key]) || typeof this.model[key] === 'object') {
                            formData.append(key, JSON.stringify(this.model[key]))
                        } else {
                            formData.append(key, this.model[key])
                        }
                    }
                })
                if (this.model.description) {
                    formData.append('description', this.model.description)
                }
                if (this.model.resi != '' && this.model.resi != null) {
                    formData.append('resi', this.model.resi)
                }
                formData.append('_method', 'put')
                let response = await axios.post(endpoint, formData, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })

                Swal.close()

                if (response) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: "Update status penerimaan berhasil disimpan",
                        icon: 'success',
                        allowOutsideClick: false,
                        showCancelButton: false,
                    }).then((result) => {
                        if (result.value) {
                            this.closeComponent()
                        }
                    })
                }
            } catch (error) {
                console.error("Error update penerimaan batch: ", error);
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
                });
            }
        },
        toggleCheckbox(itemId) {
            if (this.model.details.includes(itemId)) {
                this.model.details = this.model.details.filter(id => id !== itemId);
            } else {
                this.model.details.push(itemId);
            }

            this.arraydet = (this.collections.items.filter(item => this.model.details.includes(item.id)))
        },
        viewCurrentQRCode(qrcode) {

            const categoryCounts = {};
            this.arraydet.forEach(item => {
                const category = item.category.id;
                if (categoryCounts[category]) {
                    categoryCounts[category] += 1;
                } else {
                    categoryCounts[category] = 1;
                }
            });
            const groupedCounts = Object.entries(categoryCounts).map(([category, count]) => {
                return { category, count };
            });
            const categoryMapping = {
                '1': 'Regular',
                '2': 'Semi-Urgent',
                '3': 'Urgent',
            };
            this.toText = groupedCounts.map(item => {
                const displayName = categoryMapping[item.category];
                return `${displayName} : ${item.count} Dokumen`;
            }).join(', ');

            var opts = {
                errorCorrectionLevel: "H",
                type: "image/jpeg",
                width: 500,
                rendererOpts: {
                    quality: 0.5,
                },
            };

            this.currentQrcode = qrcode;

            // generate qrcode
            QRCode.toDataURL(qrcode, opts, (err, url) => {
                if (err) throw err;
                this.qrCodeImageBatchEdit = url;
                var svgimg = document.createElementNS("http://www.w3.org/2000/svg", "image");
                svgimg.setAttribute("width", "94");
                svgimg.setAttribute("height", "94");
                svgimg.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", url);
                document.getElementById("currentQrSvgEdit").appendChild(svgimg);
                $("#qr-download").attr("href", url);
            });

            this.openPreviewModal()

        },
        generatePDFBatchEdit() {
            Swal.fire({
                timer: 2000,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })
            const element = document.getElementById('pdfContentBatchEdit');
            html2pdf()
                .from(element)
                // .save('qrcode.pdf');
                .toPdf()
                .get('pdf')
                .then((pdf) => {
                    const blob = pdf.output('blob');
                    const url = URL.createObjectURL(blob);

                    const newTab = window.open(url);

                    newTab.onload = () => {
                        newTab.print();
                    };
                });
        },
        closeComponent() {
            this.modalPreview.hide()
            this.modalEdit.hide()
            this.modalEdit.hide()
            this.modalSendBatch.hide()
            this.modalReceiveBatch.hide()
            this.resetForm()
            emitter.emit('fetchShipmentList');
        },
        resetForm() {
            this.resi = '';
            this.model.label = '';
            this.model.description = '';
            this.model.details = [];

            this.meta.category = '';
            this.meta.search = '';
            this.meta.selected = false;

            this.collections.categories = [];
            this.collections.items = [];

            this.currentQrcode = '';
            this.selectedDetails = [];
        },
    },
    computed: {
        filteredItems() {
            let filtered = this.collections.items;
            if (this.meta.category !== '') {
                filtered = filtered.filter(item => item.category.id.toString() == this.meta.category);
            }

            if (this.meta.search !== '') {
                filtered = filtered.filter(item =>
                    item.label.toLowerCase().includes(this.meta.search.toLowerCase()) ||
                    item.number.toLowerCase().includes(this.meta.search.toLowerCase())
                );
            }
            return filtered;
        }
    },
    watch: {
        'meta.selected': function (newVal) {
            if (newVal) {
                this.selectedDetails = this.collections.items.filter(item => this.model.details.includes(item.id));
            } else {
                this.selectedDetails = [];
            }
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

.list-doc li,
.list-doc li p {
    white-space: normal;
    float: left;
    width: 100%;
    height: auto;
    word-wrap: break-word;
}
</style>