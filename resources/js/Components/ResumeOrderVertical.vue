<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';
const props = defineProps(['panier', 'linkEtapeSuivant', 'titreLink','isButtonSubmit','disabled']);


</script>
<script>
import Alert from 'icons/Alert.vue';
import {ArrowRightCircleIcon} from '@heroicons/vue/24/outline';
</script>
<template>
<div class="bg-white border border-primary-100 rounded border-2 border-primary-200 py-2 my-2">
      <h2 class="font-bold text-sm lg:text-xl sm:text-lg text-gray-800 text-center py-2">Récapitulatif de la commande</h2>

      <div class="grid grid-cols-12 px-3 py-2 justify-center items-center">
         <span class="2xl:col-span-3 lg:col-span-6 col-span-12 text-sm text-center"><span class="font-semibold text-lg">Quantité Total :</span> 
         {{ (props.panier != undefined ? (props.panier.produits_total != undefined ? props.panier.produits_total : '0') : '0')}} pcs</span>
         <span class="2xl:col-span-3 lg:col-span-6 col-span-12 text-sm text-center"><span class="font-semibold text-lg">M² Total : </span> {{ (props.panier != undefined ? (props.panier.total_m2 != undefined ? props.panier.total_m2 : '0') : '0') }}
            m²</span>
         <span class="2xl:col-span-3 lg:col-span-6 col-span-12 text-sm text-center"><span class="font-semibold text-lg">Montant HT :</span> {{ (props.panier != undefined ? (props.panier.montant_ht != undefined ? props.panier.montant_ht : '0') : '0') }}
            €</span>
         <span class="2xl:col-span-3 lg:col-span-6 col-span-12 text-sm text-center"><span class="font-semibold text-lg">* Transport HT :</span> {{ (props.panier != undefined ? (props.panier.prix_transport != undefined ? props.panier.prix_transport : '0') : '0') }}
            €</span>
         <span class="2xl:col-span-4 lg:col-span-6 col-span-12 text-sm text-center"><span class="font-semibold text-lg">Total HT :</span> {{ (props.panier != undefined ? (props.panier.total_HT != undefined ? props.panier.total_HT : '0') : '0') }}
            €</span>
         <span class="2xl:col-span-4 lg:col-span-6 col-span-12 text-sm text-center"><span class="font-semibold text-lg">Total TVA : </span>{{ (props.panier != undefined ? (props.panier.total_taxe != undefined ? props.panier.total_taxe : '0') : '0') }}
            €</span>
         <span class="2xl:col-span-4 lg:col-span-6 col-span-12 text-sm text-center"><span class="font-semibold text-lg">Total TTC :</span> {{ (props.panier != undefined ? (props.panier.total_ttc != undefined ? props.panier.total_ttc : '0') : '0') }}
            €</span>
      </div>
      <div class="flex items-center justify-center">
         <div v-if="props.titreLink != '' && props.titreLink != undefined">
            <div class="flex items-center justify-center my-3" v-if="props.linkEtapeSuivant != undefined && !props.disabled && props.panier != undefined && !isButtonSubmit && props.panier.produits_total > 0">
               <Link v-if="props.panier.total_ttc != undefined" :href="props.linkEtapeSuivant" class="btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">{{ props.titreLink }} <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></Link>
            </div>
            <div class="flex items-center justify-center my-3" v-else-if="props.panier != undefined && isButtonSubmit && !props.disabled">
               <button v-if="props.panier.total_ttc != undefined" type="submit" class="btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">{{ props.titreLink }} <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></button>
            </div>
            <div class="flex items-center justify-center my-3" v-else>
               <button type="button" class="btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300" disabled>{{ props.titreLink }} <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></button>
            </div>
         </div>
         <div v-else>
            
            <div class="flex items-center justify-center my-3" >
               <button type="button" class="btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300" disabled>{{ props.titreLink }} <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></button>
            </div>
         </div>
      </div>
      
   </div>
</template>