<template>
  <div class="podcast-player sticky bottom-0 flex h-24 w-full items-center rounded-lg border-2  bg-slate-200 px-4 shadow-md">
    <!-- add a button to hide -->

    <div
      class="flex items-center gap-4

    ">
      <Avatar v-if="!!podcast" >
        <AvatarImage src="/podcast-cover.jpg" alt="Podcast Cover" />

        <AvatarFallback>PC</AvatarFallback>
      </Avatar>

      <div class="flex flex-col">
        <span class="text-sm font-medium">Podcast Title</span>

        <span class="text-xs text-muted-foreground">Episode Title</span>
      </div>
    </div>

    <div class="m-12 flex items-center gap-2">
      <Button variant="ghost" size="icon">
        <RewindIcon class="size-5" />
      </Button>

      <Button variant="ghost" size="icon">
        <PlayIcon class="size-5" />
      </Button>

      <Button variant="ghost" size="icon">
        <FastForwardIcon class="size-5" />
      </Button>
    </div>
  </div>
</template>

<script setup>
import {
  Avatar,
  AvatarFallback,
  AvatarImage
} from '@/components/ui/avatar'
import { Button } from '@/components/ui/button'
import {
  ChevronUpIcon,
  FastForwardIcon,
  PlayIcon,
  RewindIcon
} from 'lucide-vue-next'
</script>
