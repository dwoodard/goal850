<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import StripeTable from '@/components/StripeTable/index.vue'

//get page props

const page = usePage()

</script>

<template>
  <Head title="Billing" />

  <AppLayout>
    <StripeTable :email="page.props.user.email"/>
  </AppLayout>
</template>