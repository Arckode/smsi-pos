<template>

    <!-- offcanvas Add New Document -->
    <add-nasabah-offcanvas ref="addNasabah"></add-nasabah-offcanvas>

    <!-- offcanvas Edit New Document -->
    <edit-document-offcanvas ref="editDocument"></edit-document-offcanvas>

    <!-- offcanvas detail Document -->
    <detail-nasabah-offcanvas ref="detailNasabah"></detail-nasabah-offcanvas>

    <!-- Document Table List -->
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Nasabah list</h6>
                                <p class="text-sm">Informasi tentang semua Nasabah</p>
                            </div>
                            <div class="ms-auto d-flex">
                                <button @click.prevent="addNasabah"
                                    class="btn btn-sm btn-primary d-flex align-items-center me-2" type="button"
                                    :disabled="loadContent">
                                    <span class="btn-inner--icon">
                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" fill="currentColor" class="d-block me-2">
                                            <path
                                                d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                                        </svg>
                                    </span>
                                    Tambah Baru
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                            <div class="d-flex flex-column">
                                <p class="text-sm mb-1 text-dark text-bold">Status Angsuran Pinjaman</p>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable1"
                                        autocomplete="off" checked v-model="meta.requestStatus" value="">
                                    <label class="btn btn-white px-3 mb-0" for="btnradiotable1">All</label>
                                    <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable2"
                                        autocomplete="off" v-model="meta.requestStatus" value="pending">
                                    <label class="btn btn-white px-3 mb-0" for="btnradiotable2">Terbit</label>
                                    <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable3"
                                        autocomplete="off" v-model="meta.requestStatus" value="completed">
                                    <label class="btn btn-white px-3 mb-0" for="btnradiotable3">Belum Terbit</label>
                                </div>
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
                                <input type="text" class="form-control" placeholder="Nama / HP / NIK / Alamat"
                                    v-model="meta.search">
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <div v-if="loadContent" class="d-flex justify-content-center p-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <h6 class="align-middle text-center text-lg pt-3 text-muted"
                                v-else-if="collection.nasabah && collection.nasabah.data.length == 0">Tidak ada data
                            </h6>
                            <table v-else class="table align-items-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-sm font-weight-semibold opacity-7">Nama Nasabah</th>
                                        <th class="text-sm font-weight-semibold opacity-7">Tempat / Tanggal lahir</th>
                                        <th class="text-sm font-weight-semibold opacity-7">Nomor Telepon / Alamat</th>
                                        <!-- <th class="text-sm font-weight-semibold opacity-7">Alamat</th> -->
                                        <th class="text-center text-sm font-weight-semibold opacity-7">Status
                                            <br>Angsuran Pinjaman
                                        </th>
                                        <!-- <th class="text-center text-xs font-weight-semibold opacity-7">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in collection.nasabah.data" :key="item.id">
                                        <td class="align-middle text-lg">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <a class="mb-0 text-sm font-weight-semibold text-primary text-bold" @click.prevent="detailNasabah(item.id)">
                                                        {{ item.nama_lengkap }}
                                                    </a>
                                                    <p class="text-sm text-secondary mb-0">
                                                        {{item.nik ? item.nik : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-lg">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                        {{ item.tempat_lahir ? item.tempat_lahir : '-' }}
                                                    </h6>
                                                    <p class="text-sm text-secondary mb-0">
                                                        {{ item.tanggal_lahir ? new Date(item.tanggal_lahir).toLocaleString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' }) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- <td class="align-middle text-lg">
                                            <div class="d-flex px-3 py-1">
                                                <h6 class="mb-0 text-sm font-weight-semibold">
                                                    {{ item.no_telepon }}
                                                </h6>
                                            </div>
                                        </td> -->

                                        <td class="responsive-description">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                    {{ item.no_telepon ? item.no_telepon : '-' }}
                                                </h6>
                                                    <h6 class="mb-0 text-sm font-weight-semibold responsive-description">
                                                        {{ item.alamat ?item.alamat.length > 50 ? item.alamat.substring(0, 50) + '.....' : item.alamat : '-' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-lg">
                                            <span v-if="item.angsuran_pinjaman.length > 0"
                                                class="badge badge-sm border border-success text-success bg-success">
                                                Terbit
                                            </span>
                                            <span v-else
                                                class="badge badge-sm border border-danger text-danger bg-danger">
                                                Belum Terbit
                                            </span>
                                        </td>
                                        <!-- <td class="align-middle text-center">
                                            <a @click.prevent="editDocument(item.id, item.status.status_id); $event.stopPropagation()"
                                                class="text-info fs-5 m-2" type="button" title="Edit Document">
                                                <i class="fas fa-pencil-alt" alt="Edit" aria-hidden="true">
                                                    <span class="sr-only text-sm">
                                                        Edit
                                                    </span>
                                                </i>
                                            </a>
                                            <a @click.prevent="deleteDocument(item.id, item.status.status_id); $event.stopPropagation()"
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
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top py-3 px-3 d-flex align-items-center flex-wrap">
                            <div class="d-flex flex-column">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">Halaman {{
                                    meta.page.nasabahList.current_page }} dari {{ meta.page.nasabahList.last_page
                                    }}
                                </p>
                                <p class="font-weight-semibold mb-0 text-secondary text-sm">Total: {{ meta.total }} Nasabah
                                </p>
                            </div>
                            <div class="ms-auto">
                                <button v-for="(link, index) in collection.nasabah.links"
                                    v-on:click="changePageNasabahList(link.url)" class="btn btn-sm btn-white mb-0"
                                    :disabled="link.active">
                                    <span v-if="index === 0">
                                        <i class="fas fa-chevron-left">
                                            <span class="sr-only text-xs m-0">
                                                Previous
                                            </span>
                                        </i>
                                    </span>
                                    <span v-else-if="index === collection.nasabah.links.length - 1">
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
import AddNasabahOffcanvas from './component/Add.vue';
import EditDocumentOffcanvas from './component/Edit.vue';
import DetailNasabahOffcanvas from './component/Detail.vue';
import { emitter } from '../../../../../eventEmitter.js';
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
window.BASEURL = ''

export default {
    created() {
        emitter.on('fetchNasabahList', this.fetchNasabahList);
    },
    name: "Admin.Index",
    components: {
        'add-nasabah-offcanvas': AddNasabahOffcanvas,
        'edit-document-offcanvas': EditDocumentOffcanvas,
        'detail-nasabah-offcanvas': DetailNasabahOffcanvas
    },
    data() {
        return {
            loadContent: true,
            meta: {
                user: '',
                page: {
                    nasabahList: {
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
                nasabah: '',
            },
            qrcode: '',
            qrCodeImage: '',
            currentPrintDet: '',
        }
    },

    async mounted() {
        await this.fetchCurrentUser();
        await this.fetchNasabahList();
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
        async fetchNasabahList() {
            let endpoint = `${BASEURL}/api/nasabah`;
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
                this.collection.nasabah = response.data.data
                console.log(this.collection.nasabah)
                this.meta.total = response.data.data.total
                this.meta.page.nasabahList.current_page = this.collection.nasabah.current_page
                this.meta.page.nasabahList.last_page = this.collection.nasabah.last_page
                this.loadContent = false
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },
        detailNasabah(id) {
            emitter.emit('detailNasabah', id);
        },
        // editDocument(id, status_id) {
        //     if (status_id != 1 && status_id != 3) {
        //         Swal.fire({
        //             icon: "error",
        //             title: "Gagal",
        //             text: "Document sudah diproses",
        //             showConfirmButton: false,
        //             timer: 1500
        //         });
        //         return false
        //     }

        //     emitter.emit('editDocument', [id, this.meta.user.role]);
        // },
        addNasabah() {
            emitter.emit('AddNasabah', this.meta.user);
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
                        this.fetchNasabahList();
                    } catch (error) {
                        console.log(error.response.data.message);
                        this.$swal.fire('Failed!', error.response.data.message, 'error');
                    }

                }
            });
        },
        async changePageNasabahList(url) {
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
                this.meta.page.nasabahList.current_page = this.collection.documents.current_page
                this.meta.page.nasabahList.last_page = this.collection.documents.last_page
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
        'meta.search': 'fetchNasabahList',
        'meta.requestStatus': function (newVal, oldVal) {
            this.fetchNasabahList();
        },
        // 'meta.search': function (newVal, oldVal) {
        //     this.fetchNasabahList();
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