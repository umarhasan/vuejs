<template>
  <Head title="Create Permission" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Permission</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submitPermission">
            <!-- Permission Name Input -->
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
              <input v-model="form.name" id="name" class="mt-1 block w-full" type="text" required>
            </div>

            <!-- Submit Button -->
            <div>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create Permission</button>
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
  name: '',
});

const submitPermission = () => {
  form.post(route('permissions.store'), {
    onSuccess: () => form.reset(),
  });
};
</script>
