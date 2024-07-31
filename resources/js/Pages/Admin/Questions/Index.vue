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
    <Head title="Questions" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Questions for {{ survey.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex bg-gray-800 justify-between items-center p-5">
                        <div class="flex space-x-2 items-center text-white">
                            Question Settings Page! Here you can list, create, update or delete questions!
                        </div>
                        <div class="flex space-x-2 items-center" v-if="can.create">
                            <Link :href="route('questions.create', { survey_id: survey.id })" class="px-4 py-2 bg-green-500 uppercase text-white rounded focus:outline-none flex items-center">
                                <span class="iconify mr-1" data-icon="gridicons:create" data-inline="false"></span> Create Question
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
                                <th scope="col" class="py-3 px-6">Type</th>
                                <th v-if="can.edit || can.delete" scope="col" class="py-3 px-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="question in questions.data" :key="question.id" class="bg-white border-b">
                                <td data-label="Name" class="py-4 px-6">
                                    {{ question.name }}
                                </td>
                                <td data-label="Type" class="py-4 px-6">
                                    {{ question.question_type }}
                                </td>
                                <td
                                    v-if="can.edit || can.delete"
                                    class="py-4 px-6"
                                >
                                    <div type="justify-start lg:justify-end" no-wrap>
                                        <Link :href="route('questions.edit', { id: question.id, survey_id: survey.id })" class="ml-4 bg-green-500 px-2 py-1 rounded text-white cursor-pointer" v-if="can.edit">
                                            Edit
                                        </Link>
                                        <button @click="deleteQuestion(question.id)" class="ml-4 bg-red-500 px-2 py-1 rounded text-white cursor-pointer" v-if="can.delete">
                                            Delete
                                        </button>
                                        <Link :href="route('options.index', { question_id: question.id })" class="ml-4 bg-blue-500 px-2 py-1 rounded text-white cursor-pointer">
                                            Manage Options
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

