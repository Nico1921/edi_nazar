<script setup>
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { createApp, onMounted,ref } from 'vue';
import {TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,} from '@headlessui/vue';
import DetailsDesign from '@/Components/DetailsDesign.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { HomeIcon,ListBulletIcon,BackspaceIcon, ArrowLeftIcon  } from '@heroicons/vue/24/solid';

const props = defineProps(["products","gamme","dimensions"]);
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
      title: 'Gamme',
      link: '/order_entrepot/gamme',
      icon: '',
      active: false
   },{
      title: props.gamme.nom_gamme,
      link: '/order_entrepot/gamme/'+props.gamme.nom_gamme,
      icon: '',
      active: true
}];

const isOpen = ref(false);
var productsSearch = ref(props.products.data);
var products = ref(props.products);
var clientUser = ref(usePage().props.value.auth.user[0].client);
var countP = 0;

var classVariant = {
   'default' : "col-span-12 mx-6 relative inline-block  text-sm text-gray-500 whitespace-nowrap mt-4 before:-mt-[1.8rem] before:border-r-solid before:content-[''] before:block before:absolute before:w-0 before:h-0 before:border-l-[30px] before:border-l-transparent before:border-l-solid before:border-r-[30px] before:border-r-transparent  before:border-b-[30px] before:border-b-gray-100",
   'base1' : "before:xl:right-[85%] before:lg:right-[80%] before:sm:right-[70%] before:right-[50%]",
   'base2' : "before:xl:right-[60%] before:lg:right-[45%] before:sm:right-[15%] before:right-[50%]",
   'base3' : "before:xl:right-[35%] before:lg:right-[10%] before:sm:right-[15%] before:right-[50%]",
   'base4' : "before:xl:right-[5%] before:lg:right-[45%] before:sm:right-[15%] before:right-[50%]",
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
   
   const parsedUrl = new URL(window.location.href);
   parsedUrl.searchParams.delete('filter[global]');
   var per = parsedUrl.searchParams.get('perPage');
   parsedUrl.searchParams.delete('perPage');
   var page = parsedUrl.searchParams.get('page');
   parsedUrl.searchParams.delete('page');
   var urlBase = parsedUrl.href+'/search';
   parsedUrl.href = urlBase;
   console.log(urlBase);
   parsedUrl.searchParams.set('filter[global]',e.target.value);
   if(per != '' && per  != undefined){
      parsedUrl.searchParams.set('perPage',per);
   }
   if(page != '' && page != undefined){
      parsedUrl.searchParams.set('page',page);
   }
   var url = parsedUrl.href;
   axios.post(url).then((response)=>{
      if(response.status == 200){
         const parsedUrl = new URL(window.location.href);
         parsedUrl.searchParams.set('filter[global]',e.target.value);
         productsSearch.value = response.data.products.data;
         products.value = response.data.products;
            window.history.replaceState('','',parsedUrl.href);
      }
   })
};

function closeModal() {
  isOpen.value = false;
}

function openModal(img,gamme,design,couleur) {
  countP = -1;
  isOpen.value = true;
  var nomProduit = gamme+" "+design+" "+couleur;
  document.getElementById("visuelImage").setAttribute('src','https://gestion.tapis-nazar.fr/img/produit/'+img);
  document.getElementById("visuelImage").setAttribute('alt',nomProduit);
  document.getElementById("nomVisuelImage").textContent = nomProduit;
};

const getCountP = () => {
   if(countP == 4){
      countP = 1;
   }else{
      countP++;
   }
   return countP;
}

const getVariant = (idDesign) => {
   if (idDesign != "" && idDesign != null) {
      var checkExist = document.getElementById("tab_idDesign" + idDesign);
      var keyCheck = checkExist.dataset.positiontab;
      var checkExist = checkExist.nextSibling;
      if (checkExist.id != "viewDetailsDesign") {
         axios.post('/order_entrepot/gamme/design', { id_design: idDesign }).then((response) => {
            if (response.status == 200) {
               if (document.getElementById("viewDetailsDesign") != null) {
                  if (document.getElementById("viewDetailsDesign").__vue_app__ != undefined) {
                     document.getElementById("viewDetailsDesign").__vue_app__.unmount();
                  }
                  document.getElementById("viewDetailsDesign").remove();
               }

               var detailsDesign = createApp(DetailsDesign, { designs: response.data });
               var trNew = document.createElement('div');
               trNew.id = "viewDetailsDesign";
               trNew.dataset.idDesign = idDesign;
               var classChoix = classVariant.base1;
               if(keyCheck == 2 ){
                  classChoix = classVariant.base2;
               }else if(keyCheck == 3 ){
                  classChoix = classVariant.base3;
               }else if(keyCheck == 4){
                  classChoix = classVariant.base4;
               }
               trNew.classList = classVariant.default +" "+ classChoix;
               document.getElementById("tab_idDesign" + idDesign).parentNode.insertBefore(trNew, document.getElementById("tab_idDesign" + idDesign).nextSibling);
               detailsDesign.mount(document.getElementById("viewDetailsDesign"));
            }
         })
      } else if (checkExist.id == "viewDetailsDesign") {
         if (document.getElementById("viewDetailsDesign").__vue_app__ != undefined) {
            document.getElementById("viewDetailsDesign").__vue_app__.unmount();
         }
         document.getElementById("viewDetailsDesign").remove();
      }
   }
};

const checkIsOnList = () => {
   if (document.getElementById("viewDetailsDesign") != null) {
      var dataId = document.getElementById("viewDetailsDesign").dataset.idDesign;
      var check = document.getElementById("viewDetailsDesign").previousSibling;
      if (check.id != "tab_idDesign" + dataId) {
         if (document.getElementById("viewDetailsDesign").__vue_app__ != undefined) {
            document.getElementById("viewDetailsDesign").__vue_app__.unmount();
         }
         document.getElementById("viewDetailsDesign").remove();
      }
   }
};

var deletePanier = () =>{
   Swal.fire({
      title: 'Attention',
      text: 'Êtes-vous de vider votre panier ?',
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

const lowercase = (nom) => {
   return HtmlEntities.decode(nom.toLowerCase());
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
}

onMounted(() => {
   var targetNode = document.getElementById('TabProducts');
   var config = { attributes: true, childList: true, subtree: true };
   var observer = new MutationObserver(checkIsOnList);
   observer.observe(targetNode, config);

   var targetNode2 = document.getElementById('per_page');
   targetNode2.value = perPageActual();
   const parsedUrl = new URL(window.location.href);
   var input = document.getElementById("searchGamme");
   input.value = parsedUrl.searchParams.get('filter[global]');
});
</script>
<script >
import Eye from 'icons/EyeOutline.vue';
import ImageOff from 'icons/ImageOff.vue';
import Right from 'icons/ChevronRight.vue';
import Left from 'icons/ChevronLeft.vue';
import Search from 'icons/Magnify.vue';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),
   // Using the shorthand
   layout: AuthenticatedLayout,
};
</script>

<template>

   <Head title="Products" />
   <section class="container mx-auto">
      <Breadcrumbs :links="links" />
      <section class="relative container mx-auto grid grid-cols-12 mb-4">     
         <div class="col-span-2 flex items-end">
            <a href="/order_entrepot/gamme" class="relative inline-block group">
               <ArrowLeftIcon class="h-4 w-4 absolute left-0 bottom-1/4 top-1/4 text-black group-hover:text-primary-300 transition duration-300" /> 
               <span class="inline-block border-b border-black pl-5 group-hover:text-primary-300 group-hover:border-primary-300 transition duration-300">Retourner aux gammes</span>
            </a>
         </div>    
         <div class="flex items-center justify-center col-span-7">
            <h1 class="text-6xl font-bold">{{ props.gamme.nom_gamme }}</h1>
         </div>
         <div class="col-span-3 rounded bg-primary-white border border-primary-100 text-center flex flex-col text-primary-300">
            <span>Tapis {{ (props.gamme.type_tapis == 0 ? 'intérieur' : props.gamme.type_tapis == 1 ? 'extérieur' : 'intérieur / extérieur') }}</span>
            <span>Poils {{ (props.gamme.type_poils == 1 ? 'court' : 'long') }} - {{ (props.gamme.uv_proof == 1 ? 'Résistants aux UV' : 'Non Résistants aux UV') }}</span>
            <span class="capitalize">{{ props.gamme.nom_special }}</span>
            <span>Prix HT m² : {{ calcul_prix_gamme(props.gamme.prix_vente_ht_m2) }} €</span>
         </div>
      </section>

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

      <div class="grid grid-flow-row-dense grid-cols-12 " id="TabProducts">
         <div class="xl:col-span-3 lg:col-span-4 sm:col-span-6 col-span-12" v-for="(produit, key) in productsSearch" :key="key" :data-positiontab="getCountP()" :id="'tab_idDesign' + produit.id_design">
            <div class="grid grid-cols-12 bg-primary-white border border-primary-200 rounded-lg sm:h-48 h-38 mx-6 my-4 p-4">
               <div class="xl:col-span-5 sm:col-span-4 col-span-2 items-stretch justify-center flex sm:h-40 h-full">
                  <div v-if="produit.img_produit != null"
                        class="cursor-pointer relative overflow-hidden bg-gray-200 w-full h-full">
                        <div class="absolute flex items-center justify-center w-full h-full">
                           <Eye class="text-lg text-black" />
                        </div>
                        <img @click="openModal(produit.img_produit,produit.nom_gamme,produit.nom_design,produit.nom_couleur)" :src="'https://gestion.tapis-nazar.fr/img/produit/' + produit.img_produit"
                           :alt="produit.code_sku" class="z-20 relative hover:opacity-50 transition duration-300 w-full h-full object-contain" />
                     </div>
                     <div v-else class="text-3xl h-full w-full flex items-center justify-center bg-gray-300">
                     <ImageOff />
                  </div>
               </div>
               <div class="xl:col-span-7 sm:col-span-8 col-span-10 flex flex-col ml-3">
                  <span class="font-bold xl:text-xl sm:text-lg text-sm text-gray-600">{{ produit.nom_design }}</span>
                  <span class="font-semibold 2xl:text-lg text-sm">Couleur : {{ produit.nom_couleur }}</span>
                  <div class="flex flex-start items-end h-full">
                     <button class="py-2 px-3 h-10 rounded bg-primary-200 hover:bg-primary-50 2xl:text-lg text-sm text-white hover:text-primary-400 transition duration-300" type="button" @click="getVariant(produit.id_design)">Voir les produits</button>
                  </div>
               </div>
            </div>
         </div>
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

   <TransitionRoot :show="isOpen" as="template" :unmount="false" >
    <Dialog as="div" @close="closeModal" class="relative z-30" :unmount="false">
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
            :unmount="false"
          >
            <DialogPanel
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all" :unmount="false"
            >
              <DialogTitle :unmount="false"
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
              >
                Visuel image <span id="nomVisuelImage"></span>
              </DialogTitle>
              <div class="mt-2 h-[40rem] w-full">
                  <img id="visuelImage" class="w-full h-full object-cover" />
              </div>
              <div class="flex flex-row-reverse">
                  <button type="button" class="mt-4 inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300"
                   @click="closeModal" >Fermer</button>
               </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

