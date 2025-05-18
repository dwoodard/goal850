<script setup>
import CreditDebtAnalysis from '@/array/CreditDebtAnalysis.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Debt Analysis" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditDebtAnalysis />
    </div>
  </AppLayout>
</template>
