<script setup>
import CreditReport from '@/array/CreditReport.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Report" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditReport />
    </div>
  </AppLayout>
</template>
