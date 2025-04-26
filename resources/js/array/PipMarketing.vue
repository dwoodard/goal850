<template>
  <div>
    <array-pip-marketing
      appKey="A0ADD6AD-8182-4D66-8F13-78AA2B716899"
      apiUrl="https://array.io"
      sandbox="false"
      signupHref="/register"
      termsOfUseHref="https://www.array.com"
      privacyPolicyHref="https://www.array.com"
      brandName="Array"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

// add a mount hook to check if the script is loaded
import { onMounted } from 'vue'

onMounted(() => {
  window.addEventListener('array-event', function arrayEvent(arrayEvent) {

    console.info('arrayEvent', arrayEvent.detail.event, arrayEvent.detail.metadata)

    if (arrayEvent.detail.event === 'signup') {
      console.log('Pip Marketing signup:', arrayEvent.detail.metadata)
    }

    if (arrayEvent.detail.event === 'pip-free-scan') {
      console.log('Pip Marketing pip-free-scan:', arrayEvent.detail.metadata)
    }

    if (arrayEvent.detail.event === 'pip-free-first-results-returned') {
      console.log('Pip Marketing pip-free-first-results-returned:', arrayEvent.detail.metadata)
    }

    if (arrayEvent.detail.event === 'scroll-to-top') {
      console.log('Pip Marketing scroll-to-top:', arrayEvent.detail.metadata)
    }

    if (arrayEvent.detail.event === 'pip-free-scan-complete') {
      console.log('Pip Marketing pip-free-scan-complete:', arrayEvent.detail.metadata)
    }

  })
})

useArrayScripts('pip-marketing')

</script>
