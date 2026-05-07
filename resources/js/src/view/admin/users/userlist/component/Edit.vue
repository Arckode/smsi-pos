<template>
    <!-- offcanvas Add New Document -->
    <div class="modal shadow-lg" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <template v-if="!componentload">
                        <div class="mb-3">
                            <label for="exampleFormControlNama" class="form-label mb-0">Nama</label>
                            <input type="text" class="form-control" id="exampleFormControlNama" placeholder="Nama"
                                v-model="model.name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com" v-model="model.email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlIRole" class="form-label mb-0">Role</label>
                            <select id="filter-role" class="form-select form-select-sm select2-filter"
                                v-model="model.role_id" aria-label="Filter Role">
                                <option v-for="role in collections.roles" :key="role.id" :value="role.id">
                                    {{ role.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlIUnit" class="form-label mb-0">Unit</label>
                            <select id="filter-unit" class="form-select form-select-sm select2-filter"
                                v-model="model.unit_id" aria-label="Filter Unit">
                                <option v-for="unit in collections.units" :key="unit.id" :value="unit.id">
                                    {{ unit.name }}
                                </option>
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
import { VMoney } from 'v-money'
import $ from "jquery";
import Swal from "sweetalert2";
import QRCode from "qrcode";
import { emitter } from '../../../../../../eventEmitter.js';
import html2pdf from "html2pdf.js";
import ExcelJS from 'exceljs';
import html2canvas from 'html2canvas';
export default {
    directives: { money: VMoney },
    name: "EditUserOffcanvas",
    data() {
        return {
            modalEdit: "",
            loading: false,
            componentload: false,
            userid: null,
            collections: {
                roles: [],
                units: [],
            },
            model: {
                name: "",
                email: "",
                password: "",
                role_id: null,
                unit_id: null,
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
                this.userid = id;
                await this.openModal();

                this.componentload = true;
                await this.fetchRoles();
                await this.fetchUnits();
                await this.fetchUser(this.userid);
                this.componentload = false;
            }

        });
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`;
        },
        async fetchUser(id) {
            let endpoint = `${BASEURL}/api/users/${id}`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.model = response.data.data
                console.log('User data:', this.model);
            } catch (error) {
                console.error("Error fetching user data: ", error);
            }
        },
        async fetchRoles() {
            let endpoint = `${BASEURL}/api/role/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collections.roles = response.data.data
                console.log('Role list:', this.collections.roles);
            } catch (error) {
                console.error("Error fetching role list: ", error);
            }
        },

        async fetchUnits() {
            let endpoint = `${BASEURL}/api/unit/options`;
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collections.units = response.data.data
                console.log('Unit list:', this.collections.units);
            } catch (error) {
                console.error("Error fetching unit list: ", error);
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
                    this.update()
                }
            })
        },
        async update() {
            this.loading = true
            
            let endpoint = `${BASEURL}/api/users/${this.userid}`;
            try {
                let response = await axios.put(endpoint, this.model, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                console.log('Update response:', response);
                Swal.fire(
                    'Saved!',
                    'User has been saved.',
                    'success'
                )
                this.closeComponent()
            } catch (error) {
                console.error("Error updating user: ", error);
                Swal.fire(
                    'Error!',
                    'There was an error saving the user.',
                    'error'
                )
            } finally {
                this.loading = false
            }
        },
        async openModal() {
            this.modalEdit.show();
        },
        closeComponent() {
            this.modalEdit.hide()
            this.resetForm()
            emitter.emit("fetchUserList")
        },
        resetForm() {
            this.model.name = ""
            this.model.email = ""
            this.model.password = ""
            this.model.role_id = null
            this.model.unit_id = null
        },
        initSelect2Filters() {
            const selectElements = $(this.$el).find('select.select2-filter');
            if (!selectElements.length || typeof $.fn.select2 !== 'function') {
                return;
            }
            selectElements.select2({
                theme: 'bootstrap-5',
                width: '100%',
                // placeholder: 'All',
                allowClear: true,
                // minimumResultsForSearch: 0,
                // dropdownParent: $(this.$el),
            });
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
    },
    computed: {},
    watch: {

    },
};
</script>