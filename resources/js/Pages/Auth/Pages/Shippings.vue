<script setup>
   import { Head,Link } from '@inertiajs/inertia-vue3';
   import { Table, setTranslations } from "@protonemedia/inertiajs-tables-laravel-query-builder";
   import { ref } from 'vue';

   setTranslations({
      next: "Suivant",
      no_results_found: "Aucun résultat",
      of: "de",
      per_page: "par page",
      previous: "Précédent",
      results: "Résultat",
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
                  document.location.href = "orders/clients/validation";
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
         text: 'Etes-vous sur de supprimer la commande ' + numCommande +' ?',
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
                        title: 'La commande ' + numCommande + ' à bien été suprimmer !'
                     });
                  } else {
                     Toast.fire({
                        icon: 'error',
                        title: 'Une erreur s\'est produite lors de la supression de la commande ' + numCommande + ', veuillez ressayer !'
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
         text: 'Etes-vous sur de supprimer la commande ' + numCommande +' ?',
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
                        title: 'La commande ' + numCommande + ' à bien été suprimmer !'
                     });
                  } else {
                     Toast.fire({
                        icon: 'error',
                        title: 'Une erreur s\'est produite lors de la supression de la commande ' + numCommande + ', veuillez ressayer !'
                     });
                  }
               }
            });
         }
      });
   };
</script>
<script >
   import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
   import Delete from 'icons/Delete.vue';
   import Edit from 'icons/Pencil.vue';
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
      <h1 class="text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 my-4">Historique des commandes</h1>

      <h2 class="text-center text-1xl text-primary-300">Liste commande </h2>
      <Table :meta="props.panierEdi" id="TabProducts" class="table">
         <template #body>
            <tr v-for="(panier, key) in props.panierEdi.data" :key="key" :id="'order_'+panier.id_panier_edi">
               <td data-label="TYPE COMMANDE" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                 <div v-if="panier.is_marketplace">
                     <span>Dropshipping</span>
                 </div>
                 <div v-else>
                     <span>Commercial</span>
                 </div>
               </td>
               <td data-label="N° COMMANDE" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{panier.num_commande}}
               </td>
               <td data-label="TOTAL CLIENTS" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{panier.nb_client}}
               </td>
               <td data-label="DATE COMMANDE" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{formatDate(panier.date_maj)}}
               </td>
               <td data-label="TOTAL PRODUIT" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{panier.produits_total}}
               </td>
               <td data-label="POIDS TOTAL" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{panier.poids_total}}
               </td>
               <td data-label="TOTAL M²" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{panier.total_m2}}
               </td>
               <td data-label="TOTAL HT" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{panier.total_HT}}
               </td> 
               <td data-label="DATE LIVRAISON ESTIMER" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{(panier.date_livraison != null ? formatDate(panier.date_livraison) : 'Pas encore de date')}}
               </td> 
               <td data-label="STATUT COMMANDE" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  {{(panier.is_validate ? 'Commande finalisée' : 'Commande non finalisée')}}
               </td> 
               <td data-label="ACTION" class="text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                  <div v-if="panier.is_validate">
                     <Link class="rounded p-4 bg-primary-100 hover:bg-primary-200 transition duration-300" :href="'/shippings/order/clients/'+panier.num_commande">Voir détails</Link>
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

<style>
@media (max-width: 1535px){
.table thead {
display: none;
}

.table tr{
display: block;
margin-bottom: 40px;
border: 1px solid #c9c9c9;
}

.table td {
display: block;
text-align: right;
border-bottom: 1px solid #c9c9c9;
}

.table td:before {
content: attr(data-label);
float: left;
font-weight: bold;
}
}
</style>