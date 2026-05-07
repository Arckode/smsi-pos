<template>
    <!-- Modal -->
    <div class="modal fade" id="modalUnit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <template v-for="unit in collection.units">
                        <input type="radio" class="btn-check" :name="'btnradiotable' + unit.id"
                            :id="'btnradiotable' + unit.id" v-model="meta.unit" :value="unit.id">
                        <label :for="'btnradiotable' + unit.id" class="btn btn-white px-3 mb-0">{{
                            unit.name }}</label>
                    </template> -->
                    <div class="list-group">
                        <a v-for="unit in collection.units" :key="unit.id"
                            class="list-group-item list-group-item-action" aria-current="true"
                            @click="choosenUnit(unit.id)">
                            {{ unit.name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-7 pb-6 bg-cover"
        style="background-image: url('/cud/img/header-orange-purple.jpg'); background-position: bottom;"></div>

    <div class="container my-3 py-3">
        <div v-if="meta.dev" class="warning-content" style="width:100%;height:500px;text-align:center;margin:0;">
            <h1>New Fiture Under Development</h1>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" width="100.001px" height="70px" viewBox="0 0 100 68">
                <g id="large">
                    <g>
                        <path
                            d="M55.777,38.473l6.221-1.133c0.017-1.791-0.123-3.573-0.41-5.324l-6.321-0.19c-0.438-2.053-1.135-4.048-2.076-5.931
            l4.82-4.094c-0.868-1.552-1.874-3.028-3.005-4.417l-5.569,2.999c-1.385-1.54-2.98-2.921-4.771-4.099l2.124-5.954
            c-0.759-0.452-1.543-0.878-2.357-1.269c-0.811-0.39-1.625-0.732-2.449-1.046l-3.325,5.381c-2.038-0.665-4.113-1.052-6.183-1.174
            L31.34,6.002c-1.792-0.02-3.571,0.119-5.32,0.406l-0.191,6.32c-2.056,0.439-4.051,1.137-5.936,2.08l-4.097-4.82
            c-1.546,0.872-3.022,1.875-4.407,3.006l2.996,5.566c-1.54,1.384-2.925,2.985-4.104,4.778c-2.16-0.771-4.196-1.498-5.953-2.127
            c-0.449,0.765-0.875,1.544-1.265,2.354c-0.39,0.811-0.733,1.63-1.049,2.457c1.587,0.981,3.424,2.119,5.377,3.325
            c-0.662,2.037-1.049,4.117-1.172,6.186l-6.218,1.136c-0.021,1.789,0.12,3.566,0.407,5.321l6.32,0.188
            c0.442,2.06,1.143,4.057,2.082,5.937l-4.818,4.095c0.872,1.549,1.873,3.026,3.009,4.412l5.563-2.998
            c1.392,1.54,2.989,2.92,4.777,4.099l-2.121,5.954c0.756,0.446,1.538,0.871,2.348,1.258c0.813,0.394,1.633,0.739,2.462,1.05
            l3.326-5.375c2.033,0.662,4.109,1.05,6.175,1.17l1.137,6.221c1.791,0.019,3.569-0.123,5.323-0.407l0.194-6.324
            c2.053-0.438,4.045-1.136,5.927-2.079l4.093,4.817c1.55-0.865,3.026-1.87,4.414-2.999l-2.995-5.572
            c1.537-1.385,2.914-2.98,4.093-4.772l5.953,2.127c0.448-0.761,0.878-1.545,1.268-2.356c0.388-0.808,0.729-1.631,1.047-2.458
            l-5.378-3.324C55.268,42.615,55.655,40.542,55.777,38.473z M42.302,42.435c-3.002,6.243-10.495,8.872-16.737,5.866
            c-6.244-2.999-8.872-10.493-5.867-16.736c3.002-6.244,10.495-8.873,16.736-5.869C42.676,28.698,45.306,36.19,42.302,42.435z"
                            fill="none" stroke="#E43" />
                        <animateTransform attributeName="transform" begin="0s" dur="3s" type="rotate" from="0 31 37"
                            to="360 31 37" repeatCount="indefinite" </animateTransform>
                    </g>
                    <g id="small">
                        <path d="M93.068,19.253L99,16.31c-0.371-1.651-0.934-3.257-1.679-4.776l-6.472,1.404c-0.902-1.436-2.051-2.735-3.42-3.819
            l2.115-6.273c-0.706-0.448-1.443-0.867-2.213-1.238c-0.774-0.371-1.559-0.685-2.351-0.958l-3.584,5.567
            c-1.701-0.39-3.432-0.479-5.118-0.284L73.335,0c-1.652,0.367-3.256,0.931-4.776,1.672l1.404,6.47
            c-1.439,0.899-2.744,2.047-3.835,3.419c-2.208-0.746-4.38-1.476-6.273-2.114c-0.451,0.71-0.874,1.448-1.244,2.229
            c-0.371,0.764-0.68,1.541-0.954,2.329c1.681,1.078,3.612,2.323,5.569,3.579c-0.399,1.711-0.486,3.449-0.291,5.145
            c-2.086,1.034-4.143,2.055-5.936,2.945c0.368,1.648,0.929,3.25,1.67,4.769c1.954-0.426,4.193-0.912,6.468-1.405
            c0.906,1.449,2.06,2.758,3.442,3.853l-2.117,6.27c0.708,0.449,1.439,0.865,2.218,1.236c0.767,0.371,1.551,0.685,2.338,0.96
            c1.081-1.68,2.319-3.612,3.583-5.574c1.714,0.401,3.457,0.484,5.156,0.288L82.695,42c1.651-0.371,3.252-0.931,4.773-1.676
            c-0.425-1.952-0.912-4.194-1.404-6.473c1.439-0.902,2.744-2.057,3.835-3.436l6.273,2.11c0.444-0.7,0.856-1.43,1.225-2.197
            c0.372-0.777,0.691-1.569,0.963-2.361l-5.568-3.586C93.181,22.677,93.269,20.939,93.068,19.253z M84.365,24.062
            c-1.693,3.513-5.908,4.991-9.418,3.302c-3.513-1.689-4.99-5.906-3.301-9.419c1.688-3.513,5.906-4.991,9.417-3.302
            C84.573,16.331,86.05,20.549,84.365,24.062z" fill="none" stroke="#E43" />
                        <animateTransform attributeName="transform" begin="0s" dur="2s" type="rotate" from="0 78 21"
                            to="-360 78 21" repeatCount="indefinite" </animateTransform>
                    </g>
                </g>
            </svg>
            <p>
                Please forgive the inconvenience. <br />
                We are currently initializing our brand new feature.
            </p>
            <p>
                It's okay, we're excited too!
            </p>

        </div>
        <div v-else class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">User Lists</h6>
                            <p class="text-sm">List Pengguna Aplikasi Edoc Tracking</p>
                        </div>
                        <div class="ms-auto d-flex">
                            <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="btn-inner--icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor" class="d-block me-2">
                                        <path
                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                    </svg>
                                </span>
                                <span class="btn-inner--text" type="button">Add User</span>
                            </button>
                            <ul class="dropdown-menu p-4 shadow-lg" aria-labelledby="dropdownMenuButton1"
                                style="max-width: 200px;">
                                <p class="m-0 text-dark">
                                    Pilih Unit
                                </p>
                                <p class="text-xs text-muted">
                                    Untuk melihat list user dari unit yang dipilih
                                </p>
                                <hr>
                                <li v-for="unit in collection.units" :key="unit.id"><a class="dropdown-item"
                                        @click="choosenUnit(unit.id, unit.name)">{{ unit.name }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                        <div class="btn-group flex-wrap" role="group">
                            <template v-for="unit in collection.unit">
                                <input type="radio" class="btn-check" :name="'btnradiotable' + unit.id"
                                    :id="'btnradiotable' + unit.id" v-model="meta.unit" :value="unit.id">
                                <label :for="'btnradiotable' + unit.id" class="btn btn-white px-3 mb-0">{{
                                    unit.name }}</label>
                            </template>
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
                        <table v-else class="table align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Member</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Function
                                    </th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in collection.users.data" :key="user.id">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex align-items-center">
                                                <img :src="user.picture ? asset(`${user.picture}`) : asset('/profile_pictures/default.jpg')"
                                                    class="avatar avatar-sm rounded-circle me-2" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ user.name }}</h6>
                                                <p class="text-sm text-secondary mb-0">{{ user.email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm text-dark font-weight-semibold mb-0">{{ user.unit.name }}
                                        </p>
                                        <p class="text-sm text-secondary mb-0">{{ user.role == 1 ? 'Admin' : 'User' }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <div class="dropdown">
                                            <a role="button" class="text-info"
                                                :class="{ 'text-danger': user.is_active == 0, 'text-info': user.is_active == 1 }"
                                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ user.is_active == 1 ? 'Active' : 'Inactive' }}
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-end border border-info"
                                                aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item text-primary"
                                                        @click.prevent="activate(user.id, user.name)">Active</a></li>
                                                <li><a class="dropdown-item text-danger"
                                                        @click.prevent="deactivate(user.id, user.name)">Deactivate</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top py-3 px-3 d-flex align-items-center">
                        <p class="font-weight-semibold mb-0 text-dark text-sm">Halaman {{
                            meta.page.userlist.current_page }} dari {{ meta.page.userlist.last_page
                            }}</p>
                        <div class="ms-auto">
                            <button v-for="(link, index) in collection.users.links"
                                v-on:click="changePageUserList(link.url)" class="btn btn-sm btn-white mb-0"
                                :disabled="link.active">
                                <span v-if="index === 0"><i class="fas fa-chevron-left"></i></span>
                                <span v-else-if="index === collection.users.links.length - 1"><i
                                        class="fas fa-chevron-right"></i></span>
                                <span v-else>{{ link.label }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-xs text-muted text-lg-start">
                            Copyright
                            ©
                            2024
                            MMS IT Team.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- offcanvas Add New Document -->
    <browse-user-offcanvas ref="browseUser"></browse-user-offcanvas>
</template>

<script>
import BrowseUserOffcanvas from './component/Add.vue';
import { emitter } from '../../../../eventEmitter.js';
import Swal from 'sweetalert2';
window.BASEURL = ''

export default {
    name: "Admin.Index",
    components: {
        'browse-user-offcanvas': BrowseUserOffcanvas,
    },
    data() {
        return {
            loadContent: true,
            meta: {
                dev: false,
                search: '',
                unit: '',
                page: {
                    userlist: {
                        current_page: '',
                        last_page: '',
                    }
                },
            },
            collection: {
                users: '',
                unit: '',
                units: '',
            },
        }
    },
    async mounted() {
        await this.fetchUserLists();
        await this.fetchUnits();

        emitter.on("fetchUserLists", async () => {
            await this.fetchUserLists();
        });
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async fetchUserLists() {
            let endpoint = `${BASEURL}/api/secretary/users`
            try {
                this.loadContent = true
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                    params: {
                        'search': this.meta.search,
                        'unit': this.meta.unit
                    }
                });
                this.collection.users = response.data.data
                this.meta.page.userlist.current_page = this.collection.users.current_page
                this.meta.page.userlist.last_page = this.collection.users.last_page
                this.loadContent = false
            } catch (error) {
                console.error("Error fetching user list: ", error);
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
        async fetchUnits() {
            let endpoint = `${BASEURL}/api/secretary/unit/options`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                });

                let fetchedUnit = response.data.data.options;
                this.collection.units = response.data.data.options;
                this.collection.unit = [
                    { code: '', name: 'All' },
                    ...fetchedUnit.map(unit => ({
                        id: unit.id,
                        name: unit.name.toLowerCase().replace(/_/g, ' ').replace(/^\w/, c => c.toUpperCase())
                    }))
                ];
            } catch (error) {
                console.error("Error fetching unit list: ", error);
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
        async deactivate(id, name) {
            Swal.fire({
                title: "Apakah anda akan menonaktifkan akun " + name + " ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f19937",
                confirmButtonText: "Yes!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let endpoint = `${BASEURL}/api/secretary/users/${id}`;

                    try {
                        let response = await axios.delete(endpoint, {
                            headers: {
                                Authorization: 'Bearer ' + this.$token()
                            }
                        });
                        Swal.fire({
                            title: "Success!",
                            text: "User has been deactivated.",
                            icon: "success"
                        });
                        this.fetchUserLists();
                    } catch (error) {
                        console.log(error.response.data.message);
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

                }
            });
        },
        async activate(id, name) {
            Swal.fire({
                title: "Apakah anda akan mengaktifkan akun " + name + " ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f19937",
                confirmButtonText: "Yes!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let endpoint = `${BASEURL}/api/secretary/users/activate/${id}`;

                    try {
                        let response = await axios.put(endpoint, {}, {
                            headers: {
                                Authorization: 'Bearer ' + this.$token()
                            }
                        });
                        Swal.fire({
                            title: "Success!",
                            text: "User has been activated.",
                            icon: "success"
                        });
                        this.fetchUserLists();
                    } catch (error) {
                        console.log(error.response.data.message);
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

                }
            });
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
                this.meta.page.userlist.current_page = this.collection.users.current_page
                this.meta.page.userlist.last_page = this.collection.users.last_page
                Swal.close()
            } catch (error) {
                console.error("Error fetching user list: ", error);
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
        choosenUnit(id, unit) {
            emitter.emit('browseUser', [id, unit]);
        }
    },
    watch: {
        'meta.search': 'fetchUserLists',
        'meta.unit': function (newVal, oldVal) {
            this.fetchUserLists();
        },
        // 'meta.search': function (newVal, oldVal) {
        //     this.fetchUserLists();
        // }
    }
}
</script>

<style scoped>
@media (max-width: 767px) {
    .table-responsive .dropdown-menu {
        position: static !important;
    }
}

@media (min-width: 768px) {
    .table-responsive {
        overflow: inherit;
    }
}
</style>