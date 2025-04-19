<template>
  <array-authentication-kba
    :appKey="appKey"
    :userId="userId"
    :apiUrl="apiUrl"
    :sandbox="sandbox"
    showResultPages="true"/>
  {{ this.props }}
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'

defineProps({
  userId: { type: String, required: true },
  apiUrl: { type: String, default: 'https://mock.array.io' },
  sandbox: { type: Boolean, default: function(){

    // if env prod return false
    props.env === 'production' ? false : true

    return true
  } },
  appKey: { type: String, required: true }
})
useArrayScripts('authentication-kba')

const appKey = import.meta.env.VITE_ARRAY_APP_KEY

</script>
