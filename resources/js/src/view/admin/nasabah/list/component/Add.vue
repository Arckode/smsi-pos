<template>
  <!-- offcanvas Add New Document -->
  <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasAddRight"
    data-bs-keyboard="false" aria-labelledby="offcanvasAddRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddRightLabel">Tambah Nasabah Baru</h5>
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
                  <h6 class="m-0">Biodata</h6>
                  <p class="m-0 text-sm">Informasi mengenai nasabah</p>
                </div>
                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
              </button>
            </h5>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
              data-bs-parent="#accordionDocumentLabels">
              <div class="accordion-body text-sm">
                <div class="form-check form-switch ms-1">
                  <input class="form-check-input d-flex align-items-center" style="height: 20px;" type="checkbox"
                    id="flexSwitchCheckCheckedExecuting" v-model="model.nasabah.is_executing">
                  <label class="form-check-label" for="flexSwitchCheckCheckedExecuting">{{ model.nasabah.is_executing ?
                    'Executing' : 'Channeling' }}</label>
                </div>
                <div class="row g-3 mb-3">
                  <div class="col-md">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingLabel" placeholder="Judul Document"
                        v-model="model.nasabah.nik" />
                      <label for="floatingLabel">NIK<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingLabel" placeholder="Judul Document"
                        v-model="model.nasabah.nama_lengkap" />
                      <label for="floatingLabel">Nama Lengkap<span class="text-danger"> *</span></label>
                    </div>
                    <div class="row g-2 mb-3">
                      <div class="col-md">
                        <div class="form-floating">
                          <input type="email" class="form-control" id="floatingLabel" placeholder="Kota lahir"
                            v-model="model.nasabah.tempat_lahir">
                          <label for="floatingInputGrid">Kota<span class="text-danger"> *</span></label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating">
                          <input type="date" class="form-control" id="floatingInputGrid" placeholder="Tanggal Lahir"
                            v-model="model.nasabah.tanggal_lahir">
                          <label for="floatingSelectGrid">Tanggal Lahir<span class="text-danger"> *</span></label>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md mb-3">
                      <div class="form-floating">
                        <input type="text" class="form-control border-0 bg-transparent shadow-none" id="floatingLabel"
                            placeholder="Judul Document" v-model="model.age_text_start" disabled />
                          <label for="floatingLabel">Umur</label>
                      </div>
                    </div> -->
                    <div class="form-floating mb-3">
                      <select class="form-select form-select-lg" id="floatingCategory"
                        aria-label="Floating label select example" v-model="model.nasabah.jenis_kelamin">
                        <option disabled value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                      <label for="floatingCategory">Jenis Kelamin<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                      <textarea class="form-control" placeholder="Leave a comment here"
                        id="adddoclistfloatingDescription" style="height: 100px"
                        v-model="model.nasabah.alamat"></textarea>
                      <label for="adddoclistfloatingDescription">Alamat<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingLabel" placeholder="Judul Document"
                        v-model="model.nasabah.no_telepon" />
                      <label for="floatingLabel">Nomor Telfon<span class="text-danger"> *</span></label>
                    </div>
                    <div class="ms-1 mb-3">
                      <label>Pensiun<span class="text-danger"> *</span></label>
                      <br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input d-flex align-items-center justify-content-center" type="radio"
                          name="inlineRadioOptions" id="inlineRadio1" value="Taspen" v-model="model.nasabah.pensiun">
                        <label class="form-check-label" for="inlineRadio1">Taspen</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input d-flex align-items-center justify-content-center" type="radio"
                          name="inlineRadioOptions" id="inlineRadio2" value="Asabri" v-model="model.nasabah.pensiun">
                        <label class="form-check-label" for="inlineRadio2">Asabri</label>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-check form-switch ms-1">
                        <input class="form-check-input d-flex align-items-center" style="height: 20px;" type="checkbox"
                          id="flexSwitchCheckCheckedFlagging" v-model="model.nasabah.flagging">
                        <label class="form-check-label" for="flexSwitchCheckCheckedFlagging">Flagging</label>
                      </div>
                      <div class="form">
                        <input class="form-control" id="floatingInputGrid" placeholder="Nominal Flagging"
                          v-model.lazy="model.nasabah.flagging_nominal" v-money="money">
                      </div>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="d-grid d-flex align-items-center justify-content-md-center">
                      <img v-if="model.foto_profil_preview" :src="model.foto_profil_preview" class="rounded-2"
                        alt="Foto Nasabah" style="width: auto; height: 300px; object-fit: cover;">
                    </div>
                    <div class="mt-2 d-grid d-flex align-items-center justify-content-md-center mb-3">
                      <input class="form-control" type="file" id="nasabahFile"
                        @change="handleFileChange($event, 'nasabah')" style="display:none;" accept="image/*" />
                      <label for="nasabahFile" class="form-label btn btn-info text-white">Foto Nasabah</label>
                    </div>
                    <div class="d-grid d-flex align-items-center justify-content-md-center">
                      <img v-if="model.foto_ktp_preview" :src="model.foto_ktp_preview" class="rounded-2" alt="KTP"
                        style="width: auto; height: 250px; object-fit: cover;">
                    </div>
                    <div class="mt-2 d-grid d-flex align-items-center justify-content-md-center">
                      <input class="form-control" type="file" id="ktpFile" @change="handleFileChange($event, 'ktp')"
                        style="display:none;" accept="image/*" />
                      <label for="ktpFile" class="form-label btn btn-info text-white">KTP</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card bg-info p-3" :class="model.angsuran.schedule_angsuran_created ? 'mb-3' : 'mb-6'">
          <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedAngsuran"
              v-model="model.angsuran.schedule_angsuran_created">
            <label class="form-check-label text-white text-bold mb-0" for="flexSwitchCheckCheckedAngsuran">Buat Angsuran
              Pinjaman</label>
          </div>
        </div>

        <div v-if="model.angsuran.schedule_angsuran_created" class="accordion mt-0 mb-6" id="accordionDocumentDetails">
          <div class="accordion-item mb-3">
            <h5 class="accordion-header" id="headingOne1">
              <button class="accordion-button border-bottom font-weight-bold collapsed d-flex align-items-center pt-0"
                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="false"
                aria-controls="collapseOne1">
                <div class="m-0 flex-grow-1">
                  <h6 class="m-0">Angsuran Pinjaman</h6>
                  <p class="m-0 text-sm">Detail Jadwal Angsuran Pinjaman</p>
                </div>
                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
              </button>
            </h5>
            <div id="collapseOne1" class="accordion-collapse collapse show" aria-labelledby="headingOne1"
              data-bs-parent="#accordionDocumentDetails">
              <div class="accordion-body text-sm">
                <!-- <div class="form-check d-grid d-flex align-items-center justify-content-md-end mt-3 ms-3 mb-3">
                  <input class="form-check-input" type="checkbox" v-model="model.angsuran.angsuran_accepted"
                    id="flexCheckDefault">
                  <label class="form-check-label mb-0 ms-2 text-bold" for="flexCheckDefault"
                    :class="model.angsuran.angsuran_accepted ? 'text-success' : 'text-danger'">
                    Plafond Accepted
                  </label>
                </div> -->
                <div class="row g-2">
                  <div class="col-md">
                    <p class="mb-3 fs-5 text-dark text-center text-bold">Data Debitur</p>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control border-0 bg-transparent shadow-none" id="floatingLabel"
                        placeholder="Judul Document" v-model="model.nasabah.nama_lengkap" disabled />
                      <label for="floatingLabel">Nama Nasabah</label>
                    </div>
                    <div class="row g-2">
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control border-0 bg-transparent shadow-none" id="floatingLabel"
                            placeholder="Judul Document" v-model="model.age_text_start" disabled />
                          <label for="floatingLabel">Umur Awal</label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control border-0 bg-transparent shadow-none" id="floatingLabel"
                            placeholder="Judul Document" v-model="model.age_text_end" disabled />
                          <label for="floatingLabel">Umur Akhir</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingLabel" placeholder="Judul Document"
                        v-model="model.angsuran.norek" />
                      <label for="floatingLabel">Norek<span class="text-danger"> *</span></label>
                    </div>
                    <div class="row g-2">
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <select class="form-select form-select-lg" id="floatingCategory"
                            aria-label="Floating label select example" v-model="model.angsuran.unit">
                            <option disabled value="">Unit Layanan</option>
                            <option v-for="(row, index) in collections.unit_id" :key="index" :value="row.code">
                              {{ row.name }}
                            </option>
                          </select>
                          <label for="floatingCategory">KNS Unit Layanan<span class="text-danger"> *</span></label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <select class="form-select form-select-lg" id="floatingCategory"
                            aria-label="Floating label select example" v-model="model.angsuran.fasilitas_id">
                            <option disabled value="">Pilih Fasilitas</option>
                            <option v-for="(row, index) in collections.facilities" :key="index" :value="row.code">
                              {{ row.name }}
                            </option>
                          </select>
                          <label for="floatingCategory">Fasilitas</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <!-- <label class="form-check-label mb-0 text-xs" for="flexSwitchCheckCheckedx">Provisi</label> -->
                      <div class="row g-2">
                        <div class="col-md-3">
                          <div class="form-floating mb-3">
                            <!-- <input type="number" class="form-control" placeholder="" id="floatingLabel"
                              aria-label="provisi" aria-describedby="basic-addon2" v-model="model.angsuran.provisi_percentage">
                              <label for="floatingLabel">Biaya Admin<span class="text-danger"> *</span></label>
                            <span class="input-group-text" id="basic-addon2">%</span> -->
                            <input class="form-control" placeholder="Nominal" id="floatingLabel"
                              v-model="model.angsuran.provisi_percentage" />
                            <label for="floatingLabel">Provisi (%)<span class="text-danger"> *</span></label>
                          </div>
                        </div>
                        <div class="col-sm">
                          <div class="form-floating mb-3">
                            <!-- <input class="form-control" placeholder="Nominal" id="floatingLabel"
                          v-model.lazy="model.angsuran.provisi_nominal" v-money="money" /> -->
                            <input class="form-control bg-transparent" placeholder="Nominal" id="floatingLabel"
                              v-model.lazy="model.angsuran.provisi_nominal" v-money="money" disabled />
                            <label for="floatingLabel">Nominal Provisi<span class="text-danger"> *</span></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row g-2">
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <input class="form-control" placeholder="Nominal" id="floatingLabel"
                            v-model.lazy="model.angsuran.biaya_admin" v-money="money" />
                          <label for="floatingLabel">Biaya Admin<span class="text-danger"> *</span></label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <input class="form-control" placeholder="Nominal" id="floatingLabel"
                            v-model.lazy="model.angsuran.biaya_lain" v-money="money" />
                          <label for="floatingLabel">Biaya Lain<span class="text-danger"> *</span></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md">
                    <p class="mb-3 fs-5 text-dark text-center text-bold">Data Pembiayaan</p>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingLabel" placeholder="Judul Document"
                        v-model="model.angsuran.nomor_pensiunan" />
                      <label for="floatingLabel">Nomor Pensiunan<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" placeholder="Nominal" id="floatingLabel"
                        v-model.lazy="model.angsuran.nilai_plafond" v-money="money" />
                      <label for="floatingLabel">Plafond Pembiayaan<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="number" min="0" step="0.01" class="form-control" id="floatingLabel"
                        placeholder="Judul Document" v-model="model.angsuran.rate_bunga" />
                      <label for="floatingLabel">Suku Bunga Eff/pa (%)<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="number" min="0" class="form-control" id="floatingLabel" placeholder="Judul Document"
                        v-model="model.angsuran.tenor" />
                      <label for="floatingLabel">Jangka Waktu (Bulan)<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="date" class="form-control" id="floatingLabel" placeholder="Judul Document"
                        v-model="model.angsuran.tanggal_mulai" />
                      <label for="floatingLabel">Tanggal PK / Akad<span class="text-danger"> *</span></label>
                    </div>
                    <div class="input-group mb-3">
                      <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control bg-transparent border border-1" name="floatingLabel"
                          placeholder="Nominal" v-model="displayedAngsuran" v-money="money" disabled>
                        <label for="floatingLabel">Angsuran per-bulan</label>
                      </div>
                      <a class="input-group-text btn mb-0 vertical-center"
                        :class="model.refreshAngsuranBtn ? 'btn-success' : 'btn-danger'"
                        v-show="!model.refreshAngsuranBtn" @click.prevent="calculateAngsuran" style="z-index: 0;"><i
                          class="fas fa-sync p-2 vertical-center"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-floating mb-3 text-center mt-3" v-show="!model.createdSchedule">
                <a class="btn text-center w-100" :class="model.createdSchedule ? 'btn-success' : 'btn-warning'"
                  @click.prevent="createScedule">Buat Jadwal Angsuran</a>
              </div>
              <div class="border border-1 border-primary rounded-top p-4" v-show="model.createdSchedule">
                <li class="nav-item dropdown pe-2 d-flex align-items-center float-end">
                  <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButtonProfile"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-download text-dark"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 shadow-lg"
                    aria-labelledby="dropdownMenuButtonProfile">
                    <li class="m-3">
                      <a class="text-dark text-sm" href="#" @click.prevent="convertToExcel">
                        Excel
                      </a>
                    </li>
                    <li class="m-3">
                      <a class="text-dark" href="#" @click.prevent="convertToPDF">
                        PDF
                      </a>
                    </li>
                    <li class="m-3">
                      <a class="text-dark" href="#" @click.prevent="convertToImg">
                        Image
                      </a>
                    </li>
                  </ul>
                </li>

                <div id="table-angsuran">
                  <p class="mb-0 fs-5 text-dark text-center text-bold">Jadwal Angsuran Pinjaman</p>
                  <p class="mb-0 text-sm text-dark text-center">Nama: {{ model.nasabah.nama_lengkap }}</p>
                  <div class="table-responsive w-100">
                    <table class="table table-hover table-bordered mt-3 mb-0">
                      <thead class="table-dark">
                        <tr>
                          <th width="5%" class="text-center">No</th>
                          <th>Tanggal Bayar</th>
                          <th class="text-end">Angsuran</th>
                          <th class="text-end">Cicilan Pokok</th>
                          <th class="text-end">Cicilan Bunga / Margin</th>
                          <th class="text-end">Sisa Pokok</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr style="background-color: cadetblue; border-color: cadetblue; color: white;">
                          <td class="text-center align-middle text-xs py-3" colspan="2">
                            {{ new Date(model.angsuran.tanggal_mulai).toLocaleString('en-GB', {
                              day: 'numeric', month:
                                'long', year: 'numeric'
                            }) }}
                          </td>
                          <td class="text-end ps-4 align-middle text-xs" colspan="4">
                            {{ model.angsuran.nilai_plafond }}
                          </td>
                        </tr>
                        <tr v-for="(detail, index) in model.angsuran.details" :key="index" class="align-items-center">
                          <td class="text-center align-middle text-xs p-3">
                            {{ detail.periode_ke }}
                          </td>
                          <td class="ps-4 align-middle text-xs">
                            {{ new Date(detail.tanggal_jatuh_tempo).toLocaleString('en-GB', {
                              day: 'numeric', month:
                                'long', year: 'numeric'
                            }) }}
                          </td>
                          <td class="text-end ps-4 align-middle text-xs">
                            {{ formatRupiah(detail.nilai_angsuran) }}
                          </td>
                          <td class="text-end ps-4 align-middle text-xs">
                            {{ formatRupiah(detail.cicilan_pokok) }}
                          </td>
                          <td class="text-end ps-4 align-middle text-xs">
                            {{ formatRupiah(detail.cicilan_bunga) }}
                          </td>
                          <td class="text-end ps-4 align-middle text-xs">
                            {{ formatRupiah(detail.nilai_pokok) }}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

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
import ExcelJS from 'exceljs';
import html2canvas from 'html2canvas';
export default {
  directives: { money: VMoney },
  name: "AddNasabahOffcanvas",
  data() {
    return {
      modalAdd: "",
      loading: false,
      money: {
        decimal: ',',
        thousands: '.',
        prefix: 'Rp. ',
        suffix: '',
        precision: 0,
        masked: false
      },
      collections: {
        units: [],
        facilities: [],
      },
      model: {
        nasabah: {
          is_executing: false,
          nik: '',
          nama_lengkap: '',
          tempat_lahir: '',
          tanggal_lahir: '',
          jenis_kelamin: '',
          alamat: '',
          pensiun: '',
          flagging: '',
          flagging_nominal: 0,
          no_telepon: '',
          age_year: 0,
          age_month: 0,
          age_day: 0,
        },
        angsuran: {
          schedule_angsuran_created: false,
          angsuran_accepted: false,
          nomor_pensiunan: '',
          norek: '',
          unit_id: '',
          fasilitas_id: '',
          nilai_plafond: 0,
          rate_bunga: 0,
          tenor: 0,
          tanggal_mulai: '',
          nilai_angsuran: 0,
          provisi_percentage: 0,
          provisi_nominal: 0,
          biaya_admin: 0,
          biaya_lain: 0,
          details: [],
        },
        refreshAngsuranBtn: false,
        createdSchedule: false,
        foto_profil: null,
        foto_ktp: null,
        foto_profil_preview: null,
        foto_ktp_preview: null,
        age_text_start: '',
        age_text_end: ''
      },
      displayedAngsuran: 0
    };
  },

  mounted() {
    emitter.on("AddNasabah", async (user) => {
      this.user = user;
      this.modalAdd = new bootstrap.Offcanvas("#offcanvasAddRight", {
        backdrop: false,
        keyboard: false,
      });
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
    formatRupiah(value) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        currencyDisplay: 'symbol',
        maximumFractionDigits: 0
      }).format(value);
    },
    calculateAge(birthDate) {
      let today = new Date();
      let birth = new Date(birthDate);

      let years = today.getFullYear() - birth.getFullYear();
      let months = today.getMonth() - birth.getMonth();
      let days = today.getDate() - birth.getDate();

      if (days < 0) {
        months--;
        let lastDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
        days += lastDayOfMonth;
      }

      if (months < 0) {
        years--;
        months += 12;
      }

      this.model.nasabah.age_year = years;
      this.model.nasabah.age_month = months;
      this.model.nasabah.age_day = days;

      this.model.age_text_start = `${this.model.nasabah.age_year} Tahun, ${this.model.nasabah.age_month} bulan, ${this.model.nasabah.age_day} hari`;
    },
    addMonths() {
      let newDate = new Date(this.model.nasabah.tanggal_lahir);
      let birthDate = new Date(this.model.nasabah.tanggal_lahir);
      newDate.setMonth(newDate.getMonth() + this.model.angsuran.tenor);

      let newYears = newDate.getFullYear() - birthDate.getFullYear();
      let newMonths = newDate.getMonth() - birthDate.getMonth();
      let newDays = newDate.getDate() - birthDate.getDate();

      if (newDays < 0) {
        newMonths--;
        let lastDayOfMonth = new Date(newDate.getFullYear(), newDate.getMonth(), 0).getDate();
        newDays += lastDayOfMonth;
      }

      if (newMonths < 0) {
        newYears--;
        newMonths += 12;
      }

      this.model.age_text_end = `${newYears + this.model.nasabah.age_year} Tahun, ${newMonths} bulan, ${newDays} hari`;
    },
    handleFileChange(event, type) {
      const file = event.target.files[0]
      if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
          if (type === 'nasabah') {
            this.model.foto_profil_preview = e.target.result
            this.model.foto_profil = file
          } else if (type === 'ktp') {
            this.model.foto_ktp_preview = e.target.result
            this.model.foto_ktp = file
          }
        }
        reader.readAsDataURL(file)
      }
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
    async calculateAngsuran() {
      if (
        this.model.angsuran.schedule_angsuran_created &&
        this.model.angsuran.nilai_plafond !== 0 &&
        this.model.angsuran.rate_bunga !== 0 &&
        this.model.angsuran.rate_bunga !== '' &&
        this.model.angsuran.tenor !== 0 &&
        this.model.angsuran.tenor !== ''
      ) {
        const annualInterestRate = this.model.angsuran.rate_bunga / 100;
        const months = this.model.angsuran.tenor;
        const principal = parseFloat(this.model.angsuran.nilai_plafond.replace(/Rp\.|\./g, ''));

        const monthlyInterestRate = annualInterestRate / 12;

        this.model.angsuran.nilai_angsuran = principal * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, months) / (Math.pow(1 + monthlyInterestRate, months) - 1);
        this.displayedAngsuran = Math.round(this.model.angsuran.nilai_angsuran);
        this.model.angsuran.nilai_angsuran = parseFloat(this.model.angsuran.nilai_angsuran);
        this.model.refreshAngsuranBtn = true
      }
    },

    async createScedule() {
      if (this.model.refreshAngsuranBtn) {
        let endpoint = `${BASEURL}/api/simulation`;
        let response = await axios.post(endpoint, this.model.angsuran, {
          headers: {
            Authorization: "Bearer " + this.$token(),
            "Content-Type": "multipart/form-data",
          },
        });
        this.model.angsuran.details = response.data.simulation;
        this.model.createdSchedule = true
      }
    },
    async confirmStore() {
      if (this.model.angsuran.schedule_angsuran_created) {
        if (!this.model.createdSchedule || !this.model.refreshAngsuranBtn) {
          Swal.fire("Kesalahan", "Nilai angsuran & Jadwal angsuran belum sesuai.", "error");
          return false;
        }
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
      let endpoint = `${BASEURL}/api/nasabah`;
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
            // text: "Apakah anda ingin print qrcode sekarang?",
            icon: "success",
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonText: "Close",
          }).then((result) => {
            this.closeComponent();
            // if (result.value) {
            //   this.viewCurrentQRCode(this.model.number);
            // } else {
            //   this.closeComponent();
            // }
          });
        }
      } catch (error) {
        this.loading = false
        console.error("Error store nasabah: ", error);
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

    refreshAngsuran() {
      this.model.refreshAngsuranBtn = false
      this.model.createdSchedule = false
      this.model.angsuran.details = []
    },
    closeComponent() {
      this.modalAdd.hide()
      this.resetForm()
      emitter.emit("fetchNasabahList")
    },
    resetForm() {
      this.model = {
        nasabah: {
          is_executing: false,
          nik: '',
          nama_lengkap: '',
          tempat_lahir: '',
          tanggal_lahir: '',
          jenis_kelamin: '',
          alamat: '',
          pensiun: '',
          flagging: '',
          flagging_nominal: 0,
          no_telepon: '',
          age_year: 0,
          age_month: 0,
          age_day: 0,
        },
        angsuran: {
          schedule_angsuran_created: false,
          angsuran_accepted: false,
          unit_id: '',
          fasilitas_id: '',
          nilai_plafond: 0,
          rate_bunga: 0,
          tenor: 0,
          tanggal_mulai: '',
          nilai_angsuran: 0,
          provisi_percentage: 0,
          provisi_nominal: 0,
          biaya_admin: 0,
          biaya_lain: 0,
          details: [],
        },
        refreshAngsuranBtn: false,
        createdSchedule: false,
        foto_profil: null,
        foto_ktp: null,
        foto_profil_preview: null,
        foto_ktp_preview: null,
      };
    },


    convertToExcel() {
      const workbook = new ExcelJS.Workbook();
      const worksheet = workbook.addWorksheet('Jadwal Angsuran Pinjaman');

      // Add header
      worksheet.addRow(['No', 'Tanggal Bayar', 'Angsuran', 'Pokok', 'Margin', 'Sisa Pokok']);

      // Add data rows
      this.model.angsuran.details.forEach(detail => {
        worksheet.addRow([
          detail.angsuran_ke,
          detail.tanggal_bayar,
          detail.angsuran,
          detail.pokok,
          detail.margin,
          detail.sisa_pokok
        ]);
      });

      // Save the workbook
      workbook.xlsx.writeBuffer().then(buffer => {
        const blob = new Blob([buffer], { type: 'application/octet-stream' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'jadwal_angsuran_pinjaman.xlsx';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      });
    },
    convertToPDF() {
      const element = document.getElementById('table-angsuran');
      const opt = {
        margin: 1,
        filename: 'jadwal_angsuran_pinjaman.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 1 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
      };
      html2pdf().from(element).set(opt).save();
    },
    convertToImg() {
      const element = document.getElementById('table-angsuran');
      html2canvas(element).then(canvas => {
        const link = document.createElement('a');
        link.href = canvas.toDataURL('image/png');
        link.download = 'jadwal_angsuran_pinjaman.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }).catch(function (error) {
        console.error('Oops, something went wrong!', error);
      });
    },
    convertNominal(nominal) {
      let cleanedValue = nominal
        .replace(/Rp\.?\s?/g, '')
        .replace(/\./g, '')
        .replace(/,/g, '.')
        .trim()
      return parseFloat(cleanedValue) || 0;
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
  },
  computed: {},
  watch: {
    'model.angsuran.nilai_plafond': function () {
      this.refreshAngsuran()
      if (typeof this.model.angsuran.nilai_plafond == 'string') {
        this.model.angsuran.provisi_nominal = this.model.angsuran.nilai_plafond.replace(/[^0-9]/g, "") * (this.model.angsuran.provisi_percentage / 100)
      }
    },
    'model.angsuran.rate_bunga': function () {
      this.refreshAngsuran()
    },
    'model.angsuran.tenor': function () {
      this.refreshAngsuran()
      this.addMonths()
    },
    'model.angsuran.tanggal_mulai': function () {
      this.refreshAngsuran()
    },
    'model.nasabah.tanggal_lahir': function (val) {
      this.calculateAge(val)
    },
    'model.angsuran.provisi_percentage': function () {
      if (typeof this.model.angsuran.nilai_plafond == 'string') {
        this.model.angsuran.provisi_nominal = this.model.angsuran.nilai_plafond.replace(/[^0-9]/g, "") * (this.model.angsuran.provisi_percentage / 100)
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