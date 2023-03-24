<script setup>
import { Head, usePage } from '@inertiajs/inertia-vue3';
import EtapeOrder from '@/Components/EtapeOrder.vue';
import { ref } from 'vue';

const props = defineProps(['client','panier', 'produits']);

var clientUser = ref(usePage().props.value.auth.user[0].client);
var clients = ref(usePage().props.value.PanierDrop.panier.clients);
var panier = ref(usePage().props.value.PanierDrop.panier.panierActuel);
var panierDrop = ref(usePage().props.value.PanierDrop);
var listeEtape = ['Panier', 'Adresse Livraison / Facturation', 'Finaliser commande'];
const imgBase64 = "data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDQwMDAgNDAwMCIgd2lkdGg9IjEwMDAiIGhlaWdodD0iMTAwMCI+PHN0eWxlPi5he2ZpbGw6I2EzYTNhM30uYntmaWxsOiNmZmZ9PC9zdHlsZT48cGF0aCBjbGFzcz0iYSIgZD0ibTQwMDAgNDAwMGgtNDAwMHYtNDAwMGg0MDAweiIvPjxwYXRoIGNsYXNzPSJiIiBkPSJtMzI2NSAzMDQ2Ljh2MjY1LjJoLTI1MzB2LTI2NS4yYzAtNDg5IDU2Ni40LTg4NS41IDEyNjUtODg1LjUgNjk4LjYgMCAxMjY1IDM5Ni41IDEyNjUgODg1LjV6Ii8+PHBhdGggY2xhc3M9ImIiIGQ9Im0yNjI0LjEgMTMxMi4xYzAgMzQ0LjYtMjc5LjQgNjI0LTYyNC4xIDYyNC0zNDQuNyAwLTYyNC4xLTI3OS40LTYyNC4xLTYyNCAwLTM0NC43IDI3OS40LTYyNC4xIDYyNC4xLTYyNC4xIDM0NC43IDAgNjI0LjEgMjc5LjQgNjI0LjEgNjI0LjF6Ii8+PC9zdmc+";


console.log(panier.value);
const roundResult = (number, nbVirugule) => {
   return number.toFixed(nbVirugule);
};

var formatDate = (date) => {
   return new Date(date).toLocaleDateString("fr-FR");
};
var formatPrix = (prix) => {
   return new Intl.NumberFormat("fr-FR", {
      style: "currency",
      currency: "EUR",
   }).format(prix);
};
var paymentType = ref(0);

var validationCommande = () => {
   axios.post('/dropshipping/cart/validation/order',{paymentType: paymentType.value}).then((response) => {
           if(response.status == 200){
            document.location.href = "/shippings/order/clients/"+response.data.num_commande;
           }else {

            Toast.fire({
               icon: 'error',
               title: 'Une erreur s\'est produite lors de l\'enregistrement de votre commande, veuillez ressayer !'
            });
         };
   });
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
};

var verifCheck = (e,type) => {
    if(e.target.checked){
      paymentType.value = type;
      if(type == 2){
         axios.post('/dropshipping/cart/payment/cb',{paymentType: paymentType.value}).then((response) => {
           if(response.status == 200){
            if(response.data.statut){
               document.getElementById('paymentCB').innerHTML =response.data.formpay;
            }else{
               Toast.fire({
               icon: 'error',
               title: response.data.msg
            });
            }
            console.log(response);
           }else {
            Toast.fire({
               icon: 'error',
               title: 'Une erreur s\'est produite lors de la génération du formulaire de paiement, veuillez ressayer !'
            });
         };
   });
      }
    }else{
      paymentType.value = 0;
    }
};
</script>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),
   // Using the shorthand
   layout: AuthenticatedLayout,
};
</script>

<template>

   <Head title="Validation - Panier" />
   
   <section class="container mx-auto mt-5">
      
      <div class="grid grid-cols-4">
         <div class="xl:col-span-1 col-span-4">
            <EtapeOrder :etape="3" :nbEtape="3" :listeEtape="listeEtape" />
         </div>
         <div class="xl:col-span-3 col-span-4">
            <h1 class="text-center text-3xl text-primary-300">Finalisation de la commande</h1>
            <div class="m-5">
               <div class="bg-primary-50 rounded m-2 p-4">
                  <h2 class="text-center font-bold">Total Commande</h2>
                  <div class="grid lg:grid-cols-5 grid-cols-4 justify-center flex-row mt-4 mx-6">
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span class="font-semibold text-gray-600">Quantiter : {{panier.produits_total}} pcs</span>
                        <hr class="absolute sm:block hidden w-px h-5 border border-primary-100  right-0" />
                     </div>
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span class="font-semibold text-gray-600">M² : {{panier.total_m2}} m²</span>
                        <hr class="absolute lg:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix HT : {{formatPrix(panier.total_HT)}} </span>
                        <hr class="absolute sm:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix TVA : {{formatPrix(panier.total_taxe)}} </span>
                        <hr class="absolute lg:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix TTC : {{formatPrix(panier.total_ttc)}} </span>
                     </div>
                  </div>
               </div>

               
               <div class="xl:max-h-[calc(100vh-550px)] lg:max-h-[calc(100vh-250px)] max-h-screen  sm:px-6 overflow-auto grid grid-cols-1 flex items-center justify-center my-4 mx-2">
                  <div v-for="(client,key) in clients" :key="key" class="my-2">
                     <div class="border p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex justify-between items-center mb-4">
                           <h2 class="text-xl font-bold">{{client.client.ref_externe}} - {{ client.client.prenom+" "+client.client.nom }}</h2>
                        </div>
                        <div class="flex items-center mb-4">
                           <img :src="imgBase64" alt="Logo client" class="w-12 h-12 rounded-full mr-4">
                           <div>
                              <p class="font-bold">{{ client.client.nom_adresse }}</p>
                              <p class="text-gray-600">{{ client.client.adresse1 }}, 
                                 {{ (client.client.adresse2 != '' && client.client.adresse2 != null ? client.client.adresse2+"," : '') }} 
                                 {{ (client.client.adresse3 != '' && client.client.adresse3 != null ? client.client.adresse3+"," : '') }}
                                 {{ client.client.code_postal }} {{ client.client.ville }}, 
                                 {{ client.client.pays }}</p>
                           </div>
                        </div>
                        <div class="border-b border-gray-300 mb-4">

                        </div>
                        <div>
                           <div v-if="client.produits != undefined" class="grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50">
                              <div v-if="client.produits.length > 0" v-for="(produit, key) in client.produits" :key="key" class="2xl:col-span-1 lg:col-span-2 col-span-4 w-full px-2" >
                                 <div class="w-full lg:p-4 sm:p-3 p-2  grid bg-gray-100 rounded grid-cols-12 my-2">
                                    <div class="xl:col-span-4 lg:col-span-4 sm:col-span-2 xsm:col-span-4 col-span-4 flex items-center justify-center">
                                       <div v-if="produit.photo != null"
                                          class="lg:h-[150px] sm:h-[130px] h-full w-full px-2">
                                          <img :src="'https://gestion.tapis-nazar.fr/img/produit/'+produit.photo.img_produit"
                                             :alt="produit.code_sku" class="w-full h-full object-cover rounded-xl" />
                                       </div>
                                       <div v-else>
                                          <span>Pas de photo pour ce produit !</span>
                                       </div>
                                    </div>
                                    <div class="xl:col-span-8 lg:col-span-8 sm:col-span-10 xsm:col-span-8 col-span-8 flex flex-col xl:text-lg text-sm">
                                       <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">SKU : {{ produit.code_sku }}</span>
                                       <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Taille : {{produit.dimension.largeur + 'x' +
                                          produit.dimension.longueur }}</span>
                                       <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Prix du M² : {{ calcul_prix_gamme(produit.gamme.prix_vente_ht_m2) }} € HT</span>
                                       <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">M² : {{ roundResult((produit.dimension.largeur/100) *  (produit.dimension.longueur/100)*produit.panier.quantiter,2) }} m²</span>
                                       <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Quantiter : {{ produit.panier.quantiter }}</span>
                                       <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Prix HT : {{ roundResult(((produit.dimension.largeur/100) *  (produit.dimension.longueur/100)*produit.panier.quantiter) * calcul_prix_gamme(produit.gamme.prix_vente_ht_m2),2)}} €</span>
                                    </div>
                                 </div>
                              </div>
                              <div v-else class="flex items-center">
                                 <span class="font-semibold">Panier Vide !</span>
                              </div>
                           </div>
                        </div>
                        <div class="border-t border-gray-300 mt-4 pt-4 text-right">
                           <p class="font-bold text-xl">Total commande HT : {{ formatPrix(client.client.total_ht) }}</p>
                        </div>
                     </div>
                  </div>
               </div>
               <form class="grid grid-cols-4 bg-primary-50 rounded px-4 py-2 mb-4">
                  <div class="lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center">
                    <input @click="verifCheck($event,2)" id="paymentCard" name="paymentType" type="radio" value="2" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                    <!-- <input disabled id="paymentCard" name="paymentType" type="radio" value="2" class="w-4 h-4 cursor-not-allowed text-primary-200 bg-gray-200 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100"> -->
                    <label for="paymentCard" class="ml-2 text-lg font-medium text-gray-900 ">Paiement par CB</label>
                  </div>
                  <div class="lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center">
                     <input @click="verifCheck($event,1)" id="paymentVirement" name="paymentType" type="radio" value="1" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                     <label for="paymentVirement" class="ml-2 text-lg font-medium text-gray-900 ">Paiement par Virement Bancaire</label>
                  </div>
               </form>
               <div id="paymentCB">

               </div>
               <div class="flex justify-center mb-5">
                  <button :disabled="(paymentType == 0 ? true : false)" @click="validationCommande" type="button" class="p-2 border border-primary-300 rounded bg-primary-50 
                     hover:bg-primary-100 transition duration-300 disabled:cursor-not-allowed disabled:bg-primary-200">Finaliser la commande</button>
               </div>
            </div>
         </div>
      </div>    
   </section>
</template>