<template>
    <aside v-if="!loading" class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start "
        id="sidenav-main" style="z-index: 90;">
        <div class="sidenav-header" style="height: auto;">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <div class="d-flex flex-row align-items-start">
                <a class="navbar-brand d-flex flex-column align-items-start m-0">
                    <!-- <span class="text-xs">My</span> -->
                    <span class="font-weight-bold my-1 fs-4" style="color: wheat;">It's My</span>
                    <span class="font-weight-bold mt-1 fs-4" style="color: #1b87f7;">Bookstore</span>
                </a>
                <!-- <a href="javascript:;" onclick="toggleBodyClass()" class="nav-link text-body p-0">
                    <i class="fal fa-times"></i>
                </a> -->
            </div>
        </div>
        <div class="collapse navbar-collapse px-4 w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" :class="{ 'active': active('admin.dashboard') }"
                        v-on:click="$menu('admin.dashboard')" href="#">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>dashboard</title>
                                <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <path class="color-foreground"
                                            d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z"
                                            id="Path"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <!-- <li class="nav-item mt-2">
                    <button class="d-flex align-items-center nav-link btn-toggle" type="button"
                        @click="toggleSection('nasabah')" :aria-expanded="open.nasabah.toString()">
                        <span class="font-weight-normal text-md ms-2">Nasabah</span>
                        <i class="fas fa-chevron-down ms-auto toggle-icon" :class="{ 'open': open.nasabah }"></i>
                    </button>
                    <ul class="nav submenu ms-2" :class="{ 'open': open.nasabah }" v-show="true">
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.nasabahlist') }"
                                v-on:click="$menu('admin.nasabahlist')">
                                <span class="nav-link-text ms-1">List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mt-2">
                    <button class="d-flex align-items-center nav-link btn-toggle" type="button"
                        @click="toggleSection('angsuran')" :aria-expanded="open.angsuran.toString()">
                        <span class="font-weight-normal text-md ms-2">Angsuran</span>
                        <i class="fas fa-chevron-down ms-auto toggle-icon" :class="{ 'open': open.angsuran }"></i>
                    </button>
                    <ul class="nav submenu ms-2" :class="{ 'open': open.angsuran }">
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.pinjamanlist') }"
                                v-on:click="$menu('admin.pinjamanlist')">
                                <span class="nav-link-text ms-1">List</span>
                            </a>
                        </li>
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.pembayaranlist') }"
                                v-on:click="$menu('admin.pembayaranlist')">
                                <span class="nav-link-text ms-1">Tunggakan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mt-2">
                    <button class="d-flex align-items-center nav-link btn-toggle" type="button"
                        @click="toggleSection('report')" :aria-expanded="open.report.toString()">
                        <span class="font-weight-normal text-md ms-2">Report</span>
                        <i class="fas fa-chevron-down ms-auto toggle-icon" :class="{ 'open': open.report }"></i>
                    </button>
                    <ul class="nav submenu ms-2" :class="{ 'open': open.report }">
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.neraca') }" v-on:click="$menu('admin.neraca')">
                                <span class="nav-link-text ms-1">Neraca</span>
                            </a>
                        </li>
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.penghasilan') }"
                                v-on:click="$menu('admin.penghasilan')">
                                <span class="nav-link-text ms-1">Hasil Usaha</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mt-2">
                    <button class="d-flex align-items-center nav-link btn-toggle" type="button"
                        @click="toggleSection('data')" :aria-expanded="open.data.toString()">
                        <span class="font-weight-normal text-md ms-2">Data</span>
                        <i class="fas fa-chevron-down ms-auto toggle-icon" :class="{ 'open': open.data }"></i>
                    </button>
                    <ul class="nav submenu ms-2" :class="{ 'open': open.data }">
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.input') }" v-on:click="$menu('admin.input')">
                                <span class="nav-link-text ms-1">Inputan</span>
                            </a>
                        </li>
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.import') }" v-on:click="$menu('admin.import')">
                                <span class="nav-link-text ms-1">Import</span>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="nav-item mt-2">
                    <div class="d-flex align-items-center nav-link">
                        <span class="font-weight-normal text-md ms-2">Document</span>
                    </div>
                </li>
                <li class="nav-item border-start my-0 mx-3 p-1">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                        :class="{ 'active': active('admin.documentlist') }" v-on:click="$menu('admin.documentlist')">
                        <span class="nav-link-text ms-1">List Document</span>
                    </a>
                </li>
                <li v-if="user.role == 1" class="nav-item border-start my-0 mx-3 p-1">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                        :class="{ 'active': active('admin.documentshipment') }"
                        v-on:click="$menu('admin.documentshipment')">
                        <span class="nav-link-text ms-1">Pengiriman Document</span>
                    </a>
                </li> -->



                <!-- Dynamic Menu from API -->
                <li v-for="(module, index) in userAccesses" :key="index" class="nav-item mt-2">
                    <button class="d-flex align-items-center nav-link btn-toggle" type="button"
                        @click="toggleSection(module.name)" :aria-expanded="open[module.name]?.toString()">
                        <span class="font-weight-normal text-md ms-2">{{ module.name }}</span>
                        <i class="fas fa-chevron-down ms-auto toggle-icon" :class="{ 'open': open[module.name] }"></i>
                    </button>
                    <ul class="nav submenu ms-2" :class="{ 'open': open[module.name] }">
                        <li v-for="(sub, subIndex) in module.submodules" :key="subIndex"
                            class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active(sub.url) }" v-on:click="$menu(sub.url)">
                                <span class="nav-link-text ms-1">{{ sub.sub_module_name }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                
                <li class="nav-item mt-4">
                    <button class="d-flex align-items-center nav-link btn-toggle" type="button"
                        @click="toggleSection('account')" :aria-expanded="open.account.toString()">
                        <span class="font-weight-normal text-md ms-2">Account Pages</span>
                        <i class="fas fa-chevron-down ms-auto toggle-icon" :class="{ 'open': open.account }"></i>
                    </button>
                    <ul class="nav submenu ms-2" :class="{ 'open': open.account }">
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.profile') }" v-on:click="$menu('admin.profile')">
                                <span class="nav-link-text ms-1">Profile</span>
                            </a>
                        </li>
                        <li v-if="user.role == 1" class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#"
                                :class="{ 'active': active('admin.users') }" v-on:click="$menu('admin.users')">
                                <span class="nav-link-text ms-1">User Lists</span>
                            </a>
                        </li>
                        <li class="nav-item border-start my-0 mx-3 p-1">
                            <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#" @click.prevent="logout">
                                <span class="nav-link-text ms-1">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer fixed-bottom">
            <div class="d-flex flex-row align-items-start">
                <a class="navbar-brand d-flex flex-column align-items-start m-0 p-2" style="color: #ffffff5c;"
                    href="https://github.com/Arckode">
                    <span class="text-xxs">Arckode, Copyright &copy; 2025</span>
                </a>
            </div>
        </div>
    </aside>
    <main v-if="!loading" class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-none rounded" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                v-on:click="$menu('admin.dashboard')" href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{
                            $route.meta.breadcrumb }}</li>
                    </ol>
                    <h6 class="font-weight-bold mb-0">{{
                        $route.meta.breadcrumb }}</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <!-- <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body bg-white  border-end-0 ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </span>
                            <input type="text" class="form-control ps-0" placeholder="Search">
                        </div>
                    </div> -->
                    <ul class="ms-md-auto pe-md-3 d-flex align-items-center navbar-nav justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" onclick="toggleBodyClass()" class="nav-link text-body p-0"
                                id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center px-3">
                            <a class="d-flex align-items-center" type="button" @click.prevent="scannerModal">
                                <!-- <i class="fal fa-barcode-read" style="font-size: 20px;"></i> -->
                                <i class="fas fa-barcode" style="font-size: 18px;">
                                    <span class="sr-only text-sm">
                                        Scan
                                    </span>
                                </i>
                                <!-- <i class="fas fa-qrcode" style="transform: translate(15px, 0);"></i>
                                <svg viewBox="0 0 100 100" width="20px">
                                    <path d="M25,2 L2,2 L2,25" fill="none" stroke="black" stroke-width="3" />
                                    <path d="M2,75 L2,98 L25,98" fill="none" stroke="black" stroke-width="3" />
                                    <path d="M75,98 L98,98 L98,75" fill="none" stroke="black" stroke-width="3" />
                                    <path d="M98,25 L98,2 L75,2" fill="none" stroke="black" stroke-width="3" />
                                </svg> -->
                            </a>
                        </li>
                        <!-- <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    class="fixed-plugin-button-nav cursor-pointer" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" class="cursor-pointers">
                                    <path fill-rule="evenodd"
                                        d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img :src="asset('/cud/img/team-2.jpg')"
                                                    class="avatar avatar-sm border-radius-sm  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 d-flex align-items-center ">
                                                    <i class="fa fa-clock opacity-6 me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img :src="asset('cud/img/small-logos/logo-google.svg')"
                                                    class="avatar avatar-sm border-radius-sm bg-gradient-dark p-2  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New report</span> by Google
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 d-flex align-items-center ">
                                                    <i class="fa fa-clock opacity-6 me-1"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm border-radius-sm bg-slate-800  me-3  my-auto">
                                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-2169.000000, -745.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background"
                                                                        d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                        opacity="0.593633743"></path>
                                                                    <path class="color-background"
                                                                        d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary d-flex align-items-center mb-0 ">
                                                    <i class="fa fa-clock opacity-6 me-1"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButtonProfile"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img :src="user.picture ? asset(`${user.picture}`) : asset('/profile_pictures/default.jpg')"
                                    class="avatar avatar-sm" alt="avatar" />
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButtonProfile">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="#"
                                        v-on:click="$menu('admin.profile')">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm border-radius-sm bg-slate-800  me-3  my-auto">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">Profile</span>
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 d-flex align-items-center ">
                                                    Setting
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="#" @click.prevent="logout">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm border-radius-sm bg-slate-800  me-3  my-auto">
                                                <i class="fas fa-sign-out-alt"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Log Out
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <scanner-modal ref="scannerModal"></scanner-modal>
        <!-- End Navbar -->
        <router-view></router-view>
    </main>
</template>

<script>
import { emitter } from '../eventEmitter.js';
import ScannerModal from './view/component/Scanner.vue'
export default {
    name: "App",
    components: {
        'scanner-modal': ScannerModal,
    },
    data() {
        return {
            user: {},
            userAccesses: [],
            loading: true,
            open: {
                nasabah: false,
                angsuran: false,
                report: false,
                data: false,
                account: false
            }
        }
    },

    async mounted() {
        await this.fetchCurrentUser()
        this.loading = false
        document.addEventListener('click', this.handleClickOutsideSidebar);

        emitter.on('userAccessUpdated', async () => {
            await this.fetchCurrentUser();
        });
    },
    methods: {
        asset(path) {
            return `${BASEURL}${path}`
        },
        active(routePrefix) {
            const currentPath = this.$route.path || ''
            return currentPath === routePrefix
        },
        toggleSection(name) {
            if (this.open[name] === undefined) {
                this.open[name] = true
            } else {
                this.open[name] = !this.open[name];
            }
        },
        async fetchCurrentUser() {
            let endpoint = `${BASEURL}/api/current-user`
            try {
                let response = await axios.get(endpoint, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                })
                if (response.data.status) {
                    this.user = response.data.user
                    this.userAccesses = response.data.accesses || []

                    // Initialize open state for each module
                    this.userAccesses.forEach(module => {
                        this.open[module.name] = false
                    })
                }
            } catch (error) {
                console.log('Login error: ', error)
                localStorage.removeItem('user')
                this.$router.push({ name: 'login' }).then(() => { this.$router.go(0) })
            }
        },
        async logout() {
            let endpoint = `${BASEURL}/api/logout`
            try {
                let response = await axios.post(endpoint, {}, {
                    headers: {
                        Authorization: 'Bearer ' + this.$token(),
                    }
                });
                if (response.data.status) {
                    localStorage.removeItem('user')
                    this.$router.push({ name: 'login' }).then(() => { this.$router.go(0) })
                }
            } catch (error) {
                console.log('Logout error: ', error)
            }
        },
        handleClickOutsideSidebar(event) {
            let sidebar = document.getElementById('sidenav-main');
            let navbarToggle = document.getElementById('iconNavbarSidenav');

            if (sidebar && navbarToggle && !sidebar.contains(event.target) && !navbarToggle.contains(event.target)) {
                document.body.classList.remove('g-sidenav-pinned');
            }
        },
        scannerModal() {
            emitter.emit('ScannerModal', this.user.role);
        },
    }
}
</script>

<style scoped>
#sidenav-collapse-main {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

#sidenav-collapse-main::-webkit-scrollbar {
    display: none;
}

/* Collapsible submenu */
.submenu {
    max-height: 0;
    overflow: hidden;
    transition: max-height 260ms ease;
    padding-left: 0;
}

.submenu.open {
    /* large enough to show a few items; grows if content larger */
    max-height: 500px;
}

.btn-toggle {
    background: none;
    border: none;
    width: 100%;
    padding: .5rem 0;
    color: inherit;
}

.toggle-icon {
    transition: transform .25s ease;
}

.toggle-icon.open {
    transform: rotate(180deg);
}
</style>