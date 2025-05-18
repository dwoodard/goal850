<script setup>
import CreditScoreSimulator from '@/array/CreditScoreSimulator.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Score Simulator" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditScoreSimulator />
    </div>
  </AppLayout>
</template>
