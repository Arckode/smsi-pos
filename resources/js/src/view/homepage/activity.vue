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
                    <li style="background-image: url(hp/images/homepage/header/deal.jpeg)">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="col-md-8 col-md-offset-2 col-md-push-4 js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc biru-header">
                                        <span>Gallery Kegiatan</span>
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

        <div id="kegiatan">
            <div class="container-kegiatan">
                <a id="button-kegiatan" class="uk-button uk-button-default" href="#kegiatan1" uk-toggle>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img :src="asset('hp/images/kegiatan/f1.jpeg')" width="1800" height="1200" alt="" />
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">
                                MOU Dengan PT. Bank KB Bukopin, Tbk
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="container-kegiatan">
                <a id="button-kegiatan" class="uk-button uk-button-default" href="#kegiatan2" uk-toggle>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img :src="asset('hp/images/kegiatan/1a.jpeg')" width="1800" height="1200" alt="" />
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">
                                Sosialisasi pensiunan Taspen dan ASABRI
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="container-kegiatan">
                <a id="button-kegiatan" class="uk-button uk-button-default" href="#kegiatan3" uk-toggle>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img :src="asset('hp/images/kegiatan/f3.jpeg')" width="1800" height="1200" alt="" />
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">
                                Kerjasama antara Koperasi Nusa Sejahtera dengan LPDB
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="container-kegiatan">
                <a id="button-kegiatan" class="uk-button uk-button-default" href="#kegiatan4" uk-toggle>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img :src="asset('hp/images/kegiatan/d1.jpeg')" width="1800" height="1200" alt="" />
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">
                                Kerjasama Pembiayaan Channeling Koperasi Nusa Sejahtera &
                                Koperasi Sahabat Mitra Sejati
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- <div class="modal-kegiatan"> -->
        <div id="kegiatan1" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <button class="uk-modal-close-outside" type="button" uk-close></button>
                <div class="uk-card uk-card-default">
                    <div>
                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                            uk-slideshow="animation: pull">
                            <ul class="uk-slideshow-items">
                                <li>
                                    <img :src="asset('hp/images/kegiatan/f1.jpeg')" alt="" uk-cover />
                                </li>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                                uk-slidenav-previous uk-slideshow-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#"
                                uk-slidenav-next uk-slideshow-item="next"></a>
                        </div>
                    </div>

                    <div class="uk-card-body">
                        <h3 class="uk-card-title">MOU Dengan PT. Bank KB Bukopin, Tbk</h3>
                    </div>
                </div>
                <p>
                    Dalam rangka memperkuat pangsapasar kredit pensiunan dan memberikan
                    layanan terbaik, maka terjalinlah kerja sama antara koperasi nusa
                    sejahtera dengan PT. Bank KB Bukopin, Tbk
                </p>
            </div>
        </div>
        <div id="kegiatan2" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <button class="uk-modal-close-outside" type="button" uk-close></button>
                <div class="uk-card uk-card-default">
                    <div>
                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                            uk-slideshow="animation: pull">
                            <ul class="uk-slideshow-items">
                                <li>
                                    <img :src="asset('hp/images/kegiatan/1a.jpeg')" alt="" uk-cover />
                                </li>
                                <li>
                                    <img :src="asset('hp/images/kegiatan/2a.jpeg')" alt="" uk-cover />
                                </li>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                                uk-slidenav-previous uk-slideshow-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#"
                                uk-slidenav-next uk-slideshow-item="next"></a>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">
                            Sosialisasi pensiunan Taspen dan ASABRI
                        </h3>
                    </div>
                </div>
                <p>
                    Koperasi nusa sejahtera melakukan sosialisasi terkait pinjaman
                    pensiuanan
                </p>
            </div>
        </div>
        <div id="kegiatan3" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <button class="uk-modal-close-outside" type="button" uk-close></button>
                <div class="uk-card uk-card-default">
                    <div>
                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                            uk-slideshow="animation: pull">
                            <ul class="uk-slideshow-items">
                                <li>
                                    <img :src="asset('hp/images/kegiatan/f3.jpeg')" alt="" uk-cover />
                                </li>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                                uk-slidenav-previous uk-slideshow-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#"
                                uk-slidenav-next uk-slideshow-item="next"></a>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">
                            Kerjasama antara Koperasi Nusa Sejahtera dengan LPDB
                        </h3>
                    </div>
                </div>
                <p><!-- Desc Here --></p>
            </div>
        </div>
        <div id="kegiatan4" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <button class="uk-modal-close-outside" type="button" uk-close></button>
                <div class="uk-card uk-card-default">
                    <div>
                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                            uk-slideshow="animation: pull">
                            <ul class="uk-slideshow-items">
                                <li>
                                    <img :src="asset('hp/images/kegiatan/d1.jpeg')" alt="" uk-cover />
                                </li>
                                <li>
                                    <img :src="asset('hp/images/kegiatan/d2.jpeg')" alt="" uk-cover />
                                </li>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                                uk-slidenav-previous uk-slideshow-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#"
                                uk-slidenav-next uk-slideshow-item="next"></a>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">
                            Kerjasama Pembiayaan Channeling Koperasi Nusa Sejahtera &
                            Koperasi Sahabat Mitra Sejati
                        </h3>
                    </div>
                </div>
                <p>
                    <!-- Desc Here -->
                </p>
            </div>
        </div>
        <!-- </div> -->
        <!-- close div kegiatan -->

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