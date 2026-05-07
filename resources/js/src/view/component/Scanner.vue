<template>
    <!-- Modal for file preview -->
    <div class="modal fade" id="modaluploadpreview" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-keyboard="false" style="z-index: 10000;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ detail.label }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-if="detail.isImage">
                        <img :src="detail.filePreview" alt="Preview" class="img-fluid" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div v-if="!pauseScanner" class="modal-content">
                <qrcode-stream v-if="componentOpened" @error="onInit" @detect="onDecode" :constraints="{ facingMode }"
                    style="position: absolute;" />
                <div class="modal-body m-0 p-0" style="height:100%">
                    <div class="mt-4">
                        <h3 class="text-center m-0 p-0 blend">EDOC TRACKING</h3>
                        <hr>
                        <h5 class="text-center pb-4 blend">Scan QR-Code <i class="fas fa-qrcode"></i> Document</h5>
                    </div>
                    <!-- <button type="button" class="btn-close btn-close-white"
                        style="position: absolute; z-index: 1; top: 1em; right: 1em;" @click.prevent="killCamera"
                        aria-label="Close">
                    </button> -->
                    <a style="position: absolute; z-index: 1; top: 1em; right: 1em; mix-blend-mode: difference;"
                        @click.prevent="killCamera">
                        <span class="blend" style="font-size: 1.5em">
                            <i class="fas fa-times">
                                <span class="sr-only text-sm">
                                    x
                                </span>
                            </i>
                        </span>
                    </a>
                    <a style="position: absolute; z-index: 1; bottom: 2em; right: 2em; mix-blend-mode: difference;"
                        @click.prevent="switchCamera">
                        <span class="blend" style="font-size: 1.5em">
                            <i class="fas fa-sync-alt blend">
                                <span class="sr-only text-sm">
                                    Rotate Camera
                                </span>
                            </i>
                        </span>
                    </a>
                </div>
                <div class="alert alert-info m-0" role="alert">
                    <h5 class="alert-heading"><i class="fa-duotone fa-solid fa-circle-info me-1"></i>
                        Alternatif</h5>
                    <p>Atau anda bisa menggunakan QR-Code</p>
                    <hr>
                    <div class="input-group" style="width: 100%;">
                        <div class="form-floating flex-grow-1" aria-describedby="basic-addon2">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Kode QR"
                                v-model="qrcodescanner" v-on:keyup.enter="onDecode(qrcode)">
                            <label for="floatingInput" class="text-secondary">Input QR-Code Here</label>
                        </div>
                        <button @click.prevent="onDecode(qrcode)" class="input-group-text btn btn-primary m-0"
                            id="basic-addon2">
                            <i class="fas fa-sign-in-alt">
                                <span class="sr-only text-sm">
                                    Confirm
                                </span>
                            </i>
                        </button>
                    </div>
                </div>
            </div>
            <div v-else class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel"></h5>
                    <button type="button" class="btn-close btn-close-white" aria-label="Close"
                        @click.prevent="killCamera"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info m-0" role="alert">
                        <h4 class="alert-heading" v-if="!done">Update Status E-Document</h4>
                        <h4 class="alert-heading" v-else>Status E-Document</h4>
                        <p v-if="!done">Rubah status penerimaan e-document berikut :</p>
                        <hr>
                        <dl class="row">
                            <dt class="col-sm-3">QR Code</dt>
                            <dd class="col-sm-9">{{ model.document.number }}</dd>

                            <dt class="col-sm-3">Nomor Memo</dt>
                            <dd class="col-sm-9">{{ model.document.label }}</dd>

                            <dt class="col-sm-3">Judul</dt>
                            <dd class="col-sm-9">
                                {{ model.document.description ? model.document.description : '-' }}
                            </dd>

                            <dt class="col-sm-3">Kategori</dt>
                            <dd class="col-sm-9" v-if="model.document.category == 1">
                                Reguler
                            </dd>
                            <dd class="col-sm-9" v-else-if="model.document.category == 2">
                                Semi-Urgent
                            </dd>
                            <dd class="col-sm-9" v-else>
                                Urgent
                            </dd>

                            <dt class="col-sm-3">Detail</dt>
                            <dd class="col-sm-9">
                                <ol class="list-group list-group-numbered">
                                    <li class="list-group-item d-flex justify-content-between align-items-start border-0 bg-transparent ps-0"
                                        v-for="det in model.document.details" :key="det.id">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ det.label }}</div>
                                            {{ det.desc }}
                                        </div>
                                        <div class="ms-0 me-auto">
                                            <div class="fw-bold">Nominal</div>
                                            <input class="form-control shadow-none border border-0 bg-transparent"
                                                placeholder="Nominal" v-model.lazy="det.nominals" v-money="money"
                                                disabled />
                                        </div>
                                    </li>
                                </ol>
                            </dd>
                        </dl>
                    </div>
                    <!-- <div class="form-floating mt-3 mb-3">
                        <select class="form-select form-select-lg" id="editStatuses"
                            aria-label="Floating label select example" v-model="model.status_id" :disabled="disabled">
                            <option disabled>Choose Document Category</option>
                            <option v-for="(row, index) in collections.statuses" :key="index" :value="row.status_code">
                                {{ row.status_message }}
                            </option>
                        </select>
                        <label for="editStatuses">Category</label>
                    </div> -->
                    <div v-if="!disabled">
                        <div v-if="phase == 6 || phase == 7" class="alert alert-warning mt-3 mb-3" role="alert">
                            <div class="form-check form-switch d-flex align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                    v-model="meta.upload">
                                <label class="form-check-label m-0 alert-heading fs-6 fw-bold w-100"
                                    for="flexSwitchCheckDefault">Upload File</label>
                            </div>
                            <div v-if="meta.upload">
                                <hr>
                                <div class="form-floating mb-2 mt-2">
                                    <input type="text" class="form-control border-0" id="floatingInput1"
                                        placeholder="Label File" v-model="detail.label">
                                    <label for="floatingInput1">Label File<span class="text-danger"> *</span></label>
                                </div>
                                <div class="form-floating mb-2">
                                    <textarea class="form-control border-0" placeholder="Leave a note here" id="desc1"
                                        style="height: 100px" v-model="detail.description"></textarea>
                                    <label for="desc1">Deskripsi</label>
                                </div>
                                <div style="display: flex; height: 100%;">
                                    <input type="file" class="form-control rounded-0 rounded-start rounded-end border-0"
                                        accept=".jpg, .jpeg, .png, .pdf" @change="handleFileUpload">
                                    <a class="input-group-text rounded-0 rounded-end border-0 bg-transparent text-primary"
                                        @click.prevent="showFilePreview" id="exampleModal">
                                        <i class="fad fa-eye">
                                            <span class="sr-only text-sm">
                                                Preview
                                            </span>
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="!disabled">
                        <div v-if="phase == 1 || phase == 3" class="alert alert-warning mt-3 mb-3" role="alert">
                            <div class="form-check form-switch d-flex align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                    v-model="meta.changeCategory">
                                <label class="form-check-label m-0 alert-heading fs-6 fw-bold w-100"
                                    for="flexSwitchCheckDefault">Ubah Kategori</label>
                            </div>
                            <div v-if="meta.changeCategory">
                                <hr>
                                <div class="form-floating mb-3">
                                    <select class="form-select form-select-lg" id="editfloatingCategory"
                                        aria-label="Floating label select example" v-model="model.document.category_id">
                                        <option disabled value="">Pilih Kategori Dokumen</option>
                                        <option v-for="(row, index) in collections.categories" :key="index"
                                            :value="row.code"> {{
                                                row.name }}</option>
                                    </select>
                                    <label for="editfloatingCategory">Kategori<span class="text-danger">
                                            *</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-floating mb-3" v-if="!done && !disabled">
                        <textarea class="form-control" placeholder="Leave a note here" id="floatingTextarea2"
                            style="height: 100px" v-model="model.note" :disabled="disabled"></textarea>
                        <label for="floatingTextarea2">Note</label>
                    </div>
                </div>
                <div v-if="disabled && !done" class="alert alert-warning d-flex align-items-center m-3" role="alert">
                    <i class="fa-duotone fa-solid fa-triangle-exclamation me-2 fs-2"></i>
                    <div>
                        Status document saat ini : {{ currentStatus }}
                    </div>
                </div>
                <div v-else class="modal-footer">
                    <div v-if="phase == 1 || phase == 3">
                        <button class="btn btn-danger mb-0 me-3" @click.prevent="confirmStore('Reject')">Reject</button>
                        <button class="btn btn-success mb-0 ms-3"
                            @click.prevent="confirmStore('Approve')">Approve</button>
                    </div>
                    <div v-if="phase == 6 || phase == 7">
                        <button class="btn btn-primary mb-0 me-3"
                            @click.prevent="confirmStore('AcceptSect')">Terima</button>
                    </div>
                    <div v-if="phase == 8">
                        <button class="btn btn-info mb-0 me-3" @click.prevent="confirmStore('AcceptUser')">User Terima
                            Dokumen</button>
                    </div>
                    <div class="w-100" v-if="done">
                        <div class="alert alert-success m-0" role="alert">
                            <h4 class="alert-heading">Selesai !</h4>
                            <p>Proses tracking document telah selesai. Status saat ini : <strong>Dokumen telah diterima
                                    user</strong></p>
                            <hr>
                            <p class="mb-0 text-xs">Jika ada ketidak sesuaian, mohon hubungi bagian terkait</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { VMoney } from 'v-money'
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../eventEmitter.js';
import { QrcodeStream, QrcodeCapture } from 'vue-qrcode-reader'
export default {
    directives: { money: VMoney },
    name: 'ScannerModal',
    components: {
        QrcodeStream,
    },
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
            role_id: '',
            disabled: false,
            done: false,
            currentStatus: '',
            modalScanner: '',
            componentOpened: false,
            collections: {
                statuses: [],
                categories: [],
            },
            meta: {
                upload: false,
                changeCategory: false
            },
            detail: {
                label: '',
                description: '',
                nominal: 0,
                file: null,
                filePreview: null,
                isImage: false,
                isPdf: false,
                change: true,
                checked: true
            },
            modaluploadpreview: '',
            qrcode: '',
            qrcodescanner: '',
            model: {
                status_id: '',
                note: '',
                document: [],
            },
            previousCategory: '',
            pauseScanner: false,
            facingMode: 'environment',
            phase: '',
        }
    },

    mounted() {
        emitter.on('ScannerModal', async (role_id) => {
            this.role_id = role_id
            this.modalScanner = new bootstrap.Modal('#scanModal', {
                backdrop: 'static',
                keyboard: false,
            })
            this.openModal()
        });
        $('.editStatuses').on('change', (event) => {
            this.model.status_id = event.target.value;
        });
        this.modaluploadpreview = new bootstrap.Modal('#modaluploadpreview', {
            backdrop: 'static',
            keyboard: false,
        })
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        openModal() {
            this.startCamera()
            this.modalScanner.show()
        },
        startCamera() {
            this.componentOpened = true
        },
        killCamera() {
            this.modalScanner.hide()
            this.componentOpened = false
            this.pauseScanner = false
            this.qrcode = ''
            this.collections.statuses = []
            this.model.status_id = ''
            this.model.note = ''
            this.model.document = []
            this.done = false
            this.changeCategory = false
        },
        switchCamera() {
            console.log(this.facingMode)
            switch (this.facingMode) {
                case 'environment':
                    this.facingMode = 'user'
                    break
                case 'user':
                    this.facingMode = 'environment'
                    break
            }
        },
        async onDecode(scanned) {
            this.qrcode = Array.isArray(scanned) ? scanned[0].rawValue : this.qrcodescanner
            this.pauseScanner = true
            this.disabled = false
            try {
                Swal.showLoading()
                let endpoint = `${BASEURL}/api/edoc/${this.qrcode}`
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.model.document = response.data.data
                this.model.document.category_id = this.model.document.category

                this.model.document.details.forEach((detail, index) => {
                    this.model.document.details[index].nominals = this.model.document.details[index].nominal.toFixed(2).replace('.', ',')
                });

                this.previousCategory = this.model.document.category
                this.phase = this.model.document.statuses[0].dict_edoc_status.status_code
                if (this.phase == 2 || this.phase == 4 || this.phase == 5) {
                    this.disabled = true
                }
                if (this.phase == 1 || this.phase == 3) {
                    await this.fetchCategories()
                }
                await this.fetchStatus()
                Swal.close()
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
                this.pauseScanner = false
                return false
            }
        },
        async onInit(promise) {
            try {
                await promise
            } catch (error) {
                if (error.name === 'NotAllowedError') {
                    this.error = "ERROR: you need to grant camera access permisson"
                } else if (error.name === 'NotFoundError') {
                    this.error = "ERROR: no camera on this device"
                } else if (error.name === 'NotSupportedError') {
                    this.error = "ERROR: secure context required (HTTPS, localhost)"
                } else if (error.name === 'NotReadableError') {
                    this.error = "ERROR: is the camera already in use?"
                } else if (error.name === 'OverconstrainedError') {
                    this.error = "ERROR: installed cameras are not suitable"
                } else if (error.name === 'StreamApiNotSupportedError') {
                    this.error = "ERROR: Stream API is not supported in this browser"
                }
            }
        },
        showFilePreview() {
            if (this.detail.file) {
                if (this.detail.isPdf) {
                    window.open(this.detail.filePreview, '_blank');
                } else {
                    this.modaluploadpreview.show()
                }
            }
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            this.detail.file = file;
            if (file.type.includes('image')) {
                this.detail.filePreview = URL.createObjectURL(file)
                this.detail.isImage = true
                this.detail.isPdf = false
            }
            else if (file.type === 'application/pdf') {
                this.detail.filePreview = URL.createObjectURL(file)
                this.detail.isImage = false
                this.detail.isPdf = true
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
                $('#editfloatingCategory').val(this.model.document.category_id).trigger('change');
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        async fetchStatus() {
            let endpoint = `${BASEURL}/api/edoc/status/options`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })

                this.model.status_id = this.model.document.statuses[0].status_id
                this.currentStatus = this.model.document.statuses[0].dict_edoc_status.status_message
                let filteredStatuses = response.data.data.options.filter(option => parseInt(option.status_code) >= this.model.status_id);
                if (this.role_id != 1) {
                    if (this.model.status_id < 8) {
                        this.disabled = true
                    }
                }
                if (this.model.status_id == 9) {
                    this.done = true
                }
                this.collections.statuses = filteredStatuses;

                $('#editStatuses').val(this.model.status_id).trigger('change');
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        async confirmStore(phase) {
            let texts = '';
            if (phase == 'Reject') {
                this.model.status_id = 3
                texts = 'Tolak pengajuan dokumen ?'
            }
            if (phase == 'Approve') {
                this.model.status_id = 2
                texts = 'Terima pengajuan dokumen ?'
                if (this.meta.changeCategory) {
                    texts = 'Terima pengajuan dokumen dan ubah kategori ?'
                }
            }
            if (phase == 'AcceptSect') {
                this.model.status_id = 8
                texts = this.meta.upload ? 'Apakah dokumen sudah diterima sekretaris ? Pastikan file yang terupload sudah sesuai' : 'Apakah dokumen sudah diterima sekretaris ?'
            }
            if (phase == 'AcceptUser') {
                this.model.status_id = 9
                texts = 'Apakah dokumen sudah diterima user ?'
            }

            if (this.model.status_id == '') {
                Swal.fire('Kesalahan', 'Label document harus diisi.', 'error')
                return false
            }

            if (this.meta.upload) {

                if (this.detail.label == '') {
                    Swal.fire('Kesalahan', 'Label upload file harus diisi.', 'error')
                    return false
                }
                if (!this.detail.file) {
                    Swal.fire('Kesalahan', 'Silahkan upload file terlebih dahulu.', 'error')
                    return false
                }

                this.model.document.category_id = this.model.document.category
                this.model.document.status_id = this.model.status_id
                this.model.document.details.push(this.detail)
            }

            if (this.meta.changeCategory) {
                if (this.previousCategory == this.model.document.category_id) {
                    Swal.fire('Kesalahan', 'Silahkan ganti kategori terlebih dahulu.', 'error')
                    return false
                }
                this.model.document.status_id = 2
            }

            Swal.fire({
                title: 'Simpan?',
                text: texts,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.value) {
                    if (this.meta.upload || this.meta.changeCategory) {
                        this.update()
                    } else {
                        this.store()
                    }
                }
            })
        },
        async store() {
            let endpoint = `${BASEURL}/api/edoc/status/${this.model.document.id}`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.post(endpoint, this.model, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
                Swal.close()
                if (response.data.status) {
                    emitter.emit('fetchDocumentList');
                    Swal.fire({
                        title: response.data.message,
                        text: "Apakah anda ingin scan document lain?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Scan',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            this.rescan()
                        } else {
                            this.killCamera()
                        }
                    })
                }
            } catch (error) {
                console.error("Error store docs status on scanner component: ", error);
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
        async update() {
            let endpoint = `${BASEURL}/api/secretary/edocs/${this.model.document.id}?_method=PUT`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.post(endpoint, this.model.document, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
                Swal.close()
                if (response.data.status) {
                    emitter.emit('fetchDocumentList');
                    Swal.fire({
                        title: response.data.message,
                        text: "Apakah anda ingin scan document lain?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Scan',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            this.rescan()
                        } else {
                            this.killCamera()
                        }
                    })
                }
            } catch (error) {
                console.error("Error update status on scanner component: ", error);
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
        rescan() {
            this.startCamera()
            this.pauseScanner = false
            this.disabled = false
        }
    },
    computed: {
    },
    watch: {
        'meta.upload': function (newVal) {
            if (newVal) {
                this.detail.label = this.model.document.label
                this.detail.description = 'Di upload oleh sekertaris'
            } else {
                this.detail.label = ''
                this.detail.description = ''
            }
        },
    },
}
</script>
<style scoped>
.blend {
    color: white;
    mix-blend-mode: difference;
}
</style>