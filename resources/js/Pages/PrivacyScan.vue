<script setup>
import PipDashboard from '@/array/PipDashboard.vue'
import PipMarketing from '@/array/PipMarketing.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Privacy Scan" />

  <AppLayout>
    <template #header>
      <h2>Privacy Scan</h2>
    </template>

    <!-- <section
      class="relative overflow-hidden bg-white ">
      <div class="py-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800">
          Protect your personal information.
        </h2>

        <p class="mt-4 text-2xl text-gray-600">
          Start with our free Privacy scan.
        </p>

        <PipMarketing />
      </div>
    </section> -->

    <section

      class="relative overflow-hidden bg-white ">
      <div class="py-16 text-center">
        <div v-if="has_stripe_id" class="mt-8">
          <PipDashboard />
        </div>

        <div v-else>
          <h2 class="text-4xl font-bold text-gray-800">
            Protect your personal information.
          </h2>

          <p class="mt-4 text-2xl text-gray-600">
            Start with our free Privacy scan.
          </p>

          <PipMarketing />
        </div>
      </div>
    </section>
  </AppLayout>
</template>
