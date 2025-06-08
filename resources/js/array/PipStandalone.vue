<template>
  <div>
    <array-pip-standalone
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
  // window.addEventListener('array-event', function arrayEvent(arrayEvent) {

  // console.info('arrayEvent', arrayEvent.detail.event, arrayEvent.detail.metadata)

  // })
})

useArrayScripts('pip-standalone')

</script>
