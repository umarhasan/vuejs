<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
  survey: Object,
});

const form = useForm({
  title: props.survey.title,
  status: props.survey.status
});

const updateSurvey = () => {
  form.put(route('surveys.update', props.survey.id), {
    onSuccess: () => {
      console.log("Survey updated successfully.");
    },
    onError: (errors) => {
      console.error("Error in survey update:", errors);
    }
  });
};
</script>

<template>
  <Head title="Edit Survey" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Survey</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="updateSurvey">
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700">Survey Title</label>
              <input v-model="form.title" id="title" class="mt-1 block w-full" type="text" required>
            </div>

            <div class="mt-4">
              <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
              <select v-model="form.status" id="status" class="mt-1 block w-full">
                <option value="Draft">Draft</option>
                <option value="Active">Active</option>
                <option value="Close">Close</option>
              </select>
            </div>

            <div class="mt-6">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Survey</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
