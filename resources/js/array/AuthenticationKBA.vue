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
  userId: {
    type: String,
    required: true
  }
})

const { props } = usePage()
const appKey = props.array.appKey
const apiUrl = props.array.apiUrl
const sandbox = props.array.sandbox
// const apiKey = props.array.apiKey ? props.array.apiKey : '3F03D20E-5311-43D8-8A76-E4B5D77793BD'
// const userToken = props.auth.user ? props.auth.user.token : 'AD45C4BF-5C0A-40B3-8A53-ED29D091FA11'

useArrayScripts('authentication-kba')

</script>
