<script setup>
import { ref } from 'vue';
var props = defineProps(['client','isMK']);
var client = props.client;
const transitionClasses = {
   enter: 'transform transition ease-in-out duration-500 sm:duration-700',
   enterFrom: '-translate-y-full',
   enterTo: 'translate-y-0',
   leave: 'transform transition ease-in-out duration-500 sm:duration-700',
   leaveFrom: '-translate-y-0',
   leaveTo: '-translate-y-full',
};

var isOpen = ref((props.isMK ? false : true));

var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};

const roundResult = (number, nbVirugule) => {
   return number.toFixed(nbVirugule);
};

const formatDate = (date) => {
   var dateType = new Date(date);
   return (dateType.getDate() < 10 ? '0' + dateType.getDate() : dateType.getDate()) + "/" + ((dateType.getMonth() + 1) < 10 ? '0' + (dateType.getMonth() + 1) : dateType.getMonth() + 1) + "/" + dateType.getFullYear();
};
</script>
<script>
import ImageOff from 'icons/ImageOff.vue';
import { PlusIcon,MinusIcon} from '@heroicons/vue/24/solid';
</script>
<template>
   <div class=" my-4 rounded-lg overflow-hidden">

   
   <div class="flex items-center bg-white py-2 px-5 overflow-hidden z-30 relative cursor-pointer" @click="isOpen = !isOpen">
      <PlusIcon v-if="!isOpen" class="w-5 h-5 mr-5"/>
      <MinusIcon v-if="isOpen" class="w-5 h-5 mr-5"/>
      <h3 class=" font-bold text-xl">Commande {{ (client.ref_externe != null ? client.ref_externe : client.num_commande)}}</h3>
   </div>
   <transition :enter-active-class="transitionClasses.enter" :enter-from-class="transitionClasses.enterFrom"
      :enter-to-class="transitionClasses.enterTo" :leave-active-class="transitionClasses.leave"
      :leave-from-class="transitionClasses.leaveFrom" :leave-to-class="transitionClasses.leaveTo">
      <div v-show="isOpen" class="bg-white py-2 px-5 grid grid-cols-12 z-20 relative">
         <!-- Content -->
         <div
            class="col-span-6 accordion-content px-5 pt-0 pb-1 overflow-hidden max-h-full border border-primary-300 rounded">
            <h4 class="font-bold text-center my-2">Produits de la commande</h4>
            <table class="min-w-full divide-y divide-primary-200">
               <thead>
                  <tr>
                     <th scope="col"
                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                     <th scope="col"
                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Référence
                     </th>
                     <th scope="col"
                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Taille
                     </th>
                     <th scope="col"
                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                     <th scope="col"
                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité
                     </th>
                     <th scope="col"
                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">M2 Total
                     </th>
                  </tr>
               </thead>
               <tbody class="bg-white divide-y divide-primary-200">
                  <tr v-for="(design, key) in client.produits.panier" :key="key">
                     <td class="px-4 py-4 whitespace-nowrap text-center">
                        <div :class="props.classGridImage" class="flex items-stretch justify-center w-full">
                           <div v-if="design.photo != null" class="w-full h-20">
                              <img :src="'https://gestion.tapis-nazar.fr/img/produit/' + design.photo.img_produit"
                                 :alt="design.code_sku" class="w-full h-full  object-contain" />
                           </div>
                           <div v-else class="text-3xl w-full flex items-stretch justify-center bg-gray-300">
                              <ImageOff />
                           </div>
                        </div>
                     </td>
                     <td class="px-4 py-4 whitespace-nowrap text-center">{{ design.code_sku }}</td>
                     <td class="px-4 py-4 whitespace-nowrap text-center">{{ design.dimension.largeur }}x{{
                        design.dimension.longueur }}cm</td>
                     <td class="px-4 py-4 whitespace-nowrap text-center">{{ roundNumber(design.panier.prix_ht_total) }} €
                        HT</td>
                     <td class="px-4 py-4 whitespace-nowrap text-center">{{ design.panier.quantiter }}</td>
                     <td class="px-4 py-4 whitespace-nowrap text-center">{{ roundResult((design.dimension.largeur / 100) *
                        (design.dimension.longueur / 100) * design.panier.quantiter, 2) }}</td>
                  </tr>
               </tbody>
            </table>
         </div>
         <!-- header -->
         <div class="col-span-6 accordion-header transition  px-2 transition relative transition duration-300">
            <div class="relative grid grid-cols-12 mx-auto">
               <div class="col-span-6 border border-primary-300 rounded px-4 py-2 mx-4 space-y-1">
                  <h4 class="text-lg font-bold mb-2 text-center">Commande</h4>
                  <p class="text-gray-600"><span class="font-semibold">N° Nazar : </span>{{ client.num_commande }}</p>
                  <p class="text-gray-600" v-if="client.ref_externe != null"><span class="font-semibold">N° Client :
                     </span>{{ client.ref_externe }}</p>
                  <p class="text-gray-600"><span class="font-semibold">Client : </span>{{ client.prenom + " " + client.nom
                  }}</p>
                  <p class="text-gray-600"><span class="font-semibold">Date commande : </span>{{
                     formatDate(client.date_commande) }}</p>
                  <p class="text-gray-600"><span class="font-semibold">Nombre de produit : </span>{{ client.quantiter }}
                  </p>
                  <p class="text-gray-600"><span class="font-semibold">Total_ttc : </span>{{ client.total_ttc }} €</p>
               </div>
               <div class="col-span-6 border border-primary-300 rounded px-4 py-2 mx-4 space-y-1">
                  <h4 class="text-lg font-bold mb-2 text-center">Adresse commande</h4>
                  <p class="text-gray-600"><span class="font-semibold">Contact : </span>{{ client.nom_adresse }}</p>
               <p class="text-gray-600">
                  {{ client.adresse1 }},
                  {{ (client.adresse2 != '' && client.adresse2 != null ? client.adresse2 + "," : '') }}
                  {{ (client.adresse3 != '' && client.adresse3 != null ? client.adresse3 + "," : '') }}
               </p>
               <p class="text-gray-600">
                  {{ client.code_postal }} {{ client.ville }},
                  {{ client.pays }}
               </p>
            </div>
         </div>
      </div>
   </div>
</transition>
</div>
</template>