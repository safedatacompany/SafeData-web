<template>

    <Head>
        <title>{{ $t('system.visitors') }}</title>
    </Head>
    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <div class="flex whitespace-nowrap">
                <ul class="flex flex-wrap space-x-2 rtl:space-x-reverse">
                    <li class="text-gray-400">
                        <span>{{ $t('nav.others') }}</span>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <span>{{ $t('system.visitors') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Visitors -->
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-lg font-semibold text-primary">{{ statistics.total_visitors }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $t('system.total_visitors') }}</div>
                    </div>
                    <div class="w-12 h-12 flex items-center justify-center bg-primary/10 rounded-full">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Unique Visitors -->
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-lg font-semibold text-success">{{ statistics.unique_visitors }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $t('system.unique_visitors') }}</div>
                    </div>
                    <div class="w-12 h-12 flex items-center justify-center bg-success/10 rounded-full">
                        <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Today's Visitors -->
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-lg font-semibold text-info">{{ statistics.today_visitors }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $t('system.today_visitors') }}</div>
                    </div>
                    <div class="w-12 h-12 flex items-center justify-center bg-info/10 rounded-full">
                        <svg class="w-6 h-6 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- This Month -->
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-lg font-semibold text-warning">{{ statistics.month_visitors }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $t('system.month_visitors') }}</div>
                    </div>
                    <div class="w-12 h-12 flex items-center justify-center bg-warning/10 rounded-full">
                        <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="pt-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- Browser Statistics -->
            <div class="panel">
                <div class="mb-4">
                    <h5 class="font-semibold text-lg">{{ $t('system.browser_stats') }}</h5>
                </div>
                <div class="space-y-3">
                    <div v-for="browser in statistics.browser_stats" :key="browser.browser"
                        class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-sm">{{ browser.browser }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-32 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full"
                                    :style="{ width: `${(browser.count / statistics.total_visitors * 100)}%` }"></div>
                            </div>
                            <span class="text-sm font-semibold w-12 text-right">{{ browser.count }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Platform Statistics -->
            <div class="panel">
                <div class="mb-4">
                    <h5 class="font-semibold text-lg">{{ $t('system.platform_stats') }}</h5>
                </div>
                <div class="space-y-3">
                    <div v-for="platform in statistics.platform_stats" :key="platform.platform"
                        class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-sm">{{ platform.platform }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-32 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-success rounded-full"
                                    :style="{ width: `${(platform.count / statistics.total_visitors * 100)}%` }"></div>
                            </div>
                            <span class="text-sm font-semibold w-12 text-right">{{ platform.count }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Device Statistics -->
            <div class="panel">
                <div class="mb-4">
                    <h5 class="font-semibold text-lg">{{ $t('system.device_stats') }}</h5>
                </div>
                <div class="space-y-3">
                    <div v-for="device in statistics.device_stats" :key="device.device_type"
                        class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-sm">{{ device.device_type }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-32 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-info rounded-full"
                                    :style="{ width: `${(device.count / statistics.total_visitors * 100)}%` }"></div>
                            </div>
                            <span class="text-sm font-semibold w-12 text-right">{{ device.count }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Pages -->
            <div class="panel">
                <div class="mb-4">
                    <h5 class="font-semibold text-lg">{{ $t('system.top_pages') }}</h5>
                </div>
                <perfect-scrollbar class="space-y-2 max-h-64">
                    <div v-for="(page, index) in statistics.top_pages.slice(0, 10)" :key="index"
                        class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-0">
                        <div class="flex-1 truncate text-sm pr-4">{{ page.url }}</div>
                        <span class="text-sm font-semibold bg-primary/10 text-primary px-2 py-1 rounded">
                            {{ page.visits }}
                        </span>
                    </div>
                </perfect-scrollbar>
            </div>
        </div>

        <!-- Visitors Table -->
        <div class="pt-4">
            <div class="panel">
                <!-- Datatable -->
                <Datatable :rows="visitors" :columns="columns" :totalRows="visitors.data?.length" @change="apply_filter"
                    v-model:search="filters.search" v-model:numberRows="filters.number_rows" :filter="props.filters"
                    v-model:sortBy="filters.sort_by" v-model:sortDirection="filters.sort_direction" :checkable="false">

                    <template #datatable-actions>
                        <!-- Date Range Picker -->
                        <CustomDatePicker v-model="dateRangeModel" filter-key="created_at" parent-key="system"
                            placeholder="select_date_range" @apply-filter="handleApplyFilter"
                            @clear-filter="handleClearFilter" />
                    </template>

                    <template #ip_address="data">
                        <span class="text-sm font-mono">{{ data.value.ip_address }}</span>
                    </template>

                    <template #user="data">
                        <span v-if="data.value.user" class="text-sm">
                            {{ data.value.user.name }}
                        </span>
                        <span v-else class="text-sm text-gray-400">{{ $t('common.guest') }}</span>
                    </template>

                    <template #url="data">
                        <span class="text-sm truncate block max-w-xs" :title="data.value.url">
                            {{ data.value.url }}
                        </span>
                    </template>

                    <template #browser="data">
                        <span class="text-sm">{{ data.value.browser }}</span>
                    </template>

                    <template #platform="data">
                        <span class="text-sm">{{ data.value.platform }}</span>
                    </template>

                    <template #device_type="data">
                        <span class="badge" :class="{
                            'badge-outline-primary': data.value.device_type === 'Desktop',
                            'badge-outline-success': data.value.device_type === 'Mobile',
                            'badge-outline-info': data.value.device_type === 'Tablet'
                        }">
                            {{ data.value.device_type }}
                        </span>
                    </template>

                    <template #created_at="data">
                        <span v-tippy dir="ltr" class="text-sm font-bold ltr">
                            {{ data.value.created_at ? $helpers.formatCustomDate(data.value.created_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.created_at, true) }}</tippy>
                    </template>
                </Datatable>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { wTrans } from 'laravel-vue-i18n';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, updateFilters } from '@/Plugins/filtersPlugin';
import CustomDatePicker from '@/Components/Inputs/CustomDatePicker.vue';
import { useDateFilters } from '@/composables/useDateFilters.js';

const props = defineProps([
    'visitors',
    'statistics',
    'filters',
]);

const $helpers = inject('helpers');

const filters = initializeFilters({
    search: '',
    number_rows: 15,
    sort_by: 'id',
    sort_direction: 'desc',
    start_date: props.filters.start_date || '',
    end_date: props.filters.end_date || '',
    per_page: 15,
});

const apply_filter = () => {
    updateFilters({
        search: filters.search,
        number_rows: filters.number_rows,
        sort_by: filters.sort_by,
        sort_direction: filters.sort_direction,
        start_date: filters.start_date || '',
        end_date: filters.end_date || '',
        per_page: filters.per_page,
    });
};

const { dateRangeModel, handleApplyFilter, handleClearFilter } = useDateFilters(filters, apply_filter);

const columns = ref([
    {
        field: 'id',
        title: 'ID',
        width: '25px',
        type: 'number',
    },
    {
        field: 'ip_address',
        title: wTrans('system.ip_address')
    },
    {
        field: 'user',
        title: wTrans('common.user')
    },
    {
        field: 'url',
        title: wTrans('system.url')
    },
    {
        field: 'browser',
        title: wTrans('system.browser')
    },
    {
        field: 'platform',
        title: wTrans('system.platform')
    },
    {
        field: 'device_type',
        title: wTrans('system.device_type')
    },
    {
        field: 'created_at',
        title: wTrans('common.created_at'),
        type: 'date',
    },
]);

const deleteVisitor = (id) => {
    if (confirm(wTrans('common.are_you_sure'))) {
        router.delete(route('control.system.settings.visitors.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                // Success handled by backend
            }
        });
    }
};

const deleteAllVisitors = () => {
    if (confirm(wTrans('system.confirm_delete_all_visitors'))) {
        router.delete(route('control.system.settings.visitors.destroy_all'), {
            data: {
                start_date: filters.start_date,
                end_date: filters.end_date,
            },
            preserveScroll: true,
            onSuccess: () => {
                // Success handled by backend
            }
        });
    }
};
</script>
