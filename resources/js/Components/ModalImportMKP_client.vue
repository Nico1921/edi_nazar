<script setup>
import { ref } from 'vue';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';

const props = defineProps(['isOpen','client']);

const isOpen = ref(props.isOpen);

function closeModal() {
  isOpen.value = false
  setTimeout(() => {
    document.getElementById("productClientView").__vue_app__.unmount();
  },200)
}

console.log(props.client);

var gridModal = {
 grid4: 'grid-cols-4',
 grid3: 'grid-cols-3',
 grid2: 'grid-cols-2',
 grid1: 'grid-cols-1',
};

var gridChoice = () => {
  if(props.client.products.length == 4){
    return gridModal.grid4;
  }else if(props.client.products.length == 3){
    return gridModal.grid3;
  }else if(props.client.products.length == 2){
    return gridModal.grid2;
  }else if(props.client.products.length == 1){
    return gridModal.grid1;
  }else{
    return gridModal.grid4;
  }
};
var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};
</script>
<script>
import Close from 'icons/Close.vue';
</script>

<template>
<TransitionRoot appear :show="isOpen" as="template">
   <Dialog as="div" @close="closeModal" class="relative z-10">
     <TransitionChild
       as="template"
       enter="duration-300 ease-out"
       enter-from="opacity-0"
       enter-to="opacity-100"
       leave="duration-200 ease-in"
       leave-from="opacity-100"
       leave-to="opacity-0">
       <div class="fixed inset-0 bg-black bg-opacity-25"></div>
     </TransitionChild>

     <div class="fixed inset-0 overflow-y-auto">
       <div class="flex min-h-full items-center justify-center p-4 text-center relative">
         <TransitionChild
           as="template"
           enter="duration-300 ease-out"
           enter-from="opacity-0 scale-95"
           enter-to="opacity-100 scale-100"
           leave="duration-200 ease-in"
           leave-from="opacity-100 scale-100"
           leave-to="opacity-0 scale-95" >
           <DialogPanel class="w-full max-w-6xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
             <DialogTitle as="h3" class="sm:text-xl text-lg font-bold leading-6 text-gray-900">
               Détail client : {{props.client.nom+" "+props.client.prenom}}
             </DialogTitle>
             <div>
              <button @click="closeModal" type="button" class="absolute top-5 right-10"><Close /></button>
             </div>
             <div class="grid grid-cols-10 ml-5 bg-primary-50 rounded-lg p-4 mb-4">
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center ">Quantiter : {{props.client.products_tt}}</span>
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">M² : {{props.client.m2_tt}} m²</span>
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Prix HT : {{ roundNumber(props.client.prix_ht_tt)}} €</span>
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Prix TVA : {{ roundNumber(props.client.prix_tva_tt) }} €</span>
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Prix TTC : {{ roundNumber(props.client.prix_ttc_tt) }} €</span>
             </div>
            <div :class="'overflow-auto lg:max-h-[50vh] max-h-[45vh] grid ' + (props.client.products.length > 4 ? gridModal.grid4 : gridChoice())"  v-if="props.client.products.length != 0">
              <div class="relative flex justify-center lg:col-span-1 col-span-4 h-80 w-full py-4 px-4 " v-for="(produit, key) in props.client.products" :key="key">
                <div class="groupProduit relative w-full flex items-center justify-center">
                  <div class="z-10 absolute xl:bottom-28 bottom-28  imageProduit">
                    <div v-if="produit.url_image != null" class="lg:w-[100px] lg:h-[150px] sm:w-[100px] sm:h-[150px] w-[80px] h-[120px]">
                        <img :src="'https://gestion.tapis-nazar.fr/img/produit/'+produit.url_image" :alt="produit.sku" class="w-full h-full object-cover" />
                     </div>
                     <div v-else class="lg:w-[100px] lg:h-[150px] sm:w-[100px] sm:h-[100px] w-[80px] h-[100px]">
                        <span>Pas de photo pour ce produit !</span>
                     </div>
                  </div>
                  <div class="z-20 sm:w-80 w-72 absolute bottom-0 text-center bg-white rounded drop-shadow-xl flex flex-col py-2">
                    <div class="flex flex-col px-10">
                      <span>{{produit.gamme}}</span>
                      <span>{{produit.design}}</span>
                      <span>{{produit.taille}}</span>
                    </div>
                    
                    <div class="flex justify-center items-center py-2 w-full">
                      <span v-if="produit.stock <= produit.qte" class="flex items-center justify-center mr-2">Erreur Stock<span class="bg-red-700 w-[10px] h-[10px] block rounded-full mx-2"></span> | </span>
                      <div class="flex flex-col">
                        <span>Quantiter : {{produit.qte}}</span>
                        <span>Prix Unitaire : {{ roundNumber(produit.prix_TTC_unitaire) }} €</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-center" v-else>
              <span>Il n'y a pas de produit pour ce client !</span>
            </div>
           </DialogPanel>
         </TransitionChild>
       </div>
     </div>
   </Dialog>
 </TransitionRoot>
</template>

<style>
.groupProduit .imageProduit {
  transition-duration: 400ms;
  transition-property: bottom;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

.groupProduit:hover .imageProduit {
  bottom: 9rem;
}
</style>