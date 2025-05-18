<template>
  <div>
    <array-credit-score-simulator
      :appKey="props?.array?.appKey"
      :userToken="props?.user?.array_user_token"
      :apiUrl="props?.array?.apiUrl"
      :sandbox="props?.array?.sandbox"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'
import { usePage } from '@inertiajs/vue3'

const { props } = usePage()

useArrayScripts('credit-score-simulator')
</script>
