<template>
    <!-- modal recieve batch -->
    <div class="modal fade" id="confirmationReceiveBatch" data-bs-keyboard="false" tabindex="-1">
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
                        <strong>telah diterima</strong> :
                    </h6>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Nomor Resi</dt>
                        <dd class="col-sm-9">{{ model.batch.resi ? model.batch.resi : '-' }}</dd>
                        <dt class="col-sm-3">Nomor Qrcode</dt>
                        <dd class="col-sm-9">{{ model.batch.number }}</dd>
                        <dt class="col-sm-3">Label</dt>
                        <dd class="col-sm-9">
                            {{ model.batch.label ? model.batch.label : '-' }}
                        </dd>
                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">
                            {{ model.batch.description ? model.batch.description : '-' }}
                        </dd>
                        <dt class="col-sm-3">Details</dt>
                        <dd class="col-sm-9">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start border-0 bg-transparent ps-0"
                                    v-for="det in model.batch.det" :key="det.id">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ det.edoc.unit.name }} | {{ det.edoc.label }}</div>
                                        {{ det.edoc.description }}
                                    </div>
                                </li>
                            </ol>
                        </dd>
                    </dl>
                    <div class="text-end m-0">
                        <a class="btn btn-primary m-0" @click="receiveBatchBod()">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal recieve docs -->
    <div class="modal fade" id="confirmationReceiveDocs" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="alert alert-warning fade show m-0" role="alert">
                    <div class=" d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 me-2">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <h5 class="alert-heading m-0">Penerimaan Dokumen</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white m-0" @click="closeComponent"
                            aria-label="Close"></button>
                    </div>
                    <h6 class="alert-heading mt-3"><strong>Pastikan</strong> berikut informasi mengenai document yang
                        <strong>telah diterima</strong> :
                    </h6>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Nomor Qrcode</dt>
                        <dd class="col-sm-9">{{ model.document.number }}</dd>

                        <dt class="col-sm-3">Nomor Memo</dt>
                        <dd class="col-sm-9">{{ model.document.label }}</dd>

                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ model.document.description }}</dd>
                    </dl>
                    <div class="text-end m-0">
                        <a class="btn btn-primary m-0" @click="receiveDocs()">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal send docs -->
    <div class="modal fade" id="confirmationSendDocs" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="alert alert-warning fade show m-0" role="alert">
                    <div class=" d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 me-2">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <h5 class="alert-heading m-0">Pengiriman Dokumen</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white m-0" @click="closeComponent"
                            aria-label="Close"></button>
                    </div>
                    <h6 class="alert-heading mt-3">Status dokumen saat ini
                        <strong>sudah diterima</strong>.
                        <br>
                        <strong>Lanjutkan ke proses pengiriman</strong> ?
                    </h6>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Nomor Qrcode</dt>
                        <dd class="col-sm-9">{{ model.document.number }}</dd>

                        <dt class="col-sm-3">Nomor Memo</dt>
                        <dd class="col-sm-9">{{ model.document.label }}</dd>

                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ model.document.description }}</dd>
                    </dl>
                    <div class="text-end m-0">
                        <a class="btn btn-primary m-0" @click="sendDocs()">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../eventEmitter.js';
export default {
    name: 'ConfirmationModal',
    data() {
        return {
            modalBatchConfirmation: '',
            modalDocsConfirmation: '',
            modalDocsShipment: '',
            qrcode: '',
            model: {
                batch: {
                    number: '',
                    resi: '',
                    label: '',
                    description: '',
                    details: [],
                    status_id: '',
                },
                document: {
                    status_id: '',
                    id: '',
                    note: '',
                    number: '',
                    details: [],
                    label: '',
                    description: ''
                }
            },
            currentQrcode: '',
            selectedDetails: [],
        }
    },

    mounted() {
        emitter.on('ConfirmationModal', async (qrcode) => {
            this.qrcode = qrcode
            this.modalBatchConfirmation = new bootstrap.Modal('#confirmationReceiveBatch', {
                backdrop: false,
                keyboard: false,
            })
            this.modalDocsConfirmation = new bootstrap.Modal('#confirmationReceiveDocs', {
                backdrop: false,
                keyboard: false,
            })
            this.modalDocsShipment = new bootstrap.Modal('#confirmationSendDocs', {
                backdrop: false,
                keyboard: false,
            })

            await this.fetchBatchShipment()
        });
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async fetchBatchShipment() {
            let endpoint = `${BASEURL}/api/public/qr/${this.qrcode}`
            try {
                let response = await axios.get(endpoint)
                if (response.data.type == 'edoc') {
                    let status_id = response.data.data.statuses[0].status_id
                    let current_status = response.data.data.statuses[0].dict_edoc_status.status_message
                    this.model.document.id = response.data.data.id
                    this.model.document.number = response.data.data.number
                    this.model.document.label = response.data.data.label
                    this.model.document.description = response.data.data.description
                    this.model.document.details = response.data.data.details

                    if (status_id == 5) {
                        this.openModalReceiveDocs()
                    } else if (status_id == 6) {
                        this.openModalSendDocs()
                    } else {
                        Swal.fire({
                            title: 'Dokumen telah diproses',
                            text: 'Progress document saat ini: ' + current_status,
                            icon: 'info',
                            showConfirmButton: true,
                            showCancelButton: false,
                            confirmButtonText: 'Oke, Scan lainnya !',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                this.closeComponent()
                            }
                        })
                    }

                } else {
                    let statusb_id = response.data.data.statuses[0].status_id
                    let currentb_status = response.data.data.statuses[0].dict_batch_status.status_message
                    if (statusb_id == 1 || statusb_id == 2) {
                        this.model.batch.id = response.data.data.id
                        this.model.batch.number = response.data.data.number
                        this.model.batch.resi = response.data.data.resi
                        this.model.batch.label = response.data.data.label
                        this.model.batch.description = response.data.data.description
                        this.model.batch.details = response.data.data.details.map(item => item.edoc.id);
                        this.model.batch.det = response.data.data.details;
                        this.openModal()
                    } else {
                        Swal.fire({
                            title: 'Batch dokumen telah diproses',
                            text: 'Status batch saat ini: ' + currentb_status,
                            icon: 'info',
                            showConfirmButton: true,
                            showCancelButton: false,
                            confirmButtonText: 'Oke, Scan lainnya !',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                this.closeComponent()
                            }
                        })
                    }
                }
            } catch (error) {
                this.closeComponent()
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }

        },
        async openModal() {
            this.modalBatchConfirmation.show()
        },
        async openModalReceiveDocs() {
            this.modalDocsConfirmation.show()
        },
        async openModalSendDocs() {
            this.modalDocsShipment.show()
        },
        async receiveBatchBod() {
            let endpoint = `${BASEURL}/api/public/batches/${this.model.batch.number}`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let requestData = {}
                this.model.batch.status_id = 3
                Object.keys(this.model.batch).forEach((key) => {
                    if (key !== 'description') {
                        requestData[key] = this.model.batch[key]
                    }
                })
                if (this.model.batch.description) {
                    requestData['description'] = this.model.batch.description
                }

                let response = await axios.put(endpoint, requestData, {
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                Swal.close()
                if (response) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Update status penerimaan berhasil disimpan',
                        icon: 'success',
                        showCancelButton: false,
                    }).then((result) => {
                        if (result.value) {
                            this.closeComponent()
                        }
                    })
                }
            } catch (error) {
                console.error("Error receiving batch on BOD: ", error);
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
                this.closeComponent()
                return false
            }
        },
        async receiveDocs() {
            this.model.document.status_id = 6
            let endpoint = `${BASEURL}/api/public/edoc/status/${this.model.document.id}`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.post(endpoint, this.model.document, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                })
                Swal.close()
                this.closeComponent()
                Swal.fire({
                    title: 'Berhasil',
                    text: "Document berhasil diterima",
                    icon: 'success',
                })

            } catch (error) {
                console.error("Error receiving docs on BOD: ", error);
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
                this.closeComponent()
                return false
            }
        },
        async sendDocs() {
            emitter.emit('sendDocument', this.model.document)
            this.closeComponent()
        },
        resetForm() {
            this.qrcode = ''

            this.model.batch.resi = ''
            this.model.batch.label = ''
            this.model.batch.details = []
            this.model.batch.status_id = ''
            this.model.batch.description = ''

            this.model.document.status_id = ''
            this.model.document.id = ''
            this.model.document.note = ''
            this.model.document.number = ''
            this.model.document.label = ''
        },
        closeComponent() {
            this.modalBatchConfirmation.hide()
            this.modalDocsConfirmation.hide()
            this.modalDocsShipment.hide()
            this.resetForm()
            emitter.emit('Rescan');
        },
    },
    computed: {
    },
    watch: {
    },
}
</script>