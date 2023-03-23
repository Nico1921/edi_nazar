<script setup>
import { ref,createApp } from 'vue';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';
import ModalImportMKP_client from '@/Components/ModalImportMKP_client.vue';
import axios from 'axios';


const props = defineProps(['isOpen','importMKP','reussi','erreur','qteFinal','m2Final','prixHT_TT','prixTVA_TT','prixTTC_TT','stockInvalide']);

const isOpen = ref(props.isOpen);

function closeModal() {
  isOpen.value = false
}

var gridModal = {
 grid4: 'grid-cols-4',
 grid3: 'grid-cols-3',
 grid2: 'grid-cols-2',
 grid1: 'grid-cols-1',
};

var gridChoice = () => {
  if(props.reussi == 4){
    return gridModal.grid4;
  }else if(props.reussi == 3){
    return gridModal.grid3;
  }else if(props.reussi == 2){
    return gridModal.grid2;
  }else if(props.reussi == 1){
    return gridModal.grid1;
  }
};

var viewDetails = (key) => {
  if (document.getElementById("productClientView") != null) {
    if (document.getElementById("productClientView").__vue_app__ != undefined) {
      document.getElementById("productClientView").__vue_app__.unmount();
    }
  }
  var productClientView = createApp(ModalImportMKP_client, { isOpen: true,client: props.importMKP[key],});
  productClientView.mount(document.getElementById("productClientView"));
};

var confirmImport = () => {
  axios.post('/dropshipping/clients/import/validation',{clients: props.importMKP}).then((response) => {
    if(response.status){
      document.location.href = "/dropshipping/gamme";
    }else{
      Toast.fire({
        icon: 'error',
        title: 'Une erreur s\'est produite lors de la validation de l\'importation, veuillez renouveller l\'opération !'
      });
    }
  })
};
var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};
</script>
<script>
import Alert from 'icons/Alert.vue';
</script>

<template>
<TransitionRoot appear :show="isOpen" as="template">
   <Dialog as="div" @close="closeModal" class="relative z-[100]">
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
       <div class="flex min-h-full items-center justify-center p-4 text-center">
         <TransitionChild
           as="template"
           enter="duration-300 ease-out"
           enter-from="opacity-0 scale-95"
           enter-to="opacity-100 scale-100"
           leave="duration-200 ease-in"
           leave-from="opacity-100 scale-100"
           leave-to="opacity-0 scale-95" >
           <DialogPanel class="w-full max-w-5xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all relative">
             <DialogTitle as="h3" class="sm:text-xl text-lg font-medium leading-6 text-gray-900">
               Résumer de l'importation
             </DialogTitle>
             <div class="mt-2">
               <p class="text-sm text-gray-500">
                 Status de l'importation : {{(props.erreur > 0 ? 'echec !' : 'réussi !')}}
               </p>
             </div>

             <div class="bg-yellow-100 rounded-lg text-center p-2" v-if="props.stockInvalide">
                <span class="text-yellow-500"><Alert /> Vous avez une ou des commandes qui contienne des produits avec un stock insuffisant, ces commandes ne pourront être validées.</span>
             </div>

             <div class="grid grid-cols-10 xl:ml-5 bg-primary-50 rounded-lg p-4 mb-4 mt-4">
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Quantiter : {{props.qteFinal}}</span>
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">M² : {{props.m2Final}} m²</span>
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Prix HT : {{ roundNumber(props.prixHT_TT)}} €</span>
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Prix TVA : {{ roundNumber(props.prixTVA_TT) }} €</span>
                <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Prix TTC : {{ roundNumber(props.prixTTC_TT) }} €</span>
             </div>
            <!-- <div :class="'grid '+(props.erreur == 0 ? (props.reussi > 4 ? 'grid-cols-4' : 'grid-cols-'+props.reussi) : 'grid-cols-1')" > -->
            <div :class="'overflow-auto max-h-[50vh] grid ' + (props.erreur == 0 ? (props.reussi > 4 ? gridModal.grid4 : gridChoice()) : gridModal.grid1)" >
              <div class="relative flex justify-center lg:col-span-1 col-span-4  py-4 px-4 " v-for="(client, key) in props.importMKP" :key="key">
                <div v-if="props.erreur == 0 && client.status" class="relative rounded-lg box w-full relative">
                  <div class="rotate-front rounded-lg flex flex-col p-4 overflow-hidden">
                    <div class="z-10 absolute top-2 right-2 flex flex-col" v-if="client.clientProduitStockInvalide">
                      <span class="flex items-center justify-center">Erreur Stock <span class="bg-red-700 w-[10px] h-[10px] block rounded-full ml-2"></span></span>
                    </div>
                    <span>Client : {{client.prenom+' '+client.nom}}</span>
                    <span>Adresse: {{client.adresse_livraison.adresse1}}</span>
                    <span>{{client.adresse_livraison.code_postal+', '+client.adresse_livraison.ville}}</span>
                    <span>{{client.adresse_livraison.pays}}</span>
             
                    <span>Quantiter : {{client.products_tt}}</span>
                    <span>M² total : {{client.m2_tt}} m²</span>
                    <span>Prix TTC Total : {{client.prix_ttc_tt}} €</span>
                  </div>
                  <div class="rotate-back rounded-lg py-4 px-4 flex justify-center items-center">
                    <button type="button" class="bg-primary-100 hover:bg-primary-200 transition duration-300 p-2 rounded-lg" @click="viewDetails(key)">Voir plus</button>
                  </div>
            
                </div>
                <div v-else-if="!client.status" class="cols-span-1">
                  <span>Erreur : {{client.message}}</span>
                </div>
              </div>
            </div>

            <div class=" w-full py-2 bg-white flex items-center justify-center">
              <button @click="confirmImport" class="px-4 py-2 bg-primary-50 rounded hover:bg-primary-100 transition duration-300">Valider l'importation</button>
            </div>
           </DialogPanel>
         </TransitionChild>
       </div>
     </div>
   </Dialog>
 </TransitionRoot>
</template>

<style>
.rotate-front {
   position: relative;
   width: 100%;
   height: 100%;
   background: #dad3cd;
   backface-visibility: hidden;
   transform: perspective(1000px) rotateY(0deg);
   transition: 0.7s;
}
.rotate-back {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: #dad3cd;
   backface-visibility: hidden;
   transform: perspective(1000px) rotateY(-180deg);
   transition: 0.7s;
}

.box:hover .rotate-front {
    transform: perspective(1000px) rotateY(180deg);
}

.box:hover .rotate-back {
    transform: perspective(1000px) rotateY(0deg);
}
</style>