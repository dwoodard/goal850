<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {
  Accordion, AccordionContent, AccordionItem, AccordionTrigger
} from '@/components/ui/accordion'
import { usePage } from '@inertiajs/vue3'
</script>

<template>
  <AppLayout>
    <div class="container mx-auto">
      <h1 class="mb-4 text-2xl font-bold">
        Podcasts
      </h1>
      <p class="mb-6">
        Here you can find a list of podcasts.
      </p>
      <Accordion type="single" collapsible class="w-full">
        <AccordionItem v-for="(podcast, index) in usePage().props.podcasts" :key="index" :value="'podcast-' + index">
          <AccordionTrigger class="text-lg font-semibold">
            {{ podcast.title }}
          </AccordionTrigger>
          <AccordionContent>
            <p>{{ podcast.description }}</p>
          </AccordionContent>
        </AccordionItem>
      </Accordion>
    </div>
  </AppLayout>
</template>