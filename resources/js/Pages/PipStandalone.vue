<script setup>

import PipStandalone from '@/array/PipStandalone.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Privacy Scan" />

  <AppLayout>
    <template #header>
      <h2>Personal Info Protection (standalone)</h2>
    </template>

    <section

      class="relative  ">
      <div class="py-16 text-center">
        <div  class="mt-8">
          <PipStandalone />
        </div>
      </div>
    </section>
  </AppLayout>
</template>
