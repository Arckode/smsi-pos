<template>
    <div class="col-md mb-3">
        <h6 class="font-weight-semibold text-md mb-0">Asset</h6>
        <p class="text-sm">Inputan untuk Aktiva & Pasiva</p>
        <hr>
    </div>
    <div class="row g-3 mb-3">
        <VueDatePicker v-model="index_date" hide-input-icon format="MMMM yyyy" :enable-time-picker="false"
            placeholder="End Date" month-picker></VueDatePicker>
        <div class="col-md">
            <div class="card-body table-responsive d-flex justify-content-center">
                <table class="table table-borderless table-hover align-items-center mb-0">
                    <tbody>
                        <tr class="bg-secondary">
                            <td colspan="2">
                                <p class="font-weight-semibold text-dark text-md mb-0 text-white">
                                    PENGHASILAN
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Pendapatan bunga pinjaman</p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[0].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Pendapatan jasa</p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[1].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Pendapatan investasi

                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[2].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Pendapatan lainnya
                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[3].total_nominal :
                                    0) }}
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p class="font-weight-semibold text-dark text-sm mb-0">BEBAN
                                    OPERASIONAL</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-2">BEBAN
                                    USAHA</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban bunga</p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[4].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban gaji</p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[5].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban pemasaran
                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[6].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban transpot
                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[7].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban sewa
                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[8].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban gaji</p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[9].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban listrik, telpon, air
                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[10].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban penyisihan piutang
                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[11].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Beban Penyusutan AT
                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[12].total_nominal :
                                    0) }}
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p class="font-weight-semibold text-dark text-sm mb-0">ASET
                                    TETAP</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Kendaraan</p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[13].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Inventaris</p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[14].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-weight-semibold text-dark text-sm mb-0 ms-3">-
                                    Ak. Penyusutan AT
                                </p>
                            </td>
                            <td>
                                {{ formatRupiah(collection.penghasilan.length > 0 ? collection.penghasilan[15].total_nominal :
                                    0) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md">
            <div class="card text-dark mb-3 border border-radius-lg border-1 p-2 border-start"
                style="border-left: 5px solid #55a6f8  !important;">
                <div class="container p-3">
                    <ul class="nav nav-pills mb-3 border-bottom border-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-primary fw-semibold active position-relative"
                                id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home-penghasilan" type="button"
                                role="tab" aria-controls="pills-home-penghasilan" aria-selected="true">Tambah Records</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-primary fw-semibold position-relative" id="pills-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-profile-penghasilan" type="button" role="tab"
                                aria-controls="pills-profile-penghasilan" aria-selected="false">History</button>
                        </li>
                    </ul>
                    <div class="tab-content p-3 text-danger" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home-penghasilan" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <form>
                                <div class="form-floating mb-3">
                                    <select class="form-select form-select-lg" id="floatingCategory"
                                        aria-label="Floating label select example" v-model="model.input.asset_type">
                                        <option disabled value="">Pilih Jenis Asset</option>
                                        <option v-for="(asset, index) in collection.options" :key="index"
                                            :value="asset.id">
                                            {{ asset.label }}
                                        </option>
                                    </select>
                                    <label for="floatingCategory">Jenis Assets<span class="text-danger">
                                            *</span></label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control" placeholder="Nominal" id="floatingLabel"
                                        v-model="model.input.nominal" v-money="money" />
                                    <label for="floatingLabel">Nominal<span class="text-danger"> *</span></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Leave a comment here"
                                        id="adddoclistfloatingDescription" style="height: 80px"
                                        v-model="model.input.description"></textarea>
                                    <label for="adddoclistfloatingDescription">Deskripsi<span class="text-danger">
                                        </span></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <VueDatePicker format="dd MMMM yyyy" :enable-time-picker="false"
                                        placeholder="Pilih Tanggal" v-model="model.input.tanggal" :start-date="min_date"
                                        :min-date="min_date" :max-date="max_date" :prevent-min-max-navigation="true">
                                    </VueDatePicker>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary mb-0" @click.prevent="confirmStore">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile-penghasilan" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="form-floating mb-3">
                                <select class="form-select form-select-lg" id="floatingCategory"
                                    aria-label="Floating label select example" v-model="model.history.asset_type">
                                    <option value="0">Semua</option>
                                    <option v-for="(asset, index) in collection.options" :key="index" :value="asset.id">
                                        {{ asset.label }}
                                    </option>
                                </select>
                                <label for="floatingCategory">Jenis Assets<span class="text-danger">
                                        *</span></label>
                            </div>
                            <!-- <div class="form-floating form-lg mb-3">
                                <VueDatePicker v-model="index_date" hide-input-icon format="MMMM yyyy"
                                    :enable-time-picker="false" placeholder="Pilih Tanggal" month-picker>
                                </VueDatePicker>
                            </div> -->


                            <table class="table table-borderless table-hover align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Type Asset</th>
                                        <th class="text-end" scope="col">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(detail, index) in collection.history_penghasilan" :key="index"
                                        class="align-items-center">
                                        <td class="align-middle text-xs p-3">{{ new
                                            Date(detail.date).toLocaleString('en-GB', {
                                                day: 'numeric', month: 'long',
                                            year: 'numeric' }) }}</td>
                                        <td class="align-middle text-xs p-3">{{ detail.user.name }}</td>
                                        <td class="align-middle text-xs p-3">{{ detail.penghasilan.label }}</td>
                                        <td class="text-end align-middle text-xs p-3">{{ formatRupiah(detail.nominal) }}
                                        </td>
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
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { VMoney } from 'v-money'
import $ from "jquery";
import Swal from "sweetalert2";
import QRCode from "qrcode";
import { emitter } from "../../../../../../eventEmitter.js";
import html2pdf from "html2pdf.js";
import ExcelJS from 'exceljs';
import html2canvas from 'html2canvas';
export default {
    directives: { money: VMoney },
    components: {
        VueDatePicker
    },
    name: "PenghasilanSection",
    data() {
        const curdate = new Date();
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
                input: {
                    asset_type: '',
                    nominal: 0,
                    deskripsi: '',
                    tanggal: ''
                },
                history: {
                    asset_type: 0,
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
            index_date: {
                month: curdate.getMonth(),
                year: curdate.getFullYear()
            },
            min_date: new Date(),
            max_date: new Date(),

            loadContent: true,

            start_date: '',
            end_date: '',

            collection: {
                options: [],
                penghasilan: '',
                history_penghasilan: '',
            },
        };
    },

    async mounted() {
        await this.fetchPenghasilan();
        await this.fetchDataPenghasilan();
        await this.fetchHistory();
        await this.updateDateRange();
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`;
        },
        async openModal() {
            this.modalAdd.show();
        },
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                currencyDisplay: 'symbol',
                maximumFractionDigits: 0
            }).format(value);
        },
        async updateDateRange() {
            // Set min_date to the first day of the selected month
            this.min_date = new Date(this.index_date.year, this.index_date.month, 1);
            // Set max_date to the last day of the selected month
            this.max_date = new Date(this.index_date.year, this.index_date.month + 1, 0); // 0 gets the last day of the previous month
        },
        async fetchPenghasilan() {

            let endpoint = `${BASEURL}/api/penghasilan/options`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                if (response.data) {
                    this.collection.options = response.data.data
                }
                console.log('penghasilan', this.collection.options)
            } catch (error) {
                console.log('User error: ', error)
            }
        },
        async fetchDataPenghasilan() {
            let endpoint = `${BASEURL}/api/penghasilan/table/${this.index_date.month + 1}/${this.index_date.year}`
            try {
                Swal.showLoading();
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.collection.penghasilan = response.data.data
                Swal.close()
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        async fetchHistory() {
            let endpoint = `${BASEURL}/api/penghasilan/history/${this.model.history.asset_type}/${this.index_date.month + 1}/${this.index_date.year}`
            try {
                Swal.showLoading();
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.collection.history_penghasilan = response.data.data
                Swal.close()
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        calculateAge(birthDate) {
            let today = new Date();
            let birth = new Date(birthDate);

            let years = today.getFullYear() - birth.getFullYear();
            let months = today.getMonth() - birth.getMonth();
            let days = today.getDate() - birth.getDate();

            if (days < 0) {
                months--;
                let lastDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
                days += lastDayOfMonth;
            }

            if (months < 0) {
                years--;
                months += 12;
            }

            this.model.nasabah.age_year = years;
            this.model.nasabah.age_month = months;
            this.model.nasabah.age_day = days;

            this.model.age_text_start = `${this.model.nasabah.age_year} Tahun, ${this.model.nasabah.age_month} bulan, ${this.model.nasabah.age_day} hari`;
        },
        addMonths() {
            let newDate = new Date(this.model.nasabah.tanggal_lahir);
            let birthDate = new Date(this.model.nasabah.tanggal_lahir);
            newDate.setMonth(newDate.getMonth() + this.model.angsuran.tenor);

            let newYears = newDate.getFullYear() - birthDate.getFullYear();
            let newMonths = newDate.getMonth() - birthDate.getMonth();
            let newDays = newDate.getDate() - birthDate.getDate();

            if (newDays < 0) {
                newMonths--;
                let lastDayOfMonth = new Date(newDate.getFullYear(), newDate.getMonth(), 0).getDate();
                newDays += lastDayOfMonth;
            }

            if (newMonths < 0) {
                newYears--;
                newMonths += 12;
            }

            this.model.age_text_end = `${newYears + this.model.nasabah.age_year} Tahun, ${newMonths} bulan, ${newDays} hari`;
        },
        handleFileChange(event, type) {
            const file = event.target.files[0]
            if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                    if (type === 'nasabah') {
                        this.model.foto_profil_preview = e.target.result
                        this.model.foto_profil = file
                    } else if (type === 'ktp') {
                        this.model.foto_ktp_preview = e.target.result
                        this.model.foto_ktp = file
                    }
                }
                reader.readAsDataURL(file)
            }
        },

        async fetchCategories() {
            let endpoint = `${BASEURL}/api/edoc/category/options`;
            let response = await axios.get(endpoint, {
                headers: {
                    Authorization: "Bearer " + this.$token(),
                },
            });
            this.collections.categories = response.data.data.options;
        },
        async calculateAngsuran() {
            if (
                this.model.angsuran.schedule_angsuran_created &&
                this.model.angsuran.nilai_plafond !== 0 &&
                this.model.angsuran.rate_bunga !== 0 &&
                this.model.angsuran.rate_bunga !== '' &&
                this.model.angsuran.tenor !== 0 &&
                this.model.angsuran.tenor !== ''
            ) {
                const annualInterestRate = this.model.angsuran.rate_bunga / 100;
                const months = this.model.angsuran.tenor;
                const principal = parseFloat(this.model.angsuran.nilai_plafond.replace(/Rp\.|\./g, ''));

                const monthlyInterestRate = annualInterestRate / 12;

                this.model.angsuran.nilai_angsuran = principal * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, months) / (Math.pow(1 + monthlyInterestRate, months) - 1);
                this.displayedAngsuran = Math.round(this.model.angsuran.nilai_angsuran);
                this.model.angsuran.nilai_angsuran = parseFloat(this.model.angsuran.nilai_angsuran);
                this.model.refreshAngsuranBtn = true
            }
        },

        async createScedule() {
            if (this.model.refreshAngsuranBtn) {
                let endpoint = `${BASEURL}/api/simulation`;
                let response = await axios.post(endpoint, this.model.angsuran, {
                    headers: {
                        Authorization: "Bearer " + this.$token(),
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.model.angsuran.details = response.data.simulation;
                this.model.createdSchedule = true
            }
        },
        async confirmStore() {
            if (this.model.input.asset_type == '') {
                Swal.fire("Kesalahan", "Pilih jenis terlebih dahulu", "error");
                return false;
            }
            if (this.model.input.nominal == 'Rp. 0') {
                Swal.fire("Kesalahan", "Nominal harus lebih besar dari 0 Rp.", "error");
                return false;
            }
            if (this.model.input.tanggal == '') {
                Swal.fire("Kesalahan", "Pilih tanggal terlebih dahulu", "error");
                return false;
            }

            Swal.fire({
                title: "Simpan?",
                text: "Pastikan data yang anda simpan sudah benar",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Simpan",
            }).then((result) => {
                if (result.value) {
                    this.store();
                }
            });
        },
        async store() {
            this.loading = true
            let endpoint = `${BASEURL}/api/penghasilan`;
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    text: 'Sedang diproses, mohon ditunggu..',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.post(endpoint, this.model, {
                    headers: {
                        Authorization: "Bearer " + this.$token(),
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.loading = false
                Swal.close()
                if (response) {
                    Swal.fire({
                        title: "Penyimpanan Berhasil",
                        icon: "success",
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: "Close",
                    }).then((result) => {
                        this.resetForm();
                    });
                }
            } catch (error) {
                this.loading = false
                console.error("Error store nasabah: ", error);
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

        resetForm() {
            this.model.input = {
                asset_type: '',
                nominal: 0,
                tanggal: '',
                deskripsi: '',
            }
            this.fetchDataPenghasilan()
            this.fetchHistory()
        },


        convertToExcel() {
            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Jadwal Angsuran Pinjaman');

            // Add header
            worksheet.addRow(['No', 'Tanggal Bayar', 'Angsuran', 'Pokok', 'Margin', 'Sisa Pokok']);

            // Add data rows
            this.model.angsuran.details.forEach(detail => {
                worksheet.addRow([
                    detail.angsuran_ke,
                    detail.tanggal_bayar,
                    detail.angsuran,
                    detail.pokok,
                    detail.margin,
                    detail.sisa_pokok
                ]);
            });

            // Save the workbook
            workbook.xlsx.writeBuffer().then(buffer => {
                const blob = new Blob([buffer], { type: 'application/octet-stream' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'jadwal_angsuran_pinjaman.xlsx';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            });
        },
        convertToPDF() {
            const element = document.getElementById('table-angsuran');
            const opt = {
                margin: 1,
                filename: 'jadwal_angsuran_pinjaman.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 1 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(element).set(opt).save();
        },
        convertToImg() {
            const element = document.getElementById('table-angsuran');
            html2canvas(element).then(canvas => {
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'jadwal_angsuran_pinjaman.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }).catch(function (error) {
                console.error('Oops, something went wrong!', error);
            });
        },
        convertNominal(nominal) {
            let cleanedValue = nominal
                .replace(/Rp\.?\s?/g, '')
                .replace(/\./g, '')
                .replace(/,/g, '.')
                .trim()
            return parseFloat(cleanedValue) || 0;
        },
        generatePDFAddDoc() {
            Swal.fire({
                timer: 2000,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
            const element = document.getElementById("pdfContentAddDoc");
            html2pdf()
                .from(element)
                // .save('qrcode.pdf');
                .toPdf()
                .get("pdf")
                .then((pdf) => {
                    const blob = pdf.output("blob");
                    const url = URL.createObjectURL(blob);

                    const newTab = window.open(url);

                    newTab.onload = () => {
                        newTab.print();
                    };
                });
        },
    },
    computed: {},
    watch: {
        'model.angsuran.nilai_plafond': function () {
            this.refreshAngsuran()
            this.model.angsuran.provisi_nominal = this.model.angsuran.nilai_plafond.replace(/[^0-9]/g, "") * (this.model.angsuran.provisi_percentage / 100)
            // console.log(this.model.angsuran.nilai_plafond)
        },
        'model.angsuran.rate_bunga': function () {
            this.refreshAngsuran()
        },
        'model.angsuran.tenor': function () {
            this.refreshAngsuran()
            this.addMonths()
        },
        'model.angsuran.tanggal_mulai': function () {
            this.refreshAngsuran()
        },
        'model.nasabah.tanggal_lahir': function (val) {
            this.calculateAge(val)
        },
        'model.angsuran.provisi_percentage': function () {
            // this.refreshAngsuran()
            this.model.angsuran.provisi_nominal = this.model.angsuran.nilai_plafond.replace(/[^0-9]/g, "") * (this.model.angsuran.provisi_percentage / 100)
            // console.log(this.model.angsuran.nilai_plafond)
        },
        'index_date': function () {
            this.updateDateRange()
            this.fetchDataPenghasilan()
            this.fetchHistory()
        },
        'model.history.asset_type': function () {
            this.fetchHistory()
        }
    },
};
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

.nav .nav-item button.active {
    background-color: transparent;
    color: var(--bs-info) !important;
}

.nav .nav-item button.active::after {
    content: "";
    border-bottom: 4px solid var(--bs-info);
    width: 100%;
    position: absolute;
    left: 0;
    bottom: -1px;
    border-radius: 5px 5px 0 0;
}
</style>