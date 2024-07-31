<template>
  <div v-if="hasPermission">
    <slot />
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
  permission: String
});

const hasPermission = computed(() => {
  // Assuming the user's permissions are stored as an array in `auth.user.permissions`
  const userPermissions = usePage().props.value.auth.user.permissions || [];
  return userPermissions.includes(props.permission);
});
</script>
