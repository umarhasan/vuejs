<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
  survey: Object,
});

const form = useForm({
  name: '',
  question_type: 'Text',
  survey_id: props.survey.id
});

const submitQuestion = () => {
  form.post(route('questions.store'), {
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      console.error("Error in question creation:", errors);
    }
  });
};
</script>

<template>
  <Head title="Create Question" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Question for {{ survey.title }}</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submitQuestion">
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

            <!-- Hidden Input for survey_id -->
            <input type="hidden" v-model="form.survey_id" />

            <div class="mt-6">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create Question</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
