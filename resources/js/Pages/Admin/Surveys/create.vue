<template>
  <Head title="Create Survey" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Survey</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submitSurvey">
            <!-- Survey Title Input -->
            <div class="mb-4">
              <label for="title" class="block text-sm font-medium text-gray-700">Survey Title</label>
              <input v-model="form.title" id="title" class="mt-1 block w-full" type="text" required>
            </div>

            <!-- Survey Status Input -->
            <div class="mb-4">
              <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
              <select v-model="form.status" id="status" class="mt-1 block w-full" required>
                <option value="Draft">Draft</option>
                <option value="Active">Active</option>
                <option value="Close">Close</option>
              </select>
            </div>

            <!-- Submit Button -->
            <div>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create Survey</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
  title: '',
  status: 'Draft',
});

const submitSurvey = () => {
  form.post(route('surveys.store'), {
    onSuccess: () => form.reset(),
  });
};
</script>
