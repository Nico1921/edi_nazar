<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref, computed, onMounted, createApp } from 'vue';
import ModalImportMKP from '@/Components/ModalImportMKP.vue';
import InputError from '@/Components/InputError.vue';
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from '@headlessui/vue';
const templateVierge = new URL('../../../../../fichiers/templates/Drop/Template_Vierge_Drop.xlsx', import.meta.url).href;
const templateModele = new URL('../../../../../fichiers/templates/Drop/Template_Model_Drop.xlsx', import.meta.url).href;

const props = defineProps(['panier']);

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

let fileExist = ref(false);

var fileImport = (input)=>{
   if(input.target.value == ''){
      document.getElementById("file_name_client").innerText = "";
      document.getElementById("file_name_span_client").classList.add("hidden");
      fileExist.value = false;
   }else{
      document.getElementById("file_name_client").innerText = input.target.files[0].name;
      document.getElementById("file_name_span_client").classList.remove("hidden");     
      fileExist.value = true;
   }
};

var clickResetInputFile = ()=>{
   document.getElementById("file_import_clients").value = null;
   document.getElementById("file_name_client").innerText = "";
   document.getElementById("file_name_span_client").classList.add("hidden");
   fileExist.value = false;
};

var getDateNow = ()=>{
   var date = new Date();
   // Get year, month, and day part from the date
   var year = date.toLocaleString("default", { year: "numeric" });
   var month = date.toLocaleString("default", { month: "2-digit" });
   var day = date.toLocaleString("default", { day: "2-digit" });

   // Generate yyyy-mm-dd date string
   var formattedDate = year + "-" + month + "-" + day;
   return formattedDate;
}

const formClient = useForm({
    nom: '',
    prenom: '',
    email: '',
    tel: '',
    nom_adresse: '',
    adresse1: '',
    adresse2: '',
    adresse3: '',
    code_postal: '',
    ville: '',
    pays: ref(pays[10]),
});

const submit = () => {
   formClient.post(route('orders/clients'), {
      onSuccess: (e) => {
           if(e.props.statusPanier == true){
            document.location.href = "/orders/clients/products";
           }else if(e.props.statusPanier == false){
            Toast.fire({
               icon: 'error',
               title: 'Une erreur s\'est produite lors de la création du client, veuillez ressayer !'
            })
           }
      },
   });
};

const submit_file = () => {
   var form = new FormData(document.getElementById('fileClientImport'));
   axios.post('/orders/clients/import',form).then((response) => {
      console.log(response);
      if(response.status){
         if (document.getElementById("modalImport") != null) {
            if (document.getElementById("modalImport").__vue_app__ != undefined) {
               document.getElementById("modalImport").__vue_app__.unmount();
            }
         }
         var data = response.data;
         var modalImportMKP = createApp(ModalImportMKP, { isOpen: true,importMKP: data.importCommandes,reussi: data.valider,erreur: data.erreur,
            qteFinal: data.qteFinal,m2Final: data.m2Final, prixHT_TT: data.prixHT_TT, prixTVA_TT: data.prixTVA_TT, prixTTC_TT: data.prixTTC_TT, stockInvalide: data.stockInvalide });
            modalImportMKP.mount(document.getElementById("modalImport"));
      }else{
         Toast.fire({
            icon: 'error',
            title: 'Une erreur s\'est produite lors de l\'importation de votre fichier, veuillez vérifier que votre fichier correspond bien à l\'exemple fournis puis ressayer !'
         });
      }
   });
};


onMounted(() => {
   if (document.getElementById("modalImport") != null) {
      if (document.getElementById("modalImport").__vue_app__ != undefined) {
         document.getElementById("modalImport").__vue_app__.unmount();
      }
   }
});
</script>
<script>
import { UserIcon,UserGroupIcon } from '@heroicons/vue/24/outline';
import User from 'icons/Account.vue';
import UnfoldMoreHorizontal from 'icons/UnfoldMoreHorizontal.vue';
import Excel from 'icons/MicrosoftExcel.vue';
import Check from 'icons/Check.vue'; 
import Close from 'icons/Close.vue'; 
import Phone from 'icons/Phone.vue'; 
import City from 'icons/HomeCity.vue'; 
import Flag from 'icons/Flag.vue'; 
import Mail from 'icons/Email.vue'; 
import Back from 'icons/ArrowLeftThin.vue'; 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),
   // Using the shorthand
   layout: AuthenticatedLayout,
};
</script>

<template>

   <Head title="Orders Clients" />
   
   <section class="container mx-auto mt-5">
      <div class="relative py-5 ">
         <div v-if="props.panier != undefined" class="flex flex-col justify-center">
            <h1 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg  text-primary-300">Ajouter commande pour un client</h1>
            <span class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300">Ajout à la commande {{props.panier.num_commande}}</span>
         </div>
         <div v-else>
            <h1 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300">Création d'une commande pour un client</h1>
         </div>
      </div>
      <div class="grid grid-cols-4">
         <div :class="(props.panier == undefined ? 'lg:col-span-2 xl:mr-6 col-span-4' : 'col-span-4')">
            <div class="flex flex-col items-center justify-center">
               <UserIcon class="xl:h-52 lg:h-36 sm:h-32 h-24 w-full stroke-1" />
               <h2 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 py-1">J'ai une commande</h2>
               <span class="text-center sm:text-lg text-sm">remplissez manuellement les informations ci-dessous</span>
            </div> 
            <form @submit.prevent="submit" class="grid grid-cols-2 p-4" id="form_client">
               <div class="bg-primary-50 px-4 py-4 col-span-2 grid grid-cols-2">
                  <h3 class="text-lg font-semibold col-span-2"><User /> Général : </h3>
                  <div class="col-span-2 grid grid-cols-6 py-4 mx-2">
                     <div class="col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-5 sm:col-span-4 col-span-5">
                           <label for="prenom_client" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span
                              class="inline-flex left-3 items-center justify-items-center justify-center ">
                              <User />
                           </span> Prénom :</label>
                        </div>
                        <div class="2xl:col-span-7 sm:col-span-8 col-span-7">
                           <input type="text" id="prenom_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                           name="prenom" required autofocus autocomplete="given-name" v-model="formClient.prenom"/>
                           <InputError class="mt-2" :message="formClient.errors.prenom" />
                        </div>
                     </div>
                     <div class="col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-4 sm:col-span-4 col-span-5">
                           <label for="nom_client" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span
                                 class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4">
                                 <User />
                           </span> Nom :</label>
                        </div>
                        <div class="2xl:col-span-8 sm:col-span-8 col-span-7">
                        <input type="text" id="nom_client"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                           name="nom" required autofocus autocomplete="family-name" v-model="formClient.nom"/>
                        <InputError class="mt-2" :message="formClient.errors.nom" />
                        </div>
                     </div>
                     <div class="col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-5 sm:col-span-4 col-span-5">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="mail_client"><span class="pr-2"><Mail /></span> E-Mail :</label>
                        </div>
                        <div class="2xl:col-span-7 sm:col-span-8 col-span-7">
                           <input type="text" id="mail_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                              name="email" required="" autofocus="" autocomplete="email" v-model="formClient.email"/>
                           <InputError class="mt-2" :message="formClient.errors.email" />
                        </div>
                     </div>
                     <div class="col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-6 sm:col-span-4 col-span-6">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="tel_client"><span class="mr-2"><Phone /> </span> Téléphone :</label>
                        </div>
                        <div class="2xl:col-span-6 sm:col-span-8 col-span-6">
                           <input type="text" id="tel_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                              name="tel" required="" autofocus="" autocomplete="tel" v-model="formClient.tel"/>
                           <InputError class="mt-2" :message="formClient.errors.tel" />
                        </div>
                     </div>
                  </div>

                  <h3 class="col-span-2 text-lg font-semibold"><City /> Adresse de livraison : </h3>
                  <div class="col-span-2 grid grid-cols-6 py-4 mx-2">
                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="nom_adresse_client"><span class="pr-2"><City /></span> Nom adresse :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="nom_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="nom_adresse" required="" autofocus="" v-model="formClient.nom_adresse"/>
                           <InputError class="mt-2" :message="formClient.errors.nom_adresse" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="adresse_client"><span class="pr-2"><City /></span> Adresse 1 :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse1" required autofocus autocomplete="address-line1" v-model="formClient.adresse1"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse1" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="complement_adresse_client"><span class="pr-2"><City /></span> Adresse 2 :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="complement_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse2" autofocus autocomplete="address-line2" v-model="formClient.adresse2"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse2" />
                        </div>
                     </div>

                     <div class="col-span-6 flex text-lg pb-2 grid grid-cols-12">
                        <div class="2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="information_adresse_client"><span class="pr-2"><City /></span> Adresse 3 :</label>
                        </div>
                        <div class="2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5">
                           <input type="text" id="information_adresse_client"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0"
                              name="adresse3" autofocus autocomplete="address-line3" v-model="formClient.adresse3"/>
                           <InputError class="mt-2" :message="formClient.errors.adresse3" />
                        </div>
                     </div>

                     <div class="col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2">
                        <div class="2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="cp_client"><span class="pr-2"><City /></span> Code postal :</label>
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
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ville_client"><span class="pr-2"><City /> </span> Ville :</label>
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
                           <label for="ville_client" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"><span class=" inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1"> <Flag /> </span> Pays :</label>
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
                           <InputError class="mt-2" :message="formClient.errors.pays" />
                        </div>
                     </div>
                  </div>
               </div>
               

               <div class="flex items-center justify-center relative col-span-2 py-1  text-lg text-center w-full py-5">
                  <button type="submit" class="py-2 px-4 rounded-lg text-gray-500 bg-primary-50 hover:bg-primary-100 transition duration-300">Je valide ma commande manuel</button>
               </div>
            </form>
         </div>

         <div class="absolute h-96 left-2/4 right-2/4 top-2/4 bottom-2/4 lg:flex hidden items-center justify-center" v-if="props.panier == undefined">
            <hr class="block w-1 h-96 border" />
         </div>

         <div class="lg:col-span-2 col-span-4 xl:ml-6 " v-if="props.panier == undefined">
            <div class="flex flex-col items-center justify-center">
               <UserGroupIcon class="xl:h-52 lg:h-36 sm:h-32 h-24 w-full stroke-1" />
               <h2 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 py-1">J'ai plusieurs commandes</h2>
               <span class="text-center sm:text-lg text-sm">remplissez la template puis importez la</span>
            </div>  
            <form id="fileClientImport" @submit.prevent="submit_file" class="p-4 flex flex-col">
            <div class="bg-primary-50 flex flex-col p-4">
               <span class="text-primary-500 py-5">Je télécharge le modèle d'exemple : <a :href="templateModele" class="mt-1 text-sm text-white underline hover:text-gray-200 transition duration-300">Télécharger l'exemple</a></span>
               <span class="text-primary-500 py-5">Je télécharge la template vierge : <a :href="templateVierge" class="mt-1 text-sm text-white underline hover:text-gray-200 transition duration-300">Télécharger la template</a></span>
               <span  class="text-primary-500 py-5 w-full flex">
                  J'importe mon fichier ici :  
                  <div class="grid grid-cols-4 pl-2" >
                     <div :class="fileExist ? 'relative col-span-4' : 'relative col-span-4'">
                        <label class="block cursor-pointer text-white underline hover:text-gray-200 transition duration-300" for="file_import_clients">J'importe mon fichier au format .xls ou .xlsx <Excel /></label>
                        <span class="hidden" id="file_name_span_client"><button type="button" @click="clickResetInputFile"><Close /></button><span id="file_name_client"></span></span>
                        <input @change="fileImport" type="file" class="hidden" id="file_import_clients" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="fileImport"/>
                     </div>
                  </div>   
               </span>
               </div>
               <div class="flex items-center justify-center relative col-span-2 py-1  text-lg text-center w-full py-5">
                  <button v-if="fileExist" type="submit" class="py-2 px-4 rounded-lg text-gray-500 bg-primary-50 hover:bg-primary-100 transition duration-300">Je valide ma commande par fichier</button>
                  <button v-if="!fileExist" disabled type="submit" class="py-2 px-4 rounded-lg  disabled:text-gray-200 disabled:bg-primary-50 transition duration-300">Je valide ma commande par fichier</button>
               </div>
            </form>
         </div>
      </div>
      

   </section>

   <div id="modalImport"></div>
   <div id="productClientView"></div>
</template>