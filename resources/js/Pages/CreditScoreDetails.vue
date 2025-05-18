<script setup>
import CreditScoreDetails from '@/array/CreditScoreDetails.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Score Details" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditScoreDetails />
    </div>
  </AppLayout>
</template>
