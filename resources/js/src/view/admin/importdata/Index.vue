<template>

    <!-- Document Table List -->
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex flex-column align-items-center">
                            <h6 class="font-weight-semibold text-lg mb-0">Import Data Nasabah & Angsuran</h6>
                            <p class="text-md mt-2 text-dark">Sebelum upload data excel, Pastikan urutan data sudah
                                sesuai dengan <a class="text-info pointer" @click.prevent="downloadTemplate">template
                                    berikut</a>.</p>
                        </div>
                        <div v-if="excelData.length"
                            class="d-flex flex-column bg-gray-100 border border-gray-200 border-radius-lg mb-3 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-md m-0 text-dark">Data dari Excel :</h6>
                                <a class="btn btn-warning m-0 text-xs" @click.prevent="changeFile"><i class="fas fa-sync"></i> Ganti File</a>
                            </div>
                            <p class="text-sm m-0">Nama File : {{ sheetName }}</p>
                            <p class="text-sm m-0">Jumlah Data : {{ excelData.length }}</p>
                        </div>
                        <div>

                            <div class="file-upload-container w-100 mb-3">
                                <!-- <input type="file" /> -->
                                <div class="d-flex flex-column">
                                    <input v-if="!excelData.length" ref="fileInput" type="file" @change="handleFileUpload"
                                        accept=".xlsx, .xls, .csv" />
                                    <div v-if="error" class="error-message">
                                        <p class="text-sm text-danger m-0">Terjadi kesalahan: {{ error }}</p>
                                    </div>
                                </div>

                                <div v-if="verifiedExcelData.length" class="table-responsive">
                                    <table class="table table-borderless table-hover align-items-center mb-0 w-50">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <a class="btn btn-primary m-0 text-xs">
                                                        <i class="fas fa-cloud-upload-alt"></i> import all
                                                    </a>
                                                </th>
                                                <th v-for="(header, index) in excelHeaders" :key="index">{{
                                                    header
                                                    }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(row, rowIndex) in verifiedExcelData" :key="rowIndex">
                                                <td class="text-center">
                                                    <!-- Tombol untuk setiap baris -->
                                                    <a v-if="!row.existing" class="btn btn-info m-0 text-xs"
                                                        @click.prevent="triggerRowAction(row, rowIndex)">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                    </a>
                                                    <a v-else class="btn btn-success m-0 text-xs"
                                                        @click.prevent="triggerOpenDetail(row, rowIndex)">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                </td>
                                                <td v-for="(cell, cellIndex) in row" :key="cellIndex">{{
                                                    cell }}
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
        const today = new Date();
        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };
        return {

            excelData: [], // Untuk menyimpan data yang diurai dari Excel
            excelHeaders: [], // Untuk menyimpan header kolom
            sheetName: '', // Untuk menyimpan nama sheet yang dibaca
            error: null, // Untuk menangani pesan kesalahan
            verifiedExcelData: [],


            start_date: formatDate(startOfMonth),
            end_date: formatDate(endOfMonth),
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
            },
            qrcode: '',
            qrCodeImage: '',
            currentPrintDet: '',
        }
    },

    async mounted() {
        await this.fetchIndex();

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

        // Metode baru untuk mengunduh template Excel
        downloadTemplate() {
            const headers = [
                "Nama",
                "NIK",
                "Nomor Pensiunan",
                "Rekening",
                "Plafond", // Nominal rupiah
                "Bunga (%)", // int
                "Jangka Waktu (Bulan)", // int
                "Tanggal Akad", // date (format YYYY-MM-DD)
                "Bulan Outstanding" // int
            ];

            // Contoh data kosong atau placeholder untuk template
            const templateData = [
                headers,
                ["John Doe", "1234567890123456", "P12345", "1234567890", 15000000, 5, 20, "20-01-2024", 3 + " (isi tagihan ke- , tidak perlu diisi jika tidak ada outstanding)"] // Contoh data
            ];

            // Buat worksheet dari array of arrays
            const ws = XLSX.utils.aoa_to_sheet(templateData);

            // Tambahkan lebar kolom agar lebih mudah dibaca
            ws['!cols'] = [
                { wch: 20 }, // Nama
                { wch: 20 }, // NIK
                { wch: 20 }, // Nomor Pensiunan
                { wch: 20 }, // Rekening
                { wch: 15 }, // Plafond
                { wch: 10 }, // Bunga
                { wch: 15 }, // Jangka Waktu
                { wch: 15 }, // Tanggal Akad
                { wch: 20 }  // Bulan Outstanding
            ];

            // Buat workbook baru
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Template Import Data"); // Tambahkan sheet ke workbook

            // Tulis dan unduh file Excel
            XLSX.writeFile(wb, "template_import_data.xlsx");
        },
        changeFile() {
            this.error = null;
            this.excelData = [];
            this.excelHeaders = [];
            this.sheetName = '';
            this.verifiedExcelData = [];

            this.$nextTick(() => {
                const input = this.$refs.fileInput;
                if (input) {
                    try {
                        input.value = null;
                        input.click();
                    } catch (e) {
                        console.error('Could not open file picker:', e);
                    }
                }
            });
        },
        handleFileUpload(event) {
            this.error = null; // Reset error
            const file = event.target.files[0]; // Ambil file pertama yang dipilih

            if (!file) {
                this.error = 'Tidak ada file yang dipilih.';
                return;
            }

            // Periksa tipe file
            const allowedTypes = [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
                'application/vnd.ms-excel', // .xls
                'text/csv', // .csv
            ];

            if (!allowedTypes.includes(file.type)) {
                this.error = 'Tipe file tidak didukung. Harap unggah file .xlsx, .xls, atau .csv.';
                this.excelData = [];
                this.excelHeaders = [];
                this.sheetName = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = (e) => {
                try {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: 'array' });

                    // Ambil nama sheet pertama
                    this.sheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[this.sheetName];

                    // Konversi sheet ke array of arrays (untuk mendapatkan header dan data)
                    const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

                    if (jsonData[1].length > 0) {
                        this.excelHeaders = jsonData[0]; // Baris pertama adalah header
                        this.excelData = jsonData.slice(1); // Sisa baris adalah data
                        this.uploadedFileValidation()
                    } else {
                        this.excelData = [];
                        this.excelHeaders = [];
                        this.error = 'File Excel kosong atau tidak memiliki data.';
                    }
                } catch (err) {
                    this.error = 'Gagal membaca file Excel. Pastikan formatnya benar.';
                    console.error('Error reading Excel file:', err);
                    this.excelData = [];
                    this.excelHeaders = [];
                    this.sheetName = '';
                }
            };

            reader.onerror = (err) => {
                this.error = 'Gagal membaca file. Silakan coba lagi.';
                console.error('FileReader error:', err);
                this.excelData = [];
                this.excelHeaders = [];
                this.sheetName = '';
            };

            reader.readAsArrayBuffer(file); // Baca file sebagai ArrayBuffer
        },
        async uploadedFileValidation() {
            console.log(this.excelData)
            // this.loading = true
            let endpoint = `${BASEURL}/api/data/import/verify`;
            try {
                // Swal.fire({
                //     allowOutsideClick: false,
                //     text: 'Sedang diproses, mohon ditunggu..',
                //     didOpen: () => {
                //         Swal.showLoading();
                //     }
                // })
                let response = await axios.post(endpoint, this.excelData, {
                    headers: {
                        Authorization: "Bearer " + this.$token(),
                        "Content-Type": "multipart/form-data",
                    },
                });
                // this.loading = false
                Swal.close()
                if (response) {
                    this.verifiedExcelData = response.data.data
                    // Swal.fire({
                    //     title: "Penyimpanan Berhasil",
                    //     icon: "success",
                    //     showCancelButton: false,
                    //     allowOutsideClick: false,
                    //     confirmButtonText: "Close",
                    // }).then((result) => {
                    //     this.closeComponent();
                    // });
                    console.log(response)
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

        // Metode baru untuk menangani aksi per baris
        async triggerRowAction(rowData, rowIndex) {
            let endpoint = `${BASEURL}/api/data/import/single`;
            try {
                // Swal.fire({
                //     allowOutsideClick: false,
                //     text: 'Sedang diproses, mohon ditunggu..',
                //     didOpen: () => {
                //         Swal.showLoading();
                //     }
                // })
                
                let response = await axios.post(endpoint, rowData, {
                    headers: {
                        Authorization: "Bearer " + this.$token(),
                        "Content-Type": "multipart/form-data",
                    },
                });
                // this.loading = false
                Swal.close()
                if (response) {
                    this.verifiedExcelData[rowIndex]['existing'] = true
                    // Swal.fire({
                    //     title: "Penyimpanan Berhasil",
                    //     icon: "success",
                    //     showCancelButton: false,
                    //     allowOutsideClick: false,
                    //     confirmButtonText: "Close",
                    // }).then((result) => {
                    //     this.closeComponent();
                    // });
                    console.log(response)
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

        triggerOpenDetail(rowData, rowIndex) {
            console.log('Tombol diklik untuk baris:', rowData);
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
            let endpoint = `${BASEURL}/api/penghasilan`;
            try {
                this.loadContent = true
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'is_executing': this.is_executing,
                        'start_date': this.start_date,
                        'end_date': this.end_date
                    }
                })
                console.log(response.data)
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

/* Gaya ini hanya akan berlaku untuk komponen ini */
input[type="file"] {
    margin: auto;
    padding: 1.5em;
    /* border: 2px dashed #bbb; */
    background-color: #fff;
    transition: border-color 0.25s ease-in-out;
}

/* Styling untuk tombol file selector */
input[type="file"]::file-selector-button {
    padding: 1em 1.5em;
    border-width: 0;
    border-radius: 2em;
    background-color: hsl(210 70% 30%);
    color: hsl(210 40% 90%);
    transition: all 0.25s ease-in-out;
    cursor: pointer;
    margin-right: 1em;
}

/* Efek hover pada input secara keseluruhan */
input[type="file"]:hover {
    border-color: #888;
}

/* Efek hover pada tombol file selector saat input di-hover */
input[type="file"]:hover::file-selector-button {
    background-color: hsl(210, 74%, 47%);
}

/* Anda bisa menambahkan gaya untuk container jika diperlukan */
.file-upload-container {
    display: flex;
    /* Untuk menengahkan input jika margin: auto tidak cukup */
    justify-content: center;
    align-items: center;
    min-height: 200px;
    /* Contoh tinggi */
    border: 2px dashed #bbb;
}

.pointer {
    cursor: pointer;
}
</style>