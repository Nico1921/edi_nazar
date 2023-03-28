<script setup>
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import EtapeOrder from '@/Components/EtapeOrder.vue';
import ResumeOrder from '@/Components/ResumeOrder.vue';
import ResumeOrderVertical from '@/Components/ResumeOrderVertical.vue';
import CartEntrepot from '@/Components/CartEntrepot.vue';
import CartDropshipping from '@/Components/CartDropshipping.vue';
import { ref, watchEffect } from 'vue';

const props = defineProps(['panier', 'produits']);

var produits = ref(usePage().props.value.Panier.panier.panier);
var panierDrop = ref(usePage().props.value.PanierDrop);
var typeVente = ref(usePage().props.value.session.typeVente);


var listeEtape = ['Panier', 'Adresse Livraison / Facturation', 'Finaliser commande'];
watchEffect(() => {
	produits.value = usePage().props.value.Panier.panier.panier;
   panierDrop.value = usePage().props.value.PanierDrop;
   typeVente.value = usePage().props.value.session.typeVente;
});
</script>
<script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ExclamationCircleIcon, ExclamationTriangleIcon } from '@heroicons/vue/20/solid';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),

   // Using the shorthand
   layout: AuthenticatedLayout,
}
</script>


<template>

   <Head title="Panier" />

   <section class="container mx-auto mt-5">
      <h1 class="font-semibold text-lg lg:text-2xl sm:text-xl text-gray-800 text-center py-2">Panier</h1>

      <div class="grid grid-cols-4">
         <div class="xl:col-span-1 col-span-4">
            <EtapeOrder :etape="1" :nbEtape="3" :listeEtape="listeEtape" />
         </div>
         <div class="xl:col-span-2 lg:col-span-3 col-span-4 flex flex-col items-start mt-2">
            <div v-if="usePage().props.value.session.messageError != undefined" class="w-full bg-red-200 px-4 py-2 rounded flex items-center">
               <ExclamationTriangleIcon class="h-8 w-8 text-red-600" />
               <span class="pl-2 text-red-600">{{usePage().props.value.session.messageError}}</span>
            </div>
            {{  }}
            <div v-if="panierDrop.panier.panierActuel != undefined " class="w-full bg-red-200 px-4 py-2 rounded flex items-center">
               <ExclamationTriangleIcon class="h-8 w-8 text-red-600" />
               <span class="pl-2 text-red-600">{{usePage().props.value.session.messageError}}</span>
            </div>  
            <div v-if="(!panierDrop.panier.panier_valid && typeVente == 2) " class="w-full bg-yellow-200 px-4 py-2 rounded flex items-center">
               <ExclamationCircleIcon class="h-8 w-8 text-yellow-600" />
               <span class="pl-2 text-yellow-600">Pour continuer, veuillez ajouter au minimum un produit pour chaque commande.</span>
            </div>  
            <CartEntrepot v-if="typeVente == 1" :produits="produits" :panier="props.panier" />
            <CartDropshipping v-if="typeVente == 2" :panier="panierDrop" />
         </div>
         <div class="lg:hidden block col-span-4">
            <ResumeOrderVertical :disabled="(typeVente == 2 && panierDrop.panier != undefined ? !panierDrop.panier.panier_valid : false)" :linkEtapeSuivant="(typeVente == 1 ? '/cart/adresses' : '/dropshipping/cart/adresses')" :titreLink="'Valider la commande'" :panier="(typeVente == 1 ? props.panier : (panierDrop.panier.panierActuel != undefined ? panierDrop.panier.panierActuel : undefined))" :isButtonSubmit="false" />
         </div>
         <div class="lg:block hidden col-span-1 ml-5">
            <ResumeOrder :disabled="(typeVente == 2 && panierDrop.panier != undefined ? !panierDrop.panier.panier_valid : false)" :linkEtapeSuivant="(typeVente == 1 ? '/cart/adresses' : '/dropshipping/cart/adresses')" :titreLink="'Valider la commande'" :panier="(typeVente == 1 ? props.panier : (panierDrop.panier.panierActuel != undefined ? panierDrop.panier.panierActuel : undefined))" :isButtonSubmit="false" />
         </div>
      </div>
   </section>
</template>