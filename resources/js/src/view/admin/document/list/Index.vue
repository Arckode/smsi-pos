<template>
    <!-- modal qrcode -->
    <div class="modal fade" id="viewQrCode" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="btn btn-primary m-0 font-weight-normal" @click.prevent="generatePDF"> <i
                            class="fas fa-print"></i> Print QR Code</button>
                    <button type="button" class="btn-close btn-close-white m-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5" id="printContentIndexQr">
                    <h5 class="m-0 font-weight-normal">{{ qrcode }}</h5>
                    <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="myIndexSvg"></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Download QR PDF -->
    <div v-if="currentPrintDet != ''" style="display: none;">
        <div id="pdfContent" class="m-4">
            <div style="display: flex; flex-direction: row; width: 100%;">
                <div class="p-4"
                    style="border-top: 1px solid black; border-left: 1px solid black; border-bottom: 1px solid black; border-right: none; width: 100%;">
                    <p style="font-size: 20px; font-weight: 600; margin-bottom: 0; color: black;">EDOC-TRACKING</p>
                    <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">{{
                        currentPrintDet.unit.name }}
                    </p>
                    <table style="width:100%;">
                        <tr>
                            <td style="width: 100px;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">QR Code
                                </p>
                            </td>
                            <td>
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">: {{
                                    qrcode }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">No Memo
                                </p>
                            </td>
                            <td>
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">: {{
                                    currentPrintDet.label }}
                                </p>
                            </td>
                        </tr>
                    </table>
                    <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black; margin-top: 12px;">
                        Dokumen terlampir sebanyak : {{ currentPrintDet.details.length }} Dokumen
                    </p>
                    <ul class="list-doc" style="columns: 2;">
                        <li v-for="idet in currentPrintDet.details" :key="idet.id">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">{{ idet.label
                                }}</p>
                        </li>
                    </ul>
                </div>
                <div style="border: 1px solid black;">
                    <img :src="qrCodeImage" alt="QR Code" id="qrCodeImagePdf" style="width: 250px; height: 250px;" />
                </div>
            </div>
        </div>
    </div>

    <!-- offcanvas Add New Document -->
    <add-document-offcanvas ref="addDocument"></add-document-offcanvas>

    <!-- offcanvas Edit New Document -->
    <edit-document-offcanvas ref="editDocument"></edit-document-offcanvas>

    <!-- offcanvas detail Document -->
    <detail-document-offcanvas ref="detailDocument"></detail-document-offcanvas>

    <!-- Document Table List -->
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Dokumen list</h6>
                                <p class="text-sm">Informasi tentang semua list dokumen</p>
                            </div>
                            <div class="ms-auto d-flex">
                                <button v-if="meta.user.role != 1" @click.prevent="addDocument"
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
                                v-else-if="collection.documents && collection.documents.data.length == 0">Tidak ada data
                            </h6>
                            <table v-else class="table align-items-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-xs font-weight-semibold opacity-7">Dokumen</th>
                                        <th v-if="meta.user.role == 1" class="text-xs font-weight-semibold opacity-7">
                                            User</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Kategori</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Progress</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Tanggal</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in collection.documents.data" :key="item.id"
                                        @click.prevent="detailDocument(item.id)">
                                        <td class="responsive-description">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <h6
                                                        class="mb-0 text-sm font-weight-semibold responsive-description">
                                                        {{ item.label }}</h6>
                                                    <p class="text-sm text-secondary mb-0 responsive-description">{{
                                                        item.description }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td v-if="meta.user.role == 1">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">{{ item.unit.name }}
                                                    </h6>
                                                    <p class="text-sm text-secondary mb-0">{{ item.user.name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-lg">
                                            <span v-if="item.category == 1"
                                                class="badge badge-sm border border-info text-info bg-info">
                                                Reguler
                                            </span>

                                            <span v-if="item.category == 2"
                                                class="badge badge-sm border border-warning text-warning bg-warning">
                                                Semi-Urgent
                                            </span>

                                            <span v-if="item.category == 3"
                                                class="badge badge-sm border border-danger text-danger bg-danger">
                                                Urgent
                                            </span>
                                        </td>
                                        <td class="align-middle text-center text-lg">
                                            <span v-if="item.status.status_id == 3"
                                                class="badge badge-sm border border-danger text-danger bg-danger">
                                                {{ item.status.dict_edoc_status.status_message }}
                                            </span>
                                            <span
                                                v-else-if="item.status.status_id == 1 || item.status.status_id == 2 || item.status.status_id == 6"
                                                class="badge badge-sm border border-info text-info bg-info">
                                                {{ item.status.dict_edoc_status.status_message }}
                                            </span>
                                            <span v-else
                                                class="badge badge-sm border border-success text-success bg-success">
                                                {{ item.status.dict_edoc_status.status_message }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center text-lg">
                                            <h6 class="mb-0 text-sm font-weight-semibold">{{
                                                formatCreatedAt(item.status.status_date) }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a v-if="item.status.status_id == 1 || item.status.status_id == 3"
                                                @click.prevent="editDocument(item.id, item.status.status_id); $event.stopPropagation()"
                                                class="text-info fs-5 m-2" type="button" title="Edit Document">
                                                <i class="fas fa-pencil-alt" alt="Edit" aria-hidden="true">
                                                    <span class="sr-only text-sm">
                                                        Edit
                                                    </span>
                                                </i>
                                            </a>
                                            <a v-if="meta.user.role != 1 && (item.status.status_id == 1 || item.status.status_id == 3)"
                                                @click.prevent="deleteDocument(item.id, item.status.status_id); $event.stopPropagation()"
                                                class="text-danger fs-5 m-2" type="button" title="Delete Document">
                                                <i class="fas fa-trash" alt="Delete">
                                                    <span class="sr-only text-sm">
                                                        Delete
                                                    </span>
                                                </i>
                                            </a>
                                            <a @click.prevent="getQRCode(item); $event.stopPropagation()"
                                                data-bs-toggle="modal" data-bs-target="#viewQrCode" title="View QrCode"
                                                type="button" class="text-primary fs-5 m-2">
                                                <i class="fas fa-qrcode" alt="QR Code">
                                                    <span class="sr-only text-sm">
                                                        QR Code
                                                    </span>
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top py-3 px-3 d-flex align-items-center flex-wrap">
                            <div class="d-flex flex-column">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">Halaman {{
                                    meta.page.documentList.current_page }} dari {{ meta.page.documentList.last_page
                                    }}
                                </p>
                                <p class="font-weight-semibold mb-0 text-secondary text-sm">Total: {{ total }} Dokumen
                                </p>
                            </div>
                            <div class="ms-auto">
                                <button v-for="(link, index) in collection.documents.links"
                                    v-on:click="changePageDocumentList(link.url)" class="btn btn-sm btn-white mb-0"
                                    :disabled="link.active">
                                    <span v-if="index === 0">
                                        <i class="fas fa-chevron-left">
                                            <span class="sr-only text-xs m-0">
                                                Previous
                                            </span>
                                        </i>
                                    </span>
                                    <span v-else-if="index === collection.documents.links.length - 1">
                                        <i class="fas fa-chevron-right">
                                            <span class="sr-only text-xs m-0">
                                                Next
                                            </span>
                                        </i>
                                    </span>
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
import AddDocumentOffcanvas from './component/Add.vue';
import EditDocumentOffcanvas from './component/Edit.vue';
import DetailDocumentOffcanvas from './component/Detail.vue';
import { emitter } from '../../../../../eventEmitter.js';
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
window.BASEURL = ''

export default {
    created() {
        emitter.on('fetchDocumentList', this.fetchDocumentList);
    },
    name: "Admin.Index",
    components: {
        'add-document-offcanvas': AddDocumentOffcanvas,
        'edit-document-offcanvas': EditDocumentOffcanvas,
        'detail-document-offcanvas': DetailDocumentOffcanvas
    },
    data() {
        return {
            loadContent: true,
            meta: {
                user: '',
                page: {
                    documentList: {
                        current_page: '',
                        last_page: '',
                    }
                },
                search: '',
                requestStatus: '',
                total: 0
            },
            collection: {
                documents: '',
            },
            qrcode: '',
            qrCodeImage: '',
            currentPrintDet: '',
        }
    },

    async mounted() {
        await this.fetchCurrentUser();
        await this.fetchDocumentList();
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async fetchCurrentUser() {

            let endpoint = `${BASEURL}/api/user`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                if (response.data) {
                    this.meta.user = response.data
                }
            } catch (error) {
                console.log('User error: ', error)
            }
        },
        async fetchDocumentList() {
            let endpoint = `${BASEURL}/api/edocs`;
            if (this.meta.user.role === 1) {
                endpoint = `${BASEURL}/api/secretary/edocs`
            }
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
                this.collection.documents = response.data.data
                this.total = response.data.data.total
                this.meta.page.documentList.current_page = this.collection.documents.current_page
                this.meta.page.documentList.last_page = this.collection.documents.last_page
                this.loadContent = false
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },
        detailDocument(id) {
            emitter.emit('detailDocument', [id, this.meta.user.role]);
        },
        editDocument(id, status_id) {
            if (status_id != 1 && status_id != 3) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Document sudah diproses",
                    showConfirmButton: false,
                    timer: 1500
                });
                return false
            }

            emitter.emit('editDocument', [id, this.meta.user.role]);
        },
        addDocument() {
            emitter.emit('AddDocument', this.meta.user);
        },
        getQRCode(item) {
            this.currentPrintDet = ''
            this.currentPrintDet = item
            var opts = {
                errorCorrectionLevel: "H",
                type: "image/jpeg",
                width: 500,
                rendererOpts: {
                    quality: 0.5,
                },
            };

            this.qrcode = this.currentPrintDet.number;

            QRCode.toDataURL(this.qrcode, opts, (err, url) => {
                if (err) throw err;
                this.qrCodeImage = url;
                var svgimg = document.createElementNS("http://www.w3.org/2000/svg", "image");
                svgimg.setAttribute("width", "94");
                svgimg.setAttribute("height", "94");
                svgimg.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", url);
                document.getElementById("myIndexSvg").appendChild(svgimg);
                // $("#qr-download").attr("href", url);
            });
        },
        generatePDF() {
            Swal.fire({
                timer: 2000,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })
            const element = document.getElementById('pdfContent');
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
        async deleteDocument(id, status_id) {
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
                confirmButtonColor: "#f19937",
                confirmButtonText: "Yes, delete it!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let endpoint = `${BASEURL}/api/edocs/${id}`;

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
                        this.fetchDocumentList();
                    } catch (error) {
                        console.log(error.response.data.message);
                        this.$swal.fire('Failed!', error.response.data.message, 'error');
                    }

                }
            });
        },
        async changePageDocumentList(url) {
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
                this.collection.documents = response.data.data
                this.meta.page.documentList.current_page = this.collection.documents.current_page
                this.meta.page.documentList.last_page = this.collection.documents.last_page
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
        'meta.search': 'fetchDocumentList',
        'meta.requestStatus': function (newVal, oldVal) {
            this.fetchDocumentList();
        },
        // 'meta.search': function (newVal, oldVal) {
        //     this.fetchDocumentList();
        // }
    },
}
</script>

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
</style>