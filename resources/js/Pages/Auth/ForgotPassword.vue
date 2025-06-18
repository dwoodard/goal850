<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import TextInput from '@/components/TextInput.vue'
import { Button } from '@/components/ui/button'
import {
  Head,
  useForm
} from '@inertiajs/vue3'

defineProps({
  status: {
    type: String
  }
})

const form = useForm({
  email: ''
})

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <GuestLayout>
    <Head title="Forgot Password" />
    <div class="container mx-auto max-w-md rounded bg-white p-6 shadow dark:bg-gray-900">
      <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Forgot your password? No problem. Just let us know your email
        address and we will email you a password reset link that will allow
        you to choose a new one.
      </div>

      <div
        v-if="status"
        class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div>
          <InputLabel for="email" value="Email" />

          <TextInput
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="username"/>

          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4 flex items-center justify-end">
          <Button
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing">
            Email Password Reset Link
          </Button>
        </div>
      </form>
    </div>
  </GuestLayout>
</template>
