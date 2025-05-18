<template>
  <array-authentication-kba
    :appKey="props?.array?.appKey"
    :userId="props?.user?.array_user_id"
    :apiUrl="props?.array?.apiUrl"
    :sandbox="props?.array?.sandbox"
    :showResultPages="showResultPages"/>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

// add a mount hook to check if the script is loaded
import { onMounted } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

onMounted(() => {
  window.addEventListener('array-event', function arrayEvent(arrayEvent) {
    if (arrayEvent.detail.event === 'success') {
      router.post(route('registration.wizard.kba.store'), arrayEvent.detail.metadata)
    }

    if (arrayEvent.detail.event === 'error') {
      console.log(arrayEvent.detail.metadata)
    }
  })
})

defineProps({
  showResultPages: {
    type: Boolean,
    default: true
  }
})

const { props } = usePage()

useArrayScripts('authentication-kba')
</script>