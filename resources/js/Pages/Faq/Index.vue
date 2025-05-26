<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {
  Accordion, AccordionContent, AccordionItem, AccordionTrigger
} from '@/components/ui/accordion'
</script>

<template>
  <AppLayout>
    <div class="container mx-auto">
      <h1>Frequently Asked Questions</h1>
      <p>Here you can find answers to the most common questions.</p>
      <Accordion
        type=""
        class="w-full"
        collapsible
        :default-value="defaultValue">
        <AccordionItem v-for="item in accordionItems" :key="item.value" :value="item.value">
          <AccordionTrigger>{{ item.title }}</AccordionTrigger>
          <AccordionContent>
            {{ item.content }}
          </AccordionContent>
        </AccordionItem>
      </Accordion>
    </div>
  </AppLayout>
</template>