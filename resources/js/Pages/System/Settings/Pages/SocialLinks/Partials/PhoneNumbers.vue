<template>
    <div class="panel md:w-1/2">
        <div class="mb-3 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.phone_numbers') }}</h5>
            <div class="flex items-center gap-2">
                <button v-if="phoneNumbersList.length > 0 || newPhoneNumbers.length > 0" :disabled="phoneForm.processing" type="button"
                    @click="updateAllPhoneNumbers" class="btn btn-success btn-sm flex items-center gap-1">
                    <Spinner v-if="phoneForm.processing" class="size-4" />
                    <Svg v-else name="pencil" class="size-4"></Svg>
                    <span>{{ $t('common.update') }}</span>
                </button>
                <button type="button" @click="addNewPhoneNumber" class="btn btn-primary btn-sm flex items-center gap-1">
                    <Svg name="plus" class="size-4"></Svg>
                    <span>{{ $t('common.new') }}</span>
                </button>
            </div>
        </div>

        <div>
            <ul class="space-y-3">
                <!-- Existing phone numbers -->
                <li v-for="(number, index) in phoneNumbersList" :key="number.id || `existing-${index}`"
                    class="flex items-start gap-3">
                    <div
                        class="btn btn-dark btn-sm font-bold h-[38px] w-[38px] flex items-center justify-center mt-0.5">
                        {{ index + 1 }}
                    </div>
                    <div class="flex-1">
                        <input v-model="number.phone_number" type="text" class="form-input"
                            :placeholder="$t('system.phone_number')" />
                    </div>
                    <button type="button" @click="callDelete(number.id)"
                        class="btn btn-danger btn-sm h-[38px] w-[38px] flex items-center justify-center mt-0.5"
                        v-tippy="$t('common.delete')">
                        <Svg name="trash" class="size-4"></Svg>
                    </button>
                </li>

                <!-- New phone number inputs -->
                <li v-for="(newNumber, index) in newPhoneNumbers" :key="`new-${index}`" class="flex items-start gap-3">
                    <div
                        class="btn btn-dark btn-sm font-bold h-[38px] w-[38px] flex items-center justify-center mt-0.5">
                        {{ phoneNumbersList.length + index + 1 }}
                    </div>
                    <div class="flex-1">
                        <input v-model="newNumber.phone_number" type="text" class="form-input"
                            :placeholder="$t('system.phone_number')" />
                        <div class="mt-1 text-sm text-danger" v-if="newNumber.error" v-html="newNumber.error">
                        </div>
                    </div>
                    <button type="button" @click="removeNewPhoneNumber(index)"
                        class="btn btn-danger btn-sm h-[38px] w-[38px] flex items-center justify-center mt-0.5"
                        v-tippy="$t('common.cancel')">
                        <Svg name="close" class="size-4"></Svg>
                    </button>
                </li>

                <li v-if="phoneNumbersList.length === 0 && newPhoneNumbers.length === 0" class="text-center py-8">
                    <span class="text-gray-500">
                        {{ $t('system.no_phone_numbers_added') }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, watch, computed } from 'vue';
import { Head, Link, useForm, router, usePage } from '@inertiajs/vue3';
import Spinner from '@/Components/Spinner.vue';
import { trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
const props = defineProps({
    phone_numbers: {
        type: [Array],
        default: () => []
    }
});

const $helpers = inject('helpers');
const page = usePage();

// Handle both paginated (object with data) and non-paginated (array) responses
const phoneNumbersList = computed(() => {
    if (!props.phone_numbers) return [];
    if (Array.isArray(props.phone_numbers)) return props.phone_numbers;
    if (props.phone_numbers.data) return props.phone_numbers.data;
    return [];
});

const phoneForm = useForm({
    phone_number: '',
    user_id: page.props.auth.user.id
});

const newPhoneNumbers = ref([]);
const currentSavingIndex = ref(null);

const addNewPhoneNumber = () => {
    newPhoneNumbers.value.push({
        phone_number: '',
        error: null
    });
};

const removeNewPhoneNumber = (index) => {
    newPhoneNumbers.value.splice(index, 1);
};

const updateAllPhoneNumbers = () => {
    // Validate new phone numbers first
    const hasEmptyNumbers = newPhoneNumbers.value.some(num => !num.phone_number);
    if (hasEmptyNumbers) {
        $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.phone_numbers') }), 'error');
        return;
    }

    // Prepare existing phone numbers for update
    const existingPhones = phoneNumbersList.value.map(number => ({
        id: number.id,
        phone_number: number.phone_number
    }));

    // Prepare new phone numbers for creation
    const newPhones = newPhoneNumbers.value.map(number => ({
        phone_number: number.phone_number,
        user_id: page.props.auth.user.id
    }));

    phoneForm.transform(() => ({
        existing_phones: existingPhones,
        new_phones: newPhones,
        user_id: page.props.auth.user.id
    })).put(route('control.system.settings.social-links.update-all-phones'), {
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.phone_numbers') }), 'error');
        },
        onSuccess: () => {
            newPhoneNumbers.value = [];
            $helpers.toast(trans('common.updated'), 'success');
        }
    });
};


const callDelete = (id) => {
    Swal.fire({
        icon: 'warning',
        title: trans('common.are_you_sure'),
        text: trans('common.delete_this'),
        showCancelButton: true,
        confirmButtonText: trans('common.confirm'),
        cancelButtonText: trans('common.cancel'),
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.value) {
            phoneForm.delete(route('control.system.settings.social-links.destroy', id), {
                onSuccess: () => {
                    // Swal.fire({ title: trans('common.deleted'), text: trans('common.record') + ' ' + trans('common.deleted'), icon: 'success', customClass: 'sweet-alerts' });
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });

        }
    });
};

</script>
