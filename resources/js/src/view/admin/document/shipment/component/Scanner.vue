<template>
    <div class="modal fade" id="scanModalAdd" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div v-if="!pauseScanner" class="modal-content">
                <qrcode-stream v-if="componentOpened" @error="onInit" @detect="onDecode" :constraints="{ facingMode }"
                    style="position: absolute;" />
                <div class="modal-body m-0 p-0" style="height:100%">
                    <div class="mt-4">
                        <h3 class="text-center m-0 p-0 blend">EDOC TRACKING</h3>
                        <hr>
                        <h5 class="text-center pb-4 blend">Scan QR-Code <i class="fa-light fa-qrcode"></i> Document</h5>
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
                                    X
                                </span>
                            </i>
                        </span>
                    </a>
                    <a style="position: absolute; z-index: 1; bottom: 2em; right: 2em; mix-blend-mode: difference;"
                        @click.prevent="switchCamera">
                        <span class="blend" style="font-size: 1.5em">
                            <i class="fa-solid fa-camera-rotate">
                                <span class="sr-only text-sm">
                                    Rotate Camera
                                </span>
                            </i>
                        </span>
                    </a>
                </div>
                <div class="alert alert-info m-0" role="alert">
                    <h5 class="alert-heading"><i class="fa-duotone fa-solid fa-circle-info me-1"></i>
                        Alternative</h5>
                    <p>Atau anda bisa menggunakan QR-Code</p>
                    <hr>
                    <div class="input-group" style="width: 100%;">
                        <div class="form-floating flex-grow-1" aria-describedby="basic-addon2">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Kode QR"
                                v-model="scannedqrcode" v-on:keyup.enter="onDecode(qrcode)">
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
        </div>
    </div>

    <!-- modal recieve batch -->
    <div class="modal fade" id="confirmationAddDocs" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="alert alert-warning fade show m-0" role="alert">
                    <div class=" d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 me-2">
                                <i class="fad fa-exclamation-circle"></i>
                            </div>
                            <h4 class="alert-heading m-0">Verifikasi Dokumen</h4>
                        </div>
                        <button type="button" class="btn-close btn-close-white m-0" @click="rescan()"
                            aria-label="Close"></button>
                    </div>
                    <h5 class="alert-heading mt-3"><strong>Pastikan</strong> berikut informasi mengenai document yang
                        <strong> akan diterima & dimasukkan ke list</strong> :
                    </h5>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Nomor Qrcode</dt>
                        <dd class="col-sm-9 mb-3">{{ model.document.number }}</dd>

                        <dt class="col-sm-3">Nomor Memo</dt>
                        <dd class="col-sm-9">{{ model.document.label }}</dd>

                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">
                            {{ model.document.description ? model.document.description : '-' }}
                        </dd>

                        <dt class="col-sm-3">Details</dt>
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
                                            placeholder="Nominal" v-model.lazy="det.nominal" v-money="money" disabled />
                                    </div>
                                </li>
                            </ol>
                        </dd>
                    </dl>
                    <div class="text-end m-0">
                        <a class="btn btn-primary m-0" @click="confirmAddDoc()">Confirm</a>
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
import { emitter } from '../../../../../../eventEmitter.js';
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
            currentStatus: '',
            modalScanner: '',
            modalConfirmationAddDoc: '',
            componentOpened: false,
            collections: {
                items: []
            },
            qrcode: '',
            scannedqrcode: '',
            model: {
                status_id: '',
                note: '',
                document: [],
            },
            addDoc: {},
            pauseScanner: false,
            facingMode: 'environment',
        }
    },

    mounted() {
        emitter.on('addByScan', (item) => {
            this.collections.items = item
            this.modalScanner = new bootstrap.Modal('#scanModalAdd', {
                backdrop: false,
                keyboard: false,
            })
            this.modalConfirmationAddDoc = new bootstrap.Modal('#confirmationAddDocs', {
                backdrop: false,
                keyboard: false,
            })
            this.openModal()
        });
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
            this.modalConfirmationAddDoc.hide()
            this.componentOpened = false
            this.pauseScanner = false
            this.qrcode = ''
            this.collections.statuses = []
            this.model.status_id = ''
            this.model.note = ''
            this.model.document = []
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
            this.pauseScanner = true
            this.qrcode = Array.isArray(scanned) ? scanned[0].rawValue : this.scannedqrcode
            let found = this.collections.items.find(item => item.number == this.qrcode)
            try {
                if (found) {
                    emitter.emit('foundScannedDoc', this.qrcode);
                    this.killCamera()
                } else {
                    let endpoint = `${BASEURL}/api/edoc/${this.qrcode}`
                    let response = await axios.get(endpoint, {
                        headers: {
                            Authorization: 'Bearer ' + this.$token(),
                        }
                    })
                    this.model.document = response.data.data
                    let currentStatus = this.model.document.statuses[0].status_id
                    if (currentStatus != 1 && currentStatus != 3) {
                        Swal.fire({
                            title: 'Dokumen telah diproses',
                            text: 'Progress saat ini: ' + this.model.document.statuses[0].dict_edoc_status.status_message,
                            icon: 'error',
                            showConfirmButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Oke, Scan lainnya !',
                            cancelButtonText: 'Close',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                this.rescan()
                            } else {
                                this.killCamera()
                            }
                        })
                    } else {
                        this.modalConfirmationAddDoc.show()
                    }
                }
            } catch (error) {
                this.killCamera()
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        async confirmAddDoc() {
            this.model.status_id = 2
            let endpoint = `${BASEURL}/api/edoc/status/${this.model.document.id}`
            try {
                let response = await axios.post(endpoint, this.model, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
                this.addDoc.category = { id: this.model.document.category }
                this.addDoc.description = this.model.document.description
                this.addDoc.id = this.model.document.id
                this.addDoc.label = this.model.document.label
                this.addDoc.number = this.model.document.number
                this.addDoc.unit_id = this.model.document.unit_id
                this.addDoc.unit = this.model.document.unit
                this.addDoc.user_id = this.model.document.user_id

                emitter.emit('addScannedDoc', this.addDoc);
                this.killCamera()
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
        rescan() {
            this.modalConfirmationAddDoc.hide()
            this.startCamera()
            this.qrcode = ''
            this.pauseScanner = false
        }
    },
    computed: {
    },
    watch: {
    },
}
</script>
<style scoped>
.blend {
    color: white;
    mix-blend-mode: difference;
}
</style>