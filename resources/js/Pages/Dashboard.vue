<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  user: {
    type: Array
  }
})

if (typeof window !== 'undefined') {
  const script1 = document.createElement('script')
  script1.src = 'https://embed.array.io/cms/array-web-component.js?appKey=3F03D20E-5311-43D8-8A76-E4B5D77793BD'
  document.head.appendChild(script1)

  const script2 = document.createElement('script')
  script2.src = 'https://embed.array.io/cms/array-credit-overview.js?appKey=3F03D20E-5311-43D8-8A76-E4B5D77793BD'
  document.head.appendChild(script2)
}

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout class=" text-white">
    <template #header>
      <h2>Dashboard</h2>
    </template>

    <div class=" flex flex-col justify-center">
      <array-credit-overview
        class="bg-white"
        appKey="3F03D20E-5311-43D8-8A76-E4B5D77793BD"
        userToken="AD45C4BF-5C0A-40B3-8A53-ED29D091FA11"
        apiUrl="https://mock.array.io"
        sandbox="true"/>
    </div>

    <div class="py-12">
      <div class="mx-6 px-5">
        <div class="bg-sky-500">
          You're logged in!
        </div>

        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
          <div v-if="props.user.is_admin">
            <!-- check if user is admin -->
            {{ props.user.is_admin ? 'You are an admin' : 'You are not an admin' }}
          </div>

          <div class="">
            <h1>User Information</h1>

            <div class="mt-4">
              <p>Name: {{ props.user.first_name }} {{ props.user.last_name }}</p>

              <p>Email: {{ props.user.email }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
