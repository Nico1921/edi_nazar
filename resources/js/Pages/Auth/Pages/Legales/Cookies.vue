<script setup>
   import { Head } from '@inertiajs/inertia-vue3';
   import Breadcrumbs from '@/Components/Breadcrumbs.vue';
   import { HomeIcon,LightBulbIcon  } from '@heroicons/vue/24/solid';
    var links = [{
        title: 'Accueil',
        link: '/',
        icon: HomeIcon,
        active: false
    },{
      title: 'Cookies',
      link: '/cookies',
      icon: LightBulbIcon,
      active: true
   }];
 </script>
<script >

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    export default {
    // Using a render function
    layout: (h, page) => h(AuthenticatedLayout, () => child),

    // Using the shorthand
    layout: AuthenticatedLayout,
    }
</script>

<template>
   <Head :title="'Cookies'" /> 
   <section class="container mx-auto mt-5">
      <Breadcrumbs :links="links" />
      <h1 class="font-bold lg:text-3xl sm:text-xl text-lg text-gray-800 text-center pb-1 pt-5 px-2">Cookies</h1>
      <article>
         <p>Voici la liste des cookies utilisées et leur objectif :</p>
         <ul>
            <li>
               Cookies Google Analytics (<a class="underline hover:scale-[1.2]" href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage">liste exhaustive</a>) : Web analytics
            </li>
         </ul>
      </article>
   </section>
</template>