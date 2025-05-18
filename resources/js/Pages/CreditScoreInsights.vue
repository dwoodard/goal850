<script setup>
import CreditScoreInsights from '@/array/CreditScoreInsights.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Score Insights" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditScoreInsights />
    </div>
  </AppLayout>
</template>
