<template>
    <div class="d-flex align-items-center">
        <div class="input-group">
            <span class="input-group-text text-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                    </path>
                </svg>
            </span>
            <input type="text" class="form-control" placeholder="Nama Nasabah / Nomor Pensiunan / Norek"
                v-model="meta.search">
        </div>

        <button class="btn btn-secondary mb-0 ms-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <div class="d-flex no-wrap align-items-center">
                Filter
                <i class="fas fa-filter p-0 m-0 ms-2" style="font-size: 10px;"></i>
            </div>
        </button>
    </div>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
        data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="row gx-5 mt-2">
                <div class="col-md">
                    <div class="d-flex flex-column">
                        <label for="datepicker"
                            class="col-sm-2 col-form-label p-0 pt-1 ms-1 font-weight-semibold text-sm">Tanggal</label>
                        <div class="col-sm-10 ms-1">
                            <div class="d-flex align-items-center mb-1">
                                <label class="form-check-label m-0 me-2">All</label>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCustomDate"
                                        v-model="model.custom_date">
                                    <label class="form-check-label mb-0" for="flexSwitchCustomDate">Custom Range</label>
                                </div>
                            </div>
                            <VueDatePicker v-if="model.custom_date" v-model="model.date" hide-input-icon
                                format="MMMM yyyy" :enable-time-picker="false" placeholder="Choose Date" month-picker
                                range id="datepicker">
                            </VueDatePicker>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="d-flex flex-column">
                        <label for="user-by" class="col-sm-2 col-form-label p-0 pt-1 font-weight-semibold text-sm">Input
                            By</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" id="user-by"
                                v-model="model.user_by">
                                <option value="All">All</option>
                                <option v-for="option in collections.users" :key="option.id" :value="option.id">
                                    {{ option.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card text-dark mb-0 border border-radius-lg border-1 p-2 border-start mt-3"
        style="border-left: 5px solid #55a6f8  !important;">
        <div class="table-responsive">
            <table class="table table-borderless table-hover align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-center text-sm font-weight-semibold">Nama Nasabah<br>Norek</th>
                        <th class="text-center text-sm font-weight-semibold">Nomor Pensiunan<br>Periode</th>
                        <th class="text-center text-sm font-weight-semibold">Tenor</th>
                        <th class="text-center text-sm font-weight-semibold">Jatuh Tempo</th>
                        <th class="text-center text-sm font-weight-semibold">Tanggal Pembayaran</th>
                        <th class="text-center text-sm font-weight-semibold">Nominal Tagihan</th>
                        <th class="text-center text-sm font-weight-semibold">Input by</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in collections.history.data" :key="item.id">
                        <td class="align-middle text-lg">
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-start ms-1">
                                    <p class="text-sm text-secondary mb-0">
                                        {{ item.angsuran_pinjaman_detail.angsuran_pinjaman.nasabah.nama_lengkap }}
                                        <br>
                                        {{ item.angsuran_pinjaman_detail.angsuran_pinjaman.norek }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-lg">
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-start ms-1">
                                    <p class="text-sm text-secondary mb-0">
                                        {{ item.nomor_pensiunan }}
                                        <br>
                                        Periode ke-{{ item.angsuran_pinjaman_detail.periode_ke }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-lg">
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-start ms-1">
                                    <p class="text-sm text-secondary mb-0">
                                        {{ item.angsuran_pinjaman_detail.angsuran_pinjaman.tenor }} Bulan
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-lg">
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-start ms-1">
                                    <p class="text-sm text-secondary mb-0">
                                        {{
                                            new
                                                Date(item.angsuran_pinjaman_detail.tanggal_jatuh_tempo).toLocaleString('en-GB',
                                                    {
                                                        day: 'numeric', month: 'long', year: 'numeric'
                                                    })
                                        }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-lg">
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-start ms-1">
                                    <p class="text-sm text-secondary mb-0">
                                        {{
                                            new Date(item.tanggal_pembayaran).toLocaleString('en-GB', {
                                                day: 'numeric', month: 'long', year: 'numeric'
                                            })
                                        }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-lg">
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-start ms-1">
                                    <p class="text-sm text-secondary mb-0">
                                        {{
                                            formatRupiah(item.nominal)
                                        }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-lg">
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-start ms-1">
                                    <p class="text-sm text-secondary mb-0">
                                        {{
                                            item.user.name
                                        }}
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="border-top py-3 px-3 d-flex align-items-center flex-wrap">
            <div class="d-flex flex-column">
                <p class="font-weight-semibold mb-0 text-dark text-sm">Halaman {{
                    meta.page.history.current_page }} dari {{ meta.page.history.last_page
                    }}
                </p>
            </div>
            <div class="ms-auto">
                <button v-for="(link, index) in collections.history.links" v-on:click="changePage(link.url)"
                    class="btn btn-sm btn-white mb-0" :disabled="link.active">
                    <span v-if="index === 0">
                        <i class="fas fa-chevron-left">
                            <span class="sr-only text-xs m-0">
                                Previous
                            </span>
                        </i>
                    </span>
                    <span v-else-if="index === collections.history.links.length - 1">
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

</template>

<script>
import { VMoney } from 'v-money'
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../../../../eventEmitter.js';
import ExcelJS from 'exceljs';
import html2canvas from 'html2canvas';
export default {
    directives: { money: VMoney },
    data() {
        return {
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'Rp. ',
                suffix: '',
                precision: 0,
                masked: false
            },
            role: '',
            collections: {
                history: [],
                users: []
            },
            meta: {
                search: '',
                page: {
                    history: {
                        current_page: 1,
                        last_page: 1
                    }
                }
            },
            loadContent: false,
            model: {
                custom_date: false,
                date: '',
                user_by: 'All'
            },
        };
    },
    async mounted() {
        await this.fetchUsers();
        await this.fetchData();
    },
    methods: {
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                currencyDisplay: 'symbol',
                maximumFractionDigits: 0
            }).format(value);
        },
        async fetchUsers() {
            let endpoint = `${BASEURL}/api/user/options`;
            try {
                // this.loadContent = true
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collections.users = response.data.data.users
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },
        async fetchData() {
            let endpoint = `${BASEURL}/api/angsuran-pembayaran`;
            try {
                // this.loadContent = true
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search,
                        'custom_date': this.model.custom_date,
                        'date': this.model.date,
                        'user_by': this.model.user_by
                    }
                });
                this.collections.history = response.data.data
                this.meta.page.history.current_page = this.collections.history.current_page
                this.meta.page.history.last_page = this.collections.history.last_page
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },
        async changePage(url) {
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
                this.collections.history = response.data.data
                this.meta.page.history.current_page = this.collections.history.current_page
                this.meta.page.history.last_page = this.collections.history.last_page
                Swal.close()
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },
    },
    watch: {
        'meta.search': function (newVal) {
            this.fetchData();
        },
        'model.custom_date': function (newVal) {
            this.fetchData();
        },
        'model.date': function (newVal) {
            this.fetchData();
        },
        'model.user_by': function (newVal) {
            this.fetchData();
        }
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
    /* left: 29px; */
    width: 2px;
    height: 100%;
    z-index: 400;
}

ul.timeline>li {
    /* margin: 20px 0; */
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

.embed-cover {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: calc(100% - 15px);
    opacity: 0;
    background-color: red;
}

.wrapper {
    position: relative;
    overflow: hidden;
}
</style>