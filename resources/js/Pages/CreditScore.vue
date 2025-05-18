<script setup>
import CreditScore from '@/array/CreditScore.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Score" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <CreditScore />
    </div>
  </AppLayout>
</template>
