<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
  survey: Object,
  question: Object,
});
</script>

<template>
  <Head title="Show Question" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Show Question</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-lg font-semibold">Survey: {{ survey.title }}</h3>
          <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Question Name</label>
            <p>{{ question.name }}</p>
          </div>
          <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Question Type</label>
            <p>{{ question.question_type }}</p>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
