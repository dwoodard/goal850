<template>
  <AppLayout>
    <template #header>
      <h2>Security Questions</h2>
    </template>

    <AuthenticationKBA
      :userId="user.array_user_id"
      :sandbox="true"
      showResultPages="true"/>
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