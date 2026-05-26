<template>
    <!-- offcanvas Add New Document -->
    <div class="offcanvas offcanvas-end responsive-offcanvas p-6" tabindex="-1" id="offcanvasBatchRight"
        data-bs-keyboard="false" aria-labelledby="offcanvasBatchRightLabel">

        <div class="offcanvas-header">
            <h5 id="offcanvasBatchRightLabel">Tambah Batch Baru</h5>
            <button type="button" class="btn-close btn-close-white" @click.prevent="closeComponent" aria-label="Close">
            </button>
        </div>
        <div class="offcanvas-body p-6 mx-3 border rounded-3 overflowy-hidden-style">

            <!-- table of nasabah list with pagination, search, and checkbox. on click td will add nasabah to batch. on click checkbox will add nasabah to batch. on click button submit will save batch to database. on click button cancel will close offcanvas and reset form. -->
            <div class="table-responsive p-0 mb-2">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center text-sm font-weight-semibold">Nomor Memo</th>
                            <th class="text-center text-sm font-weight-semibold">Judul</th>
                            <th class="text-center text-sm font-weight-semibold">Unit</th>
                            <th class="text-center text-sm font-weight-semibold">Category</th>
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
                                        <h6 class="mb-0 text-sm font-weight-semibold">{{ item.nama_lengkap }}</h6>
                                        <!-- <p class="text-sm text-secondary mb-0">{{ item }}</p> -->
                                    </div>
                                </div>
                            </td>
                            <!-- <td class="text-sm font-weight-semibold"
                                style="vertical-align: middle; word-wrap: break-word; min-width: 160px; max-width: 160px; white-space:normal;">
                                {{ item }}
                            </td>
                            <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
                                {{ item }}
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-check form-switch mb-8">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" v-model="meta.selected">
                <label class="form-check-label" for="flexSwitchCheckDefault">Show Selected</label>
            </div>


        </div>
        <div class="offcanvas-footer d-flex justify-content-end p-3">
            <button class="btn btn-warning me-3" @click.prevent="closeComponent">Cancel</button>
            <button class="btn btn-primary" @click.prevent="confirmStore">Submit</button>
        </div>
    </div>
</template>

<script>
import { VMoney } from 'v-money'
import $, { data } from "jquery";
import Swal from "sweetalert2";
import QRCode from "qrcode";
import { emitter } from '../../../../../../eventEmitter.js';
import html2pdf from "html2pdf.js";
import ExcelJS from 'exceljs';
import html2canvas from 'html2canvas';
export default {
    directives: { money: VMoney },
    name: "AddBatchOffcanvas",
    data() {
        return {
            modalAddBatch: "",
            loading: false,
            componentload: false,
            collections: {
                nasabah: [],
            },
            model: {
                details: [],
            },
            meta: {
                category: '',
                search: '',
                selected: false
            },
            selectedDetails: [],
            arraydet: [],
        };
    },

    mounted() {
        emitter.on("AddBatch", async (authorized) => {
            if (authorized) {
                this.modalAddBatch = new bootstrap.Offcanvas("#offcanvasBatchRight", {
                    backdrop: false,
                    keyboard: false,
                });
                await this.openModal();

                this.componentload = true;
                await this.fetchAvailableBatch();
                this.componentload = false;
            }

        });
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`;
        },
        toggleCheckbox(itemId) {
            if (this.model.details.includes(itemId)) {
                this.model.details = this.model.details.filter(id => id !== itemId);
            } else {
                this.model.details.push(itemId);
            }

            this.arraydet = (this.collections.nasabah.filter(item => this.model.details.includes(item.id)))
        },
        async fetchAvailableBatch() {
            try {
                let response = await axios.get(`${BASEURL}/api/nasabah/available/batches`, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                this.collections.nasabah = response.data.data.data;
                this.model.batch = response.data.batch;
                console.log('Available batches: ', this.collections.nasabah);
            } catch (error) {
                console.error("Error fetching available batches: ", error);
                Swal.fire(
                    'Error!',
                    'There was an error fetching available batches.',
                    'error'
                )
            }
        },
        confirmStore() {
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
                    this.store()
                }
            })
        },
        async store() {
            this.loading = true
            let endpoint = `${BASEURL}/api/nasabah/store/batches`;
            try {
                let response = await axios.post(endpoint, this.model, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    },
                });
                console.log('Store response:', response);
                Swal.fire(
                    'Saved!',
                    'Batch has been saved.',
                    'success'
                )
                emitter.emit("batchStored")
                this.closeComponent()
            } catch (error) {
                console.error("Error storing batch: ", error);
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
            this.modalAddBatch.show();
        },
        closeComponent() {
            this.modalAddBatch.hide()
            this.resetForm()
            emitter.emit("fetchDraftedList")
        },
        resetForm() {
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
    computed: {
        filteredItems() {
            let filtered = this.collections.nasabah;
            if (this.meta.category !== '') {
                filtered = filtered.filter(item => item.category.id.toString() == this.meta.category);
            }

            if (this.meta.search !== '') {
                filtered = filtered.filter(item =>
                    item.label.toLowerCase().includes(this.meta.search.toLowerCase()) ||
                    item.number.toLowerCase().includes(this.meta.search.toLowerCase()) ||
                    item.unit.name.toLowerCase().includes(this.meta.search.toLowerCase())
                );
            }
            return filtered;
        }
    },
    watch: {
        'meta.selected': function (newVal) {
            if (newVal) {
                this.selectedDetails = this.collections.nasabah.filter(item => this.model.details.includes(item.id));
            } else {
                this.selectedDetails = [];
            }
        },
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


/* Hide scrollbar for Chrome, Safari and Opera */
.overflowy-hidden-style::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.overflowy-hidden-style {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}


.entry-content h3 {
    margin: 0;
}

.entry-content {
    counter-reset: li;
    padding: 1rem;
}

.entry-content>ol>li {
    position: relative;
}

.entry-content>ol>li::before {
    /* background: green; */
    opacity: 0.95;
    content: "";
    position: absolute;
    top: 0;
    left: -15px;
    width: 10px;
    height: 100%;
}

.entry-content>ol {
    list-style: decimal;
    padding: 0 0 0 2rem;
    margin: 0;
}

.entry-content>ol>ol {
    margin: 0 0 0 1em;
}

.entry-content>ol>li {
    position: relative;
    display: block;
    padding: 0.5rem 0.5rem 1rem;
    margin: 0;
    color: #000;
    text-decoration: none;
    border-radius: 1em;
    transition: all 0.2s ease-in-out;
    line-height: 1.4em;
}

.entry-content>ol>li:hover {
    text-decoration: none;
}

.entry-content>ol>li:before {
    content: counter(li);
    counter-increment: li;
    position: absolute;
    z-index: 1;
    left: -3rem;
    top: 50%;
    transform: translateY(-50%);
    background: #774dd3;
    width: 2em;
    height: 2em;
    display: grid;
    place-content: center;
    line-height: 1;
    border: 2px solid #774dd3;
    text-align: center;
    font-weight: bold;
    border-radius: 100%;
    color: #ffffff;
}

/* When kosong */
.entry-content>ol>li.kosong:before {
    background: rgb(234, 78, 61);
    border-color: rgb(234, 78, 61);
}

/* When partial */
.entry-content>ol>li.partial:before {
    background: rgb(241, 153, 55);
    border-color: rgb(241, 153, 55);
}

/* When lengkap */
.entry-content>ol>li.lengkap:before {
    background: rgb(85, 166, 248);
    border-color: rgb(85, 166, 248);
}

.entry-content>ol>li:after {
    content: "";
    position: absolute;
    top: 0;
    bottom: -5px;
    left: -2rem;
    width: 0.1rem;
    background: #774dd3;
    z-index: 0;
}

.entry-content>ol>li:first-child:after {
    top: 50%;
}

.entry-content>ol>li:last-child:after {
    top: 0;
    bottom: 50%;
}
</style>