<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  responses: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm();

const deleteResponse = (responseId) => {
  if (confirm('Are you sure you want to delete this response?')) {
    form.delete(route('responses.destroy', responseId), {
      onSuccess: () => {
        console.log("Response deleted successfully.");
      },
      onError: (errors) => {
        console.error("Error in response deletion:", errors);
      }
    });
  }
};
</script>

<template>
  <Head title="Responses" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Responses
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="flex bg-gray-800 justify-between items-center p-5">
            <div class="flex space-x-2 items-center text-white">
              Response Settings Page! Here you can list, create, update or delete responses!
            </div>
          </div>
        </div>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="py-3 px-6">User Name</th>
                <th scope="col" class="py-3 px-6">Survey Name</th>
                <th scope="col" class="py-3 px-6">Total Questions</th>
                <th scope="col" class="py-3 px-6">Completed At</th>
                <th scope="col" class="py-3 px-6">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="response in responses.data" :key="response.id" class="bg-white border-b">
                <td data-label="User Name" class="py-4 px-6">
                  {{ response.user.name }}
                </td>
                <td data-label="Survey Name" class="py-4 px-6">
                  {{ response.survey.title }}
                </td>
                <td data-label="Total Questions" class="py-4 px-6">
                  {{ response.total_questions }}
                </td>
                <td data-label="Completed At" class="py-4 px-6">
                  {{ response.completed_at }}
                </td>
                <td class="py-4 px-6">
                  <div class="flex space-x-4">
                    <Link :href="route('responses.show', response.id)" class="bg-blue-500 px-2 py-1 rounded text-white cursor-pointer">View</Link>
                    <button @click="deleteResponse(response.id)" class="bg-red-500 px-2 py-1 rounded text-white cursor-pointer">Delete</button>
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
