<script setup>
import IdentityProtect from '@/array/IdentityProtect.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>

<template>
  <Head title="Identity Protection" />

  <AppLayout>
    <div class="flex flex-col justify-center ">
      <IdentityProtect />
    </div>
  </AppLayout>
</template>
