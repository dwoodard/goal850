<!-- StripePricing.vue -->
<template>
  <div ref="stripeContainer"/>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'

const stripeContainer = ref(null)

const { props } = usePage()

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
    stripeElement.setAttribute('pricing-table-id', props.stripe.pricingTableId)
    stripeElement.setAttribute('publishable-key', props.stripe.publishableKey)
    // set email based on previous step
    stripeElement.setAttribute('customer-email', props.userEmail)
    // phone
    stripeElement.setAttribute('phone-number', props.user.phone)
    stripeContainer.value.appendChild(stripeElement)
  }
}
</script>
