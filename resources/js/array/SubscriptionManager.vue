<template>
  <div>
    <array-subscription-manager
      :appKey="props?.array?.appKey"
      :userToken="props?.user?.array_user_token"
      :apiUrl="props?.array?.apiUrl"
      :sandbox="props?.array?.sandbox"
      provider="plaid"
      mode="premium"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'
import { usePage } from '@inertiajs/vue3'

const { props } = usePage()

useArrayScripts('subscription-manager')
</script>
