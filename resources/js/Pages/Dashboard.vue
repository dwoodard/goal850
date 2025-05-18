<script setup>
import CreditOverview from '@/array/CreditOverview.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import {
  Head, Link, usePage
} from '@inertiajs/vue3'
import {
  Card,
  CardDescription,

  CardHeader,
  CardTitle
} from '@/components/ui/card'
import { FileTextIcon } from 'lucide-vue-next'

const { props } = usePage()

</script>

<template>
  <Head title="Dashboard" />

  <AppLayout>
    <template #header>
      <h2>Dashboard</h2>
    </template>

    <div class="flex flex-col justify-center ">
      <CreditOverview :user="props.user" />
    </div>

    <div class="m-10 mx-auto max-w-7xl p-3">
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        <!-- Credit Report -->
        <Link :href="route('credit.report')">
          <Card class="transition-shadow duration-300 hover:border-primary ">
            <div class="flex justify-between">
              <div class="flex w-1/3 items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader class="w-2/3">
                <CardTitle>
                  Credit Report
                </CardTitle>
                <CardDescription>
                  View your credit report details
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!-- Credit Score Details -->
        <Link :href="route('credit.score.details')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Credit Score Details
                </CardTitle>
                <CardDescription>
                  Manage your content with Array CMS
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!-- Credit Protection -->
        <Link :href="route('credit.protection')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Credit Protection
                </CardTitle>
                <CardDescription>
                  Protect your credit information
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!-- Credit Debt Analysis -->
        <Link :href="route('credit.debt.analysis')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Debt Analysis
                </CardTitle>
                <CardDescription>
                  Analyze your credit and debt information
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!-- Credit Score Insights -->
        <Link :href="route('credit.score.insights')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Score Factors
                </CardTitle>
                <CardDescription>
                  Get insights into your credit score trends
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!--Credit Score Simulator -->
        <Link :href="route('credit.score.simulator')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Score Simulator
                </CardTitle>
                <CardDescription>
                  Simulate changes to your credit score
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!--Credit Score Coach -->
        <Link :href="route('credit.score.coach')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Score Coach
                </CardTitle>
                <CardDescription>
                  Get personalized credit score coaching
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!--Credit Score Tracker -->
        <Link :href="route('credit.score')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Score Tracker
                </CardTitle>
                <CardDescription>
                  Track your credit score over time
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!--Credit Monitoring -->
        <Link :href="route('credit.alerts')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Credit Monitoring
                </CardTitle>
                <CardDescription>
                  Receive alerts for credit changes
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!--Identity Protect -->
        <Link :href="route('identity.protect')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Identity Protection
                </CardTitle>
                <CardDescription>
                  Protect your identity and personal information
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!--Neighborhood Watch -->
        <Link :href="route('neighborhood.watch')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Neighborhood Watch
                </CardTitle>
                <CardDescription>
                  Monitor your neighborhood for safety
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!--Subscription Manager -->
        <Link :href="route('subscription.manager')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Subscription Manager
                </CardTitle>
                <CardDescription>
                  Manage your subscriptions and services
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>
        <!--Privacy Scan -->
        <Link :href="route('privacy.scan')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Privacy Scan
                </CardTitle>
                <CardDescription>
                  Scan for privacy risks and vulnerabilities
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link>

        <!--Student Loan Navigator -->
        <!-- <Link :href="route('student.loan.navigator')">
          <Card class="transition-shadow duration-300 hover:border-primary">
            <div class="flex justify-between">
              <div class="flex w-1/3  items-center justify-center">
                <FileTextIcon class="size-12 text-gray-500" />
              </div>
              <CardHeader  class="w-2/3">
                <CardTitle>
                  Student Loan Navigator
                </CardTitle>
                <CardDescription>
                  Manage your student loans and payments
                </CardDescription>
              </CardHeader>
            </div>
          </Card>
        </Link> -->
      </div>
    </div>
  </AppLayout>
</template>
