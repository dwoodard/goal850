<script setup>
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'
import {
  Link,
  useForm,
  usePage
} from '@inertiajs/vue3'

defineProps({
  mustVerifyEmail: {
    type: Boolean
  },
  status: {
    type: String
  }
})

const user = usePage().props.user

const form = useForm({
  first_name: user.first_name,
  last_name: user.last_name,
  email: user.email
})
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Profile Information
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        Update your account's profile information and email address.
      </p>
    </header>

    <form
      class="mt-6 space-y-6"
      @submit.prevent="form.patch(route('profile.update'))">
      <div
        class="flex flex-col space-y-2 md:flex-row md:space-x-4 md:space-y-0">
        <InputLabel for="name" value="Name" />

        <TextInput
          id="name"
          v-model="form.first_name"
          type="text"
          class="mt-1 block w-full"
          required/>

        <TextInput

          v-model="form.last_name"
          type="text"
          class="mt-1 block w-full"
          required/>

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div>
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autocomplete="username"/>

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div v-if="mustVerifyEmail && user.email_verified_at === null">
        <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
          Your email address is unverified.
          <Link
            :href="route('verification.send')"
            method="post"
            as="button"
            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
            Click here to re-send the verification email.
          </Link>
        </p>

        <div
          v-show="status === 'verification-link-sent'"
          class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
          A new verification link has been sent to your email address.
        </div>
      </div>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">
          Save
        </PrimaryButton>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0">
          <p
            v-if="form.recentlySuccessful"
            class="text-sm text-gray-600 dark:text-gray-400">
            Saved.
          </p>
        </Transition>
      </div>
    </form>
  </section>
</template>
