<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
  question: Object,
});

const form = useForm({
  name: props.question.name,
  question_type: props.question.question_type
});

const updateQuestion = () => {
  form.put(route('questions.update', props.question.id), {
    onSuccess: () => {
      console.log("Question updated successfully.");
    },
    onError: (errors) => {
      console.error("Error in question update:", errors);
    }
  });
};
</script>

<template>
  <Head title="Edit Question" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Question</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="updateQuestion">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Question Name</label>
              <input v-model="form.name" id="name" class="mt-1 block w-full" type="text" required>
            </div>

            <div class="mt-4">
              <label for="question_type" class="block text-sm font-medium text-gray-700">Question Type</label>
              <select v-model="form.question_type" id="question_type" class="mt-1 block w-full">
                <option value="Text">Text</option>
                <option value="Radio">Radio</option>
              </select>
            </div>

            <div class="mt-6">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Question</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
