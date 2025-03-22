<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import {
  Head,
  useForm
} from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Checkbox } from '@/components/ui/checkbox'
import { useStepper } from '@vueuse/core'
import { ArrowRight } from 'lucide-vue-next'
import ApplicationLogo from '@/components/ApplicationLogo.vue'

const form = useForm({
  email: '',
  phone: '',
  first_name: '',
  last_name: '',
  password: '',
  password_confirmation: '',
  newsletter: true
})

// Define available plans
const plans = [
  { id: 'basic', name: 'Basic Plan', price: '$7.99/month' },
  { id: 'pro', name: 'Pro Plan', price: '$19.99/month' }

]

const stepper = useStepper({
  'user-information': {
    title: 'Your Details',
    isValid: () =>
      !!form.phone &&
      !!form.first_name &&
      !!form.last_name &&
      !!form.email &&
      // !!form.password &&
      // !!form.password_confirmation &&
      form.password === form.password_confirmation
  },
  'payment': {
    title: 'Payment',
    isValid: () => true
  }
})

function submit() {
  if (!stepper.current.value.isValid()) return

  if (stepper.isLast.value) {
    form.post('/register', {
      onSuccess: () => {
        form.reset()
      },
      onError: (errors) => {
        console.log('Form errors:', errors)
      }
    })
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

    <div class="flex  max-w-2xl flex-col items-center justify-center gap-5 px-4 py-20">
      <div>
        <ApplicationLogo variant="icon" />
      </div>

      <div class="rounded-lg p-8 shadow-lg">
        <div class="flex flex-wrap gap-5">
          <div
            v-for="(step, id, i) in stepper.steps.value"
            :key="id"
            v-motion
            :initial="{ opacity: 0, y: -50 }"
            :enter="{ opacity: 1, y: 0 }"
            :delay="i * 200"
            :duration="i * 500"
            class="">
            <Button
              class="flex h-10 max-w-40 items-center justify-between rounded-lg px-4 py-2"
              :disabled="!allStepsBeforeAreValid(i) && stepper.isBefore(id)"
              @click="stepper.goTo(id)">
              <span v-text="step.title" />

              <span v-if="stepper.isCurrent(id)">
                <ArrowRight class="size-4" />
              </span>
            </Button>
          </div>
        </div>

        <form class="mt-10 " @submit.prevent="submit">
          <span class="text-lg font-bold" v-text="stepper.current.value.title" />

          <div class="mt-2 flex flex-col justify-center gap-2">
            <div v-if="stepper.isCurrent('user-information')">
              <div class="mb-4">
                <Label for="phone">Phone</Label>

                <Input id="phone" v-model="form.phone" type="text" />

                <p v-if="form.errors.phone" class="mt-1 text-sm text-red-500">
                  {{ form.errors.phone }}
                </p>
              </div>

              <div class="mb-4">
                <Label for="email">Email</Label>

                <Input id="email" v-model="form.email" type="email" />

                <p v-if="form.errors.email" class="mt-1 text-sm text-red-500">
                  {{ form.errors.email }}
                </p>
              </div>

              <div class="mb-4">
                <Label for="first_name">First name:</Label>

                <Input
                  id="first_name"
                  v-model="form.first_name"
                  class="mt-0.5"
                  type="text" />

                <p v-if="form.errors.first_name" class="mt-1 text-sm text-red-500">
                  {{ form.errors.first_name }}
                </p>
              </div>

              <div class="mb-4">
                <Label for="last_name">Last name:</Label>

                <Input
                  id="last_name"
                  v-model="form.last_name"
                  class="mt-0.5"
                  type="text" />

                <p v-if="form.errors.last_name" class="mt-1 text-sm text-red-500">
                  {{ form.errors.last_name }}
                </p>
              </div>

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

              <!-- add checkbox for email newsletter -->
              <div class="mb-4 flex items-center">
                <Checkbox
                  id="newsletter"
                  v-model="form.newsletter"
                  class="mr-2" />

                <Label for="newsletter">Subscribe to our newsletter</Label>
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
    </div>
  </GuestLayout>
</template>
