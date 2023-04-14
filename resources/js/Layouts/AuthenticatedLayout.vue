<script setup>
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
</script>

<template>
    <div class="min-h-screen flex flex-col relative " >
        <NavBar>   
        </NavBar>
        <main class="flex-1 mb-5">
            <slot />
        </main>
        
        <Footer />
    </div>
</template>

<style>
.material-design-icon.bottom-initial > .material-design-icon__svg  {
    bottom: 0;
}
</style>