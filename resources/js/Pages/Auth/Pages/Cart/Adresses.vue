<script setup>
import { Head, useForm,usePage } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import ResumeOrder from '@/Components/ResumeOrder.vue';
import ResumeOrderVertical from '@/Components/ResumeOrderVertical.vue';
import EtapeOrder from '@/Components/EtapeOrder.vue';
import { ref, computed } from 'vue';
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
  Switch 
} from '@headlessui/vue';

const props = defineProps(['panier','client']);
const sameAdresseFact = ref(true);
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
const formClient = useForm({
    email: (props.client.email != undefined ? props.client.email : ''),
    tel: (props.client.tel != undefined ? props.client.tel : ''),
    num_commande: (props.client.ref_externe != undefined ? props.client.ref_externe : ''),
    nom_adresse: (props.client.nom_adresse != undefined ? props.client.nom_adresse : ''),
    adresse1: (props.client.adresse1 != undefined ? props.client.adresse1 : ''),
    adresse2: (props.client.adresse2 != undefined ? props.client.adresse2 : ''),
    adresse3: (props.client.adresse3 != undefined ? props.client.adresse3 : ''),
    code_postal: (props.client.code_postal != undefined ? props.client.code_postal : ''),
    ville: (props.client.ville != undefined ? props.client.ville : ''),
    pays: ref(pays[(props.client.pays != undefined ? (pays.indexOf(props.client.pays) ? pays.indexOf(props.client.pays) : 10) : '')]),
    sameAdresseFact: ref(sameAdresseFact),
    nom_adresse_facturation: (props.client.nom_adresse_facturation != undefined ? props.client.nom_adresse_facturation : ''),
    adresse1_facturation: (props.client.adresse1_facturation != undefined ? props.client.adresse1_facturation : ''),
    adresse2_facturation: (props.client.adresse2_facturation != undefined ? props.client.adresse2_facturation : ''),
    adresse3_facturation: (props.client.adresse3_facturation != undefined ? props.client.adresse3_facturation : ''),
    code_postal_facturation: (props.client.code_postal_facturation != undefined ? props.client.code_postal_facturation : ''),
    ville_facturation: (props.client.ville_facturation != undefined ? props.client.ville_facturation : ''),
    pays_facturation: ref(pays[(props.client.pays_facturation != undefined ? (pays.indexOf(props.client.pays_facturation) ? pays.indexOf(props.client.pays_facturation) : 10) : '')]),
});

var listeAdresses = usePage().props.value.adressesList;
let queryAL = ref('');
const selectedAdresseL = ref('');
let filteredadresseLivraison = computed(() =>
   queryAL.value === '' ? listeAdresses : listeAdresses.filter((adresseOne) =>{
      return adresseOne.nom_adresse.toLowerCase().includes(queryAL.value.toLowerCase())
   })
);

var autocompletForm = () => {
   if(selectedAdresseL.value != ''){
      var adresse = selectedAdresseL.value.adresse;
      formClient.tel= (adresse.tel1 != undefined ? adresse.tel1 : '');
      formClient.nom_adresse= (adresse.nom_contact != undefined ? adresse.nom_contact : '');
      formClient.adresse1= (adresse.adresse1 != undefined ? adresse.adresse1 : '');
      formClient.adresse2= (adresse.adresse2 != undefined ? adresse.adresse2 : '');
      formClient.adresse3= (adresse.adresse3 != undefined ? adresse.adresse3 : '');
      formClient.code_postal= (adresse.code_postal != undefined ? adresse.code_postal : '');
      formClient.ville= (adresse.ville != undefined ? adresse.ville : '');
      formClient.pays= ref(pays[(adresse.pays != undefined ? (pays.indexOf(adresse.pays) ? pays.indexOf(adresse.pays) : 10) : '')]);
      formClient.sameAdresseFact= ref(sameAdresseFact);
      formClient.nom_adresse_facturation= (adresse.nom_contact != undefined ? adresse.nom_contact : '');
      formClient.adresse1_facturation= (adresse.adresse1 != undefined ? adresse.adresse1 : '');
      formClient.adresse2_facturation= (adresse.adresse2 != undefined ? adresse.adresse2 : '');
      formClient.adresse3_facturation= (adresse.adresse3 != undefined ? adresse.adresse3 : '');
      formClient.code_postal_facturation= (adresse.code_postal != undefined ? adresse.code_postal : '');
      formClient.ville_facturation = (adresse.ville != undefined ? adresse.ville : '');
      formClient.pays_facturation= ref(pays[(adresse.pays != undefined ? (pays.indexOf(adresse.pays) ? pays.indexOf(adresse.pays) : 10) : '')]);
   }
}




var listeEtape = ['Panier', 'Adresse Livraison / Facturation', 'Finaliser commande'];
var hrefEtape = ['/cart', '/cart/adresses', '/cart/validation'];

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


// const paysForm = ref(pays[(props.client.pays != undefined ? (pays.indexOf(props.client.pays) ? pays.indexOf(props.client.pays) : 10) : 10)]);



var validationAdresse = () => {
   formClient.post(route('cart/adresses'),{
      onStart: (e) => {
         const btnProcess = document.querySelectorAll('.btnProcess');
         for(let i = 0;i<btnProcess.length;i++){
            btnProcess[i].classList.add('opacity-25');
            btnProcess[i].setAttribute('disabled','disabled');
         }
      },
      onSuccess: (e) => {
         if(e.props.session.status == true){
            document.location.href = "/cart/validation";
           }else if(e.props.session.status == false){

            Toast.fire({
               icon: 'error',
               title: 'Une erreur s\'est produite lors de l\'enregistrement de votre adresse, veuillez ressayer !'
            });
         };
         const btnProcess = document.querySelectorAll('.btnProcess');
         for(let i =0 ;i<btnProcess.length;i++){
               btnProcess[i].classList.remove('opacity-25');
               btnProcess[i].removeAttribute('disabled');
         }
      },
      onError: (e) =>{
         const btnProcess = document.querySelectorAll('.btnProcess');
         for(let i =0 ;i<btnProcess.length;i++){
               btnProcess[i].classList.remove('opacity-25');
               btnProcess[i].removeAttribute('disabled');
         }
      }
   });
};
</script>
<script >
import User from 'icons/Account.vue';
import UnfoldMoreHorizontal from 'icons/UnfoldMoreHorizontal.vue';
import Excel from 'icons/MicrosoftExcel.vue';
import Check from 'icons/Check.vue'; 
import Close from 'icons/Close.vue'; 
import Phone from 'icons/Phone.vue'; 
import Calendar from 'icons/CalendarRange.vue'; 
import City from 'icons/HomeCity.vue'; 
import Flag from 'icons/Flag.vue'; 
import Mail from 'icons/Email.vue'; 
import Box from 'icons/package.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),

   // Using the shorthand
   layout: AuthenticatedLayout,
}
</script>

<template>

   <Head title="Adresse de livraison / facturation - Panier" />
   <section class="container mx-auto mt-5">

      <h1 class="text-center text-3xl text-primary-300">Adresse de livraison / Facturation de la commande</h1>
      <form @submit.prevent="validationAdresse" class="grid grid-cols-4">
         <div class="col-span-4">
            <EtapeOrder :hrefEtape="hrefEtape" :etape="2" :nbEtape="3" :listeEtape="listeEtape" />
         </div>
         <div class="col-span-4 grid grid-cols-4 xl:mx-16 ">
         <div class="lg:col-span-3 col-span-4 xl:ml-0 lg:ml-16 lg:mx-0 sm:mx-12">
            <div class="bg-white border border-primary-100 rounded mb-5">
               <h2 class="text-center text-3xl text-primary-300 py-1 bg-primary-50 rounded-t-sm w-full">Informations générale</h2>
               <div class="text-center w-full my-2">
                  <span>* Informations obligatoires</span>
               </div>
               <div  class="grid grid-cols-6 gap-4 p-5 mx-5" id="form_client">
                  <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-4 col-span-5">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="mail_client"><span class="pr-2">* <Mail /></span> E-Mail :</label>
                        </div>
                        <div class="sm:col-span-8 col-span-7">
                           <input type="text" id="mail_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                              name="email" required="" autofocus="" autocomplete="email" v-model="formClient.email"/>
                           <InputError class="mt-2" :message="formClient.errors.email" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-4 col-span-5">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="mail_client"><span class="pr-2">* <Box /></span> N° Commande :</label>
                        </div>
                        <div class="sm:col-span-8 col-span-7">
                           <input type="text" id="num_commande"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                              name="num_commande" required="" autofocus="" v-model="formClient.num_commande"/>
                           <InputError class="mt-2" :message="formClient.errors.num_commande" />
                        </div>
                     </div>
               </div>
            </div>
            <div class="bg-white border border-primary-100 rounded my-5">
               <h2 class="text-center text-3xl text-primary-300 py-1 bg-primary-50 rounded-t-sm w-full">Saisir l'adresse de livraison</h2>
               <div class="text-center w-full my-2">
                  <span>* Informations obligatoires</span>
               </div>
               <div class="grid grid-cols-6 gap-4 p-5 mx-5" id="form_client">
                  <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12" v-if="listeAdresses != ''">
                        <div class="sm:col-span-3 col-span-4">
                           <label for="adresses_client" class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1"><City /> </span> Liste des adresses enregistrées :</label>
                        </div>
                        <div class="sm:col-span-9 col-span-8">
                           <Combobox v-model="selectedAdresseL">
                              <div class="relative">
                                 <div class="relative w-full cursor-default overflow-hidden rounded-lg bg-transparent text-left shadow-md 
                                 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 
                                 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm">
                                    <ComboboxInput
                                       class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-sm leading-5 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                       :displayValue="(adresseOne) => {autocompletForm();return adresseOne.nom_adresse;}" @change="queryAL.value = $event.target.value;autocompletForm()" 
                                       placeholder="Sélectionnez votre adresse" name="adresse" required autofocus />
                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                       <UnfoldMoreHorizontal class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                    </ComboboxButton>
                                 </div>
                                 <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
                                    @after-leave="queryAL = ''">
                                    <ComboboxOptions
                                       class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                       <div v-if="filteredadresseLivraison.length === 0 && queryAL !== ''"
                                          class="relative cursor-default select-none py-2 px-4 text-gray-700">
                                          Aucun résultat.
                                       </div>

                                       <ComboboxOption v-for="adresseOne in filteredadresseLivraison" as="template" :key="adresseOne"
                                          :value="adresseOne" v-slot="{ selected, active }">
                                          <li class="relative cursor-default select-none py-2 pl-10 pr-4" :class="{
                                             'bg-teal-600 text-white': active,
                                             'text-gray-900': !active,
                                          }">
                                             <span class="block truncate"
                                                :class="{ 'font-medium': selected, 'font-normal': !selected }">
                                                {{ adresseOne.nom_adresse }}
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
                        </div>
                     </div>
                  <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="nom_adresse_client"><span class="pr-2">* <City /></span> Contact:</label>
                        </div>
                        <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                           <input type="text" id="nom_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="nom_adresse" required="" autofocus="" v-model="formClient.nom_adresse"/>
                           <InputError class="mt-2" :message="formClient.errors.nom_adresse" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="adresse_client"><span class="pr-2">* <City /></span> Adresse :</label>
                        </div>
                        <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                           <input type="text" id="adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse1" required autofocus autocomplete="address-line1" v-model="formClient.adresse1"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse1" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="complement_adresse_client"><span class="pr-2">* <City /></span> Complément d'adresse :</label>
                        </div>
                        <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                           <input type="text" id="complement_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse2" autofocus autocomplete="address-line2" v-model="formClient.adresse2"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse2" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="information_adresse_client"><span class="pr-2">* <City /></span> Information complèmentaires :</label>
                        </div>
                        <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                           <input type="text" id="information_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse3" autofocus autocomplete="address-line3" v-model="formClient.adresse3"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse3" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="cp_client"><span class="pr-2">* <City /></span> Code postal :</label>
                        </div>
                        <div class="2xl:col-span-6 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="cp_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="code_postal" required autofocus autocomplete="postal-code" v-model="formClient.code_postal"/>
                           <InputError class="mt-2" :message="formClient.errors.code_postal" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-5 lg:col-span-3 sm:col-span-4 col-span-7">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ville_client"><span class="pr-2">* <City /> </span> Ville :</label>
                        </div>
                        <div class="2xl:col-span-7 lg:col-span-9 sm:col-span-8 col-span-5">
                           <input type="text" id="ville_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="ville" required autofocus autocomplete="city" v-model="formClient.ville"/>
                           <InputError class="mt-2" :message="formClient.errors.ville" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-3 col-span-4">
                           <label for="pays_client" class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1">* <Flag /> </span> Pays :</label>
                        </div>
                        <div class="sm:col-span-9 col-span-8">
                           <Combobox v-model="formClient.pays">
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
                                       class="absolute z-30 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
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
                           <InputError class="mt-2" :message="formClient.errors.pays" />
                        </div>
                     </div>
                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-3 col-span-5">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="tel_client"><span class="mr-2">* <Phone /> </span> Téléphone :</label>
                        </div>
                        <div class="sm:col-span-9 col-span-7">
                           <input type="text" id="tel_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                              name="tel" required="" autofocus="" autocomplete="tel" v-model="formClient.tel"/>
                           <InputError class="mt-2" :message="formClient.errors.tel" />
                        </div>
                     </div>
                  <div class="col-span-6 z-10 relative py-1 pl-4 pr-4 text-lg rounded bg-primary-50 w-full text-primary-400 flex flex-row items-center">
                     <label for="sameAdresseFact" class="sm:w-11/12 w-10/12 text-[0.9rem]">Utiliser cette adresse comme adresse de facturation</label>
                     <div class="sm:w-1/12 w-2/12 flex justify-center">
                        <Switch id="sameAdresseFact" v-model="sameAdresseFact" :class="sameAdresseFact ? 'bg-blue-600' : 'bg-gray-200'" class="relative inline-flex h-6 w-11 items-center rounded-full">
                           <span class="sr-only">Même adresse de facturation</span>
                           <span :class="sameAdresseFact ? 'translate-x-6' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition"></span>
                        </Switch>
                     </div>
                     
                  </div>
               </div>
            </div>
            <div v-if="!sameAdresseFact" class="bg-white border border-primary-100 rounded my-5">
               <h2 class="text-center text-3xl text-primary-300 py-1 bg-primary-50 rounded-t-lg w-full">Saisir l'adresse de facturation</h2>
               <div class="text-center w-full my-2">
                  <span>* Informations obligatoires</span>
               </div>
               <div @submit.prevent="submit" class="grid grid-cols-6 gap-4 p-5 mx-5" id="form_client">
                  
                  <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="nom_adresse_client"><span class="pr-2">* <City /></span> Nom adresse :</label>
                        </div>
                        <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                           <input type="text" id="nom_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="nom_adresse" required="" autofocus="" v-model="formClient.nom_adresse_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.nom_adresse_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="adresse_client"><span class="pr-2">* <City /></span> Adresse :</label>
                        </div>
                        <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                           <input type="text" id="adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse1" required autofocus autocomplete="address-line1" v-model="formClient.adresse1_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse1_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="complement_adresse_client"><span class="pr-2"> <City /></span> Complément d'adresse :</label>
                        </div>
                        <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                           <input type="text" id="complement_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse2" autofocus autocomplete="address-line2" v-model="formClient.adresse2_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse2_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 lg:col-span-6 sm:col-span-5 col-span-8">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="information_adresse_client"><span class="pr-2"> <City /></span> Information complèmentaires :</label>
                        </div>
                        <div class="2xl:col-span-8 lg:col-span-6 sm:col-span-7 col-span-4">
                           <input type="text" id="information_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse3" autofocus autocomplete="address-line3" v-model="formClient.adresse3_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse3_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-2" for="cp_client"><span class="pr-1">* <City /></span> Code postal :</label>
                        </div>
                        <div class="2xl:col-span-6 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="cp_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="code_postal" required autofocus autocomplete="postal-code" v-model="formClient.code_postal_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.code_postal_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-5 lg:col-span-3 sm:col-span-4 col-span-7">
                           <label class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ville_client"><span class="pr-2">* <City /> </span> Ville :</label>
                        </div>
                        <div class="2xl:col-span-7 lg:col-span-9 sm:col-span-8 col-span-5">
                           <input type="text" id="ville_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="ville" required autofocus autocomplete="city" v-model="formClient.ville_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.ville_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-3 col-span-4">
                           <label for="pays_client" class="text-[0.9rem] block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1">* <Flag /> </span> Pays :</label>
                        </div>
                        <div class="sm:col-span-9 col-span-8">
                           <Combobox v-model="formClient.pays_facturation">
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
                                       class="absolute z-30 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
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
                           <InputError class="mt-2" :message="formClient.errors.pays" />
                        </div>
                     </div>
               </div>
            </div>
         </div>
         <div class="lg:hidden block col-span-4">
            <ResumeOrderVertical :linkEtapeSuivant="'/cart/validation'" :titreLink="'Valider mon adresse'" :panier="props.panier" :isButtonSubmit="true" />
         </div>
         <div class="lg:block hidden col-span-1 ml-5">
            <ResumeOrder :linkEtapeSuivant="'/cart/validation'" :titreLink="'Valider mon adresse'" :panier="props.panier" :isButtonSubmit="true" />
         </div>
      </div>
      </form>

   </section>
</template>