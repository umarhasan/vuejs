<template>
  <div v-if="hasPermission">
    <slot />
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

const props = defineProps({
  permission: String
});

const store = useStore();
const hasPermission = computed(() => {
  const userPermissions = store.getters.permissions || [];
  return userPermissions.includes(props.permission);
});
</script>
