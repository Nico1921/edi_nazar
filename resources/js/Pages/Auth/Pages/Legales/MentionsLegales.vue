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
      title: 'Mentions Légales',
      link: '/mentions-legales',
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
   <Head :title="'Mentions Légales'" /> 
   <section class="container mx-auto mt-5">
      <Breadcrumbs :links="links" />
      <h1 class="font-bold lg:text-3xl sm:text-xl text-lg text-gray-800 text-center pb-1 pt-5 px-2">Mentions Légales</h1>
      <article>
         <p>Conformément aux dispositions de l'article 6 III 1° de la loi n°2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, nous vous informons que :</p>
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800  pb-1 pt-5 px-2">1. Société propriétaire du site Nazar Rugs</h2>
              <ul class="ml-8 list-disc">
                  <li>Le présent site est la propriété de la société Nazar Rugs au capital de 200 000€.</li>
                  <li>Siège social : 1625 route de Sandillon 45560 Saint Denis en val.</li>
                  <li>Tél : 02 38 43 29 14</li>
                  <li>contact@nazarrugs.fr</li>
                  <li>Immatriculée au Registre du commerce et des sociétés de Paris sous le numéro 538 175 498 00046</li>
                  <li>TVA Intracommunautaire : FR15 538 175 498</li>
              </ul>
          </article>  
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800 pb-1 pt-5 px-2">Réalisation & Conception</h2>
            <p>Le site a été réalisé par l'équipe de Nazar Rugs</p>
          </article>
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800  pb-1 pt-5 px-2">Hébergement</h2>
            <p>L'hébergement du site est assuré par la société OVH.</p>
          </article>
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800  pb-1 pt-5 px-2">Article 1 : Préambule</h2>
            <p>
               Les utilisateurs ne peuvent bénéficier des services/produits qui leur sont proposés sur le site que sous réserve de l’acceptation des présentes conditions d’utilisation. L’utilisateur du site reconnaît avoir pris connaissance des présentes conditions d’utilisation et s’engage à les respecter.
               L’utilisateur reconnaît disposer de la compétence et des moyens nécessaires pour accéder et utiliser le site.
            </p>
          </article>
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800  pb-1 pt-5 px-2">Article 2 : Objet</h2>
            <p>
               Les présentes Conditions Générales d'utilisation ont pour objet de définir les modalités et conditions d'utilisation du site web accessible à l'adresse edi.nazarrugs.fr.
            </p>
          </article>
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800  pb-1 pt-5 px-2">Article 3 : Entrée en vigueur – Durée</h2>
            <p>Les présentes conditions d'utilisation entrent en vigueur à la date de leur mise en ligne et seront opposables à l'utilisateur à partir de la première utilisation du site. 
               Elles restent en vigueur pendant toute la durée d'utilisation du site jusqu'à ce que de nouvelles conditions d'utilisation les remplacent. 
               L'utilisateur a la possibilité de renoncer à tout moment à l'utilisation des services et du site, mais reste responsable de toute utilisation antérieure.</p>
          </article>
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800  pb-1 pt-5 px-2">Article 4 : Liens</h2>
            <p>edi.nazarrugs.fr se réserve le droit de mettre en place des liens sur son site web donnant accès à des pages web autres que celles de son site. 
               Les utilisateurs sont informés que les sites auxquels ils peuvent accéder par l’intermédiaire des liens ne sont pas la propriété de edi.nazarrugs.fr. 
               edi.nazarrugs.fr décline toute responsabilité quant au contenu des informations fournies sur ces sites au titre de l'activation du lien.
               La mise en place d'un lien en direction de ce site web sans l'autorisation expresse et préalable de edi.nazarrugs.fr est interdite.  
               L'éditeur du site ne peut être tenu responsable de l'accès par les utilisateurs par les liens présents sur le site à d'autres ressources présentes sur le réseau Internet.</p>
          </article>
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800  pb-1 pt-5 px-2">Article 5 : Cookies</h2>
            <p>
               L’utilisateur est informé qu'un cookie peut être installé automatiquement sur son logiciel de navigation lors de ses visites sur le site.
               Les cookies enregistrent certaines informations qui sont stockées dans la mémoire du disque de l’utilisateur.
               En aucun cas, les cookies ne contiennent d’information confidentielle, mais ils permettent de garder en mémoire les pages sur lesquelles l’utilisateur a navigué.
               Conformément à la loi, l’utilisateur dispose d’un droit d’accès, de retrait et de modification des données personnelles le concernant communiquées par le biais des cookies. 
               Le paramétrage du logiciel de navigation permet d’informer de la présence de cookies et éventuellement de les refuser, de la manière décrite sur le site de la CNIL à l’adresse suivante : http://www.cnil.fr.
            </p>
          </article>
          <article class="mt-4">
            <h2 class="font-bold lg:text-2xl sm:text-lg text-sm text-gray-800  pb-1 pt-5 px-2">Article 6 : Responsabilité de l’éditeur du site</h2>
            <p>edi.nazarrugs.fr ne saurait être responsable :</p>
            <ul class="ml-8 list-disc">
               <li>Des commentaires extérieurs sur les produits.</li>
               <li>De la perturbation de l'utilisation du site, notamment en cas d'interruption du service, de problèmes techniques ou de défaillance du réseau.</li>
               <li>Des photographies et dessins des produits qui ne sont pas contractuels.</li>
               <li>De l'impossibilité pour l'utilisateur d'utiliser le site web pour quelque cause que ce soit.</li>
               <li>Des atteintes à la sécurité informatique, pouvant causer des dommages aux matériels informatiques des utilisateurs et à leurs données.</li>
               <li>De l'atteinte aux droits des utilisateurs de manière générale.</li>
            </ul>
            <p>
               L’éditeur du site s'efforce de fournir aux utilisateurs des informations et/ou des outils disponibles et vérifiés, mais ne peut être tenu responsable des erreurs, de l'absence de disponibilité des informations et/ou de la présence de virus, dont la violation est passible de sanctions pénales sur le site.
               Les informations fournies par l’éditeur du site ne peuvent dispenser l’utilisateur d'une analyse complémentaire et personnalisée.
               L’éditeur du site ne garantit pas l'exactitude, l'exhaustivité ou l'actualité des informations diffusées sur le site.
               En conséquence, l’utilisateur reconnaît utiliser ces informations sous sa seule responsabilité.
            </p>
          </article>
      </article>
   </section>
</template>