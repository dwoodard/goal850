<template>
  <AppLayout>
    <template #header>
      <h2>KBA</h2>
    </template>

    <AuthenticationKBA />
  </AppLayout>
</template>

<script setup>

import AuthenticationKBA from '@/array/AuthenticationKBA.vue'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  user: {
    type: Object
  }
})

</script>

<style scoped>
/* Add any specific styles if needed */
</style>

