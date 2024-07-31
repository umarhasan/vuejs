<template>
    <div>
        <Navigation />
        <Header v-if="$slots.header">
            <template #header>
                <slot name="header" />
            </template>
        </Header>
        <main>
            <slot />
        </main>
        <Footer>
            <template #footer>
                <slot name="footer" />
            </template>
        </Footer>
    </div>
</template>

<script setup>
import Navigation from '@/Components/Navigation.vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
</script>

<style scoped>
</style>
