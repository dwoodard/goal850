<script setup >
import {
  SidebarProvider
  // SidebarTrigger
} from '@/components/ui/sidebar'
import AppSidebar from '@/components/AppSidebar.vue'
import { ref } from 'vue'

import SidebarHeader from '@/components/ui/sidebar/SidebarHeader.vue'

import PodcastPlayer from '@/components/PodcastPlayer/Index.vue'

import MainNav from '@/Nav/MainNav.vue'
import { useStorage } from '@vueuse/core'
import LeadConnectorWidget from '@/components/LeadConnectorWidget.vue'

const openPodcast = ref(false)
const openSidebar = useStorage('openSidebar', false)
</script>

<template>
  <SidebarProvider :default-open="openSidebar">
    <template #sidebarHeader>
      <SidebarHeader />
    </template>

    <AppSidebar />

    <main class="flex-1">
      <MainNav />

      <slot />
    </main>

    <PodcastPlayer v-show="openPodcast" />
  </SidebarProvider>

  <LeadConnectorWidget v-if="false" />
</template>

