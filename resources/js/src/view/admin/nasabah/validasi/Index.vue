<template>

    <!-- Modal Add -->
    <add-modal ref="addUser"></add-modal>

    <!-- Modal Edit -->
    <edit-modal ref="editNasabah"></edit-modal>

    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Nasabah lists</h6>
                                <p class="text-sm">Informasi Nasabah yang sudah diverifikasi</p>
                            </div>
                            <div class="ms-auto d-flex">
                                <button v-if="canCreateNasabah" @click.prevent="addUser"
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
                        <div class="px-3 pt-3">
                            <div class="filter-wrapper">
                                <div class="filter-sidebar p-2 border border-radius-lg"
                                    :class="{ 'hidden': filterisHidden }">
                                    <div class="d-flex justify-content-between gx-2 gy-2 align-items-center filter-toolbar"
                                        ref="filterToolbar">
                                        <div class="d-flex gx-3 gy-2 align-items-center w-70 overflow-x">
                                            <div class="m-0">
                                                <label class="form-label visually-hidden"
                                                    for="user-search">Search</label>
                                                <input id="user-search" type="text" class="form-control form-control-sm"
                                                    placeholder="Search name or email" v-model="meta.search" />
                                            </div>
                                            <!-- <div class="ms-2">
                                                <label class="form-label visually-hidden" for="filter-role">Role</label>
                                                <select id="filter-role"
                                                    class="form-select form-select-sm select2-filter"
                                                    v-model="meta.role" @change="fetchUnvalidatedList"
                                                    aria-label="Filter Role">
                                                    <option value="">All Role</option>
                                                    <option v-for="role in collection.roles" :key="role.id"
                                                        :value="role.name">
                                                        {{ role.name }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="ms-2">
                                                <label class="form-label visually-hidden" for="filter-unit">Unit</label>
                                                <select id="filter-unit"
                                                    class="form-select form-select-sm select2-filter"
                                                    v-model="meta.unit" @change="fetchUnvalidatedList"
                                                    aria-label="Filter Unit">
                                                    <option value="">All Unit</option>
                                                    <option v-for="unit in collection.units" :key="unit.id"
                                                        :value="unit.name">
                                                        {{ unit.name }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="ms-2">
                                                <label class="form-label visually-hidden"
                                                    for="filter-status">Status</label>
                                                <select id="filter-status"
                                                    class="form-select form-select-sm select2-filter"
                                                    v-model="meta.status" @change="fetchUnvalidatedList"
                                                    aria-label="Filter Status">
                                                    <option value="">All Status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div> -->
                                        </div>
                                        <div class=" m-0 me-0 btn border-none shadow-none color-primary text-md h-100 px-0 d-flex justify-content-between align-items-center"
                                            id="filter-toggleBtn" @click="filtertoggleSidebar">
                                            <h6 class="text-sm m-0 ms-2 fw-normal">Filter</h6>
                                            <i class="me-2"
                                                :class="filterisHidden ? 'fas fa-chevron-right' : 'fas fa-chevron-left'"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="p-3">
                            <div v-if="loadContent" class="d-flex justify-content-center p-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div v-else-if="accessDenied" class="text-center p-5">
                                <h6 class="text-danger">Anda tidak memiliki izin untuk melihat data pada halaman ini.
                                </h6>
                            </div>
                            <div v-else class="table-responsive">
                                <table class="table table-striped table-hover align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-sm font-weight-semibold opacity-7">
                                                Nama Nasabah
                                                <br>
                                                Affiliasi
                                            </th>
                                            <th class="text-sm font-weight-semibold opacity-7">Tanggal Pengajuan</th>
                                            <th class="text-sm font-weight-semibold opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in collection.users.data" :key="item.id">
                                            <td class="align-middle text-lg">
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-start ms-1">
                                                        <a class="mb-0 text-sm font-weight-semibold text-primary text-bold"
                                                            @click.prevent="editNasabah(item.id)">
                                                            {{ item.nama_lengkap }}
                                                        </a>
                                                        <p class="text-sm text-secondary mb-0">
                                                            {{ item.temp_affiliasi ? item.temp_affiliasi : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-lg">
                                                <p class="text-sm text-secondary mb-0">
                                                    {{ item.created_at ? new
                                                        Date(item.created_at).toLocaleDateString('id-ID', {
                                                            day: '2-digit',
                                                            month: 'long',
                                                            year: 'numeric'
                                                    }) : '-' }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-lg">
                                                <a class="btn btn-sm mb-0 btn-secondary"
                                                    @click="confirmValidation(item.id)">
                                                    Validate
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="border-top py-3 px-3 d-flex align-items-center flex-wrap">
                            <div class="d-flex flex-column">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">Halaman {{
                                    meta.page.userList.current_page }} dari {{ meta.page.userList.last_page
                                    }}
                                </p>
                                <p class="font-weight-semibold mb-0 text-secondary text-sm">Total: {{ meta.total }}
                                    Users
                                </p>
                            </div>
                            <div class="ms-auto">
                                <button v-for="(link, index) in collection.nasabah.links"
                                    v-on:click="changePageUserList(link.url)" class="btn btn-sm btn-white mb-0"
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
import AddUserModal from './component/Add.vue';
import EditNasabahModal from './component/Edit.vue';
import { emitter } from '../../../../../eventEmitter.js';
import $ from 'jquery';
window.$ = window.jQuery = $;
import 'select2/dist/js/select2.full.min.js';
import 'select2/dist/css/select2.min.css';
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
window.BASEURL = ''

export default {
    created() {
        emitter.on('fetchUnvalidatedList', this.fetchUnvalidatedList);


    },
    name: "UserList.Index",
    components: {
        'add-modal': AddUserModal,
        'edit-modal': EditNasabahModal,
    },
    data() {
        return {
            loadContent: true,
            filterisHidden: false,
            email_integration: false,
            meta: {
                user: '',
                page: {
                    userList: {
                        current_page: '',
                        last_page: '',
                    }
                },
                search: '',
                role: '',
                unit: '',
                status: '',
                requestStatus: '',
                total: 0,
                accesses: [],
            },
            collection: {
                affiliasi: '',
                nasabah: '',
                users: null,
            },
            dataTable: null,
            requestCounter: 0,
            searchTimer: null,
            qrcode: '',
            qrCodeImage: '',
            currentPrintDet: '',
            accessDenied: false,
        }
    },

    async mounted() {
        await this.fetchCurrentUser();

        if (this.canReadNasabah) {
            this.accessDenied = false;
            await this.fetchAffiliasi();
            await this.fetchRoleList();
            await this.fetchUnitList();
            await this.fetchUnvalidatedList();
        } else {
            this.loadContent = false;
            this.accessDenied = true;
        }
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        addUser() {
            emitter.emit('AddNasabah', this.canCreateNasabah);
        },
        editNasabah(id) {
            emitter.emit('EditNasabah', [this.canUpdateNasabah, id]);
        },
        filtertoggleSidebar() {
            this.filterisHidden = !this.filterisHidden;
        },
        async fetchAffiliasi() {
            let endpoint = `${BASEURL}/api/affiliasi/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collection.affiliasi = response.data.data;
            } catch (error) {
                console.error("Error fetching affiliasi: ", error);
            }
        },
        confirmValidation(id) {
            if (!Array.isArray(this.collection.affiliasi) || !this.collection.affiliasi.length) {
                return Swal.fire({
                    icon: 'warning',
                    title: 'Affiliasi belum tersedia',
                    text: 'Tidak ada opsi affiliasi untuk dipilih.',
                });
            }

            const optionsHtml = this.collection.affiliasi
                .map((aff) => `<option value="${aff.id}">${aff.nama ?? aff.name ?? aff.nama_affiliasi ?? aff.namaAffiliasi ?? aff.affiliasi ?? 'Affiliasi'}</option>`)
                .join('');

            Swal.fire({
                title: 'Pilih Affiliasi',
                html: `
                    <label for="swal-affiliasi" class="form-label text-start w-100 mb-2">Affiliasi</label>
                    <select id="swal-affiliasi" class="form-select">
                        <option value="">Pilih affiliasi</option>
                        ${optionsHtml}
                    </select>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Validate',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const selected = Swal.getPopup().querySelector('#swal-affiliasi');
                    const selectedValue = selected ? selected.value : null;
                    if (!selectedValue) {
                        Swal.showValidationMessage('Silakan pilih affiliasi terlebih dahulu');
                    }
                    return selectedValue;
                },
                didOpen: () => {
                    const select = Swal.getPopup().querySelector('#swal-affiliasi');
                    if (select) {
                        select.focus();
                    }
                },
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.isConfirmed) {
                    this.validation(id, result.value);
                }
            });
        },
        async fetchCurrentUser() {
            let endpoint = `${BASEURL}/api/current-user`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })

                if (response.data) {
                    this.meta.user = response.data.user || response.data;
                    console.log('User accesses:', response.data.accesses);
                    this.meta.accesses = response.data.accesses ?? [];
                }
            } catch (error) {
                console.log('User error: ', error)
            }
        },
        async preview(id) {
            let endpoint = `${BASEURL}/api/preview/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: { Authorization: 'Bearer ' + this.$token() }
                });

                const blob = new Blob([response.data], { type: 'text/html' });

                const url = URL.createObjectURL(blob);

                // Open the URL in a new tab (optional, if you want to show the preview before downloading)
                window.open(url, '_blank');

                setTimeout(() => URL.revokeObjectURL(url), 100);

            } catch (error) {
                console.error('Preview error: ', error);
            }
        },
        async preview_asuransi(id) {
            let endpoint = `${BASEURL}/api/asuransi/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: { Authorization: 'Bearer ' + this.$token() }
                });

                const blob = new Blob([response.data], { type: 'text/html' });

                const url = URL.createObjectURL(blob);

                // Open the URL in a new tab (optional, if you want to show the preview before downloading)
                window.open(url, '_blank');

                setTimeout(() => URL.revokeObjectURL(url), 100);

            } catch (error) {
                console.error('Preview error: ', error);
            }
        },

        async downloadPreview(id, name) {
            let endpoint = `${BASEURL}/api/preview-pdf/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: { Authorization: 'Bearer ' + this.$token() },
                    responseType: 'blob',
                });

                const blob = new Blob([response.data], { type: 'application/pdf' });
                const url = URL.createObjectURL(blob);
                const anchor = document.createElement('a');
                const safeName = name ? name.replace(/[^a-zA-Z0-9-_]/g, '_') : 'nasabah';
                anchor.href = url;
                anchor.download = `preview_nasabah_${safeName}_${id}.pdf`;
                document.body.appendChild(anchor);
                anchor.click();
                document.body.removeChild(anchor);
                setTimeout(() => URL.revokeObjectURL(url), 100);
            } catch (error) {
                console.error('Download preview error: ', error);
            }
        },

        async sendPengajuanEmail(nasabahId) {
            // Show a loading indicator here if you want (e.g., changing button text to "Sending...")
            console.log("Sending email for Nasabah ID: " + nasabahId);

            try {
                const response = await fetch(`/api/nasabah/${nasabahId}/send-pengajuan`, {
                    method: 'POST',
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.status) {
                    alert('Success: ' + data.message);
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An unexpected error occurred.');
            }
        },

        async fetchRoleList() {
            let endpoint = `${BASEURL}/api/role/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collection.roles = response.data.data
                console.log('Role list:', this.collection.roles);
            } catch (error) {
                console.error("Error fetching role list: ", error);
            }
        },

        async fetchUnitList() {
            let endpoint = `${BASEURL}/api/unit/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collection.units = response.data.data
                console.log('Unit list:', this.collection.units);
            } catch (error) {
                console.error("Error fetching unit list: ", error);
            }
        },

        destroySelect2() {
            const selectElements = $(this.$el).find('select.select2-filter');
            if (!selectElements.length) {
                return;
            }

            selectElements.each(function () {
                if ($(this).data('select2')) {
                    $(this).select2('destroy');
                }
            });
        },

        destroyDataTable() {
            this.destroySelect2();

            if (this.dataTable) {
                this.dataTable.destroy();
                this.dataTable = null;
            }
        },

        debounceSearchFetch() {
            if (this.searchTimer) {
                clearTimeout(this.searchTimer);
            }
            this.searchTimer = setTimeout(() => {
                this.fetchUnvalidatedList();
            }, 400);
        },

        initSelect2Filters() {
            const selectElements = $(this.$el).find('select.select2-filter');
            if (!selectElements.length || typeof $.fn.select2 !== 'function') {
                return;
            }
            selectElements.select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'All',
                allowClear: true,
                // minimumResultsForSearch: 0,
                // dropdownParent: $(this.$el),
            });
        },

        // initDataTable() {
        //     this.$nextTick(() => {
        //         if (!this.collection.users || !Array.isArray(this.collection.users.data)) {
        //             return;
        //         }

        //         this.destroyDataTable();

        //         this.dataTable = $(this.$refs.NasabahTable).DataTable({
        //             dom: 't',
        //             responsive: true,
        //             autoWidth: false,
        //             paging: false,
        //             searching: false,
        //             ordering: true,
        //             info: false,
        //             lengthChange: false,
        //             language: {
        //                 zeroRecords: "Tidak ada data yang cocok",
        //             }
        //         });

        //         this.initSelect2Filters();
        //     });
        // },

        async fetchUnvalidatedList() {
            this.destroyDataTable();
            this.loadContent = false;
            const requestId = ++this.requestCounter;
            let endpoint = `${BASEURL}/api/nasabah/unvalidated`;
            try {
                this.loadContent = true
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search,
                        // 'role': this.meta.role,
                        // 'unit': this.meta.unit,
                        // 'status': this.meta.status,
                    }
                });

                if (requestId !== this.requestCounter) {
                    return;
                }

                this.collection.users = response.data.data
                console.log(this.collection.users)
                this.meta.total = response.data.data.total
                this.meta.page.userList.current_page = this.collection.users.current_page
                this.meta.page.userList.last_page = this.collection.users.last_page
                this.loadContent = false
                // this.initDataTable();
            } catch (error) {
                console.error("Error fetching document list: ", error);
                if (requestId === this.requestCounter) {
                    this.loadContent = false
                }
            }
        },
        async validation(id, affiliasiId) {
            let endpoint = `${BASEURL}/api/nasabah/validation/${id}/${affiliasiId}`;
            try {
                let response = await axios.post(endpoint, {}, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: response.data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                this.fetchUnvalidatedList();
            } catch (error) {
                console.log(error.response?.data?.message || error.message);
                this.$swal.fire('Failed!', error.response?.data?.message || 'Terjadi kesalahan', 'error');
            }
        },
        async resetPassword(id) {
            let endpoint = `${BASEURL}/api/reset-password/${id}`;
            try {
                let response = await axios.post(endpoint, {}, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                });
                Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: response.data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            } catch (error) {
                console.log(error.response.data.message);
                this.$swal.fire('Failed!', error.response.data.message, 'error');
            }
        },

        async changePageUserList(url) {
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
                this.collection.users = response.data.data
                this.meta.page.userList.current_page = this.collection.users.current_page
                this.meta.page.userList.last_page = this.collection.users.last_page
                Swal.close()
                // this.initDataTable();
            } catch (error) {
                console.error("Error fetching document list: ", error);
            }
        },


        getSubmoduleAccessByUrl(url) {
            console.log('Checking access for URL:', this.meta.accesses);
            if (!Array.isArray(this.meta.accesses)) {
                return null;
            }

            for (const module of this.meta.accesses) {
                if (!Array.isArray(module.submodules)) {
                    continue;
                }

                const subModule = module.submodules.find(sub => sub.url === url);
                if (subModule) {
                    return subModule;
                }
            }

            return null;
        },

        canPerformAction(action) {
            console.log('Checking access for action:', action, this.userSubmoduleAccess?.actions?.includes(action) ?? false);
            return this.userSubmoduleAccess?.actions?.includes(action) ?? false;
        },
    },
    beforeUnmount() {
        if (this.searchTimer) {
            clearTimeout(this.searchTimer);
            this.searchTimer = null;
        }
        this.destroyDataTable();
    },
    computed: {
        userSubmoduleAccess() {
            return this.getSubmoduleAccessByUrl('/nasabah/lists');
        },

        canCreateNasabah() {
            return this.canPerformAction('create');
        },

        canReadNasabah() {
            return this.canPerformAction('read');
        },

        canUpdateNasabah() {
            return this.canPerformAction('update');
        },

        canDeleteNasabah() {
            return this.canPerformAction('delete');
        },
    },

    watch: {
        'meta.search': 'debounceSearchFetch',
        'meta.role': 'fetchUnvalidatedList',
        'meta.unit': 'fetchUnvalidatedList',
        'meta.status': 'fetchUnvalidatedList',
        'meta.requestStatus': function (newVal, oldVal) {
            this.fetchUnvalidatedList();
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

.overflow-x {
    -ms-overflow-style: none;
    scrollbar-width: none;
    overflow-x: scroll;
}

.filter-toolbar input.form-control-sm,
.filter-toolbar select.form-select-sm {
    min-width: 120px;
    width: 100%;
}

.filter-wrapper {
    display: flex;
    overflow: hidden;
}

.filter-sidebar {
    width: 100%;
    transition: margin 0.8s ease-in-out;
}

.filter-sidebar.hidden {
    margin-left: -90%;
    transition: margin 1s ease-in-out;
}

#filter-toggleBtn {
    width: 100px;
}

#horz-list ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
    text-align: center;
}

#horz-list ul li {
    display: inline;
}

#horz-list ul li {
    text-decoration: none;
    margin: 10px;
    width: 60px;
    /* border-right: 1px solid rgba(170, 54, 216, 0.8); */
    /* margin: 0 0 0 -6px; */
}

/* #horz-list ul li a:hover {
  background: rgba(255, 255, 255, 0.8);
  color: #1a1a1a;
} */
</style>