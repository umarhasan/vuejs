<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  questions: Array,
  options: Object,
  can: Object
});

const form = useForm();

const deleteOption = (optionId) => {
  if (confirm('Are you sure you want to delete this option?')) {
    form.delete(route('options.destroy', optionId), {
      onSuccess: () => {
        console.log("Option deleted successfully.");
      },
      onError: (errors) => {
        console.error("Error in option deletion:", errors);
      }
    });
  }
};
</script>

<template>
  <Head title="Options" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Options</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          
          <div class="mt-4">
            <table class="w-full text-sm text-left text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th scope="col" class="py-3 px-6">Question</th>
                  <th scope="col" class="py-3 px-6">Option Name</th>
                  <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="option in options.data" :key="option.id" class="bg-white border-b">
                  <td data-label="Question" class="py-4 px-6">{{ option.question.name }}</td>
                  <td data-label="Option Name" class="py-4 px-6">{{ option.name }}</td>
                  <td class="py-4 px-6">
                    <Link :href="route('options.edit', option.id)" class="bg-green-500 px-2 py-1 rounded text-white cursor-pointer">Edit</Link>
                    <button @click="deleteOption(option.id)" class="bg-red-500 px-2 py-1 rounded text-white cursor-pointer">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
