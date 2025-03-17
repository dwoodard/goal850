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
                  src="images/G850-LOGO-WEB-w-Green.png"
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
                  <a href="#">Blog</a>
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
              </ul>
            </div>

            <div class="hidden w-auto lg:block">
              <div class="inline-block">
                <nav class="-mx-3 flex flex-1 justify-end">
                  <Link
                    v-if="$page.props.auth.user"
                    :href="route('logout')"
                    as="button"
                    method="post"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log out
                  </Link>

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
import { MenuIcon } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'
import { useSidebar } from '@/components/ui/sidebar'

const { isOpen,
  toggleSidebar } = useSidebar()

console.log(isOpen)

</script>
