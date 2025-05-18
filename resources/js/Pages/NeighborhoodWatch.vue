<script setup>
import NeighborhoodWatch from '@/array/NeighborhoodWatch.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Credit Report" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <NeighborhoodWatch />
    </div>
  </AppLayout>
</template>
