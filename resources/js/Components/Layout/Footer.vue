<template>
    <footer>
        <div class="dark:text-white-dark text-center ltr:sm:text-left rtl:sm:text-right pt-6">
            © {{ new Date().getFullYear() }} - 
            <a href="https://safedatait.com" target="_blank" class="font-semibold hover:underline">{{ $t('nav.logo') }}</a>
            {{ $t('nav.all_reserved') }}
        </div>
    </footer>
</template>
