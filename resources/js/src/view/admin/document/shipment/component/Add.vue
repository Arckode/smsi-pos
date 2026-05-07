<template>
    <!-- modal current qrcode -->
    <div class="modal fade" id="viewCurrentQrCode" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button @click="printCurrentQRCode" class="btn btn-primary m-0 font-weight-normal"><i
                            class="fa-solid fa-print"></i> Print</button> -->
                    <button class="btn btn-primary m-0 font-weight-normal" @click="generatePDFBatchAdd"> <i
                            class="fad fa-print"></i> Print QR Code</button>
                    <button type="button" class="btn-close btn-close-white m-0" @click="closeComponent"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5" id="printCurrentQrCode">
                    <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="currentQrSvg"></svg>
                    <h3 class="m-0 font-weight-normal">{{ currentQrcode }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Download QR PDF -->
    <div v-if="this.model.details != ''" style="display: none;">
        <div id="pdfContentBatchAdd" class="m-4">
            <div style="display: flex; flex-direction: row; width: 100%;">
                <div style="border: 1px solid black;">
                    <img :src="qrCodeImageBatchAdd" alt="QR Code" id="qrCodeImagePdfBatchAdd"
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
                        Dokumen terlampir sebanyak : {{ this.model.details.length }} Dokumen
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

    <!-- offcanvas Add New Document Shipping -->
    <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasAddShipmentRight"
        aria-labelledby="offcanvasAddShipmentRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddShipmentRightLabel">Add New Document Shipping</h5>
            <button type="button" class="btn-close btn-close-white" @click="closeComponent" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Nomor resi" id="floatingResi"
                        v-model="model.resi">
                    <label for="floatingResi">Nomor Resi</label>
                </div>
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
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-1">
                            <h6 class="m-0">Document Lists <span class="text-danger"> *</span></h6>
                            <p class="text-sm">Choose from the document list below or scan Qr-code</p>
                        </div>
                        <div class="me-3">
                            <a class="text-primary" type="button" @click.prevent="addByScan">
                                <i class="fal fa-barcode-read" style="font-size: 20px;"></i>
                            </a>
                        </div>
                    </div>
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
                            @click.prevent="confirmStore">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <addbyscanner-modal ref="addByScan"></addbyscanner-modal>
</template>

<script>
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../../../eventEmitter.js';
import addByScan from './Scanner.vue'
import html2pdf from 'html2pdf.js';
export default {
    name: 'AddDocumentOffcanvas',
    components: {
        'addbyscanner-modal': addByScan,
    },
    data() {
        return {
            modalAdd: '',
            modalPreview: '',
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
                resi: '',
                label: '',
                description: '',
                details: [],
                status_id: 1,
            },
            currentQrcode: '',
            selectedDetails: [],
            qrCodeImageBatchAdd: '',
            arraydet: [],
            toText: '',
        }
    },

    mounted() {
        emitter.on('AddShipment', async () => {

            this.modalAdd = new bootstrap.Offcanvas('#offcanvasAddShipmentRight', {
                backdrop: false,
                keyboard: false,
            })

            this.modalPreview = new bootstrap.Modal('#viewCurrentQrCode', {
                backdrop: false,
                keyboard: false,
            })

            await this.fetchCategory()
            await this.fetchAvailDocumentList()
            await this.openAddOffCanvas()
        });
        emitter.on('addScannedDoc', async (detail) => {
            await this.addScannedDoc(detail)
        });
        emitter.on('foundScannedDoc', async (qrcode) => {
            await this.foundScannedDoc(qrcode)
        });
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async openAddOffCanvas() {
            this.modalAdd.show()
        },
        async foundScannedDoc(qrcode) {
            let find = this.collections.items.find(item => item.number == qrcode)
            let found = this.model.details.find((item) => item == find.id)
            if (!found) {
                this.model.details.push(find.id)
            }
            Swal.fire({
                icon: "success",
                title: "Document berhasil ditambahkan",
                showConfirmButton: false,
                timer: 1500
            });
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
        async confirmStore() {
            if (this.model.label == '') {
                Swal.fire('Kesalahan', 'Label document harus diisi.', 'error')
                return false
            }

            if (this.model.details.length == 0) {
                Swal.fire('Kesalahan', 'List document harus ada yang dipilih', 'error')
                return false
            }

            if (this.model.resi != '') {
                this.model.status_id = 2
            }

            Swal.fire({
                title: 'Simpan?',
                text: "Pastikan data yang anda isi sudah benar",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Simpan'
            }).then((result) => {
                if (result.value) {
                    this.store()
                }
            })
        },
        async store() {
            let endpoint = `${BASEURL}/api/batches`
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
                            this.viewCurrentQRCode(response.data.batchNumber)
                        } else {
                            this.closeComponent()
                        }
                    })
                }
            } catch (error) {
                console.error("Error store batch: ", error);
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
        openPreviewModal() {
            this.modalPreview.show()
        },
        addByScan() {
            emitter.emit('addByScan', this.collections.items);
        },
        async addScannedDoc(detail) {
            this.collections.items.push(detail)
            this.model.details.push(detail.id)
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
                '3': 'Urgent'
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
                this.qrCodeImageBatchAdd = url;
                var svgimg = document.createElementNS("http://www.w3.org/2000/svg", "image");
                svgimg.setAttribute("width", "94");
                svgimg.setAttribute("height", "94");
                svgimg.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", url);
                document.getElementById("currentQrSvg").appendChild(svgimg);
                $("#qr-download").attr("href", url);
            });

            this.openPreviewModal()

        },
        generatePDFBatchAdd() {
            Swal.fire({
                timer: 2000,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })
            const element = document.getElementById('pdfContentBatchAdd');
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
            this.modalAdd.hide()
            this.resetForm()
            emitter.emit('fetchShipmentList');
        },
        resetForm() {
            this.model.resi = '';
            this.model.label = '';
            this.model.description = '';
            this.model.details = [];
            this.model.status_id = 1;

            this.meta.category = '';
            this.meta.search = '';
            this.meta.selected = false;

            this.collections.categories = [];
            this.collections.items = [];

            this.currentQrcode = '';
            this.selectedDetails = [];
        }
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
                    item.number.toLowerCase().includes(this.meta.search.toLowerCase()) ||
                    item.unit.name.toLowerCase().includes(this.meta.search.toLowerCase())
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