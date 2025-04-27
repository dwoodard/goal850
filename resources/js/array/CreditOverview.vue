<template>
  <div>
    <array-credit-overview
      class="bg-white"
      appKey="3F03D20E-5311-43D8-8A76-E4B5D77793BD"
      userToken="AD45C4BF-5C0A-40B3-8A53-ED29D091FA11"
      apiUrl="https://mock.array.io"
      sandbox="true"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

defineProps({
  userToken: { type: String, required: true },
  apiUrl: { type: String, default: 'https://mock.array.io' },
  sandbox: { type: Boolean, default: true }
})

const appKey = import.meta.env.VITE_ARRAY_APP_KEY
useArrayScripts('credit-overview')
</script>
