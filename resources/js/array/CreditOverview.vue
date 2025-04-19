<template>
  <client-only>
    <array-credit-overview
      class="bg-white"
      :appKey="appKey"
      :userToken="userToken"
      :apiUrl="apiUrl"
      :sandbox="sandbox"/>
  </client-only>
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
