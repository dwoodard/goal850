<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {
  Head,
  Link,
  router,
  useForm
} from '@inertiajs/vue3'
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger
} from '@/components/ui/alert-dialog'
import { Button } from '@/components/ui/button'
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle
} from '@/components/ui/card'
import { Checkbox } from '@/components/ui/checkbox'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
  Tabs,
  TabsContent,
  TabsList,
  TabsTrigger
} from '@/components/ui/tabs'
import { ref } from 'vue'

const { editUser } = defineProps(['editUser'])

// Note: Admin access is already protected by server-side middleware

// Dialog state
const showManualPasswordDialog = ref(false)

// Manual password reset state
const showManualPasswordForm = ref(false)

// Manual password form with validation
const manualPasswordForm = useForm({
  password: '',
  password_confirmation: ''
})

// Form setup
const form = useForm({
  first_name: editUser?.first_name || '',
  last_name: editUser?.last_name || '',
  email: editUser?.email || '',
  phone: editUser?.phone || '',
  is_admin: editUser?.is_admin || false,
  email_verified_at: editUser?.email_verified_at || null
})

const submit = () => {
  form.put(route('admin.users.update', editUser.id), {
    preserveScroll: true
  })
}

const verifyEmail = () => {
  router.post(route('admin.users.verify-email', editUser.id), {}, {
    preserveState: true
  })
}

const unverifyEmail = () => {
  router.post(route('admin.users.unverify-email', editUser.id), {}, {
    preserveState: true
  })
}

const confirmManualPasswordReset = () => {
  manualPasswordForm.post(route('admin.users.set-password', editUser.id), {
    preserveState: true,
    onSuccess: () => {
      manualPasswordForm.reset()
      showManualPasswordForm.value = false
      showManualPasswordDialog.value = false
    }
  })
}
</script>

<template>
  <Head title="Edit User" />

  <AppLayout>
    <div class="py-8">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div class="flex flex-col gap-6">
              <!-- Page Header -->
              <div>
                <h1 class="text-3xl font-bold text-gray-900">
                  Edit User
                </h1>
                <p class="mt-1 text-gray-600">
                  Manage profile, security, permissions, and activity.
                </p>
              </div>

              <!-- User Identity Card -->
              <div class="rounded-xl bg-gray-100 p-4 shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800">
                  {{ editUser.first_name }} {{ editUser.last_name }}
                </h2>
                <p class="text-sm text-gray-600">
                  {{ editUser.email }}
                </p>
              </div>
            </div>
            <Link
              :href="route('admin.users.index')"
              class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500">
              ← Back to Users
            </Link>
          </div>
        </div>

        <!-- Tabs -->
        <Tabs default-value="profile" class="w-full">
          <TabsList class="grid w-full grid-cols-4">
            <TabsTrigger value="profile">
              🧑‍💼 Profile
            </TabsTrigger>
            <TabsTrigger value="security">
              🔐 Security
            </TabsTrigger>
            <TabsTrigger value="permissions">
              🛠️ Permissions
            </TabsTrigger>
            <TabsTrigger value="activity">
              📊 Activity
            </TabsTrigger>
          </TabsList>

          <!-- Profile Tab -->
          <TabsContent value="profile">
            <Card>
              <CardHeader>
                <CardTitle>User Information</CardTitle>
                <CardDescription>
                  Update the user's personal information and contact details.
                </CardDescription>
              </CardHeader>
              <form @submit.prevent="submit">
                <CardContent class="space-y-6">
                  <div class="grid gap-6 md:grid-cols-2">
                    <!-- First Name -->
                    <div class="space-y-2">
                      <Label for="first_name">First Name</Label>
                      <Input
                        id="first_name"
                        v-model="form.first_name"
                        type="text"
                        :class="{ 'border-red-500': form.errors.first_name }"
                        placeholder="Enter first name" />
                      <div v-if="form.errors.first_name" class="text-sm text-red-600">
                        {{ form.errors.first_name }}
                      </div>
                    </div>

                    <!-- Last Name -->
                    <div class="space-y-2">
                      <Label for="last_name">Last Name</Label>
                      <Input
                        id="last_name"
                        v-model="form.last_name"
                        type="text"
                        :class="{ 'border-red-500': form.errors.last_name }"
                        placeholder="Enter last name" />
                      <div v-if="form.errors.last_name" class="text-sm text-red-600">
                        {{ form.errors.last_name }}
                      </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                      <Label for="email">Email Address</Label>
                      <Input
                        id="email"
                        v-model="form.email"
                        type="email"
                        :class="{ 'border-red-500': form.errors.email }"
                        placeholder="Enter email address" />
                      <div v-if="form.errors.email" class="text-sm text-red-600">
                        {{ form.errors.email }}
                      </div>
                    </div>

                    <!-- Phone -->
                    <div class="space-y-2">
                      <Label for="phone">Phone Number</Label>
                      <Input
                        id="phone"
                        v-model="form.phone"
                        type="tel"
                        :class="{ 'border-red-500': form.errors.phone }"
                        placeholder="Enter phone number" />
                      <div v-if="form.errors.phone" class="text-sm text-red-600">
                        {{ form.errors.phone }}
                      </div>
                    </div>
                  </div>
                </CardContent>
                <CardFooter class="flex justify-between">
                  <div class="flex space-x-3">
                    <Button
                      type="submit"
                      :disabled="form.processing">
                      {{ form.processing ? 'Saving...' : 'Save Changes' }}
                    </Button>
                    <Button
                      type="button"
                      variant="outline"
                      @click="router.get(route('admin.users.index'))">
                      Cancel
                    </Button>
                  </div>
                  <div class="text-sm text-gray-500">
                    User ID: {{ editUser.id }}
                  </div>
                </CardFooter>
              </form>
            </Card>
          </TabsContent>

          <!-- Security Tab -->
          <TabsContent value="security">
            <div class="space-y-6">
              <!-- Email Verification Card -->
              <Card>
                <CardHeader>
                  <CardTitle>Email Verification</CardTitle>
                  <CardDescription>
                    Manage the user's email verification status.
                  </CardDescription>
                </CardHeader>
                <CardContent>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                      <span class="text-sm font-medium text-gray-700">Status:</span>
                      <span
                        :class="editUser.email_verified_at ? 'text-green-600' : 'text-red-600'"
                        class="text-sm font-medium">
                        {{ editUser.email_verified_at ? '✅ Verified' : '❌ Unverified' }}
                      </span>
                    </div>
                    <Button
                      v-if="!editUser.email_verified_at"
                      type="button"
                      variant="outline"
                      size="sm"
                      @click="verifyEmail">
                      Verify Email
                    </Button>
                    <Button
                      v-else
                      type="button"
                      variant="outline"
                      size="sm"
                      @click="unverifyEmail">
                      Unverify Email
                    </Button>
                  </div>
                </CardContent>
              </Card>

              <!-- Password Management Card -->
              <Card>
                <CardHeader>
                  <CardTitle>Password Management</CardTitle>
                  <CardDescription>
                    Reset or set a new password for the user.
                  </CardDescription>
                </CardHeader>
                <CardContent class="space-y-6">
                  <!-- Manual Password Set -->
                  <div class="rounded-lg bg-blue-50 p-4">
                    <div class="flex items-start">
                      <div class="flex-shrink-0">
                        <svg class="size-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <div class="ml-3 flex-1">
                        <h4 class="text-sm font-medium text-blue-800">
                          Set Custom Password
                        </h4>
                        <p class="mt-1 text-sm text-blue-700">
                          Manually set a specific password for this user. Password must be at least 8 characters long.
                        </p>
                        <div class="mt-4">
                          <Button
                            v-if="!showManualPasswordForm"
                            type="button"
                            variant="outline"
                            size="sm"
                            class="border-blue-300 bg-blue-50 text-blue-800 hover:bg-blue-100"
                            @click="showManualPasswordForm = true">
                            Set Custom Password
                          </Button>

                          <div v-else class="space-y-3">
                            <div>
                              <Label for="manual_password">New Password</Label>
                              <Input
                                id="manual_password"
                                v-model="manualPasswordForm.password"
                                type="password"
                                placeholder="Enter new password (min 8 characters)"
                                :class="{ 'border-red-500': manualPasswordForm.errors.password }"
                                class="mt-1" />
                              <div v-if="manualPasswordForm.errors.password" class="mt-1 text-sm text-red-600">
                                {{ manualPasswordForm.errors.password }}
                              </div>
                            </div>
                            <div>
                              <Label for="manual_password_confirmation">Confirm Password</Label>
                              <Input
                                id="manual_password_confirmation"
                                v-model="manualPasswordForm.password_confirmation"
                                type="password"
                                placeholder="Confirm new password"
                                :class="{ 'border-red-500': manualPasswordForm.errors.password_confirmation }"
                                class="mt-1" />
                              <div v-if="manualPasswordForm.errors.password_confirmation" class="mt-1 text-sm text-red-600">
                                {{ manualPasswordForm.errors.password_confirmation }}
                              </div>
                            </div>
                            <div class="flex space-x-2">
                              <AlertDialog v-model:open="showManualPasswordDialog">
                                <AlertDialogTrigger as-child>
                                  <Button
                                    type="button"
                                    size="sm"
                                    :disabled="manualPasswordForm.processing"
                                    class="bg-blue-600 text-white hover:bg-blue-700">
                                    {{ manualPasswordForm.processing ? 'Setting...' : 'Set Password' }}
                                  </Button>
                                </AlertDialogTrigger>
                                <AlertDialogContent>
                                  <AlertDialogHeader>
                                    <AlertDialogTitle>Set Custom Password</AlertDialogTitle>
                                    <AlertDialogDescription>
                                      Are you sure you want to set a custom password for {{ editUser.first_name }} {{ editUser.last_name }}?
                                      This will immediately change their current password.
                                    </AlertDialogDescription>
                                  </AlertDialogHeader>
                                  <AlertDialogFooter>
                                    <AlertDialogCancel>Cancel</AlertDialogCancel>
                                    <AlertDialogAction @click="confirmManualPasswordReset">
                                      Set Password
                                    </AlertDialogAction>
                                  </AlertDialogFooter>
                                </AlertDialogContent>
                              </AlertDialog>
                              <Button
                                type="button"
                                variant="outline"
                                size="sm"
                                @click="showManualPasswordForm = false; manualPasswordForm.reset()">
                                Cancel
                              </Button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </CardContent>
              </Card>
            </div>
          </TabsContent>

          <!-- Permissions Tab -->
          <TabsContent value="permissions">
            <Card>
              <CardHeader>
                <CardTitle>Administrator Access</CardTitle>
                <CardDescription>
                  Manage user permissions and administrative privileges.
                </CardDescription>
              </CardHeader>
              <CardContent>
                <div class="space-y-4">
                  <div class="flex items-center space-x-2">
                    <Checkbox
                      id="is_admin"
                      v-model:checked="form.is_admin" />
                    <Label for="is_admin" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                      Grant administrative privileges to this user
                    </Label>
                  </div>
                  <p class="text-sm text-gray-600">
                    Administrators have full access to the system including user management, settings, and all administrative functions.
                  </p>
                  <div v-if="form.errors.is_admin" class="text-sm text-red-600">
                    {{ form.errors.is_admin }}
                  </div>
                </div>
              </CardContent>
              <CardFooter>
                <Button
                  type="button"
                  :disabled="form.processing"
                  @click="submit">
                  {{ form.processing ? 'Saving...' : 'Update Permissions' }}
                </Button>
              </CardFooter>
            </Card>
          </TabsContent>

          <!-- Activity Tab -->
          <TabsContent value="activity">
            <div class="space-y-6">
              <!-- User Statistics Card -->
              <Card>
                <CardHeader>
                  <CardTitle>User Statistics</CardTitle>
                  <CardDescription>
                    View user activity and engagement metrics.
                  </CardDescription>
                </CardHeader>
                <CardContent>
                  <div class="grid gap-4 md:grid-cols-3">
                    <div class="rounded-lg bg-gray-50 p-4">
                      <div class="text-sm font-medium text-gray-500">
                        Total Logins
                      </div>
                      <div class="text-2xl font-bold text-gray-900">
                        {{ editUser.login_count || 0 }}
                      </div>
                    </div>
                    <div class="rounded-lg bg-gray-50 p-4">
                      <div class="text-sm font-medium text-gray-500">
                        Last Login
                      </div>
                      <div class="text-2xl font-bold text-gray-900">
                        {{ editUser.last_login ? new Date(editUser.last_login).toLocaleDateString() : 'Never' }}
                      </div>
                    </div>
                    <div class="rounded-lg bg-gray-50 p-4">
                      <div class="text-sm font-medium text-gray-500">
                        Account Created
                      </div>
                      <div class="text-2xl font-bold text-gray-900">
                        {{ new Date(editUser.created_at).toLocaleDateString() }}
                      </div>
                    </div>
                  </div>
                </CardContent>
              </Card>

              <!-- Subscriptions Card -->
              <Card>
                <CardHeader>
                  <CardTitle>Subscriptions</CardTitle>
                  <CardDescription>
                    View user subscription history and active plans.
                  </CardDescription>
                </CardHeader>
                <CardContent>
                  <div class="flex items-center justify-between">
                    <div class="space-y-1">
                      <div class="text-sm font-medium text-gray-700">
                        Active Plans
                      </div>
                      <div class="text-2xl font-bold text-gray-900">
                        {{ editUser.subscriptions_count || 0 }}
                      </div>
                    </div>
                    <Button
                      type="button"
                      variant="outline"
                      @click="router.get(route('admin.users.subscriptions', editUser.id))">
                      View All Subscriptions
                    </Button>
                  </div>
                </CardContent>
              </Card>
            </div>
          </TabsContent>
        </Tabs>
      </div>
    </div>
  </AppLayout>
</template>
