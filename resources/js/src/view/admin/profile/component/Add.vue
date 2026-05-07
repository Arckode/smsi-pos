<template>
  <!-- offcanvas Add New Document -->
  <div class="offcanvas offcanvas-end responsive-offcanvas" tabindex="-1" id="offcanvasBrowseUser"
    data-bs-keyboard="false" aria-labelledby="offcanvasAddRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddRightLabel">Tambah User Baru</h5>
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
                  <h6 class="m-0">Browse User Terdaftar</h6>
                  <p class="m-0 text-sm">Unit {{ unit }}</p>
                </div>
                <i class="fas fa-chevron-down position-absolute end-0 me-3"></i>
              </button>
            </h5>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
              data-bs-parent="#accordionDocumentLabels">
              <div class="accordion-body text-sm">
                <div class="input-group mb-3">
                  <span class="input-group-text text-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24"
                      stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                      </path>
                    </svg>
                  </span>
                  <input type="text" class="form-control" placeholder="Search Nama" v-model="meta.search">
                </div>
                <div class="table-responsive table-wrap p-0">
                  <table class="table align-items-center mb-0">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class="d-flex flex-column p-2" role="group" aria-label="Basic radio toggle button group">
                          <div class="w-100" v-for="(user, index) in filteredUsers" :key="index">
                            <input type="radio" class="btn-check" v-model="selectedUser" :name="'radiotable'"
                              :id="'radiotable' + index" :value="user">
                            <label class="btn btn-white mb-2 w-100 text-start" :for="'radiotable' + index">
                              <p class="m-0 fw-bold">{{ user.name }}</p>
                              <p class="m-0 fw-normal">{{ user.email }}</p>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="alert" :class="{ 'alert-danger': selectedUser == '', 'alert-success': selectedUser != '' }"
          role="alert">
          <h5 class="mb-0 alert-heading">Selected User</h5>
          <p class="m-0 text-sm">Berikut ini informasi user yang anda pilih</p>
          <hr>
          <p class="mb-0 text-sm">Nama</p>
          <div class="d-flex flex-wrap">
            <p class="fw-bold">{{ selectedUser.name }}</p>
          </div>
          <p class="mb-0 text-sm">Email</p>
          <div class="d-flex flex-wrap">
            <p class="fw-bold">{{ selectedUser.email }}</p>
          </div>
        </div>
        <div class="position-absolute end-0 bottom-0 me-3">
          <button type="button" class="btn btn-primary rounded-1" @click.prevent="confirmStore">
            Pilih
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import { emitter } from "../../../../../eventEmitter.js";
export default {
  name: "AddDocumentOffcanvas",
  data() {
    return {
      meta: {
        search: ''
      },
      collection: {
        users: [],
      },
      model: {
        unit_id: '',
        erp: true,
      },
      modalBrowseUser: '',
      unit: '',
      selectedUser: '',
    };
  },

  mounted() {
    emitter.on("browseUser", async ([id, unit]) => {
      this.modalBrowseUser = new bootstrap.Offcanvas("#offcanvasBrowseUser", {
        backdrop: false,
        keyboard: false,
      });

      this.model.unit_id = id
      this.unit = unit

      await this.fetchUserByUnit();
      await this.openComponent();
    });
  },

  methods: {
    asset(path) {
      return `${BASEURL}${path}`;
    },
    async openComponent() {
      this.modalBrowseUser.show();
    },
    async fetchUserByUnit() {
      let endpoint = `${BASEURL}/api/secretary/users/load/${this.model.unit_id}`;
      let response = await axios.get(endpoint, {
        headers: {
          Authorization: "Bearer " + this.$token(),
        },
      });
      this.collection.users = response.data.data.users
    },
    async confirmStore() {
      if (this.selectedUser == "") {
        Swal.fire("Kesalahan", "User harus dipilih.", "error");
        return false;
      }

      this.model.name = this.selectedUser.name
      this.model.email = this.selectedUser.email
      this.model.password = this.selectedUser.password
      this.model.password_confirmation = this.selectedUser.password

      Swal.fire({
        title: "Simpan?",
        text: "Pastikan user yang dipilih sudah benar",
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
      let endpoint = `${BASEURL}/api/secretary/users`;
      try {
        Swal.showLoading();
        let response = await axios.post(endpoint, this.model, {
          headers: {
            Authorization: "Bearer " + this.$token(),
            "Content-Type": "multipart/form-data",
          },
        });
        Swal.close();
        if (response) {
          Swal.fire({
            title: "Penyimpanan Berhasil!",
            icon: "success",
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonText: "Oke",
          }).then((result) => {
            if (result.value) {
              this.closeComponent();
              emitter.emit("fetchUserList");
            }
          });
        }
      } catch (error) {
        console.log(error.response.data.message);
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
    closeComponent() {
      this.modalBrowseUser.hide()
      this.resetForm()
    },
    resetForm() {
      this.model.unit_id = ''
      this.model.name = ''
      this.model.password = ''
      this.model.password_confirmation = ''
      this.selectedUser = ''
      this.unit = ''
    }
  },
  computed: {
    filteredUsers() {
      const searchQuery = this.meta.search.toLowerCase();
      return this.collection.users.filter(user => {
        return user.name.toLowerCase().includes(searchQuery);
      });
    }
  },
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

.table-wrap {
  height: 50vh;
  overflow-y: auto;
}

.btn-check:checked+.btn {
  border: 2px solid #774dd3;
}
</style>