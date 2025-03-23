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
  'payment': {
    title: 'Payment',
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
        stepper.goTo('payment')
      },
      onError: (errors) => {
        console.log('Form errors:', errors)
      }
    })

  }

  if (stepper.isCurrent('payment')) {
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

  this.step++
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
              @click="stepper.goTo(id)">
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

            <div
              class="flex flex-col items-center gap-4">
              <Button
                v-if="!stepper.isLast.value"
                class="w-full "
                :disabled="!stepper.current.value.isValid()">
                Next
              </Button>

              <Button v-if="stepper.isLast.value" :disabled="!stepper.current.value.isValid()">
                Submit
              </Button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </GuestLayout>
</template>
