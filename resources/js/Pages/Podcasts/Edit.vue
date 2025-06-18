<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>
  <AppLayout>
    <div class="container mx-auto">
      <h1>Edit Podcast</h1>
      <p>Update the details of your podcast below.</p>
      <!-- Podcast edit form -->
      <form class="mt-4">
        <div class="mb-4">
          <label class="mb-2 block font-bold text-gray-700" for="title">
            Title
          </label>
          <input
            id="title"
            type="text"
            class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
            placeholder="Podcast Title">
        </div>
        <div class="mb-4">
          <label class="mb-2 block font-bold text-gray-700" for="description">
            Description
          </label>
          <textarea
            id="description"
            class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
            placeholder="Podcast Description"/>
        </div>
        <button
          type="submit"
          class="focus:shadow-outline rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none">
          Save Changes
        </button>
      </form>
    </div>
  </AppLayout>
</template>