<script setup>
import SubscriptionManager from '@/array/SubscriptionManager.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Subscription Manager" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <SubscriptionManager />
    </div>
  </AppLayout>
</template>
