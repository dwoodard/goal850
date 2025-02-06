<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    user: {
        type: Array,
    },
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout class=" text-white">
        <template #header>
            <h2>Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-6 px-5">
                <div class="bg-sky-500">You're logged in!</div>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">


                    <div v-if="props.user.is_admin">
                        <!-- check if user is admin -->
                        {{ props.user.is_admin ? 'You are an admin' : 'You are not an admin' }}
                    </div>

                    <div class="">
                        <h1>User Information</h1>
                        <div class="mt-4">
                            <p>Name: {{ props.user.first_name }} {{ props.user.last_name }}</p>
                            <p>Email: {{ props.user.email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
