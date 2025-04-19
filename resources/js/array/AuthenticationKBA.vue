<template>
  <array-authentication-kba
    :appKey="appKey"
    :userId="userId"
    :apiUrl="apiUrl"
    :sandbox="sandbox"
    showResultPages="true"/>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

// add a mount hook to check if the script is loaded
import { onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

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

const appKey = import.meta.env.VITE_ARRAY_APP_KEY

defineProps({
  userId: { type: String, required: true },
  apiUrl: { type: String, default: 'https://mock.array.io' },
  sandbox: { type: Boolean, default: function(){
    return true // check if sandbox is true
  } }
  // appKey: { type: String, required: true }
})
useArrayScripts('authentication-kba')

</script>
