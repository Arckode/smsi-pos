<template>
    <!-- modal current qrcode -->
    <div class="modal fade" id="viewCurrentEditedQrCode" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button @click.prevent="printCurrentQRCode" class="btn btn-primary m-0 font-weight-normal"><i
                            class="fa-solid fa-print"></i> Print</button> -->
                    <button class="btn btn-primary m-0 font-weight-normal" @click.prevent="generatePDFEditDoc"> <i
                            class="fad fa-print"></i> Print QR Code</button>
                    <button type="button" class="btn-close btn-close-white m-0" @click.prevent="closeComponent"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5" id="printCurrentEdittedQrCode">
                    <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="currentedittedQrSvg"></svg>
                    <h3 class="m-0 font-weight-normal">{{ currentQrcode }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Download QR PDF -->
    <div v-if="this.model.details != ''" style="display: none;">
        <div id="pdfContentEditDoc" class="m-4">
            <div style="display: flex; flex-direction: row; width: 100%;">
                <div class="p-4"
                    style="border-top: 1px solid black; border-left: 1px solid black; border-bottom: 1px solid black; border-right: none; width: 100%;">
                    <p style="font-size: 20px; font-weight: 600; margin-bottom: 0; color: black;">EDOC-TRACKING</p>
                    <table style="width:100%;">
                        <tr>
                            <td style="width: 100px;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">QR Code
                                </p>
                            </td>
                            <td>
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">: {{
                                    this.model.number }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">No Memo
                                </p>
                            </td>
                            <td>
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">: {{
                                    this.model.label }}
                                </p>
                            </td>
                        </tr>
                    </table>
                    <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black; margin-top: 12px;">
                        Dokumen terlampir sebanyak : {{ this.model.details.length }} Dokumen
                    </p>
                    <ul class="list-doc" style="columns: 2;">
                        <li v-for="idet in this.model.details" :key="index">
                            <p style="font-size: 12px; font-weight: 500; margin-bottom: 0; color: black;">{{ idet.label
                                }}</p>
                        </li>
                    </ul>
                </div>
                <img :src="qrCodeEditDocImage" alt="QR Code" id="qrCodeImagePdfEditDoc"
                    style="width: 250px; height: 250px; border: 1px solid black;" />
            </div>
        </div>
    </div>

    <!-- Modal for file preview -->
    <div class="modal fade" id="exampleeditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ preview.label }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-if="preview.isImage">
                        <img :src="preview.filePreview" alt="Preview" class="img-fluid" />
                    </div>
                    <embed v-if="preview.isPdf" :src="preview.filePreview + '#toolbar=0&navpanes=0&scrollbar=0'"
                        frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- offcanvas Edit New Document -->
    <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasEditRight"
        data-bs-keyboard="false" aria-labelledby="offcanvasEditRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEditRightLabel">Edit Dokumen</h5>
            <button type="button" class="btn-close btn-close-white" @click.prevent="closeComponent"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form>
                <div class="accordion" id="accordionDocumentLabels">
                    <div class="accordion-item mb-3">
                        <h5 class="accordion-header" id="headingOne">
                            <button class="accordion-button border-bottom font-weight-bold collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne">
                                <div class="m-0 flex-grow-1">
                                    <h6 class="m-0">Label Dokumen</h6>
                                    <p class="m-0 text-sm">Informasi mengenai dokumen</p>
                                </div>
                                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                            </button>
                        </h5>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionDocumentLabels">
                            <div class="accordion-body text-sm">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control bg-transparent" id="floatingLabel"
                                        placeholder="Judul Document" v-model="model.label" :disabled="disabled">
                                    <label for="floatingLabel">Nomor Memo<span class="text-danger"> *</span></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control bg-transparent" placeholder="Leave a comment here"
                                        id="floatingDescription" style="height: 100px" v-model="model.description"
                                        :disabled="disabled"></textarea>
                                    <label for="floatingDescription">Judul<span class="text-danger"> *</span></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select form-select-lg" id="editfloatingCategory"
                                        aria-label="Floating label select example" v-model="model.category_id">
                                        <option disabled value="">Pilih Kategori Dokumen</option>
                                        <option v-for="(row, index) in collections.categories" :key="index"
                                            :value="row.code"> {{
                                                row.name }}</option>
                                    </select>
                                    <label for="editfloatingCategory">Kategori<span class="text-danger">
                                            *</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionDocumentDetails">
                    <div class="accordion-item mb-3">
                        <h5 class="accordion-header" id="headingOne1">
                            <button
                                class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1"
                                aria-expanded="false" aria-controls="collapseOne1">
                                <div class="m-0 flex-grow-1">
                                    <h6 class="m-0">Detail</h6>
                                    <p class="m-0 text-sm">Edit detail dokumen</p>
                                </div>
                                <h6 class="text-sm mb-0 me-4" :class="{ 'text-danger': model.details.length == 0 }">
                                    {{ model.details.length }} Detail</h6>
                                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                            </button>
                        </h5>
                        <div id="collapseOne1" class="accordion-collapse collapse" aria-labelledby="headingOne1"
                            data-bs-parent="#accordionDocumentDetails">
                            <div class="accordion-body text-sm">
                                <div class="table-responsive w-100">
                                    <table class="table table-hover table-bordered mt-3 mb-0">
                                        <thead>
                                            <tr>
                                                <th>Label<span class="text-danger"> *</span></th>
                                                <th>Deskripsi</th>
                                                <th>Nominal</th>
                                                <th>File</th>
                                                <th v-if="role != 1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(detail, index) in model.details" :key="index"
                                                class="align-items-center">
                                                <td>
                                                    <!-- <input type="text"
                                                        class="form-control shadow-none border border-0 bg-transparent"
                                                        v-model="detail.label" placeholder="Label" :disabled="disabled"> -->
                                                    <div class="tag-input">
                                                        <div class="d-flex flex-wrap gap-1">
                                                            <div v-for="(tag, tagIndex) in detail.labels" :key="tag"
                                                                class="m-0 btn btn-primary d-flex justify-content-between ps-2 pe-2 gap-3 text-xs">
                                                                {{ tag }}
                                                                <a @click.prevent="removeTag(detail, tagIndex)">
                                                                    <i class="fas fa-minus text-warning">
                                                                        <span class="sr-only text-sm">
                                                                            -
                                                                        </span>
                                                                    </i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <input type="text" placeholder="Masukkan label"
                                                            class="form-control shadow-none border border-0 bg-transparent"
                                                            @keydown.enter="addTag(detail, $event)"
                                                            @keydown.188="addTag(detail, $event)"
                                                            @keydown.delete="removeLastTag(detail, $event)"
                                                            @input="onInput(detail, $event)"
                                                            @focus="detail.isActive = true" @blur="handleBlur(detail)"
                                                            v-model="detail.currentInput" />
                                                        <ul class="position-absolute bg-white px-2 py-3 me-sm-n4 shadow-lg"
                                                            v-if="detail.isActive && suggestions.length > 0">
                                                            <li class="dropdown-item mb-2 bg-white"
                                                                v-for="(suggestion) in suggestions" :key="suggestion"
                                                                @click.prevent="addSuggestion(detail, suggestion)">
                                                                <a class="dropdown-item border-radius-md">
                                                                    <div class="d-flex px-3 py-1">
                                                                        <p
                                                                            class="text-xs text-secondary mb-0 d-flex align-items-center ">
                                                                            {{ suggestion }}
                                                                        </p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea
                                                        class="form-control shadow-none border border-0 bg-transparent"
                                                        v-model="detail.description" rows="1" placeholder="Description"
                                                        :disabled="disabled"></textarea>
                                                </td>
                                                <td>
                                                    <input
                                                        class="form-control shadow-none border border-0 bg-transparent"
                                                        placeholder="Nominal" v-model.lazy="detail.nominals"
                                                        v-money="money" :disabled="disabled" />

                                                </td>
                                                <td>
                                                    <div style="display: flex; height: 100%;">

                                                        <input v-if="detail.change == true" type="file"
                                                            class="form-control rounded-0 rounded-start"
                                                            accept=".jpg, .jpeg, .png, .pdf"
                                                            @change="handleFileUpload(index)" :disabled="disabled">
                                                        <span v-else class="form-control rounded-0 rounded-start"
                                                            @click.prevent="showFilePreview(index)"> See File
                                                        </span>
                                                        <a v-if="detail.change == false && role != 1"
                                                            class="input-group-text text-danger rounded-0"
                                                            @click.prevent="!disabled ? changeFile(index) : ''"
                                                            id="exampleModal" :disabled="disabled">
                                                            <i class="fas fa-redo">
                                                                <span class="sr-only text-sm">
                                                                    Change File
                                                                </span>
                                                            </i>
                                                        </a>
                                                        <a class="input-group-text rounded-0 rounded-end"
                                                            @click.prevent="showFilePreview(index)" id="exampleModal">
                                                            <i class="fas fa-search">
                                                                <span class="sr-only text-sm">
                                                                    Preview
                                                                </span>
                                                            </i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td v-if="role != 1"
                                                    style="text-align: center; vertical-align: middle;">
                                                    <a @click.prevent="!disabled ? removeCard(index) : ''">
                                                        <i class="fas fa-times-square" style="font-size: 18px;">
                                                            <span class="sr-only text-sm">
                                                                Remove
                                                            </span>
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a v-if="role != 1"
                                    class="btn btn-outline-info hstack gap-3 w-100 rounded-0 rounded-bottom"
                                    @click.prevent="addNewCard">
                                    <i class="fad fa-plus"></i>
                                    <p class="mb-0 text-sm">Tambah Detail</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="position-absolute end-0 bottom-0 me-3">
                    <button v-if="!loading" type="button" class="btn btn-secondary rounded-1 me-3"
                        @click.prevent="closeComponent">Cancel</button>
                    <button v-if="!loading" type="button" class="btn btn-warning rounded-1"
                        @click.prevent="confirmUpdate">Update</button>
                    <button v-else class="btn btn-primary" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { VMoney } from 'v-money'
import $ from "jquery";
import Swal from 'sweetalert2';
import QRCode from 'qrcode';
import { emitter } from '../../../../../../../eventEmitter.js';
import html2pdf from 'html2pdf.js';
export default {
    directives: { money: VMoney },
    data() {
        return {
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'Rp. ',
                suffix: '',
                precision: 2,
                masked: false
            },
            role: '',
            disabled: false,
            collections: {
                categories: []
            },
            suggestions: ['PPH23', 'Pajak', 'BPP'],
            model: {
                number: '',
                label: '',
                labels: [],
                category_id: '',
                description: '',
                status_id: '',
                details: [],
            },
            currentQrcode: '',
            preview: '',
            modalPreview: '',
            offcanvasEdit: '',
            qrCodeEditDocImage: '',
            modalQrEdit: '',
            loading: false,
        };
    },
    mounted() {
        emitter.on('editDocument', ([id, role]) => {
            this.role = role
            if (this.role == 1) {
                this.disabled = true
            }
            this.fetchDocument(id);
            this.fetchCategories();
            this.modalPreview = new bootstrap.Modal('#exampleeditModal', {
                backdrop: false,
                keyboard: false,
            })
            this.offcanvasEdit = new bootstrap.Offcanvas('#offcanvasEditRight', {
                backdrop: false,
                keyboard: false,
            })
            this.modalQrEdit = new bootstrap.Modal('#viewCurrentEditedQrCode', {
                backdrop: false,
                keyboard: false,
            })
        });
        $('.editfloatingCategory').on('change', (event) => {
            this.model.category_id = event.target.value;
        });
    },
    methods: {
        async fetchDocument(id) {
            let endpoint = `${BASEURL}/api/edocs/${id}`
            if (this.role == 1) {
                endpoint = `${BASEURL}/api/secretary/edocs/${id}`
            }
            try {
                Swal.showLoading();
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.model = response.data.data
                this.model.category_id = this.model.category
                this.model.status_id = this.model.statuses[0].status_id

                this.model.details.forEach((detail, index) => {
                    if (detail.file.includes('.pdf')) {
                        this.model.details[index].filePreview = detail.file
                        this.model.details[index].isImage = false;
                        this.model.details[index].isPdf = true;
                        this.model.details[index].change = false
                    } else {
                        this.model.details[index].filePreview = detail.file
                        this.model.details[index].isImage = true;
                        this.model.details[index].isPdf = false;
                        this.model.details[index].change = false
                    }
                    this.model.details[index].nominals = this.model.details[index].nominal.toFixed(2).replace('.', ',')
                    this.model.details[index].labels = this.model.details[index].label.split(',').map(e => e.trim());
                });
                Swal.close()
                this.offcanvasEdit.show()
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
                return false
            }
        },
        async fetchCategories() {
            let endpoint = `${BASEURL}/api/edoc/category/options`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                this.collections.categories = response.data.data.options
                $('#editfloatingCategory').val(this.model.category_id).trigger('change');
            } catch (error) {
                console.log(error)
                Swal.fire({
                    title: error.response.statusText,
                    text: error.response.data.message,
                    icon: 'error'
                })
            }
        },
        async confirmUpdate() {
            if (this.model.label == '') {
                Swal.fire('Kesalahan', 'Nomor Memo document harus diisi.', 'error')
                return false
            }

            if (this.model.category_id == '') {
                Swal.fire('Kesalahan', 'Category document harus diisi.', 'error')
                return false
            }

            if (this.model.description == '') {
                Swal.fire('Kesalahan', 'Judul document harus diisi.', 'error')
                return false
            }

            if (this.model.details.length == 0) {
                Swal.fire('Kesalahan', 'Document harus memiliki detail.', 'error')
                return false
            }

            this.model.details.forEach(detail => {
                detail.nominal = this.convertNominal(detail.nominals)
            });

            if (this.model.category_id == 3) {
                this.nofile = !this.model.details.some(detail => detail.file)
                if (this.nofile) {
                    Swal.fire("Kesalahan", "Dokumen dengan category Urgent harus memiliki file. Silahkan Upload file terlebih dahulu", "error");
                    return false;
                }
            }

            this.model.details.forEach((detail) => {
                detail.label = detail.labels.join(', ');
            });
            let hasEmptyDetailsLabel = this.model.details.some(detail => detail.label.trim() === '');
            if (hasEmptyDetailsLabel) {
                Swal.fire('Kesalahan', 'Label detail document harus diisi.', 'error')
                return false
            }

            this.model.details.forEach(detail => {
                if (typeof detail.file === 'string') {
                    if (detail.file.includes('images/no_content.jpg')) {
                        detail.file = null;
                    }
                }
            })

            Swal.fire({
                title: 'Simpan?',
                text: "Pastikan data yang anda simpan sudah benar",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Simpan'
            }).then((result) => {
                if (result.value) {
                    this.update()
                }
            })
        },
        async update() {
            this.loading = true
            let endpoint = `${BASEURL}/api/edocs/${this.model.id}?_method=PUT`
            if (this.role == 1) {
                endpoint = `${BASEURL}/api/secretary/edocs/${this.model.id}?_method=PUT`
            }
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
                        Authorization: 'Bearer ' + this.$token(),
                        'Content-Type': 'multipart/form-data',
                    }
                })
                Swal.close()
                if (response) {
                    this.loading = false
                    Swal.fire({
                        title: 'Perubahan Berhasil Disimpan. Print?',
                        text: "Apakah anda ingin print qrcode sekarang?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Print'
                    }).then((result) => {
                        if (result.value) {
                            this.viewCurrentQRCode(this.model.number)
                        } else {
                            this.closeComponent()
                        }
                    })
                }
            } catch (error) {
                this.loading = false
                console.error("Error store docs: ", error);
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
                })
            }
        },
        convertNominal(nominal) {
            let cleanedValue = nominal
                .replace(/Rp\.?\s?/g, '')
                .replace(/\./g, '')
                .replace(/,/g, '.')
                .trim()
            return parseFloat(cleanedValue) || 0;
        },
        addNewCard() {
            this.model.details.push({
                labels: [],
                description: null,
                nominal: 0,
                checked: true,
                file: null,
                isImage: false,
                isPdf: false,
                filePreview: null,
                change: true
            });
        },
        removeCard(index) {
            this.model.details.splice(index, 1)
        },
        onInput(detail, event) {
            detail.currentInput = event.target.value;

            detail.suggestions = this.suggestions.filter(suggestion =>
                suggestion.toLowerCase().includes(detail.currentInput.toLowerCase())
            );
        },
        handleBlur(detail) {
            setTimeout(() => {
                let val = detail.currentInput.trim();
                if (val.length > 0 && !detail.labels.includes(val)) {
                    detail.labels.push(val);
                    detail.currentInput = '';
                }

                detail.isActive = false;
            }, 100);
        },
        addTag(detail, event) {
            event.preventDefault()
            let val = detail.currentInput.trim()
            if (val.length > 0 && !detail.labels.includes(val)) {
                detail.labels.push(val)
                detail.currentInput = ''
                // detail.suggestions = []
            }
        },
        addSuggestion(detail, suggestion) {
            if (!detail.labels.includes(suggestion)) {
                detail.labels.push(suggestion)
                detail.currentInput = ''
                // detail.suggestions = []
            }
        },
        removeTag(detail, index) {
            detail.labels.splice(index, 1);
        },
        removeLastTag(detail, event) {
            if (event.target.value.length === 0) {
                this.removeTag(detail, detail.labels.length - 1);
            }
        },
        changeFile(index) {
            Swal.fire({
                title: 'Ganti?',
                text: "Apakah anda ingin mengganti file yang telah terupload?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ganti'
            }).then((result) => {
                if (result.value) {
                    this.model.details[index].change = true
                }
            })
        },
        handleFileUpload(index) {
            const file = event.target.files[0];
            this.model.details[index].file = file;
            if (file.type.includes('image')) {
                this.model.details[index].filePreview = URL.createObjectURL(file)
                this.model.details[index].isImage = true
                this.model.details[index].isPdf = false
            }
            else if (file.type === 'application/pdf') {
                this.model.details[index].filePreview = URL.createObjectURL(file)
                this.model.details[index].isImage = false
                this.model.details[index].isPdf = true
            }
        },
        showFilePreview(index) {
            if (this.model.details[index].file) {
                this.preview = this.model.details[index]
                // if (this.preview.isPdf) {
                //     window.open(this.preview.filePreview, '_blank');
                // } else {
                this.modalPreview.show()
                // }
            }
        },
        viewCurrentQRCode(qrcode) {
            var opts = {
                errorCorrectionLevel: "H",
                type: "image/jpeg",
                width: 500,
                rendererOpts: {
                    quality: 0.5,
                },
            };

            this.currentQrcode = qrcode;

            // generate qrcode
            QRCode.toDataURL(qrcode, opts, (err, url) => {
                if (err) throw err;
                this.qrCodeEditDocImage = url;
                var svgimg = document.createElementNS("http://www.w3.org/2000/svg", "image");
                svgimg.setAttribute("width", "94");
                svgimg.setAttribute("height", "94");
                svgimg.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", url);
                document.getElementById("currentedittedQrSvg").appendChild(svgimg);
                $("#qr-download").attr("href", url);
            });

            this.modalQrEdit.show()
        },
        generatePDFEditDoc() {
            Swal.fire({
                timer: 2000,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })
            const element = document.getElementById('pdfContentEditDoc');
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
        closeComponent() {
            this.resetForm()
            emitter.emit('fetchDocumentList')
            this.modalQrEdit.hide()
            this.modalPreview.hide()
            this.offcanvasEdit.hide()

        },
        resetForm() {
            this.model.details = []
            this.model.number = ''
            this.model.label = ''
            this.model.category_id = ''
            this.model.description = ''
        }
    },
    watch: {
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

.list-doc li,
.list-doc li p {
    white-space: normal;
    float: left;
    width: 100%;
    height: auto;
    word-wrap: break-word;
}
</style>