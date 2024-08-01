<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
  option: Object,
});

const form = useForm({
  name: props.option.name
});

const updateOption = () => {
  form.put(route('options.update', props.option.id), {
    onSuccess: () => {
      console.log("Option updated successfully.");
    },
    onError: (errors) => {
      console.error("Error in option update:", errors);
    }
  });
};
</script>

<template>
  <Head title="Edit Option" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Option</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="updateOption">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Option Name</label>
              <input v-model="form.name" id="name" class="mt-1 block w-full" type="text" required>
            </div>

            <div class="mt-6">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Option</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
