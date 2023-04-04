<script setup>
import NavBar from '@/Components/NavBar.vue';
import Home from 'icons/Home.vue';
import Right from 'icons/ChevronRight.vue';
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';

var user = ref(usePage().props.value.auth.user);
</script>

<template>
    <div class="min-h-full relative xl:pb-24 lg:pb-28 pb-24" >
        <NavBar>
            <slot />
        </NavBar>
    </div>
        <footer class="bg-primary-50 grid grid-cols-12 items-center justify-center text-center w-full absolute bottom-0 lg:h-16 h-24">
            <div class="lg:absolute left-5 lg:block hidden">
                <a href="/politique-confidentialite" class="text-gray-500 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Politique de confidentialité</a>
            </div>
            
            <div class="col-span-12">
                <span class="text-gray-400 ">@Copyright NAZAR RUGS {{ new Date().getFullYear() }}</span>
            </div>
            <div class="lg:hidden block col-span-12">
                <a href="/politique-confidentialite" class="text-gray-500 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Politique de confidentialité</a>
            </div>
            <div class="lg:absolute right-5 col-span-12">
                <a href="/cgv" class="text-gray-500 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Condition Générale de Vente</a>
            </div>
        </footer>
    
</template>

<style>
.material-design-icon.bottom-initial > .material-design-icon__svg  {
    bottom: 0;
}
</style>