<template>
  <AppLayout>
    <div class="mx-auto mb-10 max-w-2xl space-y-6">
      <h2 class="text-2xl font-bold text-gray-800">
        Please answer the following security questions
      </h2>

      <p>
        This information is required to verify your identity. Please answer the questions based on your personal records.
      </p>
    </div>

    <div
      class="mx-auto max-w-2xl rounded-md bg-white p-6 shadow-md">
      <!--  -->
      <AuthenticationKBA
        :userId="user.id"
        :sandbox="true"
        showResultPages="true"/>
    </div>
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