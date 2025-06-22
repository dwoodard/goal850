<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import Button from '@/components/ui/button/Button.vue'

const page = usePage()
const { settings } = defineProps(['settings'])

// Redirect non-admin users
if (!page.props.user?.is_admin) {
  window.location.href = '/dashboard'
}
</script>

<template>
  <Head title="Admin - Settings" />

  <AppLayout>
    <div class="py-8">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">
            Admin Settings
          </h1>
          <p class="mt-2 text-gray-600">
            Configure system-wide settings and preferences
          </p>
        </div>

        <div class="space-y-6">
          <!-- Application Settings -->
          <div class="rounded-lg bg-white shadow">
            <div class="border-b border-gray-200 px-6 py-4">
              <h2 class="text-lg font-medium text-gray-900">
                Application Settings
              </h2>
            </div>
            <div class="p-6">
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <label class="block text-sm font-medium text-gray-700">Application Name</label>
                  <input type="text" value="Goal850" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Environment</label>
                  <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option>Production</option>
                    <option>Staging</option>
                    <option>Development</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Maintenance Mode</label>
                  <div class="mt-1">
                    <label class="inline-flex items-center">
                      <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      <span class="ml-2 text-sm text-gray-600">Enable maintenance mode</span>
                    </label>
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Debug Mode</label>
                  <div class="mt-1">
                    <label class="inline-flex items-center">
                      <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      <span class="ml-2 text-sm text-gray-600">Enable debug mode</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- User Settings -->
          <div class="rounded-lg bg-white shadow">
            <div class="border-b border-gray-200 px-6 py-4">
              <h2 class="text-lg font-medium text-gray-900">
                User Settings
              </h2>
            </div>
            <div class="p-6">
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <label class="block text-sm font-medium text-gray-700">User Registration</label>
                  <div class="mt-1">
                    <label class="inline-flex items-center">
                      <input type="checkbox" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      <span class="ml-2 text-sm text-gray-600">Allow user registration</span>
                    </label>
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Email Verification</label>
                  <div class="mt-1">
                    <label class="inline-flex items-center">
                      <input type="checkbox" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      <span class="ml-2 text-sm text-gray-600">Require email verification</span>
                    </label>
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Default User Role</label>
                  <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option>User</option>
                    <option>Premium User</option>
                    <option>Editor</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Session Timeout (minutes)</label>
                  <input type="number" value="120" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
              </div>
            </div>
          </div>

          <!-- Notification Settings -->
          <div class="rounded-lg bg-white shadow">
            <div class="border-b border-gray-200 px-6 py-4">
              <h2 class="text-lg font-medium text-gray-900">
                Notification Settings
              </h2>
            </div>
            <div class="p-6">
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <label class="block text-sm font-medium text-gray-700">Email Notifications</label>
                  <div class="mt-1">
                    <label class="inline-flex items-center">
                      <input type="checkbox" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      <span class="ml-2 text-sm text-gray-600">Enable email notifications</span>
                    </label>
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">SMS Notifications</label>
                  <div class="mt-1">
                    <label class="inline-flex items-center">
                      <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      <span class="ml-2 text-sm text-gray-600">Enable SMS notifications</span>
                    </label>
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Admin Email</label>
                  <input type="email" value="admin@goal850.com" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Support Email</label>
                  <input type="email" value="support@goal850.com" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
              </div>
            </div>
          </div>

          <!-- Save Button -->
          <div class="flex justify-end">
            <Button size="lg">
              Save Settings
            </Button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
