<script setup >

// import AppSidebar from '@/components/AppSidebar.vue'
// import SidebarHeader from '@/components/ui/sidebar/SidebarHeader.vue'
import { ref } from 'vue'

import MainNav from '@/Nav/MainNav.vue'
// import PodcastPlayer from '@/components/PodcastPlayer/Index.vue'
import LeadConnectorWidget from '@/components/LeadConnectorWidget.vue'

// import { useStorage } from '@vueuse/core'

const openPodcast = ref(false)
// const openSidebar = useStorage('openSidebar', false)
</script>

<template>
  <main>
    <MainNav />

    <slot />
  </main>

  <div>
    <!-- <PodcastPlayer v-show="openPodcast" /> -->
    <LeadConnectorWidget v-if="true" />
  </div>

  <!-- <SidebarProvider :default-open="openSidebar">
    <template #sidebarHeader>
      <SidebarHeader />
    </template>

    <AppSidebar />

  </SidebarProvider> -->
</template>

