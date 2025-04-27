<template>
  <div>
    <!-- <array-credit-overview
      class="bg-white"
      :appKey="appKey"
      :userToken="userToken"
      :apiUrl="apiUrl"
      :sandbox="sandbox"/> -->
    <array-credit-overview
      :appKey="appKey"
      :userToken="userToken"
      :apiUrl="apiUrl"
      :sandbox="sandbox"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'
import { usePage } from '@inertiajs/vue3'

const { props } = usePage()
const appKey = props.array.appKey
const userToken = props.array.userToken
const apiUrl = props.array.apiUrl
const sandbox = props.appEnv === 'local'

useArrayScripts('credit-overview')
</script>
