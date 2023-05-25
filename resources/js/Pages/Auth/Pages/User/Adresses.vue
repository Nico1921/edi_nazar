<script setup>
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, watchEffect,computed } from 'vue';
import {
   TransitionRoot,
   TransitionChild,
   Dialog,
   DialogPanel,
   DialogTitle,
   Combobox,
   ComboboxInput,
   ComboboxButton,
   ComboboxOptions,
   ComboboxOption,
} from '@headlessui/vue';
import InputError from '@/Components/InputError.vue';

var prop = defineProps(['adresses']);

var adresses = ref(prop.adresses);
const pays = [
  'Allemagne',
  'Autriche',
  'Belgique',
  'Bulgarie',
  'Chypre',
  'Croatie',
  'Danemark',
  'Espagne',
  'Estonie',
  'Finlande',
  'France',
  'Grèce',
  'Hongrie',
  'Irlande',
  'Italie',
  'Lettonie',
  'Lituanie',
  'Luxembourg',
  'Malte',
  'Pays-Bas',
  'Pologne',
  'Portugal',
  'République tchèque',
  'Roumanie',
  'Slovaquie',
  'Slovénie',
  'Suède',
];
var formAdresseModal = useForm({
   nom_adresse:null,
   id_adresse:null,
   id_adresse_edi:null,
   nom_contact : null,
   adresse1: null,
   adresse2: null,
   adresse3: null,
   code_postal : null,
   ville : null,
   pays : null,
   tel1: null 
});

var formDeleteAdresse = useForm({
   id_adresse_edi:null,
});

let query = ref('');

let filteredPays = computed(() =>
  query.value === ''
    ? pays
    : pays.filter((paysOne) =>
      paysOne
          .toLowerCase()
          .replace(/\s+/g, '')
          .includes(query.value.toLowerCase().replace(/\s+/g, ''))
      )
);


const isOpen = ref(false);

function closeModal() {
   isOpen.value = false;
}

function setIsOpen() {
   formAdresseModal.nom_contact = null;
   formAdresseModal.adresse1 = null;
   formAdresseModal.adresse2 = null;
   formAdresseModal.adresse3 = null
   formAdresseModal.code_postal = null;
   formAdresseModal.ville = null;
   formAdresseModal.pays = null;
   formAdresseModal.tel1 = null;
   formAdresseModal.id_adresse = null;
   formAdresseModal.id_adresse_edi = null;
   formAdresseModal.nom_adresse = null;
   isOpen.value = true;
}

function openModal(adresse) {
   formAdresseModal.nom_contact = adresse.adresse.nom_contact;
   formAdresseModal.adresse1 = adresse.adresse.adresse1;
   formAdresseModal.adresse2 = adresse.adresse.adresse2;
   formAdresseModal.adresse3 = adresse.adresse.adresse3;
   formAdresseModal.code_postal = adresse.adresse.code_postal;
   formAdresseModal.ville = adresse.adresse.ville;
   formAdresseModal.pays = adresse.adresse.pays;
   formAdresseModal.tel1 = adresse.adresse.tel1;
   formAdresseModal.id_adresse = adresse.adresse.id_adresse;
   formAdresseModal.id_adresse_edi = adresse.id_adresse_edi;
   formAdresseModal.nom_adresse = adresse.nom_adresse;
   isOpen.value = true;
}

var submit = ()=>{
   formAdresseModal.post('/settings/adresses/save', {
      onSuccess: (e) => {
         if(e.props.session.status == true){
            closeModal()
            Toast.fire({
               icon: 'success',
               title: e.props.session.message
            });
         }else if(e.props.session.status == false){ 
            Toast.fire({
               icon: 'error',
               title: e.props.session.message
            });
         };
      }
   });
}
var deleteAdresse = (id_adresse_edi)=>{
   Swal.fire({
      title: 'Attention',
      text: 'Êtes-vous sûr(e) de vouloir supprimer cette adresse de votre carnet d\'adresses ? Veuillez noter que toutes les commandes validées avant la suppression seront expédiées à cette adresse.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
         formDeleteAdresse.id_adresse_edi = id_adresse_edi;
         formDeleteAdresse.post('/settings/adresses/delete', {
            onSuccess: (e) => {
               if(e.props.session.status == true){
                  Toast.fire({
                     icon: 'success',
                     title: e.props.session.message
                  });
               }else if(e.props.session.status == false){ 
                  Toast.fire({
                     icon: 'error',
                     title: e.props.session.message
                  });
               };
               formDeleteAdresse.id_adresse_edi = null;
            },
            onError: (e) => {
               if(e.props.session.message != undefined){
                  Toast.fire({
                     icon: 'error',
                     title: e.props.session.message
                  });
               }else if(e.props.session.status == false){ 
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite. Veuillez réessayer ultérieurement.'
                  });
               };
               formDeleteAdresse.id_adresse_edi = null;
            },
         });
      }
   });
}

watchEffect(() => {
   adresses.value =  usePage().props.value.adressesList;
});
</script>
<script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UnfoldMoreHorizontal from 'icons/UnfoldMoreHorizontal.vue';
import City from 'icons/HomeCity.vue'; 
import Flag from 'icons/Flag.vue'; 
import Phone from 'icons/Phone.vue'; 
import Save from 'icons/ContentSave.vue'; 
import { PencilIcon, XMarkIcon,PlusIcon,TrashIcon } from '@heroicons/vue/20/solid';
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
      <div class="relative flex items-center justify-center">
         <h1 class="text-center text-3xl font-bold">Mes adresses</h1>
               <div v-if="adresses != ''" class="absolute left-0 flex items-center justify-center">
                  <button @click="setIsOpen(true)" class="px-2 bg-primary-50 hover:scale-110 transition duration-300 rounded h-auto flex items-center justify-center">
                        <PlusIcon class="w-5 h-5 mr-1" />
                        <span>Ajouter une adresse</span>
                     </button>
               </div>
      </div>
               
               
               <div class="grid grid-cols-3 gap-6 mt-8 ">
                  <div v-if="adresses != ''" v-for="(oneAdresse, key) in adresses" :key="key"
                     class="col-span-1 bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between hover:shadow-2xl transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                     <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center">
                              <div class="flex flex-col"
                                 v-if="oneAdresse.adresse.adresse1 != '' && oneAdresse.adresse.adresse1 != null">
                                 <span class="text-lg"><span class="font-bold">Adresse commande : </span>{{oneAdresse.nom_adresse }}</span>
                                 <span class="text-lg">{{oneAdresse.adresse.nom_contact }},</span>
                                 <span class="text-lg">{{ oneAdresse.adresse.adresse1 }},</span>
                                 <span v-if="oneAdresse.adresse.adresse2 != '' && oneAdresse.adresse.adresse2 != null"
                                    class="text-lg ">{{ oneAdresse.adresse.adresse2 }},</span>
                                 <span v-if="oneAdresse.adresse.adresse3 != '' && oneAdresse.adresse.adresse3 != null"
                                    class="text-lg ">{{ oneAdresse.adresse.adresse3 }},</span>
                                 <span class="text-lg">{{ oneAdresse.adresse.code_postal + ", " + oneAdresse.adresse.ville }},</span>
                                 <span class="text-lg">{{ oneAdresse.adresse.pays }}</span>
                              </div>
                        </div>

                        <div class="">
                           <button @click="openModal(oneAdresse)"
                              class="text-gray-600 hover:text-gray-400 flex bg-primary-50 hover:bg-primary-100 group px-4 py-1 rounded-2xl  transition duration-300 ease-in-out">
                              <PencilIcon class="pt-1 w-5 h-5 text-primary-300 group-hover:text-primary-200" />
                              <span>Modifier</span>
                           </button>
                           <button @click="deleteAdresse(oneAdresse.id_adresse_edi)"
                              class="mt-5 text-red-600 hover:text-red-500 flex bg-red-50 hover:bg-red-100 group px-4 py-1 rounded-2xl  transition duration-300 ease-in-out">
                              <TrashIcon class="pt-1 w-5 h-5 text-red-300 group-hover:text-red-400" />
                              <span>Suprimer</span>
                           </button>
                        </div>
                     </div>
                  </div>
                  <div v-else class="col-span-2">
                     <div class="flex flex-col items-center justify-center">
                        <span class="text-xl font-semibold my-5">Votre carnet d'adresse est vide !</span>
                        <button @click="setIsOpen(true)" class="px-2 bg-primary-50 hover:scale-110 transition duration-300 rounded h-auto flex items-center justify-center">
                           <PlusIcon class="w-5 h-5 mr-1" />
                           <span>Ajouter une adresse</span>
                     </button>
                     </div>
                  </div>
               </div>
   </section>

   <TransitionRoot appear :show="isOpen" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-50">
         <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
            leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
            <div class="fixed inset-0 bg-black bg-opacity-25" />
         </TransitionChild>

         <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
               <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                  enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                  leave-to="opacity-0 scale-95">
                  <DialogPanel
                     class="relative w-full max-w-4xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                     <DialogTitle as="h3"
                        class="mb-5 xl:text-3xl lg:text-2xl sm:text-xl text-lg font-medium leading-6 text-gray-600 text-center">
                        {{ (formAdresseModal.id_adresse != null && formAdresseModal.id_adresse != '' ? 'Modification de l\'' : 'Ajout d\'une' )}} adresse {{ formAdresseModal.nom_adresse }} 
                     </DialogTitle>

                     <button @click="closeModal" type="button" class="absolute top-5 right-10 h-5 w-5">
                        <XMarkIcon />
                     </button>
                     <div class="text-center w-full">
                        <span>* Informations obligatoires</span>
                     </div>
                     
                     <form @submit.prevent="submit" class="grid grid-cols-6 gap-4 p-5 mx-5" id="form_client">
                        <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                              <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                                 <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-2" for="nom_adresse_client"><span class="pr-2">* <City /></span> Nom adresse :</label>
                              </div>
                              <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                                 <input type="text" id="nom_adresse_client"
                                 class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                    name="nom_adresse" required="" autofocus="" v-model="formAdresseModal.nom_adresse"/>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.nom_adresse" />
                              </div>
                           </div>
                           <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                              <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                                 <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="nom_contact_client"><span class="pr-2">* <City /></span> Contact :</label>
                              </div>
                              <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                                 <input type="text" id="nom_contact_client"
                                 class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                    name="nom_contact" required="" autofocus="" v-model="formAdresseModal.nom_contact"/>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.nom_contact" />
                              </div>
                           </div>
                           <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                              <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                                 <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="adresse_client"><span class="pr-2">* <City /></span> Adresse :</label>
                              </div>
                              <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                                 <input type="text" id="adresse_client"
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                    name="adresse1" required autofocus autocomplete="address-line1" v-model="formAdresseModal.adresse1"/>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.adresse1" />
                              </div>
                           </div>
                           <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                              <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                                 <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="complement_adresse_client"><span class="pr-2"><City /></span> Complément d'adresse :</label>
                              </div>
                              <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                                 <input type="text" id="complement_adresse_client"
                                 class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                    name="adresse2" autofocus autocomplete="address-line2" v-model="formAdresseModal.adresse2"/>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.adresse2" />
                              </div>
                           </div>
                           <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                              <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                                 <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="information_adresse_client"><span class="pr-2"><City /></span> Information complèmentaires :</label>
                              </div>
                              <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                                 <input type="text" id="information_adresse_client"
                                 class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                    name="adresse3" autofocus autocomplete="address-line3" v-model="formAdresseModal.adresse3"/>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.adresse3" />
                              </div>
                           </div>
                           <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                              <div class="2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7">
                                 <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-2" for="cp_client"><span class="pr-1">* <City /></span> Code postal :</label>
                              </div>
                              <div class="2xl:col-span-6 lg:col-span-7 sm:col-span-8 col-span-5">
                                 <input type="text" id="cp_client"
                                 class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                    name="code_postal" required autofocus autocomplete="postal-code" v-model="formAdresseModal.code_postal"/>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.code_postal" />
                              </div>
                           </div>
                           <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                              <div class="2xl:col-span-5 lg:col-span-3 sm:col-span-4 col-span-7">
                                 <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ville_client"><span class="pr-2">* <City /> </span> Ville :</label>
                              </div>
                              <div class="2xl:col-span-7 lg:col-span-9 sm:col-span-8 col-span-5">
                                 <input type="text" id="ville_client"
                                 class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                    name="ville" required autofocus autocomplete="city" v-model="formAdresseModal.ville"/>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.ville" />
                              </div>
                           </div>
                           <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                              <div class="sm:col-span-3 col-span-4">
                                 <label for="pays_client" class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1">* <Flag /> </span> Pays :</label>
                              </div>
                              <div class="sm:col-span-9 col-span-8">
                                 <Combobox v-model="formAdresseModal.pays">
                                    <div class="relative">
                                       <div class="relative w-full cursor-default overflow-hidden rounded-lg bg-transparent text-left shadow-md 
                                       focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 
                                       focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm">
                                          <ComboboxInput
                                             class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-sm leading-5 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                             :displayValue="(paysOne) => paysOne" @change="query = $event.target.value" 
                                             name="pays" required autofocus />
                                          <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                             <UnfoldMoreHorizontal class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                          </ComboboxButton>
                                       </div>
                                       <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
                                          @after-leave="query = ''">
                                          <ComboboxOptions
                                             class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                             <div v-if="filteredPays.length === 0 && query !== ''"
                                                class="relative cursor-default select-none py-2 px-4 text-gray-700">
                                                Nothing found.
                                             </div>

                                             <ComboboxOption v-for="paysOne in filteredPays" as="template" :key="paysOne"
                                                :value="paysOne" v-slot="{ selected, active }">
                                                <li class="relative cursor-default select-none py-2 pl-10 pr-4" :class="{
                                                   'bg-teal-600 text-white': active,
                                                   'text-gray-900': !active,
                                                }">
                                                   <span class="block truncate"
                                                      :class="{ 'font-medium': selected, 'font-normal': !selected }">
                                                      {{ paysOne }}
                                                   </span>
                                                   <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                      :class="{ 'text-white': active, 'text-teal-600': !active }">
                                                      <Check class="h-5 w-5" aria-hidden="true" />
                                                   </span>
                                                </li>
                                             </ComboboxOption>
                                          </ComboboxOptions>
                                       </TransitionRoot>
                                    </div>
                                 </Combobox>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.pays" />
                              </div>
                           </div>
                           <div class="col-span-6 grid grid-cols-12 flex text-lg pb-2">
                              <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                                 <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="tel_client"><span class="mr-2">* <Phone /> </span> Téléphone :</label>
                              </div>
                              <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                                 <input type="text" id="tel_client"
                                 class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                                    name="tel1" required="" autofocus="" autocomplete="tel" v-model="formAdresseModal.tel1"/>
                                 <InputError class="mt-2" :message="formAdresseModal.errors.tel1" />
                              </div>
                           </div>
                           <div class="col-span-6 flex items-center justify-end">
                              <button :class="{ 'opacity-25': formAdresseModal.processing }" :disabled="formAdresseModal.processing" type="submit" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                                 hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                                 disabled:bg-green-300">
                                 Enregistrer <Save class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" />
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