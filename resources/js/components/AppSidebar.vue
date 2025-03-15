<script setup>
import {
  Calendar,
  Home,
  Inbox,
  Search,
  Settings
} from 'lucide-vue-next'
import {
  Sidebar,
  SidebarContent,
  SidebarGroup,
  SidebarGroupContent,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem
} from '@/components/ui/sidebar'

const items = [
  { title: 'Home', url: '/', icon: Home },
  { title: 'Inbox', url: '/inbox', icon: Inbox },
  { title: 'Calendar', url: '/calendar', icon: Calendar },
  { title: 'Search', url: '/search', icon: Search },
  { title: 'Settings', url: '/settings', icon: Settings }
]
</script>

<template>
  <Sidebar collapsible="icon" side="left" >
    <SidebarContent>
      <SidebarGroup>
        <SidebarGroupLabel>Application</SidebarGroupLabel>

        <SidebarGroupContent>
          <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
              <SidebarMenuButton asChild>
                <a :href="item.url" class="flex items-center space-x-2">
                  <component :is="item.icon" class="size-5" />

                  <span>{{ item.title }}</span>
                </a>
              </SidebarMenuButton>
            </SidebarMenuItem>
          </SidebarMenu>
        </SidebarGroupContent>
      </SidebarGroup>
    </SidebarContent>
  </Sidebar>
</template>
