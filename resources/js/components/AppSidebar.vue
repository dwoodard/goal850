<script setup>
import {
  Calendar,
  ChevronDown,
  Folder,
  Home,
  Inbox,
  Settings
} from 'lucide-vue-next'

import {
  Sidebar,
  SidebarContent,
  SidebarGroup,
  SidebarGroupContent,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem
} from '@/components/ui/sidebar'
import { Link } from '@inertiajs/vue3'

const items = [
  { title: 'Home', url: '/', icon: Home },
  { title: 'Blog', url: '/blog', icon: Inbox },
  { title: 'Solution', url: '/solution', icon: Calendar },
  { title: 'Resources', url: '/resources', icon: Folder },
  { title: 'Settings', url: '/settings', icon: Settings }
]
// import { useParticles } from '@/composables/useParticles.js'

import SidebarHeader from './ui/sidebar/SidebarHeader.vue'
import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger
} from './ui/collapsible'

</script>

<template>
  <Sidebar variant="sidebar">
    <SidebarHeader>
      <img src="images/Goal-850-Web-Logo-BW.png" alt="Goal850 Logo">
    </SidebarHeader>

    <Collapsible>
      <CollapsibleTrigger>
        <SidebarMenuButton asChild>
          <Link href="dashboard" class="flex items-center space-x-2">
            <Home />

            <span>Dashboard</span>
          </Link>
        </SidebarMenuButton>
      </CollapsibleTrigger>

      <CollapsibleContent>
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton asChild>
              <Link href="/dashboard" class="flex items-center space-x-2">
                <Home />

                <span>Dashboard</span>
              </Link>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </CollapsibleContent>
    </Collapsible>

    <SidebarContent>
      <SidebarGroup>
        <SidebarGroupContent>
          <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
              <SidebarMenuButton asChild>
                <Link :href="item.url" class="flex items-center space-x-2">
                  <item.icon />

                  <span>{{ item.title }}</span>
                </Link>
              </SidebarMenuButton>
            </SidebarMenuItem>
          </SidebarMenu>
        </SidebarGroupContent>
      </SidebarGroup>
    </SidebarContent>
  </Sidebar>

  <PodcastPlayer />
</template>
