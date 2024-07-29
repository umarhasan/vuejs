<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    permission: String
});

const userPermissions = usePage().props.value.permissions;

const hasPermission = computed(() => {
    return userPermissions.includes(props.permission);
});
</script>

<template>
<div v-if="hasPermission">
    <slot />
</div>
</template>