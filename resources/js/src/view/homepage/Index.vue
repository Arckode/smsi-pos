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
                                <a class="fh5co-logo" href="#"
                                    v-on:click="navigateToDashboard(home)"><span>Koperasi</span>
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
                                        <h2>Memberikan Layanan Terbaik</h2>
                                        <p>
                                            Siap Membantu Menjawab Pertanyaan, Memberikan Informasi
                                            Produk dan Layanan, atau Membantu dalam Menyelesaikan
                                            Masalah yang Terkait.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li style="background-image: url(hp/images/homepage/header/deal.jpeg)">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="col-md-8 col-md-offset-2 col-md-push-4 js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc biru-header">
                                        <h2>Menjunjung Tinggi Keamanan dan Kenyamanan</h2>
                                        <p>Proses Transaksi Mudah, Aman dan Terjamin.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li style="background-image: url(hp/images/homepage/header/happy.jpg)">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="col-md-8 col-md-offset-2 col-md-push-4 js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc biru-header">
                                        <h2>Pinjaman Pensiun</h2>
                                        <p>Dengan Bunga Rendah dan Syarat Mudah.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </aside>
        <div id="whyus-section" class="animate-box">
            <div class="whyus-kiri">
                <h1>Kenapa memilih Koperasi Nusa Sejahtera?</h1>
                <p>Bergabunglah dengan kami, dan dapatkan banyak keunggulannya</p>
            </div>
            <div class="whyus-kanan">
                <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1"
                    uk-slider="autoplay: true; autoplay-interval:3000;">
                    <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@m uk-grid">
                        <li>
                            <div class="uk-panel">
                                <div>
                                    <div class="uk-card biru uk-card-secondary uk-card-body">
                                        <h3 class="uk-card-title">Kemudahan Modal</h3>
                                        <p>
                                            Menjadi koperasi yang bermanfaat bagi anggota dan
                                            menjunjung tinggi prinsip dasar koperasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-panel">
                                <div>
                                    <div class="uk-card biru uk-card-secondary uk-card-body">
                                        <h3 class="uk-card-title">Professional</h3>
                                        <p>
                                            Pengelolaan secara profesional, transparan dan
                                            kehati-hatian.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-panel">
                                <div>
                                    <div class="uk-card biru uk-card-secondary uk-card-body">
                                        <h3 class="uk-card-title">Terpercaya</h3>
                                        <p>
                                            Senantiasa mengutamakan kerja sama dan memberikan
                                            pelayanan terbaik.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
                        uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
                        uk-slider-item="next"></a>
                </div>
            </div>
        </div>

        <div id="fh5co-featured">
            <div class="container-fluid">
                <div class="row">
                    <div class="post-entry">
                        <div class="col-md-6 col-md-push-6 nopaddingbottom animate-box">
                            <div class="post-image" style="background-image: url(hp/images/homepage/profile/p.jpeg)">
                            </div>
                        </div>
                        <div class="col-md-6 col-md-pull-5 animate-box">
                            <div class="display-tc">
                                <div class="desc">
                                    <h3>
                                        Koperasi Terpercaya Untuk Mengembangkan Usaha &
                                        Meningkatkan Kesejahteraan Anggota
                                    </h3>
                                    <p>
                                        Koperasi Nusa Sejahtera adalah koperasi serba usaha yang
                                        berkedudukan di Waru Sidoarjo, dibentuk pertama kali pada
                                        tanggal 12 Juni 2012 dengan keinginan menjadi koperasi
                                        yang dapat terpercaya, terbaik dan terkuat sebagai pilihan
                                        masyarakat dan dapat beroperasi di seluruh Indonesia
                                        melalui kemitraan.
                                    </p>
                                    <a class="new-button" href="#" v-on:click="navigateToDashboard(about)">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="mitra-usaha" style="
          background-image: linear-gradient(
              rgba(255, 255, 255, 0.5),
              rgba(255, 255, 255, 0.5)
            ),
            url(hp/images/homepage/mitra/m1.jpg);
          background-size: cover;
        " class="animate-box">
            <div class="mitra-atas">
                <h1>Mitra Usaha Kami</h1>
            </div>
            <div class="mitra-bawah">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                    uk-slider="autoplay: true; autoplay-interval: 2000;">
                    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-4@m">
                        <li>
                            <img :src="asset('hp/images/homepage/mitra/bukopinsyariah.png')" width="400" height="600"
                                alt="" />
                        </li>
                        <li>
                            <img :src="asset('hp/images/homepage/mitra/bukopoin.png')" width="400" height="600"
                                alt="" />
                        </li>
                        <li>
                            <img :src="asset('hp/images/homepage/mitra/ksp-sahabat.png')" width="400" height="600"
                                alt="" />
                        </li>
                        <li>
                            <img :src="asset('hp/images/homepage/mitra/sheiljedang.png')" width="400" height="600"
                                alt="" />
                        </li>
                        <li>
                            <img :src="asset('hp/images/homepage/mitra/lpdb-kumkn.png')" width="400" height="600"
                                alt="" />
                        </li>
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
                        uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
                        uk-slider-item="next"></a>
                </div>
            </div>
        </div>

        <div id="layanan-usaha" class="animate-box">
            <div class="layanan-atas">
                <h1>Layanan Usaha</h1>
            </div>
            <div class="layanan-bawah">
                <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                    <div class="uk-card-media-left uk-cover-container">
                        <img :src="asset('hp/images/homepage/jasa/happy.jpg')" alt="" uk-cover />
                        <canvas width="600" height="400"></canvas>
                    </div>
                    <div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Kredit Serba Guna</h3>
                            <p>
                                Kredit yang diberikan oleh koperasi simpan pinjam kepada
                                anggota untuk memenuhi kebutuhan finansial sesuai dengan
                                keinginan dan kebutuhan masing-masing. Kredit Serba Guna dapat
                                digunakan untuk berbagai macam keperluan, mulai dari biaya
                                pendidikan, renovasi rumah, modal usaha, hingga kebutuhan
                                konsumtif lainnya.
                            </p>
                            <ul>
                                <li>Modal Kerja / Usaha</li>
                                <li>Pendidikan</li>
                                <li>Lain-lain</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                    <div class="uk-flex-last@s uk-card-media-right uk-cover-container">
                        <img :src="asset('hp/images/homepage/jasa/pensiunan.jpg')" alt="" uk-cover />
                        <canvas width="600" height="400"></canvas>
                    </div>
                    <div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Kredit Pensiun</h3>
                            <p>
                                Kredit yang diberikan kepada pensiunan atau calon pensiunan
                                yang membutuhkan dana tambahan untuk memenuhi kebutuhan
                                finansial. Kredit Pensiun dengan bunga yang rendah dan jangka
                                waktu yang fleksibel sehingga pensiunan dapat memperoleh dana
                                yang dibutuhkan dengan mudah Khusus untuk Pensiunan :
                            </p>
                            <ul>
                                <li>Pegawai Negri Sipil (PNS)</li>
                                <li>TNI Polri</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                    <div class="uk-card-media-left uk-cover-container">
                        <img :src="asset('hp/images/homepage/jasa/umk.jpg')" alt="" uk-cover />
                        <canvas width="600" height="400"></canvas>
                    </div>
                    <div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Kredit Mikro</h3>
                            <p>
                                Kredit yang diberikan kepada usaha kecil dan menengah (UKM)
                                dengan bunga yang rendah dan jangka waktu yang fleksibel untuk
                                memperluas usaha.
                            </p>
                        </div>
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