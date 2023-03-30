<script setup>
import Langue from '@/Components/LangueChoice.vue';
const fond = new URL('../../images/FondLogin/fond2.webp', import.meta.url).href;
defineProps(['TextTitre','SousTitre','TextBouttonTitre','hrefBtnTitre']);

</script>

<script>
    import pinterest from "icons/Pinterest.vue";
    import instagram from "icons/Instagram.vue";
    import facebook from "icons/Facebook.vue";
    import linkedin from "icons/Linkedin.vue";
    import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <section class="min-h-screen flex items-stretch text-white ">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center" :style="{'background-image':'url('+fond+')'}" >
            <div class="absolute bg-black opacity-40 inset-0 z-0"></div>
            <div class="grid grid-rows-1 px-24 z-10">
                <h1 class="text-5xl font-bold text-left tracking-wide">{{ TextTitre }}</h1>
                <p class="text-3xl my-4">{{ SousTitre }}</p>
                <div class="flex items-center my-4">
                    <hr class="w-full"/><span class="px-2 text-xl">{{$t('Or')}}</span><hr class="w-full"/>
                </div>
                <Link :href="route(hrefBtnTitre)" class="block w-full text-center px-5 py-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-400 focus:outline-none">{{ TextBouttonTitre }}</Link>
            </div>
            <div class="bottom-0 absolute p-4 text-center right-0 left-0 flex justify-center space-x-4 text-[28px]">
                <a href="https://www.pinterest.fr/nazarrugsfrance/" rel="noopener" target="_blank" aria-label="Pinterest">
                    <pinterest />
                </a>
                <a href="https://www.instagram.com/nazar_rugs/" rel="noopener" target="_blank" aria-label="Instagram">
                    <instagram />
                </a>
                <a href="https://www.facebook.com/Nazarrugs-102036118298025" rel="noopener" target="_blank" aria-label="Facebook">
                    <facebook />
                </a>
                <a href="https://fr.linkedin.com/company/nazar-rugs" rel="noopener" target="_blank" aria-label="Linkedin">
                    <linkedin />
                </a>
            </div>
        </div>
        <div class="lg:w-1/2 w-full flex sm:items-center items-start justify-center text-center md:px-16 px-0 z-0 bg-primary-50 relative">
            <div class="w-full z-20">
                <!-- <div class="absolute right-5 top-5"><Langue class="w-20" /></div> -->
                <slot />
            </div>
        </div>
    </section>
</template>
