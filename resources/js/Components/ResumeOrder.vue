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
   <div class="bg-white border border-primary-100 rounded border-2 border-primary-200 py-2">
      <h2 class="font-bold text-sm lg:text-xl sm:text-lg text-gray-800 text-center py-2">Récapitulatif de
         la commande</h2>

      <div class="flex flex-col px-5 py-2">
         <span class="py-2 text-sm"><span class="font-semibold text-lg">Quantiter Total :</span> {{ (props.panier != undefined ?
               (props.panier.produits_total != undefined ? props.panier.produits_total : '0') : '0')
         }} pcs</span>
         <span class="py-2 text-sm"><span class="font-semibold text-lg">M² Total : </span> {{ (props.panier != undefined ? (props.panier.total_m2 != undefined ? props.panier.total_m2 : '0') : '0') }}
            m²</span>
         <span class="py-2 text-sm"><span class="font-semibold text-lg">Total HT :</span> {{ (props.panier != undefined ? (props.panier.total_HT != undefined ? props.panier.total_HT : '0') : '0') }}
            €</span>
         <span class="py-2 text-sm"><span class="font-semibold text-lg">Total TVA : </span>{{ (props.panier != undefined ? (props.panier.total_taxe != undefined ? props.panier.total_taxe : '0') : '0') }}
            €</span>
         <span class="py-2 text-sm"><span class="font-semibold text-lg">Total TTC :</span> {{ (props.panier != undefined ? (props.panier.total_ttc != undefined ? props.panier.total_ttc : '0') : '0') }}
            €</span>
      </div>
      <div class="flex items-center justify-center">
         <div v-if="props.titreLink != '' && props.titreLink != undefined">
            <div class="flex items-center justify-center my-3" v-if="props.linkEtapeSuivant != undefined && !props.disabled && props.panier != undefined && !isButtonSubmit && props.panier.produits_total > 0">
               <Link v-if="props.panier.total_ttc != undefined" :href="props.linkEtapeSuivant" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">{{ props.titreLink }} <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></Link>
            </div>
            <div class="flex items-center justify-center my-3" v-else-if="props.panier != undefined && isButtonSubmit && !props.disabled">
               <button v-if="props.panier.total_ttc != undefined" type="submit" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">{{ props.titreLink }} <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></button>
            </div>
            <div class="flex items-center justify-center my-3" v-else>
               <button type="button" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300" disabled>{{ props.titreLink }} <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></button>
            </div>
         </div>
         <div v-else>
            
            <div class="flex items-center justify-center my-3" >
               <button type="button" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300" disabled>{{ props.titreLink }} <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></button>
            </div>
         </div>
      </div>
      
   </div>
</template>