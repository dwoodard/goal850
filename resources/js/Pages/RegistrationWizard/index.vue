<template>
  <AppLayout>
    <div class="mx-auto mb-10 max-w-2xl space-y-6">
      <h2 class="text-2xl font-bold text-gray-800">
        Great, to get started, please enter your date of birth and ssn
      </h2>

      <p>
        This information is required to create your account and verify your identity.
        Please ensure that the information you provide is accurate and matches your official records.
      </p>
    </div>

    <div
      class="mx-auto max-w-2xl rounded-md bg-white p-6 shadow-md">
      <form class="space-y-6" @submit.prevent="submit">
        <div>
          <Label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth:</Label>

          <Input
            id="dob"
            v-model="form.dob"

            type="date"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            @change="form.validate('dob')"
            @input="form.validate('dob')"/>

          <div v-if="form.invalid('dob')" class="mt-2 text-sm text-red-500">
            {{ form.errors.dob }}
          </div>
        </div>

        <div>
          <label for="ssn" class="block text-sm font-medium text-gray-700">SSN:</label>

          <Input
            id="ssn"
            v-model="form.ssn"
            type="text"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>

          <div
            v-if="form.invalid('ssn')"
            class="mt-2 text-sm text-red-500">
            {{ form.errors.ssn }}
          </div>
        </div>

        <Button
          type="submit"
          class="w-full px-4 py-2"
          :disabled="form.processing">
          Submit
        </Button>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import AppLayout from '@/Layouts/AppLayout.vue'
// import { useForm } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'

const form = useForm('post', route('registration.wizard.store'), {
  form_name: 'array_dob_ssn',
  dob: '',
  ssn: ''
})

defineProps({
  user: {
    type: Object
  }
})

const submit = () => form.submit({
  preserveScroll: true,
  onSuccess: () => form.reset()
})

</script>

<style scoped>

</style>