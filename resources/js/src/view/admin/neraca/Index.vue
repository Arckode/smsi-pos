<template>

    <!-- Document Table List -->
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="row g-3">
                            <div class="col-sm align-self-center">
                                <button class="btn btn-primary m-0 font-weight-normal" @click="exportTableData"><i
                                        class="fas fa-file-excel me-2"></i> Export</button>
                            </div>
                            <div class="col-sm align-self-center">
                                <div class="d-flex flex-row align-items-center justify-content-end me-3">
                                    <label class="form-check-label me-2"> All</label>
                                    <div class="form-check form-switch ms-1">
                                        <input class="form-check-input d-flex align-items-center" style="height: 20px;"
                                            type="checkbox" id="flexSwitchCheckCheckedExecuting" v-model="is_executing">
                                        <label class="form-check-label" for="flexSwitchCheckCheckedExecuting">
                                            Executing</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-sm-flex flex-column align-items-center">
                            <h4 class="font-weight-bold mb-0 text-dark text-xl">Koperasi Nusa Sejahtera</h4>
                            <h5 class="font-weight-semibold mb-0 text-dark text-md">Neraca Transisi</h5>
                            <!-- <p class="font-weight-semibold text-dark text-sm">Untuk Periode 1 Januari 2021 s/d 31
                                Desember 2021</p> -->
                            <div class="d-flex flex-row align-items-center justify-content-center mb-4">
                                <!-- <p class="font-weight-semibold text-dark text-sm"> -->
                                <p class="font-weight-semibold text-dark text-nowrap mb-0 mx-2 text-md"> Untuk Periode
                                </p>
                                <VueDatePicker v-model="year" year-picker />
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center ">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-items-center mb-0" id="myTable">
                                <tbody>
                                    <tr class="bg-primary">
                                        <td>
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white">
                                                ASET
                                            </p>
                                            <p class="text-sm mb-0 text-white">
                                                ( Aktiva )
                                            </p>
                                        </td>
                                        <template v-for="(month, index) in months" :key="index">
                                            <td class="text-center align-middle">
                                                <p class="font-weight-semibold text-dark text-md mb-0 text-white">
                                                    {{ month }}
                                                </p>
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td colspan="13">
                                            <p class="font-weight-semibold text-dark text-sm mb-0">ASET LANCAR</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Kas</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[1]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Bank</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[2]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Piutang Usaha
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[3]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Penyisihan
                                                Piutang
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[4]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Persediaan ATK
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[5]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>


                                    <tr class="bg-secondary">
                                        <td class="text-center align-middle">
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white">Jumlah
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in sum.asset_lancar" :key="index">
                                            <td class="text-end align-middle text-white">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>

                                    <!-- <tr>
                                        <td colspan="13"></td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="13">
                                            <p class="font-weight-semibold text-dark text-sm mb-0">ASET TIDAK LANCAR</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Investasi
                                                Peternakan</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[6]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Diposito</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[7]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr class="bg-secondary">
                                        <td>
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white ms-5">
                                                Jumlah
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in sum.asset_tidak_lancar" :key="index">
                                            <td class="text-end align-middle text-white">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>

                                    <!-- <tr>
                                        <td colspan="13"></td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="13">
                                            <p class="font-weight-semibold text-dark text-sm mb-0">ASET TETAP</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Kendaraan</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[8]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Inventaris</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[9]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Ak. Penyusutan
                                                AT
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[10]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr class="bg-secondary">
                                        <td>
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white ms-5">
                                                Jumlah
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in sum.asset_tetap" :key="index">
                                            <td class="text-end align-middle text-white">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>

                                    <!-- <tr>
                                        <td colspan="13"></td>
                                    </tr> -->
                                    <tr class="bg-info">
                                        <td>
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white">TOTAL ASET
                                            </p>
                                            <p class="text-sm mb-0 text-white">
                                                ( Aktiva )
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in sum.aktiva" :key="index">
                                            <td class="text-end align-middle text-white">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td colspan="13"></td>
                                    </tr>
                                    <tr class="bg-primary">
                                        <td>
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white">
                                                KEWAJIBAN & EKUITI
                                            </p>
                                            <p class="text-sm mb-0 text-white">
                                                ( Passiva )
                                            </p>
                                        </td>
                                        <template v-for="(month, index) in months" :key="index">
                                            <td class="text-center align-middle">
                                                <p class="font-weight-semibold text-dark text-md mb-0 text-white">
                                                    {{ month }}
                                                </p>
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td colspan="13">
                                            <p class="font-weight-semibold text-dark text-sm mb-0">KEWAJIBAN JANGKA
                                                PENDEK</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Simpanan
                                                sukarela</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[11]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Dana bag SHU
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[12]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Dana Risiko
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[13]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Utang PPh
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[14]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr class="bg-secondary">
                                        <td class="text-center align-middle">
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white">Jumlah
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in sum.asset_jangka_pendek" :key="index">
                                            <td class="text-end align-middle text-white">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>






                                    <!-- <tr>
                                        <td colspan="13"></td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="13">
                                            <p class="font-weight-semibold text-dark text-sm mb-0">KEWAJIBAN JANGKA
                                                PANJANG</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Utang bank</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[15]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr class="bg-secondary">
                                        <td>
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white ms-5">
                                                Jumlah
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in sum.asset_jangka_panjang" :key="index">
                                            <td class="text-end align-middle text-white">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>

                                    <!-- <tr>
                                        <td colspan="13"></td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="13">
                                            <p class="font-weight-semibold text-dark text-sm mb-0">EKUITAS</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Simpanan pokok
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[16]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Simpanan wajib
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[17]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Cadangan Umum
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[18]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- Modal
                                                Penyertaan</p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[19]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">- SHU
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in collection.assets[20]" :key="index">
                                            <td class="text-end align-middle">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                    <tr class="bg-secondary">
                                        <td>
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white ms-5">
                                                Jumlah
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in sum.asset_ekuitas" :key="index">
                                            <td class="text-end align-middle text-white">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>

                                    <!-- <tr>
                                        <td colspan="13"></td>
                                    </tr> -->
                                    <tr class="bg-info">
                                        <td>
                                            <p class="font-weight-semibold text-dark text-md mb-0 text-white">TOTAL
                                                KEWAJIBAN & EKUITI</p>
                                            <p class="text-sm mb-0 text-white">
                                                ( Passiva )
                                            </p>
                                        </td>
                                        <template v-for="(asset, index) in sum.passiva" :key="index">
                                            <td class="text-end align-middle text-white">
                                                {{ formatRupiah(asset) }}
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { emitter } from '../../../../eventEmitter.js';
import $ from "jquery";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
import * as XLSX from 'xlsx';
window.BASEURL = ''

export default {
    components: { VueDatePicker },
    created() {
        // emitter.on('fetchNasabahList', this.fetchNasabahList);
    },
    name: "Admin.Index",
    data() {
        const curdate = new Date();
        return {
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
            year: curdate.getFullYear(),
            is_executing: true,
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
                assets: '',
                documents: '',
                nasabah: '',
            },
            sum: {
                asset_lancar: '',
                asset_tidak_lancar: '',
                asset_tetap: '',
                aktiva: '',

                asset_jangka_pendek: '',
                asset_jangka_panjang: '',
                asset_ekuitas: '',
                passiva: '',
            },
            qrcode: '',
            qrCodeImage: '',
            currentPrintDet: '',
        }
    },

    async mounted() {
        // await this.fetchReport();
        await this.fetchIndex();

    },

    methods: {
        exportTableData() {
            // Get the table element by ID
            const table = document.getElementById('myTable');

            // Create a workbook and a worksheet
            const workbook = XLSX.utils.table_to_book(table, { sheet: 'Sheet1' });

            // Generate buffer and save the file
            XLSX.writeFile(workbook, 'table_data.xlsx');
        },
        asset(path) {
            return `${BASEURL}${path}`
        },
        formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'decimal',
                maximumFractionDigits: 0,
            }).format(value);
        },
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                currencyDisplay: 'symbol',
                maximumFractionDigits: 0,
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
        async fetchIndex() {

            let endpoint = `${BASEURL}/api/assets`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'is_executing': this.is_executing,
                        'year': this.year
                    }
                })
                console.log(response.data.data)
                if (response.data) {
                    this.collection.assets = response.data.data

                    let asset_lancar = [1, 2, 3, 4, 5];
                    let asset_tidak_lancar = [6, 7];
                    let asset_tetap = [8, 9, 10];
                    let asset_aktiva = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

                    let asset_jangka_pendek = [11, 12, 13, 14];
                    let asset_jangka_panjang = [15];
                    let asset_ekuitas = [16, 17, 18, 19, 20];
                    let asset_passiva = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

                    this.sum.asset_lancar = this.sumArrays(this.collection.assets, asset_lancar)
                    this.sum.asset_tidak_lancar = this.sumArrays(this.collection.assets, asset_tidak_lancar)
                    this.sum.asset_tetap = this.sumArrays(this.collection.assets, asset_tetap)
                    this.sum.aktiva = this.sumArrays(this.collection.assets, asset_aktiva)

                    this.sum.asset_jangka_pendek = this.sumArrays(this.collection.assets, asset_jangka_pendek)
                    this.sum.asset_jangka_panjang = this.sumArrays(this.collection.assets, asset_jangka_panjang)
                    this.sum.asset_ekuitas = this.sumArrays(this.collection.assets, asset_ekuitas)
                    this.sum.passiva = this.sumArrays(this.collection.assets, asset_passiva)
                }
            } catch (error) {
                console.log('User error: ', error)
            }
        },
        sumArrays(data, range) {
            // Convert range to a set for efficient lookup
            let rangeSet = new Set(range);

            let arrays = Object.entries(data)
                .filter(([key]) => rangeSet.has(parseInt(key))) // Filter based on the range
                .map(([, value]) => value); // Extract the value arrays

            if (arrays.length === 0) {
                return []; // Handle the case where no data matches the range
            }

            // Use reduce to sum the arrays element-wise
            return arrays.reduce((sums, currentArray) => {
                return sums.map((sum, index) => sum + currentArray[index]);
            }, Array(arrays[0].length).fill(0)); // Initialize with an array of zeros
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
        'is_executing': function () {
            this.fetchIndex();
        },
        'year': function () {
            this.year != '' ? this.fetchIndex() : '';
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