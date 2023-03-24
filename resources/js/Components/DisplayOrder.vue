<script setup>
import { ref } from 'vue';
import {decode} from 'html-entities';
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper';
import "swiper/css";
import "swiper/css/navigation";
import 'swiper/css/pagination';

var props = defineProps(['products','hBlock','slidePerView','classGridText','classGridImage']);
var products = ref(props.products);
console.log(products.value);
var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};
</script>
<script>
import ImageOff from 'icons/ImageOff.vue';
import Left from 'icons/MenuLeft.vue';
import Right from 'icons/MenuRight.vue';

</script>
<template>
         <div class="bg-gray-100 shadow-lg">
      <swiper  :modules="[Navigation, Pagination, Scrollbar, A11y]"
               :slides-per-view="3"
               :space-between="40"
               :breakpoints="props.slidePerView"
               :pagination="{ clickable: true, el: '.swiper-pagination-custom',bulletActiveClass: 'opacity-full',bulletClass:'swiper-pagination-bullet mx-2 !bg-primary-100', type: 'bullets' }"
               :scrollbar="{ draggable: true }"
               :navigation="{nextEl: '.swiper-button-prev-custom', prevEl: '.swiper-button-next-custom', disabledClass: 'opacity-50'}"
               class="lg:!px-9 !px-0 lg:!py-2 lg:!pt-4 !py-2 !relative">
         <div class="swiper-button-prev-custom absolute top-1/2 right-0 z-40 cursor-pointer lg:block hidden">
            <Right class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
         </div>
         <div class="swiper-button-next-custom absolute top-1/2 left-0 z-40 cursor-pointer lg:block hidden">
            <Left class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
         </div>
         <div class="swiper-pagination-custom flex items-center justify-center py-2"></div>
            <swiper-slide :class="hBlock" v-for="(design, key) in products" :key="key">
               <div class="flex bg-gray-200 px-2 py-4 max-h-full" :class="hBlock" >
                  <div class="grid grid-cols-12 auto-rows-fr">
                     <div :class="props.classGridImage" class="flex items-stretch justify-center w-full">
                        <div v-if="design.photo != null" class=" w-full" >
                           <img :src="'https://gestion.tapis-nazar.fr/img/produit/'+design.photo.img_produit" :alt="design.code_sku" class="w-full h-full object-contain"/>
                        </div>
                        <div v-else class="text-3xl w-full flex items-stretch justify-center bg-gray-300">
                           <ImageOff />
                        </div>
                     </div>
                     <div :class="props.classGridText" class="px-2 grid grid-cols-1">
                        <span class="sm:text-sm text-[0.700rem] font-bold">SKU : {{design.code_sku}}</span>
                        <span class="sm:text-sm text-[0.700rem] font-bold">Taille : {{design.dimension.largeur}}x{{design.dimension.longueur}}cm</span>
                        <span class="sm:text-sm text-[0.700rem] font-bold">EAN : {{design.gencode}}</span>
                        <span class="sm:text-sm text-[0.700rem] font-bold">Quantiter : {{design.panier.quantiter}}</span>
                        <span class="sm:text-sm text-[0.700rem] font-bold">Prix : {{ roundNumber(design.panier.prix_ht_total) }} € HT</span>
                        <div v-if="design.panierG.is_marketplace == 1" class="sm:text-sm text-[0.700rem] font-bold whitespace-nowrap">
                           <span class="sm:text-sm text-[0.700rem] font-bold">Statut : {{decode(design.commande.etape.nom_etape)}}</span>
                           <div v-if="design.commande.etape.id_etape >= 4">
                              <span>Suivi GLS : <a rel="noopener" target="_blank" class="text-blue-500 hover:text-blue-300 transition duration-150" :href="'https://gls-group.eu/FR/fr/suivi-colis?match='+design.commande.commande_stock.tracking">{{design.commande.commande_stock.tracking}}</a></span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </swiper-slide>
      </swiper>
   </div>
</template>