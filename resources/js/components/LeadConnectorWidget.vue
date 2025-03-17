<script setup>
import { onMounted } from 'vue'

onMounted(() => {
  const existingScript = document.getElementById('leadconnector-widget')

  // Avoid loading the script multiple times
  if (!existingScript) {
    const script = document.createElement('script')
    script.id = 'leadconnector-widget'
    script.src = 'https://widgets.leadconnectorhq.com/loader.js'
    script.setAttribute('data-resources-url', 'https://widgets.leadconnectorhq.com/chat-widget/loader.js')
    script.setAttribute('data-widget-id', '6791a86c46f09b3e3cabe181')
    script.async = true
    script.onload = () => {
      console.log('LeadConnector widget loaded')
    }
    script.onerror = () => {
      console.error('Failed to load LeadConnector widget')
    }

    document.body.appendChild(script)
  }
})
</script>