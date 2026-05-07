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
                    <li style="background-image: url(hp/images/homepage/profile/p2.jpg)">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="col-md-8 col-md-offset-2 col-md-push-4 js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc biru-header">
                                        <span>Informasi Terkait</span>
                                        <h2>Koperasi Nusa Sejahtera</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </aside>

        <div id="fh5co-about" style="padding-bottom: 0">
            <div class="container">
                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 animate-box">
                        <div class="about-content">
                            <h3>Sedikit Sejarah Tentang Koperasi Nusa Sejahtera</h3>
                            <blockquote>
                                <p>
                                    Koperasi Nusa Sejahtera adalah koperasi serba usaha yang
                                    berkedudukan di Waru Sidoarjo, dibentuk pertama kali pada
                                    tanggal 12 Juni 2012 dengan keinginan menjadi koperasi yang
                                    dapat terpercaya, terbaik dan terkuat sebagai pilihan
                                    masyarakat dan dapat beroperasi di seluruh Indonesia melalui
                                    kemitraan.<br />
                                    <br />Pada awal sebelum terbentuknya Koperasi Nusa
                                    Sejahtera, tahun 2009 telah dilakukan kegiatan usaha yang
                                    dijalankan secara perorangan antara lain CV. Central Jaya
                                    Ban di Waru Sidoarjo (Tomo-Bridgestone), penjualan spare
                                    part mobil, jasa perbengkelan, Metropolis Laundery berupa
                                    jasa binatu, PT. Usaha Central Jaya Sakti Makassar (
                                    Perikanan) dan PT. Malino Randu Perkasa Makassar (Breeding
                                    Farm) Kemudian melalui Akta Pendirian nomor 74 yang dibuat
                                    dihadapan Notaris Ria Dewanti, SH. dan Surat Ijin Menteri
                                    Koperasi nomor 1073/BH/M.KUKM.2/VIII/2012 dan Surat Ijin
                                    Simpan Pinjam nomor 218/SISP/Dep.1/VIII/2012 tanggal 10
                                    Agustus 2012 kegiatan usaha disahkan dengan nama Koperasi
                                    Nusa Sejahtera yang kegiatannya mendapat ijin operasional
                                    diseluruh Indonesia.
                                </p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="staff-section" class="animate-box">
            <div class="pengurus uk-card uk-card-default uk-width-1-4@m">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Susunan Pengurus
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">
                                Koperasi Nusa Sejahtera
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <ul class="uk-list uk-list-square">
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Anisah Shahab, SE
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">Ketua</p>
                        </li>
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Yuli Winarsih
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">Sekertaris</p>
                        </li>
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Ivana Margery Chandra
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">Bendahara</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pengawas uk-card uk-card-default uk-width-1-4@m">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Susunan Pengawas
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">
                                Koperasi Nusa Sejahtera
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <ul class="uk-list uk-list-square">
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Agus Supriyadi
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">Ketua Pengawas</p>
                        </li>
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Lusi Grace Rambing
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">Anggota</p>
                        </li>
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Ari Prihatiningsih
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">Anggota</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pengelola uk-card uk-card-default uk-width-1-4@m">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Susunan Pengelola
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">
                                Koperasi Nusa Sejahtera
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <ul class="uk-list uk-list-square">
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Hengki Chandra
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">General Manager</p>
                        </li>
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Andrianus Gabriel Sudoyo
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">
                                Manager Simpan Pinjam
                            </p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="penasehat uk-card uk-card-default uk-width-1-4@m">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">Penasehat</h3>
                            <p class="uk-text-meta uk-margin-remove-top">
                                Koperasi Nusa Sejahtera
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <ul class="uk-list uk-list-square">
                        <li>
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                Drs. Sumito, MM
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">Penasehat</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="jaringan animate-box">
            <h1>Jaringan Kantor</h1>
            <p>Tersebar di seluruh pulau Jawa</p>
            <div id="jaringan-section">
                <div class="jabar uk-card uk-card-default uk-width-1-4@m">
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom">
                                    Jawa Barat
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <ul class="uk-list uk-list-square">
                            <li>Tasikmalaya</li>
                            <li>Bandung</li>
                            <li>Cianjur</li>
                            <li>Banjar</li>
                        </ul>
                    </div>
                </div>

                <div class="jateng uk-card uk-card-default uk-width-1-4@m">
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom">
                                    Jawa Tengah
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <ul class="uk-list uk-list-square">
                            <li>Semarang</li>
                            <li>Magetan</li>
                            <li>Yogyakarta</li>
                            <li>Solo</li>
                        </ul>
                    </div>
                </div>

                <div class="jatim uk-card uk-card-default uk-width-1-4@m">
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom">
                                    Jawa Timur
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <ul class="uk-list uk-list-square">
                            <li>Sidoarjo</li>
                            <li>Nganjuk</li>
                            <li>Pasuruan</li>
                            <li>Probolinggo</li>
                            <li>Kraksaan</li>
                            <li>Lumajang</li>
                            <li>Jember</li>
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