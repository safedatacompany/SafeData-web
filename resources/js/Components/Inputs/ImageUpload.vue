<template>
    <!-- Image -->
    <div class="custom-file-container" data-upload-id="logo">
        <!-- Avatar -->
        <div class="custom-file-container w-auto" data-upload-id="logo">
            <div class="dropdown">
                <Popper :placement="rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="0"
                    class="relative align-middle">
                    <button type="button"
                        class="group btn outline-none border-none hover:underline shadow-none btn-sm text-sm text-primary font-bold dropdown-toggle flex items-center gap-0.5">
                        <div class="relative size-24 xl:size-32">
                            <div
                                class="custom-file-container__image-preview !size-24 xl:!size-32 !rounded-lg !object-fit !mb-5 !mt-0 !overflow-hidden">
                            </div>
                            <div
                                class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-lg duration-500 opacity-0 group-hover:opacity-100">
                                <Svg name="edit_image" class="size-7 xl:size-9 text-white"></Svg>
                            </div>
                        </div>
                    </button>
                    <template #content="{ close }">
                        <ul @click="close()"
                            class="whitespace-nowrap border border-gray-100 dark:border-gray-700 !-mt-5 !py-1">
                            <li>
                                <button type="button" @click="uploadImage()">
                                    {{ $t('common.upload_image') }}
                                    <label class="hidden">
                                        <button type="button"
                                            class="relative w-full custom-file-container__custom-file__custom-file-input !cursor-pointer !opacity-100 text-start px-4 !py-2 font-normal text-sm text-gray-600 hover:text-primary hover:bg-primary/10">
                                            <span class="relative z-10">{{
                                                $t('common.upload_image')
                                            }}</span>
                                            <input @input="logo = $event.target.files[0]" ref="imageProfile" type="file"
                                                class="absolute !inset-0 z-0 w-full !cursor-pointer opacity-0"
                                                accept="image/*" />
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        </button>
                                        <span
                                            class="custom-file-container__custom-file__custom-file-control hidden"></span>
                                    </label>
                                </button>
                            </li>
                            <li>
                                <!-- <button @click.prevent="form.avatar = ''" type="button" -->
                                <button @click="removeImage()" type="button" class="custom-file-container__image-clear">
                                    {{ $t('common.remove_image')
                                    }}
                                </button>
                            </li>
                        </ul>
                    </template>
                </Popper>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, inject, onMounted } from 'vue';
import Svg from '@/Components/Svg.vue';
import FileUploadWithPreview from 'file-upload-with-preview';
import 'file-upload-with-preview/dist/file-upload-with-preview.min.css';

const rtlClass = inject('rtlClass');

const props = defineProps({
    modelValue: {
        type: [Object, String],
        default: '',
    },
    label: {
        type: String,
        default: 'name',
    },
    style: {
        type: String,
        default: '',
    },
});

const logo = ref(null);

watch(() => props.modelValue, (newValue) => {
    logo.value = newValue;
});

watch(() => logo.value, (newValue) => {
    emits('update:modelValue', newValue);
});

const inetilizeAvatar = () => {
    new FileUploadWithPreview('logo', {
        images: {
            baseImage: logo.value || '/assets/images/avatar.png',
        },
    });
}

const imageProfile = ref(null);
const uploadImage = () => {
    imageProfile.value.click();
};

const emits = defineEmits(['update:modelValue', 'update:form']);

const form = ref({
    logo: '',
    remove_logo: false,
});

const removeImage = () => {
    form.value.logo = '';
    form.value.remove_logo = true;
    logo.value = '';
    imageProfile.value = null;
    inetilizeAvatar();

    emits('update:modelValue', form.logo);
    emits('update:form', form.value);
};

onMounted(() => {
    logo.value = props.modelValue;
    setTimeout(() => {
        inetilizeAvatar();
    }, 100);
});

</script>