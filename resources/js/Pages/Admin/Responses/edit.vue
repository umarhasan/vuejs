<template>
  <Head title="Edit Response" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Response</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="updateResponse">
            <!-- Response Input -->
            <div class="mb-4">
              <label for="response" class="block text-sm font-medium text-gray-700">Response</label>
              <textarea v-model="form.response" id="response" class="mt-1 block w-full" required></textarea>
            </div>

            <!-- Submit Button -->
            <div>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Response</button>
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
import { defineProps } from 'vue';

const props = defineProps({
  response: Object,
});

const form = useForm({
  response: props.response.response,
});

const updateResponse = () => {
  form.put(route('responses.update', props.response.id));
};
</script>
