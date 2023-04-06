<script setup>
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
</script>

<template>
    <div class="min-h-full relative pb-4" >
        <NavBar>
            <slot />
        </NavBar>
    </div>
    <Footer />
</template>

<style>
.material-design-icon.bottom-initial > .material-design-icon__svg  {
    bottom: 0;
}
</style>