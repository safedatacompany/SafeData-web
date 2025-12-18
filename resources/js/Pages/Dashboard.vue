<template>
    <div>

        <Head>
            <title>{{ $t('dashboard.dashboard') }}</title>
        </Head>

        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <p>{{ $t('dashboard.dashboard') }}</p>
            </li>
        </ul>

        <div class="pt-5">
            <!-- Welcome Panel -->
            <div class="panel mb-5">
                <h1 class="text-xl font-bold">
                    {{ $t('dashboard.welcome') }} - <span class="font-semibold text-primary">{{
                        $page.props.auth.user.name }}</span>
                </h1>
                <!-- <p class="text-white-dark mt-2">{{ $t('dashboard.overview') || 'Here\'s an overview of your system' }}</p> -->
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Users -->
                <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400 text-white">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">
                            {{ $t('dashboard.total_users') || 'Total Users' }}
                        </div>
                    </div>
                    <div class="flex items-center mt-2">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ stats.users.total }}</div>
                    </div>
                    <div class="flex items-center font-semibold mt-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="ltr:mr-2 rtl:ml-2">
                            <path opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        {{ stats.users.active }} {{ $t('dashboard.active') || 'Active' }}
                    </div>
                </div>
                <!-- Total Clients -->
                <div class="panel bg-gradient-to-r from-indigo-500 to-indigo-400 text-white">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">
                            {{ $t('dashboard.total_clients') || 'Total Clients' }}
                        </div>
                    </div>
                    <div class="flex items-center mt-2">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ stats.clients }}</div>
                    </div>
                    <div class="flex items-center font-semibold mt-2">
                        <Svg name="users" class="size-5"></Svg>

                        <!-- {{ stats.roles }} {{ $t('dashboard.roles') || 'Roles' }} -->
                    </div>
                </div>

                <!-- Total News -->
                <!-- <div class="panel bg-gradient-to-r from-violet-500 to-violet-400 text-white">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">
                            {{ $t('dashboard.total_news') || 'Total News' }}
                        </div>
                    </div>
                    <div class="flex items-center mt-2">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ stats.news.total }}</div>
                    </div>
                    <div class="flex items-center font-semibold mt-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="ltr:mr-2 rtl:ml-2">
                            <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M15.9998 12L15.9998 8" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.9998 16H16.0088" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        {{ stats.news.published }} {{ $t('dashboard.published') || 'Published' }}
                    </div>
                </div> -->

                <!-- Total Visitors -->
                <div class="panel bg-gradient-to-r from-blue-500 to-blue-400 text-white">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">
                            {{ $t('dashboard.total_visitors') || 'Visitors (30d)' }}
                        </div>
                    </div>
                    <div class="flex items-center mt-2">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ stats.visitors.total }}</div>
                    </div>
                    <div class="flex items-center font-semibold mt-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="ltr:mr-2 rtl:ml-2">
                            <path d="M16 2V5M8 2V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M3.5 9.08984H20.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        {{ stats.visitors.unique }} {{ $t('dashboard.unique') || 'Unique' }}
                    </div>
                </div>

                <!-- Total Languages -->
                <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400 text-white">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">
                            {{ $t('dashboard.languages') || 'Languages' }}
                        </div>
                    </div>
                    <div class="flex items-center mt-2">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ stats.languages }}</div>
                    </div>
                    <div class="flex items-center font-semibold mt-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="ltr:mr-2 rtl:ml-2">
                            <path
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path d="M2 12H22" stroke="currentColor" stroke-width="1.5" />
                            <path
                                d="M12 2C14.5013 4.73835 15.9228 8.29203 16 12C15.9228 15.708 14.5013 19.2616 12 22C9.49872 19.2616 8.07725 15.708 8 12C8.07725 8.29203 9.49872 4.73835 12 2Z"
                                stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        {{ $t('dashboard.total_languages') || 'Total Languages' }}
                    </div>
                </div>
            </div>

            <!-- Charts and Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Monthly Activity Chart -->
                <div class="panel h-full">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">{{ $t('dashboard.monthly_activity') ||
                            'Monthly Activity' }}</h5>
                    </div>
                    <div class="relative">
                        <apexchart type="area" height="325" :options="monthlyChart" :series="monthlySeries"></apexchart>
                    </div>
                </div>

                <!-- Visitors by Device -->
                <div class="panel h-full">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">{{ $t('dashboard.visitors_device') ||
                            'Visitors by Device' }}</h5>
                    </div>
                    <div class="relative">
                        <apexchart type="donut" height="325" :options="deviceChart" :series="deviceSeries"></apexchart>
                    </div>
                </div>
            </div>

            <!-- Recent Data Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Recent Clients -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">{{ $t('dashboard.recent_clients') ||
                            'Recent Clients' }}</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table-hover">
                            <thead>
                                <tr>
                                    <th>{{ $t('dashboard.name') || 'Name' }}</th>
                                    <th>{{ $t('dashboard.created_at') || 'Created At' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="client in recentClients" :key="client.id">
                                    <td>
                                        <div class="whitespace-nowrap">{{ client.name }}</div>
                                    </td>
                                    <td>{{ client.created_at }}</td>
                                </tr>
                                <tr v-if="recentClients.length === 0">
                                    <td colspan="2" class="text-center">
                                        {{ $t('dashboard.no_data') || 'No data available' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">
                            {{ $t('dashboard.recent_users') || 'Recent Users' }}
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table-hover">
                            <thead>
                                <tr>
                                    <th>{{ $t('dashboard.name') || 'Name' }}</th>
                                    <th>{{ $t('dashboard.email') || 'Email' }}</th>
                                    <th>{{ $t('dashboard.status') || 'Status' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in recentUsers" :key="user.id">
                                    <td>
                                        <div class="whitespace-nowrap">{{ user.name }}</div>
                                        <div class="text-xs text-white-dark">{{ user.created_at }}</div>
                                    </td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <span class="badge"
                                            :class="user.is_active ? 'badge-outline-success' : 'badge-outline-danger'">
                                            {{ user.is_active ? ($t('dashboard.active') || 'Active') :
                                                ($t('dashboard.inactive') || 'Inactive') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr v-if="recentUsers.length === 0">
                                    <td colspan="3" class="text-center">
                                        {{ $t('dashboard.no_data') || 'No data available' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Popular Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Popular News -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">{{ $t('dashboard.popular_hosting') ||
                        'Popular Hosting' }}</h5>
                </div>
                <div class="space-y-4">
                    <div v-for="hosting in popularHosting" :key="hosting.id"
                        class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <div class="flex-1 truncate">{{ hosting.name }}</div>
                        <div class="flex items-center ltr:ml-4 rtl:mr-4">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="ltr:mr-1 rtl:ml-1">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <!-- <span class="font-semibold text-sm">{{ news.views }}</span> -->
                        </div>
                    </div>
                    <div v-if="popularHosting.length === 0" class="text-center text-white-dark py-4">
                        {{ $t('dashboard.no_data') || 'No data available' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, inject } from 'vue';
import apexchart from 'vue3-apexcharts';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    stats: Object,
    visitorsByDevice: Array,
    recentClients: Array,
    recentUsers: Array,
    recentServices: Array,
    popularHosting: Array,
    monthlyData: Array,
});

const theme = inject('theme');
const rtlClass = inject('rtlClass');

// Monthly Activity Chart
const monthlyChart = computed(() => {
    const isDark = theme.value === 'dark';
    const isRtl = rtlClass.value === 'rtl';
    return {
        chart: {
            height: 325,
            type: 'area',
            fontFamily: 'Nunito, sans-serif',
            zoom: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square',
        },
        colors: isDark ? ['#2196f3', '#e7515a', '#00ab55'] : ['#1b55e2', '#e7515a', '#00ab55'],
        labels: props.monthlyData.map(item => item.month),
        xaxis: {
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            labels: {
                offsetX: isRtl ? 2 : 0,
                offsetY: 5,
                style: {
                    fontSize: '12px',
                },
            },
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                offsetX: isRtl ? -30 : -10,
                offsetY: 0,
                style: {
                    fontSize: '12px',
                },
            },
            opposite: isRtl,
        },
        grid: {
            borderColor: isDark ? '#191e3a' : '#e0e6ed',
            strokeDashArray: 5,
            xaxis: {
                lines: {
                    show: true,
                },
            },
            yaxis: {
                lines: {
                    show: false,
                },
            },
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            fontSize: '14px',
            markers: {
                width: 10,
                height: 10,
            },
        },
        tooltip: {
            marker: {
                show: true,
            },
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: isDark ? 0.19 : 0.28,
                opacityTo: 0.05,
                stops: isDark ? [100, 100] : [45, 100],
            },
        },
    };
});

const monthlySeries = computed(() => [
    {
        name: 'Users',
        data: props.monthlyData.map(item => item.users),
    },
    {
        name: 'Visitors',
        data: props.monthlyData.map(item => item.visitors),
    },
]);

// Device Chart
const deviceChart = computed(() => {
    const isDark = theme.value === 'dark';
    return {
        chart: {
            type: 'donut',
            height: 325,
            fontFamily: 'Nunito, sans-serif',
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 20,
            colors: isDark ? '#0e1726' : '#fff',
        },
        colors: isDark ? ['#5c1ac3', '#e2a03f', '#e7515a', '#00ab55'] : ['#e2a03f', '#5c1ac3', '#e7515a', '#00ab55'],
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            markers: {
                width: 10,
                height: 10,
            },
            height: 50,
            offsetY: 20,
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '65%',
                    background: 'transparent',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '20px',
                            offsetY: -10,
                        },
                        value: {
                            show: true,
                            fontSize: '22px',
                            color: isDark ? '#bfc9d4' : undefined,
                            offsetY: 16,
                            formatter: (val) => {
                                return val;
                            },
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            color: '#888ea8',
                            fontSize: '20px',
                            formatter: (w) => {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            },
                        },
                    },
                },
            },
        },
        labels: props.visitorsByDevice.map(item => item.device_type || 'Unknown'),
    };
});

const deviceSeries = computed(() => props.visitorsByDevice.map(item => item.count));
</script>
