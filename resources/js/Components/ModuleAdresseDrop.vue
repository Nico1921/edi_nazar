<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
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

const props = defineProps(['client']);
const emit = defineEmits(['close'])

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

const sameAdresseFact = ref((props.client.adresse1_facturation == props.client.adresse1 ? true : false));

// const paysForm = ref(pays[(props.client.pays != undefined ? (pays.indexOf(props.client.pays) ? pays.indexOf(props.client.pays) : 10) : 10)]);

const formClient = useForm({
    id_client_edi: (props.client.id_client_edi != undefined ? props.client.id_client_edi : ''),
    nom: (props.client.nom != undefined ? props.client.nom : ''),
    prenom: (props.client.prenom != undefined ? props.client.prenom : ''),
    email: (props.client.email != undefined ? props.client.email : ''),
    tel: (props.client.tel != undefined ? props.client.tel : ''),
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

var validationAdresse = () => {
   formClient.post('/dropshipping/cart/adresses',{
      onSuccess: (e) => {
           if(e.props.session.status == true){
               emit('close');
           }else if(e.props.session.status == false){

            Toast.fire({
               icon: 'error',
               title: 'Une erreur s\'est produite lors de l\'enregistrement de votre adresse, veuillez ressayer !'
            });
         };
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
import Back from 'icons/ArrowLeftThin.vue'; 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),

   // Using the shorthand
   layout: AuthenticatedLayout,
}
</script>

<template>
      <form @submit.prevent="validationAdresse" >
            <div class="bg-primary-50 rounded mb-5">
               <h2 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 py-1 bg-primary-100 rounded-t-lg w-full">Information générale</h2>
               <div  class="grid grid-cols-6 gap-4 mt-2 lg:p-5 sm:p-3 p-1 lg:mx-5 sm:mx-3 mx-2" id="form_client">
                  <div class="col-span-6 flex text-lg pb-2 ">
                     <input type="hidden" id="id_client_edi" name="id_client_edi" v-model="formClient.id_client_edi"/>
                     <InputError class="mt-2" :message="formClient.errors.id_client_edi" />
                  </div>

                  <div class="col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-5 sm:col-span-4 col-span-5">
                           <label for="prenom_client" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4 sm:text-lg text-sm"><span
                              class="inline-flex left-3 items-center justify-items-center justify-center sm:text-lg text-sm">
                              <User />
                           </span> Prénom :</label>
                        </div>
                        <div class="2xl:col-span-7 sm:col-span-8 col-span-7">
                           <input type="text" id="prenom_client"
                           class="bg-gray-200 sm:text-lg text-sm appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                           name="prenom" required autofocus autocomplete="given-name" v-model="formClient.prenom"/>
                           <InputError class="mt-2" :message="formClient.errors.prenom" />
                        </div>
                     </div>
                     <div class="col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 sm:col-span-4 col-span-5">
                           <label for="nom_client" class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span
                                 class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4 sm:text-lg text-sm">
                                 <User />
                           </span> Nom :</label>
                        </div>
                        <div class="2xl:col-span-8 sm:col-span-8 col-span-7">
                        <input type="text" id="nom_client"
                        class="bg-gray-200 sm:text-lg text-sm appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                           name="nom" required autofocus autocomplete="family-name" v-model="formClient.nom"/>
                        <InputError class="mt-2" :message="formClient.errors.nom" />
                        </div>
                     </div>
                  
                  <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-4 col-span-5">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4 sm:text-lg text-sm" for="mail_client"><span class="pr-2"><Mail /></span> E-Mail :</label>
                        </div>
                        <div class="sm:col-span-8 col-span-7">
                           <input type="text" id="mail_client"
                           class="bg-gray-200 sm:text-lg text-sm appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                              name="email" required="" autofocus="" autocomplete="email" v-model="formClient.email"/>
                           <InputError class="mt-2" :message="formClient.errors.email" />
                        </div>
                     </div>
                  <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-4 col-span-6">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4 sm:text-lg text-sm" for="tel_client"><span class="mr-2"><Phone /> </span> Téléphone :</label>
                        </div>
                        <div class="sm:col-span-8 col-span-6">
                           <input type="text" id="tel_client"
                           class="bg-gray-200 sm:text-lg text-sm appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                              name="tel" required="" autofocus="" autocomplete="tel" v-model="formClient.tel"/>
                           <InputError class="mt-2" :message="formClient.errors.tel" />
                        </div>
                  </div>
               </div>
            </div>
            <div class="bg-primary-50 rounded my-5">
               <h2 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 py-1 bg-primary-100 rounded-t-lg w-full">Saisir l'adresse de livraison</h2>
               <div class="grid grid-cols-6 gap-4 mt-2 lg:p-5 sm:p-3 p-1 lg:mx-5 sm:mx-3 mx-2" id="form_client">

                  <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="nom_adresse_client"><span class="pr-2"><City /></span> Contact :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="nom_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="nom_adresse" required="" autofocus="" v-model="formClient.nom_adresse"/>
                           <InputError class="mt-2" :message="formClient.errors.nom_adresse" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="adresse_client"><span class="pr-2"><City /></span> Adresse :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse1" required autofocus autocomplete="address-line1" v-model="formClient.adresse1"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse1" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="complement_adresse_client"><span class="pr-2"><City /></span> Adresse 2 :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="complement_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse2" autofocus autocomplete="address-line2" v-model="formClient.adresse2"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse2" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="information_adresse_client"><span class="pr-2"><City /></span> Adresse 3 :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="information_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse3" autofocus autocomplete="address-line3" v-model="formClient.adresse3"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse3" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="cp_client"><span class="pr-2"><City /></span> Code postal :</label>
                        </div>
                        <div class="2xl:col-span-6 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="cp_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="code_postal" required autofocus autocomplete="postal-code" v-model="formClient.code_postal"/>
                           <InputError class="mt-2" :message="formClient.errors.code_postal" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-5 lg:col-span-3 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ville_client"><span class="pr-2"><City /> </span> Ville :</label>
                        </div>
                        <div class="2xl:col-span-7 lg:col-span-9 sm:col-span-8 col-span-5">
                           <input type="text" id="ville_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="ville" required autofocus autocomplete="city" v-model="formClient.ville"/>
                           <InputError class="mt-2" :message="formClient.errors.ville" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-3 col-span-4">
                           <label for="ville_client" class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1"> <Flag /> </span> Pays :</label>
                        </div>
                        <div class="sm:col-span-9 col-span-8">
                           <Combobox v-model="formClient.pays">
                              <div class="relative">
                                 <div class="relative w-full cursor-default overflow-hidden rounded-lg bg-transparent text-left shadow-md 
                                 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 
                                 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm">
                                    <ComboboxInput
                                       class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-sm leading-5 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                       :displayValue="(paysOne) => paysOne" @change="query = $event.target.value" 
                                       name="pays" required autofocus />
                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                       <UnfoldMoreHorizontal class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                    </ComboboxButton>
                                 </div>
                                 <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
                                    @after-leave="query = ''">
                                    <ComboboxOptions
                                       class="absolute z-40 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                       <div v-if="filteredPays.length === 0 && query !== ''"
                                          class="relative cursor-default select-none sm:py-2 py-1 sm:px-4 px-2 text-gray-700">
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
                  <div class="col-span-6 z-10 relative py-1 pl-4 pr-4 text-lg rounded bg-primary-100 w-full text-primary-400 flex flex-row items-center">
                     <label for="sameAdresseFact" class=" sm:text-lg text-sm sm:w-11/12 w-10/12">Utiliser cette adresse comme adresse de facturation</label>
                     <div class="sm:w-1/12 w-2/12 flex justify-center">
                        <Switch id="sameAdresseFact" v-model="sameAdresseFact" :class="sameAdresseFact ? 'bg-blue-600' : 'bg-gray-200'" class="relative inline-flex h-6 w-11 items-center rounded-full">
                           <span class="sr-only">Même adresse de facturation</span>
                           <span :class="sameAdresseFact ? 'translate-x-6' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition"></span>
                        </Switch>
                     </div>
                     
                  </div>
               </div>
            </div>
            <div v-if="!sameAdresseFact" class="bg-primary-50 rounded my-5">
               <h2 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 py-1 bg-primary-100 rounded-t-lg w-full">Saisir l'adresse de facturation</h2>
               <div @submit.prevent="submit" class="grid grid-cols-1 gap-4 lg:p-5 sm:p-3 p-1 lg:mx-5 sm:mx-3 mx-2 mt-2" id="form_client">
                  <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="nom_adresse_client"><span class="pr-2"><City /></span> Nom adresse :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="nom_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="nom_adresse" required="" autofocus="" v-model="formClient.nom_adresse_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.nom_adresse_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="adresse_client"><span class="pr-2"><City /></span> Adresse 1 :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse1" required autofocus autocomplete="address-line1" v-model="formClient.adresse1_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse1_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="complement_adresse_client"><span class="pr-2"><City /></span> Adresse 2 :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="complement_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse2" autofocus autocomplete="address-line2" v-model="formClient.adresse2_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse2_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="information_adresse_client"><span class="pr-2"><City /></span> Adresse 3 :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="information_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse3" autofocus autocomplete="address-line3" v-model="formClient.adresse3_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse3_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-2" for="cp_client"><span class="pr-1"><City /></span> Code postal :</label>
                        </div>
                        <div class="2xl:col-span-6 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="cp_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="code_postal" required autofocus autocomplete="postal-code" v-model="formClient.code_postal_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.code_postal_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-5 lg:col-span-3 sm:col-span-4 col-span-7">
                           <label class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ville_client"><span class="pr-2"><City /> </span> Ville :</label>
                        </div>
                        <div class="2xl:col-span-7 lg:col-span-9 sm:col-span-8 col-span-5">
                           <input type="text" id="ville_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="ville" required autofocus autocomplete="city" v-model="formClient.ville_facturation"/>
                           <InputError class="mt-2" :message="formClient.errors.ville_facturation" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="sm:col-span-3 col-span-4">
                           <label for="ville_client" class="sm:text-lg text-sm block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1"> <Flag /> </span> Pays :</label>
                        </div>
                        <div class="sm:col-span-9 col-span-8">
                           <Combobox v-model="formClient.pays_facturation">
                              <div class="relative">
                                 <div class="relative w-full cursor-default overflow-hidden rounded-lg bg-transparent text-left shadow-md 
                                 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 
                                 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm">
                                    <ComboboxInput
                                       class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full sm:py-2 py-1 sm:px-4 px-2 text-sm leading-5 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                                       :displayValue="(paysOne) => paysOne" @change="query = $event.target.value" 
                                       name="pays" required autofocus />
                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                       <UnfoldMoreHorizontal class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                    </ComboboxButton>
                                 </div>
                                 <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
                                    @after-leave="query = ''">
                                    <ComboboxOptions
                                       class="absolute z-40 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                       <div v-if="filteredPays.length === 0 && query !== ''"
                                          class="relative cursor-default select-none sm:py-2 py-1 sm:px-4 px-2 text-gray-700">
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

            <div class="flex flex-row-reverse">
               <button :class="{ 'opacity-25': formClient.processing }" :disabled="formClient.processing" type="submit" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">
                  Valider
               </button>
            </div>
      </form>
</template>

<style>
/* Scale animation */
@keyframes scale {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}

/* Hover animation */
.animation-button:hover {
  animation: scale 0.3s ease-in-out;
}
</style>