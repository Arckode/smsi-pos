<template>
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header sticky-top border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Users Access Management</h6>
                                <!-- <p class="text-sm">Informasi tentang semua Nasabah</p> -->
                            </div>
                        </div>
                        <div class="pb-3 px-3 d-sm-flex align-items-center">
                            <div class="input-group w-sm-50 ms-auto">
                                <span class="input-group-text text-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                        </path>
                                    </svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Nama User"
                                    aria-label="Nama/Email User" v-model="meta.search">
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="table-responsive p-0">
                            <div v-if="loadContent" class="d-flex justify-content-center p-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div v-else-if="accessDenied" class="text-center p-5">
                                <h6 class="text-danger">Anda tidak memiliki izin untuk melihat data pada halaman ini.
                                </h6>
                            </div>
                            <h6 v-else-if="collection.user && collection.user.length == 0"
                                class="align-middle text-center text-lg pt-3 text-muted">Tidak ada data
                            </h6>

                            <div v-else class="p-3 d-flex flex-wrap gap-3">
                                <div class="card border shadow-xs w-100" v-for="item in filteredUsers"
                                    :key="item.user.id">
                                    <span v-if="hasUserChanges(item)"
                                        class="position-absolute top-0 start-100 translate-middle p-2 bg-warning border border-light rounded-circle">
                                        <span class="visually-hidden">Edited User Access</span>
                                    </span>
                                    <!-- <span class="position-absolute top-0 start-100 translate-middle p-2 badge bg-primary">Primary</span> -->
                                    <div class="card-body">
                                        <h6 class="card-title text-md">{{ item.user.name }}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted text-sm">{{ item.user.email }}</h6>
                                        <div class="accordion accordion-flush" :id="`accordionFlush-${item.user.id}`">
                                            <template v-if="item.modules && item.modules.length">
                                                <div class="accordion-item card border shadow-xs m-3"
                                                    v-for="(module, moduleIndex) in item.modules"
                                                    :key="`module-${item.user.id}-${module.module_id || moduleIndex}`">
                                                    <h2 class="accordion-header"
                                                        :id="`flush-heading-${item.user.id}-${moduleIndex}`">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            :data-bs-target="`#flush-collapse-${item.user.id}-${moduleIndex}`"
                                                            aria-expanded="false"
                                                            :aria-controls="`flush-collapse-${item.user.id}-${moduleIndex}`">
                                                            {{ module.name || module.module_name || `Module
                                                            ${moduleIndex + 1}` }}
                                                        </button>
                                                    </h2>
                                                    <div :id="`flush-collapse-${item.user.id}-${moduleIndex}`"
                                                        class="accordion-collapse collapse"
                                                        :aria-labelledby="`flush-heading-${item.user.id}-${moduleIndex}`"
                                                        :data-bs-parent="`#accordionFlush-${item.user.id}`">
                                                        <div class="accordion-body mx-1 mb-1 pt-0">
                                                            <div v-if="module.submodules && module.submodules.length">
                                                                <div class="accordion accordion-flush"
                                                                    :id="`submoduleAccordion-${item.user.id}-${module.module_id || moduleIndex}`">
                                                                    <div class="accordion-item card border shadow-xs mb-2"
                                                                        v-for="(sub, subIndex) in module.submodules"
                                                                        :key="`sub-${item.user.id}-${module.module_id || moduleIndex}-${sub.sub_module_id || subIndex}`">
                                                                        <h2 class="accordion-header"
                                                                            :id="`subflush-heading-${item.user.id}-${moduleIndex}-${subIndex}`">
                                                                            <button class="accordion-button collapsed"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                :data-bs-target="`#subflush-collapse-${item.user.id}-${moduleIndex}-${subIndex}`"
                                                                                aria-expanded="false"
                                                                                :aria-controls="`subflush-collapse-${item.user.id}-${moduleIndex}-${subIndex}`">
                                                                                {{ sub.sub_module_name || sub.name ||
                                                                                    sub.title || `Submodule ${subIndex + 1}`
                                                                                }}
                                                                            </button>
                                                                        </h2>
                                                                        <div :id="`subflush-collapse-${item.user.id}-${moduleIndex}-${subIndex}`"
                                                                            class="accordion-collapse collapse"
                                                                            :aria-labelledby="`subflush-heading-${item.user.id}-${moduleIndex}-${subIndex}`"
                                                                            :data-bs-parent="`#submoduleAccordion-${item.user.id}-${module.module_id || moduleIndex}`">
                                                                            <div class="accordion-body pt-0">
                                                                                <hr style="color: black;">
                                                                                <div class="row gy-2">
                                                                                    <div class="col-auto"
                                                                                        v-for="action in ['create', 'read', 'update', 'delete']"
                                                                                        :key="action">
                                                                                        <div class="form-check">
                                                                                            <input
                                                                                                class="form-check-input"
                                                                                                type="checkbox"
                                                                                                :id="`checkbox-${item.user.id}-${moduleIndex}-${subIndex}-${action}`"
                                                                                                :checked="Boolean(sub.actions?.[action])"
                                                                                                :disabled="editDenied"
                                                                                                @change="toggleSubmoduleAction(item, module, sub, action, $event.target.checked)" />
                                                                                            <label
                                                                                                class="form-check-label"
                                                                                                :for="`checkbox-${item.user.id}-${moduleIndex}-${subIndex}-${action}`">
                                                                                                {{
                                                                                                    action.charAt(0).toUpperCase()
                                                                                                    + action.slice(1) }}
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p v-else class="text-sm mb-0 text-dark fst-italic">
                                                                No submodules.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <div v-else class="text-sm text-muted">
                                                No access modules available.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="card-footer sticky-bottom d-flex justify-content-end gap-2 bg-white border-top shadow-lg">
                        <a class="btn p-3 mb-0" @click.prevent="confirmStore"
                            :class="model.data.length === 0 ? `btn-secondary` : `btn-info`">Save Changes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { emitter } from '../../../../../eventEmitter.js';
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
window.BASEURL = ''

export default {
    name: "UserAccess.Index",
    data() {
        return {
            loadContent: true,
            meta: {
                user: '',
                search: '',
                accesses: [],
            },
            collection: {
                user: '',
            },
            model: {
                data: [],
            },
            accessDenied: false,
            editDenied: false,
        }
    },

    async mounted() {
        await this.fetchCurrentUser();

        if (this.canReadAccess) {
            await this.fetchUserAccess();
        } else {
            this.loadContent = false;
            this.accessDenied = true;
        }

        if (this.canUpdateAccess) {
            this.editDenied = false;
        } else {
            this.loadContent = false;
            this.editDenied = true;
        }
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
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
                    this.meta.accesses = response.data.accesses ?? [];
                }
            } catch (error) {
                console.log('User error: ', error)
                swal.fire('Error', 'Gagal mengambil data user saat ini. Silahkan refresh halaman / hubungi IT', 'error');
            }
        },
        async fetchUserAccess() {
            let endpoint = `${BASEURL}/api/users/access`;
            try {
                this.loadContent = true
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                });
                this.collection.user = (response.data.data || []).map(item => ({
                    ...item,
                    is_edited: false,
                    originalModules: JSON.parse(JSON.stringify(item.modules || [])),
                }));
                this.loadContent = false
            } catch (error) {
                this.loadContent = false
                console.error("Error fetching document list: ", error);
                swal.fire('Error', 'Gagal mengambil data akses user. Silahkan refresh halaman / hubungi IT', 'error');
            }
        },

        getSubmoduleAccessByUrl(url) {
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
            return this.useraccessSubmoduleAccess?.actions?.includes(action) ?? false;
        },

        hasUserChanges(item) {
            if (!item.originalModules || !Array.isArray(item.modules)) {
                return false;
            }

            return item.modules.some((module, moduleIndex) => {
                const originalModule = item.originalModules[moduleIndex];
                if (!originalModule || !Array.isArray(module.submodules) || !Array.isArray(originalModule.submodules)) {
                    return true;
                }

                return module.submodules.some((sub, subIndex) => {
                    const originalSub = originalModule.submodules[subIndex];
                    if (!originalSub) {
                        return true;
                    }

                    const currentActions = sub.actions || {};
                    const originalActions = originalSub.actions || {};
                    return ['create', 'read', 'update', 'delete'].some(action =>
                        Boolean(currentActions[action]) !== Boolean(originalActions[action])
                    );
                });
            });
        },

        toggleSubmoduleAction(item, module, sub, action, value) {
            if (!sub.actions) {
                sub.actions = {};
            }
            sub.actions[action] = value;
            item.is_edited = this.hasUserChanges(item);

            const existingIndex = this.model.data.findIndex(u => u.user.id === item.user.id);
            if (item.is_edited) {
                const payload = {
                    user: item.user,
                    modules: item.modules.map(m => ({
                        module_id: m.module_id,
                        name: m.name,
                        submodules: m.submodules.map(s => ({
                            sub_module_id: s.sub_module_id,
                            sub_module_name: s.sub_module_name,
                            url: s.url,
                            actions: { ...s.actions }
                        }))
                    }))
                };

                if (existingIndex >= 0) {
                    this.model.data.splice(existingIndex, 1, payload);
                } else {
                    this.model.data.push(payload);
                }
            } else if (existingIndex >= 0) {
                this.model.data.splice(existingIndex, 1);
            }
        },

        async storeAccessChanges() {
            this.loading = true
            let endpoint = `${BASEURL}/api/change/users-access`;
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    text: 'Sedang diproses, mohon ditunggu..',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.post(`${endpoint}`, this.model, {
                    headers: {
                        Authorization: "Bearer " + this.$token(),
                        "Content-Type": "multipart/form-data",
                    },
                });
                if (response) {
                    this.loading = false
                    Swal.close()
                    Swal.fire('Sukses', 'Data akses user berhasil diubah.', 'success');
                    this.fetchCurrentUser();
                    this.fetchUserAccess();
                    emitter.emit('userAccessUpdated');
                }
            } catch (error) {
                this.loading = false
                console.error("Error store access changes: ", error);
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

        confirmStore() {
            if (!this.model.data.length) {
                Swal.fire('Tidak ada perubahan', 'Belum ada data akses user yang diubah.', 'info');
                return;
            }

            Swal.fire({
                title: 'Simpan Perubahan?',
                text: "Apakah Anda yakin ingin menyimpan perubahan akses user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.storeAccessChanges();
                }
            });
        },
    },
    computed: {
        useraccessSubmoduleAccess() {
            return this.getSubmoduleAccessByUrl('/users/access');
        },

        filteredUsers() {
            const search = (this.meta.search || '').toString().trim().toLowerCase();
            if (!search || !Array.isArray(this.collection.user)) {
                return this.collection.user || [];
            }

            return this.collection.user.filter(item => {
                const name = (item.user?.name || '').toString().toLowerCase();
                const email = (item.user?.email || '').toString().toLowerCase();
                return name.includes(search) || email.includes(search);
            });
        },

        canCreateAccess() {
            return this.canPerformAction('create');
        },

        canReadAccess() {
            return this.canPerformAction('read');
        },

        canUpdateAccess() {
            return this.canPerformAction('update');
        },

        canDeleteAccess() {
            return this.canPerformAction('delete');
        },
    },

    watch: {
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