<script setup>
    import { Head } from '@inertiajs/inertia-vue3';
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
   <Head :title="'Politique de confidentialité'" /> 
   <section class="container mx-auto mt-5">
      <h1 class="font-bold lg:text-3xl sm:text-xl text-lg text-gray-800 text-center pb-1 pt-5 px-2">Politique de confidentialité</h1>
      <article>
         <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800 text-center pb-1 pt-5 px-2">Politique de confidentialité</h2>
         <p>
            Dans le cadre de son activité, la société Nazar Rugs, dont le siège social est situé au 1625 route de Sandillon 45560 Saint denis en Val, est amenée à collecter et à traiter des informations dont certaines sont qualifiées de "données personnelles". Nazar Rugs attache une grande importance au respect de la vie privée, et n’utilise que des donnes de manière responsable et confidentielle et dans une finalité précise.
         </p>
      </article>
      <article>
         <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800 text-center pb-1 pt-5 px-2">Données personnelles</h2>
         <p>Sur le site web www.nazarrugs.com/edi, il y a 2 types de données susceptibles d’être recueillies :</p>
         <ul>
            <li>
               Ces données sont celles que vous nous transmettez directement, via un formulaire de contact ou bien par contact direct par email. Sont obligatoires dans le formulaire de contact le champs « prénom et nom », « entreprise ou organisation » et « email ».
            </li>
            <li>
               Les données collectées automatiquement
               Lors de vos visites, une fois votre consentement donné, nous pouvons recueillir des informations de type « web analytics » relatives à votre navigation, la durée de votre consultation, votre adresse IP, votre type et version de navigateur. La technologie utilisée est le cookie.
            </li>
         </ul>
      </article>
      <article>
         <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800 text-center pb-1 pt-5 px-2">Utilisation des données</h2>
         <p>
            Les données que vous nous transmettez directement sont utilisées dans le but de vous re-contacter et/ou dans le cadre de la demande que vous nous faites. Les données « web analytics » sont collectées de forme anonyme (en enregistrant des adresses IP anonymes) par Google Analytics, et nous permettent de mesurer l'audience de notre site web, les consultations et les éventuelles erreurs afin d’améliorer constamment l’expérience des utilisateurs. Ces données sont utilisées par Nazar Rugs, responsable du traitement des données, et ne seront jamais cédées à un tiers ni utilisées à d’autres fins que celles détaillées ci-dessus.
         </p>
      </article>
      <article>
         <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800 text-center pb-1 pt-5 px-2">Base légale</h2>
         <p>
            Les données personnelles ne sont collectées qu’après consentement obligatoire de l’utilisateur. Ce consentement est valablement recueilli (boutons et cases à cocher), libre, clair et sans équivoque.
         </p>
      </article>
      <article>
         <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800 text-center pb-1 pt-5 px-2">Durée de conservation</h2>
         <p>
            Les données seront sauvegardées durant une durée maximale de 2 ans.
         </p>
      </article>
      <article>
         <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800 text-center pb-1 pt-5 px-2">Cookies</h2>
         <p>Voici la liste des cookies utilisées et leur objectif :</p>
         <ul>
            <li>
               Cookies Google Analytics (<a class="underline hover:scale-[1.2]" href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage">liste exhaustive</a>) : Web analytics
            </li>
         </ul>
      </article>
      <article>
         <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800 text-center pb-1 pt-5 px-2">Vos droits concernant les données personnelles</h2>
         <p>
            Vous avez le droit de consultation, demande de modification ou d’effacement sur l’ensemble de vos données personnelles. Vous pouvez également retirer votre consentement au traitement de vos données.
         </p>
      </article>
   </section>
</template>