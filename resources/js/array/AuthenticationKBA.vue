<template>
  <array-authentication-kba
    :appKey="appKey"
    :userId="userId"
    :apiUrl="apiUrl"
    :sandbox="sandbox"
    showResultPages="true"/>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

import { usePage } from '@inertiajs/vue3'
const page = usePage()
const env = import.meta.env.VITE_APP_ENV
const appKey = import.meta.env.VITE_ARRAY_APP_KEY

defineProps({
  userId: { type: String, required: true },
  apiUrl: { type: String, default: 'https://mock.array.io' },
  sandbox: { type: Boolean, default: function(){
    return true
  } }
  // appKey: { type: String, required: true }
})
useArrayScripts('authentication-kba')

</script>
