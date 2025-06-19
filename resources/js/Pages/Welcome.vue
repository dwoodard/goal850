<script setup>
import {
  Head,
  Link
} from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref } from 'vue'
import ApplicationLogo from '@/components/ApplicationLogo.vue'

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
const isVideoPlaying = ref(false)
const videoRef = ref(null)

// const { canvasRef } = useParticles(50)

</script>

<template>
  <AppLayout>
    <Head title="Welcome" />

    <section class=" bg-[#32383F]">
      <div class=" container ">
        <div class="bg-[url('/images/GLogo.svg')]  bg-[right_bottom_-2rem] bg-no-repeat">
          <div class="grid grid-cols-1 gap-12 pt-12 sm:grid-cols-2">
            <div class=" ">
              <div class="grid grid-flow-row gap-3  ">
                <div
                  v-motion
                  :initial="{ opacity: 0, x: -150 }"
                  :enter="{ opacity: 1, x: 0, transition: { type: 'spring', stiffness: '100', delay: 250 } }"
                  :delay="100"
                  class="flex flex-col items-start gap-2 lg:gap-6">
                  <h2 class=" text-3xl font-bold text-white ">
                    <div>Monitor. Protect.</div>
                    <div>Build. Your credit.</div>
                  </h2>
                  <p class=" text-xl text-white">
                    Access your free credit score. Track
                    your progress and get alerts. 100%
                    free, no strings attached.
                  </p>
                  <Link
                    class="align-self-end "
                    as="button"
                    :href="route('register', { intent: 'privacy.scan' })">
                    <Button>
                      Sign up for FREE credit monitoring
                    </Button>
                  </Link>
                </div>
              </div>
            </div>

            <div class="flex items-center justify-center lg:justify-end">
              <img
                v-motion
                :initial="{ opacity: 0, x: 150 }"
                :enter="{ opacity: 1, x: 0, transition: { type: 'spring', stiffness: '100', delay: 250 } }"
                :delay="100"
                src="images/GOAT-Mascot.png"
                alt="GOAT Mascot"
                class="mt-12 h-96  lg:-mt-20 lg:h-96">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section
      class="relative overflow-hidden bg-white ">
      <div class="container py-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800">
          Your credit matters. Free tools. Real results.
        </h2>

        <div class="grid grid-cols-1 gap-12 px-4 py-8 sm:grid-cols-2   ">
          <div class="flex items-center *:justify-center">
            <div class="relative">
              <video
                ref="videoRef"
                v-motion
                :initial="{ opacity: 0, y: -50 }"
                :visible="{ opacity: 1, y: 0, transition: { type: 'spring', stiffness: 100, delay: 250 } }"
                :delay="100"
                class="aspect-video rounded-lg shadow-lg"
                controls
                muted
                playsinline
                preload="metadata"
                src="/videos/goal850_promo.mp4"
                @play="isVideoPlaying = true"
                @pause="isVideoPlaying = false"
                @ended="isVideoPlaying = false"/>

              <!-- Play Button Overlay -->
              <div
                v-show="!isVideoPlaying"
                class="absolute inset-0 flex cursor-pointer items-center justify-center rounded-lg bg-black bg-opacity-30 transition-opacity duration-300 hover:bg-opacity-40"
                @click="videoRef?.play()">
                <div class="transform rounded-full bg-white bg-opacity-90 p-4 shadow-lg transition-transform duration-200 hover:scale-110">
                  <svg class="ml-1 size-12 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="mx-auto mt-8 max-w-lg text-left">
              <p class="mt-4 text-2xl font-semibold text-gray-600">
                <span class="font-black">Free credit monitoring</span> is your first step to financial GOATness. Sign up today and you’ll get all this for free.*
              </p>
              <ul class="mt-6 space-y-3 text-left text-lg text-gray-900">
                <li class="flex items-center">
                  <span class="mr-2 text-green-500">✔</span>
                  Full Credit Report &amp; Score
                </li>
                <li class="flex items-center">
                  <span class="mr-2 text-green-500">✔</span>
                  Real-Time Score Tracker &amp; Alerts
                </li>
                <li class="flex items-center">
                  <span class="mr-2 text-green-500">✔</span>
                  Personalized Debt Analysis &amp; Insights
                </li>
                <li class="flex items-center">
                  <span class="mr-2 text-green-500">✔</span>
                  100% Free — No Strings Attached
                </li>
                <li class="flex items-center font-semibold">
                  <span class="mr-2 text-green-500">🎁</span>
                  BONUS Free Privacy Scan ($20 value!)
                </li>
              </ul>
              <div class="mt-6 flex justify-center">
                <Link
                  as="button"
                  :href="route('register', { intent: 'privacy.scan' })"
                  class="mb-4 w-full">
                  <Button>
                    Sign up for credit FREE monitoring
                  </Button>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="  bg-[#32383F]  text-white">
      <div class="container bg-[url('/images/GLogo.svg')]  bg-[left_bottom_-1.5rem] bg-no-repeat">
        <div class="max-w-6xl px-4 py-16 *:mx-auto lg:px-40">
          <h2 class="mb-5 text-3xl font-bold">
            Why it’s free?
          </h2>

          <p class="text-lg leading-loose">
            Because at <span class="font-bold  ">GOAL850</span>, we believe everyone deserves access to their own credit info. We’re able to offer this for free thanks to partnerships and optional upgrades — but you’re never required to pay a penny. <span class="italic  ">GOAT guaranteed!</span>
          </p>

          <div class=" mt-6 flex">
            <Link
              as="button"
              :href="route('register', { intent: 'privacy.scan' })"
              class="mb-4 w-full">
              <Button>
                Click here to start your journey
              </Button>
            </Link>
          </div>
        </div>
      </div>
    </section>

    <section class="container ">
      <h2 class="py-5 text-center text-3xl font-bold">
        Want even more protection?
      </h2>
      <div class="grid grid-cols-1 gap-12 px-4 py-8 sm:grid-cols-2">
        <div>
          <!-- logo -->
        </div>
        <div class="grid grid-cols-1 gap-6">
          <h3 class="text-2xl font-semibold">
            Privacy Protection
          </h3>

          <p>
            Data brokers collect and sell your
            personal details — like your name,
            address, income, and even family info —
            without your consent.
            This info can end up in the hands of
            marketers, scammers, and identity
            thieves.
          </p>

          <p>
            As part of your free credit tools, we’ll run
            a complimentary privacy scan to show
            you exactly where your data is exposed
          </p>

          <span class="font-semibold">— and what to do about it.</span>

          <div class="mt-6 flex justify-center">
            <Link
              as="button"
              :href="route('register', { intent: 'privacy.scan' })"
              class="mb-4 w-full">
              <Button>
                Scan My Info For Free
              </Button>
            </Link>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-12 px-4 py-8 sm:grid-cols-2">
        <div class="grid grid-cols-1 gap-6">
          <h3 class="text-2xl font-semibold">
            Identity Protection
          </h3>

          <p>
            Every few seconds, someone becomes a
            victim of identity theft — often without
            knowing until it’s too late.
            With Goal 850’s Identity Protection, you
            get real-time alerts if your Social
            Security number, address, or financial
            info shows up where it shouldn't — from
            the dark web to change-of-address
            databases.
          </p>

          <p>
            Plus, you’re covered by <span class="font-semibold">
              $1 million in
              identity theft insurance
            </span> and full
            restoration support, just in case.
          </p>

          <div class="mt-6 flex justify-center">
            <Link
              as="button"
              :href="route('register', { intent: 'payment' })"
              class="mb-4 w-full">
              <Button>
                Upgrade to Full Protection
              </Button>
            </Link>
          </div>
        </div>
        <div>
          <!-- logo -->
        </div>
      </div>
      <a id="pricing"/>
    </section>

    <section class="bg-[#32383F] py-32">
      <div class="container mx-auto   px-4">
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
          <div
            class="flex flex-col  gap-8 lg:flex-row" >
            <div
              v-motion
              :initial="{ opacity: 0, y: -50 }"
              :visible="{ opacity: 1, y: 0, transition: { type: 'spring', stiffness: '100' } }"
              :delay="300"
              class="mt-8 w-full max-w-sm rounded-lg bg-white p-8">
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
                :href="route('register', { intent: 'payment' })"
                class="mb-4 w-full">
                <Button>
                  Sign up
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

            <div
              v-motion
              :initial="{ opacity: 0, y: -50 }"
              :visible="{ opacity: 1, y: 0, transition: { type: 'spring', stiffness: '100', delay: 250 } }"
              :delay="200"
              class="relative w-full max-w-sm rounded-lg border-2 border-primary bg-white p-8 pt-16">
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
                :href="route('register', { intent: 'payment' })"
                class="mb-4 w-full">
                <Button>
                  Sign up
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

    <section class=" ">
      <div class="rounded-lg bg-gray-50 p-8 text-center shadow-md">
        <h3 class="mb-4 text-2xl font-bold text-gray-800">
          Not ready to have the greatest

          credit of all time just yet?
        </h3>
        <p class="mb-6 text-lg text-gray-600">
          Get Free Credit Tips and Free Alerts in Your Inbox.
          Sign up today and get our FREE e-book!
        </p>
        <div class="mx-auto flex w-full max-w-md">
          <input
            type="email"
            placeholder="Type your email"
            class="flex-1 rounded-l-md border border-gray-300 px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-primary"
            required>
          <button
            type="submit"
            class="rounded-r-md bg-primary px-8 py-3 text-lg font-semibold text-white transition hover:bg-primary">
            Subscribe
          </button>
        </div>
      </div>
    </section>

    <footer class="  bg-[#32383F]   text-white">
      <div class="container mx-auto px-4 py-8 text-center">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
          <div>
            <h4 class="mb-3 text-lg font-bold">
              Company
            </h4>
            <ul class="space-y-2">
              <li>
                <Link href="#"  class="hover:underline">
                  About Us
                </Link>
              </li>
              <li>
                <Link href="#"  class="hover:underline">
                  FAQs
                </Link>
              </li>
            </ul>
          </div>

          <div>
            <h4 class="mb-3 text-lg font-bold">
              Products
            </h4>
            <ul class="space-y-2">
              <li>
                <Link :href="route('credit.report')" class="hover:underline">
                  Credit Monitoring
                </Link>
              </li>
              <li>
                <Link :href="route('privacy.scan')" target="_blank" class="hover:underline">
                  Privacy
                </Link>
              </li>
              <li>
                <Link :href="route('identity.protect')" class="hover:underline">
                  Identity
                </Link>
              </li>
            </ul>
          </div>

          <div>
            <h4 class="mb-3 text-lg font-bold">
              Resources
            </h4>
            <ul class="space-y-2">
              <li>
                <Link href="#" class="hover:underline">
                  Blog
                </Link>
              </li>
              <li>
                <Link href="#"  class="hover:underline">
                  Podcast
                </Link>
              </li>
              <li>
                <Link href="#"  class="hover:underline">
                  Offerings
                </Link>
              </li>
            </ul>
          </div>

          <div>
            <h4 class="mb-3 text-lg font-bold">
              Legal
            </h4>
            <ul class="space-y-2">
              <li>
                <Link :href="route('privacy')" class="hover:underline">
                  Privacy
                </Link>
              </li>
              <li>
                <Link :href="route('terms')" class="hover:underline">
                  Terms
                </Link>
              </li>
              <li>
                <Link href="#" class="hover:underline">
                  Contact Us
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!--  -->

      <div class="border-t border-gray-700 py-4 text-center text-sm text-gray-400">
        <div class="container flex max-w-2xl items-center justify-between ">
          <ApplicationLogo variant="icon" class="text-white" />
          <span class="ml-2">
            Copyright &copy; {{ new Date().getFullYear() }}  Goal850 All Rights Reserved
          </span>
        </div>
      </div>
    </footer>
  </AppLayout>
</template>

<style scoped>

 </style>