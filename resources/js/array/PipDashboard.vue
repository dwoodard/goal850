<template>
  <div>
    <!-- <array-pip-dashboard
      appKey="3F03D20E-5311-43D8-8A76-E4B5D77793BD"
      userToken="4EF162A4-FB08-42FA-8DF6-D436C1379C88"
      apiUrl="https://mock.array.io"
      sandbox="true"/> -->
    <array-pip-dashboard
      :appKey="props?.array?.appKey"
      :userToken="props?.user?.array_user_token"
      :apiUrl="props?.array?.apiComponentUrl"
      :sandbox="props?.array?.sandbox"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

// add a mount hook to check if the script is loaded
import { onMounted } from 'vue'

onMounted(() => {
  window.addEventListener('array-event', function arrayEvent(arrayEvent) {

    // console.info('arrayEvent', arrayEvent.detail.event, arrayEvent.detail.metadata)

  })
})

useArrayScripts('pip-dashboard')

</script>
