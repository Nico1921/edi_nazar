<script setup>
import { ref, computed, watchEffect,watch } from 'vue';
import { useForm, usePage} from '@inertiajs/inertia-vue3';
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';
import InputError from '@/Components/InputError.vue';
import { CheckIcon, ChevronUpDownIcon,PlusIcon,TrashIcon,EyeIcon,XMarkIcon } from '@heroicons/vue/20/solid';

var prop =  defineProps(['data']);
var data = ref(prop.data);
var id_panier_edi_commande = data.value.id_panier_edi;
var clients = ref(data.value.clients);
var clientModal = ref();
var typeVente = ref(usePage().props.value.session.typeVente);
var indexClientActuel = clients.value.findIndex(client => client.client.id_client_edi == data.value.clientActuel.id_client_edi);
var selected = ref(clients.value[(indexClientActuel != -1 ? indexClientActuel : 0)]);
let query = ref('');

var isOpenModalAdd = ref(false);

var setIsOpen = (value) => {
   isOpenModalAdd.value = value;
}

var formClient = useForm({
   ref_externe: '',
});

let filteredClients = computed(() =>
  query.value === ''
    ? clients.value
    : clients.value.filter((client) =>
      client.client.ref_externe
          .toLowerCase()
          .includes(query.value.toLowerCase())
      )
);

const isOpen = ref(false)

function closeModal() {
  isOpen.value = false;
}
function openModal(e,client) {
   e.preventDefault();
  isOpen.value = true;
  clientModal.value = client;
}

var deleteCommande = (id_panier_edi_list) =>{
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous de supprimer cette article de la commande ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
         const formProduit = useForm({
            id_panier_edi_list: id_panier_edi_list,
         });

         formProduit.post('/dropshipping/panier/delete', {
            preserveScroll: true,
            onSuccess: (e) => {
               if(e.props.session.status){
                  Toast.fire({
                     icon: 'success',
                     title: 'Le produit à bien été supprimer de la commande'
                  })
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur c\'est produit lors de la supression du produit de la commande'
                  });
               }
               
            },
         });
      }
   });
};

var deleteClient = (e,id_client_edi,ref_externe) => {
   e.preventDefault();
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous sur de supprimer la commande client '+ref_externe+' ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
         
         Inertia.post('/dropshipping/clients/delete', { 
            id_client_edi: id_client_edi, 
            id_panier_edi: id_panier_edi_commande 
         },{
            onSuccess : (e) => {
               if (e.props.session.status == true) {
                  Toast.fire({
                        icon: 'success',
                        title: 'La commande client '+ref_externe+ ' à bien été suprimmer !'
                     });
               }else{
                  Toast.fire({
                        icon: 'error',
                        title: 'Une erreur s\'est produite lors de la supression de la commande client'+ref_externe+', veuillez ressayer !'
                     });
               }
         }});
      }
   });
};

var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};

var addRefClient = (event) => {
   var formData = new FormData(event.target);
   formClient.post('/dropshipping/clients/add',{
      preserveScroll: true,
      preserveState:true,   
      onSuccess:(e) => {
            if(e.props.session.statut){
               setIsOpen(false);
               Toast.fire({
                  icon: 'success',
                  title: 'La commande a été ajouter avec succès'
               });
            }else{
               Toast.fire({
                  icon: 'error',
                  title: e.props.session.msg
               });
            }
         }
      });
}

var selectRefClient = (id_client_edi,isModal=false) => {
   Inertia.post('/dropshipping/clients/edit',{id_client_edi: id_client_edi},{
      preserveScroll: true,
      preserveState:true,   
      onSuccess:(e) => {
         if(e.props.session.status){
            setIsOpen(false);
            if(isModal){
               closeModal();
            }
            Toast.fire({
                  icon: 'info',
                  title: 'La commande '+data.value.clientActuel.ref_externe+' a été sélectionner !'
            });
         }else{
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur est survenue, essayer d\'actualiser la page.'
               });
         }
      }
   });
}

watch(data,()=>{
   if(clients.value != undefined){
      indexClientActuel = clients.value.findIndex(client => client.client.id_client_edi == data.value.clientActuel.id_client_edi);
   selected.value = clients.value[(indexClientActuel != -1 ? indexClientActuel : 0)];
   }
})

watchEffect(() => {
   data.value = usePage().props.value.PanierDrop.panier;
   clients.value = data.value.clients;
   
   if (clientModal.value != undefined) {
      var dataClient = usePage().props.value.PanierDrop.panier.clients;
      var indexClientActuel = dataClient.findIndex(client => client.client.id_client_edi == clientModal.value.client.id_client_edi);
      if(indexClientActuel != -1){
         clientModal.value = dataClient[indexClientActuel];
      }
   }
});
</script>
<script>
import Box from 'icons/package.vue';
import { Inertia } from '@inertiajs/inertia';
</script>

<template>
   <Combobox v-model="selected" class="z-40">
      <div class="relative mt-1">
        <div class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm" >
         <div class="absolute inset-y-0 left-0 flex items-center pr-2 pb-1 pl-1">
            <Box class="text-lg text-gray-400" aria-hidden="true"/> 
         </div>
         <ComboboxInput
            class="w-full border-none py-2 pl-6 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
            :displayValue="(client) => client.client.ref_externe"
            @change="query = $event.target.value" />
          <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2" >
            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
          </ComboboxButton>
        </div>
        <TransitionRoot
          leave="transition ease-in duration-100"
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
          @after-leave="query = ''">
          <div class="absolute rounded-md bg-white pt-1 shadow-lg w-full mt-1">
            <ComboboxOptions class=" max-h-36 w-full overflow-auto text-base  ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
            <div v-if="filteredClients.length === 0 && query !== ''" class="relative cursor-default select-none py-2 px-4 text-gray-700">
              Aucun résultat
            </div>
            
            <ComboboxOption v-for="(client, key) in filteredClients" as="template"
              :key="key"
              :value="client"
              v-slot="{ selected, active }">
              <li @click="selectRefClient(client.client.id_client_edi)" class="relative cursor-default select-none py-2 pl-10 pr-4" :class="{'bg-emerald-500 text-white': active, 'text-primary-400': !active,}">
               <span  v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3" :class="{ 'text-white': active, 'text-teal-400': !active }">
                  <CheckIcon class="h-5 w-5" aria-hidden="true" />
                </span> 
               <span class="block truncate pr-14" :class="{ 'font-medium': selected, 'font-normal': !selected }">
                  {{ client.client.ref_externe }}
                </span>
                <div class="absolute inset-y-0 right-0 flex items-center pr-1">
                  <button @click.stop="openModal($event,client)" class="w-full h-full px-2">
                     <span class="rounded-full bg-blue-200 hover:bg-blue-400 text-blue-500 hover:text-blue-700 transition duration-300 p-1 block"><EyeIcon class="h-4 w-4 " /></span>
                  </button>
                  <button @click.stop="deleteClient($event,client.client.id_client_edi,client.client.ref_externe)" class="w-full h-full px-2">
                     <span class="rounded-full bg-red-200 hover:bg-red-400 text-red-500 hover:text-red-700 transition duration-300 p-1 block"><TrashIcon class="h-4 w-4 " /></span></button>
                </div>
              </li>
            </ComboboxOption>
            
          </ComboboxOptions>
          <div class="text-center">
            <button @click="setIsOpen(true)" class="py-2 text-sm overflow-hidden hover:bg-green-200 hover:text-green-600 w-full rounded-md transition duration-300">
               <span class="w-full flex items-center justify-center"><PlusIcon class="w-5 h-5" aria-hidden="true" />Ajouter commande clients</span> 
               <span class="w-full flex items-center justify-center">{{ (filteredClients.length === 0 ? query : '') }}</span>
            </button>
          </div>
          </div>
        </TransitionRoot>
      </div>
    </Combobox>

    <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-[60]">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black bg-opacity-25 z-[50]" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto z-[60]">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel class="w-full max-w-2xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all" >
              <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900 relative" >
                Commande Client N° : {{ clientModal.client.ref_externe }}
                <div class="absolute right-0 top-0">
                  <button @click="closeModal" class="rounded-full p-1 hover:bg-red-200 hover:text-red-400 transition duration-300"><XMarkIcon class="w-4 h-4" /></button>
                </div>
              </DialogTitle>
              <div class="mt-2 grid grid-cols-2">
                  <div v-for="(produit, key) in clientModal.produits" :key="key" class="sm:col-span-1 col-span-2 grid grid-cols-4 bg-gray-100 p-1 m-2 relative rounded-xl">
                     <button @click="deleteCommande(produit.panier.id_panier_edi_list)" class="absolute left-2 top-2 rounded-full bg-red-200 hover:bg-red-400 text-red-500 hover:text-red-700 p-1 transition duration-300" type="button"><TrashIcon class="w-4 h-4" /></button>
                     <div class="col-span-1 flex items-center justify-center">
                        <div v-if="produit.photo != null && produit.photo.img_produit != null"
                           class="lg:w-[45px] lg:h-[75px] sm:w-[60px] sm:h-[90px] w-[70px] h-[100px]">
                           <img  :src="'https://gestion.tapis-nazar.fr/img/produit/' + produit.photo.img_produit"
                              :alt="produit.code_sku" class="w-full h-full object-cover" />
                        </div>
                        <div v-else class="h-full w-full py-2 px-1">
                           <div class="text-3xl h-full w-full flex items-center justify-center bg-gray-300">
                              <ImageOff />
                           </div>
                        </div>
                     </div>
                     <div class="flex flex-col col-span-3">
                        <span class="my-1 text-sm rounded-xl bg-gray-200"><span class="rounded-xl bg-indigo-200 text-indigo-500 px-2 ">Gammes</span> {{ produit.gamme.nom_gamme }}</span>
                        <span class="my-1 text-sm rounded-xl bg-gray-200"><span class="rounded-xl bg-indigo-200 text-indigo-500 px-2 ">Design</span> {{ produit.design.nom_design }}</span>
                        <span class="my-1 text-sm rounded-xl bg-gray-200"><span class="rounded-xl bg-indigo-200 text-indigo-500 px-2 ">Couleur</span> {{ produit.couleur.nom_couleur }}</span>
                        <span class="my-1 text-sm rounded-xl bg-gray-200"><span class="rounded-xl bg-indigo-200 text-indigo-500 px-2 ">Dimension</span> {{ produit.dimension.largeur +"x"+ produit.dimension.longueur  }}cm</span>
                        <span class="my-1 text-sm rounded-xl bg-gray-200"><span class="rounded-xl bg-indigo-200 text-indigo-500 px-2 ">Quantité</span> {{ produit.panier.quantiter }}</span>
                        <span class="my-1 text-sm rounded-xl bg-gray-200"><span class="rounded-xl bg-indigo-200 text-indigo-500 px-2 ">Prix unitaire</span> {{ roundNumber(produit.prixProduit) }} €</span>
                     </div>
                  </div>
              </div>

              <div class="mt-4">
                <button @click="selectRefClient(clientModal.client.id_client_edi,true)" v-if="clientModal.client.id_client_edi != data.clientActuel.id_client_edi" type="button"  
                class="inline-flex justify-center rounded-md border border-transparent bg-green-200 px-4 py-2 
                text-sm font-medium text-green-900 hover:bg-green-300 transition duration-300 mx-1
                focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500 focus-visible:ring-offset-2">
                  <PlusIcon class="h-4 w-4 text-green-500 mt-0 mr-1" /> Ajouter des produits
                </button>
                <button type="button" @click="closeModal" 
                class="inline-flex justify-center rounded-md border border-transparent bg-red-200 px-4 py-2 
                text-sm font-medium text-red-900 hover:bg-red-300 transition duration-300 mx-1
                focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2">
                  <TrashIcon class="h-4 w-4 text-red-500 mt-0 mr-1" /> Supprimer la commande
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>

  <TransitionRoot v-if="typeVente == 2 " appear :show="isOpenModalAdd" as="template" :unmount="false">
    <Dialog as="div" class="relative z-50">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
        :unmount="false"
      >
        <div class="fixed inset-0 bg-black bg-opacity-25" />
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
            leave-to="opacity-0 scale-95" :unmount="false">
            <DialogPanel class="w-full max-w-2xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all" >
              <DialogTitle as="h3" class="lg:text-lg text-sm font-medium leading-6 text-gray-900">
               Saisissez la référence de la commande client.
              </DialogTitle>
               <form @submit.prevent="addRefClient">
                  <input type="hidden" name="id_produit_modal" id="id_produit_modal"/>
                  <input type="hidden" name="key_tab_modal" id="key_tab_modal"/>
                  <input type="hidden" name="qte_modal" id="qte_modal"/>
                  <div class="mt-2">
                     <div class="text-sm text-gray-500">
                        <label class="lg:text-lg text-sm" for="ref"> Référence : </label> 
                        <input v-model="formClient.ref_externe" class="lg:text-lg text-sm transition duration-300 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" id="ref" type="text" name="ref_externe" placeholder="Saisissez la référence de la commande">
                        <InputError class="mt-2" :message="formClient.errors.ref_externe" />
                     </div>
                  </div>

                  <div class="mt-4 flex flex-row-reverse">
                     <button type="submit" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">
                        Valider
                     </button>
                     <button @click="isOpenModalAdd = false;" type="button" class="mx-1 inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300">
                        Fermer
                     </button>
                  </div>
              </form>
             
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>