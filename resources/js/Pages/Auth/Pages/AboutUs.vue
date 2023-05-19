<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { HomeIcon,LightBulbIcon,ChevronDownIcon  } from '@heroicons/vue/24/solid';
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
  } from '@headlessui/vue';
const bandeau = new URL('../../../../images/AboutUs/bandeau_a_propos.webp', import.meta.url).href;
var links = [{
        title: 'Accueil',
        link: '/',
        icon: HomeIcon,
        active: false
    },{
      title: 'A propos',
      link: '/about-us',
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

const timelineNazar = [{
    position: 1,
    date: '1',
    title: 'Historique de l\'entrerpise NAZAR RUGS',
    text_visible: 'Nazar Rugs est une société française spécialisée dans la production et la vente d\'articles de décoration, qui trouve ses origines en Turquie.',
    text_disclosure: 'Notre objectif premier consiste à offrir à nos clients BtoB et BtoC un service de qualité supérieure en veillant à ce'+
        ' que leurs besoins soient continuellement comblés.',
},{
    position: 2,
    date: '2011',
    title: 'Création de l\'entreprise',
    text_visible: 'Mikail Ari, entrepreneur émergent, s\'engage à promouvoir la culture du tapis du Moyen-Orient sur le marché occidental, en réponse à une demande croissante dans ce segment.',
    text_disclosure: 'Son objectif premier est de faire découvrir et apprécier la richesse culturelle du Moyen-Orient sur le marché français.',
},
{
    position: 1,
    date: '2017',
    title: 'LANCEMENT DES PREMIÈRES COLLECTIONS NAZAR RUGS',
    text_visible: 'La transition de la distribution de marques de tapis allemandes à la création de nos propres collections s\'est révélée être un moment clé dans notre parcours.',
    text_disclosure: 'Cela nous a permis d\'acquérir une expertise sur le marché français et de nous positionner parmi les principaux acteurs européens en matière de tendances en matière de tapis.'+
        '<br/> Les équipes de Nazar Rugs sont responsables de la supervision complète de la chaîne de production, depuis'+
        ' l\'élaboration des croquis jusqu\'à la mise en production dans nos usines partenaires situées en Turquie.'+
        '<br/> Nous avons établi une filiale en Turquie, dirigée par l\'associé de Monsieur Ari, qui supervise l\'ensemble de la'+
        ' production.'+
        '<br/> Cette filiale est composée de cinq personnes dédiées à la gestion de la production et à la garantie de la qualité des'+
        ' produits fabriqués.',
},
{
    position: 2,
    date: '2019',
    title: 'LANCEMENT DES PREMIÈRES COLLECTIONS NAZAR RUGS',
    text_visible: 'Initialement situés à Ingré et employant une dizaine de personnes, les locaux de Nazar Rugs sont rapidement devenus inadaptés à la forte croissance de l\'entreprise.',
    text_disclosure: 'Pour faire face à cette expansion, l\'équipe de Nazar Rugs a choisi de s\'installer'
       + ' dans de nouveaux locaux situés à Saint Denis en Val.'
       + '<br/> En raison de cette croissance, l\'effectif de l\'entreprise a également augmenté'
       + ' et se compose désormais de seize membres, répartis comme suit :'+
       '<ul class="list-disc pl-4"><li>10 personnes travaillant dans les bureaux</li><li>6 personnes affectées aux opérations logistiques.</li><ul/>',
},
{
    position: 1,
    date: '2020',
    title: 'CRISE DE LA COVID-19 ET OUVERTURE AU BTOC',
    text_visible: 'Bien que l\'ADN de Nazar soit centré sur le commerce BtoB, la pandémie de COVID-19 a également offert l\'opportunité de développer de nouvelles compétences dans le secteur BtoC.',
    text_disclosure: 'Cette période a poussé l\'entreprise à redéfinir sa stratégie en se lançant sur le marché BtoC.'+
        '<br/> Dans cette optique, nous avons créé un site internet dédié, en plus de proposer nos produits sur différentes Market'+
        ' places telles que Maison du Monde, But, et des canaux de distribution tels que Veepee',
},
{
    position: 2,
    date: 'AUJOURD\'HUI',
    title: '',
    text_visible: 'Notre objectif actuel est de renforcer notre position de leader et de pionnier en matière de tendances sur le marché français tout en développant notre présence internationale.',
    text_disclosure: 'Dans cette optique, nous envisageons de participer à différents salons internationaux tels que Maison et Objet pour'+
        ' accroître notre visibilité et renforcer notre notoriété à l\'échelle mondiale',
}];
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
    <Head title="A propos" />
    <section class="container mx-auto px-7 mt-5">
        <Breadcrumbs :links="links" />
        <h1 class="font-semibold text-sm lg:text-xl sm:text-lg text-gray-800 text-center py-5 uppercase">
            A propos
        </h1>
        <img :src="bandeau" alt="Bandeau A propos" class="w-full h-[28rem] object-cover my-4"/>
        <span class="font-bold block py-3 mt-5">Nous sommes une société française spécialisée dans la production et la vente d'articles de décoration, qui trouve ses origines en Turquie.</span>
        <span class="font-bold block py-2">Notre objectif premier consiste à offrir à nos clients BtoB et BtoC un service de qualité supérieure en veillant à ce que leurs besoins soient continuellement comblés.</span>
        <div class="py-6 flex flex-col justify-center sm:py-12">
            <div class="py-3  sm:mx-auto w-full px-2 sm:px-0">
                <div class="relative text-gray-700 antialiased text-sm font-semibold">
                    <div class="hidden sm:block w-1 bg-primary-300 absolute h-full left-1/2 transform -translate-x-1/2"></div>
                    <div v-for="(oneTimeline,key) in timelineNazar" :key="key" class="mt-6 sm:mt-0 sm:mb-12">
                        <div class="flex flex-col sm:flex-row items-center">
                            <div :class="(oneTimeline.position == 1 ? 'justify-start' : 'justify-end')" class="flex w-full mx-auto items-center">
                                <div :class="(oneTimeline.position == 1 ? 'sm:pr-8' : 'sm:pl-8')" class="w-full sm:w-1/2">
                                    <div class="p-4 bg-white rounded shadow">
                                        <h2 class="font-bold uppercase text-cl">{{ oneTimeline.date }} {{ oneTimeline.title != '' ? ':' : '' }} {{ oneTimeline.title }}</h2>
                                        <Disclosure v-slot="{ open }" >
                                            <DisclosureButton class="flex w-full justify-between  py-2 text-left text-sm font-medium text-primary-400 focus:outline-none focus-visible:ring focus-visible:ring-primary-300 focus-visible:ring-opacity-75 transition-full duration-300">
                                                <p class="font-semibold">{{ oneTimeline.text_visible }}</p>
                                                <ChevronDownIcon :class="open ? 'rotate-180 transform' : ''" class="h-5 w-5 text-primary-300" />
                                            </DisclosureButton>
                                            <transition
                                            :enter-active-class="transitionClasses.enter" :enter-from-class="transitionClasses.enterFrom"
                                            :enter-to-class="transitionClasses.enterTo" :leave-active-class="transitionClasses.leave"
                                            :leave-from-class="transitionClasses.leaveFrom" :leave-to-class="transitionClasses.leaveTo">
                                                <DisclosurePanel class=" pt-4 pb-2 text-sm text-primary-400 rounded-b-lg font-medium">
                                                    <p class="font-semibold" v-html="oneTimeline.text_disclosure"></p>
                                                </DisclosurePanel>
                                            </transition>
                                        </Disclosure>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-full bg-primary-300 border-white border-4 w-8 h-8 absolute left-1/2 -translate-y-4 sm:translate-y-0 transform -translate-x-1/2 flex items-center justify-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
   