<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import {
  Head, Link, useForm
} from '@inertiajs/vue3'
import { ArrowRight } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Checkbox } from '@/components/ui/checkbox'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { useStepper } from '@vueuse/core'
import ApplicationLogo from '@/components/ApplicationLogo.vue'

const form = useForm({
  step: null,
  email: '',
  phone: '',
  first_name: '',
  last_name: '',
  password: '',
  password_confirmation: '',
  newsletter: true
})

// Field validation
const validations = {
  email: (value) => !!value && value.includes('@') && value.includes('.') ,
  phone: (value) => !!value && value.length >= 10,
  first_name: (value) => !!value,
  last_name: (value) => !!value,
  password: (value) => !!value && value.length >= 6,
  password_confirmation: (value) => value === form.password
}

const stepper = useStepper({
  'user-information': {
    title: 'Your Details',
    isValid: () =>
      !! validations.email(form.email) &&
      !! validations.phone(form.phone) &&
      !!validations.first_name(form.first_name) &&
      !!validations.last_name(form.last_name) &&
      !!validations.password(form.password) &&
      !!validations.password_confirmation(form.password_confirmation)
  },
  'plan': {
    title: 'Pick Plan',
    isValid: () => true
  }
})

function submit() {

  if (!stepper.current.value.isValid()) return

  console.log('Form step:', stepper.index.value)

  if (stepper.isCurrent('user-information')) {

    //add current step to form data
    form.step = stepper.index.value

    form.post('/register', {
      onSuccess: () => {
        stepper.goTo('plan')
      },
      onError: (errors) => {
        console.log('Form errors:', errors)
      }
    })

  }

  if (stepper.isCurrent('plan')) {
    console.log('Form step:', stepper.index.value)

    form.post('/register', {
      onSuccess: () => {

        form.reset()
      },
      onError: (errors) => {
        console.log('Form errors:', errors)
      }
    })
  }
  stepper.goToNext()
}

function allStepsBeforeAreValid(index) {
  return !Array.from({ length: index }, () => null)
    .some((_, i) => !stepper.at(i)?.isValid())
}
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <div class="flex flex-col items-center justify-center gap-5 py-2">
      <Link :href="route('welcome')">
        <ApplicationLogo variant="icon"/>
      </Link>

      <div class="rounded-lg p-8 shadow-lg">
        <div class="flex flex-wrap gap-5">
          <div
            v-for="(step, id, i) in stepper.steps.value"
            :key="id"
            v-motion
            :initial="{ opacity: 0, y: -50 }"
            :enter="{ opacity: 1, y: 0 }"
            :delay="i * 200"
            :duration="i * 500">
            <Button
              class="flex h-10 w-full items-center justify-between rounded-lg px-4 py-2 "
              :disabled="!allStepsBeforeAreValid(i) && stepper.isBefore(id)"
              @click="() => { submit(); if (stepper.current.value.isValid()) stepper.goTo(id); }">
              <span v-text="step.title" />

              <span>
                <ArrowRight class="size-4" />
              </span>
            </Button>
          </div>
        </div>

        <form ref="target" class="mt-10 " @submit.prevent="submit">
          <span class="text-lg font-bold" v-text="stepper.current.value.title" />

          <div class="mt-2 flex flex-col justify-center gap-2">
            <div v-if="stepper.isCurrent('user-information')">
              <!-- First and last name fields -->
              <div class="mb-4 flex flex-col md:flex-row md:gap-4">
                <div class="w-full md:w-1/2">
                  <Label for="first_name">First name:</Label>

                  <Input
                    id="first_name"
                    v-model="form.first_name"
                    class="mt-0.5"
                    type="text"/>

                  <p v-if="form.errors.first_name" class="mt-1 text-sm text-red-500">
                    {{ form.errors.first_name }}
                  </p>
                </div>

                <div class="w-full md:w-1/2">
                  <Label for="last_name">Last name:</Label>

                  <Input
                    id="last_name"
                    v-model="form.last_name"
                    class="mt-0.5"
                    type="text"/>

                  <p v-if="form.errors.last_name" class="mt-1 text-sm text-red-500">
                    {{ form.errors.last_name }}
                  </p>
                </div>
              </div>
              <!-- End of first and last name fields -->

              <!-- Phone and email fields -->
              <div class="mb-4 flex flex-col md:flex-row md:gap-4">
                <div class="w-full md:w-1/2">
                  <Label for="phone">Phone</Label>

                  <Input id="phone" v-model="form.phone" type="text" />

                  <p v-if="form.errors.phone" class="mt-1 text-sm text-red-500">
                    {{ form.errors.phone }}
                  </p>
                </div>

                <div class="w-full md:w-1/2">
                  <Label for="email">Email</Label>

                  <Input id="email" v-model="form.email" type="email" />

                  <p v-if="form.errors.email" class="mt-1 text-sm text-red-500">
                    {{ form.errors.email }}
                  </p>
                </div>
              </div>

              <!-- Password and confirm password fields -->
              <div class="mb-4">
                <Label for="password">Password:</Label>

                <Input
                  id="password"
                  v-model="form.password"
                  class="mt-0.5"
                  type="password" />

                <p v-if="form.errors.password" class="mt-1 text-sm text-red-500">
                  {{ form.errors.password }}
                </p>
              </div>

              <div class="mb-4">
                <Label for="confirm-password">Confirm Password:</Label>

                <Input
                  id="confirm-password"
                  v-model="form.password_confirmation"
                  class="mt-0.5"
                  type="password" />

                <p v-if="form.errors.password_confirmation" class="mt-1 text-sm text-red-500">
                  {{ form.errors.password_confirmation }}
                </p>
              </div>
              <!-- End of password and confirm password fields -->

              <!-- add checkbox for email newsletter -->
              <div class="mb-4 flex items-center">
                <Checkbox
                  id="newsletter"
                  v-model:checked="form.newsletter"
                  class="mr-2"/>

                <Label for="newsletter">
                  Subscribe to our newsletter
                </Label>
              </div>
            </div>

            <div v-if="stepper.isCurrent('plan')">
              <div class="mt-6 space-y-8">
                <h3 class="text-lg font-medium">
                  Select a Subscription Plan
                </h3>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                  <!-- Basic Tier -->
                  <div
                    class="relative cursor-pointer rounded-lg border p-6 shadow-sm transition-all hover:shadow-md"
                    :class="{ 'border-primary ring-primary ring-2': form.plan === 'basic', 'border-gray-200': form.plan !== 'basic' }"
                    @click="form.plan = 'basic'">
                    <div class="absolute right-4 top-4">
                      <Checkbox
                        :checked="form.plan === 'basic'"
                        @click.stop
                        @change="form.plan = 'basic'"/>
                    </div>

                    <h3 class="text-xl font-bold">
                      Basic
                    </h3>

                    <div class="mt-2 flex items-baseline">
                      <span class="text-2xl font-bold">$9</span>

                      <span class="ml-1 text-gray-500">/month</span>
                    </div>

                    <p class="mt-3 text-sm text-gray-500">
                      Perfect for individuals just getting started.
                    </p>

                    <ul class="mt-4 space-y-2 text-sm">
                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>Basic feature access</span>
                      </li>

                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>Email support</span>
                      </li>
                    </ul>
                  </div>

                  <!-- Pro Tier -->
                  <div
                    class="relative cursor-pointer rounded-lg border p-6 shadow-sm transition-all hover:shadow-md"
                    :class="{ 'border-primary ring-primary ring-2': form.plan === 'pro', 'border-gray-200': form.plan !== 'pro' }"
                    @click="form.plan = 'pro'">
                    <div class="absolute right-4 top-4">
                      <Checkbox
                        :checked="form.plan === 'pro'"
                        @click.stop
                        @change="form.plan = 'pro'"/>
                    </div>

                    <div class="bg-primary/10 text-primary inline-block rounded-full px-3 py-1 text-xs font-medium">
                      Popular
                    </div>

                    <h3 class="text-xl font-bold">
                      Pro
                    </h3>

                    <div class="mt-2 flex items-baseline">
                      <span class="text-2xl font-bold">$29</span>

                      <span class="ml-1 text-gray-500">/month</span>
                    </div>

                    <p class="mt-3 text-sm text-gray-500">
                      Ideal for professionals and small teams.
                    </p>

                    <ul class="mt-4 space-y-2 text-sm">
                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>All Basic features</span>
                      </li>

                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>Priority support</span>
                      </li>

                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>Advanced analytics</span>
                      </li>
                    </ul>
                  </div>

                  <!-- Premium Tier -->
                  <div
                    class="relative cursor-pointer rounded-lg border p-6 shadow-sm transition-all hover:shadow-md"
                    :class="{ 'border-primary ring-primary ring-2': form.plan === 'premium', 'border-gray-200': form.plan !== 'premium' }"
                    @click="form.plan = 'premium'">
                    <div class="absolute right-4 top-4">
                      <Checkbox
                        :checked="form.plan === 'premium'"
                        @click.stop
                        @change="form.plan = 'premium'"/>
                    </div>

                    <h3 class="text-xl font-bold">
                      Premium
                    </h3>

                    <div class="mt-2 flex items-baseline">
                      <span class="text-2xl font-bold">$79</span>

                      <span class="ml-1 text-gray-500">/month</span>
                    </div>

                    <p class="mt-3 text-sm text-gray-500">
                      For enterprises and large organizations.
                    </p>

                    <ul class="mt-4 space-y-2 text-sm">
                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>All Pro features</span>
                      </li>

                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>24/7 dedicated support</span>
                      </li>

                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>Custom integrations</span>
                      </li>

                      <li class="flex items-center">
                        <svg
                          class="mr-2 size-4 text-green-500"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>

                        <span>Unlimited users</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div>
                <p class="mt-4 text-sm text-gray-500">
                  By selecting a plan, you agree to our
                  <Link href="/terms" class="text-primary underline">
                    Terms of Service
                  </Link>
                  and
                  <Link href="/privacy" class="text-primary underline">
                    Privacy Policy
                  </Link>.
                </p>
              </div>

              <div class="mb-4 mt-6">
                <h4 class="mb-2 text-sm font-medium text-gray-700">
                  Have a coupon?
                </h4>

                <div class="flex items-center gap-2">
                  <div class="flex w-full space-x-2">
                    <div class="relative flex-1">
                      <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="size-4 text-gray-500"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 7h.01M7 10h.01M7 13h.01M7 16h.01M7 19h.01M10 19h.01M13 19h.01M16 19h.01M19 19h.01M19 16h.01M19 13h.01M19 10h.01M19 7h.01M16 7h.01M13 7h.01M10 7h.01M9 5H5v4m0 0v6m0 0v4m0 0h4m-4 0h6m-6 0h4" />
                        </svg>
                      </div>

                      <Input
                        id="coupon"
                        v-model="form.coupon"
                        class="rounded-r-none pl-10"
                        type="text"
                        placeholder="Enter coupon code" />
                    </div>

                    <Button
                      variant="default"
                      type="button"
                      class="rounded-l-none border-l-0">
                      Apply
                    </Button>
                  </div>
                </div>

                <p class="mt-1.5 text-xs text-gray-500">
                  Enter a valid coupon code to receive a discount on your subscription.
                </p>
              </div>
            </div>

            <div
              class="flex flex-col items-center gap-4">
              <Button
                v-if="!stepper.isLast.value"
                class="w-full "
                :disabled="!stepper.current.value.isValid()">
                Next
              </Button>

              <Button v-if="stepper.isLast.value" :disabled="!stepper.current.value.isValid()">
                Subscribe
              </Button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </GuestLayout>
</template>
