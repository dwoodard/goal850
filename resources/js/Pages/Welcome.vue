<script setup>
import {
  Head,
  Link
} from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref } from 'vue'
import PipMarketing from '@/array/PipMarketing.vue'
import PipDashboard from '@/array/PipDashboard.vue'
import CreditOverview from '@/array/CreditOverview.vue'
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

    <section class=" bg-[#32383F] md:-mb-10 lg:max-h-[380px]">
      <div class="lg:max-height-[380px] mx-auto px-4 pt-10 lg:container lg:flex lg:flex-wrap lg:px-40">
        <div class="w-full lg:w-1/2">
          <div class=" ">
            <div
              v-motion
              :initial="{ opacity: 0, x: -25 }"
              :enter="{ opacity: 1, x: 0, transition: { type: 'spring', stiffness: '25', delay: 1000 } }"
              :variants="{ custom: { scale: 2 } }"
              :delay="200"
              :duration="1000">
              <h2 class="mb-4 text-4xl font-bold text-white">
                Did you apply for a loan online?
              </h2>

              <p class="text-bold mb-4 text-2xl text-white">
                Your personal and banking info may be exposed.
              </p>

              <p class="text-sm text-white">
                Up to 98% of consumers have their information exposed on Data Broker and People Search sites—putting their privacy and security at risk.
              </p>
            </div>
          </div>
        </div>

        <div class="w-full lg:w-1/2 lg:justify-end">
          <div class="flex justify-center  lg:w-96 lg:justify-end">
            <img
              v-motion
              :initial="{ opacity: 0, x: 25 }"
              :enter="{ opacity: 1, x: 0, transition: { type: 'spring', stiffness: '25', delay: 1000 } }"
              :variants="{ custom: { scale: 2 } }"
              :delay="200"
              :duration="2400"
              src="images/GOAT-Mascot.png"
              alt="GOAT Mascot"
              class="mt-12 h-96  lg:-mt-20 lg:h-96">
          </div>
        </div>
      </div>
    </section>

    <section
      class="relative overflow-hidden bg-white "
      style="background-image: url('flaro-assets/images/pricing/gradient6.svg'); background-size: cover; background-position: center;">
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

    <section class="relative flex  justify-center overflow-hidden bg-[#32383F] py-32">
      <div class="container mx-auto max-w-6xl px-4">
        <div class="flex flex-col justify-between gap-10 lg:flex-row">
          <!-- Left side: Heading and Testimonial -->
          <div class="max-w-md text-white">
            <h2 class="mb-6 text-4xl font-bold">
              Affordable pricing plans
            </h2>

            <div class="relative pl-10">
              <div class="absolute -top-4 left-0 text-[80px] leading-none text-green-400">
                &ldquo;
              </div>

              <p class="mb-6 text-lg leading-relaxed">
                Do like I did and protect yourself from hackers, spammers, and thieves. Your privacy, identity, credit, and finances deserve it!
              </p>

              <p class="mt-4 text-sm font-semibold">
                AJ --<br>Happy Customer
              </p>
            </div>
          </div>

          <!-- Right side: Pricing Plans -->
          <div class="flex flex-col  gap-8 lg:flex-row" >
            <div class="mt-8 w-full max-w-sm rounded-lg bg-white p-8">
              <h3 class="mb-4 text-center text-xl font-semibold">
                Privacy Protection
              </h3>

              <div class="mb-4 flex items-center justify-between">
                <div class="text-3xl font-bold">
                  $9<sup class="text-sm">99</sup>

                  <span class="text-base font-normal">/mo</span>
                </div>

                <div class="text-3xl font-bold">
                  $99<span class="text-base font-normal">/yr</span>
                </div>
              </div>

              <p class="mb-6 text-center text-sm text-gray-600">
                Monthly subscription, cancel anytime.
              </p>

              <Link
                as="button"
                :href="route('register')"
                class="mb-4 w-full">
                <Button>
                  Get 7 Days Free Trial
                </Button>
              </Link>

              <ul class="space-y-2 text-sm text-gray-700">
                <li>Free Credit Monitoring</li>

                <li>Dark Web Monitoring</li>

                <li>Basic Identity Theft Protection</li>

                <li>Spam Protection</li>

                <li>Hacker Protection</li>

                <li>Stalker Protection</li>

                <li>Data Theft Prevention</li>
              </ul>
            </div>

            <div class="relative w-full max-w-sm rounded-lg border-2 border-primary bg-white p-8 pt-16">
              <!-- MOST POPULAR Badge floating above -->
              <div class="absolute inset-x-0 top-0">
                <span class="block w-full bg-primary py-2 text-center text-sm font-bold uppercase tracking-[.6em] text-white">
                  Most Popular
                </span>
              </div>

              <h3 class="mb-4 text-center text-xl font-semibold">
                Privacy & Identity
              </h3>

              <div class="mb-4 flex items-center justify-between">
                <div class="text-3xl font-bold">
                  $19<sup class="text-sm">99</sup>

                  <span class="text-base font-normal">/mo</span>
                </div>

                <div class="text-3xl font-bold">
                  $199<span class="text-base font-normal">/yr</span>
                </div>
              </div>

              <p class="mb-6 text-center text-sm text-gray-600">
                Monthly subscription, cancel anytime.
              </p>

              <Link
                as="button"
                :href="route('register')"
                class="mb-4 w-full">
                <Button>
                  Get 7 Days Free Trial
                </Button>
              </Link>

              <ul class="space-y-2 text-sm text-gray-700">
                <li>Free Credit Monitoring</li>

                <li>Dark Web Monitoring</li>

                <li>Basic Identity Theft Protection</li>

                <li>Spam Protection</li>

                <li>Hacker Protection</li>

                <li>Stalker Protection</li>

                <li>Data Theft Prevention</li>

                <li class="font-bold">
                  $1M Identity Theft Protection
                </li>

                <li class="font-bold">
                  SSN Monitoring
                </li>

                <li class="font-bold">
                  Change of Address
                </li>

                <li class="font-bold">
                  Account Monitoring
                </li>

                <li class="font-bold">
                  Social Media Monitoring
                </li>

                <li class="font-bold">
                  Telecom Monitoring
                </li>

                <li class="font-bold">
                  Court Records Monitoring
                </li>

                <li class="font-bold">
                  Home Title Monitoring
                </li>

                <li class="font-bold">
                  Auto Title Monitoring
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section
      class="bg-gray-100 lg:p-40">
      <div class="rounded-lg bg-gray-50 p-8 text-center shadow-md">
        <h3 class="mb-4 text-2xl font-bold text-gray-800">
          Identity Protection
        </h3>

        <p class="text-lg leading-relaxed text-gray-600">
          Safeguard your identity with up to <span class="font-semibold text-primary">$1M</span> in theft reimbursement, full-service restoration, and real-time monitoring to detect and prevent fraud across your financial, social, and personal records.
        </p>
      </div>

      <div
        class="bg-white   outline-1 outline-gray-200">
        <PipDashboard />
      </div>

      <div class="flex justify-center py-10">
        <Link
          as="button"
          :href="route('register')"
          class="mb-4 w-full max-w-lg">
          <H3 class="mb-4 text-2xl font-bold text-gray-800">
            Get Identity Protection
          </H3>

          <Button class="p-8 text-lg">
            Get Identity Protection
          </Button>
        </Link>
      </div>
    </section>

    <section class="bg-gray-50">
      <div class="  p-8 text-center  ">
        <h3 class="mb-4 text-2xl font-bold text-gray-800">
          Credit Monitoring
        </h3>

        <p class="text-lg leading-relaxed text-gray-600">
          Monitoring your credit regularly helps you catch identity theft early, track your financial progress, and ensure accuracy in your credit reports, empowering you to protect and improve your credit score.
        </p>
      </div>

      <div class="p-100 bg-gray-50">
        <CreditOverview />
      </div>

      <div class="p-10 text-center">
        <Link :href="route('register')" class=" text-lg font-bold text-primary hover:underline">
          <Button class="p-8 text-lg">
            Get Credit Monitoring
          </Button>
        </Link>
      </div>
    </section>

    <footer class="overflow-hidden bg-[#32383F] pt-24 text-white">
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
    </footer>
  </AppLayout>
</template>

<style scoped>

 </style>