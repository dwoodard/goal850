<script setup>
import CreditScoreCoach from '@/array/CreditScoreCoach.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Score Coach" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditScoreCoach />
    </div>
  </AppLayout>
</template>
