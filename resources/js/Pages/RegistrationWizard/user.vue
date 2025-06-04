<template>
  <AppLayout>
    <div class="mx-auto mb-10 max-w-2xl space-y-6">
      <h2 class="text-2xl font-bold text-gray-800">
        Great, to get started, please enter your date of birth, SSN, and address
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

            @change="submit"/>

          <div v-if="form.errors.dob" class="mt-2 text-sm text-red-500">
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

            @change="submit"/>

          <div v-if="form.errors.ssn" class="mt-2 text-sm text-red-500">
            {{ form.errors.ssn }}
          </div>
        </div>

        <div>
          <label for="ssn" class="block text-sm font-medium text-gray-700">Address:</label>

          <Input
            id="add"
            v-model="form.street"
            type="text"
            required

            @change="submit"/>

          <div v-if="form.errors.street" class="mt-2 text-sm text-red-500">
            {{ form.errors.street }}
          </div>
        </div>

        <div>
          <label for="city" class="block text-sm font-medium text-gray-700">City:</label>

          <Input
            id="city"
            v-model="form.city"
            type="text"
            required

            @change="submit"/>

          <div v-if="form.errors.city" class="mt-2 text-sm text-red-500">
            {{ form.errors.city }}
          </div>
        </div>

        <div>
          <label for="state" class="block text-sm font-medium text-gray-700">State:</label>

          <Input
            id="state"
            v-model="form.state"
            type="text"
            maxlength="2"
            placeholder="CA"
            required

            @change="submit"/>

          <div v-if="form.errors.state" class="mt-2 text-sm text-red-500">
            {{ form.errors.state }}
          </div>
        </div>

        <div>
          <label for="zip" class="block text-sm font-medium text-gray-700">ZIP Code:</label>

          <Input
            id="zip"
            v-model="form.zip"
            type="text"
            maxlength="5"
            placeholder="90210"
            required

            @change="submit"/>

          <div v-if="form.errors.zip" class="mt-2 text-sm text-red-500">
            {{ form.errors.zip }}
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
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  form_name: 'array_dob_ssn',
  dob: '',
  ssn: '' ,
  street: '',
  city: '',
  state: '',
  zip: ''
})

defineProps({
  user: {
    type: Object
  }
})

const submit = () => {
  form.post(route('registration.wizard.user.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset()
  })
}

</script>

<style scoped>

</style>