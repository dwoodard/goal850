<template>
  <div>
    <array-student-loan-navigator
      :appKey="props?.array?.appKey"
      :userToken="props?.user?.array_user_token"
      :apiUrl="props?.array?.apiUrl"
      :sandbox="props?.array?.sandbox"
      autolaunch="true"/>
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'
import { usePage } from '@inertiajs/vue3'

const { props } = usePage()

useArrayScripts('student-loan-navigator')
</script>
