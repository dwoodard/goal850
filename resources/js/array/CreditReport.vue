<template>
  <div>
    <array-credit-report
      :appKey="props?.array?.appKey"
      :userToken="props?.user?.array_user_token"
      :apiUrl="props?.array?.apiComponentUrl"
      :sandbox="props?.array?.sandbox"
      :condensed="condensed"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'
import { usePage } from '@inertiajs/vue3'

const { props } = usePage()

defineProps({
  condensed: {
    type: Boolean,
    default: false
  }
})

useArrayScripts('credit-report')
</script>
