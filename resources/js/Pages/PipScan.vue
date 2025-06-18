<script setup>
import PipScan from '@/array/PipScan.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Personal Info Protection" />

  <AppLayout>
    <template #header>
      <h2>Personal Info Protection</h2>
    </template>

    <section class="relative">
      <div class="py-16 text-center">
        <div>
          <PipScan />
        </div>
      </div>
    </section>
  </AppLayout>
</template>
