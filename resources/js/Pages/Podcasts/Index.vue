<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

</script>

<template>
  <AppLayout>
    <div class="container mx-auto">
      <h1>Podcasts</h1>
      <p>Here you can find a list of podcasts.</p>
      <!-- Add your podcast items here -->
      <div class="mt-4">
        <h2 class="text-lg font-semibold">
          Podcast Title
        </h2>
        <p class="text-gray-600">
          Podcast description goes here.
          <a href="/podcasts/1">Listen Now</a>
        </p>
      </div>
    </div>
  </AppLayout>
</template>