<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';
const props = defineProps(['panier', 'linkEtapeSuivant', 'titreLink','isButtonSubmit','disabled']);


</script>
<script>
import Alert from 'icons/Alert.vue';
</script>
<template>
   <div class="bg-primary-50 rounded border-2 border-primary-200 py-5 grid grid-cols-2">
      <div class="col-span-2 text-center">
         <h2 class="font-bold text-sm lg:text-xl sm:text-lg text-gray-800 text-center py-2">Récapitulatif de
         la commande</h2>
      </div>
      

      <div class="col-span-2 grid grid-cols-12 px-5 py-2">
         <span class="py-2 text-sm lg:col-span-3 sm:col-span-6 col-span-12"><span class="font-semibold sm:text-lg text-sm">Quantiter Total :</span> {{ (props.panier != undefined ?
               props.panier.produits_total : '0')
         }} pcs</span>
         <span class="py-2 text-sm lg:col-span-3 sm:col-span-6 col-span-12"><span class="font-semibold sm:text-lg text-sm">M² Total : </span> {{ (props.panier != undefined ? props.panier.total_m2 : '0') }}
            m²</span>
         <span class="py-2 text-sm lg:col-span-2 sm:col-span-6 col-span-12"><span class="font-semibold sm:text-lg text-sm">Total HT :</span> {{ (props.panier != undefined ? props.panier.total_HT : '0') }}
            €</span>
         <span class="py-2 text-sm lg:col-span-2 sm:col-span-6 col-span-12"><span class="font-semibold sm:text-lg text-sm">Total TVA : </span>{{ (props.panier != undefined ? props.panier.total_taxe : '0') }}
            €</span>
         <span class="py-2 text-sm lg:col-span-2 col-span-12"><span class="font-semibold sm:text-lg text-sm">Total TTC :</span> {{ (props.panier != undefined ? props.panier.total_ttc : '0') }}
            €</span>
      </div>
      <div class="col-span-2 flex items-center justify-center">
         <div v-if="props.titreLink != '' && props.titreLink != undefined ">
            <div class="flex items-center justify-center my-3" v-if="props.linkEtapeSuivant != undefined && !props.disabled && props.panier != undefined && !isButtonSubmit">
            <Link :href="props.linkEtapeSuivant" class="p-2 border border-primary-300 rounded bg-primary-200 
                     hover:bg-primary-100 transition duration-300">{{ props.titreLink }}</Link>
            </div>
            <div class="flex items-center justify-center my-3" v-else-if="props.panier != undefined && !props.disabled && isButtonSubmit">
               <button type="submit" class="p-2 border border-primary-300 rounded bg-primary-200 
                           hover:bg-primary-100 transition duration-300 disabled:bg-primary-100
                            disabled:cursor-not-allowed">{{ props.titreLink }}</button>
            </div>
            <div class="flex items-center justify-center my-3" v-else>
               <button type="button" class="p-2 border border-primary-300 rounded bg-primary-200 
                           hover:bg-primary-100 transition duration-300 disabled:bg-primary-100
                            disabled:cursor-not-allowed" disabled>{{ props.titreLink }}</button>
            </div>
         </div>
         <div v-else>
            
            <div class="flex items-center justify-center my-3" >
               <button type="button" class="p-2 border border-primary-300 rounded bg-primary-200 
                           hover:bg-primary-100 transition duration-300 disabled:bg-primary-100
                            disabled:cursor-not-allowed" disabled>{{ props.titreLink }}</button>
            </div>
         </div>
      </div>
      
   </div>
</template>