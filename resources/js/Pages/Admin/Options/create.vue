<template>
  <Head title="Create Option" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Option for Question: {{ question.name }}</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submitOption">
            <!-- Option Name Input -->
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700">Option Name</label>
              <input v-model="form.name" id="name" class="mt-1 block w-full" type="text" required>
            </div>

            <!-- Submit Button -->
            <div>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create Option</button>
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
  question: Object,
});

const form = useForm({
  name: '',
});

const submitOption = () => {
  form.post(route('options.store', { question_id: props.question.id }), {
    onSuccess: () => form.reset(),
  });
};
</script>
