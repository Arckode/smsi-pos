<template>
    <!-- modal current qrcode -->
    <div class="modal fade" id="viewCurrentQrCode" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <!-- <div class="modal-content">
                <div class="modal-header">
                    <button @click="printCurrentQRCode" class="btn btn-primary m-0 font-weight-normal"><i
                            class="fa-solid fa-print"></i> Print</button>
                    <button type="button" class="btn-close btn-close-white m-0" @click="closeComponent"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5" id="printCurrentQrCode">
                    <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="currentQrSvg"></svg>
                    <h3 class="m-0 font-weight-normal">{{ currentQrcode }}</h3>
                </div>
            </div> -->
        </div>
    </div>
    <!-- offcanvas Add New Document Shipping -->
    <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasDetShipmentRight"
        aria-labelledby="offcanvasDetShipmentRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasDetShipmentRightLabel">Detail Document Shipping</h5>
            <button type="button" class="btn-close btn-close-white" @click="closeComponent" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="accordion" id="accordionBatchDetail">
                <div class="accordion-item mb-3">
                    <h5 class="accordion-header" id="headingOne1">
                        <button
                            class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="false"
                            aria-controls="collapseOne1">
                            <div class="m-0 flex-grow-1">
                                <h6 class="m-0">Batch Shipping Labels</h6>
                                <p class="m-0 text-sm">See batch shipping details</p>
                            </div>
                            <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                        </button>
                    </h5>
                    <div id="collapseOne1" class="accordion-collapse collapse" aria-labelledby="headingOne1"
                        data-bs-parent="#accordionBatchDetail">
                        <div class="accordion-body text-sm">
                            <form>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="Nomor resi" id="floatingNomor"
                                        v-model="model.number" disabled>
                                    <label for="floatingNomor">Nomor</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="Nomor resi" id="floatingResi"
                                        v-model="model.resi" disabled>
                                    <label for="floatingResi">Nomor Resi</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="label" id="floatingLabel"
                                        v-model="model.label" disabled>
                                    <label for="floatingLabel">Label</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Leave a comment here"
                                        id="floatingDescription" style="height: 100px" v-model="model.description"
                                        disabled></textarea>
                                    <label for="floatingDescription">Description</label>
                                </div>
                                <hr>
                                <div class="mb-3 d-flex flex-column">
                                    <label class="form-label">Document Lists <span class="text-danger"> *</span></label>
                                    <div class="table-responsive p-0 mb-2">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-sm font-weight-semibold">Nomor Memo</th>
                                                    <th class="text-center text-sm font-weight-semibold">Judul</th>
                                                    <th class="text-center text-sm font-weight-semibold">Unit</th>
                                                    <th class="text-center text-sm font-weight-semibold">category</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in model.details" :key="item.id">
                                                    <td class="text-sm font-weight-semibold">
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-start ms-1">
                                                                <h6 class="mb-0 text-sm font-weight-semibold">{{
                                                                    item.edoc.label }}</h6>
                                                                <p class="text-sm text-secondary mb-0">{{
                                                                    item.edoc.number
                                                                }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-sm font-weight-semibold"
                                                        style="vertical-align: middle; word-wrap: break-word; min-width: 160px; max-width: 160px; white-space:normal;">
                                                        {{ item.edoc.description }}
                                                    </td>
                                                    <td class="text-center text-sm font-weight-semibold"
                                                        style="vertical-align: middle;">
                                                        {{ item.edoc.unit.name }}
                                                    </td>
                                                    <td class="text-center text-lg font-weight-semibold m-0"
                                                        style="vertical-align: middle;">
                                                        <span v-if="item.edoc.category == 1"
                                                            class="badge badge-sm border border-warning text-warning bg-warning">
                                                            Reguler
                                                        </span>
                                                        <span v-if="item.edoc.category == 2"
                                                            class="badge badge-sm border border-danger text-danger bg-danger">
                                                            Semi-Urgent
                                                        </span>
                                                        <span v-if="item.edoc.category == 3"
                                                            class="badge badge-sm border border-info text-info bg-info">
                                                            Urgent
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion" id="accordionBatchHistory">
                <div class="accordion-item mb-3">
                    <h5 class="accordion-header" id="headingOne2">
                        <button
                            class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne2" aria-expanded="false"
                            aria-controls="collapseOne2">
                            <div class="m-0 flex-grow-1">
                                <h6 class="m-0">History</h6>
                                <p class="m-0 text-sm">See batch shipping history timelines</p>
                            </div>
                            <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                        </button>
                    </h5>
                    <div id="collapseOne2" class="accordion-collapse collapse" aria-labelledby="headingOne2"
                        data-bs-parent="#accordionBatchHistory">
                        <div class="accordion-body text-sm">
                            <div class="row">
                                <div class="m-0">
                                    <ul class="timeline mb-0">
                                        <li class="d-flex flex-column" v-for="(det, index) in model.statuses"
                                            :key="index">
                                            <p class="text-primary mb-0">{{ formatDate(det.created_at) }}</p>
                                            <h6 class="text-dark mb-3">{{ det.dict_batch_status.status_message }}</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-absolute end-0 bottom-0 me-3">
            <button type="button" class="btn btn-secondary rounded-1" @click.prevent="closeComponent">Close</button>
        </div>
    </div>
</template>

<script>
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../../../eventEmitter.js';
export default {
    name: 'AddDocumentOffcanvas',
    data() {
        return {
            modalDetail: '',
            modalPreview: '',
            model: {
                resi: '',
                label: '',
                description: '',
                details: []
            },
        }
    },

    mounted() {
        emitter.on('detailShipment', async (id) => {

            this.modalDetail = new bootstrap.Offcanvas('#offcanvasDetShipmentRight', {
                backdrop: false,
                keyboard: false,
            })

            this.modalPreview = new bootstrap.Modal('#viewCurrentQrCode', {
                backdrop: false,
                keyboard: false,
            })

            await this.fetchShipment(id)
            await this.openDetOffCanvas()
        });
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async openDetOffCanvas() {
            this.modalDetail.show()
        },
        openPreviewModal() {
            this.modalPreview.show()
        },
        closeComponent() {
            this.modalPreview.hide()
            this.modalDetail.hide()
            this.resetForm()
        },
        async fetchShipment(id) {
            let endpoint = `${BASEURL}/api/batches/${id}`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.model = response.data.data
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },

        viewCurrentQRCode(qrcode) {
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
            QRCode.toDataURL(qrcode, opts, function (err, url) {
                if (err) throw err;
                var svgimg = document.createElementNS("http://www.w3.org/2000/svg", "image");
                svgimg.setAttribute("width", "94");
                svgimg.setAttribute("height", "94");
                svgimg.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", url);
                document.getElementById("currentQrSvg").appendChild(svgimg);
                $("#qr-download").attr("href", url);
            });

            this.openPreviewModal()

        },
        printCurrentQRCode() {
            let currentPrintContents = document.getElementById("printCurrentQrCode").innerHTML;
            let currentPrintWindow = window.open("", "_blank");
            currentPrintWindow.document.open();
            currentPrintWindow.document.write('<html><head><title>Print</title></head><body>' + currentPrintContents + '</body></html>');
            currentPrintWindow.document.close();
            currentPrintWindow.print();
            this.closeComponent()
        },
        resetForm() {
            this.model.resi = '';
            this.model.label = '';
            this.model.description = '';
            this.model.details = [];
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
    },
    computed: {
    },
    watch: {
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
    left: 1rem !important;
    width: 2px;
    height: 100%;
    z-index: 400;
}

ul.timeline>li {
    margin: 20px 0;
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
</style>