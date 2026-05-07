<template>
  <!-- modal current qrcode -->
  <div class="modal fade" id="addDocumentListCurrentQrCode" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button class="btn btn-primary m-0 font-weight-normal" @click.prevent="generatePDFAddDoc">
            <i class="fas fa-print"></i> Print QR Code
          </button>
          <button type="button" class="btn-close btn-close-white m-0" @click.prevent="closeComponent"
            aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-5" id="printCurrentQrCode">
          <svg viewBox="0 0 93 100" enable-background="new 0 0 93.7 121.7" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" id="currentQrSvg"></svg>
          <h3 class="m-0 font-weight-normal">{{ currentQrcode }}</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Download QR PDF -->
  <div v-if="this.model.details != ''" style="display: none">
    <div id="pdfContentAddDoc" class="m-4">
      <div style="display: flex; flex-direction: row; width: 100%">
        <div class="p-4"
          style="border-top: 1px solid black; border-left: 1px solid black; border-bottom: 1px solid black; border-right: none; width: 100%">
          <p style="font-size: 20px; font-weight: 600; margin-bottom: 0; color: black;">EDOC-TRACKING</p>
          <p style="font-size: 16px; font-weight: 600; margin-bottom: 0; color: black;">{{
            user.unit.name }}
          </p>
          <table style="width: 100%">
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
              <td style="width: 100px">
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
        <img :src="qrCodeAddDocImage" alt="QR Code" id="qrCodeImagePdfAddDoc"
          style="width: 250px; height: 250px; border: 1px solid black" />
      </div>
    </div>
  </div>

  <!-- Modal for file preview -->
  <div class="modal fade" id="addDocumentListPreviewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div v-if="preview.isImage">
            {{ preview.label }}
            <img :src="preview.filePreview" alt="Preview" class="img-fluid" />
          </div>
          <embed v-if="preview.isPdf" :src="preview.filePreview + '#toolbar=0&navpanes=0&scrollbar=0'" frameBorder="0"
            scrolling="auto" height="100%" width="100%"></embed>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- offcanvas Add New Document -->
  <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasAddRight"
    data-bs-keyboard="false" aria-labelledby="offcanvasAddRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddRightLabel">Tambah Dokumen Baru</h5>
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
                  <input type="text" class="form-control" id="floatingLabel" placeholder="Judul Document"
                    v-model="model.label" />
                  <label for="floatingLabel">Nomor Memo<span class="text-danger"> *</span></label>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" placeholder="Leave a comment here" id="adddoclistfloatingDescription"
                    style="height: 100px" v-model="model.description"></textarea>
                  <label for="adddoclistfloatingDescription">Judul<span class="text-danger"> *</span></label>
                </div>
                <div class="form-floating mb-3">
                  <select class="form-select form-select-lg" id="floatingCategory"
                    aria-label="Floating label select example" v-model="model.category_id">
                    <option disabled value="">Pilih Kategori Dokumen</option>
                    <option v-for="(row, index) in collections.categories" :key="index" :value="row.code">
                      {{ row.name }}
                    </option>
                  </select>
                  <label for="floatingCategory">Kategori<span class="text-danger"> *</span></label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="accordion" id="accordionDocumentDetails">
          <div class="accordion-item mb-3">
            <h5 class="accordion-header" id="headingOne1">
              <button class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center"
                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="false"
                aria-controls="collapseOne1">
                <div class="m-0 flex-grow-1">
                  <h6 class="m-0">Detail</h6>
                  <p class="m-0 text-sm">Tambahkan detail dokumen</p>
                </div>
                <h6 class="text-sm mb-0 me-4" :class="{ 'text-danger': model.details.length == 0 }">
                  {{ model.details.length }} Detail
                </h6>
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
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(detail, index) in model.details" :key="index" class="align-items-center">
                        <td>
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
                              @keydown.enter="addTag(detail, $event)" @keydown.188="addTag(detail, $event)"
                              @keydown.delete="removeLastTag(detail, $event)" @input="onInput(detail, $event)"
                              @focus="detail.isActive = true" @blur="handleBlur(detail)"
                              v-model="detail.currentInput" />
                            <ul class="position-absolute bg-white px-2 py-3 me-sm-n4 shadow-lg"
                              v-if="detail.isActive && suggestions.length > 0">
                              <li class="dropdown-item mb-2 bg-white" v-for="(suggestion) in suggestions"
                                :key="suggestion" @click.prevent="addSuggestion(detail, suggestion)">
                                <a class="dropdown-item border-radius-md">
                                  <div class="d-flex px-3 py-1">
                                    <p class="text-xs text-secondary mb-0 d-flex align-items-center ">
                                      {{ suggestion }}
                                    </p>
                                  </div>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </td>
                        <td>
                          <textarea class="form-control shadow-none border border-0 bg-transparent"
                            v-model="detail.description" rows="1" placeholder="Description"></textarea>
                        </td>
                        <td>
                          <input class="form-control shadow-none border border-0 bg-transparent" placeholder="Nominal"
                            v-model.lazy="detail.nominals" v-money="money" />
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <div style="display: flex; height: 100%">
                            <div class="input-group">
                              <input type="file" class="form-control shadow-none bg-transparent"
                                accept=".jpg, .jpeg, .png, .pdf" @change="handleFileUpload(index)" />
                              <a v-if="detail.file" class="input-group-text" @click.prevent="showFilePreview(index)"
                                id="exampleModal">
                                <i class="fas fa-search">
                                  <span class="sr-only text-sm">
                                    Preview
                                  </span>
                                </i>
                              </a>
                            </div>
                          </div>
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <a @click.prevent="removeCard(index)">
                            <i class="fas fa-minus-square" style="font-size: 18px">
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
                <a class="btn btn-outline-info hstack gap-3 w-100 rounded-0 rounded-bottom" @click.prevent="addNewCard">
                  +
                  <p class="mb-0 text-sm">Tambah Detail</p>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="position-absolute end-0 bottom-0 me-3">
          <button v-if="!loading" type="button" class="btn btn-secondary rounded-1 me-3"
            @click.prevent="closeComponent">
            Cancel
          </button>
          <button v-if="!loading" type="button" class="btn btn-primary rounded-1" @click.prevent="confirmStore">
            Simpan
          </button>
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
import Swal from "sweetalert2";
import QRCode from "qrcode";
import { emitter } from "../../../../../../eventEmitter.js";
import html2pdf from "html2pdf.js";
export default {
  directives: { money: VMoney },
  name: "AddDocumentOffcanvas",
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
      collections: {
        categories: [],
      },
      suggestions: ['PPH23', 'Memo', 'BPP', 'Kwitansi'],
      model: {
        number: "",
        label: "",
        category_id: "",
        description: "",
        status_id: 1,
        details: [],
      },
      user: {},
      currentQrcode: "",
      preview: "",
      modalPreview: "",
      modalCurrentQr: "",
      modalAdd: "",
      qrCodeAddDocImage: "",
      loading: false,
    };
  },

  mounted() {
    emitter.on("AddDocument", async (user) => {
      this.user = user;
      this.modalPreview = new bootstrap.Modal("#addDocumentListPreviewModal", {
        backdrop: false,
        keyboard: false,
      });
      this.modalCurrentQr = new bootstrap.Modal(
        "#addDocumentListCurrentQrCode",
        {
          backdrop: false,
          keyboard: false,
        }
      );
      this.modalAdd = new bootstrap.Offcanvas("#offcanvasAddRight", {
        backdrop: false,
        keyboard: false,
      });
      await this.fetchNumber();
      await this.fetchCategories();
      await this.openModal();
    });
  },
  methods: {
    asset(path) {
      return `${BASEURL}${path}`;
    },
    async openModal() {
      this.modalAdd.show();
    },
    async fetchNumber() {
      let endpoint = `${BASEURL}/api/edoc/generate-unique-id`;
      let response = await axios.get(endpoint, {
        headers: {
          Authorization: "Bearer " + this.$token(),
        },
      });
      this.model.number = response.data.data.id;

    },
    async fetchCategories() {
      let endpoint = `${BASEURL}/api/edoc/category/options`;
      let response = await axios.get(endpoint, {
        headers: {
          Authorization: "Bearer " + this.$token(),
        },
      });
      this.collections.categories = response.data.data.options;
    },
    async confirmStore() {
      if (this.model.label == "") {
        Swal.fire("Kesalahan", "Nomor memo dokumen harus diisi.", "error");
        return false;
      }

      if (this.model.category_id == "") {
        Swal.fire("Kesalahan", "Kategori dokumen harus diisi.", "error");
        return false;
      }

      if (this.model.description == "") {
        Swal.fire("Kesalahan", "Judul dokumen harus diisi.", "error");
        return false;
      }

      if (this.model.details.length == 0) {
        Swal.fire("Kesalahan", "Dokumen harus memiliki detail.", "error");
        return false;
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
      let hasEmptyDetailsLabel = this.model.details.some(
        (detail) => detail.label.trim() === ""
      );
      if (hasEmptyDetailsLabel) {
        Swal.fire("Kesalahan", "Detail dokumen harus diisi.", "error");
        return false;
      }


      Swal.fire({
        title: "Simpan?",
        text: "Pastikan data yang anda simpan sudah benar",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Simpan",
      }).then((result) => {
        if (result.value) {
          this.store();
        }
      });
    },
    async store() {
      this.loading = true
      let endpoint = `${BASEURL}/api/edocs`;
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
            Authorization: "Bearer " + this.$token(),
            "Content-Type": "multipart/form-data",
          },
        });
        this.loading = false
        Swal.close()
        if (response) {
          Swal.fire({
            title: "Penyimpanan Berhasil. Print?",
            text: "Apakah anda ingin print qrcode sekarang?",
            icon: "success",
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonText: "Print",
          }).then((result) => {
            if (result.value) {
              this.viewCurrentQRCode(this.model.number);
            } else {
              this.closeComponent();
            }
          });
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
        });
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
        nominals: 0,
        checked: true,
        file: null,
        isImage: false,
        isPdf: false,
        filePreview: null,
      });
    },
    removeCard(index) {
      this.model.details.splice(index, 1);
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
      event.preventDefault();
      let val = detail.currentInput.trim();
      if (val.length > 0 && !detail.labels.includes(val)) {
        detail.labels.push(val)
        detail.currentInput = ''
        // detail.suggestions = []
      }
    },
    addSuggestion(detail, suggestion) {
      if (!detail.labels.includes(suggestion)) {
        detail.labels.push(suggestion);
        detail.currentInput = ''
        // detail.suggestions = []
      }
    },
    removeTag(detail, index) {
      detail.labels.splice(index, 1)
    },
    removeLastTag(detail, event) {
      if (event.target.value.length === 0) {
        this.removeTag(detail, detail.labels.length - 1)
      }
    },
    handleFileUpload(index) {
      const file = event.target.files[0];
      const maxSizeInBytes = 8 * 1024 * 1024; // 8 MB

      if (file.size > maxSizeInBytes) {
        Swal.fire("Kesalahan", "File tidak bisa melebihi 8mb", "error");
        return;
      }

      this.model.details[index].file = file;
      if (file.type.includes("image")) {
        this.model.details[index].filePreview = URL.createObjectURL(file);
        this.model.details[index].isImage = true;
        this.model.details[index].isPdf = false;
      } else if (file.type === "application/pdf") {
        this.model.details[index].filePreview = URL.createObjectURL(file);
        this.model.details[index].isImage = false;
        this.model.details[index].isPdf = true;
      }
    },
    showFilePreview(index) {
      if (this.model.details[index].file) {
        this.preview = this.model.details[index];
        // if (this.preview.isPdf) {
        //   window.open(this.preview.filePreview, "_blank");
        // } else {
        this.modalPreview.show();
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
        this.qrCodeAddDocImage = url;
        var svgimg = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "image"
        );
        svgimg.setAttribute("width", "94");
        svgimg.setAttribute("height", "94");
        svgimg.setAttributeNS(
          "http://www.w3.org/1999/xlink",
          "xlink:href",
          url
        );
        document.getElementById("currentQrSvg").appendChild(svgimg);
        $("#qr-download").attr("href", url);
      });

      this.modalCurrentQr.show();
    },
    generatePDFAddDoc() {
      Swal.fire({
        timer: 2000,
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });
      const element = document.getElementById("pdfContentAddDoc");
      html2pdf()
        .from(element)
        // .save('qrcode.pdf');
        .toPdf()
        .get("pdf")
        .then((pdf) => {
          const blob = pdf.output("blob");
          const url = URL.createObjectURL(blob);

          const newTab = window.open(url);

          newTab.onload = () => {
            newTab.print();
          };
        });
    },
    closeComponent() {
      this.modalCurrentQr.hide()
      this.modalPreview.hide()
      this.modalAdd.hide()
      this.resetForm()
      emitter.emit("fetchDocumentList")
    },
    resetForm() {
      this.model.details = []
      this.model.number = ""
      this.model.label = ""
      this.model.category_id = ""
      this.model.description = ""
      this.collections.categories = []
    },
  },
  computed: {},
  watch: {},
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

.list-doc li,
.list-doc li p {
  white-space: normal;
  float: left;
  width: 100%;
  height: auto;
  word-wrap: break-word;
}
</style>