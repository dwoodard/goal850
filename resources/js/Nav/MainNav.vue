<template>
  <nav>
    <div class="container mx-auto overflow-hidden">
      <div class=" flex items-center justify-between px-4 py-5">
        <div class="w-auto">
          <div class="flex flex-wrap items-center">
            <div class="mr-14 w-auto">
              <Link href="/">
                <img
                  class="w-32"
                  src="/images/G850-LOGO-WEB-w-Green.png"
                  alt="Goal850 Logo" >
              </Link>
            </div>
          </div>
        </div>

        <div class="w-auto">
          <div class="flex flex-wrap items-center">
            <div class="hidden w-auto lg:block">
              <ul class="mr-16 flex items-center">
                <li
                  v-if="$page.props.auth.user"
                  class="mr-9 font-medium hover:text-gray-700">
                  <Link :href="route('dashboard')">
                    <Button
                      :variant="route().current('dashboard') ? 'outline' : null">
                      Dashboard
                    </Button>
                  </Link>
                </li>

                <li
                  class="mr-9 font-medium hover:text-gray-700">
                  <Button
                    :variant="route().current('blog') ? 'outline' : null"
                    href="#">
                    Blog
                  </Button>
                </li>

                <li
                  v-if="$page.props.auth.user"
                  class="mr-9 font-medium hover:text-gray-700">
                  <a href="#">Tools</a>
                </li>

                <li
                  v-if="!$page.props.auth.user"
                  class="mr-9 font-medium hover:text-gray-700">
                  <a href="#">Solutions</a>
                </li>

                <li
                  v-if="!$page.props.auth.user"
                  class="mr-9 font-medium hover:text-gray-700">
                  <a href="#">Resources</a>
                </li>

                <!-- don't show if auth user-->
                <li
                  v-if="!$page.props.auth.user"
                  class="font-medium hover:text-gray-700">
                  <a href="#">Pricing</a>
                </li>

                <li>
                  <component
                    :is="openPodcast ? Megaphone : MegaphoneOff"
                    class="size-6 cursor-pointer text-gray-700 hover:text-gray-900"
                    @click="openPodcast = !openPodcast"/>
                </li>
              </ul>
            </div>

            <div class="hidden w-auto lg:block">
              <div class="inline-block">
                <nav class="-mx-3 flex flex-1 justify-end">
                  <DropdownMenu
                    v-if="$page.props.auth.user">
                    <DropdownMenuTrigger as-child>
                      <Avatar>
                        <AvatarImage src="https://github.com/radix-vue.png" alt="@radix-vue" />

                        <AvatarFallback>
                          <!-- page.props.auth.user get first name and last name initials -->
                          {{ UserInitials }}
                        </AvatarFallback>
                      </Avatar>
                    </DropdownMenuTrigger>

                    <DropdownMenuContent>
                      <DropdownMenuLabel>
                        {{ $page.props.auth.user.email }}
                      </DropdownMenuLabel>

                      <DropdownMenuSeparator />

                      <DropdownMenuItem>
                        <Link :href="route('profile.edit')">
                          Profile
                        </Link>
                      </DropdownMenuItem>

                      <DropdownMenuItem>
                        <Link :href="route('billing')">
                          Billing
                        </Link>
                      </DropdownMenuItem>

                      <!-- add a logout -->
                      <DropdownMenuItem>
                        <Link
                          :href="route('logout')"
                          method="post">
                          Logout
                        </Link>
                      </DropdownMenuItem>
                    </DropdownMenuContent>
                  </DropdownMenu>

                  <template v-else>
                    <Link :href="route('login')" >
                      <Button> Sign in </Button>
                    </Link>

                    <Link
                      v-if="canRegister"
                      :href="route('register')"
                      class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                      Register
                    </Link>
                  </template>
                </nav>
              </div>
            </div>

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
