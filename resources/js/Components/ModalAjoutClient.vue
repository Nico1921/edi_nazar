<script setup>
import { ref, watchEffect,watch } from 'vue';
import { useForm, usePage} from '@inertiajs/inertia-vue3';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';
import InputError from '@/Components/InputError.vue';
import { PlusIcon } from '@heroicons/vue/20/solid';

var isOpenModalAdd = ref(false);
var typeVente = ref(usePage().props.value.session.typeVente);
var setIsOpen = (value) => {
   isOpenModalAdd.value = value;
}

var formClient = useForm({
   ref_externe: '',
});

var addRefClient = (event) => {
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
};
</script>
<script>
import Box from 'icons/package.vue';
import { Inertia } from '@inertiajs/inertia';
</script>

<template>
  <TransitionRoot v-if="typeVente == 2" appear :show="isOpenModalAdd" as="template" :unmount="false">
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

  <div class="overflow-hidden">
      <button @click="setIsOpen(true)" class="group flex items-center justify-center w-auto focus:outline-none">
         <PlusIcon class="w-5 h-5 mr-1" />
         <span class=" ">Ajouter une commande client</span>
      </button>
   </div>
</template>