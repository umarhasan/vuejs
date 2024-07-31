<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  surveys: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm();

const deleteSurvey = (roleId) => {
  if (confirm('Are you sure you want to delete this role?')) {
    form.delete(route('surveys.destroy', roleId), {
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
    <Head title="Surveys" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Surveys
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex bg-gray-800 justify-between items-center p-5">
                        <div class="flex space-x-2 items-center text-white">
                            Survey Settings Page! Here you can list, create, update or delete surveys!
                        </div>
                        <div class="flex space-x-2 items-center">
                            <Link :href="route('surveys.create')" class="px-4 py-2 bg-green-500 uppercase text-white rounded focus:outline-none flex items-center">
                                <span class="iconify mr-1" data-icon="gridicons:create" data-inline="false"></span> Create Survey
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
                                <th scope="col" class="py-3 px-6">Title</th>
                                <th scope="col" class="py-3 px-6">Status</th>
                                <th scope="col" class="py-3 px-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="survey in surveys.data" :key="survey.id" class="bg-white border-b">
                                <td data-label="Title" class="py-4 px-6">
                                    {{ survey.title }}
                                </td>
                                <td data-label="Status" class="py-4 px-6">
                                    {{ survey.status }}
                                </td>
                                <td class="py-4 px-6">
                                    <div type="justify-start lg:justify-end" no-wrap>
                                        <Link :href="route('surveys.edit', survey.id)" class="ml-4 bg-green-500 px-2 py-1 rounded text-white cursor-pointer">
                                            Edit
                                        </Link>
                                        <button @click="deleteSurvey(survey.id)" class="ml-4 bg-red-500 px-2 py-1 rounded text-white cursor-pointer">
                                            Delete
                                        </button>
                                        <Link :href="route('questions.index', { survey_id: survey.id })" class="ml-4 bg-blue-500 px-2 py-1 rounded text-white cursor-pointer">
                                            Manage Questions
                                        </Link>
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


