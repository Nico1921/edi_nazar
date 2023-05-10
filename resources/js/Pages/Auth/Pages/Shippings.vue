<script setup>
   import { Head,Link } from '@inertiajs/inertia-vue3';
   import { Table, setTranslations,  } from "@protonemedia/inertiajs-tables-laravel-query-builder";
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
         active: true
   }];
   
   setTranslations({
      next: "Suivant",
      no_results_found: "Aucun résultat",
      of: "de",
      per_page: "par page",
      previous: "Précédent",
      results: "Résultat(s)",
      to: "à",
   });

   const props = defineProps(["panierEdi"]);
   
   const formatDate = (date) => {
      var dateType = new Date(date);
      return (dateType.getDate() < 10 ? '0'+dateType.getDate() : dateType.getDate())+"/"+((dateType.getMonth()+1) < 10 ? '0'+(dateType.getMonth()+1) : dateType.getMonth()+1)+"/"+dateType.getFullYear();
   };

   const editCommande = (id_panier) => {
      axios.post('shippings/edit', { id_panier_edi: id_panier }).then((response) => {
            if (response.status == 200) {
               if(response.data){
                  document.location.href = "/dropshipping/gamme";
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la récupération de la commande, veuillez ressayer !'
                  });
               }
            }
      });
   };

   const editPanier = (id_panier) => {
      axios.post('/shippings/panier/edit', { id_panier_edi: id_panier }).then((response) => {
            if (response.status == 200) {
               if(response.data){
                  document.location.href = "cart";
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la récupération de la commande, veuillez ressayer !'
                  });
               }
            }
      });
   };

   const deletePanier = (id_panier_edi,numCommande) => {
      Swal.fire({
         title: 'Attention',
         text: 'Êtes-vous sur de supprimer la commande ' + numCommande +' ?',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         cancelButtonText: 'Non',
         confirmButtonText: 'Oui',
      }).then((result) => {
         if (result.isConfirmed) {
            axios.post('/shippings/panier/delete', {
               id_panier_edi: id_panier_edi
            }).then((response) => {
               if (response.status == 200) {
                  if (response.data) {
                     document.getElementById('order_' + id_panier_edi).remove();
                     Toast.fire({
                        icon: 'success',
                        title: 'La commande ' + numCommande + ' a bien été supprimer !'
                     });
                  } else {
                     Toast.fire({
                        icon: 'error',
                        title: 'Une erreur s\'est produite lors de la suppression de la commande ' + numCommande + ', veuillez ressayer !'
                     });
                  }
               }
            });
         }
      });
   };

   const deleteClient = (id_panier_edi,numCommande) => {
      Swal.fire({
         title: 'Attention',
         text: 'Êtes-vous sur de supprimer la commande ' + numCommande +' ?',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         cancelButtonText: 'Non',
         confirmButtonText: 'Oui',
      }).then((result) => {
         if (result.isConfirmed) {
            axios.post('/shippings/delete', {
               id_panier_edi: id_panier_edi
            }).then((response) => {
               if (response.status == 200) {
                  if (response.data) {
                     document.getElementById('order_' + id_panier_edi).remove();
                     Toast.fire({
                        icon: 'success',
                        title: 'La commande ' + numCommande + ' a bien été supprimer !'
                     });
                  } else {
                     Toast.fire({
                        icon: 'error',
                        title: 'Une erreur s\'est produite lors de la suppression de la commande ' + numCommande + ', veuillez ressayer !'
                     });
                  }
               }
            });
         }
      });
   };

   var round = (number) => {
      return number.toFixed(2);
   };
</script>
<script >
   import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
   import Delete from 'icons/Delete.vue';
   import Edit from 'icons/Pencil.vue';
   import { ChevronDownIcon,ChevronUpIcon,ChevronUpDownIcon } from '@heroicons/vue/24/outline'; 
   export default {
      // Using a render function
      layout: (h, page) => h(AuthenticatedLayout, () => child),
      // Using the shorthand
      layout: AuthenticatedLayout,
   };
</script>

<template>
   <Head title="Expédition Clients" />

   <section class="container mx-auto">
      <Breadcrumbs :links="links" />
      <h1 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 my-4">Historique des commandes</h1>

      <h2 class="text-center text-1xl text-primary-300">Liste commandes </h2>
      <Table :meta="props.panierEdi" id="TabProducts" class="table mx-6">
         <template v-slot:head="slotHead">
                <tr class="font-medium text-xs uppercase text-left tracking-wider text-gray-500 py-3 px-6">
                  <th class="table-cell">
                        <div class="py-3 sm:px-6 px-2 w-full">
                            <span class="flex flex-row items-center"><span class="uppercase">Type Commande</span></span>
                        </div>
                    </th>  
                  <th class="table-cell" @click="slotHead.sortBy('num_commande')">
                        <button class="py-3 sm:px-6 px-2 w-full" dusk="sort-num_commande">
                            <span class="flex flex-row items-center">
                              <span class="uppercase">N° Commande</span>
                              <ChevronDownIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('num_commande').sorted == 'desc'" />
                              <ChevronUpIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('num_commande').sorted == 'asc'" />
                              <ChevronUpDownIcon class="w-3 h-3 ml-2 text-gray-400" v-if="slotHead.header('num_commande').sorted == false" />
                           </span>
                     </button>
                    </th>
                    <th class="lg:table-cell hidden">
                        <div class="py-3 px-6 w-full">
                            <span class="flex flex-row items-center"><span class="uppercase">clients</span></span>
                        </div>
                    </th>
                    <th class="sm:table-cell hidden" @click="slotHead.sortBy('date_commande')">
                     <button class="py-3 sm:px-6 px-1 w-full flex flex-row items-center" dusk="sort-date_commande">
                            <span class="flex flex-row items-center">
                              <span class="uppercase">Date commande</span>
                              <ChevronDownIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('date_commande').sorted == 'desc'" />
                              <ChevronUpIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('date_commande').sorted == 'asc'" />
                              <ChevronUpDownIcon class="w-3 h-3 ml-2 text-gray-400" v-if="slotHead.header('date_commande').sorted == false" />
                           </span>
                     </button>               
                    </th>
                    <th class="2xl:table-cell hidden" @click="slotHead.sortBy('produits_total')">
                        <button  class="py-3 px-6 w-full flex flex-row items-center" dusk="sort-produits_total">
                            <span class="flex flex-row items-center"><span class="uppercase">Total produit</span></span>
                            <ChevronDownIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('produits_total').sorted == 'desc'" />
                              <ChevronUpIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('produits_total').sorted == 'asc'" />
                              <ChevronUpDownIcon class="w-3 h-3 ml-2 text-gray-400" v-if="slotHead.header('produits_total').sorted == false" />
                           </button>
                    </th>
                    <th class="xl:table-cell hidden" @click="slotHead.sortBy('poids_total')">
                        <button class="py-3 px-6 w-full flex flex-row items-center" dusk="sort-poids_total">
                            <span class="flex flex-row items-center"><span class="uppercase">Poids Total</span></span>
                            <ChevronDownIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('poids_total').sorted == 'desc'" />
                              <ChevronUpIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('poids_total').sorted == 'asc'" />
                              <ChevronUpDownIcon class="w-3 h-3 ml-2 text-gray-400" v-if="slotHead.header('poids_total').sorted == false" />
                           </button>
                    </th>
                    <th class="xl:table-cell hidden" @click="slotHead.sortBy('total_m2')">
                        <button class="py-3 px-6 w-full flex flex-row items-center" dusk="sort-total_m2">
                            <span class="flex flex-row items-center"><span class="uppercase">Total m²</span></span>
                            <ChevronDownIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('total_m2').sorted == 'desc'" />
                              <ChevronUpIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('total_m2').sorted == 'asc'" />
                              <ChevronUpDownIcon class="w-3 h-3 ml-2 text-gray-400" v-if="slotHead.header('total_m2').sorted == false" />
                           </button>
                    </th>
                    <th class="lg:table-cell hidden" @click="slotHead.sortBy('total_HT')">
                        <button class="py-3 px-6 w-full flex flex-row items-center" dusk="sort-total_HT">
                            <span class="flex flex-row items-center"><span class="uppercase">Total HT</span></span>
                            <ChevronDownIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('total_HT').sorted == 'desc'" />
                              <ChevronUpIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('total_HT').sorted == 'asc'" />
                              <ChevronUpDownIcon class="w-3 h-3 ml-2 text-gray-400" v-if="slotHead.header('total_HT').sorted == false" />
                           </button>
                    </th>
                    <th class="lg:table-cell hidden" @click="slotHead.sortBy('date_livraison')">
                        <button class="py-3 px-6 w-full flex flex-row items-center"  dusk="sort-date-livraison-estimer">
                            <span class="flex flex-row items-center"><span class="uppercase">Date livraison estimée</span></span>
                            <ChevronDownIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('date_livraison').sorted == 'desc'" />
                              <ChevronUpIcon class="w-3 h-3 ml-2 text-green-600" v-if="slotHead.header('date_livraison').sorted == 'asc'" />
                              <ChevronUpDownIcon class="w-3 h-3 ml-2 text-gray-400" v-if="slotHead.header('date_livraison').sorted == false" />
                           </button>
                    </th>
                    <th class="2xl:table-cell hidden">
                        <div class="py-3 px-6 w-full">
                            <span class="flex flex-row items-center"><span class="uppercase">Statut commande</span></span>
                        </div>
                    </th>
                    <th class="table-cell">
                        <div class="py-3 sm:px-6 px-1 w-full flex flex-row items-center">
                            <span class="flex flex-row items-center "><span class="uppercase">Action</span></span>
                        </div>
                    </th>
                </tr>
         </template>
         <template #body>
            <tr v-for="(panier, key) in props.panierEdi.data" :key="key" :id="'order_'+panier.id_panier_edi">
               <td data-label="TYPE COMMANDE" class="table-cell text-sm py-4 2xl:px-5 sm:px-5 px-2 text-gray-500 lg:text-center whitespace-nowrap">
                  {{(panier.is_marketplace ? 'Dropshipping' : 'Commandes Entrepôt')}}
               </td>
               <td data-label="N° COMMANDE" class="table-cell text-sm py-4 2xl:px-6 sm:px-5 px-2 text-gray-500 lg:text-center whitespace-nowrap">
                  {{panier.num_commande}}
               </td>
               <td data-label="CLIENTS" class="lg:table-cell hidden text-sm py-4 2xl:px-5 sm:px-5 px-2  text-gray-500 lg:text-center whitespace-nowrap">
                  {{panier.nb_client}}
               </td>
               <td data-label="DATE COMMANDE" class="sm:table-cell hidden text-sm py-4 2xl:px-6 sm:px-5 px-1 text-gray-500 lg:text-center whitespace-nowrap">
                  {{formatDate(panier.date_commande)}}
               </td>
               <td data-label="TOTAL PRODUIT" class="2xl:table-cell hidden text-sm py-4 2xl:px-6 sm:px-5 px-6  text-gray-500 lg:text-center whitespace-nowrap">
                  {{panier.produits_total}}
               </td>
               <td data-label="POIDS TOTAL" class="xl:table-cell hidden text-sm py-4 2xl:px-6 sm:px-5 px-6 text-gray-500 lg:text-center whitespace-nowrap">
                  {{panier.poids_total}}
               </td>
               <td data-label="TOTAL M²" class="xl:table-cell hidden text-sm py-4 2xl:px-6 sm:px-5 px-6 text-gray-500 lg:text-center whitespace-nowrap">
                  {{round(panier.total_m2)}}
               </td>
               <td data-label="TOTAL HT" class="lg:table-cell hidden text-sm py-4 2xl:px-6 sm:px-5 px-6 text-gray-500 lg:text-center whitespace-nowrap">
                  {{panier.total_HT}}
               </td> 
               <td data-label="DATE LIVRAISON ESTIMER" class="lg:table-cell hidden text-sm py-4 2xl:px-6 sm:px-5 px-6 lg:text-center text-gray-500 whitespace-nowrap">
                  {{(panier.date_livraison != null && panier.date_livraison != '0000-00-00' ? formatDate(panier.date_livraison) : 'Pas encore de date')}}
               </td> 
               <td data-label="STATUT COMMANDE" class="2xl:table-cell hidden text-sm py-4 2xl:px-5 sm:px-5 px-6text-gray-500 whitespace-nowrap">
                  {{(panier.is_validate ? 'Commande finalisée' : 'Commande non finalisée')}}
               </td> 
               <td data-label="ACTION" class="table-cell text-sm py-4 2xl:px-4 sm:px-5 px-1 text-gray-500 whitespace-nowrap">
                  <div v-if="panier.is_validate">
                     <Link class="rounded 2xl:p-3 p-2 bg-primary-100 hover:bg-primary-200 transition duration-300" :href="'/shippings/order/clients/'+panier.num_commande">Voir détails</Link>
                  </div>
                  <div v-else-if="panier.is_marketplace">
                     <button @click="editCommande(panier.id_panier_edi)" class="rounded p-2 bg-primary-100 hover:bg-primary-200 transition duration-300"><Edit /></button>
                     <button @click="deleteClient(panier.id_panier_edi,panier.num_commande)" class="rounded notDeployAccordion p-2 bg-red-500 hover:bg-red-300 transition duration-300 ml-2"><Delete class="text-white" /></button>
                  </div>
                  <div v-else-if="!panier.is_marketplace">
                     <button @click="editPanier(panier.id_panier_edi)" class="rounded p-2 bg-primary-100 hover:bg-primary-200 transition duration-300"><Edit /></button>
                     <button @click="deletePanier(panier.id_panier_edi,panier.num_commande)" class="rounded notDeployAccordion p-2 bg-red-500 hover:bg-red-300 transition duration-300 ml-2"><Delete class="text-white" /></button>
                  </div>
               </td> 
            </tr>
         </template>
      </Table>
   </section>
</template>