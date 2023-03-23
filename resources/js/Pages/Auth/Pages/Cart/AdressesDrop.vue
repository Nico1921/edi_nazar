<script setup>
import { Head,usePage } from '@inertiajs/inertia-vue3';
import { ref, computed, watchEffect } from 'vue';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';
import ResumeOrder from '@/Components/ResumeOrder.vue';
import ResumeOrderVertical from '@/Components/ResumeOrderVertical.vue';
import EtapeOrder from '@/Components/EtapeOrder.vue';
import Tooltip from '@/Components/Tooltip.vue';
import ModuleAdresseDrop from '@/Components/ModuleAdresseDrop.vue';

var clients = ref(usePage().props.value.PanierDrop.panier.clients);
var panierDrop = ref(usePage().props.value.PanierDrop);
var allValid = ref(usePage().props.value.PanierDrop.panier.addresses_valid);
var ref_edit = ref(null);
var clientModal = ref(usePage().props.value.PanierDrop.panier.clients[0].client);

const isOpen = ref(false)

function closeModal() {
  isOpen.value = false
}
function openModal(ref_externe,client) {
  clientModal.value = client;
  ref_edit.value = ref_externe;
  isOpen.value = true
}
var listeEtape = ['Panier', 'Adresse Livraison / Facturation', 'Finaliser commande'];
watchEffect(() => {
   clients.value = usePage().props.value.PanierDrop.panier.clients;
   panierDrop.value = usePage().props.value.PanierDrop;
   allValid.value = usePage().props.value.PanierDrop.panier.addresses_valid;
   console.log(allValid.value);
});
</script>
<script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { PencilIcon,XMarkIcon,CheckIcon,ExclamationCircleIcon } from '@heroicons/vue/20/solid';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),

   // Using the shorthand
   layout: AuthenticatedLayout,
}
</script>
<template>
   <Head title="Adresse de livraison / facturation des commandes - Panier" />
   <section class="container mx-auto mt-5">
      <div class="grid grid-cols-4">
         <div class="xl:col-span-1 col-span-4">
            <EtapeOrder :etape="2" :nbEtape="3" :listeEtape="listeEtape" />
         </div>
         <div class="xl:col-span-2 lg:col-span-3 col-span-4">
         <h1 class="text-center text-3xl text-primary-300">Adresse de livraison / Facturation des commandes</h1>
         <div v-if="!allValid" class="bg-yellow-200 px-4 py-2 rounded flex items-center">
            <ExclamationCircleIcon class="h-8 w-8 text-yellow-600" />
            <span class="pl-2 text-yellow-600">Pour continuer, veuillez saisir l'adresse pour chaque commande.</span>
         </div>   
         <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
               <div v-for="(client, key) in clients"
                  :key="key" class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between hover:shadow-2xl transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                  <div class="flex flex-row justify-between items-center">
                     <div class="flex flex-row items-center">
                        <Tooltip>
                           <template #header>
                              <XMarkIcon class="w-8 h-8 text-red-500" v-if="!client.client.adresseValide" />
                              <CheckIcon class="w-8 h-8 text-green-500" v-if="client.client.adresseValide" />
                           </template>
                           <template #body>
                              <span v-if="!client.client.adresseValide" class="text-red-500">Invalide</span>
                              <span v-if="client.client.adresseValide" class="text-green-500">Valide</span>
                           </template>
                        </Tooltip>
                        <span class="text-lg font-bold">{{ client.client.ref_externe }}</span>
                     </div>
                     
                     <div class="">
                        <button @click="openModal(client.client.ref_externe,client.client)" class="text-gray-500 hover:text-gray-300 flex bg-primary-50 hover:bg-primary-100 group px-4 py-1 rounded-2xl  transition duration-300 ease-in-out">
                           <PencilIcon class="pt-1 w-5 h-5 text-primary-200 group-hover:text-primary-50" /> <span>Modifier</span>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="lg:hidden block col-span-4">
            <ResumeOrderVertical :disabled="!allValid" :linkEtapeSuivant="(panierDrop.panier.addresses_valid ? '/dropshipping/cart/validation' : '')" :titreLink="'Valider mon adresse'" :panier="(panierDrop.panier.panierActuel != undefined ? panierDrop.panier.panierActuel : undefined)" :isButtonSubmit="false" />
         </div>
         <div class="lg:block hidden col-span-1 ml-5">
            <ResumeOrder :disabled="!allValid" :linkEtapeSuivant="(panierDrop.panier.addresses_valid ? '/dropshipping/cart/validation' : '')" :titreLink="'Valider mon adresse'" :panier="(panierDrop.panier.panierActuel != undefined ? panierDrop.panier.panierActuel : undefined)" :isButtonSubmit="false" />
         </div>
      </div>
   </section>

   <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-50">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
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
            <DialogPanel
              class="relative w-full max-w-4xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle
                as="h3"
                class="mb-5 xl:text-3xl lg:text-2xl sm:text-xl text-lg font-medium leading-6 text-gray-600"
              >
                Modification adresse {{ ref_edit }}
              </DialogTitle>
              
               <button @click="closeModal" type="button" class="absolute top-5 right-10 h-5 w-5"><XMarkIcon /></button>
        
              <ModuleAdresseDrop @close="closeModal" :client="clientModal" />
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
 </template>