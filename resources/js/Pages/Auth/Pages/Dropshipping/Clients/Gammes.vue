<script setup>
import { Head, usePage, useForm } from '@inertiajs/inertia-vue3';
import { ref, onMounted, watchEffect,createApp } from 'vue';
import ListClients from '@/Components/ListClients.vue';
import ModalImportMKP from '@/Components/ModalImportMKP.vue';
import ModalAjoutClient from '@/Components/ModalAjoutClient.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { HomeIcon,ListBulletIcon  } from '@heroicons/vue/24/solid';
    
var links = [{
        title: 'Accueil',
        link: '/',
        icon: HomeIcon,
        active: false
    },{
      title: 'Dropshipping',
      link: '/dropshipping/gamme',
      icon: ListBulletIcon,
      active: false
   },{
      title: 'Gamme',
      link: '/dropshipping/gamme',
      icon: '',
      active: true
   }];
const templateVierge = new URL('../../../../../../fichiers/templates/Drop/Template_Vierge_Drop.xlsx', import.meta.url).href;
const templateModele = new URL('../../../../../../fichiers/templates/Drop/Template_Model_Drop.xlsx', import.meta.url).href;
const props = defineProps(['products','dimensions', 'produitsAchat']);
const isOpen = ref(false);

var products = ref(props.products);
var dynamic = ref(usePage().props.value.dynamique_client);

var clientUser = ref(usePage().props.value.auth.user[0].client);

let fileExist = ref(false);
var typeVente = ref(usePage().props.value.session.typeVente);
var panierDrop = ref(usePage().props.value.PanierDrop);
var client = ref(panierDrop.value.panier.clientActuel);

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

const submit_file = () => {
   var form = new FormData(document.getElementById('fileClientImport'));
   axios.post('/dropshipping/clients/import',form).then((response) => {
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

const lowercase = (nom) => {
   return HtmlEntities.decode(nom.toLowerCase());
};


const find_dimensions = (id_gammes) => {
   return props.dimensions.filter(({ id_gamme }) => id_gamme === id_gammes) 
};

var classPaginate = {
   'previous' : 'text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium',
   'previous_disabled' : 'cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium',
   'next' : 'text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium',
   'next_disabled' : 'cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium',
   'number' : 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50',
   'number_active' : 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 bg-gray-100'
}

var perPage = () => {
   const parsedUrl = new URL(window.location.href);
   var targetNode = document.getElementById('per_page');
   parsedUrl.searchParams.set('perPage',targetNode.value);
   window.location.href = parsedUrl.href;
};

var perPageActual = () => {
   const parsedUrl = new URL(window.location.href);
   if(parsedUrl.searchParams.get('perPage') != null ){
      return parsedUrl.searchParams.get('perPage');
   }else{
      return 12;
   }
};

var searchGamme = (e) => {
   var url = '/dropshipping/gamme?filter[nom_gamme]='+e.target.value;
   axios.post(encodeURI(url)).then((response)=>{
      if(response.status == 200){
         const parsedUrl = new URL(window.location.href);
         parsedUrl.searchParams.set('filter[nom_gamme]',e.target.value);
            products.value = response.data.products;
            window.history.replaceState('','',parsedUrl.href);
      }
   })
};

var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};

var calcul_prix_gamme = (prix_gamme) => {
   var HT = prix_gamme;
   if(clientUser.value.taux_remise > 0){
      HT = HT - ((HT) * (clientUser.value.taux_remise /100));
   }
   return roundNumber(HT);
};

var deletePanier = () =>{
   Swal.fire({
      title: 'Attention',
      text: 'Êtes-vous de vouloir vider votre panier ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
         Inertia.post('/dropshipping/panier/empty',{}, {
            preserveScroll: true,
            onSuccess: (e) => {
               console.log(e);
               if(e.props.session.status){
                  Toast.fire({
                     icon: 'success',
                     title: 'Le panier a bien été vider !'
                  });
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur est survenue, pour vider votre panier, vous pouvez aussi vous déconnecter et vous reconnecter.'
                  });
               }
               
            },
         });
      }
   });
};

onMounted(() => {
   var targetNode = document.getElementById('per_page');
   targetNode.value = perPageActual();
   const parsedUrl = new URL(window.location.href);
   var input = document.getElementById("searchGamme");
   input.value = parsedUrl.searchParams.get('filter[nom_gamme]');
   if (document.getElementById("modalImport") != null) {
      if (document.getElementById("modalImport").__vue_app__ != undefined) {
         document.getElementById("modalImport").__vue_app__.unmount();
      }
   }
});

watchEffect(() => {
   dynamic.value = usePage().props.value.dynamique_client;
   panierDrop.value = usePage().props.value.PanierDrop;
   client.value = panierDrop.value.panier.clientActuel;
});
</script>
<script >
import Right from 'icons/ChevronRight.vue';
import Left from 'icons/ChevronLeft.vue';
import Close from 'icons/Close.vue';
import Search from 'icons/Magnify.vue';
import Excel from 'icons/MicrosoftExcel.vue';
import {BackspaceIcon} from '@heroicons/vue/24/outline';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),
   // Using the shorthand
   layout: AuthenticatedLayout,
};
</script>

<template>

   <Head title="Products" />
   <section class="container mx-auto mt-5">
      <Breadcrumbs :links="links" />

      <div class="flex lg:flex-row flex-col items-center justify-center relative pb-10">
         <h1 class="font-semibold text-center mx-1 lg:text-2xl text-lg text-gray-800 py-2">Dropshipping  - Gamme</h1>

         <div v-if="typeVente == 2" class="lg:absolute inset-0 lg:flex items-center justify-end">
            <div class="">
               <form id="fileClientImport" class="grid grid-cols-4 max-w-[21rem]" @submit.prevent="submit_file">
                  <div class="relative lg:mx-2 mx-1 flex flex-col max-w-sm" :class="fileExist ? 'col-span-3' : ' col-span-4'">
                     <label class="block text-sm cursor-pointer text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300 px-2 py-2 rounded-xl" for="file_import_clients">Importer fichier de commandes <Excel /></label>
                     <span class="hidden whitespace-nowrap truncate" id="file_name_span_client"><button type="button" @click="clickResetInputFile"><Close /></button><span id="file_name_client"></span></span>
                     <input @change="fileImport" type="file" class="hidden" id="file_import_clients" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="fileImport"/>
                     <span class="mt-1 ml-1 text-sm text-gray-500"><a :href="templateVierge" class="mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300">Template vierge</a> / <a :href="templateModele" class="mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300">Modèle</a></span>
                  </div>
                  <div class="col-span-1" v-if="fileExist">
                     <button type="submit" class="px-2 py-2 rounded-xl text-sm text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300">Importer !</button>
                  </div>
               </form>       
            </div>
         </div>
      </div>

      <div class="flex justify-between">
         <div v-if="client != undefined " class="flex items-center px-2 py-1 bg-primary-50 rounded">
            <h3 class="text-lg text-gray-600 mr-2">Commande client N° :</h3>
            <div v-if="client.id_client_edi != undefined" class="flex justify-between ">
               <ListClients  v-if="client.id_client_edi != undefined" :data="panierDrop.panier" />
            </div>
            
         </div>

         <div class=" px-2 bg-primary-50 hover:scale-110 transition duration-300 rounded h-auto flex items-center justify-center">
            <ModalAjoutClient />
         </div>
      </div>
      

      <div class="mx-1 my-1 flex sm:flex-row flex-col w-auto sm:flex-grow order-1 sm:order-2 mb-2 sm:mb-0 ">
         <div class="relative flex-grow">
            <input class="block w-full pl-9 text-sm rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300" 
            placeholder="Recherche..." id="searchGamme" type="text" name="global" @input="searchGamme">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
               <Search class="text-xl mb-1" />
            </div>
         </div>
         <div class="sm:w-auto w-full sm:pl-2 pl-0 sm:pt-0 pt-2">
            <button type="button" @click="deletePanier" class="sm:w-auto w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"><BackspaceIcon class="w-5 h-5 mr-2" />Vider mon panier</button>
         </div>
      </div>

      <div class="grid grid-cols-4" id="gammes">
         <a v-for="(produit, key) in products.data" :key="key" :href="'/dropshipping/gamme/'+lowercase(produit.nom_gamme)" class="col-span-1 group p-4 hover:scale-110 transition-full duration-300 cursor-pointer">
            <div class="relative group">
               <div v-if="produit.img_gamme != null" class="relative w-full h-60">
                  <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + produit.img_gamme"
                        :alt="produit.nom_gamme" 
                        class="z-20 rounded relative  w-full h-full object-cover" />
               </div>
               <div v-else class="relative w-full h-60">
                  <span>Pas de photo pour cette gamme !</span>
               </div>

               <div class="absolute bottom-0 z-30 w-full overflow-hidden">
                 <div class="max-h-0 group-hover:max-h-60 group-hover:p-1 transition-full duration-500 bg-primary-300 text-center flex flex-col  bg-opacity-70 text-white">
                  <span>Tapis {{ (produit.type_tapis == 0 ? 'intérieur' : produit.type_tapis == 1 ? 'extérieur' : 'intérieur / extérieur') }}</span>
                  <span>Poils {{ (produit.type_poils == 1 ? 'court' : 'long') }} - {{ (produit.uv_proof == 1 ? 'Résistants aux UV' : 'Non Résistants aux UV') }}</span>
                  <span class="capitalize">{{ lowercase(produit.nom_special) }}</span>
                  <div class="flex flex-wrap items-center justify-center text-center px-4 py-2">
                     <span v-for="(dimension, key) in find_dimensions(produit.id_gamme)" :key="key" class="block text-center w-auto px-1">
                         {{ (!Number.isInteger(key/3) && key != 0 ? ' - ' : '') }} {{ dimension.largeur }}x{{ dimension.longueur }}cm
                     </span>
                  </div>
                  <span>Prix HT m² : {{ calcul_prix_gamme(produit.prix_vente_ht_m2) }} €</span>
                 </div>
                  
               </div>
            </div>

            <div>
               <h2 class="capitalize text-center font-semibold">Collection {{ lowercase(produit.nom_gamme) }}</h2>
            </div>
         </a>
      </div>

      <div class="flex justify-center items-center bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
         <div class="w-1/3">
            <select id="per_page" name="per_page" dusk="per-page-full" @change="perPage" class="mr-5 focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md">
               <option value="8">8 par page</option>
               <option value="12" >12 par page</option>
               <option value="18" >18 par page</option>
               <option value="50" >50 par page</option>
               <option value="100">100 par page</option>
            </select>
            <span>Page {{ products.current_page }} sur {{ products.last_page }}</span>
         </div>
         
         
         <span class="w-1/3 text-center">{{ products.total }} Résultats</span>
         <div class="flex justify-end w-1/3">
            <nav class="relative z-0 inline-flex  rounded-md shadow-sm -space-x-px" aria-label="Pagination">
               <a v-for="(link, key) in products.links" :key="key"
               :class="(key != 0 && key+1 != products.links.length ? (link.active ? classPaginate.number_active : classPaginate.number) : (key == 0 ? (products.current_page == 1 ? classPaginate.previous_disabled : classPaginate.previous) : (products.current_page == products.last_page ? classPaginate.next_disabled : classPaginate.next)))" 
               :href="link.url">
                  <span v-if="key != 0 && key+1 != products.links.length">{{ link.label }}</span>
                  <Right v-if="key+1 == products.links.length" />
                  <Left v-if="key == 0"/>
               </a>
            </nav>
         </div>
       </div>
      
   </section>

   <div id="modalImport"></div>
   <div id="productClientView"></div>
</template>

