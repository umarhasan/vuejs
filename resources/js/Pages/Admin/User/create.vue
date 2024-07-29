<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});

const submit = () => {
  form.post(route('admin.users.store'));
};
</script>

<template>
  <Head title="Create User" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create User</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submit">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
              <input v-model="form.name" id="name" class="mt-1 block w-full" type="text" required>
            </div>

            <div class="mt-4">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input v-model="form.email" id="email" class="mt-1 block w-full" type="email" required>
            </div>

            <div class="mt-4">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input v-model="form.password" id="password" class="mt-1 block w-full" type="password" required>
            </div>

            <div class="mt-4">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
              <input v-model="form.password_confirmation" id="password_confirmation" class="mt-1 block w-full" type="password" required>
            </div>

            <div class="mt-6">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
