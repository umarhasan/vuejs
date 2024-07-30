<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  roles: Array,
});

const form = useForm({
  name: '',
  email: '',
  password: '',
  role: '',
 
});

const submit = () => {
  form.post(route('user.store'));
};
</script>

<template>
  <Head title="Create User" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create User</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submit">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
              <input v-model="form.name" id="name" type="text" class="mt-1 block w-full" required />
            </div>
            <div class="mt-4">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input v-model="form.email" id="email" type="email" class="mt-1 block w-full" required />
            </div>
            <div class="mt-4">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input v-model="form.password" id="password" type="password" class="mt-1 block w-full" required />
            </div>
            <div class="mt-4">
              <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
              <select v-model="form.role" id="role" class="mt-1 block w-full" required>
                <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
              </select>
            </div>
            <div class="mt-6">
              <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
