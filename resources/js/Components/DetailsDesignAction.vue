<script setup>
import InputNumber from '@/Components/InputNumber.vue';
import InputError from '@/Components/InputError.vue';
import { useForm,usePage } from '@inertiajs/inertia-vue3';
import { ref, watchEffect, onMounted } from 'vue';
import {
   TransitionRoot,
   TransitionChild,
   Dialog,
   DialogPanel,
   DialogTitle,
  } from '@headlessui/vue'
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper';
import "swiper/css";
import "swiper/css/navigation";
import 'swiper/css/pagination';

var props = defineProps(['designs','gamme']);
var designs = ref(props.designs);
var typeVente = ref(usePage().props.value.session.typeVente);
var isOpen = ref(false);
var formClient = useForm({
   ref_externe: '',
});

var setIsOpen = (e,value) => {
    isOpen.value = value;
    var formData = new FormData(e.target);
    document.getElementById('id_produit_modal').value = formData.get("id_produit");
    document.getElementById('qte_modal').value = formData.get("qte");
    document.getElementById('key_tab_modal').value = formData.get("key_tab");
}

watchEffect(() => {
	typeVente.value = usePage().props.value.session.typeVente;
   var dataClient = usePage().props.value.PanierDrop.panier.clients;
   if(dataClient != undefined && dataClient.length != 0){
      for(var d=0;d < designs.value.length;d++){
         var find = false;
         dataClient.forEach(elP => {
            if(elP.client.id_client_edi == usePage().props.value.PanierDrop.panier.clientActuel.id_client_edi){
               var produitsClient = elP.produits;
               produitsClient.forEach(element => {
                  if(designs.value[d].id_produit == element.id_produit){
                     designs.value[d].isInPanier = true;
                     designs.value[d].panier.quantiter = element.quantiter;
                     designs.value[d].panier.id_panier_edi_list = element.id_panier_edi_list;
                     find = true;
                  }
               });
            }
         });

         if(!find){
            designs.value[d].isInPanier = false;
            designs.value[d].panier.quantiter = 0;
            designs.value[d].panier.id_panier_edi_list = 0;
         }

         if(usePage().props.value.PanierDrop.panier.clientActuel != undefined){
            designs.value[d].id_client_edi = usePage().props.value.PanierDrop.panier.clientActuel.id_client_edi;
         }
         
      }
   } 
});

var addCommande = (e,isPanier) => {
   e.preventDefault();
   
   var formData = new FormData(e.target);
   const formProduit = useForm({
      idProduit: formData.get("id_produit"),
      quantiter: formData.get("qte"),
      id_panier_edi_list: formData.get("id_panier_edi_list"),
      id_client_edi: formData.get("id_client_edi"),
   });
   formProduit.post('/dropshipping/panier/add', {
      preserveScroll: true,
      preserveState:true,
      onSuccess: (e) => {
         if(e.props.session.status){
            designs.value[formData.get("key_tab")].panier.id_panier_edi_list = e.props.session.id_panier_edi_list;
            designs.value[formData.get("key_tab")].isInPanier = true;
            designs.value[formData.get("key_tab")].panier.quantiter = formData.get("qte");
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
};

var editCommande = (key) =>{
   designs.value[key].isInPanier = false;
};

var deleteCommande = (id_panier_edi_list,key) =>{
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous de supprimer cette article de la commande ?',
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

         formProduit.post('/dropshipping/panier/delete', {
            preserveScroll: true,
            onSuccess: (e) => {
               if(e.props.session.status){
                  Toast.fire({
                     icon: 'success',
                     title: 'Le produit à bien été supprimer de la commande'
                  })
                  designs.value[key].isInPanier = false;
                  designs.value[key].panier.quantiter = 0;
                  designs.value[key].panier.id_panier_edi_list = 0;
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: e.props.session.message
                  });
               }
               
            },
         });
      }
   });
};

var addRefClient = (event) => {
   var formData = new FormData(event.target);
   formClient.post('/dropshipping/clients/add', {
      preserveScroll: true,
      preserveState:true,
      onSuccess : (e) => {
         if(e.props.session.statut){
            var id_client_edi = e.props.session.id_client_edi;
            const formProduit = useForm({
               idProduit: formData.get("id_produit_modal"),
               quantiter: formData.get("qte_modal"),
               id_panier_edi_list: 0,
               id_client_edi: id_client_edi,
            });
            formProduit.post('/dropshipping/panier/add', {
               preserveScroll: true,
               preserveState:true,
               onSuccess: (e) => {
                  if(e.props.session.status){
                     designs.value[formData.get("key_tab_modal")].panier.id_panier_edi_list = e.props.session.id_panier_edi_list;
                     designs.value[formData.get("key_tab_modal")].isInPanier = true;
                     designs.value[formData.get("key_tab_modal")].panier.quantiter = formData.get("qte_modal");
                     for(var i=0;i<designs.value.length;i++){
                        designs.value[i].id_client_edi = id_client_edi;
                     }
                     isOpen.value = false;
                     Toast.fire({
                        icon: 'success',
                        title: 'Le produit à bien ajouter au panier'
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
            Toast.fire({
               icon: 'error',
               title: e.props.session.msg
            });
         }
      }
   });
}

var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};
</script>

<script>
import Check from 'icons/Check.vue';
import Delete from 'icons/Delete.vue';
import Edit from 'icons/Pencil.vue';
import ImageOff from 'icons/ImageOff.vue';
import Left from 'icons/MenuLeft.vue';
import Right from 'icons/MenuRight.vue';
import { Inertia } from '@inertiajs/inertia';


</script>

<template>
   <div class="bg-gray-100 shadow-lg">
      <div class="grid grid-cols-12 !z-30 lg:!px-2 !px-0 lg:!py-6 lg:!pt-4 !py-2 !relative">
         <div class="xl:col-span-3 col-span-12 flex items-stretch justify-center w-full ">
            <swiper  :modules="[Navigation, Pagination, Scrollbar, A11y]"
               :slides-per-view="1"
               :space-between="40"
               :pagination="{ clickable: true, el: '.swiper-pagination-custom',bulletActiveClass: 'opacity-full',bulletClass:'swiper-pagination-bullet mx-2 !bg-primary-300', type: 'bullets' }"
               :scrollbar="{ draggable: true }"
               :navigation="{nextEl: '.swiper-button-prev-custom', prevEl: '.swiper-button-next-custom', disabledClass: 'opacity-50'}"
               class="lg:!px-9 !px-0 lg:!py-2 lg:!pt-4 !py-2 !relative">
               <div class="swiper-button-prev-custom absolute top-1/2 right-0 z-40 cursor-pointer lg:block hidden">
                  <Right class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
               </div>
               <div class="swiper-button-next-custom absolute top-1/2 left-0 z-40 cursor-pointer lg:block hidden">
                  <Left class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
               </div>
               <div class="swiper-pagination-custom flex items-center justify-center !z-40 relative py-2"></div>
               <swiper-slide class="xl:!h-full !h-52 !flex items-center justify-center" v-for="(design, key) in designs" :key="key">
                  <div v-if="design.photo != null" class="h-full w-full">
                     <img :src="'https://gestion.tapis-nazar.fr/img/produit/'+design.photo.img_produit" :alt="design.code_sku" class="w-full h-full object-contain"/>
                  </div>
                  <div v-else class="text-3xl h-full w-full flex items-stretch justify-center bg-gray-300">
                     <ImageOff />
                  </div>   
               </swiper-slide>
            </swiper>  
         </div>
         <div class="xl:col-span-9 col-span-12 grid grid-cols-12">
            <div class="lg:col-span-4 sm:col-span-6 col-span-12 p-2 flex items-center justify-center" v-for="(design, key) in designs" :key="key">
               <div class="bg-gray-200 px-4 py-4 w-full h-full">    
                  <div class="grid grid-cols-1">
                           <span class="sm:text-sm text-[0.700rem] font-bold">SKU : {{design.code_sku}}</span>
                           <span class="sm:text-sm text-[0.700rem] font-bold">Taille : {{design.dimension.largeur}}x{{design.dimension.longueur}}cm</span>
                           <span class="sm:text-sm text-[0.700rem] font-bold">EAN : {{design.gencode}}</span>
                           <span class="sm:text-sm text-[0.700rem] font-bold">Prix : {{ roundNumber(design.prixProduit) }} € HT</span>
                           <div class="grid grid-cols-12">
                              <div class="2xl:pr-1 col-span-1">
                                 <div v-if="design.stats_produit.stock_restant > 10">
                                       <span class="bg-green-700 w-[20px] h-[20px] block rounded-full"></span>
                                    </div>
                                    <div v-else-if="design.stats_produit.stock_restant > 0">
                                       <span class="bg-orange-400 w-[20px] h-[20px] block rounded-full"></span>
                                    </div>
                                    <div v-else="design.stats_produit.stock_restant== 0">
                                       <span class="bg-red-700 w-[20px] h-[20px] block rounded-full"></span>
                                    </div>
                              </div>
                              <div class="2xl:pr-1col-span-11 2xl:pl-0  pl-1">
                                 <div v-if="design.stats_produit.stock_restant > 10">
                                       <span class="sm:text-sm text-[0.700rem] font-bold">En stock</span>
                                    </div>
                                    <div v-else-if="design.stats_produit.stock_restant > 0">
                                       <span class="sm:text-sm text-[0.700rem] font-bold">Stock Faible</span>
                                    </div>
                                    <div v-else="design.stats_produit.stock_restant== 0">
                                       <span class="sm:text-sm text-[0.700rem] font-bold">Rupture de stock</span>
                                    </div>
                              </div>
                           </div>
                           <div v-if="typeVente == 2 && design.id_client_edi != ''" class="mt-2">
                              <form @submit.prevent="addCommande($event,(design.panier.quantiter > 0 ? true : false))" class="grid grid-cols-8"
                                 v-if="design.stats_produit.stock_restant > 0 && !design.isInPanier">
                                 <input type="hidden" name="id_produit" :value="design.id_produit" />
                                 <input type="hidden" name="id_client_edi" :value="design.id_client_edi" />
                                 <input type="hidden" name="id_panier_edi_list" :value="(design.panier.id_panier_edi_list != undefined ? design.panier.id_panier_edi_list : 0)" />
                                 <input type="hidden" name="key_tab" :value="key" />
                                 <div class="xsm:col-span-3 col-span-8 xsm:mr-2">
                                    <InputNumber class="sm:h-10 h-8 sm:w-full w-full" name="qte" :max="design.stats_produit.stock_restant" :value="(design.panier.quantiter > 0 ? design.panier.quantiter : 1)" />
                                 </div>
                                 <div class="xsm:col-span-5 col-span-8 xsm:mt-0 mt-2">
                                    <div class="h-10 flex items-start">
                                       <button type="submit" class="2xl:text-sm xl:text-[0.700rem] lg:text-sm text-[0.700rem] font-bold sm:h-full h-3/4 w-full sm:px-3 px-2 bg-primary-50 rounded hover:bg-primary-100 transition duration-300">{{ design.panier.quantiter > 0 ? 'Modifier' : 'Ajouter à' }} la commande</button>
                                    </div>
                                 </div>
                              </form>
                              <div v-else-if="design.isInPanier" class="col-span-2 grid grid-cols-2">
                                 <div class="col-span-2">
                                    <span class="whitespace-pre-line">
                                       <Check class="text-green-500" /> Ajouter à la commande du client.
                                    </span>
                                 </div>
                           
                                 <div class="grid grid-cols-8 col-span-2">
                                    <div class="xl:col-span-5 sm:col-span-4 col-span-8 w-full h-8 bg-gray-300 flex items-center justify-center rounded">
                                       <span class="">Quantité : {{design.panier.quantiter}}</span>
                                    </div>
                                    
                                    <div class="xl:col-span-3 sm:col-span-4 col-span-8 sm:mt-0 mt-1">
                                       <button type="button" @click="editCommande(key)"
                                          class="px-2 h-8 bg-primary-50 rounded hover:bg-primary-100 transition duration-300 sm:mx-1 mr-1 xl:mb-0 mb-2 sm:w-10 w-1/2">
                                          <Edit class="text-white" />
                                       </button>
                                       <button type="button"
                                          @click="deleteCommande((design.panier.id_panier_edi_list != undefined ? design.panier.id_panier_edi_list : 0),key)"
                                          class="px-2 h-8 bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 sm:w-10 w-1/2">
                                          <Delete class="text-white" />
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div v-else-if="typeVente == 2" class="mt-2">
                              <form @submit.prevent="setIsOpen($event,true)" class="grid grid-cols-8"
                                 v-if="design.stats_produit.stock_restant > 0 && !design.isInPanier">
                                 <input type="hidden" name="id_produit" :value="design.id_produit" />
                                 <input type="hidden" name="key_tab" :value="key" />
                                 <div class="xsm:col-span-3 col-span-8 xsm:mr-2">
                                    <InputNumber class="sm:h-10 h-8 sm:w-full w-full" name="qte" :max="design.stats_produit.stock_restant" :value="(design.panier.quantiter > 0 ? design.panier.quantiter : 1)" />
                                 </div>
                                 <div class="xsm:col-span-5 col-span-8 xsm:mt-0 mt-2">
                                    <div class="h-10 flex items-start">
                                       <button type="submit" class="2xl:text-sm xl:text-[0.700rem] lg:text-sm text-[0.700rem] font-bold sm:h-full h-3/4 w-full sm:px-3 px-2 bg-primary-50 rounded hover:bg-primary-100 transition duration-300">Ajouter à la commande</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


   <TransitionRoot v-if="typeVente == 2 && designs[0].id_client_edi == ''" appear :show="isOpen" as="template" :unmount="false">
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
                  Pour continuer, veuillez saisir la référence de la commande client concernée. 
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
                     <button type="submit" class="mx-1 inline-flex justify-center rounded-md border border-transparent bg-green-100 px-4 py-2 text-sm font-medium text-green-900 hover:bg-green-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500 focus-visible:ring-offset-2 transition duration-300">
                        Valider
                     </button>
                     <button @click="isOpen = false;" type="button" class="mx-1 inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300">
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
</template>

<style>
.opacity-full{
   opacity: 1 !important;
}
</style>