<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'

//get page props

const page = usePage()

</script>

<template>
  <Head title="Billing" />

  <AppLayout>
    <template #header>
      <h2>Billing</h2>
    </template>

    <div>
      hey, {{ page.props.auth.user.first_name }} {{ page.props.auth.user.last_name }}

      <p>Billing page</p>

      <p>Here you can manage your billing information.</p>
    </div>
  </AppLayout>
</template>