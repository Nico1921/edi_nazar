<script setup>
import { Head, usePage,useForm } from '@inertiajs/inertia-vue3';
import { ref, onMounted } from 'vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { HomeIcon,ListBulletIcon  } from '@heroicons/vue/24/solid';
import InputError from '@/Components/InputError.vue';
    
var links = [{
        title: 'Accueil',
        link: '/',
        icon: HomeIcon,
        active: false
    },{
      title: 'Commande Entrepôt',
      link: '/order_entrepot/gamme',
      icon: ListBulletIcon,
      active: false
   },{
      title: 'Gammes',
      link: '/order_entrepot/gamme',
      icon: '',
      active: true
}];

const templateVierge = new URL('../../../../fichiers/templates/Commercial/Template_Vierge_Com.xlsx', import.meta.url).href;
const templateModele = new URL('../../../../fichiers/templates/Commercial/Template_Model_Com.xlsx', import.meta.url).href;
const props = defineProps(["products","dimensions"]);

var products = ref(props.products);

let fileExist = ref(false);
var typeVente = ref(usePage().props.value.session.typeVente);

var formFileImport = useForm({
   fileImport: null
});

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
   document.getElementById("file_import_cart").value = null;
   document.getElementById("file_name_client").innerText = "";
   document.getElementById("file_name_span_client").classList.add("hidden");
   fileExist.value = false;
};

const submit_file = () => {
   formFileImport.post('/order_entrepot/panier/import',{
            onError : (e) => {
               Toast.fire({
               icon: 'error',
               title: 'Une erreur s\'est produite lors de l\'importation de votre fichier, veuillez vérifier que votre fichier correspond bien à l\'exemple fournis puis ressayer !'
            });
   }});

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
   var url = '/order_entrepot/gamme?filter[nom_gamme]='+e.target.value;
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

/*
var calcul_prix_gamme = (prix_gamme) => {
   var HT = prix_gamme;
   if(clientUser.value.taux_remise > 0){
      HT = HT - ((HT) * (clientUser.value.taux_remise /100));
   }
   return roundNumber(HT);
}
*/
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
         Inertia.post('/cart/empty',{}, {
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

   <Head title="Produits" />
   <section class="container mx-auto mt-5">
      <Breadcrumbs :links="links" />
      <div class="flex lg:flex-row flex-col items-center justify-center relative pb-10">
         <h1 class="font-semibold text-center mx-1 lg:text-2xl text-lg text-gray-800 py-2">Commande Entrepôt - Gammes</h1>

         <div v-if="typeVente == 1" class="lg:absolute inset-0 lg:flex items-center justify-end">
            <div class="">
               <form id="fileCartImport" class="grid grid-cols-4 max-w-[21rem]" @submit.prevent="submit_file">
                  <div class="relative lg:mx-2 mx-1 flex flex-col max-w-sm" :class="fileExist ? 'col-span-3' : ' col-span-4'">
                     <label class="block text-sm cursor-pointer text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300 px-2 py-2 rounded-xl" for="file_import_cart">Importer fichier de commandes <Excel /></label>
                     <span class="hidden whitespace-nowrap truncate" id="file_name_span_client"><button type="button" @click="clickResetInputFile"><Close /></button><span id="file_name_client"></span></span>
                     <input @input="formFileImport.fileImport = $event.target.files[0]"  @change="fileImport" type="file" class="hidden" id="file_import_cart" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="fileImport"/>
                     <span class="mt-1 ml-1 text-sm text-gray-500"><a :href="templateVierge" class="mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300">Template vierge</a> / <a :href="templateModele" class="mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300">Modèle</a></span>
                     <InputError class="mt-2" :message="formFileImport.errors.fileImport" />
                  </div>
                  <div class="col-span-1" v-if="fileExist">
                     <button :class="{ 'opacity-25': formFileImport.processing }" :disabled="formFileImport.processing" type="submit" class="px-2 py-2 rounded-xl text-sm text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300">Importer !</button>
                  </div>
               </form>       
            </div>
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
         <a v-for="(produit, key) in products.data" :key="key" :href="'/order_entrepot/gamme/'+lowercase(produit.nom_gamme)" class="z-30 lg:col-span-1 col-span-2 group p-4 hover:scale-110 transition-full duration-300 cursor-pointer">
            <div class="relative group z-20">
               <div v-if="produit.img_gamme != null" class="relative w-full lg:h-60 sm:h-52 h-40 z-20">
                  <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + produit.img_gamme"
                        :alt="produit.nom_gamme" 
                        class="z-20 rounded relative  w-full h-full object-cover" />
               </div>
               <div v-else class="relative w-full h-60">
                  <span>Pas de photo pour cette gamme !</span>
               </div>

               <div class="absolute bottom-0 z-30 w-full overflow-hidden text-sm">
                 <div class="max-h-0 group-hover:max-h-60  rounded group-hover:p-1 transition-full duration-500 bg-primary-300 text-center flex flex-col  sm:bg-opacity-70 text-white z-30">
                  <span>Tapis {{ (produit.type_tapis == 0 ? 'intérieur' : produit.type_tapis == 1 ? 'extérieur' : 'intérieur / extérieur') }}</span>
                  <span>Poils {{ (produit.type_poils == 1 ? 'court' : 'long') }} - {{ (produit.uv_proof == 1 ? 'Résistants aux UV' : 'Non Résistants aux UV') }}</span>
                  <span class="capitalize">{{ lowercase(produit.nom_special) }}</span>
                  <div class="flex flex-wrap items-center justify-center text-center lg:px-4 px-0 py-2">
                     <span v-for="(dimension, key) in find_dimensions(produit.id_gamme)" :key="key" class="block text-center w-auto lg:px-1">
                         {{ (!Number.isInteger(key/3) && key != 0 ? ' - ' : '') }} {{ dimension.largeur }}x{{ dimension.longueur }}cm
                     </span>
                  </div>
                  <span>Prix HT m² : {{ produit.prix_vente_ht_m2_remise?produit.prix_vente_ht_m2_remise:produit.prix_vente_ht_m2 }} €</span>
                 </div>
                  
               </div>
            </div>

            <div>
               <h2 class="capitalize text-center font-semibold">Collection {{ lowercase(produit.nom_gamme) }}</h2>
            </div>
         </a>
      </div>

      <div class="grid grid-cols-4 justify-center items-center bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 xl:px-6">
         <div class="lg:col-span-1 sm:col-span-2 col-span-4 sm:text-start text-center">
            <select id="per_page" name="per_page" dusk="per-page-full" @change="perPage" class="xl:mr-5 mr-2 focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md">
               <option value="8">8 par page</option>
               <option value="12" >12 par page</option>
               <option value="18" >18 par page</option>
               <option value="50" >50 par page</option>
               <option value="100">100 par page</option>
            </select>
            <span>Page {{ products.current_page }} sur {{ products.last_page }}</span>
         </div>
         <span class="lg:col-span-2 sm:col-span-2 col-span-4 lg:text-center sm:text-end text-center sm:my-0 my-2">{{ products.total }} Résultats</span>
         <div class="flex lg:justify-end justify-center lg:col-span-1 col-span-4">
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
</template>

