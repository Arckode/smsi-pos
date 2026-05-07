<template>
    <div class="container-fluid py-4 px-5">
        <div class="card border shadow-none">
            <div class="card-body">
                <p class="card-text text-md m-0">Jumlah Semua Tunggakan Nasabah</p>
                <h3 class="card-title m-0">{{ formatRupiah(total) }}</h3>
                <span class="alert alert-danger p-0 ps-2 pe-2">
                    Tunggakan Nasabah Per Bulan {{ currentMonthName }}
                </span>
            </div>
            <nav>
                <div class="nav nav-tabs mt-1" id="nav-tab" role="tablist">
                    <button class="nav-link ms-3 active" id="nav-home-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                        aria-selected="true">List Tunggakan</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">History</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active bg-white p-3" id="nav-home" role="tabpanel"
                    aria-labelledby="nav-home-tab">
                    <list-section></list-section>
                </div>

                <div class="tab-pane fade bg-white p-3" id="nav-profile" role="tabpanel"
                    aria-labelledby="nav-profile-tab">
                    <history-section></history-section>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import AssetsSection from './component/list.vue';
import HistorySection from './component/history.vue';

import { emitter } from '../../../../../../eventEmitter.js';
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
window.BASEURL = ''

export default {
    created() {
        emitter.on('fetchPinjamanList', this.fetchPinjamanList);
    },
    name: "Admin.Index",
    components: {
        'list-section': AssetsSection,
        'history-section': HistorySection,
        // 'edit-document-offcanvas': EditDocumentOffcanvas,
        // 'detail-pinjaman-offcanvas': DetailPinjamanOffcanvas
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
                pinjaman: '',
                nasabah: '',
            },
            qrcode: '',
            qrCodeImage: '',
            currentPrintDet: '',
            currentMonthName: '',
            total: 0,
        }
    },

    async mounted() {
        await this.getCurrentMonth();
        await this.getCurrentTunggakan();
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                currencyDisplay: 'symbol',
                maximumFractionDigits: 0
            }).format(value);
        },
        async getCurrentMonth() {
            const date = new Date();
            const monthIndex = date.getMonth(); // getMonth() returns a zero-based index (0 for January, 11 for December)
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            this.currentMonthName = monthNames[monthIndex];
        },
        async getCurrentTunggakan() {
            let endpoint = `${BASEURL}/api/angsuran-pinjaman/tunggakan`;
            let response = await axios.get(endpoint, {
                headers: {
                    Authorization: "Bearer " + this.$token(),
                },
            });
            this.total = response.data.data.total
            console.log('tunggakan', this.total)
        },
    },
    watch: {
        'meta.search': 'fetchPinjamanList',
        'meta.requestStatus': function (newVal, oldVal) {
            this.fetchPinjamanList();
        },
        // 'meta.search': function (newVal, oldVal) {
        //     this.fetchPinjamanList();
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