<script setup>
import { Head,Link } from '@inertiajs/inertia-vue3';
const imageUrl = new URL('../../../images/Logo/Nazar Logo.svg', import.meta.url).href;
const btob = new URL('../../../images/Accueil/BtoB.webp', import.meta.url).href;
const btoc = new URL('../../../images/Accueil/BtoC.webp', import.meta.url).href;
</script>
<template>
   <Head title="Choix type commandes" />
   <div class="bg-primary-50 fixed w-full h-full flex items-center justify-center ">
      <Link href="/type_order/about-us" class="absolute top-5 right-40 py-2 text-sm text-primary-300 hover:text-primary-500 transition duration-300" >{{$t('navbar.aPropos')}}</Link>
      <Link class="absolute top-5 right-5 py-2 px-4 rounded text-sm bg-red-600 text-white hover:bg-red-400 transition duration-300" :href="route('logout')" method="post" as="button">{{$t('navbar.deconnexion')}}</Link>
                  
      <section class="container mx-auto text-center">
         <div class="flex justify-center items-center">
            <img :src="imageUrl" alt="Logo Nazar Rugs" class="w-60 h-60 " />
         </div>
         
         <h1 class="lg:text-2xl sm:text-xl text-lg sm:mx-0 mx-2 font-bold py-10">Pour continuer, sélectionner le type de commande</h1>
         
         <div class="flex items-center justify-center">
            <div class="sm:my-5 sm:mx-12 mx-5 my-2">
               <Link href="/type_order/warehouse" class="relative flex items-center justify-center flex-col hover:scale-105 transition duration-300 xl:h-96 xl:p-20 lg:p-10 lg:h-72 sm:p-5 sm:h-44 h-52 rounded w-full" type="button" >
                  <img :src="btob" alt="Logo B to B" class="xl:w-80 xl:h-80 lg:w-72 lg:h-72 sm:w-44 sm:h-44 h-36 w-36" />
               </Link>
            </div>
            <div class="sm:my-5 sm:mx-12 mx-5 my-2">
               <Link href="/type_order/customers" class="relative flex items-center justify-center flex-col hover:scale-105 transition duration-300 xl:h-96 xl:p-20 lg:p-10 lg:h-72 sm:p-5 sm:h-44 h-52 rounded w-full" type="button" >
                  <img :src="btoc" alt="Logo B to C" class="xl:w-80 xl:h-80 lg:w-72 lg:h-72 sm:w-44 sm:h-44 h-36 w-36" />
               </Link>
            </div>
         </div>
      </section>
   </div>
</template>