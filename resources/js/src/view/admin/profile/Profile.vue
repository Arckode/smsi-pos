<template>
    <div class="pt-7 pb-6 bg-cover"
        style="background-image: url('/cud/img/header-orange-purple.jpg'); background-position: bottom;"></div>
    <div class="container">
        <div class="card card-body py-2 bg-transparent shadow-none">
            <div class="row">
                <div class="col-auto">
                    <div v-if="!isEditing"
                        class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                        <img :src="user.picture ? asset(`${user.picture}`) : asset('/profile_pictures/default.jpg')"
                            alt="profile_image" class="w-100 profile-picture">
                    </div>
                    <div v-else
                        class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4"
                        :style="{
                            backgroundImage: previewImage ? 'url(' + previewImage + ')' : 'url(/cud/img/header-orange-purple.jpg)',
                            backgroundPosition: 'center',
                            backgroundRepeat: 'no-repeat',
                            backgroundSize: 'cover'
                        }">
                        <label for="fileInput" class="w-100"
                            style="height:152px; display:flex; align-items: center; justify-content: center; position: relative;">
                            <input type="file" ref="fileInput" @change="handleFileChange" id="fileInput"
                                accept="image/*"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                            <i class="fas fa-camera-retro" style="height:45px; position:absolute;"></i>
                        </label>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h3 class="mb-0 font-weight-bold">
                            {{ user.name }}
                        </h3>
                        <h5 class="mb-0">
                            {{ user.unit.name }}
                        </h5>
                        <p class="mb-0">
                            {{ user.email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-3 py-3">
        <div class="row">
            <div class="col-12 col-xl-4 mb-4">
                <div class="card border shadow-xs h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 col-9">
                                <h6 class="mb-0 font-weight-semibold text-lg">Profile information</h6>
                                <p class="text-sm mb-1">Edit the information about you.</p>
                            </div>
                            <div class="col-md-4 col-3 text-end">
                                <button v-if="isEditing" type="button" class="btn btn-white btn-icon px-2 py-2"
                                    @click="toggleEdit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 352 512"
                                        fill="currentColor">
                                        <path
                                            d="M242.7 256l100.1-100.1c12.3-12.3 12.3-32.2 0-44.5l-22.2-22.2c-12.3-12.3-32.2-12.3-44.5 0L176 189.3 75.9 89.2c-12.3-12.3-32.2-12.3-44.5 0L9.2 111.5c-12.3 12.3-12.3 32.2 0 44.5L109.3 256 9.2 356.1c-12.3 12.3-12.3 32.2 0 44.5l22.2 22.2c12.3 12.3 32.2 12.3 44.5 0L176 322.7l100.1 100.1c12.3 12.3 32.2 12.3 44.5 0l22.2-22.2c12.3-12.3 12.3-32.2 0-44.5L242.7 256z" />
                                    </svg>
                                </button>
                                <button v-if="!isEditing" type="button" class="btn btn-white btn-icon px-2 py-2"
                                    @click="toggleEdit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                </button>
                                <button v-else type="button" class="btn btn-white btn-icon px-2 py-2"
                                    @click="confirmSave">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"
                                        fill="currentColor">
                                        <path
                                            d="M433.9 129.9l-83.9-83.9A48 48 0 0 0 316.1 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V163.9a48 48 0 0 0 -14.1-33.9zM224 416c-35.3 0-64-28.7-64-64 0-35.3 28.7-64 64-64s64 28.7 64 64c0 35.3-28.7 64-64 64zm96-304.5V212c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12V108c0-6.6 5.4-12 12-12h228.5c3.2 0 6.2 1.3 8.5 3.5l3.5 3.5A12 12 0 0 1 320 111.5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">

                            <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                <div class="input-group flex-nowrap" style="align-items: center;">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 90px;">Unit</span>
                                    <p class="text-secondary"
                                        style="margin:0; padding-left:0.75rem; font-size:0.875rem; border-top:1px solid transparent">
                                        {{ user.unit.name }}</p>
                                </div>
                            </li>
                            <br>
                            <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                <div v-if="!isEditing" class="input-group flex-nowrap pb-2"
                                    style="align-items: center;">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 90px;">Name</span>
                                    <p class="text-secondary"
                                        style="margin:0; padding-left:0.75rem; font-size:0.875rem; border-top:1px solid transparent">
                                        {{ user.name }}</p>
                                </div>
                                <div v-else class="input-group flex-nowrap pb-2" style="align-items: center;">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 90px;">Name</span>
                                    <input type="text" class="form-control" aria-describedby="addon-wrapping"
                                        v-model="model.name">
                                </div>
                            </li>

                            <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                <div v-if="!isEditing" class="input-group flex-nowrap pb-2"
                                    style="align-items: center;">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 90px;">Email</span>
                                    <p class="text-secondary"
                                        style="margin:0; padding-left:0.75rem; font-size:0.875rem; border-top:1px solid transparent">
                                        {{ user.email }}</p>
                                </div>
                                <div v-else class="input-group flex-nowrap pb-2" style="align-items: center;">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 90px;">Email</span>
                                    <input type="text" class="form-control" aria-describedby="addon-wrapping"
                                        v-model="model.email">
                                </div>
                            </li>

                            <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                        v-model="changePassword" :disabled="!isEditing" @change="resetPassword">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Change Password</label>
                                </div>
                                <div class="input-group flex-nowrap pb-2" style="align-items: center;"
                                    v-if="changePassword">
                                    <span class="input-group-text" style="width: 90px;">Password</span>
                                    <input v-bind:type="showPassword ? 'text' : 'password'" class="form-control"
                                        aria-label="Password" v-model="model.password">
                                    <button v-if="showPassword" class="btn btn-outline-secondary mb-0" type="button"
                                        @click="togglePasswordVisibility">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                    <button v-else class="btn btn-outline-secondary mb-0" type="button"
                                        @click="togglePasswordVisibility">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <p v-if="changePassword" class="text-sm" :class="{ 'text-danger': model.password.length < 8, 'text-success': model.password.length >= 8 }">{{ model.password.length < 8 ? 'Password length must be over 8 characters!' : 'Looks good!'}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-xs text-muted text-lg-start">
                            Copyright
                            ©
                            2024
                            MMS IT Team.
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-xs text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-xs text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-xs text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link text-xs pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import Chart from 'chart.js/auto';
import $ from "jquery";
import Echo from 'laravel-echo'; // Import Laravel Echo or your WebSocket library
import Swal from 'sweetalert2';
window.BASEURL = ''

export default {
    name: "Admin.Index",
    data() {
        return {
            meta: {

            },
            user: {
                name: '',
                email: '',
                password: '',
                unit_id: 0,
                picture: '',
                unit: [],
            },
            model: {
                name: '',
                email: '',
                password: '',
                picture: '',
                unit_id: 0,
                erp: null,
            },
            editedUser: {
            },
            isEditing: false,
            selectedFile: null,
            changePassword: false,
            showPassword: false,
            previewImage: null
        }
    },
    mounted() {
        this.fetchCurrentUser();
    },

    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async fetchCurrentUser() {
            let endpoint = `${BASEURL}/api/user`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                if (response.data) {
                    this.user = response.data
                }
                this.model.unit_id = this.user.unit.id
            } catch (error) {
                console.log('Logout error: ', error)
            }
        },
        toggleEdit() {
            this.isEditing = !this.isEditing
            this.changePassword = false
            this.previewImage = null
            if (this.isEditing) {
                this.model = { ...this.user };
            }
            this.model.password = ''
        },
        handleFileChange(event) {
            this.model.picture = event.target.files[0];
            this.previewImage = URL.createObjectURL(this.model.picture);
        },
        resetPassword() {
            if (!this.changePassword) {
                this.model.password = '';
            }
        },
        togglePasswordVisibility() {
            this.showPassword = !this.showPassword;
        },
        async confirmSave() {
            console.log(this.changePassword, this.model.password.length)
            if (this.changePassword) {
                if(this.model.password == ''){
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Password can't be empty!",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return false;
                }
                if(this.model.password.length < 8){
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Password must be over 8 character!",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return false;
                }
            }
            console.log(this.model)
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#f19937",
                confirmButtonText: "Save"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.toggleUpdate()
                }
            });
        },
        async toggleUpdate() {
            let endpoint = `${BASEURL}/api/users/${this.user.id}?_method=PUT`
            try {
                Swal.showLoading()
                if (this.changePassword) {
                    this.model.password_confirmation = this.model.password
                    await this.changePass()
                }
                await this.update()

                Swal.close()
                Swal.fire({
                    icon: "success",
                    text: "User Profile Successfully Updated",
                    showConfirmButton: false,
                    timer: 2000,
                    didOpen: () => {
                        this.toggleEdit()
                        this.fetchCurrentUser()
                    }
                })

            } catch (error) {
                console.log(error)
            }
        },
        async update() {
            let endpoint = `${BASEURL}/api/users/${this.user.id}?_method=PUT`
            try {
                Swal.showLoading()
                let response = await axios.post(endpoint, this.model, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': 'Bearer ' + this.$token()
                    }
                })
                Swal.close()
            } catch (error) {
                console.log(error)
                return false
            }
        },
        async changePass() {
            let endpoint = `${BASEURL}/api/change-password`
            try {
                Swal.showLoading()
                let response = await axios.post(endpoint, this.model, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': 'Bearer ' + this.$token()
                    }
                })
                Swal.close()
            } catch (error) {
                console.log(error)
                return false
            }
        }
    }
}
</script>

<style scoped>
.nb-bb {
    border: 0px;
    border-bottom: 1px solid grey;
}

.h-28 {
    height: 28px;
}

.profile-picture {
    height: 100%;
    /* Set the height of the container */
    display: flex;
    /* Use flexbox for centering */
    justify-content: center;
    /* Center horizontally */
    align-items: center;
    /* Center vertically */
}

.profile-picture img {
    max-height: 100%;
    /* Ensure the image fills the height */
    max-width: 100%;
    /* Allow the image to maintain aspect ratio */
}
</style>