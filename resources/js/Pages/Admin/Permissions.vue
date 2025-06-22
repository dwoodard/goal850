<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import Button from '@/components/ui/button/Button.vue'

const page = usePage()
const { permissions } = defineProps(['permissions'])

// Redirect non-admin users
if (!page.props.user?.is_admin) {
  window.location.href = '/dashboard'
}
</script>

<template>
  <Head title="Admin - Permissions" />

  <AppLayout>
    <div class="py-8">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">
            Permission Management
          </h1>
          <p class="mt-2 text-gray-600">
            Manage system permissions and access controls
          </p>
        </div>

        <div class="rounded-lg bg-white shadow">
          <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
              <h2 class="text-lg font-medium text-gray-900">
                Permissions
              </h2>
              <Button>Add New Permission</Button>
            </div>
          </div>

          <div class="p-6">
            <div v-if="permissions && permissions.length > 0" class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Description
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Module
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Roles
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="permission in permissions" :key="permission.id">
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                      {{ permission.name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                      {{ permission.description }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      <span class="inline-flex rounded-full bg-blue-100 px-2 text-xs font-semibold leading-5 text-blue-800">
                        {{ permission.module || 'General' }}
                      </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ permission.roles?.length || 0 }} roles
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                      <Button variant="outline" size="sm" class="mr-2">
                        Edit
                      </Button>
                      <Button variant="destructive" size="sm">
                        Delete
                      </Button>
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
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                  No permissions found
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  Get started by creating a new permission.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
