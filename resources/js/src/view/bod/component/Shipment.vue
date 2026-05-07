<template>
    <!-- offcanvas Add New Document Shipping -->
    <div class="offcanvas offcanvas-bottom h-100" tabindex="-1" id="offcanvasBottom"
        aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <div class="card-body d-flex justify-content-between m-0" style="align-items: center;">
                <p class="text-black m-0 ms-3">Pengiriman Document</p>
                <a @click="closeComponent" style="border: 10x solid black;">
                    <i class="fas fa-chevron-down me-3">
                        <span class="sr-only text-sm">
                            X
                        </span>
                    </i>
                </a>
            </div>
        </div>
        <div class="offcanvas-body">
            <form>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="label" id="floatingLabel" v-model="model.label"
                        disabled>
                    <label for="floatingLabel">Label <span class="text-danger"> *</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Nomor resi" id="floatingResi"
                        v-model="model.resi">
                    <label for="floatingResi">Nomor Resi</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingDescription"
                        style="height: 100px" v-model="model.description"></textarea>
                    <label for="floatingDescription">Description</label>
                </div>
                <hr>
                <div class="mb-3 d-flex flex-column">
                    <label class="form-label">Document Lists <span class="text-danger"> *</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text text-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </span>
                        <input type="text" class="form-control" v-model="meta.search" placeholder="Search">
                    </div>
                    <div class="table-responsive p-0 mb-2">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center text-sm font-weight-semibold">Label</th>
                                    <th class="text-center text-sm font-weight-semibold">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in meta.selected ? selectedDetails : filteredItems" :key="item.id"
                                    @click="toggleCheckbox(item.id)">
                                    <td class="text-center text-sm font-weight-semibold">
                                        <input type="checkbox" v-model="model.details" :value="item.id">
                                    </td>
                                    <td class="text-sm font-weight-semibold">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-start ms-1">
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ item.label }}</h6>
                                                <p class="text-sm text-secondary mb-0">{{ item.number }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm font-weight-semibold"
                                        style="vertical-align: middle; word-wrap: break-word; min-width: 160px; max-width: 160px; white-space:normal;">
                                        {{ item.description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-check form-switch mb-8">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                            v-model="meta.selected">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Show Selected</label>
                    </div>
                </div>
                <div class="position-absolute end-0 bottom-0 w-100 glass-morph">
                    <div class="d-flex justify-content-end m-3">
                        <h6 class="text-sm me-3">{{ model.details.length }} Document terpilih <span class="text-danger">
                                *</span></h6>
                        <button type="button" class="btn btn-primary rounded-1 m-0"
                            @click.prevent="confirmStore">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../eventEmitter.js';
export default {
    name: 'AddDocumentOffcanvas',
    data() {
        return {
            modalAdd: '',
            modalPreview: '',
            meta: {
                category: '',
                search: '',
                selected: false
            },
            collections: {
                categories: [],
                items: []
            },
            model: {
                resi: '',
                label: '',
                description: '',
                details: [],
                status_id: '',
            },
            currentQrcode: '',
            selectedDetails: [],
        }
    },

    mounted() {
        emitter.on('DocumentShipment', async () => {
            this.modalAdd = new bootstrap.Offcanvas('#offcanvasBottom', {
                backdrop: false,
                keyboard: false,
            })
            await this.openAddOffCanvas()
            this.model.status_id = 5
            await this.fetchAvailDocumentList()
        });

        emitter.on('sendSelectedDocs', async (ids) => {
            this.modalAdd = new bootstrap.Offcanvas('#offcanvasBottom', {
                backdrop: false,
                keyboard: false,
            })
            this.model.status_id = 5
            await this.fetchAvailDocumentList()
            await this.selectedDocs(ids)
            await this.openAddOffCanvas()
        });
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async openAddOffCanvas() {
            this.model.label = `BOD/${new Date().toLocaleDateString()}-${Math.floor(100 + Math.random() * 900)}`
            this.modalAdd.show()
        },
        closeComponent() {
            this.modalAdd.hide()
            this.resetForm()
            emitter.emit('Rescan');
        },
        async selectedDocs(ids) {
            ids.forEach(id => {
                this.model.details.push(id);
            })
        },
        async fetchAvailDocumentList() {
            let endpoint = `${BASEURL}/api/public/edocs/received-by-bod/list`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.collections.items = response.data.data.edocs
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        toggleCheckbox(itemId) {
            if (this.model.details.includes(itemId)) {
                this.model.details = this.model.details.filter(id => id !== itemId);
            } else {
                this.model.details.push(itemId);
            }
        },
        async confirmStore() {
            if (this.model.label == '') {
                Swal.fire('Kesalahan', 'Label document harus diisi.', 'error')
                return false
            }

            if (this.model.details.length == 0) {
                Swal.fire('Kesalahan', 'List document harus ada yang dipilih', 'error')
                return false
            }

            Swal.fire({
                title: 'Simpan?',
                text: "Pastikan data yang anda isi sudah benar",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Simpan'
            }).then((result) => {
                if (result.value) {
                    this.store()
                }
            })
        },
        async store() {
            let endpoint = `${BASEURL}/api/public/batches`
            try {
                Swal.fire({
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                let response = await axios.post(endpoint, this.model, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
                Swal.close()
                if (response) {
                    emitter.emit('ResetList');
                    Swal.fire({
                        title: 'Penyimpanan Berhasil',
                        text: "Terimakasih sudah menggunakan sistem kami",
                        icon: 'success',
                    }).then((result) => {
                        if (result.value) {
                            this.closeComponent()
                        }
                    })
                }
            } catch (error) {
                console.error("Error batch shipment on BOD: ", error);
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
            this.model.resi = '';
            this.model.label = '';
            this.model.description = '';
            this.model.details = [];

            this.meta.category = '';
            this.meta.search = '';
            this.meta.selected = false;

            this.collections.categories = [];
            this.collections.items = [];

            this.currentQrcode = '';
            this.selectedDetails = [];
        }
    },
    computed: {
        filteredItems() {
            let filtered = this.collections.items;
            if (this.meta.category !== '') {
                filtered = filtered.filter(item => item.category.id.toString() == this.meta.category);
            }

            if (this.meta.search !== '') {
                filtered = filtered.filter(item =>
                    item.label.toLowerCase().includes(this.meta.search.toLowerCase()) ||
                    item.number.toLowerCase().includes(this.meta.search.toLowerCase())
                );
            }
            return filtered;
        }
    },
    watch: {
        'meta.selected': function (newVal) {
            if (newVal) {
                this.selectedDetails = this.collections.items.filter(item => this.model.details.includes(item.id));
            } else {
                this.selectedDetails = [];
            }
        },
    },
}
</script>
<style scoped>
.glass-morph {
    background: rgba(255, 255, 255, 0);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5.8px);
    -webkit-backdrop-filter: blur(5.8px);
}
</style>