<template>
  <div>
    <!--
    TODO: Implement identity protection plus features
    -->

    <array-identity-protect
      :appKey="props?.array?.appKey"
      :userToken="props?.user?.array_user_token"
      :apiUrl="props?.array?.apiUrl"
      :sandbox="props?.array?.sandbox"
      :autoEnrollmentCode="autoEnrollmentCode"/>

    <!--  -->
  </div>
</template>

<script setup>
import { useArrayScripts } from '@/composables/useArrayScripts'
import { usePage } from '@inertiajs/vue3'

const { props } = usePage()

defineProps({
  autoEnrollmentCode: {
    type: String,
    default: () => {
      //check the user if the user has a plus plan
      return 'disabled'
    }
  }
})

useArrayScripts('identity-protect')
</script>
