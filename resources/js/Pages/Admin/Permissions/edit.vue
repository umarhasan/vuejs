<template>
  <Head title="Edit Permission" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Permission</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="updatePermission">
            <!-- Permission Name Input -->
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
              <input v-model="form.name" id="name" class="mt-1 block w-full" type="text" required>
            </div>

            <!-- Submit Button -->
            <div>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Permission</button>
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
  permission: Object,
});

const form = useForm({
  name: props.permission.name,
});

const updatePermission = () => {
  form.put(route('permissions.update', props.permission.id));
};
</script>
