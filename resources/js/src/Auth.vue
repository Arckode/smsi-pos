<template>
    <!-- <router-view></router-view> -->
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container m-0">
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6">EDOC TRACKING</h3>
                                    <p class="mb-0">Welcome back<br> Please enter your login details.</p>
                                </div>
                                <div class="card-body">
                                    <form role="form">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="emailField" placeholder="Enter"
                                                v-model="data.login.email">
                                            <label for="emailField">Email</label>
                                            <p class="text-danger text-sm" v-if="errors.email">{{ errors.email[0] }}</p>
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="form-floating flex-grow-1">
                                                <input v-bind:type="showPassword ? 'text' : 'password'"
                                                    class="form-control" id="passField" placeholder="Enter"
                                                    v-model="data.login.password">
                                                <label for="passField">Password</label>
                                            </div>
                                            <a v-if="showPassword" class="input-group-text" id="basic-addon2"
                                                @click="togglePasswordVisibility">
                                                <i class="fas fa-eye-slash" style="font-size: 15px;">
                                                    <span class="sr-only text-sm">
                                                        Hide
                                                    </span>
                                                </i>
                                            </a>
                                            <a v-else class="input-group-text" id="basic-addon2"
                                                @click="togglePasswordVisibility">
                                                <i class="fas fa-eye" style="font-size: 15px;">
                                                    <span class="sr-only text-sm">
                                                        Show
                                                    </span>
                                                </i>
                                            </a>
                                            <p class="text-danger text-sm" v-if="errors.password">{{ errors.password[0]
                                                }}</p>
                                        </div>

                                        <div class="text-center">
                                            <button v-if="!loading" type="button" class="btn btn-dark w-100 mt-4 mb-3"
                                                @click.prevent="login" :disabled="loading">
                                                Sign in
                                            </button>
                                            <button v-else class="btn btn-dark w-100 mt-4 mb-3" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="background-image:url('cud/img/image-sign-in.jpg')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                    <h6 class="text-dark text-sm m-0 p-0">Copyright © 2024 Edoc-Tracking by MMS IT Team.
                    </h6>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import $ from "jquery";
window.BASEURL = ''
export default {
    name: "App",
    data() {
        return {
            meta: {

            },
            menu: '',
            data: {
                login: {
                    email: '',
                    password: ''
                },
                register: {
                    fullname: '',
                    email: '',
                    username: '',
                    password: '',
                }
            },
            showPassword: false,
            errors: {},
            loading: false
        }
    },

    mounted() {
        document.addEventListener('keydown', this.handleKeyPress);
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        async login() {
            let endpoint = `${BASEURL}/api/login`
            try {
                this.loading = true
                let response = await axios.post(endpoint, this.data.login)
                console.log(response)
                localStorage.setItem('user', JSON.stringify(response.data.token))
                this.loading = false
                this.$router.push({ name: 'admin.dashboard' }).then(() => { this.$router.go(0) })
            } catch (error) {
                this.loading = false
                this.errors = {}
                if (error.response.data.errors) {
                    this.errors = error.response.data.errors;
                }
                this.$swal.fire({
                    icon: 'error',
                    title: "Ooops..",
                    html: 'Something went wrong!<br> ' + error.response.data.message,
                    showConfirmButton: false,
                    timer: 3000,
                });
            }
        },
        async register() {
            let endpoint = `${BASEURL}/api/register`
            try {
                let response = await axios.post(endpoint, this.data.register)
                if (response.data.status) {
                    this.$swal.fire({
                        title: "Success",
                        text: response.data.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            } catch (error) {
                console.log(error.response.data.errors)
                this.$swal.fire({
                    title: "Failed",
                    text: error.response.data.message,
                    icon: 'error',
                });
            }
        },
        togglePasswordVisibility() {
            this.showPassword = !this.showPassword;
        },
        handleKeyPress(event) {
            if (event.key === 'Enter') {
                this.login();
            }
        }
    }
}
</script>