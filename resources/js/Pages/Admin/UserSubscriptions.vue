<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {
  Head,
  Link
} from '@inertiajs/vue3'

const { editUser } = defineProps(['editUser'])

// Note: Admin access is already protected by server-side middleware

const formatDate = (date) => {
  if (!date) return 'N/A'
  return new Date(date).toLocaleDateString()
}
</script>

<template>
  <Head :title="`${editUser.first_name} ${editUser.last_name} - Subscriptions`" />

  <AppLayout>
    <div class="py-8">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-3xl font-bold text-gray-900">
                User Subscriptions
              </h1>
              <p class="mt-2 text-gray-600">
                Subscriptions for {{ editUser.first_name }} {{ editUser.last_name }}
              </p>
            </div>
            <Link
              :href="route('admin.users.index')"
              class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500">
              ← Back to Users
            </Link>
          </div>
        </div>

        <div class="rounded-lg bg-white shadow">
          <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-lg font-medium text-gray-900">
              Subscription History
            </h2>
          </div>

          <div class="p-6">
            <div v-if="editUser.subscriptions && editUser.subscriptions.length > 0" class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Plan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Start Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      End Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Created
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="subscription in editUser.subscriptions" :key="subscription.id">
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                      {{ subscription.name || 'N/A' }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      <span
                        :class="{
                          'bg-green-100 text-green-800': subscription.stripe_status === 'active',
                          'bg-red-100 text-red-800': subscription.stripe_status === 'canceled',
                          'bg-yellow-100 text-yellow-800': subscription.stripe_status === 'incomplete',
                          'bg-gray-100 text-gray-800': !subscription.stripe_status
                        }"
                        class="inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                        {{ subscription.stripe_status || 'Unknown' }}
                      </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ formatDate(subscription.trial_ends_at || subscription.created_at) }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ formatDate(subscription.ends_at) }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ formatDate(subscription.created_at) }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div v-else class="py-12 text-center">
              <div class="text-gray-500">
                <svg
                  class="mx-auto size-12 text-gray-400"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                  No subscriptions found
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  This user has no subscription history.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
