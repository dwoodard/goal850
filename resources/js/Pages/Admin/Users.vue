<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {
  Head,
  Link,
  router
} from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger
} from '@/components/ui/dropdown-menu'
import {
  Pagination,
  PaginationEllipsis,
  PaginationList,
  PaginationListItem,
  PaginationNext,
  PaginationPrev
} from '@/components/ui/pagination'
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle
} from '@/components/ui/alert-dialog'
import { ref } from 'vue'

const { users } = defineProps(['users'])

// AlertDialog state
const showDeleteUserDialog = ref(false)
const selectedUserId = ref(null)
const selectedUserName = ref('')

// Note: Admin access is already protected by server-side middleware

// Helper function to format date
const formatDate = (date) => {
  if (!date) return 'Never'
  return new Date(date).toLocaleDateString()
}

// Helper function to get user status
const getUserStatus = (user) => {
  if (!user.email_verified_at) return { label: 'Unverified', class: 'bg-red-100 text-red-800' }
  // Since there's no status column, we'll determine status based on email verification and login activity
  if (user.last_login) return { label: 'Active', class: 'bg-green-100 text-green-800' }
  return { label: 'Inactive', class: 'bg-gray-100 text-gray-800' }
}

// Helper function to get full name
const getFullName = (user) => {
  const firstName = user.first_name || ''
  const lastName = user.last_name || ''
  return `${firstName} ${lastName}`.trim() || 'No Name'
}

// Navigation functions
const goToPage = (pageNumber) => {
  router.get(route('admin.users.index'), { page: pageNumber }, {
    preserveState: true,
    preserveScroll: true
  })
}

const goToPrevPage = () => {
  if (users.current_page > 1) {
    goToPage(users.current_page - 1)
  }
}

const goToNextPage = () => {
  if (users.current_page < users.last_page) {
    goToPage(users.current_page + 1)
  }
}

// Action functions
const viewSubscriptions = (userId) => {
  router.get(route('admin.users.subscriptions', userId))
}

const confirmDeleteUser = (userId, userName) => {
  selectedUserId.value = userId
  selectedUserName.value = userName
  showDeleteUserDialog.value = true
}

const handleDeleteUser = () => {
  router.delete(route('admin.users.destroy', selectedUserId.value), {
    preserveState: true,
    preserveScroll: true,
    onFinish: () => {
      showDeleteUserDialog.value = false
    }
  })
}
</script>

<template>
  <Head title="Admin - Users" />

  <AppLayout>
    <div class="py-8">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">
            User Management
          </h1>
          <p class="mt-2 text-gray-600">
            Manage system users and their access permissions
          </p>
        </div>

        <div class="rounded-lg bg-white shadow">
          <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
              <h2 class="text-lg font-medium text-gray-900">
                Users
              </h2>
              <Button>Add New User</Button>
            </div>
          </div>

          <div class="p-6">
            <div v-if="users?.data?.length > 0" class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Phone
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Role
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Last Login
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Subscriptions
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"/>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="user in users.data" :key="user.id">
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                      {{ getFullName(user) }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ user.email }}
                      <div v-if="!user.email_verified_at" class="text-xs text-red-500">
                        Unverified
                      </div>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ user.phone || 'N/A' }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      <span v-if="user.is_admin" class="inline-flex rounded-full bg-purple-100 px-2 text-xs font-semibold leading-5 text-purple-800">
                        Admin
                      </span>
                      <span v-else class="inline-flex rounded-full bg-gray-100 px-2 text-xs font-semibold leading-5 text-gray-800">
                        User
                      </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      <span :class="`inline-flex rounded-full px-2 text-xs font-semibold leading-5 ${getUserStatus(user).class}`">
                        {{ getUserStatus(user).label }}
                      </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ formatDate(user.last_login) }}
                      <div class="text-xs text-gray-400">
                        {{ user.login_count || 0 }} logins
                      </div>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ user.subscriptions_count || 0 }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                      <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                          <Button variant="outline" size="sm">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="size-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor">
                              <circle cx="12" cy="5" r="1.5"/>
                              <circle cx="12" cy="12" r="1.5"/>
                              <circle cx="12" cy="19" r="1.5"/>
                            </svg>
                          </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                          <DropdownMenuLabel>User Actions</DropdownMenuLabel>
                          <DropdownMenuSeparator />
                          <DropdownMenuItem as-child>
                            <Link :href="route('admin.users.edit', user.id)" class="w-full">
                              Edit User
                            </Link>
                          </DropdownMenuItem>
                          <DropdownMenuItem @click="viewSubscriptions(user.id)">
                            View Subscriptions
                          </DropdownMenuItem>
                          <DropdownMenuSeparator />
                          <DropdownMenuItem class="text-red-600" @click="confirmDeleteUser(user.id, getFullName(user))">
                            Delete User
                          </DropdownMenuItem>
                        </DropdownMenuContent>
                      </DropdownMenu>
                    </td>
                  </tr>
                </tbody>
              </table>

              <!-- Pagination -->
              <div v-if="users.links" class="flex justify-center border-t border-gray-200 bg-white px-4 py-3">
                <Pagination
                  :items-per-page="users.per_page"
                  :total="users.total"
                  :default-page="users.current_page"
                  class="flex items-center gap-1"
                  @update:page="goToPage">
                  <PaginationPrev @click="goToPrevPage" />

                  <PaginationList v-slot="{ items }" class="flex items-center gap-1">
                    <template v-for="(item, index) in items" :key="index">
                      <PaginationListItem
                        v-if="item.type === 'page'"
                        :value="item.value"
                        as-child
                        @click="() => goToPage(item.value)">
                        <Button
                          class="size-10 p-0"
                          :variant="item.value === users.current_page ? 'default' : 'outline'">
                          {{ item.value }}
                        </Button>
                      </PaginationListItem>

                      <PaginationEllipsis v-else :index="index" />
                    </template>
                  </PaginationList>

                  <PaginationNext @click="goToNextPage" />
                </Pagination>
              </div>
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
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                  No users found
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  Get started by adding a new user.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete User Dialog -->
    <AlertDialog v-model:open="showDeleteUserDialog">
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>Delete User</AlertDialogTitle>
          <AlertDialogDescription>
            Are you sure you want to delete {{ selectedUserName }}? This action cannot be undone and will permanently remove all user data.
          </AlertDialogDescription>
        </AlertDialogHeader>
        <AlertDialogFooter>
          <AlertDialogCancel>Cancel</AlertDialogCancel>
          <AlertDialogAction class="bg-red-600 text-white hover:bg-red-700" @click="handleDeleteUser">
            Delete User
          </AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  </AppLayout>
</template>
