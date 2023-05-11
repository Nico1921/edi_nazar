<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { HomeIcon,LightBulbIcon, ChevronDownIcon  } from '@heroicons/vue/24/solid';
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
  } from '@headlessui/vue';

const schema = new URL('../../../../images/AboutUs/schema.webp', import.meta.url).href;
var links = [{
        title: 'Accueil',
        link: '/',
        icon: HomeIcon,
        active: false
    },{
      title: 'FAQ',
      link: '/faq',
      icon: LightBulbIcon,
      active: true
}];
const transitionClasses = {
   enter: 'transition duration-500 ease-out',
   enterFrom: 'transform scale-95 opacity-0',
   enterTo: 'transform scale-100 opacity-100',
   leave: 'transition duration-500 ease-out',
   leaveFrom: 'transform scale-100 opacity-100',
   leaveTo: 'transform scale-95 opacity-0',
};
</script>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    // Using a render function
    layout: (h, page) => h(AuthenticatedLayout, () => child),

    // Using the shorthand
    layout: AuthenticatedLayout,
}
</script>
   
<template>
    <Head title="FAQ" />
    <section class="container mx-auto px-7 mt-5">
         <Breadcrumbs :links="links" />
         <h1 class="font-semibold text-sm lg:text-xl sm:text-lg text-gray-800 text-center py-5">
               FAQ
         </h1>

         <div class="w-full px-4">
            <div class="mx-auto w-full rounded-2xl bg-white p-2">
               <Disclosure v-slot="{ open }" >
                  <DisclosureButton :class="open ? 'bg-primary-200 rounded-tr-lg' : 'bg-primary-100 rounded-r-lg'" class="flex w-full justify-between px-4 py-2 text-left text-sm font-medium text-primary-400 hover:bg-primary-200 focus:outline-none focus-visible:ring focus-visible:ring-primary-300 focus-visible:ring-opacity-75 transition-full duration-300">
                     <span class="font-semibold">COMMENT PASSER UNE COMMANDE ENTREPÔT ?</span>
                     <ChevronDownIcon
                        :class="open ? 'rotate-180 transform' : ''"
                        class="h-5 w-5 text-primary-300"
                     />
                  </DisclosureButton>
                  <transition
                  :enter-active-class="transitionClasses.enter" :enter-from-class="transitionClasses.enterFrom"
                  :enter-to-class="transitionClasses.enterTo" :leave-active-class="transitionClasses.leave"
                  :leave-from-class="transitionClasses.leaveFrom" :leave-to-class="transitionClasses.leaveTo">
                     <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500 bg-primary-200 rounded-b-lg">
                       <p class="py-1">Si vous souhaitez passer une commande pour votre entrepôt, suivez les étapes suivantes :</p>
                       <p class="py-1">1 : Sélectionnez les produits que vous souhaitez commander pour votre entrepôt.</p>
                        <p class="py-1">2 : Ajoutez les produits sélectionnés à votre panier, puis rendez-vous à l'étape 2 pour saisir l'adresse de livraison
                        et votre référence de commande.</p>
                        <p class="py-1">3 : Sélectionnez le mode de paiement de votre choix et validez votre commande.</p>
                           <p class="py-1">De plus, sur l'onglet Commandes Entrepôts, vous pouvez consulter l'état des stocks en temps réel avec une
                        mise à jour quotidienne.</p>
                        <p class="py-1">Vous pouvez également télécharger des photos, récupérer les descriptions techniques de chaque collection et
                        vérifier les codes SKU et EAN.</p>
                        <p class="py-1">Une recherche rapide est possible en entrant vos besoins dans l'encart approprié sous chaque titre.</p>
                     </DisclosurePanel>
                  </transition>
               </Disclosure>
            </div>
            <div class="mx-auto w-full rounded-2xl bg-white p-2">
               <Disclosure v-slot="{ open }" >
                  <DisclosureButton :class="open ? 'bg-primary-200 rounded-tr-lg' : 'bg-primary-100 rounded-r-lg'" class="flex w-full justify-between px-4 py-2 text-left text-sm font-medium text-primary-400 hover:bg-primary-200 focus:outline-none focus-visible:ring focus-visible:ring-primary-300 focus-visible:ring-opacity-75 transition-full duration-300">
                     <span class="font-semibold">QU'EST CE QUE LE DROPSHIPPING ?</span>
                     <ChevronDownIcon
                        :class="open ? 'rotate-180 transform' : ''"
                        class="h-5 w-5 text-primary-300"
                     />
                  </DisclosureButton>
                  <transition
                  :enter-active-class="transitionClasses.enter" :enter-from-class="transitionClasses.enterFrom"
                  :enter-to-class="transitionClasses.enterTo" :leave-active-class="transitionClasses.leave"
                  :leave-from-class="transitionClasses.leaveFrom" :leave-to-class="transitionClasses.leaveTo">
                     <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500 bg-primary-200 rounded-b-lg">
                       <p class="py-1">Le dropshipping est un modèle commercial qui permet à une entreprise de vendre des produits sans avoir
                        besoin de les stocker ou de les expédier elle-même.</p>
                        <p class="py-1">À la place, l'entreprise travaille avec un fournisseur tiers qui stocke les produits et s'occupe de l'expédition
                        directement au client final, au nom de l'entreprise.</p>
                        <p class="py-1">Le processus de dropshipping fonctionne de la manière suivante : l'entreprise crée une boutique en ligne et
                        ajoute les produits du fournisseur tiers à son catalogue en ligne, à un prix qu'elle fixe elle-même.</p>
                        <p class="py-1">Lorsqu'un client commande un produit sur le site de l'entreprise, cette dernière transmet la commande et les
                        informations de livraison au fournisseur, qui s'occupe de l'expédition du produit directement au client final.</p>
                        <p class="py-1">Le principal avantage du dropshipping est qu'il permet à une entreprise de se lancer rapidement avec peu de
                        capitaux initiaux, car elle n'a pas besoin d'acheter et de stocker des produits en avance.</p>
                        <p class="py-1">Cela peut également être avantageux en termes de logistique et de temps, car l'entreprise n'a pas à gérer elle même l'expédition des produits, ce qui lui permet de se concentrer sur la croissance de son activité.</p>
                        <img :src="schema" alt="Schéma BtoB" class="w-full h-full object-contain px-32 py-4" />
                     </DisclosurePanel>
                  </transition>
               </Disclosure>
            </div>

            <div class="mx-auto w-full rounded-2xl bg-white p-2">
               <Disclosure v-slot="{ open }" >
                  <DisclosureButton :class="open ? 'bg-primary-200 rounded-tr-lg' : 'bg-primary-100 rounded-r-lg'" class="flex w-full justify-between px-4 py-2 text-left text-sm font-medium text-primary-400 hover:bg-primary-200 focus:outline-none focus-visible:ring focus-visible:ring-primary-300 focus-visible:ring-opacity-75 transition-full duration-300">
                     <span class="font-semibold">COMMENT PASSER UNE COMMANDE EN DROPSHIPPING ?</span>
                     <ChevronDownIcon
                        :class="open ? 'rotate-180 transform' : ''"
                        class="h-5 w-5 text-primary-300"
                     />
                  </DisclosureButton>
                  <transition
                  :enter-active-class="transitionClasses.enter" :enter-from-class="transitionClasses.enterFrom"
                  :enter-to-class="transitionClasses.enterTo" :leave-active-class="transitionClasses.leave"
                  :leave-from-class="transitionClasses.leaveFrom" :leave-to-class="transitionClasses.leaveTo">
                     <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500 bg-primary-200 rounded-b-lg">
                        <span class="pb-1 block font-semibold">MÉTHODE 1</span>
                       <p class="py-1">Etape 1 : Cliquez sur le bouton "Ajouter Commande client" dans le menu principal et saisissez la référence de
                        la commande du client.</p>
                        <p class="py-1">Etape 1 : Cliquez sur le bouton "Ajouter Commande client" dans le menu principal et saisissez la référence de
                        la commande du client.</p>
                        <p class="py-1">Etape 3 : Répétez les étapes 1 et 2 pour chaque commande client que vous devez créer.</p>
                        
                        <span class="pt-4 pb-2 block font-semibold">MÉTHODE 2</span>
                        <p class="py-1">Étape 1 - Dans l'interface de gestion des commandes, importer le fichier Excel contenant les commandes
                        clients en cliquant sur "Importer".</p>
                        <p class="py-1">Étape 2 - Vérifier que toutes les informations importées sont correctes et valides, puis confirmer
                        l'importation.</p>
                        <p class="py-1">Étape 3 - Accéder à l'étape 2 du panier et saisir l'adresse de 
                           livraison de chaque commande client.</p>
                        <p class="py-1">Étape 4 - Sélectionner le mode de paiement approprié pour chaque commande 
                           client et valider la commande.</p>
                        <p class="py-1">Il est important de vérifier avec soin les informations importées
                            pour éviter tout problème de livraison ou de paiement.</p>
                     </DisclosurePanel>
                  </transition>
               </Disclosure>
            </div>

            <div class="mx-auto w-full rounded-2xl bg-white p-2">
               <Disclosure v-slot="{ open }" >
                  <DisclosureButton :class="open ? 'bg-primary-200 rounded-tr-lg' : 'bg-primary-100 rounded-r-lg'" class="flex w-full justify-between px-4 py-2 text-left text-sm font-medium text-primary-400 hover:bg-primary-200 focus:outline-none focus-visible:ring focus-visible:ring-primary-300 focus-visible:ring-opacity-75 transition-full duration-300">
                     <span class="font-semibold">LES AVANTAGE DU DROPSHIPPING AVEC NAZAR RUGS</span>
                     <ChevronDownIcon
                        :class="open ? 'rotate-180 transform' : ''"
                        class="h-5 w-5 text-primary-300"
                     />
                  </DisclosureButton>
                  <transition
                  :enter-active-class="transitionClasses.enter" :enter-from-class="transitionClasses.enterFrom"
                  :enter-to-class="transitionClasses.enterTo" :leave-active-class="transitionClasses.leave"
                  :leave-from-class="transitionClasses.leaveFrom" :leave-to-class="transitionClasses.leaveTo">
                     <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500 bg-primary-200 rounded-b-lg">
                       <p class="py-1">Afin de permettre à nos partenaires de commercialiser nos produits avec succès, Nazar Rugs met à
                           disposition toutes les données pertinentes sous forme numérique.</p>
                        <p class="py-1">Ces données ont été préparées par notre équipe d'informaticiens dans différentes langues, facilitant
                           l'intégration des produits dans la boutique et le système existant du partenaire.</p>
                           <p class="py-1">La disponibilité des marchandises est automatiquement transmise plusieurs fois par jour. Les partenaires
                           peuvent consulter les bons de commande, les commandes et les informations de suivi de colis via l'onglet «
                           suivi ».</p>
                           <p class="py-1">Nous nous occupons de la préparation et de l'expédition directe des produits aux clients finaux à partir de
                           notre entrepôt, en utilisant les informations pertinentes fournies par le partenaire, soit manuellement, soit
                           par importation via un fichier Excel.</p>
                           <p class="py-1">Le client final reçoit sa livraison au nom du partenaire, sans que ce dernier n'ait jamais à entrer
                           physiquement en contact avec la marchandise.</p>
                           Une équipe de service professionnelle et expérimentée dans le secteur est à la disposition des partenaires
                           pour répondre à leurs questions ainsi qu'à celles de leurs clients finaux.
                           <p class="py-1">En cas de retour, nous nous occupons également du traitement, réduisant ainsi l'effort du partenaire au
                           minimum.</p>
                           <p class="py-1">Notre taux de livraison supérieur à 98% pour environ 3 000 références, ainsi qu'un nombre très faible de
                           retours témoignent de notre professionnalisme et de notre succès.</p>
                           <p class="py-1">Les entreprises qui négligent le potentiel du commerce électronique manquent l'opportunité d'augmenter
                           leurs ventes, de gagner de nouveaux clients et de s'établir durablement sur le marché.</p>
                     </DisclosurePanel>
                  </transition>
               </Disclosure>
            </div>

            <div class="mx-auto w-full rounded-2xl bg-white p-2">
               <Disclosure v-slot="{ open }" >
                  <DisclosureButton :class="open ? 'bg-primary-200 rounded-tr-lg' : 'bg-primary-100 rounded-r-lg'" class="flex w-full justify-between px-4 py-2 text-left text-sm font-medium text-primary-400 hover:bg-primary-200 focus:outline-none focus-visible:ring focus-visible:ring-primary-300 focus-visible:ring-opacity-75 transition-full duration-300">
                     <span class="font-semibold">LIVRAISON DIRECTE CHEZ LE CLIENT AVEC UNE SOLUTION DE DROPSHIPPING </span>
                     <ChevronDownIcon
                        :class="open ? 'rotate-180 transform' : ''"
                        class="h-5 w-5 text-primary-300"
                     />
                  </DisclosureButton>
                  <transition
                  :enter-active-class="transitionClasses.enter" :enter-from-class="transitionClasses.enterFrom"
                  :enter-to-class="transitionClasses.enterTo" :leave-active-class="transitionClasses.leave"
                  :leave-from-class="transitionClasses.leaveFrom" :leave-to-class="transitionClasses.leaveTo">
                     <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500 bg-primary-200 rounded-b-lg">
                       <p class="py-1">Le modèle de Nazar Rugs DropShipping offre aux e-commerçants et partenaires la possibilité de proposer une
                        large gamme de produits, soit environ 3 000 références, sans avoir à les préfinancer et avec une disponibilité
                        immédiate.</p>
                        <p class="py-1">Le modèle DropShipping peut être adapté à chaque marchand e-commerce, ce qui permet d'investir le capital
                        ailleurs, notamment dans le marketing et la croissance.</p>
                        <p class="py-1">En étroite collaboration entre le partenaire et Nazar Rugs, le partenaire vend les marchandises à ses clients
                        finaux et Nazar Rugs les envoie directement de son entrepôt au client final.</p>
                        <p class="py-1">Le groupe Nazar, qui est l'un des leaders du marché du tapis en France depuis plus de 12 ans, a créé la filiale
                        Nazar Rugs DropShipping pour relier les domaines d'activité du commerce de gros, du commerce fixe et du
                        commerce en ligne de manière efficace et lucrative.</p>
                        <p class="py-1">Le savoir-faire en matière de processus et les 3 000 références de produits innovants des marques du groupe
                        Nazar (Nazar Rugs et Bruges Intériors) constituent la base optimale du concept Nazar Rugs DropShipping.</p>
                        <p class="py-1">Au cours d'une phase de développement et d'optimisation de 18 mois, les systèmes techniques nécessaires à
                        l'échange électronique automatisé de données ont été développés par les spécialistes informatiques de Nazar.</p>
                        <p class="py-1">Les experts en marketing, chefs de produits et designers ont créé toutes les données spécifiques aux produits, des
                        photos professionnelles détaillées et des descriptions textuelles émotionnelles, qui sont absolument nécessaires
                        pour répondre pleinement aux attentes élevées des clients finaux lors de la réception de leur commande.</p>
                        <p class="py-1">Depuis le début de l'activité opérationnelle, les demandes de connexion de nouveaux partenaires ne cessent
                        d'augmenter.</p>
                        <p class="py-1">Les partenaires de Nazar Rugs comprennent des clients existants du groupe Nazar du commerce spécialisé en
                        ameublement, des chaînes de quincailleries bien connues, des sociétés de vente par correspondance, des
                        discounters, des détaillants, etc.</p>
                        <p class="py-1">En se concentrant sur leurs propres compétences de base, une situation gagnant-gagnant est créée pour les deux
                        partenaires, ce qui augmente les ventes, les retours et l'efficacité.</p>
                     </DisclosurePanel>
                  </transition>
               </Disclosure>
            </div>
         </div>
         <div class="px-6"> 
            <p class="py-1">Vous ne trouvez pas la réponse à votre question ?</p>
            <p class="py-1">N'hésitez pas à nous envoyer un mail à : <a class="underline" href="mailto:commande@nazarrugs.fr">commande@nazarrugs.fr</a></p>
            <p class="py-1">Notre équipe se fera une joie de vous répondre dans un délais de 48h maximum (jours ouvrés).</p>
         </div>
         
    </section>
</template>
   