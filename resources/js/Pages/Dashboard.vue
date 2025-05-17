<script setup>
import CreditOverview from '@/array/CreditOverview.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle
} from '@/components/ui/card'
import Button from '@/components/ui/button/Button.vue'

const { props } = usePage()

if (typeof window !== 'undefined') {
  const script1 = document.createElement('script')
  script1.src = `https://embed.array.io/cms/array-web-component.js?appKey=${props.array.appKey}`
  document.head.appendChild(script1)

  // const script2 = document.createElement('script')
  // script2.src = `https://embed.array.io/cms/array-credit-overview.js?appKey=${props.array.appKey}`
  // document.head.appendChild(script2)
}
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

    <div class="m-10">
      <Card>
        <CardHeader>
          <CardDescription>Nav links</CardDescription>
        </CardHeader>
        <CardContent>
          <div class="flex flex-col gap-4">
            <p>Array CMS is a headless CMS that allows you to manage your content and integrate it with your applications.</p>
            <p>To get started, you can check out the <a href="https://docs.array.io" target="_blank" class="text-blue-500">Array documentation</a>.</p>
          </div>
        </CardContent>
        <CardContent>
          <div class="flex flex-col gap-4">
            <p>Array CMS is a headless CMS that allows you to manage your content and integrate it with your applications.</p>
            <p>To get started, you can check out the <a href="https://docs.array.io" target="_blank" class="text-blue-500">Array documentation</a>.</p>
          </div>
        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>
