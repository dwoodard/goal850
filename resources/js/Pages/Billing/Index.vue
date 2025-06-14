<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import StripeTable from '@/components/StripeTable/index.vue'
import Button from '@/components/ui/button/Button.vue'

//get page props

const page = usePage()

</script>

<template>
  <Head title="Billing" />

  <AppLayout>
    <div
      v-if="page.props.user.is_subscribed"
      class="my-8 flex justify-center">
      <div class="flex w-full max-w-lg flex-col items-center rounded-xl p-8 shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-gray-800">
          Manage Your Billing
        </h2>
        <p class="mb-8 text-center text-base leading-relaxed text-gray-600">
          To manage your subscription, view invoices, or update your payment details, please use the button below to access your <span class="font-semibold text-indigo-600">Stripe billing portal</span>.
        </p>
        <a
          href="https://billing.stripe.com/p/login/00wfZhfPM6KJ2s4bvC2B200"
          target="_blank"
          rel="noopener"
          class="flex w-full justify-center">
          <Button class="w-full max-w-xs">
            Manage your billing on Stripe
          </Button>
        </a>
      </div>
    </div>
    <StripeTable
      v-if="!page.props.user.is_subscribed"
      :email="page.props.user.email"
      :phone="page.props.user.phone" />

    <!-- <StripeTable :email="page.props.user.email"/> -->
  </AppLayout>
</template>