<template>
  <div>
    <array-credit-overview
      class="bg-white"
      :appKey="appKey"
      :userToken="userToken"
      :apiUrl="apiUrl"
      sandbox="true"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'
import { usePage } from '@inertiajs/vue3'

defineProps({
  // userToken: { type: String, required: true },
  apiUrl: { type: String, default: 'https://mock.array.io' },
  sandbox: { type: Boolean, default: true }
})
const { props } = usePage()
const appKey = props.array.appKey
const apiKey = props.array.apiKey ? props.array.apiKey : '3F03D20E-5311-43D8-8A76-E4B5D77793BD'
const userToken = props.auth.user ? props.auth.user.token : 'AD45C4BF-5C0A-40B3-8A53-ED29D091FA11'

useArrayScripts('credit-overview')
</script>
