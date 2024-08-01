<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
  survey: Object,
  questions: Array,
});
</script>

<template>
  <Head title="Manage Questions" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Questions</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-lg font-semibold">Survey: {{ survey.title }}</h3>
          <div class="mt-4">
            <Link :href="route('question.new', { survey: survey.id })" class="px-4 py-2 bg-green-500 text-white rounded">Add Question</Link>
          </div>
          <div class="mt-4">
            <table class="w-full text-sm text-left text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th scope="col" class="py-3 px-6">Name</th>
                  <th scope="col" class="py-3 px-6">Question Type</th>
                  <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="question in questions" :key="question.id" class="bg-white border-b">
                  <td data-label="Name" class="py-4 px-6">{{ question.name }}</td>
                  <td data-label="Question Type" class="py-4 px-6">{{ question.question_type }}</td>
                  <td class="py-4 px-6">
                    <Link :href="route('questions.edit', question.id)" class="bg-green-500 px-2 py-1 rounded text-white cursor-pointer">Edit</Link>
                    <Link :href="route('surveys.questions.show', { survey: survey.id, question: question.id })" class="bg-blue-500 px-2 py-1 rounded text-white cursor-pointer">View</Link>
                    <Link v-if="question.question_type === 'Radio'" :href="route('questions.manage.options', question.id)" class="bg-purple-500 px-2 py-1 rounded text-white cursor-pointer">Manage Options</Link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
