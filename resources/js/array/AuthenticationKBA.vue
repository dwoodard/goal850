<template>
  <client-only>
    <array-authentication-kba
      :appKey="appKey"
      :userId="userId"
      :apiUrl="apiUrl"
      :sandbox="sandbox"
      showResultPages="true"/>
  </client-only>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

defineProps({
  userId: { type: String, required: true },
  apiUrl: { type: String, default: 'https://mock.array.io' },
  sandbox: { type: Boolean, default: true }
})

// const appKey = import.meta.env.VITE_ARRAY_APP_KEY
useArrayScripts('authentication-kba')
</script>
