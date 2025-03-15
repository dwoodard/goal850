<template>
  <SidebarProvider style="--sidebar-width: 15rem; --sidebar-width-mobile: 10rem;">
    <AppSidebar />

    <div class="flex">
      <SidebarTrigger />

      <main class="flex-1">
        <slot />
      </main>
    </div>
  </SidebarProvider>
</template>

<script setup >
import {
  SidebarProvider,
  SidebarTrigger
} from '@/components/ui/sidebar'
import AppSidebar from '@/components/AppSidebar.vue'
</script>