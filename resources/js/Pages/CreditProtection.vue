<script setup>
import CreditProtection from '@/array/CreditProtection.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Protection" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditProtection />
    </div>
  </AppLayout>
</template>
