<script setup>
import { Head,Link } from '@inertiajs/inertia-vue3';
import { createApp } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel,TransitionRoot,TransitionChild } from '@headlessui/vue';
import DisplayOrder from '@/Components/DisplayOrder.vue';

const props = defineProps(['order', 'clients','produits']);
const classListe = {
   gridImage : "2xl:col-span-3 xl:col-span-4 lg:col-span-3 sm:col-span-2 xsm:col-span-3 col-span-4",
   gridBlock : "2xl:col-span-9 xl:col-span-8 lg:col-span-9 sm:col-span-10 xsm:col-span-9 col-span-8",
   hBlock : "lg:!h-52 sm:!h-42 !h-42"
}

const checkElementInClassArray = (array,elementSearch) =>{
   var status = false;
   array.forEach(element => {
      if(element.classList != undefined && element.classList.length > 0){
         if(element.classList.contains(elementSearch)){
            status = true;
         }
      }
   });

   return status;
}

const eventClick = (header,id_client_edi,num_commande) => {
   console.log('twe')
   var array = header.path;
   var exclud = checkElementInClassArray(array,"notDeployAccordion");
   
   if(!exclud){
      var header = array.find(element => element.classList.contains("accordion-header"));
      const accordionContent = header.parentElement.querySelector(".accordion-content");
      let accordionMaxHeight = accordionContent.style.maxHeight;
      // Condition handling
      if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
         axios.post('/shippings/order/clients/'+num_commande+'/products', { id_client_edi: id_client_edi }).then((response) => {
               if (response.status == 200) {
                  if(document.getElementById("orders_" + id_client_edi).__vue_app__ != undefined){
                     document.getElementById("orders_" + id_client_edi).__vue_app__.unmount();
                  }
                  console.log(response.data);
                  var displayOrder = createApp(DisplayOrder, { products: response.data.panier,ifEdit:false,
                     slidePerView: { 1280:{ slidesPerView:2}, 1024:{ slidesPerView:1}, 0:{ slidesPerView:1} },
                     classGridImage : classListe.gridImage,
                     classGridText : classListe.gridBlock,
                     hBlock: classListe.hBlock });
                  displayOrder.mount(document.getElementById("orders_" + id_client_edi));
               }
         });
         var minus = createApp(Minus);
         accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 100}%`;
         if(header.querySelector(".mdi").__vue_app__ != undefined){
            header.querySelector(".mdi").__vue_app__.unmount();
         }
         minus.mount(header.querySelector(".mdi"));
         header.parentElement.classList.add("bg-primary-100");
         
      } else {
         var plus = createApp(Plus);
         accordionContent.style.maxHeight = `0px`;
         if(header.querySelector(".mdi").__vue_app__ != undefined){
            header.querySelector(".mdi").__vue_app__.unmount();
         }
         plus.mount(header.querySelector(".mdi"));
         header.parentElement.classList.remove("bg-primary-100");
         if (document.getElementById("orders_" + id_client_edi).__vue_app__ != undefined) {
            document.getElementById("orders_" + id_client_edi).__vue_app__.unmount();
         }
      }
   }
};

var getUrl = () => {
   var url = document.location.href;
   return url;
};
</script>
<script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Plus from 'icons/Plus.vue';
import Minus from 'icons/Minus.vue';
import Bill from 'icons/Receipt.vue';
import ImagesIcon from 'icons/Image.vue';

export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),

   // Using the shorthand
   layout: AuthenticatedLayout,
}
</script>
<template>

   <Head :title="'Commande N°'+props.order.num_commande" />

   <section class="container mx-auto px-7 mt-5">

      <div class="p-4 bg-primary-50">
         <h1 class="lg:text-xl text-lg font-bold">Commande n°{{props.order.num_commande}}</h1>
      </div>

   <TabGroup>
    <TabList class="flex space-x-1 rounded-xl  p-1 bg-primary-50 my-5">
      <Tab v-slot="{ selected }" class="relative outline-none">
         <button class="z-30 w-full rounded-lg p-5 relative ring-0"> 
            Commande
          </button>
          <TransitionRoot :show="selected" class="z-10 transition duration-700 " >
            <TransitionChild
            :unmount="false"
            class="w-full h-full bg-primary-100 rounded transition duration-700 absolute top-0 right-0 p-5 "
            enter="ease-in-out"
            enterFrom="translate-x-full"
            enterTo="translate-x-0"
            leave="ease-out"
            leaveFrom="translate-x-0"
            leaveTo="translate-x-full">
            </TransitionChild>
         </TransitionRoot>
         </Tab>
      <Tab v-slot="{ selected }" class="relative outline-none">
          <button class="z-30 w-full rounded-lg p-5 relative ring-0"> 
            Documents
          </button>
          <TransitionRoot :show="selected" class="z-10 transition duration-700 " >
            <TransitionChild
            :unmount="false"
            class="w-full h-full bg-primary-100 rounded transition duration-700 absolute top-0 right-0 p-5"
            enter="ease-in-out"
            enterFrom="-translate-x-full"
            enterTo="translate-x-0"
            leave="ease-out"
            leaveFrom="translate-x-0"
            leaveTo="-translate-x-full">
            </TransitionChild>
         </TransitionRoot>
      </Tab>
    </TabList>
    <TabPanels>
      <TabPanel>
      <div class="my-8 bg-primary-50 grid grid-cols-4 relative" >
         <div class="p-4 lg:col-span-3 col-span-4" v-if="order.is_marketplace == 1 ">
            <h2 class="text-lg font-semibold">Listes des commandes clients</h2>
            <div class="my-5">
               <div class="bg-white py-10 px-5">
                  <!-- What is term -->
                  <div v-for="(client, key) in props.clients" :key="key" :id="'ordersResum_'+client.id_client_edi"
                     class="transition hover:bg-primary-100 border shadow-sm ">
                     <!-- header -->
                     <div @click="eventClick($event,client.id_client_edi)"
                        class="accordion-header cursor-pointer transition flex space-x-5 px-2 items-center py-1 relative">
                        <div class="absolute left-3 lg:col-span-11 col-span-12 relative">
                           <i class="mdi absolute top-1"> <Plus /> </i>
                           <div class="grid grid-cols-12 ml-5 my-1">
                              <h3  class="xl:col-span-3 sm:col-span-5 col-span-12 mx-1">n° : {{client.num_commande}}</h3>
                              <span class="xl:col-span-3 sm:col-span-5 col-span-12  mx-1">Client : {{client.nom+" "+client.prenom}}</span>
                              <span class="xl:col-span-3 sm:col-span-5 col-span-12  mx-1">Nombre de produit : {{client.quantiter}}</span>
                              <span class="xl:col-span-3 sm:col-span-5 col-span-12  mx-1">Total_ttc : {{client.total_ttc}} €</span>
                           </div>
                           
                        </div>
                     </div>
                     <!-- Content -->
                     <div class="accordion-content px-2 pt-0 pb-1 overflow-hidden max-h-0"
                        :id="'orders_'+client.id_client_edi">

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="p-4 lg:col-span-3 col-span-4" v-else>
            <h2 class="text-lg font-semibold">Listes de la commandes</h2>
            <div class="my-5">
               <div class="bg-white py-10 px-5">
                  <!-- What is term -->
                  <div class="transition hover:bg-primary-100 border shadow-sm ">
                     <!-- header -->
                     <div class="accordion-header cursor-pointer transition flex space-x-5 px-2 items-center py-1 relative">
                        <div class="absolute left-3 lg:col-span-11 col-span-12 relative">
                           <div class="grid grid-cols-12 ml-5 my-1">
                              <h3  class="xl:col-span-3 sm:col-span-5 col-span-12 mx-1">n° : {{clients.num_commande}}</h3>
                              <span class="xl:col-span-3 sm:col-span-5 col-span-12  mx-1">Client : {{clients.nom+" "+clients.prenom}}</span>
                              <span class="xl:col-span-3 sm:col-span-5 col-span-12  mx-1">Nombre de produit : {{clients.quantiter}}</span>
                              <span class="xl:col-span-3 sm:col-span-5 col-span-12  mx-1">Total_ttc : {{clients.total_ttc}} €</span>
                           </div>
                        </div>
                     </div>
                     <!-- Content -->
                     <div class="accordion-content px-5 pt-0 pb-1 overflow-hidden max-h-full">
                        <DisplayOrder :products="props.produits.panier" 
                        :slidePerView='{ 1536:{ slidesPerView:2}, 1024:{ slidesPerView:1}, 0:{ slidesPerView:1} }'
                        :classGridImage='classListe.gridImage'
                        :classGridText='classListe.gridBlock'
                        :hBlock='classListe.hBlock' />
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="p-4 bg-primary-100 rounded lg:col-span-1 col-span-4 lg:-my-5 lg:mr-5 flex flex-col">
            <div class="flex flex-col">
               <h2 class="text-center my-5 text-lg font-semibold">Résumer de la commande</h2>

               <span class="my-1">Nombre de clients : {{props.order.nb_client}}</span>
               <span class="my-1">Poids total : {{props.order.poids_total}} kg</span>
               <span class="my-1">Total de m² : {{props.order.total_m2}} m²</span>

               <h3 class="text-center my-5 text-lg font-semibold">Paiement</h3>
               <span class="my-1">Total HT : {{props.order.total_HT}} €</span>
               <span class="my-1">Total TVA : {{props.order.total_taxe}} €</span>
               <span class="my-1">Total TTC : {{props.order.total_ttc}} €</span>
               <span class="my-1">Total Payer : {{props.order.total_payer}} €</span>
               <span class="my-1">Total Restant À Payer : {{props.order.total_ttc - props.order.total_payer}} €</span>
            </div>
            <div class="w-full h-full flex flex-col justify-end">
               <a :href="getUrl()+'/pdf/facture'" rel="noopener" target="_blank" class="p-3 text-center bg-primary-50 mt-6 hover:bg-primary-200 transition duration-300 ease-in-out" v-if="props.order.total_ttc - props.order.total_payer == 0">Télécharger ma facture</a>
               <a :href="getUrl()+'/pdf/proforma'" rel="noopener" target="_blank" class="p-3 text-center bg-primary-50 mt-6 hover:bg-primary-200 transition duration-300 ease-in-out" v-else>Télécharger mon devis</a>
            </div>
         </div>
      </div>
   </TabPanel>
      <TabPanel>
         <h2 class="text-lg font-semibold">Document lier à la commande</h2>
         <div class="lg:ml-4 flex flex-col ">
            <a v-if="props.order.total_ttc - props.order.total_payer == 0" :href="getUrl()+'/pdf/facture'" rel="noopener" target="_blank" class="p-2 m-2 lg:text-lg text-sm bg-primary-50 rounded-lg hover:drop-shadow-xl hover:scale-[1.02] transition-full duration-300"><Bill /> Facture de la commande {{props.order.num_commande}}</a>
            <a :href="getUrl()+'/pdf/proforma'" rel="noopener" target="_blank" class="p-2 m-2 lg:text-lg text-sm bg-primary-50 rounded-lg hover:drop-shadow-xl hover:scale-[1.02] transition-full duration-300"><Bill /> Devis de la commande {{props.order.num_commande}}</a>
            <a :href="getUrl()+'/visuel'" rel="noopener" target="_blank" class="p-2 m-2 lg:text-lg text-sm bg-primary-50 rounded-lg hover:drop-shadow-xl hover:scale-[1.02] transition-full duration-300"><ImagesIcon />Télécharger les visuels des produits de la commande</a>
         </div>
      </TabPanel>
    </TabPanels>
  </TabGroup>
   </section>
</template>
