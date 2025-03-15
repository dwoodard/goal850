<script setup >
import {
  SidebarProvider
  // SidebarTrigger
} from '@/components/ui/sidebar'
import AppSidebar from '@/components/AppSidebar.vue'
import { ref } from 'vue'
import SidebarTrigger from '@/components/ui/sidebar/SidebarTrigger.vue'

import SidebarFooter from '@/components/ui/sidebar/SidebarFooter.vue'
import SidebarHeader from '@/components/ui/sidebar/SidebarHeader.vue'
import PodcastPlayer from '@/components/PodcastPlayer/Index.vue'
import MainNav from '@/Nav/MainNav.vue'
const open = ref(false)
</script>

<template>
  <SidebarProvider v-model:open="open">
    <SidebarHeader />

    <AppSidebar />

    <div class="flex flex-col">
      <SidebarTrigger />

      <main class="m-auto  max-w-7xl flex-1 px-4 py-8">
        <MainNav />

        <slot />
      </main>

      <PodcastPlayer />
    </div>

    <SidebarFooter />
  </SidebarProvider>
</template>

