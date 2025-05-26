<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {
  Accordion, AccordionContent, AccordionItem, AccordionTrigger
} from '@/components/ui/accordion'
import { ref } from 'vue'

const accordionItems = ref([
  {
    title: 'What is this website about?',
    content: 'Goal 850 is a credit and identity protection service that helps you manage your personal information and protect your identity online.'
  },
  {
    title: 'How do I create an account?',
    content: 'To create an account, click on the "Sign Up" button on the homepage and fill out the registration form.'
  },
  {
    title: 'Where can I find more information?',
    content: 'More information can be found in the resources section of our website.'

  }
])
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
        <AccordionItem v-for="(item,index) in accordionItems" :key="index" :value="'item-' + index">
          <AccordionTrigger>{{ item.title }}</AccordionTrigger>
          <AccordionContent>
            {{ item.content }}
          </AccordionContent>
        </AccordionItem>
      </Accordion>
    </div>
  </AppLayout>
</template>