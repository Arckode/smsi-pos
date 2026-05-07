<template>
    <!-- modal current qrcode -->
    <div class="modal fade" id="viewCurrentDetQrCode" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5" id="printCurrentEdittedQrCode">
                    <h3 class="m-0 font-weight-normal">{{ currentQrcode }}</h3>
                    <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="currentdetQrSvg"></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for file preview -->
    <div class="modal fade" id="exampledetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-keyboard="false" @contextmenu.prevent>
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ preview.label }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p v-if="preview.isPdf" class="mb-1 me-2 text-danger text-end text-sm fw-800" style="opacity: 0.8;">
                        *gunakan scrollbar
                    </p>
                    <div v-if="preview.isImage">
                        <img :src="preview.filePreview" alt="Preview" class="img-fluid" />
                    </div>
                    <div class="wrapper" v-if="preview.isPdf" style="height: 100%;">
                        <embed :src="preview.filePreview + '#toolbar=0&navpanes=0&scrollbar=0'" height="100%"
                            width="100%" />
                        <div class="embed-cover"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        @click.prevent="downloadFile(preview.filePreview, preview.id)">Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- offcanvas detail Document -->
    <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasDetailRight"
        data-bs-keyboard="false" aria-labelledby="offcanvasDetailRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasDetailRightLabel">Detail Dokumen</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
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
                                <div class="d-flex flex-row mb-3" style="align-items: center;">
                                    <div class="form-floating w-100">
                                        <input type="text" class="form-control bg-transparent" id="floatingNumber"
                                            placeholder="name@example.com" v-model="model.number" disabled>
                                        <label for="floatingNumber">QR Code</label>
                                    </div>
                                    <a @click.prevent="viewCurrentQRCode(model.number)" data-bs-toggle="modal"
                                        data-bs-target="#viewCurrentDetQrCode" data-bs-title="QrCode"
                                        class="text-primary fs-4 ms-3">
                                        <i class="fas fa-qrcode">
                                            <span class="sr-only text-sm">
                                                QR Code
                                            </span>
                                        </i>
                                    </a>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control bg-transparent" id="floatingLabel"
                                        placeholder="Judul Document" v-model="model.label" disabled>
                                    <label for="floatingLabel">Nomor Memo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control bg-transparent" placeholder="Leave a comment here"
                                        id="adddoclistfloatingDescription" style="height: 100px"
                                        v-model="model.description" disabled></textarea>
                                    <label for="adddoclistfloatingDescription">Judul</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select form-select-lg bg-transparent" id="floatingCategory"
                                        aria-label="Floating label select example" v-model="model.category_id" disabled>
                                        <option value="">Pilih Kategori Dokumen</option>
                                        <option v-for="(row, index) in collections.categories" :key="index"
                                            :value="row.code"> {{
                                                row.name }}</option>
                                    </select>
                                    <label for="floatingCategory">Kategori</label>
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
                                    <p class="m-0 text-sm">Informasi detail dokumen</p>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(detail, index) in model.details" :key="index"
                                                class="align-items-center">
                                                <td>
                                                    <div class="tag-input">
                                                        <div class="d-flex flex-wrap gap-1">
                                                            <div v-for="tag in detail.labels" :key="tag"
                                                                class="m-0 btn btn-primary d-flex justify-content-between px-3 gap-3 text-xs">
                                                                {{ tag }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea
                                                        class="form-control shadow-none border border-0 bg-transparent"
                                                        v-model="detail.description" rows="1" placeholder="Description"
                                                        disabled></textarea>
                                                </td>
                                                <td>
                                                    <!-- <input type="number"
                                                        class="form-control shadow-none border border-0 bg-transparent"
                                                        placeholder="Nominal" v-model="detail.nominal" disabled> -->
                                                    <input
                                                        class="form-control shadow-none border border-0 bg-transparent"
                                                        placeholder="Nominal" v-model.lazy="detail.nominal"
                                                        v-money="money" disabled />

                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div v-if="!detail.nofile" style="display: flex; height: 100%;">
                                                        <span class="form-control rounded-0 rounded-start"
                                                            @click.prevent="showFilePreview(index)"> Lihat File
                                                        </span>
                                                        <a class="input-group-text rounded-0 rounded-end"
                                                            @click.prevent="showFilePreview(index)" id="exampleModal"><i
                                                                class="fas fa-search"></i></a>
                                                    </div>
                                                    <div v-else>
                                                        <p class="text-sm text-muted m-0">Tidak ada file</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionDocumentHistory">
                    <div class="accordion-item mb-3">
                        <h5 class="accordion-header" id="headingOne2">
                            <button
                                class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne2"
                                aria-expanded="false" aria-controls="collapseOne2">
                                <div class="m-0 flex-grow-1">
                                    <h6 class="m-0">Histori</h6>
                                    <p class="m-0 text-sm">Informasi timeline histori dokumen</p>
                                </div>
                                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
                            </button>
                        </h5>
                        <div id="collapseOne2" class="accordion-collapse collapse" aria-labelledby="headingOne2"
                            data-bs-parent="#accordionDocumentHistory">
                            <div class="accordion-body text-sm">
                                <div class="row">
                                    <div class="m-0">
                                        <ul class="timeline">
                                            <li class="d-flex flex-column mb-3" v-for="(det, index) in model.statuses"
                                                :key="index">
                                                <div class="d-flex justify-content-between flex-wrap mb-1">
                                                    <h6 class="text-dark mb-0">
                                                        {{ det.dict_edoc_status.status_message }}
                                                    </h6>
                                                    <p class="text-primary mb-0 me-3">{{ formatDate(det.created_at) }}
                                                    </p>
                                                </div>
                                                <p v-if="det.note" class="text-muted">{{ det.note }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-absolute end-0 bottom-0 me-3">
                    <button type="button" class="btn btn-secondary rounded-1" @click.prevent="resetForm">Close</button>
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
import { emitter } from '../../../../../../eventEmitter.js';
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
            collections: {
                categories: []
            },
            model: {
                number: '',
                label: '',
                labels: [],
                category_id: '',
                description: '',
                details: [],
            },
            currentQrcode: '',
            preview: '',
            modalDetailPreview: '',
            offcanvasDetail: '',
        };
    },
    mounted() {
        emitter.on('detailDocument', ([id, role]) => {
            this.role = role
            this.modalDetailPreview = new bootstrap.Modal('#exampledetailModal', {
                backdrop: false,
                keyboard: false,
            })
            this.offcanvasDetail = new bootstrap.Offcanvas('#offcanvasDetailRight', {
                backdrop: false,
                keyboard: false,
            })
            this.fetchDocument(id);
            this.fetchCategories();
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

                    if (detail.file.includes('no_content')) {
                        this.model.details[index].nofile = true
                    } else {
                        this.model.details[index].nofile = false
                    }

                    this.model.details[index].labels = this.model.details[index].label.split(',').map(e => e.trim());
                    this.model.details[index].nominal = this.model.details[index].nominal.toFixed(2).replace('.', ',')
                });
                Swal.close()
                this.offcanvasDetail.show()
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
        addNewCard() {
            this.model.details.push({
                label: '',
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
        showFilePreview(index) {
            if (this.model.details[index].file) {
                this.preview = this.model.details[index]
                this.modalDetailPreview.show()
            }
        },
        formatDate(dateString) {
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
        async downloadFile(fileUrl, id) {
            let endpoint = `${BASEURL}/api/edoc/detail/download-file/${id}`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                const link = document.createElement('a');
                link.href = fileUrl;
                link.download = '';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } catch (error) {
                console.error("Error download detail file: ", error);
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
            QRCode.toDataURL(qrcode, opts, function (err, url) {
                if (err) throw err;
                var svgimg = document.createElementNS("http://www.w3.org/2000/svg", "image");
                svgimg.setAttribute("width", "94");
                svgimg.setAttribute("height", "94");
                svgimg.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", url);
                document.getElementById("currentdetQrSvg").appendChild(svgimg);
                $("#qr-download").attr("href", url);
            });

            // let modal = new bootstrap.Modal(document.getElementById('viewCurrentEditedQrCode'));
            // modal.show();
        },
        printCurrentQRCode() {
            let currentPrintContents = document.getElementById("printCurrentEdittedQrCode").innerHTML;
            let currentPrintWindow = window.open("", "_blank");
            currentPrintWindow.document.open();
            currentPrintWindow.document.write('<html><head><title>Print</title></head><body>' + currentPrintContents + '</body></html>');
            currentPrintWindow.document.close();
            currentPrintWindow.print();
        },
        resetForm() {
            let closeOffcanvas = document.querySelector('#offcanvasDetailRight [data-bs-dismiss="offcanvas"]');
            closeOffcanvas.click();
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