<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import {
  Head,
  router
  // useForm
} from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Checkbox } from '@/components/ui/checkbox'
import { useStepper } from '@vueuse/core'
import { reactive } from 'vue'

const form = reactive({
  phone: '',
  email: '',
  first_name: '',
  last_name: '',

  password: '',
  password_confirmation: '',

  billingAddress: '',
  contractAccepted: false
})

const stepper = useStepper({
  'user-information': {
    title: 'User information',
    isValid: () => !!form.first_name
      && !!form.last_name
      && !!form.phone
      && !!form.email
      && !!form.password
      && !!form.password_confirmation
      && form.password === form.password_confirmation
  }

})

function submit() {
  if (!stepper.current.value.isValid()) return

  if (stepper.isLast.value) {
    console.log('submitting form', form)
    router.post('/register', form)
  } else {
    stepper.goToNext()
  }
}

function allStepsBeforeAreValid(index) {
  return !Array.from({ length: index }, () => null)
    .some((_, i) => !stepper.at(i)?.isValid())
}

</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <Link href="/" class="    mb-4">
      <ApplicationLogo class="size-20 fill-current text-gray-500" />
    </Link>

    <div class="rounded-lg bg-gray-800 p-8 shadow-lg">
      <div class="flex flex-wrap gap-5  ">
        <div
          v-for="(step, id, i) in stepper.steps.value"
          :key="id"
          v-motion
          :initial="{ opacity: 0, y: -50 }"
          :enter="{ opacity: 1, y: 0 }"
          :delay="i * 200"
          :duration="500"
          class="">
          <Button
            class="flex h-10 w-40 items-center justify-between rounded-lg px-4 py-2"
            :disabled="!allStepsBeforeAreValid(i) && stepper.isBefore(id)"
            @click="stepper.goTo(id)">
            <span v-text="step.title" />

            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="size-5"
              viewBox="0 0 20 20"
              fill="currentColor">
              <path
                fill-rule="evenodd"
                d="M10.293 15.707a1 1 0 010-1.414L13.586 11H3a1 1 0 110-2h10.586l-3.293-3.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                clip-rule="evenodd" />
            </svg>
          </Button>
        </div>
      </div>

      <form class="mt-10 text-white" @submit.prevent="submit">
        <span class="text-lg font-bold" v-text="stepper.current.value.title" />

        <div class="mt-2 flex flex-col justify-center gap-2">
          <div>
            <div v-if="stepper.isCurrent('user-information')">
              <div
                v-motion="{ initial: { opacity: 0, x: -20 }, enter: { opacity: 1, x: 0 }, duration: 1400 }"
                class="mb-4">
                <Label for="phone">Phone</Label>

                <Input
                  id="phone"
                  v-model="form.phone"
                  type="text"
                  @input="form.phone = form.phone.replace(/\D/g, '')" />

                <div
                  v-if="form.phone && !/^\d{10}$/.test(form.phone)"
                  class="mt-1 text-sm text-red-500">
                  <span class="mt-1 text-sm text-red-500">Please enter a valid phone number.</span>
                </div>
              </div>

              <div
                v-if="form.phone && /^\d{10}$/.test(form.phone)"
                v-motion="{
                  initial: { opacity: 0, x: -20 },
                  enter: { opacity: 1, x: 0 },
                  duration: 1400
                }

                "
                class="mb-4">
                <Label for="email">Email</Label>

                <Input
                  id="email"
                  v-model="form.email"
                  type="email" />

                <span
                  v-if="form.email && !/^\S+@\S+\.\S+$/.test(form.email)"
                  class="mt-1 text-sm text-red-500">
                  Please enter a valid email address.
                </span>
              </div>

              <div
                v-if="form.email && /^\S+@\S+\.\S+$/.test(form.email)"
                v-motion="{ initial: { opacity: 0, x: -20 }, enter: { opacity: 1, x: 0 }, duration: 1400 }"
                class="mb-4">
                <Label for="first_name">First name:</Label>

                <Input
                  id="first_name"
                  v-model="form.first_name"
                  class="mt-0.5"
                  type="text" />
              </div>

              <div
                v-if="form.phone && /^\d{10}$/.test(form.phone)"
                v-motion="{ initial: { opacity: 0, x: -20 }, enter: { opacity: 1, x: 0 }, duration: 1400 }"
                class="mb-4">
                <Label for="last_name">Last name:</Label>

                <Input
                  id="last_name"
                  v-model="form.last_name"
                  class="mt-0.5"
                  type="text" />
              </div>

              <div
                v-if="form.phone && /^\d{10}$/.test(form.phone)"
                v-motion="{ initial: { opacity: 0, x: -20 }, enter: { opacity: 1, x: 0 }, duration: 1400 }"
                class="mb-4">
                <Label for="password">Password:</Label>

                <Input
                  id="password"
                  v-model="form.password"
                  class="mt-0.5"
                  type="password" />
              </div>

              <div
                v-if="form.phone && /^\d{10}$/.test(form.phone)"
                v-motion="{ initial: { opacity: 0, x: -20 }, enter: { opacity: 1, x: 0 }, duration: 1400 }"
                class="mb-4">
                <Label for="confirm-password">Confirm Password:</Label>

                <Input
                  id="confirm-password"
                  v-model="form.password_confirmation"
                  class="mt-0.5"
                  type="password" />
              </div>
            </div>

            <div v-if="stepper.isCurrent('billing-address')">
              <Input v-model="form.billingAddress" type="text" />
            </div>

            <div v-if="stepper.isCurrent('terms')">
              <div class="flex items-center space-x-2">
                <Checkbox
                  id="terms"
                  v-bind="form.contractAccepted"
                  v-on:update:checked="form.contractAccepted = $event" />

                <label
                  for="terms"
                  class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                  Accept terms and conditions
                </label>
              </div>
            </div>
          </div>

          <div>
            <Button v-if="!stepper.isLast.value" :disabled="!stepper.current.value.isValid()">
              Next
            </Button>

            <Button v-if="stepper.isLast.value" :disabled="!stepper.current.value.isValid()">
              Submit
            </Button>
          </div>
        </div>
      </form>
    </div>
  </GuestLayout>
</template>
