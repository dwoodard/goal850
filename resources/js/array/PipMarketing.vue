<template>
  <div>
    <array-pip-marketing
      :appKey="appKey"
      apiUrl="https://array.io"
      sandbox="false"
      signupHref="/billing"
      termsOfUseHref="https://www.goal850.com/terms-of-use"
      privacyPolicyHref="https://www.goal850.com/privacy-policy"
      brandName="Goal 850"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

// add a mount hook to check if the script is loaded
import { onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const appKey = page.props.array.appKey

onMounted(() => {
  window.addEventListener('array-event', function arrayEvent(arrayEvent) {

    // console.info('arrayEvent', arrayEvent.detail.event, arrayEvent.detail.metadata)

    if (arrayEvent.detail.event === 'signup') {
      console.log('Pip Marketing signup:', arrayEvent.detail.metadata)
    }

    if (arrayEvent.detail.event === 'pip-free-scan') {
      console.log('Pip Marketing pip-free-scan:', {
        'metadata': arrayEvent.detail.metadata,
        'route': `/api/user/${page.props.user.id}`
      })

      // save a date on the user model
      axios.post(`/api/user/${page.props.user.id}`, {
        _method: 'PUT',
        last_privacy_scan: new Date().toISOString()
      }).then(response => {
        console.log('User last_privacy_scan updated:', response.data)
      }).catch(error => {
        console.error('Error updating user last_privacy_scan:', error)
      })
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
