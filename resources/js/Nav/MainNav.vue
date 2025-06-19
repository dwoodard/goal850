<template>
  <nav>
    <div class="container mx-auto">
      <div class=" flex items-center justify-between px-4 py-5">
        <div class="w-auto">
          <div class="flex flex-wrap items-center">
            <div class="mr-14 w-auto">
              <Link href="/">
                <img
                  class="w-40 lg:w-96"
                  src="/images/G850-LOGO-WEB-w-Green.png"
                  alt="Goal850 Logo" >
              </Link>
            </div>
          </div>
        </div>

        <div class="w-auto">
          <div class="flex flex-wrap items-center">
            <div class="hidden w-auto  lg:block">
              <!-- Guest Menu -->
              <ul v-if="!$page.props.user" class="flex items-center space-x-8">
                <NavigationMenu>
                  <NavigationMenuList>
                    <template v-for="section in visibleNavItems">
                      <NavigationMenuItem
                        v-if="section.children.length === 1 && section.children[0].asButton"
                        :key="section.children[0].name">
                        <Link :href="routeOrPath(section.children[0].route)">
                          <Button>{{ section.children[0].name }}</Button>
                        </Link>
                      </NavigationMenuItem>

                      <!-- Normal dropdown -->
                      <NavigationMenuItem
                        v-else
                        :key="section.title || section.children[0]?.name">
                        <NavigationMenuTrigger>{{ section.title || 'Menu' }}</NavigationMenuTrigger>
                        <NavigationMenuContent>
                          <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px]">
                            <li v-for="item in section.children" :key="item.name">
                              <NavigationMenuLink as-child>
                                <Link
                                  :href="routeOrPath(item.route)"
                                  :class="[
                                    'block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent focus:bg-accent',

                                  ]">
                                  <div class="text-sm font-medium leading-none">
                                    {{ item.name }}
                                  </div>
                                </Link>
                              </NavigationMenuLink>
                            </li>
                          </ul>
                        </NavigationMenuContent>
                      </NavigationMenuItem>
                    </template>
                  </NavigationMenuList>
                </NavigationMenu>
              </ul>

              <!-- User Menu -->
              <ul v-if="$page.props.user" class="flex items-center space-x-8">
                <NavigationMenu>
                  <NavigationMenuList>
                    <NavigationMenuItem
                      v-for="section in visibleNavItems"
                      :key="section.title || section.children[0]?.name">
                      <NavigationMenuTrigger>{{ section.title || 'Menu' }}</NavigationMenuTrigger>
                      <NavigationMenuContent>
                        <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px]">
                          <li v-for="item in section.children" :key="item.name">
                            <NavigationMenuLink as-child>
                              <Link
                                :href="routeOrPath(item.route)"
                                :class="[
                                  'block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent focus:bg-accent',
                                  { 'bg-gray-100': isActive(item.route) }
                                ]">
                                <div class="text-sm font-medium leading-none">
                                  {{ item.name }}

                                  <div class="text-xs text-gray-500">
                                    {{ item.description }}
                                  </div>
                                </div>
                              </Link>
                            </NavigationMenuLink>
                          </li>
                        </ul>
                      </NavigationMenuContent>
                    </NavigationMenuItem>
                  </NavigationMenuList>
                </NavigationMenu>
              </ul>
            </div>

            <div class="w-auto lg:hidden">
              <Sheet>
                <SheetTrigger as-child>
                  <Button variant="outline">
                    <MenuIcon />
                  </Button>
                </SheetTrigger>
                <SheetContent
                  class="max-h-[100vh] overflow-y-auto">
                  <!-- mobile menu -->
                  <Accordion
                    type="single"
                    collapsible
                    :default-value="defaultOpenSection"
                    class="">
                    <div
                      class="">
                      <!-- Render regular dropdowns -->
                      <AccordionItem
                        v-for="section in navItems.filter(i => i.show !== false && !(i.children.length === 1 && i.children[0].asButton))"
                        :key="section.title || section.children[0]?.name"
                        :value="(section.title || section.children[0]?.name).toLowerCase()">
                        <AccordionTrigger class="w-full text-left font-semibold text-gray-900">
                          {{ section.title || 'Menu' }}
                        </AccordionTrigger>
                        <AccordionContent>
                          <div
                            v-for="item in section.children"
                            :key="item.name"
                            class="relative rounded-lg p-4 hover:bg-gray-50">
                            <Link
                              :href="routeOrPath(item.route)"
                              :class="[
                                'block font-semibold text-gray-900'
                              ]">
                              {{ item.name }}
                              <span class="absolute inset-0"/>
                            </Link>
                            <p class="mt-1 text-gray-600">
                              {{ item.description }}
                            </p>
                          </div>
                        </AccordionContent>
                      </AccordionItem>

                      <!-- Render button-style item(s) -->
                      <div
                        v-for="section in navItems.filter(i =>
                          i.show !== false &&
                          i.children.length === 1 &&
                          i.children[0].asButton)"
                        :key="'button-' + section.children[0].name"
                        class="mt-4">
                        <Link :href="routeOrPath(section.children[0].route)">
                          <Button class="w-full">
                            {{ section.children[0].name }}
                          </Button>
                        </Link>
                      </div>
                    </div>
                  </Accordion>
                </SheetContent>
              </Sheet>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import Button from '@/components/ui/button/Button.vue'
import { MenuIcon } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'

import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

// Navigation Menu
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger
} from '@/components/ui/navigation-menu'

import {
  Sheet,
  SheetContent,
  SheetTrigger
} from '@/components/ui/sheet'
import Accordion from '@/components/ui/accordion/Accordion.vue'
import AccordionItem from '@/components/ui/accordion/AccordionItem.vue'
import AccordionTrigger from '@/components/ui/accordion/AccordionTrigger.vue'
import AccordionContent from '@/components/ui/accordion/AccordionContent.vue'

// -----------------------------------------------------------------------------
const _openPodcast = ref(false)
const $page = usePage()
const isLoggedIn = !!$page.props.user
const isActive = (path) => $page.url === routeOrPath(path)

const _scrollTo = (event) => {
  event.preventDefault()

  let link = event.target
  while (link && link.tagName !== 'A') {
    link = link.parentElement
  }

  if (!link) return

  const targetId = link.getAttribute('href')?.substring(1)
  const targetElement = document.getElementById(targetId)
  if (targetElement) {
    targetElement.scrollIntoView({ behavior: 'smooth' })
  }
}
// -----------------------------------------------------------------------------

const visibleNavItems = computed(() =>
  navigationItems(!!$page.props.user).filter(i => i.show !== false)
)

// Get the default open section based on the defaultOpen property in the navigation items
const defaultOpenSection = computed(() => {
  const defaultOpenItem = navItems.find(i =>
    i.show !== false &&
    !(i.children.length === 1 && i.children[0].asButton) &&
    i.defaultOpen === true
  )
  if (!defaultOpenItem) return ''
  const title = defaultOpenItem.title || (defaultOpenItem.children?.[0]?.name || '')
  return title.toLowerCase()
})

// 🧮 Navigation structure
const navigationItems = ( isLoggedIn = false ) => [
  {
    title: 'My Credit',
    show: isLoggedIn,
    defaultOpen: true, // This section will be open by default on mobile
    children: [
      { name: 'Dashboard', route: 'dashboard.overview', description: 'View your dashboard' },
      { name: 'Credit Report', route: 'credit.report', description: 'View your credit report' },
      { name: 'Debt Analysis', route: 'credit.debt.analysis', description: 'Analyze your debt' },
      { name: 'Score Factors', route: 'credit.score.insights', description: 'View factors affecting your score' },
      { name: 'Score Simulator', route: 'credit.score.simulator', description: 'Simulate your credit score' },
      { name: 'Score Tracker', route: 'credit.score', description: 'Track your credit score' },
      { name: 'Credit Monitoring', route: 'credit.alerts', description: 'Monitor your credit' },
      { name: 'Identity Protection', route: 'credit.protection', description: 'Protect your identity' },
      { name: 'Neighborhood Watch', route: 'neighborhood.watch', description: 'Watch your neighborhood' },
      // { name: 'Privacy Scan', route: 'privacy.scan' },
      { name: 'Personal Info Protection', route: 'pip.scan' }
    ]
  },
  {
    title: 'Account',
    show: isLoggedIn,
    defaultOpen: false,
    children: [
      { name: 'Profile', route: '/profile' },
      { name: 'Billing', route: '/billing' },
      { name: 'Logout', route: '/logout' }
    ]
  },
  {
    title: 'Pricing',
    show: !isLoggedIn,
    defaultOpen: true, // This section will be open by default on mobile for guests
    children: [
      { name: 'Pricing Details', route: '/#pricing' },
      { name: 'Monthly Plan', route: '/#pricing' },
      { name: 'Yearly Plan', route: '/#pricing' }
    ]
  },
  {
    title: 'Products',
    show: false,
    defaultOpen: false,
    children: [
      { name: 'Product 1', route: '/products/product1' },
      { name: 'Product 2', route: '/products/product2' }
    ]
  },
  {
    title: 'Education',
    show: !isLoggedIn,
    defaultOpen: false,
    children: [
      { name: 'Tutorials', route: '/education/tutorials' },
      { name: 'Webinars', route: '/education/webinars' }
    ]
  },
  {
    title: 'Resources',
    show: !isLoggedIn,
    defaultOpen: false,
    children: [
      { name: 'Blog', route: '/resources/blog' },
      { name: 'FAQ', route: '/resources/faq' }
    ]
  },
  {
    title: '',
    show: !isLoggedIn,
    defaultOpen: false,
    children: [
      {
        name: 'Secure Log In',
        route: 'login' ,
        asButton: true
      }
    ]
  }
]

const navItems = navigationItems(isLoggedIn)

const routeOrPath = (r) => {
  if (!r) return '#'
  return r.startsWith('/') || r.startsWith('#') ? r : route(r)
}

</script>
