<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const { questions } = defineProps({
  questions: Array
});

const form = useForm({
  question_id: '',
  response: '',
  total_questions: '',
  completed_at: ''
});


const submit = () => {
  console.log("Form data before submission:", form);
  form.post(route('responses.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset('responses');
      console.log("responses created successfully.");
    },
    onError: (errors) => {
      console.error("Error in role creation:", errors);
    }
  });
};
</script>

<template>
  <Head title="Create Response" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Response</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submit">
            <!-- Question Selection -->
            <div class="mt-4">
              <label for="question_id" class="block text-sm font-medium text-gray-700">Question:</label>
              <select v-model="form.question_id" id="question_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <option disabled value="">Please select one</option>
                <option v-for="question in questions" :key="question.id" :value="question.id">
                  {{ question.name }}
                </option>
              </select>
            </div>

            <!-- Text Response -->
            <div class="mt-4">
              <label for="response" class="block text-sm font-medium text-gray-700">Response:</label>
              <textarea v-model="form.response" id="response" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
            </div>

            <!-- Total Questions -->
            <div class="mt-4">
              <label for="total_questions" class="block text-sm font-medium text-gray-700">Total Questions:</label>
              <input type="number" v-model="form.total_questions" id="total_questions" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>

            <!-- Completed At -->
            <div class="mt-4">
              <label for="completed_at" class="block text-sm font-medium text-gray-700">Completed At:</label>
              <input type="date" v-model="form.completed_at" id="completed_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit Response</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
