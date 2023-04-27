<script setup>
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import EtapeOrder from '@/Components/EtapeOrder.vue';
import ResumeOrder from '@/Components/ResumeOrderVertical.vue';
import CartEntrepot from '@/Components/CartEntrepot.vue';
import CartDropshipping from '@/Components/CartDropshipping.vue';
import { ref, watchEffect } from 'vue';


const props = defineProps(['panier', 'produits','message_error']);

var produits = ref(usePage().props.value.Panier.panier.panier);
var panierDrop = ref(usePage().props.value.PanierDrop);
var typeVente = ref(usePage().props.value.session.typeVente);


var listeEtape = ['Panier', 'Adresse Livraison / Facturation', 'Finaliser commande'];
var hrefEtape = ['/cart', '/cart/adresses', '/cart/validation'];
var hrefEtapeDrop = ['/dropshipping/cart', '/dropshipping/cart/adresses', '/dropshipping/cart/validation'];



watchEffect(() => {
	produits.value = usePage().props.value.Panier.panier.panier;
   panierDrop.value = usePage().props.value.PanierDrop;
   typeVente.value = usePage().props.value.session.typeVente;
});
</script>
<script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ArrowLeftIcon,ExclamationCircleIcon, ExclamationTriangleIcon } from '@heroicons/vue/20/solid';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),

   // Using the shorthand
   layout: AuthenticatedLayout,
}
</script>


<template>

   <Head :title="'Panier - '+(typeVente == 1 ? 'Commande Entrepôt' : 'Dropshipping')" />

   <section class="container mx-auto mt-5">
      <div class="grid grid-cols-4">
         <div class="col-span-4">
            <EtapeOrder :hrefEtape="(typeVente == 1 ? hrefEtape : hrefEtapeDrop)" :etape="1" :nbEtape="3" :listeEtape="listeEtape" />
         </div>
         <div class="col-span-4 grid grid-cols-4 xl:mx-16 ">
            <div class="col-span-4 flex flex-col items-start mt-2 lg:mx-0 sm:mx-2 mx-4 ">
               <div v-if="usePage().props.value.session.messageError != undefined" class="w-full bg-red-200 px-4 py-2 rounded flex items-center">
                  <ExclamationTriangleIcon class="h-8 w-8 text-red-600" />
                  <span class="pl-2 text-red-600">{{usePage().props.value.session.messageError}}</span>
               </div>
               <div v-if="props.message_error != ''" class="w-full bg-red-200 px-4 py-2 rounded flex items-center">
                  <ExclamationTriangleIcon class="h-8 w-8 text-red-600" />
                  <span class="pl-2 text-red-600">{{props.message_error}}</span>
               </div>
               <div v-if="(!panierDrop.panier.panier_valid && typeVente == 2) " class="w-full bg-yellow-200 px-4 py-2 my-2 rounded flex items-center">
                  <ExclamationCircleIcon class="h-8 w-8 text-yellow-600" />
                  <span class="pl-2 text-yellow-600">Pour continuer, veuillez ajouter au minimum un produit pour chaque commande.</span>
               </div> 
               <div class="relative w-full">
                  <h1 class=" w-full font-semibold text-lg lg:text-2xl sm:text-xl text-gray-800 text-center py-2">Panier - {{ (typeVente == 1 ? 'Commande Entrepôt' : 'Dropshipping') }}</h1>
               </div>   
                  <CartEntrepot v-if="typeVente == 1" :produits="produits" :panier="props.panier" />
                  <CartDropshipping v-if="typeVente == 2" :panier="panierDrop.panier" />
            </div>
            <div class="col-span-4 grid grid-cols-8 ml-5">
               <div class="lg:col-span-3 sm:col-span-4 col-span-8">
                  <a :href="(typeVente == 1 ? '/order_entrepot/gamme' : '/dropshipping/gamme')" class="relative inline-block group">
                     <ArrowLeftIcon class="h-4 w-4 absolute left-0 bottom-1/4 top-1/4 text-black group-hover:text-primary-300 transition duration-300" /> 
                     <span class="inline-block border-b border-black pl-5 group-hover:text-primary-300 group-hover:border-primary-300 transition duration-300">Poursuivre mes achats</span>
                  </a>
               </div>
               <div class="lg:col-span-5 sm:col-span-4 col-span-8">
                  <ResumeOrder :disabled="(typeVente == 2 && panierDrop.panier != undefined ? !panierDrop.panier.panier_valid : false)" :linkEtapeSuivant="(typeVente == 1 ? '/cart/adresses' : '/dropshipping/cart/adresses')" :titreLink="'Valider la commande'" :panier="(typeVente == 1 ? props.panier : (panierDrop.panier.panierActuel != undefined ? panierDrop.panier.panierActuel : undefined))" :isButtonSubmit="false" />
               </div>
            </div>
         </div>
         
      </div>
   </section>
</template>