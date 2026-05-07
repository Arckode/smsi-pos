<template>
    <nav id="fh5co-main-nav" role="navigation">
        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle active"><i></i></a>
        <div class="js-fullheight fh5co-table">
            <div class="fh5co-table-cell js-fullheight">
                <h1 class="text-center">
                    <!-- <a class="fh5co-logo" href="index.html">Words</a> -->
                    <a class="fh5co-logo" href="index.html"><span>Koperasi</span>
                        <p class="nusa">Nusa</p>
                        <p class="sejahtera">Sejahtera</p>
                    </a>
                </h1>
                <ul>
                    <li v-for="(menuItem, index) in menuItems" :key="index">
                        <a v-on:click="navigateToDashboard(menuItem.route)" href="#">{{ menuItem.label }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="fh5co-page">
        <header>
            <div class="container">
                <div class="fh5co-navbar-brand">
                    <div class="row">
                        <div class="col-xs-6">
                            <h1 class="text-left">
                                <a class="fh5co-logo" href="index.html"><span>Koperasi</span>
                                    <p class="nusa">Nusa</p>
                                    <p class="sejahtera">Sejahtera</p>
                                </a>
                            </h1>
                        </div>
                    </div>
                    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
                </div>
            </div>
        </header>
        <aside id="fh5co-hero" class="js-fullheight">
            <div class="flexslider js-fullheight">
                <ul class="slides">
                    <li style="background-image: url(hp/images/homepage/header/cs.jpg)">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="col-md-8 col-md-offset-2 col-md-push-4 js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc biru-header">
                                        <span>Informasi Kontak</span>
                                        <h2>Koperasi Nusa Sejahtera</h2>
                                        <!-- <p class="fh5co-lead">
                        Designed with <i class="icon-heart3"></i> by the fine
                        folks at
                        <a href="http://freehtml5.co" target="_blank"
                          >FreeHTML5.co</a
                        >
                      </p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </aside>

        <div id="fh5co-contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-push-3 animate-box">
                        <h3>Our Address</h3>
                        <ul class="contact-info">
                            <li>
                                <i class="icon-location-pin"></i>Ruko Gateway E 19, Waru
                                Sidoarjo 61256
                            </li>
                            <li><i class="icon-phone2"></i>(031)855525657</li>
                            <li>
                                <i class="icon-mail"></i><a href="#">nusasejahtera@yahoo.com</a>
                            </li>
                            <li>
                                <i class="icon-globe2"></i><a href="#">www.koperasinusasejahtera.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- <h3 class="section-title">Koperas Nusa Sejahtera</h3> -->
                            <!-- <h1 class="text-left" style="padding: 0"> -->
                            <a class="fh5co-logo" href="#" v-on:click="navigateToDashboard(home)"
                                style="line-height: 1.2"><span>Koperasi</span>
                                <p class="nusa">Nusa</p>
                                <p class="sejahtera">Sejahtera</p>
                            </a>
                            <!-- </h1> -->
                            <p>
                                Koperasi Nusa Sejahtera adalah koperasi serba usaha yang
                                berkedudukan di Waru Sidoarjo, dibentuk pertama kali pada
                                tanggal 12 Juni 2012 dengan keinginan menjadi koperasi yang
                                dapat terpercaya, terbaik dan terkuat sebagai pilihan
                                masyarakat dan dapat beroperasi di seluruh Indonesia melalui
                                kemitraan.
                            </p>
                        </div>

                        <div class="col-md-4 col-md-push-1">
                            <h3 class="section-title">Links</h3>
                            <ul>
                                <li v-for="(menuItem, index) in menuItems" :key="index">
                                    <a v-on:click="navigateToDashboard(menuItem.route)" href="#">{{ menuItem.label
                                        }}</a>
                                </li>
                                <!-- <li><a href="index.html">Beranda</a></li>
                                <li><a href="work.html">Kegiatan</a></li>
                                <li><a href="about.html">Tentang Kami</a></li>
                                <li><a href="contact.html">Kontak</a></li> -->
                            </ul>
                        </div>

                        <div class="col-md-4">
                            <h3 class="section-title">Contact Info</h3>
                            <ul>
                                <li>
                                    <i class="icon-location-pin"></i>Ruko Gateway E 19, Waru
                                    Sidoarjo 61256
                                </li>
                                <li><i class="icon-phone2"></i>(031)855525657</li>
                                <li><i class="icon-mail"></i>nusasejahtera@yahoo.com</li>
                                <li>
                                    <i class="icon-globe2"></i>www.koperasinusasejahtera.com
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</template>

<script>
import $ from "jquery";
window.BASEURL = ''
export default {
    name: "home",
    data() {
        return {
            menuItems: [
                { label: 'Beranda', route: 'home' },
                { label: 'Kegiatan', route: 'activity' },
                { label: 'Tentang Kami', route: 'about' },
                { label: 'Kontak', route: 'contact' },
            ]
        }
    },
    mounted() {

    },
    destroyed() {

    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        navigateToDashboard(route) {
            this.$router.push({ name: route }).then(() => {
                this.$router.go(0);
            });
        }
    }
}

</script>