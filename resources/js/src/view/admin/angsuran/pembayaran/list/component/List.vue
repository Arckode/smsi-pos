<template>
  <!-- offcanvas Add New Document -->
  <!-- <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasAddRight"
    data-bs-keyboard="false" aria-labelledby="offcanvasAddRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddRightLabel">Tambah Angsuran Pembayaran Baru</h5>
      <button type="button" class="btn-close btn-close-white" @click.prevent="closeComponent"
        aria-label="Close"></button>
    </div> -->
  <!-- <div class="offcanvas-body"> -->
  <form>
    <!-- <div class="d-flex gap-3 mt-3">
          <div class="input-group">
            <div class="form-floating flex-grow-1">
              <select class="form-select form-select-lg" id="floatingCategory"
                aria-label="Floating label select example" v-model="selectedNasabah">
                <option disabled value="">Pilih Nasabah</option>
                <option v-for="(row, index) in collections.nasabah" :key="index" :value="row.id">
                  {{ row.nama_lengkap }}
                </option>
              </select>
              <label for="floatingCategory">Nama Nasabah</label>
            </div>
          </div>
          <div class="input-group">
            <div class="form-floating flex-grow-1">
              <select class="form-select form-select-lg" id="floatingCategory"
                aria-label="Floating label select example" v-model="selectedPinjaman">
                <option disabled value="">Kode Pinjaman</option>
                <option v-for="(row, index) in collections.pinjaman" :key="index" :value="row.id">
                  {{ row.kode_pinjaman }}
                </option>
              </select>
              <label for="floatingCategory">Nomor Pinjaman</label>
            </div>
          </div>
        </div> -->

    <!-- <div class="accordion" id="accordionDocumentLabels">
          <div class="accordion-item mb-3">
            <h5 class="accordion-header" id="headingOne">
              <button class="accordion-button border-bottom font-weight-bold collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                aria-controls="collapseOne">
                <div class="m-0 flex-grow-1">
                  <h6 class="m-0">Data Nasabah</h6>
                  <p class="m-0 text-sm">Informasi mengenai detail Nasabah</p>
                </div>
                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
              </button>
            </h5>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
              data-bs-parent="#accordionDocumentLabels">
              <div class="accordion-body text-sm">
                <div class="row g-2 mb-3">
                  <div class="col-md">
                    <div class="form-floating">
                      <input type="text" disabled class="form-control border-0 bg-transparent shadow-none"
                        id="floatingLabel" placeholder="Kota lahir" v-model="nasabah.nik">
                      <label for="floatingInputGrid">NIK</label>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-floating">
                      <input type="text" disabled class="form-control border-0 bg-transparent shadow-none"
                        id="floatingLabel" placeholder="Tanggal Lahir" v-model="nasabah.no_telepon">
                      <label for="floatingSelectGrid">Nomor Telfon</label>
                    </div>
                  </div>
                </div>
                <div class="row g-2 mb-3">
                  <div class="col-md">
                    <div class="form-floating">
                      <input type="email" disabled class="form-control border-0 bg-transparent shadow-none"
                        id="floatingLabel" placeholder="Kota lahir" v-model="nasabah.tempat_lahir">
                      <label for="floatingInputGrid">Tempat lahir</label>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-floating">
                      <input type="date" disabled class="form-control border-0 bg-transparent shadow-none"
                        id="floatingInputGrid" placeholder="Tanggal Lahir" v-model="nasabah.tanggal_lahir">
                      <label for="floatingSelectGrid">Tanggal Lahir</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->

    <!-- <div class="accordion" id="accordionDocumentLabels1">
          <div class="accordion-item mb-3">
            <h5 class="accordion-header" id="headingOne">
              <button class="accordion-button border-bottom font-weight-bold collapsed pt-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseOnex" aria-expanded="false"
                aria-controls="collapseOne">
                <div class="m-0 flex-grow-1">
                  <h6 class="m-0">Data Angsuran Pinjaman</h6>
                  <p class="m-0 text-sm">Informasi mengenai detail angsuran pinjaman</p>
                </div>
                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
              </button>
            </h5>
            <div id="collapseOnex" class="accordion-collapse collapse show" aria-labelledby="headingOne"
              data-bs-parent="#accordionDocumentLabels1">
              <div class="accordion-body text-sm">



                <div class="row g-2 mb-3">
                  <div class="col-md">
                    <div class="form-floating">
                      <input disabled class="form-control border-0 bg-transparent shadow-none" id="floatingLabel"
                        placeholder="Kota lahir" v-model.lazy="pinjaman.nilai_plafond" v-money="money">
                      <label for="floatingInputGrid">Plafond Pembiayaan</label>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-floating">
                      <input type="number" disabled class="form-control border-0 bg-transparent shadow-none"
                        id="floatingInputGrid" placeholder="Tanggal Lahir" v-model="pinjaman.rate_bunga">
                      <label for="floatingSelectGrid">Suku Bunga Eff/pa (%)</label>
                    </div>
                  </div>
                </div>
                <div class="row g-2 mb-3">
                  <div class="col-md">
                    <div class="form-floating">
                      <input type="number" disabled class="form-control border-0 bg-transparent shadow-none"
                        id="floatingLabel" placeholder="Kota lahir" v-model="pinjaman.tenor">
                      <label for="floatingInputGrid">Jangka Waktu (Bulan)</label>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-floating">
                      <input type="date" disabled class="form-control border-0 bg-transparent shadow-none"
                        id="floatingInputGrid" placeholder="Tanggal Lahir" v-model="pinjaman.tanggal_mulai">
                      <label for="floatingSelectGrid">Tanggal PK / Akad</label>
                    </div>
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input disabled class="form-control border-0 bg-transparent shadow-none" id="floatingLabel"
                    placeholder="Judul Document" v-model.lazy="pinjaman.nilai_angsuran" v-money="money" />
                  <label for="floatingLabel">Angsuran per-bulan</label>
                </div>

              </div>
            </div>
          </div>
        </div> -->

    <!-- <div class="accordion mt-0 mb-6" id="accordionDocumentDetails">
          <div class="accordion-item">
            <h5 class="accordion-header" id="headingOne1">
              <button class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center pt-0"
                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="false"
                aria-controls="collapseOne1">
                <div class="m-0 flex-grow-1">
                  <h6 class="m-0">Pembayaran</h6>
                  <p class="m-0 text-sm">Detail Pembayaran Angsuran</p>
                </div>
                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
              </button>
            </h5> -->
    <!-- <div id="collapseOne1" class="accordion-collapse collapse show" aria-labelledby="headingOne1"
              data-bs-parent="#accordionDocumentDetails"> -->
    <!-- <div class="accordion-body text-sm pb-0"> -->
    <!-- </div> -->
    <div class="table-responsive p-0 mt-3">
      <div class="input-group mb-3">
        <span class="input-group-text text-body">
          <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
            </path>
          </svg>
        </span>
        <input type="text" class="form-control" placeholder="Nama Nasabah / Nomor Pensiunan / Norek"
          v-model="meta.search">
      </div>
      <table class="table table-hover table-bordered">
        <thead class="table-dark">
          <tr>
            <th class="text-center text-sm font-weight-semibold">Nama Nasabah<br>Norek</th>
            <th class="text-center text-sm font-weight-semibold">Nomor Pensiunan<br>Periode</th>
            <th class="text-center text-sm font-weight-semibold">Tenor</th>
            <th class="text-center text-sm font-weight-semibold">Jatuh Tempo</th>
            <th class="text-center text-sm font-weight-semibold">Plafond</th>
            <th class="text-center text-sm font-weight-semibold">Nilai Angsuran</th>
            <th class="text-center text-sm font-weight-semibold">Nominal Outstanding</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in filteredDetails" :key="item.id" @click="toggleCheckbox(item.id)"
            :class="arraydet.includes(item.id) ? 'border-dark bg-info text-white' : 'border-secondary'">
            <td class="text-center text-sm font-weight-semibold d-none">
              <input type="checkbox" v-model="arraydet" :value="item.id">
            </td>
            <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
              {{ item.angsuran_pinjaman.nasabah.nama_lengkap }}
              <br>
              {{ item.angsuran_pinjaman.norek }}
            </td>
            <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
              {{ item.angsuran_pinjaman.nomor_pensiunan }}
              <br>
              Periode ke-{{ item.periode_ke }}
            </td>
            <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
              {{ item.angsuran_pinjaman.tenor }} Bulan
            </td>
            <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
              {{ new Date(item.tanggal_jatuh_tempo).toLocaleString('en-GB', {
                day: 'numeric', month: 'long', year: 'numeric'
              }) }}
            </td>
            <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
              {{ formatRupiah(item.angsuran_pinjaman.nilai_plafond) }}
            </td>
            <!-- <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
                          {{ item.nilai_pokok }}
                        </td>
                        <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
                          {{ item.cicilan_pokok }}
                        </td>
                        <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
                          {{ item.cicilan_bunga }}
                        </td> -->
            <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
              {{ formatRupiah(item.nilai_angsuran) }}
            </td>
            <td class="text-center text-sm font-weight-semibold" style="vertical-align: middle;">
              <input class="form-control" placeholder="Nominal" id="floatingLabel"
                v-model.lazy="item.outstanding_angsuran" v-money="money" />
            </td>
          </tr>
        </tbody>
        <tfoot class="bg-warning border border-dark">
          <td class="text-center text-md font-weight-semibold p-2 text-white" colspan="6">
            Total Terpilih
          </td>
          <td class="text-center text-md font-weight-semibold text-white">
            {{ formatRupiah(model.total) }}
          </td>
        </tfoot>
      </table>
    </div>
    <div class="row g-2 mb-8 mb-3">
      <div class="col-md">
        <div class="form-floating">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" v-model="meta.selected">
            <label class="form-check-label" for="flexSwitchCheckDefault">Show Selected</label>
          </div>
        </div>
      </div>
      <div class="col-md">
        <div class="form-floating">
          <input type="date" class="form-control border border-warning" style="padding: 30px;" id="floatingLabel"
            placeholder="Kota lahir" v-model="model.tanggal_bayar">
          <label style="font-size: 12px;" for="floatingInputGrid">Tanggal Pembayaran<span class="text-danger">
              *</span></label>
        </div>
      </div>
    </div>
    <!-- </div> -->
    <!-- </div>
        </div> -->

    <div class="position-absolute end-0 bottom-0 me-3">
      <button v-if="!loading" type="button" class="btn btn-secondary rounded-1 me-3" @click.prevent="closeComponent">
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
  <!-- </div> -->
  <!-- </div> -->
</template>

<script>
import { VMoney } from 'v-money'
import $ from "jquery";
import Swal from "sweetalert2";
import QRCode from "qrcode";
import { emitter } from "../../../../../../../eventEmitter.js";
import html2pdf from "html2pdf.js";
import ExcelJS from 'exceljs';
import html2canvas from 'html2canvas';
export default {
  directives: { money: VMoney },
  data() {
    return {
      modalPreview: "",
      modalCurrentQr: "",
      modalAdd: "",
      loading: false,
      meta: {
        selected: false,
        search: '',
      },
      money: {
        decimal: ',',
        thousands: '.',
        prefix: 'Rp. ',
        suffix: '',
        precision: 2,
        masked: false
      },
      collections: {
        nasabah: [],
        pinjaman: [],
        tunggakan: [],
        total: 0
      },
      nasabah: {
        nik: '',
        nama_lengkap: '',
        tempat_lahir: '',
        tanggal_lahir: '',
        jenis_kelamin: '',
        alamat: '',
        no_telepon: '',
      },
      pinjaman: {},
      model: {
        details: [],
        tanggal_bayar: '',
        total: 0,
      },
      selectedPinjaman: '',
      selectedNasabah: '',
      selectedDetails: [],
      total: 0,
      arraydet: [],
    };
  },

  async mounted() {
    await this.fetchTunggakanList();
    // emitter.on("addPembayaran", async (user) => {
    //   console.log('openAddPinjaman')
    //   this.user = user;
    //   this.modalAdd = new bootstrap.Offcanvas("#offcanvasAddRight", {
    //     backdrop: false,
    //     keyboard: false,
    //   });

    //   // await this.fetchCategories();
    //   await this.fetchNasabahList();
    //   await this.openModal();
    // });
  },
  methods: {
    asset(path) {
      return `${BASEURL}${path}`;
    },
    async openModal() {
      this.modalAdd.show();
    },
    formatRupiah(value) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        currencyDisplay: 'symbol',
        maximumFractionDigits: 0
      }).format(value);
    },
    toggleCheckbox(itemId) {
      if (this.arraydet.includes(itemId)) {
        this.arraydet = this.arraydet.filter(id => id !== itemId);
      } else {
        this.arraydet.push(itemId);
      }
      this.model.details = (this.collections.tunggakan.filter(item => this.arraydet.includes(item.id)))
      // console.log('det', this.arraydet)

      // this.model.total = this.arraydet.reduce((acc, item) => acc + parseFloat(item.nilai_angsuran), 0);
      this.model.total = Math.floor(this.model.details.reduce((acc, item) => {
        const value = parseFloat(item.outstanding_angsuran.replace(/[Rp.\s]+/g, ''));
        return acc + value;
      }, 0)); 
    },
    async fetchTunggakanList() {
      let endpoint = `${BASEURL}/api/angsuran-pinjaman/tunggakan`;
      let response = await axios.get(endpoint, {
        headers: {
          Authorization: "Bearer " + this.$token(),
        },
      });
      this.collections.tunggakan = response.data.data.list;
      this.collections.total = response.data.data.total
      console.log('tunggakan', this.collections.tunggakan)
    },


    // async fetchNasabahList() {
    //   let endpoint = `${BASEURL}/api/nasabah/options`;
    //   let response = await axios.get(endpoint, {
    //     headers: {
    //       Authorization: "Bearer " + this.$token(),
    //     },
    //   });
    //   this.collections.nasabah = response.data.data;
    // },
    // async loadNasabahDetails(id) {
    //   let endpoint = `${BASEURL}/api/nasabah/${id}`
    //   try {
    //     Swal.showLoading();
    //     let response = await axios.get(endpoint, {
    //       headers: {
    //         Authorization: 'Bearer ' + this.$token(),
    //       }
    //     })
    //     this.nasabah = response.data.data.nasabah
    //     this.fetchPinjamanList(this.nasabah.id)
    //     Swal.close()
    //   } catch (error) {
    //     console.log(error)
    //     Swal.fire({
    //       title: error.response.statusText,
    //       text: error.response.data.message,
    //       icon: 'error'
    //     })
    //     return false
    //   }
    // },
    // async fetchPinjamanList(id) {
    //   console.log(id)
    //   let endpoint = `${BASEURL}/api/pinjaman-list/${id}`
    //   try {
    //     Swal.showLoading();
    //     let response = await axios.get(endpoint, {
    //       headers: {
    //         Authorization: 'Bearer ' + this.$token(),
    //       }
    //     })
    //     this.collections.pinjaman = response.data.data
    //     Swal.close()
    //   } catch (error) {
    //     console.log(error)
    //     Swal.fire({
    //       title: error.response.statusText,
    //       text: error.response.data.message,
    //       icon: 'error'
    //     })
    //     return false
    //   }
    // },
    // async loadPinjamanDetails(id) {
    //   console.log(id)
    //   let endpoint = `${BASEURL}/api/angsuran-pinjaman/${id}`
    //   try {
    //     Swal.showLoading();
    //     let response = await axios.get(endpoint, {
    //       headers: {
    //         Authorization: 'Bearer ' + this.$token(),
    //       }
    //     })
    //     this.pinjaman = response.data.data.angsuran
    //     this.pinjaman.angsuran_pinjaman_detail = this.pinjaman.angsuran_pinjaman_detail.filter(item => item.status_pembayaran == 'belum_bayar')
    //     this.pinjaman.nilai_angsuran = parseInt(this.pinjaman.nilai_angsuran)
    //     this.pinjaman.nilai_plafond = parseInt(this.pinjaman.nilai_plafond)
    //     console.log(this.pinjaman)
    //     Swal.close()
    //   } catch (error) {
    //     console.log(error)
    //     Swal.fire({
    //       title: error.response.statusText,
    //       text: error.response.data.message,
    //       icon: 'error'
    //     })
    //     return false
    //   }
    // },

    async confirmStore() {  
      if (this.model.details.length == 0) {
        Swal.fire("Kesalahan", "Silahkan pilih dulu angsuran yang perlu diproses.", "error");
        return false;
      }
      if (this.model.tanggal_bayar == '') {
        Swal.fire("Kesalahan", "Silahkan isi tanggal angsuran pembayaran.", "error");
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
      let endpoint = `${BASEURL}/api/angsuran-pembayaran`;
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
            title: "Penyimpanan Berhasil",
            icon: "success",
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonText: "Ok",
          }).then((result) => {
            if (result.value) {
              this.fetchTunggakanList();
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

    // convertNominal(nominal) {
    //   let cleanedValue = nominal
    //     .replace(/Rp\.?\s?/g, '')
    //     .replace(/\./g, '')
    //     .replace(/,/g, '.')
    //     .trim()
    //   return parseFloat(cleanedValue) || 0;
    // },
    // closeComponent() {
    //   this.modalAdd.hide()
    //   this.resetForm()
    //   emitter.emit("fetchDocumentList")
    // },
    // resetForm() {
    //   this.collections.nasabah = []
    //   this.collections.pinjaman = []
    // },
    // resetNasabah() {
    //   this.collections.pinjaman = []
    //   this.nasabah = {
    //     nik: '',
    //     nama_lengkap: '',
    //     tempat_lahir: '',
    //     tanggal_lahir: '',
    //     jenis_kelamin: '',
    //     alamat: '',
    //     no_telepon: '',
    //   };
    //   this.resetPinjaman();
    // },
    // resetPinjaman() {
    //   this.pinjaman = {};
    //   this.resetModel();
    // },
    // resetModel() {
    //   this.model = {
    //     nasabah: {
    //       id: '',
    //     },
    //     pinjaman: {
    //       id: '',
    //     },
    //     details: [],
    //     total: 0,
    //     tanggal_bayar: '',
    //   };
    // }
  },
  computed: {
    filteredDetails() {
      const searchTerm = this.meta.search.toLowerCase();

      if (!searchTerm) {
        return this.meta.selected ? this.selectedDetails : this.collections.tunggakan;
      }

      const filtered = this.meta.selected
        ? this.selectedDetails.filter(item => {
          return (
            (item.angsuran_pinjaman && item.angsuran_pinjaman.nasabah && item.angsuran_pinjaman.nasabah.nama_lengkap &&
              item.angsuran_pinjaman.nasabah.nama_lengkap.toLowerCase().includes(searchTerm)) ||
            (item.angsuran_pinjaman && item.angsuran_pinjaman.nomor_pensiunan &&
              item.angsuran_pinjaman.nomor_pensiunan.toLowerCase().includes(searchTerm)) || // Ensure this is correct
            (item.angsuran_pinjaman && item.angsuran_pinjaman.norek &&
              item.angsuran_pinjaman.norek.toString().includes(searchTerm))
          );
        })
        : this.collections.tunggakan.filter(item => {
          return (
            (item.angsuran_pinjaman && item.angsuran_pinjaman.nasabah && item.angsuran_pinjaman.nasabah.nama_lengkap &&
              item.angsuran_pinjaman.nasabah.nama_lengkap.toLowerCase().includes(searchTerm)) ||
            (item.angsuran_pinjaman && item.angsuran_pinjaman.nomor_pensiunan &&
              item.angsuran_pinjaman.nomor_pensiunan.toLowerCase().includes(searchTerm)) || // Ensure this is correct
            (item.angsuran_pinjaman && item.angsuran_pinjaman.norek &&
              item.angsuran_pinjaman.norek.toString().includes(searchTerm))
          );
        });

      return filtered;
    }
  },
  watch: {
    // 'selectedNasabah': function (val) {
    //   this.selectedPinjaman = ''
    //   this.resetNasabah()
    //   this.loadNasabahDetails(val)
    // },
    // 'selectedPinjaman': function (val) {
    //   this.resetPinjaman()
    //   if (val != '') {
    //     this.loadPinjamanDetails(val)
    //   }
    // },
    'meta.selected': function (newVal) {
      if (newVal) {
        this.selectedDetails = this.collections.tunggakan.filter(item => this.arraydet.includes(item.id));
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

.list-doc li,
.list-doc li p {
  white-space: normal;
  float: left;
  width: 100%;
  height: auto;
  word-wrap: break-word;
}
</style>