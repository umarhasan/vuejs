<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
  role: Object,
  permissions: Array,
  rolePermissions: Array
});

const form = useForm({
  name: props.role.name,
  permissions: props.rolePermissions
});

const updateRole = () => {
  console.log("Form data before update:", form);
  form.put(route('role.update', props.role.id), {
    preserveScroll: true,
    onSuccess: () => {
      console.log("Role updated successfully.");
    },
    onError: (errors) => {
      console.error("Error in role update:", errors);
    }
  });
};
</script>

<template>
  <Head title="Edit Role" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Role</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="updateRole">
            <!-- Role Name Input -->
            <div>
              <label for="roleName" class="block text-sm font-medium text-gray-700">Role Name</label>
              <input v-model="form.name" id="roleName" class="mt-1 block w-full" type="text" required>
            </div>

            <!-- Permissions Selection -->
            <div class="mt-4">
              <label class="block text-sm font-medium text-gray-700">Permissions</label>
              <div v-for="permission in permissions" :key="permission.id" class="mt-2">
                <label class="inline-flex items-center">
                  <input type="checkbox" v-model="form.permissions" :value="permission.id">
                  <span class="ml-2">{{ permission.name }}</span>
                </label>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Role</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
