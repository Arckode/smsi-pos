<template>
    <div v-if="loading"
        style="width: 100%; height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="spinner-border text-primary" role="status" style="width: 70px; height: 70px;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div v-if="!loading" class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-md-12">
                <div class="d-md-flex align-items-center mb-3 mx-2">
                    <div class="mb-md-0 mb-3">
                        <h3 class="font-weight-bold mb-0">Hello, {{ user.name }}</h3>
                        <p class="mb-0">Laporan hari ini untukmu!</p>
                    </div>
                    <!-- <button type="button"
                        class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                        <span class="btn-inner--icon">
                            <span class="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                                <span class="visually-hidden">New</span>
                            </span>
                        </span>
                        <span class="btn-inner--text">Messages</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                        <span class="btn-inner--icon">
                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </span>
                        <span class="btn-inner--text">Sync</span>
                    </button> -->
                </div>
            </div>
        </div>
        <hr>
        <h5 v-if="user.role == 1" class="font-weight-bold mb-0">Status Document saat ini</h5>
        <!-- <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card border shadow-xs mb-4">
                    <div class="card-body text-start p-3 w-100">
                        <div class="d-flex flex-row">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3 me-3">
                                <i class="fad fa-book-user" style="font-size: 20px;"></i>
                            </div>
                            <div>
                                <h6 class="text-md mb-0">Document</h6>
                                <p class="text-sm text-secondary mb-1">Dibuat oleh user</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <div class="d-flex align-items-end justify-content-end">
                                        <h3 class="mb-0 font-weight-bold">{{ dashboard['1'] }}</h3>
                                        <span class="text-sm text-success font-weight-bolder">
                                            <i class="fa fa-chevron-up text-xs me-1"></i>10.5%
                                        </span>
                                        <span class="text-sm ms-1">from $89,740.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card border shadow-xs mb-4">
                    <div class="card-body text-start p-3 w-100">
                        <div class="d-flex flex-row">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3 me-3">
                                <i class="fa-duotone fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                            </div>
                            <div>
                                <h6 class="text-md mb-0">Document</h6>
                                <p class="text-sm text-secondary mb-1">Dikirim oleh secretary</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <div class="d-flex align-items-end justify-content-end">
                                        <h3 class="mb-0 font-weight-bold">{{ dashboard['5'] }}</h3>
                                        <span class="text-sm text-success font-weight-bolder">
                                            <i class="fa fa-chevron-up text-xs me-1"></i>10.5%
                                        </span>
                                        <span class="text-sm ms-1">from $89,740.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card border shadow-xs mb-4">
                    <div class="card-body text-start p-3 w-100">
                        <div class="d-flex flex-row">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3 me-3">
                                <i class="fa-duotone fa-solid fa-person-carry-box" style="font-size: 20px;"></i>
                            </div>
                            <div>
                                <h6 class="text-md mb-0">Document</h6>
                                <p class="text-sm text-secondary mb-1">Diterima oleh user</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <div class="d-flex align-items-end justify-content-end">
                                        <h3 class="mb-0 font-weight-bold">{{ dashboard['9'] }}</h3>
                                        <span class="text-sm text-success font-weight-bolder">
                                            <i class="fa fa-chevron-up text-xs me-1"></i>10.5%
                                        </span>
                                        <span class="text-sm ms-1">from $89,740.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div v-if="user.role == 1" class="d-flex justify-content-around mt-3 flex-wrap">
            <div class="card p-3 m-2" style="width: 18rem;">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3 me-3">
                            <i class="fas fa-file-alt" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <h5 class="text-md mb-0 card-title">List Dokumen</h5>
                            <h6 class="text-sm text-secondary mb-1 card-subtitle">Dibuat oleh user</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <div class="d-flex align-items-end justify-content-end">
                                    <h1 class="mb-0 font-weight-bold">{{ dashboard['1'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-3 m-2" style="width: 18rem;">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3 me-3">
                            <i class="fas fa-shipping-fast" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <h5 class="text-md mb-0 card-title">Batch Dokumen</h5>
                            <h6 class="text-sm text-secondary mb-1 card-subtitle">Dikirim oleh sekertaris</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <div class="d-flex align-items-end justify-content-end">
                                    <h1 class="mb-0 font-weight-bold">{{ dashboard['5'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-3 m-2" style="width: 18rem;">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3 me-3">
                            <i class="fas fa-people-carry" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <h5 class="text-md mb-0 card-title">List Dokumen</h5>
                            <h6 class="text-sm text-secondary mb-1 card-subtitle">Diterima oleh user</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <div class="d-flex align-items-end justify-content-end">
                                    <h1 class="mb-0 font-weight-bold">{{ dashboard['9'] }}</h1>
                                    <!-- <span class="text-sm text-success font-weight-bolder">
                                            <i class="fa fa-chevron-up text-xs me-1"></i>10.5%
                                        </span>
                                        <span class="text-sm ms-1">from $89,740.00</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="row my-4">
            <!-- <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                <div class="card shadow-xs border h-100">
                    <div class="card-header pb-0">
                        <h6 class="font-weight-semibold text-lg mb-0">Balances over time</h6>
                        <p class="text-sm">Here you have details about the balance.</p>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                                checked>
                            <label class="btn btn-white px-3 mb-0" for="btnradio1">12 months</label>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-white px-3 mb-0" for="btnradio2">30 days</label>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-white px-3 mb-0" for="btnradio3">7 days</label>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart mb-2">
                            <canvas id="chart-bars" class="chart-canvas" height="240" ref="chartBars"></canvas>
                        </div>
                        <button class="btn btn-white mb-0 ms-auto">View report</button>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-12 col-md-12">
                <div class="card shadow-xs border">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center mb-3">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">List Dokumen</h6>
                                <p class="text-sm mb-sm-0 mb-2">Berikut detail 5 dokumen terbaru</p>
                            </div>
                            <!-- <div class="ms-auto d-flex">
                                <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                    View report
                                </button>
                                <button type="button"
                                    class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                                    <span class="btn-inner--icon">
                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="d-block me-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                    </span>
                                    <span class="btn-inner--text">Download</span>
                                </button>
                            </div> -->
                        </div>
                        <!-- <div class="pb-3 d-sm-flex align-items-center">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable1"
                                    autocomplete="off" checked>
                                <label class="btn btn-white px-3 mb-0" for="btnradiotable1">All</label>
                                <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable2"
                                    autocomplete="off">
                                <label class="btn btn-white px-3 mb-0" for="btnradiotable2">Monitored</label>
                                <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable3"
                                    autocomplete="off">
                                <label class="btn btn-white px-3 mb-0" for="btnradiotable3">Unmonitored</label>
                            </div>
                            <div class="input-group w-sm-25 ms-auto">
                                <span class="input-group-text text-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                        </path>
                                    </svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                        </div> -->
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="table-responsive p-0" v-if="collection.documents.length > 0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-xs font-weight-semibold opacity-7">Document</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Qr-code</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Category</th>
                                        <th class="text-center text-xs font-weight-semibold opacity-7">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in collection.documents" :key="item.id">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-start ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">{{ item.label }}</h6>
                                                    <p class="text-sm text-secondary mb-0">{{ item.description }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-lg">
                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ item.number }}</h6>
                                        </td>
                                        <td class="align-middle text-center text-lg">
                                            <span v-if="item.category == 1"
                                                class="badge badge-sm border border-warning text-warning bg-warning">
                                                Semi Urgent
                                            </span>

                                            <span v-if="item.category == 2"
                                                class="badge badge-sm border border-danger text-danger bg-danger">
                                                Urgent
                                            </span>

                                            <span v-if="item.category == 3"
                                                class="badge badge-sm border border-info text-info bg-info">
                                                Reguler
                                            </span>
                                        </td>
                                        <td class="align-middle text-center text-lg">
                                            <span v-if="item.status.status_id == 3"
                                                class="badge badge-sm border border-danger text-danger bg-danger">
                                                {{ item.status.dict_edoc_status.status_message }}
                                            </span>
                                            <span
                                                v-else-if="item.status.status_id == 1 || item.status.status_id == 2 || item.status.status_id == 6"
                                                class="badge badge-sm border border-info text-info bg-info">
                                                {{ item.status.dict_edoc_status.status_message }}
                                            </span>
                                            <span v-else
                                                class="badge badge-sm border border-success text-success bg-success">
                                                {{ item.status.dict_edoc_status.status_message }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex p-2 text-sm justify-content-center m-4" v-else>
                            Tidak ada data
                        </div>
                        <a class="btn btn-sm btn-dark hstack gap-3 w-100 rounded-0 rounded-bottom m-0">
                            <a class="mb-0 text-sm text-white font-weight-normal stretched-link" @click="move">{{collection.documents.length > 0 ? 'See All Document' : 'Tambahkan Document'}}</a>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-xs border">
                    <div class="card-header pb-0">
                        <div class="d-sm-flex align-items-center mb-3">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Overview balance</h6>
                                <p class="text-sm mb-sm-0 mb-2">Here you have details about the balance.</p>
                            </div>
                            <div class="ms-auto d-flex">
                                <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                    View report
                                </button>
                            </div>
                        </div>
                        <div class="d-sm-flex align-items-center">
                            <h3 class="mb-0 font-weight-semibold">$87,982.80</h3>
                            <span
                                class="badge badge-sm border border-success text-success bg-success border-radius-sm ms-sm-3 px-2">
                                <svg width="9" height="9" viewBox="0 0 10 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0.46967 4.46967C0.176777 4.76256 0.176777 5.23744 0.46967 5.53033C0.762563 5.82322 1.23744 5.82322 1.53033 5.53033L0.46967 4.46967ZM5.53033 1.53033C5.82322 1.23744 5.82322 0.762563 5.53033 0.46967C5.23744 0.176777 4.76256 0.176777 4.46967 0.46967L5.53033 1.53033ZM5.53033 0.46967C5.23744 0.176777 4.76256 0.176777 4.46967 0.46967C4.17678 0.762563 4.17678 1.23744 4.46967 1.53033L5.53033 0.46967ZM8.46967 5.53033C8.76256 5.82322 9.23744 5.82322 9.53033 5.53033C9.82322 5.23744 9.82322 4.76256 9.53033 4.46967L8.46967 5.53033ZM1.53033 5.53033L5.53033 1.53033L4.46967 0.46967L0.46967 4.46967L1.53033 5.53033ZM4.46967 1.53033L8.46967 5.53033L9.53033 4.46967L5.53033 0.46967L4.46967 1.53033Z"
                                        fill="#67C23A"></path>
                                </svg>
                                10.5%
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart mt-n6">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <footer class="footer pt-3">
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
window.BASEURL = ''

export default {
    name: "Admin.Index",

    data() {
        return {
            user: {},
            dashboard: {
                1: 0,
                5: 0,
                9: 0
            },
            collection: { documents: [] },
            loading: true
        }
    },

    async mounted() {
        await this.fetchCurrentUser();
        await this.fetchDashboard();
        this.loading = false;
        var ctx = document.getElementById("chart-bars").getContext("2d");
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderSkipped: false,
                    backgroundColor: "#2ca8ff",
                    data: [450, 200, 100, 220, 500, 100, 400, 230, 500, 200],
                    maxBarThickness: 6
                },
                {
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderSkipped: false,
                    backgroundColor: "#7c3aed",
                    data: [200, 300, 200, 420, 400, 200, 300, 430, 400, 300],
                    maxBarThickness: 6
                },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#1e293b',
                        bodyColor: '#1e293b',
                        borderColor: '#e9ecef',
                        borderWidth: 1,
                        usePointStyle: true
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        stacked: true,
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4],
                        },
                        ticks: {
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        },
                    },
                    x: {
                        stacked: true,
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        },
                    },
                },
            },
        });

        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(45,168,255,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(45,168,255,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(45,168,255,0)'); //blue colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(119,77,211,0.4)');
        gradientStroke2.addColorStop(0.7, 'rgba(119,77,211,0.1)');
        gradientStroke2.addColorStop(0, 'rgba(119,77,211,0)'); //purple colors

        new Chart(ctx2, {
            plugins: [{
                beforeInit(chart) {
                    const originalFit = chart.legend.fit;
                    chart.legend.fit = function fit() {
                        originalFit.bind(chart.legend)();
                        this.height += 40;
                    }
                },
            }],
            type: "line",
            data: {
                labels: ["Aug 18", "Aug 19", "Aug 20", "Aug 21", "Aug 22", "Aug 23", "Aug 24", "Aug 25", "Aug 26",
                    "Aug 27", "Aug 28", "Aug 29", "Aug 30", "Aug 31", "Sept 01", "Sept 02", "Sept 03", "Aug 22",
                    "Sept 04", "Sept 05", "Sept 06", "Sept 07", "Sept 08", "Sept 09"
                ],
                datasets: [{
                    label: "Volume",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    borderColor: "#2ca8ff",
                    pointBorderColor: '#2ca8ff',
                    pointBackgroundColor: '#2ca8ff',
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [2828, 1291, 3360, 3223, 1630, 980, 2059, 3092, 1831, 1842, 1902, 1478, 1123,
                        2444, 2636, 2593, 2885, 1764, 898, 1356, 2573, 3382, 2858, 4228
                    ],
                    maxBarThickness: 6

                },
                {
                    label: "Trade",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    borderColor: "#832bf9",
                    pointBorderColor: '#832bf9',
                    pointBackgroundColor: '#832bf9',
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [2797, 2182, 1069, 2098, 3309, 3881, 2059, 3239, 6215, 2185, 2115, 5430, 4648,
                        2444, 2161, 3018, 1153, 1068, 2192, 1152, 2129, 1396, 2067, 1215, 712, 2462,
                        1669, 2360, 2787, 861
                    ],
                    maxBarThickness: 6
                },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 6,
                            boxHeight: 6,
                            padding: 20,
                            pointStyle: 'circle',
                            borderRadius: 50,
                            usePointStyle: true,
                            font: {
                                weight: 400,
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#1e293b',
                        bodyColor: '#1e293b',
                        borderColor: '#e9ecef',
                        borderWidth: 1,
                        pointRadius: 2,
                        usePointStyle: true,
                        boxWidth: 8,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            callback: function (value, index, ticks) {
                                return parseInt(value).toLocaleString() + ' EUR';
                            },
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        }
                    },
                },
            },
        });
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
            } catch (error) {
                console.log('Logout error: ', error)
            }
        },
        async fetchDashboard() {
            if (this.user.role == 1) {
                let endpoint = `${BASEURL}/api/dashboard`
                try {
                    let response = await axios.get(endpoint, {
                        headers: {
                            Authorization: 'Bearer ' + this.$token(),
                        }
                    })
                    if (response.data) {
                        this.dashboard = response.data.data
                    }
                    this.dashboard[1] = response.data.data['1'] ? response.data.data['1'] : 0
                    this.dashboard[5] = response.data.data['5'] ? response.data.data['5'] : 0
                    this.dashboard[9] = response.data.data['9'] ? response.data.data['9'] : 0
                    this.loading = false
                } catch (error) {
                    console.log('Logout error: ', error)
                }
            } else {
                let endpoint = `${BASEURL}/api/edocs`
                try {
                    this.loadContent = true
                    let response = await axios.get(endpoint, {
                        headers: {
                            Authorization: 'Bearer ' + this.$token(),
                        },
                        params: {
                            'search': ''
                        }
                    });
                    this.collection.documents = response.data.data.data.slice(-5)
                    this.loading = false
                } catch (error) {
                    console.error("Error fetching document list: ", error);
                }
            }
        },
        async move() {
            this.$router.push({ name: 'admin.documentlist' })
        }
    }
}
</script>