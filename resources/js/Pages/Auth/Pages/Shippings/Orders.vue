<script setup>
import { Head,usePage } from '@inertiajs/inertia-vue3';
import { createApp } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel,TransitionRoot,TransitionChild } from '@headlessui/vue';
import DisplayOrder from '@/Components/DisplayOrder.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { HomeIcon,DocumentTextIcon  } from '@heroicons/vue/24/solid';
      
var links = [{
      title: 'Accueil',
      link: '/',
      icon: HomeIcon,
      active: false
   },{
      title: 'Historique des commandes',
      link: '/shippings',
      icon: DocumentTextIcon,
      active: false
   },{
      title: 'Commande N° '+props.order.num_commande,
      link: '/shippings/order/clients/'+props.order.num_commande,
      icon: '',
      active: true
   }];

const props = defineProps(['order', 'clients','produits']);
const classListe = {
   gridImage : "2xl:col-span-3 xl:col-span-4 lg:col-span-3 sm:col-span-2 xsm:col-span-3 col-span-4",
   gridBlock : "2xl:col-span-9 xl:col-span-8 lg:col-span-9 sm:col-span-10 xsm:col-span-9 col-span-8",
   hBlock : "lg:!h-52 sm:!h-42 !h-42"
}
const imgBase64 = "data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDQwMDAgNDAwMCIgd2lkdGg9IjEwMDAiIGhlaWdodD0iMTAwMCI+PHN0eWxlPi5he2ZpbGw6I2EzYTNhM30uYntmaWxsOiNmZmZ9PC9zdHlsZT48cGF0aCBjbGFzcz0iYSIgZD0ibTQwMDAgNDAwMGgtNDAwMHYtNDAwMGg0MDAweiIvPjxwYXRoIGNsYXNzPSJiIiBkPSJtMzI2NSAzMDQ2Ljh2MjY1LjJoLTI1MzB2LTI2NS4yYzAtNDg5IDU2Ni40LTg4NS41IDEyNjUtODg1LjUgNjk4LjYgMCAxMjY1IDM5Ni41IDEyNjUgODg1LjV6Ii8+PHBhdGggY2xhc3M9ImIiIGQ9Im0yNjI0LjEgMTMxMi4xYzAgMzQ0LjYtMjc5LjQgNjI0LTYyNC4xIDYyNC0zNDQuNyAwLTYyNC4xLTI3OS40LTYyNC4xLTYyNCAwLTM0NC43IDI3OS40LTYyNC4xIDYyNC4xLTYyNC4xIDM0NC43IDAgNjI0LjEgMjc5LjQgNjI0LjEgNjI0LjF6Ii8+PC9zdmc+";

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
import { CheckCircleIcon } from '@heroicons/vue/20/solid';

export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),

   // Using the shorthand
   layout: AuthenticatedLayout,
}
</script>
<template>

   <Head :title="'Commande N°'+props.order.num_commande" />

   <section class="container mx-auto px-2 mt-5">
      <Breadcrumbs :links="links" />
      <div v-if="usePage().props.value.session.messageValidation != undefined" class="w-full bg-green-200 px-4 py-2 rounded flex items-center mb-4">
         <CheckCircleIcon class="h-8 w-8 text-green-600" />
         <span class="pl-2 text-green-600">{{usePage().props.value.session.messageValidation}}</span>
      </div> 

      <div class="p-4 bg-primary-50">
         <h1 class="lg:text-xl text-lg font-bold">Commande n°{{props.order.num_commande}}</h1>
      </div>

      

   <TabGroup>
    <TabList class="overflow-hidden flex space-x-1 rounded-xl  p-1 bg-primary-50 my-5">
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
            Documents et visuels
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
      <div class="my-8 relative" >
         <div class="p-4">
            <div class="px-4 my-2 border border-primary-300 rounded">
               <div class="flex flex-col">
                  <div class="flex items-center justify-center flex-col">
                     <h2 class="text-center my-3 text-lg font-semibold">Résumé de la commande</h2>
                     <div class="flex space-x-4">
                        <span class="my-1">Nombre de clients : {{props.order.nb_client}}</span>
                        <span class="my-1">Poids total : {{props.order.poids_total}} kg</span>
                        <span class="my-1">Total de m² : {{props.order.total_m2}} m²</span>
                     </div>
                     
                  </div>
                  <div class="flex items-center justify-center flex-col mx-5">
                     <h2 class="text-center my-3 text-lg font-semibold">Paiement</h2>
                     <div class="flex space-x-4">
                        <span class="my-1">Montant HT : {{props.order.montant_ht}} €</span>
                        <span class="my-1">Transport HT : {{props.order.prix_transport}} €</span>
                        <span class="my-1">Total HT : {{props.order.total_HT}} €</span>
                        <span class="my-1">Total TVA : {{props.order.total_taxe}} €</span>
                        <span class="my-1">Total TTC : {{props.order.total_ttc}} €</span>
                        <span class="my-1">Total Payer : {{props.order.total_payer}} €</span>
                        <span class="my-1">Total Restant À Payer : {{props.order.total_ttc - props.order.total_payer}} €</span>
                     </div>
                     
                  </div>
               </div>
               <div class="w-full h-full flex flex-col justify-end my-2">
                  <a :href="getUrl()+'/pdf/facture'" rel="noopener" target="_blank" class=" p-3 text-center bg-primary-50 mt-6 hover:bg-primary-200 transition duration-300 ease-in-out" v-if="props.order.total_ttc - props.order.total_payer == 0">Télécharger ma facture</a>
                  <a :href="getUrl()+'/pdf/proforma'" rel="noopener" target="_blank" class=" p-3 text-center bg-primary-50 mt-6 hover:bg-primary-200 transition duration-300 ease-in-out" v-else>Télécharger mon devis</a>
               </div>
            </div>
            <div class="bg-primary-50 my-8 px-2 py-2 relative">
               <h2 class="text-xl font-semibold">Liste des commandes {{props.order.is_marketplace ? 'clients' : '' }}</h2>
               <div class="my-5 ">
                  <div class=" py-4 px-5">
                     <!-- What is term -->
                     <div class=" " v-for="(client, key) in clients" :key="key" :id="'ordersResum_'+client.id_client_edi">
                        <DisplayOrder :client="client" :isMK="props.order.is_marketplace" />
                     </div>
                  </div>
               </div>
            </div>      
         </div>
      </div>
   </TabPanel>
      <TabPanel>
         <h2 class="text-lg font-semibold">Document lié à la commande</h2>
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
