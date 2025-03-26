<!-- StripePricing.vue -->
<template>
  <div ref="stripeContainer"/>
</template>

<script setup>
import { onMounted, ref } from 'vue'

const stripeContainer = ref(null)

// define prop
const props = defineProps({
  email: {
    type: String,
    required: true
  }
})

onMounted(() => {
  // Load Stripe script
  if (!document.querySelector('script[src="https://js.stripe.com/v3/pricing-table.js"]')) {
    const script = document.createElement('script')
    script.src = 'https://js.stripe.com/v3/pricing-table.js'
    script.async = true
    script.onload = () => {
      mountStripeTable()
    }
    document.head.appendChild(script)
  } else {
    mountStripeTable()
  }
})

function mountStripeTable() {
  if (!stripeContainer.value.querySelector('stripe-pricing-table')) {
    const stripeElement = document.createElement('stripe-pricing-table')
    stripeElement.setAttribute('pricing-table-id', 'prctbl_1R6kxXHIAHd68JddoXmjrhF8')
    stripeElement.setAttribute('publishable-key', 'pk_test_51Qw5dVHIAHd68JddpIhfBLJlvepfwFuxBH1gyPBNHCbKTEp5u6D4cJ5kLSfRWdfziemCWczbOTe7W5g7ZgHsJxtp009WnOGaSs')
    // set email based on previous step
    stripeElement.setAttribute('customer-email', props.email)
    // phone
    stripeElement.setAttribute('phone-number', props.phone)
    stripeContainer.value.appendChild(stripeElement)
  }
}
</script>
