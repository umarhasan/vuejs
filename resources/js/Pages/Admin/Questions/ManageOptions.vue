<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link, useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
  question: Object,
  options: Array,
});
</script>

<template>
  <Head title="Manage Options" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Options</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-lg font-semibold">Question: {{ question.name }}</h3>
          <div class="mt-4">
              <Link :href="route('options.new', { question: question.id })" class="px-4 py-2 bg-green-500 text-white rounded">Add Option</Link>
          </div>
          <div class="mt-4">
            <table class="w-full text-sm text-left text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th scope="col" class="py-3 px-6">Name</th>
                  <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="option in options" :key="option.id" class="bg-white border-b">
                  <td data-label="Name" class="py-4 px-6">{{ option.name }}</td>
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
