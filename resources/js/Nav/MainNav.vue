<template>
  <nav>
    <div class="container mx-auto overflow-hidden">
      <div class=" flex items-center justify-between px-4 py-5">
        <div class="w-auto">
          <div class="flex flex-wrap items-center">
            <div class="mr-14 w-auto">
              <a href="#">
                <img src="images/G850-LOGO-WEB-w-Green.png" alt="">
              </a>
            </div>
          </div>
        </div>

        <div class="w-auto">
          <div class="flex flex-wrap items-center">
            <div class="hidden w-auto lg:block">
              <ul class="mr-16 flex items-center">
                <li class="mr-9 font-medium hover:text-gray-700">
                  <a href="#">Blog</a>
                </li>

                <li class="mr-9 font-medium hover:text-gray-700">
                  <a href="#">Solutions</a>
                </li>

                <li class="mr-9 font-medium hover:text-gray-700">
                  <a href="#">Resources</a>
                </li>

                <li class="font-medium hover:text-gray-700">
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
                    <inertia-link :href="route('login')" >
                      <Button> Sign in </Button>
                    </inertia-link>

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
import { useSidebar } from '@/components/ui/sidebar'
import { MenuIcon } from 'lucide-vue-next'
const { toggleSidebar } = useSidebar()

</script>
