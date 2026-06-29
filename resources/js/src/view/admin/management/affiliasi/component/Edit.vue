<template>
    <!-- offcanvas Edit Affiliasi -->
    <div class="modal shadow-lg" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <template v-if="!componentload">
                        <div class="mb-3">
                            <label for="inputNamaAffiliasi" class="form-label mb-0">Nama Affiliasi</label>
                            <input type="text" class="form-control" id="inputNamaAffiliasi" placeholder="Nama Affiliasi"
                                v-model="model.nama_affiliasi">
                        </div>
                        <div class="mb-3">
                            <label for="inputKota" class="form-label mb-0">Kota</label>
                            <input type="text" class="form-control" id="inputKota" placeholder="Kota"
                                v-model="model.kota">
                        </div>
                        <div class="mb-3">
                            <label for="inputTelepon" class="form-label mb-0">No. Telepon</label>
                            <input type="text" class="form-control" id="inputTelepon" placeholder="No. Telepon"
                                v-model="model.no_telepon">
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label mb-0">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                                v-model="model.email">
                        </div>
                        <div class="mb-3">
                            <label for="inputPIC" class="form-label mb-0">PIC</label>
                            <input type="text" class="form-control" id="inputPIC" placeholder="PIC"
                                v-model="model.pic_name">
                        </div>
                        <div class="mb-5">
                            <label for="selectStatus" class="form-label mb-0">Status</label>
                            <select id="selectStatus" class="form-select form-select-sm"
                                v-model.number="model.status">
                                <option :value="1">Active</option>
                                <option :value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end mb-0 pb-0">
                            <template v-if="!loading">
                                <button type="button" class="btn btn-warning mb-0" data-bs-dismiss="modal"
                                    @click.prevent="closeComponent">Close</button>
                                <button type="button" class="btn btn-info ms-3 mb-0"
                                    @click.prevent="confirmUpdate">Update</button>
                            </template>
                            <template v-else>
                                <button class="btn btn-info ms-3 mb-0" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </template>
                        </div>
                    </template>
                    <template v-else>
                        <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from "jquery";
import Swal from "sweetalert2";
import { emitter } from '../../../../../../eventEmitter.js';
export default {
    name: "EditAffiliasiModal",
    data() {
        return {
            modalEdit: null,
            loading: false,
            componentload: false,
            affiliasiId: null,
            model: {
                nama_affiliasi: "",
                kota: "",
                no_telepon: "",
                email: "",
                pic_name: "",
                status: 1,
            },
        };
    },

    mounted() {
        emitter.on("EditUser", async ([authorized, id]) => {
            console.log('EditUser event received with authorized:', authorized, 'and id:', id);
            if (authorized) {
                this.modalEdit = new bootstrap.Modal("#modalEdit", {
                    backdrop: 'static',
                    keyboard: false,
                });
                this.affiliasiId = id;
                this.componentload = true;
                await this.fetchAffiliasi(id);
                this.componentload = false;
                await this.openModal();
            }
        });
    },
    methods: {
        async fetchAffiliasi(id) {
            let endpoint = `${BASEURL}/api/affiliasi/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                const data = response.data.data ?? response.data;
                this.model = {
                    nama_affiliasi: data.nama_affiliasi || "",
                    kota: data.kota || "",
                    no_telepon: data.no_telepon || "",
                    email: data.email || "",
                    pic_name: data.pic_name || "",
                    status: Number(data.status) === 1 ? 1 : 0,
                };
                console.log('Affiliasi data:', this.model);
            } catch (error) {
                console.error("Error fetching affiliasi data: ", error);
                Swal.fire('Error', 'Gagal memuat data affiliasi.', 'error');
            }
        },
        confirmUpdate() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.update();
                }
            });
        },
        async update() {
            this.loading = true;
            let endpoint = `${BASEURL}/api/affiliasi/${this.affiliasiId}`;
            try {
                let response = await axios.put(endpoint, this.model, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                console.log('Update response:', response);
                Swal.fire('Saved!', 'Affiliasi has been saved.', 'success');
                this.closeComponent();
            } catch (error) {
                console.error("Error updating affiliasi: ", error);
                Swal.fire('Error!', 'There was an error saving the affiliasi.', 'error');
            } finally {
                this.loading = false;
            }
        },
        async openModal() {
            this.modalEdit.show();
        },
        closeComponent() {
            this.modalEdit.hide();
            this.resetForm();
            emitter.emit("fetchUserList");
        },
        resetForm() {
            this.affiliasiId = null;
            this.model = {
                nama_affiliasi: "",
                kota: "",
                no_telepon: "",
                email: "",
                pic_name: "",
                status: 1,
            };
        },
    },
};
</script>