<script setup>
import CreditAlerts from '@/array/CreditAlerts.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Alerts" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditAlerts />
    </div>
  </AppLayout>
</template>
