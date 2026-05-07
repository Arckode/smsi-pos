<!-- <template>
    <qrcode-stream :paused="pauseScanner" @error="onInit" @detect="onDecode" :constraints="{ facingMode }"
        style="position: absolute; margin: 0; padding: 0; z-index: -1; height: 100vh;" />

    <div v-if="scannerOpened" class="container-fluid py-4 px-5 w-100 h-100">
        <div>
            <a style="mix-blend-mode: difference;" @click="login">
                <span class="blend">
                    <i class="fas fa-user blend" style="font-size: 20px;">
                        <span class="sr-only text-sm">
                            Login
                        </span>
                    </i>
                </span>
            </a>
        </div>

        <div>
            <h3 class="text-center m-0 p-0 blend">EDOC TRACKING</h3>
            <hr>
            <h5 class="text-center pb-4 blend">Scan QR-Code <i class="fas fa-qrcode"></i></h5>
        </div>


        <div class="alert alert-info m-4 mb-6 fixed-bottom" role="alert" style="z-index: 0 !important;">
            <a class="blend" style="position: absolute; z-index: 1; top:-3em; right: 1em; mix-blend-mode: difference;"
                @click="switchCamera" id="btnGroupAddon">
                <span class="blend" style="font-size: 1.5em">
                    <i class="fas fa-sync-alt blend">
                        <span class="sr-only text-sm">
                            Camera Rotate
                        </span>
                    </i>
                </span>
            </a>
            <h4 class="alert-heading"><i class="fa-duotone fa-solid fa-circle-info me-3"></i> Alternative</h4>
            <p class="text-xs">Atau anda bisa menggunakan QR-Code batch document</p>
            <hr>
            <div class="input-group" style="width: 100%;">
                <div class="form-floating flex-grow-1" aria-describedby="basic-addon2">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Kode QR" v-model="qrcode"
                        v-on:keyup.enter="onDecode(qrcode)">
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
        <a class="card fixed-bottom" type="button" @click.prevent="documentShipment">
            <div class="card-body d-flex justify-content-between m-0" style="align-items: center;">
                <p class="text-black m-0 ms-3">Pengiriman Document</p>
                <i class="fas fa-chevron-up me-3"></i>
            </div>
        </a>
    </div>
    <confirmation-modal ref="confirmationModal"></confirmation-modal>
    <shipment-modal ref="shipmentModal"></shipment-modal>

    <div v-if="items.length > 0" class="btn-group dropstart" style="position: fixed; top: 30px; right: -10px;">
        <a type="button" class="rounded-circle bg-white d-flex align-items-center justify-content-center"
            :class="{ shake: shakeAnimation }" data-bs-toggle="dropdown" aria-expanded="false"
            style="width: 50px; height: 50px;">
            <span class="position-absolute top-10 start-0 translate-middle badge rounded-pill"
                style="background: rgba(234, 78, 61, 1) !important;">
                {{ items.length }}
            </span>
            <i class="far fa-paper-plane" style="font-size: 20px; margin-left: -8px;"></i>
        </a>
        <div class="dropdown-menu p-4 mt-4" style="width: 80vw; max-height: 80vh; overflow-y: auto;">
            <h5 class="mb-0 pb-0">Pengiriman Document</h5>
            <p class="pt-0 text-sm">List document yang akan dikirim kembali ke PT.MMS</p>
            <hr>
            <div class="card-body p-0 mt-2">
                <div class="table-responsive p-0 mb-6">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-xs font-weight-semibold">Nomor Memo & QR-Code</th>
                                <th class="text-xs font-weight-semibold">Judul</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in items" :key="item.id">
                                <td class="text-sm font-weight-semibold">
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-start ms-1">
                                            <h6 class="mb-0 text-xs font-weight-semibold">{{ item.label }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ item.number }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-xs font-weight-semibold"
                                    style="vertical-align: middle; word-wrap: break-word; min-width: 160px; max-width: 160px; white-space:normal;">
                                    {{ item.description }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="position-absolute end-0 bottom-0 me-3">
                <button type="button" class="btn btn-primary rounded-1"
                    @click.prevent="sendSelectedDocs">Lanjutkan</button>
            </div>
        </div>
    </div>

</template>

<script>
import { QrcodeStream, QrcodeCapture } from 'vue-qrcode-reader'
import { emitter } from '../eventEmitter.js';
import ConfirmationModal from './view/bod/component/Confirmation.vue'
import ShipmentModal from './view/bod/component/Shipment.vue'
export default {
    name: "App",
    components: {
        QrcodeStream,
        'confirmation-modal': ConfirmationModal,
        'shipment-modal': ShipmentModal,
    },
    data() {
        return {
            scannerOpened: true,
            pauseScanner: false,
            meta: {
            },
            items: [],
            facingMode: 'environment',
            shakeAnimation: false,
            qrcode: '',
        }
    },
    mounted() {
        emitter.on('Rescan', () => {
            this.scannerOpened = true
            this.pauseScanner = false
        })
        emitter.on('ResetList', () => {
            this.items = []
        })
        emitter.on('sendDocument', async (detail) => {
            await this.addShipmentDetails(detail)
        })
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        active(routePrefix) {
            return this.$route.name && this.$route.name.startsWith(routePrefix);
        },

        async addShipmentDetails(detail) {
            this.qrcode = ''
            let find = this.items.find(item => item.id == detail.id)

            if (!find) {
                this.items.push({
                    id: detail.id,
                    number: detail.number,
                    label: detail.label,
                    description: detail.description
                })
            }
        },

        sendSelectedDocs() {
            let ids = this.items.map(item => item.id)
            emitter.emit('sendSelectedDocs', ids)
        },

        switchCamerax() {
            switch (this.camera) {
                case 'front':
                    this.camera = 'rear'
                    break
                case 'rear':
                    this.camera = 'front'
                    break
            }
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

        documentShipment() {
            emitter.emit('DocumentShipment');
        },

        async onDecode(result) {
            let qrcode = Array.isArray(result) ? result[0].rawValue : this.qrcode
            this.scannerOpened = false
            this.pauseScanner = true
            this.confirmation(qrcode)
        },
        confirmation(qrcode) {
            emitter.emit('ConfirmationModal', qrcode);
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
        async login() {
            this.$router.push({ name: 'login' }).then(() => { this.$router.go(0) })
        }
    },
    watch: {
        'items.length': function (newLength, oldLength) {
            if (newLength !== oldLength) {
                this.shakeAnimation = true

                setTimeout(() => {
                    this.shakeAnimation = false
                }, 1500)
            }
        }
    },
}
</script>

<style scoped>
.blend {
    color: white;
    mix-blend-mode: difference;
}

@keyframes shake {
    0% {
        transform: translateX(0);
    }

    25% {
        transform: translateX(-5px);
    }

    50% {
        transform: translateX(5px);
    }

    75% {
        transform: translateX(-5px);
    }

    100% {
        transform: translateX(0);
    }
}

.shake {
    animation: shake 1s ease-in-out 1;
}
</style> -->
<template>
    <router-view></router-view>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            meta: {

            },
        }
    },
    mounted() {

    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        active(routePrefix) {
            return this.$route.name && this.$route.name.startsWith(routePrefix);
        }
    }
}
</script>