<script setup>
import {
  Head,
  Link
} from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref } from 'vue'
import PipMarketing from '@/array/PipMarketing.vue'
// import { useParticles } from '@/composables/useParticles.js'
defineProps({
  canLogin: {
    type: Boolean
  },
  canRegister: {
    type: Boolean
  }

})

const subscribeEmail = ref(null)

const scrollToBottom = () => {
  subscribeEmail.value?.scrollIntoView({ behavior: 'smooth' })
}

// Use the composable for particles
// const { canvasRef } = useParticles(50)

</script>

<template>
  <AppLayout>
    <Head title="Welcome" />

    <section class="overflow-auto bg-[#32383F] md:-mb-10 lg:max-h-[480px] ">
      <div class="container mx-auto px-4  lg:px-10">
        <div class="-mt-14 flex flex-wrap justify-between lg:items-center ">
          <div class="w-full pt-10  md:w-1/2 md:px-10">
            <div
              v-motion
              :initial="{ opacity: 0, x: -25, }"
              :enter="{ opacity: 1, x: 0, transition: { type: 'spring', stiffness: '25', delay: 1000, }, }"
              :variants="{ custom: { scale: 2 } }"
              :delay="200"
              :duration="2400">
              <h2 class="mb-4 text-4xl font-bold text-white">
                Did you apply for a loan online?
              </h2>

              <p class="text-bold mb-4 text-2xl  text-white">
                Your personal and banking info may be exposed.
              </p>

              <p class="text-sm text-white">
                Up to 98% of consumers have their information exposed on Data Broker and People Search sites—putting their privacy and security at risk.
              </p>
            </div>
          </div>

          <img
            v-motion
            :initial="{ opacity: 0, x: 25, }"
            :enter="{ opacity: 1, x: 0, transition: { type: 'spring', stiffness: '25', delay: 1000, }, }"
            :variants="{ custom: { scale: 2 } }"
            :delay="200"
            :duration="2400"
            src="images/GOAT-Mascot.png"
            alt="GOAT Mascot"
            class="relative mx-auto mt-20 h-auto w-full object-contain md:w-1/2 lg:mt-0 lg:max-w-[500px] lg:object-cover lg:object-right"
            style="bottom: 40px; max-height: 450px;">
        </div>
      </div>
    </section>

    <section
      class="relative overflow-hidden bg-white "
      style="background-image: url('flaro-assets/images/pricing/gradient6.svg'); background-size: cover; background-position: center;">
      <!--  -->
      <div class="py-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800">
          Protect your personal information.
        </h2>

        <p class="mt-4 text-2xl text-gray-600">
          Start with our free Privacy scan.
        </p>

        <PipMarketing />
      </div>
    </section>

    <section class="relative overflow-hidden bg-[#32383F] py-32">
      <!--  -->
      pricing
    </section>

    <section class="relative overflow-hidden bg-white py-32">
      <img class="absolute bottom-0 right-0" src="flaro-assets/images/pricing/gradient6.svg" alt="">

      <div class="container mx-auto px-4">
        <div class="-m-8 flex flex-wrap">
          <div class="w-full p-8 md:w-1/2">
            <div class="flex h-full flex-col justify-between md:max-w-md">
              <div>
                <h2 class="xl:text-10xl font-heading tracking-px-n mb-8 text-6xl font-bold leading-none md:text-8xl">
                  Affordable pricing plans
                </h2>

                <p class="mb-16 font-medium leading-relaxed text-gray-600">
                  Amet minim mollit non deserunt ullamco an aliqua dolor elit officia consequat duis.Amet minim mollit non deserunt ullamco est sit aliqua.
                </p>
              </div>

              <div>
                <h3 class="mb-3 font-semibold text-gray-900">
                  Soon to be trusted by 1M+ customers
                </h3>

                <div class="-m-1 flex flex-wrap items-center">
                  <div class="w-auto p-1">
                    <div class="-m-0.5 flex flex-wrap">
                      <div class="w-auto p-0.5">
                        <svg
                          width="17"
                          height="16"
                          viewbox="0 0 17 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.707 1.21267C8.02812 0.224357 9.42632 0.224357 9.74744 1.21267L10.8948 4.74387C11.0384 5.18586 11.4503 5.48511 11.915 5.48511H15.6279C16.6671 5.48511 17.0992 6.81488 16.2585 7.42569L13.2547 9.60809C12.8787 9.88126 12.7214 10.3654 12.865 10.8074L14.0123 14.3386C14.3335 15.327 13.2023 16.1488 12.3616 15.538L9.35775 13.3556C8.98178 13.0824 8.47266 13.0824 8.09669 13.3556L5.09287 15.538C4.25216 16.1488 3.12099 15.327 3.44211 14.3386L4.58947 10.8074C4.73308 10.3654 4.57575 9.88126 4.19978 9.60809L1.19596 7.42569C0.355248 6.81488 0.787317 5.48511 1.82649 5.48511H5.53942C6.00415 5.48511 6.41603 5.18586 6.55964 4.74387L7.707 1.21267Z" fill="#6366F1"/>
                        </svg>
                      </div>

                      <div class="w-auto p-0.5">
                        <svg
                          width="17"
                          height="16"
                          viewbox="0 0 17 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.707 1.21267C8.02812 0.224357 9.42632 0.224357 9.74744 1.21267L10.8948 4.74387C11.0384 5.18586 11.4503 5.48511 11.915 5.48511H15.6279C16.6671 5.48511 17.0992 6.81488 16.2585 7.42569L13.2547 9.60809C12.8787 9.88126 12.7214 10.3654 12.865 10.8074L14.0123 14.3386C14.3335 15.327 13.2023 16.1488 12.3616 15.538L9.35775 13.3556C8.98178 13.0824 8.47266 13.0824 8.09669 13.3556L5.09287 15.538C4.25216 16.1488 3.12099 15.327 3.44211 14.3386L4.58947 10.8074C4.73308 10.3654 4.57575 9.88126 4.19978 9.60809L1.19596 7.42569C0.355248 6.81488 0.787317 5.48511 1.82649 5.48511H5.53942C6.00415 5.48511 6.41603 5.18586 6.55964 4.74387L7.707 1.21267Z" fill="#6366F1"/>
                        </svg>
                      </div>

                      <div class="w-auto p-0.5">
                        <svg
                          width="17"
                          height="16"
                          viewbox="0 0 17 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.707 1.21267C8.02812 0.224357 9.42632 0.224357 9.74744 1.21267L10.8948 4.74387C11.0384 5.18586 11.4503 5.48511 11.915 5.48511H15.6279C16.6671 5.48511 17.0992 6.81488 16.2585 7.42569L13.2547 9.60809C12.8787 9.88126 12.7214 10.3654 12.865 10.8074L14.0123 14.3386C14.3335 15.327 13.2023 16.1488 12.3616 15.538L9.35775 13.3556C8.98178 13.0824 8.47266 13.0824 8.09669 13.3556L5.09287 15.538C4.25216 16.1488 3.12099 15.327 3.44211 14.3386L4.58947 10.8074C4.73308 10.3654 4.57575 9.88126 4.19978 9.60809L1.19596 7.42569C0.355248 6.81488 0.787317 5.48511 1.82649 5.48511H5.53942C6.00415 5.48511 6.41603 5.18586 6.55964 4.74387L7.707 1.21267Z" fill="#6366F1"/>
                        </svg>
                      </div>

                      <div class="w-auto p-0.5">
                        <svg
                          width="17"
                          height="16"
                          viewbox="0 0 17 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.707 1.21267C8.02812 0.224357 9.42632 0.224357 9.74744 1.21267L10.8948 4.74387C11.0384 5.18586 11.4503 5.48511 11.915 5.48511H15.6279C16.6671 5.48511 17.0992 6.81488 16.2585 7.42569L13.2547 9.60809C12.8787 9.88126 12.7214 10.3654 12.865 10.8074L14.0123 14.3386C14.3335 15.327 13.2023 16.1488 12.3616 15.538L9.35775 13.3556C8.98178 13.0824 8.47266 13.0824 8.09669 13.3556L5.09287 15.538C4.25216 16.1488 3.12099 15.327 3.44211 14.3386L4.58947 10.8074C4.73308 10.3654 4.57575 9.88126 4.19978 9.60809L1.19596 7.42569C0.355248 6.81488 0.787317 5.48511 1.82649 5.48511H5.53942C6.00415 5.48511 6.41603 5.18586 6.55964 4.74387L7.707 1.21267Z" fill="#6366F1"/>
                        </svg>
                      </div>

                      <div class="w-auto p-0.5">
                        <svg
                          width="17"
                          height="16"
                          viewbox="0 0 17 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.707 1.21267C8.02812 0.224357 9.42632 0.224357 9.74744 1.21267L10.8948 4.74387C11.0384 5.18586 11.4503 5.48511 11.915 5.48511H15.6279C16.6671 5.48511 17.0992 6.81488 16.2585 7.42569L13.2547 9.60809C12.8787 9.88126 12.7214 10.3654 12.865 10.8074L14.0123 14.3386C14.3335 15.327 13.2023 16.1488 12.3616 15.538L9.35775 13.3556C8.98178 13.0824 8.47266 13.0824 8.09669 13.3556L5.09287 15.538C4.25216 16.1488 3.12099 15.327 3.44211 14.3386L4.58947 10.8074C4.73308 10.3654 4.57575 9.88126 4.19978 9.60809L1.19596 7.42569C0.355248 6.81488 0.787317 5.48511 1.82649 5.48511H5.53942C6.00415 5.48511 6.41603 5.18586 6.55964 4.74387L7.707 1.21267Z" fill="#6366F1"/>
                        </svg>
                      </div>
                    </div>
                  </div>

                  <div class="w-auto p-1">
                    <div class="-m-0.5 flex flex-wrap">
                      <div class="w-auto p-0.5">
                        <p class="font-bold text-gray-900">
                          4.2/5
                        </p>
                      </div>

                      <div class="w-auto p-0.5">
                        <p class="font-medium text-gray-600">
                          (45k Reviews)
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="w-full p-8 md:w-1/2">
            <div class="-m-3 flex flex-wrap">
              <div class="w-full p-3 xl:w-1/2">
                <div class="border-blueGray100 h-full rounded-xl border bg-white bg-opacity-80 px-8 py-7" style="backdrop-filter: blur(46px);">
                  <span class="mb-2 inline-block font-medium leading-relaxed">Privacy Protection</span>

                  <h3 class="font-heading tracking-px-n mb-3 text-6xl font-bold leading-tight md:text-7xl">
                    $7.99
                  </h3>

                  <p
                    class="mb-12 w-full text-base font-medium leading-relaxed text-gray-600 sm:text-lg md:min-h-16 md:text-xl lg:text-2xl ">
                    Monthly subscription, cancel anytime.
                  </p>

                  <Button class="shadow-4xl mb-9" size="lg">
                    Get 30 Days Free Trial
                  </Button>

                  <h3 class="mb-5 font-semibold leading-normal">
                    What’s included:
                  </h3>

                  <ul>
                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Dark Web Monitoring
                    </li>

                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Spammer Prevention
                    </li>

                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Hacker Prevention
                    </li>

                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Stalker Prevention
                    </li>

                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Prevent your data from being sold
                    </li>
                  </ul>
                </div>
              </div>

              <div class="w-full p-3 xl:w-1/2">
                <div class="border-blueGray100 h-full rounded-xl border bg-white bg-opacity-80 px-8 py-7" style="backdrop-filter: blur(46px);">
                  <span class="mb-2 inline-block font-medium leading-relaxed">Credit Monitoring</span>

                  <h3 class="font-heading tracking-px-n mb-3 text-6xl font-bold leading-tight md:text-7xl">
                    Free
                  </h3>

                  <p class="mb-12 font-medium leading-relaxed text-gray-600 sm:text-lg md:min-h-16 md:text-xl lg:text-2xl ">
                    With your Privacy subscripton.
                  </p>

                  <Button class="mb-9" size="lg">
                    Free Credit Monitoring
                  </Button>

                  <h3 class="mb-5 font-semibold leading-normal">
                    What’s included:
                  </h3>

                  <ul>
                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Credit Bureau Monitor
                    </li>

                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Score Simulator
                    </li>

                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Debt Analysis
                    </li>

                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Score Factors
                    </li>

                    <li class="mb-1.5 font-medium leading-normal text-gray-600">
                      Credit Alerts
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="overflow-hidden bg-white pt-24">
      <div class="container mx-auto px-4">
        <div class="border-b pb-20">
          <div class="-m-8 flex flex-wrap">
            <div class="w-full p-8 sm:w-1/2 lg:w-2/12">
              <h3 class="mb-6 font-semibold leading-normal">
                Company
              </h3>

              <ul>
                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">About Us</a>
                </li>

                <li class="mb-3.5"/>

                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Press</a>
                </li>

                <li><a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Blog</a></li>
              </ul>
            </div>

            <div class="w-full p-8 sm:w-1/2 lg:w-2/12">
              <h3 class="mb-6 font-semibold leading-normal">
                Products
              </h3>

              <ul>
                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Credit Monitoring</a>
                </li>

                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Privacy</a>
                </li>

                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">ID protection (coming soon)</a>
                </li>

                <li><a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Contact</a></li>
              </ul>
            </div>

            <div class="w-full p-8 sm:w-1/2 lg:w-2/12">
              <h3 class="mb-6 font-semibold leading-normal">
                Resources
              </h3>

              <ul>
                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Blog</a>
                </li>

                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Financial Education</a>
                </li>

                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Credit Ideas</a>
                </li>

                <li>
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Hustles </a>
                </li>
              </ul>
            </div>

            <div class="w-full p-8 sm:w-1/2 lg:w-2/12">
              <h3 class="mb-6 font-semibold leading-normal">
                Legal
              </h3>

              <ul>
                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Privacy Policy</a>
                </li>

                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Unsubscribe</a>
                </li>

                <li class="mb-3.5">
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Contact Us</a>
                </li>

                <li>
                  <a class="font-medium leading-relaxed text-gray-600 hover:text-gray-700" href="#">Pricing</a>
                </li>
              </ul>
            </div>

            <div class="w-full p-8 sm:w-1/2 lg:w-4/12">
              <div class="lg:max-w-sm">
                <h3 class="mb-6 font-semibold leading-normal">
                  Subscribe
                </h3>

                <p class="mb-5 font-sans leading-relaxed text-gray-600">
                  Receive our free eBook and subscribe to our free newsletter filled with credit building tips as well as other financial wellness education.
                </p>

                <div ref="subscribeEmail" class="mb-3 inline-block w-full overflow-hidden rounded-xl border border-gray-300 focus-within:ring focus-within:ring-primary md:max-w-xl xl:pl-6">
                  <div class="flex flex-wrap items-center">
                    <div class="w-full xl:flex-1">
                      <input
                        id="footerInput1-1"
                        class="w-full p-3 font-medium text-gray-500 placeholder-gray-500 outline-none xl:p-0 xl:pr-6"
                        type="text"
                        placeholder="Type your e-mail">
                    </div>

                    <div class="w-full xl:w-auto">
                      <div class="block">
                        <Button size="lg" class="rounded-l-none">
                          Subscribe
                        </Button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <canvas ref="canvasRef" class="pointer-events-none fixed inset-0 z-0" />
    </section>

    <div class="hidden bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
      <div class="relative flex min-h-screen flex-col items-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
          <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <div class="flex lg:col-start-2 lg:justify-center">
              <h1>Goal 850</h1>
            </div>

            <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
              <Link
                v-if="$page.props.auth.user"
                as="button"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
              </Link>

              <Link
                v-if="$page.props.auth.user"
                :href="route('logout')"
                as="button"
                method="post"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log out
              </Link>

              <template v-else>
                <Link
                  :href="route('login')"
                  class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                  Log in
                </Link>

                <Link
                  v-if="canRegister"
                  :href="route('register')"
                  class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                  Register
                </Link>
              </template>
            </nav>
          </header>

          <main class="mt-6">
            <div>Welcome details</div>
          </main>

          <div>
            <Link :href="route('register')">
              <Button class="flex h-10 w-40 items-center justify-between rounded-lg px-4 py-2">
                Subscribe
              </Button>
            </Link>
          </div>

          <footer class="py-16 text-center text-sm text-black dark:text-white/50">
            <div>
              <a href="/about">About</a>
              |
              <a href="/privacy-policy">Privacy Policy</a>
              |
              <a href="/terms-of-service">Terms of Service</a>
              |
              <a href="/contact">Contact</a>
            </div>
          </footer>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
canvas {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
 </style>