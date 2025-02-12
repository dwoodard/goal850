<script setup>
import ApplicationLogo from '@/components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen dark:bg-gray-900 flex flex-col p-5">
        <slot />
    </div>

    <div>hey</div>
</template>
