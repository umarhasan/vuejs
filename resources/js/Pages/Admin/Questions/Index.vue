<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  questions: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm();

const deleteQuestion = (questionId) => {
  if (confirm('Are you sure you want to delete this question?')) {
    form.delete(route('questions.destroy', questionId), {
      onSuccess: () => {
        console.log("Question deleted successfully.");
      },
      onError: (errors) => {
        console.error("Error in question deletion:", errors);
      }
    });
  }
};
</script>

<template>
  <Head title="Questions" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Questions
      </h2>
    </template>

    <div class="py-12">
      
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="py-3 px-6">Name</th>
                <th scope="col" class="py-3 px-6">Question Type</th>
                <th scope="col" class="py-3 px-6">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="question in questions.data" :key="question.id" class="bg-white border-b">
                <td data-label="Name" class="py-4 px-6">
                  {{ question.name }}
                </td>
                <td data-label="Question Type" class="py-4 px-6">
                  {{ question.question_type }}
                </td>
                <td class="py-4 px-6">
                  <div class="flex space-x-4">
                    <Link :href="route('questions.edit', question.id)" class="bg-green-500 px-2 py-1 rounded text-white cursor-pointer">Edit</Link>
                    <button @click="deleteQuestion(question.id)" class="bg-red-500 px-2 py-1 rounded text-white cursor-pointer">Delete</button>
                    <Link v-if="question.question_type === 'Radio'" :href="route('questions.manage.options', question.id)" class="bg-blue-500 px-2 py-1 rounded text-white cursor-pointer">Manage Options</Link>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
