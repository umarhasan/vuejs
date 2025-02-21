<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  roles: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm();

const deleteRole = (roleId) => {
  if (confirm('Are you sure you want to delete this role?')) {
    form.delete(route('role.destroy', roleId), {
      onSuccess: () => {
        console.log("Role deleted successfully.");
      },
      onError: (errors) => {
        console.error("Error in role deletion:", errors);
      }
    });
  }
};
</script>

<template>
  <Head title="Role" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Role</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="flex bg-gray-800 justify-between items-center p-5">
            <div class="flex space-x-2 items-center text-white">
              Role Settings Page! Here you can list, create, update or delete roles!
            </div>
            <div class="flex space-x-2 items-center" v-if="can.create">
              <Link :href="route('role.create')" class="px-4 py-2 bg-green-500 uppercase text-white rounded focus:outline-none flex items-center">
                <span class="iconify mr-1" data-icon="gridicons:create" data-inline="false"></span> Create Role
              </Link>
            </div>
          </div>
        </div>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="py-3 px-6">Name</th>
                <th v-if="can.edit || can.delete" scope="col" class="py-3 px-6">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="role in roles.data" :key="role.id" class="bg-white border-b">
                <td data-label="Name" class="py-4 px-6">
                  {{ role.name }}
                </td>
                <td v-if="can.edit || can.delete" class="py-4 px-6">
                  <div class="flex space-x-4">
                    <Link v-if="can.edit" :href="route('role.edit', role.id)" class="bg-green-500 px-2 py-1 rounded text-white cursor-pointer">Edit</Link>
                    <button v-if="can.delete" @click="deleteRole(role.id)" class="bg-red-500 px-2 py-1 rounded text-white cursor-pointer">Delete</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
