<script setup>
import { Head, usePage, useForm, } from '@inertiajs/inertia-vue3';
import { ref, watchEffect } from 'vue';
import {TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,} from '@headlessui/vue';
import { HomeIcon,ListBulletIcon,ArrowLeftIcon  } from '@heroicons/vue/24/solid';
import { ArrowRightCircleIcon,ArrowSmallDownIcon  } from '@heroicons/vue/24/outline';
import { Tooltip } from 'floating-vue';
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper';
import {decode} from 'html-entities';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import InputError from '@/Components/InputError.vue';
import ListClients from '@/Components/ListClients.vue';
import ModalAjoutClient from '@/Components/ModalAjoutClient.vue';
import InputNumberProduit from '@/Components/InputNumberProduit.vue';

import "swiper/css";
import "swiper/css/navigation";
import 'swiper/css/pagination';

const props = defineProps(["gamme","designpanier"]);
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
      title: 'Gammes',
      link: '/dropshipping/gamme',
      icon: '',
      active: false
   },{
      title: props.gamme.nom_gamme,
      link: '/dropshipping/gamme/'+props.gamme.nom_gamme,
      icon: '',
      active: true
}];

var imgModal = ref({
   nom_visuel: null,
   visuels: [{'img_produit' : null}]
});

var dynamic = ref(usePage().props.value.dynamique_client);
var panierDrop = ref(usePage().props.value.PanierDrop);
var client = ref(panierDrop.value.panier.clientActuel);
var designpanier = ref(props.designpanier);
var produitAdd = ref(false);
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

function openModal(img,gamme,design,imgList) {
  isOpen.value = true;
  imgModal.value.nom_visuel = gamme+" "+design;
  if(imgList != undefined && imgList != null){
   imgModal.value.visuels = imgList;
  }else if(img != undefined && img != null){
   imgModal.value.visuels = [{'img_produit' : decode(img)}];
  }else{
   imgModal.value.visuels = [{'img_produit' : null}];
  }
};

const findElementInClassArray = (array, elementSearch) => {
   var elementCheck = undefined;
   array.forEach(element => {
      if (element.classList != undefined && element.classList.length > 0) {
         if (element.classList.contains(elementSearch)) {
            elementCheck = element;
         }
      }
   });

   return elementCheck;
}

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
                  title: (isPanier ? 'La quantité pour ce produit a bien été modifier.' : 'Le produit à bien ajouter au panier.')
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
                  title: (isPanier ? 'La quantité pour ce produit a bien été modifier.' : 'Le produit et la commande client à bien ajouter au panier.')
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
      text: 'Êtes-vous sur de supprimer cet article du panier ?',
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

         formProduit.post(route('dropshipping/panier/delete'), {
            preserveScroll: true,
            onSuccess: (e) => {
               if(e.props.session.status){
                  Toast.fire({
                     icon: 'success',
                     title: 'Le produit a bien été supprimer du panier.'
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


watchEffect(() => {
   dynamic.value = usePage().props.value.dynamique_client;
   panierDrop.value = usePage().props.value.PanierDrop;
   client.value = panierDrop.value.panier.clientActuel;
   clientUser.value = usePage().props.value.auth.user[0].client;
	axios.post('/dropshipping/panier/view',{gamme:props.gamme.nom_gamme}).then((response)=>{
      //console.log(response);
      if(response.data != null){         
         designpanier.value = response.data;
         formAddProduit.id_client_edi = (client.value != undefined ? client.value.id_client_edi : 0)
      }
   });
});

var formatPrix = (prix) => {
   return new Intl.NumberFormat("fr-FR", {
      style: "currency",
      currency: "EUR",
   }).format(prix);
};

var afficheIMG = (classAff,img) => {
   if(typeof img === 'object' || img instanceof Object){
      if(img != undefined && img != null && img != ''){ 
         img = decode(img.img_produit);
      }
   }
   if(img != undefined && img != null && img != ''){ 
      if(document.getElementsByClassName(classAff).length == 1){
         document.getElementsByClassName(classAff)[0].classList.remove('opacity-100');
         document.getElementsByClassName(classAff)[0].classList.add('opacity-50');
         document.getElementsByClassName(classAff)[0].src = 'https://gestion.tapis-nazar.fr/img/produit/'+decode(img);
         document.getElementsByClassName(classAff)[0].classList.remove('opacity-50');
         document.getElementsByClassName(classAff)[0].classList.add('opacity-100');
      }
   }
};

var modifQte = (e,formRef) => {
   e.preventDefault();

   var form = findElementInClassArray(e.path, 'editQteModal');
   if (form != undefined) {
      
      var formData = new FormData(form);
      formRef.quantiter = formData.get("quantiter");
   }
};
</script>

<script>
import Eye from 'icons/EyeOutline.vue';
import ImageOff from 'icons/ImageOff.vue';
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
    components: { InputNumberProduit }
};
</script>

<template>

   <Head title="Orders Products Clients" />
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
            <span>Poils {{ (props.gamme.type_poils == 1 ? 'courts' : 'longs') }} - {{ (props.gamme.uv_proof == 1 ? 'Résistants aux UV' : 'Non Résistants aux UV') }}</span>
            <span class="capitalize">{{ props.gamme.nom_special }}</span>
            <span v-if="props.gamme.prix_piece">Prix HT à la pièce</span>
            <span v-else>Prix HT m² : {{ props.gamme.prix_vente_ht_m2_remise?props.gamme.prix_vente_ht_m2_remise:props.gamme.prix_vente_ht_m2 }} €</span>
            <div class="sm:w-auto w-full py-2 px-4 flex items-center justify-center" v-if="props.gamme.nom_trame != null && props.gamme.nom_trame != ''">
               <a :href="'https://gestion.tapis-nazar.fr/xls/trame/'+props.gamme.nom_trame" 
               class="py-2 px-4 w-full flex items-center justify-center group border border-blue-300 rounded bg-blue-700 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300" download><ArrowSmallDownIcon class="w-5 h-5 mr-2" />Télécharger la trame</a>
            </div>
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
                                       <img @click="openModal(gamme.img_produit,props.gamme.nom_gamme,gamme.nom_design,gamme.img_produit_list)" :src="'https://gestion.tapis-nazar.fr/img/produit/' + decode(gamme.img_produit)"
                                          :alt="gamme.code_sku" :class="'imgView_'+key1" class="z-20 relative hover:opacity-50 transition duration-300 w-full h-full object-contain" />
                                    </div>
                                    <div v-else class="text-3xl h-full w-full flex items-center justify-center bg-gray-300">
                                       <ImageOff />
                                    </div>
                                 </div>
                                 <div class="text-center w-full">
                                    <span class="font-bold pt-2">{{ gamme.nom_design }}</span>
                                 </div>
                                 
                              </td>
                              <td  v-for="(produit,key2) in gamme.produits" :key="key2" @mouseover="afficheIMG('imgView_'+key1,produit.photo_produit)" @mouseleave="afficheIMG('imgView_'+key1,gamme.img_produit)"  class="whitespace-nowrap px-4 py-4 h-24 table-cell align-middle">
                                 <div class="w-full h-full flex flex-col items-center justify-between">
                                    <div class="w-full font-bold text-center">
                                       {{ produit.largeur }}x{{ produit.longueur }}
                                    </div>
                                    <div  class="flex items-center justify-center ">
                                       <Tooltip :placement="'right'" :triggers="['hover', 'focus', 'click']">
                                          <div>
                                             <div v-if="produit.stock_restant > 0" class="hover:scale-110 transition duration-300">
                                                   <button @click="(client != undefined  ? setIsOpenAdd(true,produit,key1,key2) : setIsOpenAddRef(true,produit,key1,key2))"
                                                      :class="produit.stock_restant > 10 ? 'bg-green-700' : (produit.stock_restant > 0 ? 'bg-orange-400 ' : 'bg-red-700')" 
                                                      class=" w-[35px] h-[35px] block rounded-full flex items-center justify-center">
                                                      <CartAdd v-if="!produit.isInPanier" class="text-xl text-white items-center justify-center" />
                                                      <span v-else class="text-xl text-white items-center justify-center">{{ produit.panier.quantiter }}</span>

                                                   </button>
                                                </div>
                                                
                                                <span v-else class="bg-red-700 w-[35px] h-[35px] block rounded-full flex items-center justify-center"></span>
                                          </div>


                                          <template #popper>
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

   </section>

   <TransitionRoot :show="isOpen" as="template" :unmount="false" >
    <Dialog as="div" @close="closeModal" class="relative z-[60]" :unmount="false">
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
            :unmount="false" >
            <DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all" :unmount="false">
              <DialogTitle :unmount="false" as="h3" class="text-lg font-medium leading-6 text-gray-900">
                Visuel image {{ imgModal.nom_visuel }} 
              </DialogTitle>
              <div class="mt-2 h-[40rem] w-full">
               <swiper :modules="[Navigation, Pagination, Scrollbar, A11y]"
                    :slides-per-view="1"
                    :space-between="40"
                    :pagination="{ clickable: true, el: '.swiper-pagination-custom',bulletActiveClass: 'opacity-full',bulletClass:'swiper-pagination-bullet mx-2 !bg-primary-300', type: 'bullets' }"
                    :scrollbar="{ draggable: true }"
                    :navigation="{nextEl: '.swiper-button-prev-custom', prevEl: '.swiper-button-next-custom', disabledClass: 'lg:hidden'}"
                    class="lg:!px-10 !px-0 lg:!py-2 lg:!pt-4 !py-2 !relative h-full">
                <div class="swiper-button-prev-custom absolute justify-center items-center top-0 bottom-0 right-0 z-40 cursor-pointer lg:flex hidden">
                    <Right class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
                </div>
                <div class="swiper-button-next-custom absolute justify-center items-center top-0 bottom-0 left-0 z-40 cursor-pointer lg:flex hidden">
                    <Left class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
                </div>
                <div class="swiper-pagination-custom lg:hidden flex items-center justify-center py-2"></div>
                <swiper-slide class="lg:px-2" v-for="(visuel, key) in imgModal.visuels" :key="key">
                  <div class="flex items-stretch justify-center w-full h-full">
                     <div v-if="visuel.img_produit != null" class="relative w-full h-full">
                        <img  :src="'https://gestion.tapis-nazar.fr/img/produit/' + decode(visuel.img_produit)"
                           :alt="imgModal.nom_visuel" 
                           class="z-20 rounded relative w-full h-full object-contain" />
                     </div>
                     <div v-else class="text-3xl w-full flex items-stretch justify-center bg-gray-300">
                        <ImageOff />
                     </div>
                  </div>
                </swiper-slide>
            </swiper>
                  <!-- <img id="visuelImage" class="w-full h-full object-cover" /> -->
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
               {{ (formAddProduit.id_panier_edi_list != null && formAddProduit.id_panier_edi_list != 0 ? 'Modifier Quantité' : 'Ajouter ') }} produit {{ produitAdd.sku }}
              </DialogTitle>
               <form class="editQteModal" v-if="produitAdd != false" @submit.prevent="addCommande($event,(formAddProduit.id_panier_edi_list != null && formAddProduit.id_panier_edi_list != 0 ? true : false))">
                  <input type="hidden" name="id_produit" id="id_produit" v-model="formAddProduit.idProduit" />
                  <input type="hidden" name="id_panier_edi_list" id="id_panier_edi_list" v-model="formAddProduit.id_panier_edi_list" />
                  <div class="mt-2 flex justify-center items-center">
                     <div class="text-sm text-gray-500 w-full">
                        <label class="lg:text-lg text-sm" for="ref"> Quantité : </label> 
                        <InputNumberProduit  @change="modifQte($event,formAddProduit)" :value="formAddProduit.quantiter"                         
                           id="quantiter" min="0" :max="produitAdd.stock_restant" name="quantiter" placeholder="Saisissez la quantiter pour la commande" />
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
                     <button :class="{ 'opacity-25': formAddProduit.processing }" :disabled="formAddProduit.processing" type="submit" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
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
               <form class="editQteModal" v-if="produitAdd != false" @submit.prevent="addCommandeRef($event,(formAddProduitAndRef.id_panier_edi_list != null && formAddProduitAndRef.id_panier_edi_list != 0 ? true : false))">
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
                        <label class="lg:text-lg text-sm" for="ref"> Quantité : </label> 
                        <InputNumberProduit  @change="modifQte($event,formAddProduitAndRef)" :value="formAddProduitAndRef.quantiter"                        
                           id="quantiter" min="0" :max="produitAdd.stock_restant" name="quantiter" placeholder="Saisissez la quantiter pour la commande" />
                        <InputError class="mt-2" :message="formAddProduitAndRef.errors.quantiter" />
                        <InputError class="mt-2" :message="formAddProduitAndRef.errors.idProduit" />
                     </div>
                  </div>

                  <div class="mt-4 flex justify-center">
                     <button @click="isOpenAddRef = false;" type="button" class="mx-10 inline-flex justify-center rounded-md border border-transparent hover:border-red-100 px-4 py-2 text-sm font-medium text-red-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300">
                        Annuler
                     </button>
                     <button :class="{ 'opacity-25': formAddProduitAndRef.processing }" :disabled="formAddProduitAndRef.processing" type="submit" class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
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
