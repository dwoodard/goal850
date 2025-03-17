<script setup>
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
import {
  Head,
  Link,
  useForm
} from '@inertiajs/vue3'

defineProps({
  canResetPassword: {
    type: Boolean
  },
  status: {
    type: String
  }
})

const form = useForm({
  email: '',
  password: '',
  remember: false
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password')
  })
}
</script>

<template>
  <Head title="Log in" />

  <div class="flex min-h-screen items-center justify-center bg-gray-50">
    <div class="w-full max-w-md space-y-8 rounded-lg bg-white p-8 shadow-md">
      <div class="text-center">
        <h2 class="text-3xl font-bold">Login</h2>
        <p class="mt-2 text-sm text-gray-600">
          Enter your credentials to access your account
        </p>
      </div>

      <form class="space-y-6" @submit.prevent="submit">
        <div class="space-y-4">
          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email
            </label>
            <Input
              id="email"
              v-model="form.email"
              type="email"
              required
              placeholder="m@example.com"
            />
            <p v-if="form.errors.email" class="text-sm text-red-500 mt-1">
              {{ form.errors.email }}
            </p>
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
              Password
            </label>
            <Input
              id="password"
              v-model="form.password"
              type="password"
              required
              placeholder="••••••••"
            />
            <p v-if="form.errors.password" class="text-sm text-red-500 mt-1">
              {{ form.errors.password }}
            </p>
          </div>

          <!-- Remember Me & Forgot Password -->
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <Checkbox
                id="remember"
                v-model="form.remember"
                class="mr-2"
              />
              <label for="remember" class="text-sm text-gray-700">
                Remember me
              </label>
            </div>

            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="text-sm text-primary hover:underline"
            >
              Forgot your password?
            </Link>
          </div>
        </div>

        <!-- Submit Button -->
        <Button
          type="submit"
          class="w-full"
          :disabled="form.processing"
        >
          {{ form.processing ? 'Signing in...' : 'Sign in' }}
        </Button>
      </form>

      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
          Don't have an account?
          <Link
            :href="route('register')"
            class="text-primary hover:underline"
          >
            Sign up
          </Link>
        </p>
      </div>
    </div>
  </div>
</template>
