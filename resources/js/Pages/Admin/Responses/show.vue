<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const { response } = defineProps({
  response: Object
});


</script>

<template>
  <Head title="View Response" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Response</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Question Display -->
            <div>
              <h3 class="text-lg font-medium text-gray-700">Question:</h3>
              <p class="mt-1 text-gray-600">{{ response.question.name }}</p>
            </div>

            <!-- Text Response Display -->
            <div>
              <h3 class="text-lg font-medium text-gray-700">Response:</h3>
              <p class="mt-1 text-gray-600">{{ response.response }}</p>
            </div>

            <!-- Total Questions Display -->
            <div>
              <h3 class="text-lg font-medium text-gray-700">Total Questions in Survey:</h3>
              <p class="mt-1 text-gray-600">{{ total_question }}</p>
            </div>

            <!-- Completed At Display -->
            <div>
              <h3 class="text-lg font-medium text-gray-700">Completed At:</h3>
              <p class="mt-1 text-gray-600">{{ response.completed_at }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>

  
  
<!--   
  <div>
    <h1>Response Details</h1>
    <p>User: {{ response.users }}</p>
    <p>Response: {{ response.response }}</p>
    <p>Total Questions: {{ response.total_questions }}</p>
    <p>Completed At: {{ response.completed_at }}</p>
  </div> -->
</template>


