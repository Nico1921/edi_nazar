<script setup>
import { Head, usePage, useForm, } from '@inertiajs/inertia-vue3';
import { createApp,ref, watchEffect } from 'vue';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';
import { HomeIcon,ListBulletIcon,ArrowLeftIcon  } from '@heroicons/vue/24/solid';
import { ArrowRightCircleIcon  } from '@heroicons/vue/24/outline';
import Tooltip from '@/Components/Tooltip.vue';
import DetailsDesign from '@/Components/DetailsDesignAction.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import InputError from '@/Components/InputError.vue';
import ListClients from '@/Components/ListClients.vue';
import ModalAjoutClient from '@/Components/ModalAjoutClient.vue';
import {decode} from 'html-entities';

const props = defineProps(["products","gamme","designpanier"]);
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
      active: false
   },{
      title: props.gamme.nom_gamme,
      link: '/dropshipping/gamme/'+props.gamme.nom_gamme,
      icon: '',
      active: true
}];

var dynamic = ref(usePage().props.value.dynamique_client);
var panierDrop = ref(usePage().props.value.PanierDrop);
var client = ref(panierDrop.value.panier.clientActuel);
var productsSearch = ref(props.products.data);
var products = ref(props.products);
var designpanier = ref(props.designpanier);
var produitAdd = ref(false);
var countP = 0;
var clientUser = ref(usePage().props.value.auth.user[0].client);
const isOpen = ref(false);
const isOpenAddRef = ref(false);
const isOpenAdd = ref(false);
var formAddProduit = useForm({
   idProduit: null,
   id_client_edi: (client.value != undefined ? client.value.id_client_edi : 0),
   quantiter: 1,
   id_panier_edi_list: null,
   key_tab_1 : 0,
   key_tab_2 : 0,
});

var formAddProduitAndRef = useForm({
   idProduit: null,
   quantiter: 1,
   ref_externe: null,
   key_tab_1 : 0,
   key_tab_2 : 0,
});

function closeModal() {
  isOpen.value = false;
}

function openModal(img,gamme,design,couleur) {
  isOpen.value = true;
  var nomProduit = gamme+" "+design+" "+couleur;
  document.getElementById("visuelImage").setAttribute('src','https://gestion.tapis-nazar.fr/img/produit/'+img);
  document.getElementById("visuelImage").setAttribute('alt',nomProduit);
  document.getElementById("nomVisuelImage").textContent = nomProduit;
};

const getVariant = (idDesign) => {
   if (idDesign != "" && idDesign != null) {
      var checkExist = document.getElementById("tab_idDesign" + idDesign);
      var keyCheck = checkExist.dataset.positiontab;
      var checkExist = checkExist.nextSibling;
      if (checkExist.id != "viewDetailsDesign") {
         axios.post('/dropshipping/gamme/design', { id_design: idDesign }).then((response) => {
            if (response.status == 200) {
               if (document.getElementById("viewDetailsDesign") != null) {
                  if (document.getElementById("viewDetailsDesign").__vue_app__ != undefined) {
                     document.getElementById("viewDetailsDesign").__vue_app__.unmount();
                  }
                  document.getElementById("viewDetailsDesign").remove();
               }
               var detailsDesign = createApp(DetailsDesign, { designs: response.data, gamme: props.gamme.nom_gamme });
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
               document.getElementById("tab_idDesign" + idDesign).parentNode.insertBefore(trNew, document.getElementById("tab_idDesign" + idDesign).nextSibling)
               detailsDesign.mount(document.getElementById("viewDetailsDesign"));
            }
         });
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

var addCommande = (e,isPanier) => {
   e.preventDefault();
   var key1= formAddProduit.key_tab_1;
   var key2= formAddProduit.key_tab_2;
   if(formAddProduit.quantiter > 0){
      formAddProduit.post('/dropshipping/panier/add', {
         preserveScroll: true,
         preserveState:true,
         onSuccess: (e) => {
            if(e.props.session.status){
               designpanier.value[key1].produits[key2].panier.id_panier_edi_list = e.props.session.id_panier_edi_list;
               designpanier.value[key1].produits[key2].isInPanier = true;
               designpanier.value[key1].produits[key2].panier.quantiter = formAddProduit.quantiter;
               isOpenAdd.value = false;
               isOpenAddRef.value = false;
               Toast.fire({
                  icon: 'success',
                  title: (isPanier ? 'La quantiter pour ce produit à bien été modifier' : 'Le produit à bien ajouter au panier')
               });
            }else{
               Toast.fire({
                  icon: 'error',
                  title: e.props.session.message
               });
            }
            
         },
      });
   }else{
      deleteCommande(formAddProduit.id_panier_edi_list,key1,key2)
   }
   
};

var addCommandeRef = (e,isPanier) => {
   e.preventDefault();
   var key1= formAddProduitAndRef.key_tab_1;
   var key2= formAddProduitAndRef.key_tab_2;
   if(formAddProduitAndRef.quantiter > 0){
      formAddProduitAndRef.post('/dropshipping/panier/add', {
         preserveScroll: true,
         preserveState:true,
         onSuccess: (e) => {
            if(e.props.session.status){
               designpanier.value[key1].produits[key2].panier.id_panier_edi_list = e.props.session.id_panier_edi_list;
               designpanier.value[key1].produits[key2].isInPanier = true;
               designpanier.value[key1].produits[key2].panier.quantiter = formAddProduitAndRef.quantiter;
               isOpenAdd.value = false;
               isOpenAddRef.value = false;
               Toast.fire({
                  icon: 'success',
                  title: (isPanier ? 'La quantiter pour ce produit à bien été modifier' : 'Le produit et la commande client à bien ajouter au panier')
               });
            }else{
               Toast.fire({
                  icon: 'error',
                  title: e.props.session.message
               });
            }
            
         },
      });
   }
   
};

var deleteCommande = (id_panier_edi_list,key,key2) =>{
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous sur de supprimer cette article du panier ?',
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

         formProduit.post(route('order_entrepot/panier/delete'), {
            preserveScroll: true,
            onSuccess: (e) => {
               if(e.props.session.status){
                  Toast.fire({
                     icon: 'success',
                     title: 'Le produit à bien été supprimer du panier'
                  })
                  designpanier.value[key].produits[key2].isInPanier = false;
                  designpanier.value[key].produits[key2].panier.quantiter = 0;
                  designpanier.value[key].produits[key2].panier.id_panier_edi_list = 0;
                  isOpenAdd.value = false;
                  isOpenAddRef.value = false;
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: e.props.session.message
                  });
               }
               
            },
         });
      }
   })
};

var deletePanier = () =>{
   Swal.fire({
      title: 'Attention, Êtes-vous de vouloir vider votre panier ?',
      text: 'Cela supprimera tous les clients de la commande ainsi que leurs produits !',
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

var setIsOpenAdd = (value,produit,key1,key2) => {
   isOpenAdd.value = value;
   produitAdd.value = produit;
   formAddProduit.idProduit = produit.id_produit;
   formAddProduit.key_tab_1 = key1;
   formAddProduit.key_tab_2 = key2;
   formAddProduit.quantiter = (produit.panier.quantiter > 0 ? produit.panier.quantiter : 1);
   formAddProduit.id_panier_edi_list = (produit.panier.id_panier_edi_list != undefined ? produit.panier.id_panier_edi_list : 0);
}

var setIsOpenAddRef = (value,produit,key1,key2) => {
   isOpenAddRef.value = value;
   produitAdd.value = produit;
   formAddProduitAndRef.idProduit = produit.id_produit;
   formAddProduitAndRef.key_tab_1 = key1;
   formAddProduitAndRef.key_tab_2 = key2;
   formAddProduitAndRef.quantiter = (produit.panier.quantiter > 0 ? produit.panier.quantiter : 1);
}

var calcul_prix_gamme = (prix_gamme) => {
   var HT = prix_gamme;
   if(clientUser.value.taux_remise > 0){
      HT = HT - ((HT) * (clientUser.value.taux_remise /100));
   }
   return roundNumber(HT);
}

var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};


watchEffect(() => {
   dynamic.value = usePage().props.value.dynamique_client;
   panierDrop.value = usePage().props.value.PanierDrop;
   client.value = panierDrop.value.panier.clientActuel;
   clientUser.value = usePage().props.value.auth.user[0].client;
	axios.post('/dropshipping/panier/view',{gamme:props.gamme.nom_gamme}).then((response)=>{
      console.log(response);
      if(response.data != null){         
         designpanier.value = response.data;
         formAddProduit.id_client_edi = (client.value != undefined ? client.value.id_client_edi : 0)
      }
   });
});

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

// const lowercase = (nom) => {
//    return HtmlEntities.decode(nom.toLowerCase());
// };

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

const getCountP = () => {
   if(countP == 4){
      countP = 1;
   }else{
      countP++;
   }
   return countP;
};

var formatPrix = (prix) => {
   return new Intl.NumberFormat("fr-FR", {
      style: "currency",
      currency: "EUR",
   }).format(prix);
};
</script>

<script>
import Eye from 'icons/EyeOutline.vue';
import Close from 'icons/Close.vue';
import ImageOff from 'icons/ImageOff.vue';
import Right from 'icons/ChevronRight.vue';
import Left from 'icons/ChevronLeft.vue';
import Search from 'icons/Magnify.vue';
import CartAdd from 'icons/CartPlus.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
import {BackspaceIcon} from '@heroicons/vue/24/outline';
import { Inertia } from '@inertiajs/inertia';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),
   // Using the shorthand
   layout: AuthenticatedLayout,
};
</script>

<template>

   <Head title="Orders Products Clients" />
   <!-- <section :style="imgBackground" class="h-52 relative container mx-auto bg-cover bg-[center_bottom_-15rem]">
      <Breadcrumbs :links="links" />
      <div class="absolute top-1 left-0 text-white p-5 py-2 rounded-r-lg bg-primary-50">
         <a class="underline" href="/">Accueil</a> / <a class="underline" href="/dropshipping/gamme">Gamme</a> / {{ props.gamme.nom_gamme }}
      </div>
      <div class="flex items-center h-full ">
         <h1 class="text-white text-3xl font-bold px-5 py-2 rounded-r-lg bg-primary-50">{{ props.gamme.nom_gamme }}</h1>
      </div>
      <div class="absolute bottom-0 left-0 py-2">
         <div class="relative  rounded bg-gradient-to-r from-blue-400 to-indigo-500">
               <a href="/dropshipping/gamme" class="group rounded bg-gradient-to-r from-blue-400 to-indigo-500">
                  <div class="bg-gradient-to-r to-blue-400 from-indigo-500 text-white font-bold py-2 px-4 rounded shadow-md transition duration-500 ease-in-out opacity-0 group-hover:opacity-100">
                     <span class="opacity-100 text-white font-bold">Retourner aux gammes</span>
                  </div>
                  <div class="absolute flex items-center justify-center w-full h-full top-0 left-0 opacity-100 group-hover:opacity-0 transition duration-500 ease-in-out">
                     <span class="opacity-100 text-white font-bold">Retourner aux gammes</span>
                  </div>
               </a>
            </div>
      </div>
   </section> -->

   


   <section class="container mx-auto mt-5">
      <Breadcrumbs :links="links" />
      <section class="relative container mx-auto grid grid-cols-12 mb-4">     
         <div class="col-span-2 flex items-end">
            <a href="/dropshipping/gamme" class="relative inline-block group">
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
            <div class="sm:w-auto w-full py-2 flex items-center justify-center">
               <button type="button" @click="deletePanier" class="sm:w-auto w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"><BackspaceIcon class="w-5 h-5 mr-2" />Vider mon panier</button>
               <a href="/dropshipping/cart" class="py-2 px-4 ml-2 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">Voir mon panier</a>
            </div>
         </div>
      </section>

      <div class="bg-primary-50 rounded mx-1 py-2 mb-5">
         <h2 class="text-center text-3xl text-gray-800">Sélectionner les produits pour votre client.</h2>
      </div>
      

      <div class="flex justify-between my-1 mx-1">
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

      <!-- <div class="mx-1 my-1 flex sm:flex-row flex-col w-auto sm:flex-grow order-1 sm:order-2 mb-2 sm:mb-0 ">
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
      </div> -->

      <div class="flex flex-col">
         <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
               <div class="min-w-full overflow-hidden border border-primary-200 p-4">
                  <div class="border-b border-primary-200 min-w-full" :key="key1" v-for="(gamme,key1) in designpanier">
                     <table class=" text-left text-sm font-light" >
                        <tbody>
                           <tr class="px-4 py-4">
                              <td class="whitespace-nowrap px-4 py-4 w-[190px] overflow-x-hidden">

                                 <div class="h-24 w-full mb-2">
                                    <div v-if="gamme.img_produit != null"
                                          class="cursor-pointer relative overflow-hidden w-full h-full flex justify-center">
                                       <div class="absolute flex items-center justify-center w-full h-full">
                                          <Eye class="text-lg text-black" />
                                       </div>
                                       <img @click="openModal(gamme.img_produit,props.gamme.nom_gamme,gamme.nom_design)" :src="'https://gestion.tapis-nazar.fr/img/produit/' + decode(gamme.img_produit)"
                                          :alt="gamme.code_sku" class="z-20 relative hover:opacity-50 transition duration-300 h-full object-contain" />

                                    </div>
                                    <div v-else class="text-3xl h-full w-full flex items-center justify-center bg-gray-300">
                                       <ImageOff />
                                    </div>
                                 </div>
                                 <div class="text-center w-full">
                                    <span class="font-bold pt-2">{{ gamme.nom_design }}</span>
                                 </div>
                                 
                              </td>
                              <td  v-for="(produit,key2) in gamme.produits" :key="key2" class="whitespace-nowrap px-4 py-4 h-24 table-cell align-middle">
                                 <div class="w-full h-full flex flex-col items-center justify-between">
                                    <div class="w-full font-bold text-center">
                                       {{ produit.largeur }}x{{ produit.longueur }}
                                    </div>
                                    <div  class="flex items-center justify-center ">
                                          <Tooltip>
                                             <template #header>
                                                <div v-if="produit.stock_restant > 0" class="hover:scale-110 transition duration-300">
                                                   <button @click="(client != undefined  ? setIsOpenAdd(true,produit,key1,key2) : setIsOpenAddRef(true,produit,key1,key2))"
                                                      :class="produit.stock_restant > 10 ? 'bg-green-700' : (produit.stock_restant > 0 ? 'bg-orange-400 ' : 'bg-red-700')" 
                                                      class=" w-[35px] h-[35px] block rounded-full flex items-center justify-center">
                                                      <CartAdd v-if="!produit.isInPanier" class="text-xl text-white items-center justify-center" />
                                                      <span v-else class="text-xl text-white items-center justify-center">{{ produit.panier.quantiter }}</span>

                                                   </button>
                                                </div>
                                                
                                                <span v-else class="bg-red-700 w-[35px] h-[35px] block rounded-full flex items-center justify-center"></span>
                                             </template>
                                             <template #body>
                                                <span v-if="produit.stock_restant > 0"> {{(produit.isInPanier ? 'Modifier quantiter' : 'Ajouter au')}} panier</span>
                                                <span v-else> Rupture de stock </span>
                                             </template>
                                          </Tooltip>
                                          
                                    </div>
                                    <div class="text-center w-full">
                                       <span class="font-bold">{{ formatPrix(produit.prixProduit) }} HT</span>
                                    </div>
                                 </div>
                                 
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- <div class="grid grid-cols-4 justify-center items-center bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 xl:px-6">
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
       </div> -->

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

  <TransitionRoot appear :show="isOpenAdd" as="template" :unmount="false">
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
            <DialogPanel class="w-full border-[5px] border-primary-200 max-w-2xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all" >
              <DialogTitle as="h3" class="lg:text-lg text-sm text-center font-medium leading-6 text-gray-900"  v-if="produitAdd != false">
               {{ (formAddProduit.id_panier_edi_list != null && formAddProduit.id_panier_edi_list != 0 ? 'Modifier Quantiter' : 'Ajouter ') }} produit {{ produitAdd.sku }}
              </DialogTitle>
               <form v-if="produitAdd != false" @submit.prevent="addCommande($event,(formAddProduit.id_panier_edi_list != null && formAddProduit.id_panier_edi_list != 0 ? true : false))">
                  <input type="hidden" name="id_produit" id="id_produit" v-model="formAddProduit.idProduit" />
                  <input type="hidden" name="id_panier_edi_list" id="id_panier_edi_list" v-model="formAddProduit.id_panier_edi_list" />
                  <div class="mt-2 flex justify-center items-center">
                     <div class="text-sm text-gray-500 w-full">
                        <label class="lg:text-lg text-sm" for="ref"> Quantiter : </label> 
                        <input v-model="formAddProduit.quantiter" class="w-full lg:text-lg text-sm transition duration-300 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                        id="quantiter" type="number" min="0" :max="produitAdd.stock_restant" name="quantiter" placeholder="Saisissez la quantiter pour la commande">
                        <InputError class="mt-2" :message="formAddProduit.errors.quantiter" />
                        <InputError class="mt-2" :message="formAddProduit.errors.idProduit" />
                        <InputError class="mt-2" :message="formAddProduit.errors.id_panier_edi_list" />
                     </div>
                     <div class="w-full mt-7 ml-5" v-if="produitAdd.isInPanier">
                        <button type="button" @click="deleteCommande(produitAdd.panier.id_panier_edi_list,formAddProduit.key_tab_1,formAddProduit.key_tab_2)" class="w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300">
                           <BackspaceIcon class="w-5 h-5 mr-2" />Suprimmer le produit du panier
                        </button>
                     </div>
                  </div>

                  <div class="mt-4 flex justify-center">
                     <button @click="isOpenAdd = false;" type="button" class="mx-10 inline-flex justify-center rounded-md border border-transparent hover:border-red-100 px-4 py-2 text-sm font-medium text-red-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300">
                        Annuler
                     </button>
                     <button type="submit" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">
                        Valider <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" />
                     </button>
                     
                  </div>
              </form>
             
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>

  <TransitionRoot appear :show="isOpenAddRef" as="template" :unmount="false">
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
            <DialogPanel class="w-full border-[5px] border-primary-200 max-w-3xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all" >
              <DialogTitle as="h3" class="lg:text-lg text-sm text-center font-medium leading-6 text-gray-900"  v-if="produitAdd != false">
               Ajouter le numéro de commande et la quantité du produit {{ produitAdd.sku }} 
              </DialogTitle>
               <form v-if="produitAdd != false" @submit.prevent="addCommandeRef($event,(formAddProduitAndRef.id_panier_edi_list != null && formAddProduitAndRef.id_panier_edi_list != 0 ? true : false))">
                  <input type="hidden" name="id_produit" id="id_produit" v-model="formAddProduitAndRef.idProduit" />
                  <input type="hidden" name="id_panier_edi_list" id="id_panier_edi_list" v-model="formAddProduitAndRef.id_panier_edi_list" />
                  <div class="mt-2 flex justify-center items-center">
                     <div class="mr-2 w-full">
                        <div class="text-sm text-gray-500">
                           <label class="lg:text-lg text-sm" for="ref"> Référence : </label> 
                           <input v-model="formAddProduitAndRef.ref_externe" class="lg:text-lg text-sm transition duration-300 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" id="ref" type="text" name="ref_externe" placeholder="Saisissez la référence de la commande">
                           <InputError class="mt-2" :message="formAddProduitAndRef.errors.ref_externe" />
                        </div>
                     </div>
                     <div class="text-sm text-gray-500 w-full">
                        <label class="lg:text-lg text-sm" for="ref"> Quantiter : </label> 
                        <input v-model="formAddProduitAndRef.quantiter" class="w-full lg:text-lg text-sm transition duration-300 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0" 
                        id="quantiter" type="number" min="0" :max="produitAdd.stock_restant" name="quantiter" placeholder="Saisissez la quantiter pour la commande">
                        <InputError class="mt-2" :message="formAddProduitAndRef.errors.quantiter" />
                        <InputError class="mt-2" :message="formAddProduitAndRef.errors.idProduit" />
                     </div>
                  </div>

                  <div class="mt-4 flex justify-center">
                     <button @click="isOpenAddRef = false;" type="button" class="mx-10 inline-flex justify-center rounded-md border border-transparent hover:border-red-100 px-4 py-2 text-sm font-medium text-red-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300">
                        Annuler
                     </button>
                     <button type="submit" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">
                        Valider <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" />
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
