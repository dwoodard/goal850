<script setup>
import { AvatarImage } from 'radix-vue'

const props = defineProps({
  src: { type: String, required: true },
  referrerPolicy: { type: null, required: false },
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false }
})
</script>

<template>
  <AvatarImage v-bind="props" class="size-full object-cover" />
</template>
