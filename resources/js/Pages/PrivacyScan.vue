<script setup>
import PipMarketing from '@/array/PipMarketing.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'

const props = defineProps({
  user: {
    type: Array
  }
})

const page = usePage()
const apiUrl = page.props.array.apiUrl
const sandbox = page.props.array.sandbox

if (typeof window !== 'undefined') {
  const script1 = document.createElement('script')
  script1.src = `https://embed.array.io/cms/array-web-component.js?appKey=${page.props.array.appKey}`
  document.head.appendChild(script1)

  const script2 = document.createElement('script')
  script2.src = `https://embed.array.io/cms/array-credit-overview.js?appKey=${page.props.array.appKey}`
  document.head.appendChild(script2)
}
</script>

<template>
  <Head title="Privacy Scan" />

  <AppLayout>
    <template #header>
      <h2>Privacy Scan</h2>
    </template>

    <section
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
    </section>
  </AppLayout>
</template>
