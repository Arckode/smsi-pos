<template>
    <!-- modal qrcode -->
    <div class="modal fade" id="viewQrCode" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button @click.prevent="printQRCode" class="btn btn-primary m-0 font-weight-normal"><i
                            class="fa-solid fa-print"></i> Print</button> -->
                    <button class="btn btn-primary m-0 font-weight-normal" @click.prevent="generatePDFBatchList"> <i
                            class="fas fa-print"></i> Print QR Code</button>
                    <button type="button" class="btn-close btn-close-white m-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5" id="printContent">
                    <h5 class="m-0 font-weight-normal">{{ qrcode }}</h5>
                    <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="mySvg"></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Download QR PDF -->
    <div v-if="currentSelectedBatchQr != ''" style="display: none;">
        <div id="pdfContentBatchList" class="m-4">
            <div style="display: flex; flex-direction: row; width: 100%;">
                <div style="border: 1px solid black;">
                    <img :src="qrCodeImageBatchList" alt="QR Code" id="qrCodeImagePdfBatchList"
                        style="width: 250px; height: 250px;" />
                </div>
                <div class="p-4" style="border: 1px solid black; width: 100%;">
                    <p style="font-size: 20px; font-weight: 600; margin-bottom: 0; color: black;">EDOC-TRACKING</p>
                    <table style="width:100%;">
                        <tr>
                            <td style="width: 100px;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">QR Code
                                </p>
                            </td>
                            <td>
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">: {{
                                    qrcode }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">Label</p>
                            </td>
                            <td>
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">
                                    : {{ currentSelectedBatchQr.label }}
                                </p>
                            </td>
                        </tr>
                    </table>
                    <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black; margin-top: 12px;">
                        Dokumen terlampir sebanyak : {{ currentSelectedBatchQr.details.length }} Dokumen
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
                <li v-for="bdet in currentSelectedBatchQr.details" :key="bdet.id">
                    <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">{{ bdet.edoc.label }}
                        (<strong>{{ bdet.edoc.unit.name }}</strong>)</p>
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

    <!-- modal resi -->
    <div class="modal fade" id="showResi" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="alert alert-light m-0" role="alert">
                    <h4 class="alert-heading">Nomor Resi Pengiriman</h4>
                    <p>Simpan nomor resi pengiriman dokumen</p>
                    <hr>
                    <div class="input-group" style="width: 100%;">
                        <div class="form-floating flex-grow-1" aria-describedby="basic-addon2">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Resi"
                                v-model="model.resi.number">
                            <label for="floatingInput" class="text-secondary">Input Nomor Resi</label>
                        </div>
                        <button @click.prevent="confirmStoreResi()" class="input-group-text btn btn-primary m-0"
                            id="basic-addon2">
                            <i class="fas fa-sign-in-alt">
                                <span class="sr-only text-sm">
                                    Save
                                </span>
                            </i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- offcanvas Add New Document Shipping -->
    <add-shipment-offcanvas ref="addShipment"></add-shipment-offcanvas>

    <!-- offcanvas Edit Document Shipping -->
    <edit-shipment-offcanvas ref="editShipment"></edit-shipment-offcanvas>

    <!-- offcanvas detail Document -->
    <detail-shipment-offcanvas ref="detailShipment"></detail-shipment-offcanvas>

    <!-- Shipment Table List -->
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Document Shipment list</h6>
                                <p class="text-sm">See information about all shipment status</p>
                            </div>
                            <div class="ms-auto d-flex">
                                <button @click.prevent="addShipment"
                                    class="btn btn-sm btn-white d-flex align-items-center me-2" type="button"
                                    :disabled="loadContent">
                                    <span class="btn-inner--icon">
                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" fill="currentColor" class="d-block me-2">
                                            <path
                                                d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                                        </svg>
                                    </span>
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable1"
                                    autocomplete="off" checked v-model="meta.requestStatus" value="">
                                <label class="btn btn-white px-3 mb-0" for="btnradiotable1">All</label>
                                <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable2"
                                    autocomplete="off" v-model="meta.requestStatus" value="pending">
                                <label class="btn btn-white px-3 mb-0" for="btnradiotable2">On Progress</label>
                                <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable3"
                                    autocomplete="off" v-model="meta.requestStatus" value="completed">
                                <label class="btn btn-white px-3 mb-0" for="btnradiotable3">Selesai</label>
                            </div>
                            <div class="input-group w-sm-25 ms-auto">
                                <span class="input-group-text text-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                        </path>
                                    </svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Search" v-model="meta.search">
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <div v-if="loadContent" class="d-flex justify-content-center p-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <h6 class="align-middle text-center text-lg pt-3 text-muted"
                                v-else-if="collection.shipments && collection.shipments.data.length == 0">Tidak ada data
                            </h6>
                            <table v-else class="table align-items-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-xs font-weight-semibold opacity-7">Document</th>
                                        <th class="text-xs font-weight-semibold opacity-7">Resi</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Progress</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Tanggal</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in collection.shipments.data" :key="item.id"
                                        @click.prevent="detailShipment(item.id)">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">{{ item.label }}</h6>
                                                    <p class="text-sm text-secondary mb-0">{{ item.description }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">{{ item.resi ?
                                                        item.resi : '-' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-lg">
                                            <span v-if="item.status.status_id == 1"
                                                class="badge badge-sm border border-warning text-warning bg-warning">
                                                {{ item.status.dict_batch_status.status_message }}
                                            </span>
                                            <span v-if="item.status.status_id == 2"
                                                class="badge badge-sm border border-primary text-primary bg-primary">
                                                {{ item.status.dict_batch_status.status_message }}
                                            </span>
                                            <span v-if="item.status.status_id == 3"
                                                class="badge badge-sm border border-success text-success bg-success">
                                                {{ item.status.dict_batch_status.status_message }}
                                            </span>
                                            <span v-if="item.status.status_id == 5"
                                                class="badge badge-sm border border-info text-info bg-info">
                                                {{ item.status.dict_batch_status.status_message }}
                                            </span>
                                            <span v-if="item.status.status_id == 6"
                                                class="badge badge-sm border border-success text-success bg-success">
                                                {{ item.status.dict_batch_status.status_message }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">{{
                                                        formatCreatedAt(item.status.status_date) }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a v-if="item.status.status_id == 1"
                                                @click.prevent="editShipment(item.id, item.status.status_id); $event.stopPropagation()"
                                                class="text-info fs-5 m-2" type="button" title="Edit Batch">
                                                <i class="fas fa-pencil-alt">
                                                    <span class="sr-only text-sm">
                                                        Edit
                                                    </span>
                                                </i>
                                            </a>
                                            <a v-if="item.status.status_id == 1"
                                                @click.prevent="deleteShipment(item.id, item.status.status_id); $event.stopPropagation()"
                                                class="text-danger fs-5 m-2" title="Delete Batch">
                                                <i class="fas fa-trash">
                                                    <span class="sr-only text-sm">
                                                        Delete
                                                    </span>
                                                </i>
                                            </a>
                                            <a @click.prevent="getQRCode(item); $event.stopPropagation()"
                                                data-bs-toggle="modal" data-bs-target="#viewQrCode" title="View QrCode"
                                                class="text-primary fs-5 m-2">
                                                <i class="fas fa-qrcode">
                                                    <span class="sr-only text-sm">
                                                        QR Code
                                                    </span>
                                                </i>
                                            </a>
                                            <a v-if="!item.resi && item.status.status_id > 1"
                                                @click.prevent="showResi(item.id, item.resi); $event.stopPropagation()"
                                                title="Input Resi" class="text-dark fs-5 m-2">
                                                <i class="fas fa-receipt">
                                                    <span class="sr-only text-sm">
                                                        Input Resi
                                                    </span>
                                                </i>
                                            </a>
                                            <a v-if="item.status.status_id == 1"
                                                @click.prevent="sendBatch(item.id); $event.stopPropagation()"
                                                title="Kirim Batch" class="text-primary fs-5 m-2">
                                                <i class="fas fa-shipping-fast">
                                                    <span class="sr-only text-sm">
                                                        Confirm Pengiriman
                                                    </span>
                                                </i>
                                            </a>
                                            <a v-if="item.status.status_id == 2"
                                                @click.prevent="receiveBatch(item.id); $event.stopPropagation()"
                                                title="Batch Diterima BOD" class="text-info fs-5 m-2">
                                                <i class="fas fa-people-carry">
                                                    <span class="sr-only text-sm">
                                                        Confirm Penerimaan
                                                    </span>
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top py-3 px-3 d-flex align-items-center">
                            <p class="font-weight-semibold mb-0 text-dark text-sm">Page {{
                                meta.page.shipmentList.current_page }} of {{ meta.page.shipmentList.last_page
                                }}
                            </p>
                            <div class="ms-auto">
                                <button v-for="(link, index) in collection.shipments.links"
                                    v-on:click="changePageShipmentList(link.url)" class="btn btn-sm btn-white mb-0"
                                    :disabled="link.active">
                                    <span v-if="index === 0"><i class="fas fa-chevron-left"></i></span>
                                    <span v-else-if="index === collection.shipments.links.length - 1"><i
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
</template>

<script>
import AddShipmentOffcanvas from './component/Add.vue';
import EditShipmentOffcanvas from './component/Edit.vue';
import DetShipmentOffcanvas from './component/Detail.vue';
import { emitter } from '../../../../../eventEmitter.js';
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
window.BASEURL = ''

export default {
    created() {
        emitter.on('fetchShipmentList', this.fetchShipmentList);
    },
    name: "Admin.Index",
    components: {
        'add-shipment-offcanvas': AddShipmentOffcanvas,
        'edit-shipment-offcanvas': EditShipmentOffcanvas,
        'detail-shipment-offcanvas': DetShipmentOffcanvas
    },
    data() {
        return {
            loadContent: true,
            meta: {
                page: {
                    shipmentList: {
                        current_page: '',
                        last_page: '',
                    },
                },
                search: '',
                requestStatus: '',
            },
            model: {
                resi: {
                    docid: '',
                    number: ''
                }
            },
            collection: {
                shipments: '',
            },
            qrcode: '',
            modalResi: '',
            qrCodeImageBatchList: '',
            currentSelectedBatchQr: '',
            toText: '',
        }
    },

    mounted() {
        this.modalResi = new bootstrap.Modal('#showResi')
        this.fetchShipmentList()
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },

        async fetchShipmentList() {
            let endpoint = `${BASEURL}/api/batches`;
            try {
                this.loadContent = true
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search,
                        'status': this.meta.requestStatus
                    }
                });
                this.collection.shipments = response.data.data
                this.meta.page.shipmentList.current_page = this.collection.shipments.current_page
                this.meta.page.shipmentList.last_page = this.collection.shipments.last_page
                this.loadContent = false
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },

        getQRCode(item) {
            this.currentSelectedBatchQr = ''
            this.toText = ''
            this.currentSelectedBatchQr = item

            const categoryCounts = {};
            this.currentSelectedBatchQr.details.forEach(item => {
                const category = item.edoc.category;
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
                '2': 'Urgent',
                '3': 'Reguler',
                '1': 'Semi-urgent'
            };
            this.toText = groupedCounts.map(item => {
                const displayName = categoryMapping[item.category];
                return `${displayName} (${item.count} Dokumen)`;
            }).join(', ');

            var opts = {
                errorCorrectionLevel: "H",
                type: "image/jpeg",
                width: 500,
                rendererOpts: {
                    quality: 0.5,
                },
            };

            this.qrcode = this.currentSelectedBatchQr.number;

            // generate qrcode
            QRCode.toDataURL(this.qrcode, opts, (err, url) => {
                if (err) throw err;
                this.qrCodeImageBatchList = url;
                var svgimg = document.createElementNS("http://www.w3.org/2000/svg", "image");
                svgimg.setAttribute("width", "94");
                svgimg.setAttribute("height", "94");
                svgimg.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", url);
                document.getElementById("mySvg").appendChild(svgimg);
                $("#qr-download").attr("href", url);
            });
        },

        generatePDFBatchList() {
            Swal.fire({
                timer: 2000,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })
            const element = document.getElementById('pdfContentBatchList');
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

        showResi(id, number) {
            this.model.resi.docid = id
            console.log(id)
            this.model.resi.number = number
            this.modalResi.show()
        },
        confirmStoreResi() {
            if (this.model.resi.number == null || this.model.resi.number == '') {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Nomor resi harus diisi",
                    showConfirmButton: false,
                    timer: 2000
                });
                return false
            }

            Swal.fire({
                title: 'Simpan?',
                text: "Pastikan data yang anda isi sudah benar. karena data ini tidak dapat diedit lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Simpan'
            }).then((result) => {
                if (result.value) {
                    this.storeResi()
                }
            })
        },
        async storeResi() {
            let endpoint = `${BASEURL}/api/batch/shipment-number/${this.model.resi.docid}`

            try {
                let response = await axios.post(endpoint,
                    {
                        'resi': this.model.resi.number
                    }, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token()
                    }
                })
                if (response) {
                    Swal.fire({
                        title: 'Penyimpanan Berhasil.',
                        icon: 'success',
                        confirmButtonText: 'Ok!'
                    })
                }
                this.modalResi.hide()
                emitter.emit('fetchShipmentList');
            } catch (error) {
                console.log(error)
                let errorMessage = 'Something went wrong';

                if (error.response && error.response.data && error.response.data.message) {
                    if (typeof error.response.data.message === 'object') {
                        const resiErrors = error.response.data.message.resi;
                        if (resiErrors && resiErrors.length > 0) {
                            errorMessage = resiErrors.join(', ');
                        }
                    } else {
                        errorMessage = error.response.data.message;
                    }
                } else if (error.response) {
                    errorMessage = error.response.statusText;
                }

                Swal.fire({
                    title: 'Error',
                    text: errorMessage,
                    icon: 'error'
                });
            }
        },

        editShipment(id, status_id) {
            if (status_id != 1) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Document sudah diproses",
                    showConfirmButton: false,
                    timer: 1500
                });
                return false
            }

            emitter.emit('editShipment', id);
        },

        sendBatch(id) {
            emitter.emit('sendBatch', id);
        },

        receiveBatch(id) {
            emitter.emit('receiveBatch', id);
        },

        detailShipment(id) {
            emitter.emit('detailShipment', id);
        },

        addShipment() {
            emitter.emit('AddShipment');
        },

        async deleteShipment(id, status_id) {
            if (status_id != 1) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Document sudah diproses",
                    showConfirmButton: false,
                    timer: 1500
                });
                return false
            }

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let endpoint = `${BASEURL}/api/batches/${id}`;

                    try {
                        let response = await axios.delete(endpoint, {
                            headers: {
                                Authorization: 'Bearer ' + this.$token()
                            }
                        });
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                        this.fetchShipmentList();
                    } catch (error) {
                        console.log(error.response.data.message);
                        this.$swal.fire('Failed!', error.response.data.message, 'error');
                    }

                }
            });
        },
        async changePageShipmentList (url) {
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
                this.collection.shipments = response.data.data
                this.meta.page.shipmentList.current_page = this.collection.shipments.current_page
                this.meta.page.shipmentList.last_page = this.collection.shipments.last_page
                Swal.close()
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },
        formatCreatedAt(dateString) {
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
    watch: {
        'meta.search': 'fetchShipmentList',
        'meta.requestStatus': function (newVal, oldVal) {
            this.fetchShipmentList();
        }
    }
}
</script>
<style scoped>
.list-doc li,
.list-doc li p {
    white-space: normal;
    float: left;
    width: 100%;
    height: auto;
    word-wrap: break-word;
}
</style>