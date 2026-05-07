<template>

    <!-- Document Table List -->
    <div class="container-fluid py-4 px-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asset</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Penghasilan &
                    Beban</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active border border-1 border-top-0 bg-white p-3" id="nav-home"
                role="tabpanel" aria-labelledby="nav-home-tab">
                <assets-section></assets-section>
            </div>

            <div class="tab-pane fade border border-1 border-top-0 bg-white p-3" id="nav-profile" role="tabpanel"
                aria-labelledby="nav-profile-tab">
                <penghasilan-section></penghasilan-section>
            </div>
        </div>
    </div>
</template>

<script>
import AssetsSection from './component/aset/index.vue';
import PenghasilanSection from './component/penghasilan/index.vue';
import { VMoney } from 'v-money'
import { emitter } from '../../../../eventEmitter.js';
import $ from "jquery";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
window.BASEURL = ''

export default {
    directives: { money: VMoney },
    components: { 
        VueDatePicker,
        'assets-section': AssetsSection,
        'penghasilan-section': PenghasilanSection,
    },
    created() {
        // emitter.on('fetchNasabahList', this.fetchNasabahList);
    },
    name: "Admin.Index",
    data() {
        return {
            model: {
                aset: {
                    kas: 0,
                    bank: 0,
                    penyisihan_piutang: 0,
                    persediaan_atk: 0,
                    investasi_peternakan: 0,
                    deposito: 0,
                    kendaraan: 0,
                    inventaris: 0,
                    ak_penyusutan_at: 0
                },
                penghasilan: {
                    pendapatan_lainnya: 0,
                    pendapatan_jasa: 0,
                    pendapatan_investasi: 0,
                    pendapatan_lainnya: 0,
                    beban_bunga: 0,
                    beban_gaji: 0,
                    beban_pemasaran: 0,
                    beban_transportasi: 0,
                    beban_atk: 0,
                    beban_sewa: 0,
                    beban_listrik: 0,
                    beban_penyisihan_piutang: 0,
                    beban_penyusutan_at: 0,
                    pendapatan_lainnya: 0,
                    beban_lainnya: 0,
                    shu_sebelum_pajak: 0,
                    pph: 0,
                    shu_setelah_pajak: 0
                }
            },
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'Rp. ',
                suffix: '',
                precision: 0,
                masked: false
            },
            months: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec"
            ],
            start_date: '',
            end_date: '',
            report: '',
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
                assets: '',
            },
            qrcode: '',
            qrCodeImage: '',
            currentPrintDet: '',
        }
    },

    async mounted() {
        await this.fetchReport();

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

        async fetchReport() {
            let endpoint = `${BASEURL}/api/report/hasil-usaha`;
            try {
                this.loadContent = true
                var date = new Date();
                var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                this.start_date == '' ? this.start_date = firstDay : this.start_date = this.start_date;
                this.end_date == '' ? this.end_date = lastDay : this.end_date = this.end_date;

                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'start_date': this.start_date,
                        'end_date': this.end_date
                    }
                });
                this.report = response.data
                console.log(this.report)
                this.loadContent = false
            } catch (error) {
                console.error("Error fetching document list: ", error);
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
                this.total = response.data.data.total
                this.meta.page.nasabahList.current_page = this.collection.nasabah.current_page
                this.meta.page.nasabahList.last_page = this.collection.nasabah.last_page
                this.loadContent = false
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },
        detailNasabah(id) {
            emitter.emit('detailNasabah', [id, this.meta.user.role]);
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
        // 'meta.search': 'fetchNasabahList',
        // 'meta.requestStatus': function (newVal, oldVal) {
        //     this.fetchNasabahList();
        // },
        // 'meta.search': function (newVal, oldVal) {
        //     this.fetchNasabahList();
        // }
        'start_date': function () {
            this.end_date != '' ? this.fetchReport() : '';
        },
        'end_date': function () {
            this.start_date != '' ? this.fetchReport() : '';
        },
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