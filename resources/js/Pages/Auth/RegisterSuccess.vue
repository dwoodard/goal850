<script setup>

import { usePage } from '@inertiajs/vue3'
const page = usePage()
console.log(page.props)

</script>

<template>
  <div>
    <pre>{{ page.props.auth.user}}</pre>
  </div>
</template>