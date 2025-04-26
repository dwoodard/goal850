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
              <ul v-if="!$page.props.auth.user" class="flex items-center space-x-8 ">
                <NavigationMenu>
                  <NavigationMenuList>
                    <NavigationMenuItem>
                      <NavigationMenuTrigger>Pricing</NavigationMenuTrigger>

                      <NavigationMenuContent>
                        <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px] lg:grid-cols-[minmax(0,.75fr)_minmax(0,1fr)]">
                          <li class="row-span-3">
                            <NavigationMenuLink as-child>
                              <a
                                class="flex size-full select-none flex-col justify-end rounded-md bg-gradient-to-b from-muted/50 to-muted p-6 no-underline outline-none focus:shadow-md"
                                href="#pricing">
                                <img src="/images/pricing-icon.svg" class="size-6">

                                <div class="mb-2 mt-4 text-lg font-medium">
                                  Pricing Details
                                </div>

                                <p class="text-sm leading-tight text-muted-foreground">
                                  Explore our pricing plans and find the best fit for your needs.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/pricing/monthly"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Monthly Plan</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Flexible monthly subscription for short-term needs.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/pricing/yearly"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Yearly Plan</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Save more with an annual subscription.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>
                        </ul>
                      </NavigationMenuContent>
                    </NavigationMenuItem>

                    <NavigationMenuItem>
                      <NavigationMenuTrigger>Products</NavigationMenuTrigger>

                      <NavigationMenuContent>
                        <ul class="grid w-[400px] gap-3 p-4 md:w-[500px] md:grid-cols-2 lg:w-[600px]">
                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/products/product1"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Product 1</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Description of Product 1.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/products/product2"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Product 2</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Description of Product 2.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>
                        </ul>
                      </NavigationMenuContent>
                    </NavigationMenuItem>

                    <NavigationMenuItem>
                      <NavigationMenuTrigger>Education</NavigationMenuTrigger>

                      <NavigationMenuContent>
                        <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px]">
                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/education/tutorials"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Tutorials</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Step-by-step guides to help you get started.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/education/webinars"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Webinars</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Join live sessions with experts.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>
                        </ul>
                      </NavigationMenuContent>
                    </NavigationMenuItem>

                    <NavigationMenuItem>
                      <NavigationMenuTrigger>Resources</NavigationMenuTrigger>

                      <NavigationMenuContent>
                        <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px]">
                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/resources/blog"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Blog</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Read our latest articles and updates.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/resources/faq"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">FAQ</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Frequently asked questions.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>
                        </ul>
                      </NavigationMenuContent>
                    </NavigationMenuItem>

                    <NavigationMenuItem>
                      <Link :href="route('login')" class="inline-flex items-center">
                        <Button>Secure Log In</Button>
                      </Link>
                    </NavigationMenuItem>
                  </NavigationMenuList>
                </NavigationMenu>
              </ul>

              <!-- User Menu -->
              <ul v-if="$page.props.auth.user" class="flex items-center space-x-8">
                <NavigationMenu>
                  <NavigationMenuList>
                    <NavigationMenuItem>
                      <NavigationMenuTrigger>Dashboard</NavigationMenuTrigger>

                      <NavigationMenuContent>
                        <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px]">
                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/dashboard/overview"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Overview</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  View your dashboard overview and recent activity.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/dashboard/settings"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Settings</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Manage your account and preferences.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>
                        </ul>
                      </NavigationMenuContent>
                    </NavigationMenuItem>

                    <NavigationMenuItem>
                      <NavigationMenuTrigger>Podcast</NavigationMenuTrigger>

                      <NavigationMenuContent>
                        <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px]">
                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/podcast/latest"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Latest Episodes</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Listen to the latest podcast episodes.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/podcast/subscribe"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Subscribe</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Stay updated with new episodes.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>
                        </ul>
                      </NavigationMenuContent>
                    </NavigationMenuItem>

                    <NavigationMenuItem>
                      <NavigationMenuTrigger>Account</NavigationMenuTrigger>

                      <NavigationMenuContent>
                        <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px]">
                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/profile"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Profile</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Edit your profile information.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/billing"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Billing</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Manage your billing and subscriptions.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>

                          <li>
                            <NavigationMenuLink as-child>
                              <a
                                href="/logout"
                                class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground">
                                <div class="text-sm font-medium leading-none">Logout</div>

                                <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                  Sign out of your account.
                                </p>
                              </a>
                            </NavigationMenuLink>
                          </li>
                        </ul>
                      </NavigationMenuContent>
                    </NavigationMenuItem>
                  </NavigationMenuList>
                </NavigationMenu>
              </ul>
            </div>

            <div class="hidden w-auto lg:block"/>

            <div class="w-auto lg:hidden">
              <button @click="toggleSidebar">
                <MenuIcon />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import Button from '@/components/ui/button/Button.vue'
import {
  Megaphone, MegaphoneOff, MenuIcon
} from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'
import { useSidebar } from '@/components/ui/sidebar'
import Avatar from '@/components/ui/avatar/Avatar.vue'
import AvatarImage from '@/components/ui/avatar/AvatarImage.vue'
import AvatarFallback from '@/components/ui/avatar/AvatarFallback.vue'
import DropdownMenu from '@/components/ui/dropdown-menu/DropdownMenu.vue'
import DropdownMenuTrigger from '@/components/ui/dropdown-menu/DropdownMenuTrigger.vue'
import DropdownMenuContent from '@/components/ui/dropdown-menu/DropdownMenuContent.vue'
import DropdownMenuLabel from '@/components/ui/dropdown-menu/DropdownMenuLabel.vue'
import DropdownMenuSeparator from '@/components/ui/dropdown-menu/DropdownMenuSeparator.vue'
import DropdownMenuItem from '@/components/ui/dropdown-menu/DropdownMenuItem.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'
import NavigationMenu from '@/components/ui/navigation-menu/NavigationMenu.vue'
import NavigationMenuList from '@/components/ui/navigation-menu/NavigationMenuList.vue'
import NavigationMenuItem from '@/components/ui/navigation-menu/NavigationMenuItem.vue'
import NavigationMenuTrigger from '@/components/ui/navigation-menu/NavigationMenuTrigger.vue'
import NavigationMenuContent from '@/components/ui/navigation-menu/NavigationMenuContent.vue'
import NavigationMenuLink from '@/components/ui/navigation-menu/NavigationMenuLink.vue'
import Toggle from '@/components/ui/toggle/Toggle.vue'
const { toggleSidebar } = useSidebar()
const openPodcast = ref(false)
const $page = usePage()

const UserInitials = computed(() => {
  if ($page.props.auth.user) {
    return $page.props.auth.user.first_name.charAt(0) + $page.props.auth.user.last_name.charAt(0)
  }
  return ''
})

</script>
