<script setup>
import { Head, usePage } from '@inertiajs/inertia-vue3';
import EtapeOrder from '@/Components/EtapeOrder.vue';
import { ref } from 'vue';

const props = defineProps(['client','panier', 'produits']);

var clientUser = ref(usePage().props.value.auth.user[0].client);
var listeEtape = ['Panier', 'Adresse Livraison / Facturation', 'Finaliser commande'];

const roundResult = (number, nbVirugule) => {
   return number.toFixed(nbVirugule);
};

var paymentType = ref(0);

var validationCommande = () => {
   axios.post('/cart/adresses/validation/order',{paymentType: paymentType.value}).then((response) => {
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
    }else{
      paymentType.value = 0;
    }
};
</script>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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
               <div class="grid grid-cols-2">
                  <div class="bg-primary-50 rounded sm:col-span-1 col-span-2 m-2 flex flex-col p-4">
                     <h2 class="text-center font-bold">Adresse de livraison</h2>
                     <span>{{props.client.nom_adresse}},</span>
                     <span>{{props.client.adresse1}},</span>
                     <span v-if="props.client.adresse2 != '' && props.client.adresse2 != null">{{props.client.adresse2}},</span>
                     <span v-if="props.client.adresse3 != '' && props.client.adresse3 != null">{{props.client.adresse3}},</span>
                     <span>{{props.client.code_postal+", "+props.client.ville}},</span>
                     <span>{{props.client.pays}}</span>
                  </div>
                  <div class="bg-primary-50 rounded sm:col-span-1 col-span-2 m-2 flex flex-col p-4">
                     <h2 class="text-center font-bold">Adresse de facturation</h2>
                     <span>{{props.client.nom_adresse_facturation}},</span>
                     <span>{{props.client.adresse1_facturation}},</span>
                     <span v-if="props.client.adresse2_facturation != '' && props.client.adresse2_facturation != null">{{props.client.adresse2_facturation}},</span>
                     <span v-if="props.client.adresse3_facturation != '' && props.client.adresse3_facturation != null">{{props.client.adresse3_facturation}},</span>
                     <span>{{props.client.code_postal_facturation+", "+props.client.ville_facturation}},</span>
                     <span>{{props.client.pays_facturation}}</span>
                  </div>
               </div>
               <div class="bg-primary-50 rounded m-2 p-4">
                  <h2 class="text-center font-bold">Total Commande</h2>
                  <div class="grid lg:grid-cols-5 grid-cols-4 justify-center flex-row mt-4 mx-6">
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span class="font-semibold text-gray-600">Quantiter : {{props.panier.produits_total}} pcs</span>
                        <hr class="absolute sm:block hidden w-px h-5 border border-primary-100  right-0" />
                     </div>
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span class="font-semibold text-gray-600">M² : {{props.panier.total_m2}} m²</span>
                        <hr class="absolute lg:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix HT : {{props.panier.total_HT}} €</span>
                        <hr class="absolute sm:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix TVA : {{props.panier.total_taxe}} €</span>
                        <hr class="absolute lg:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix TTC : {{props.panier.total_ttc}} €</span>
                     </div>
                  </div>
               </div>

               
               <div class="grid grid-cols-1 flex items-center justify-center my-4 mx-2">
                  <h2 class="px-5 py-3 bg-primary-50 rounded font-bold text-center">Produits</h2>
                  <div v-if="produits != undefined" class="grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50">
                     <div v-for="(produit, key) in props.produits.panier" :key="key" class="2xl:col-span-1 lg:col-span-2 col-span-4 w-full px-2" >
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
                  </div>
               </div>
               <form class="grid grid-cols-4 bg-primary-50 rounded px-4 py-2 mb-4">
                  <div class="lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center">
                    <!-- <input @click="verifCheck($event,2)" id="paymentCard" name="paymentType" type="radio" value="2" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100"> -->
                    <input disabled id="paymentCard" name="paymentType" type="radio" value="2" class="w-4 h-4 cursor-not-allowed text-primary-200 bg-gray-200 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                    <label for="paymentCard" class="ml-2 text-lg font-medium text-gray-900 ">Paiement par CB</label>
                  </div>
                  <div class="lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center">
                     <input @click="verifCheck($event,1)" id="paymentVirement" name="paymentType" type="radio" value="1" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                     <label for="paymentVirement" class="ml-2 text-lg font-medium text-gray-900 ">Paiement par Virement Bancaire</label>
                  </div>
               </form>
               <div class="flex justify-center mb-5">
                  <button :disabled="(paymentType == 0 ? true : false)" @click="validationCommande" type="button" class="p-2 border border-primary-300 rounded bg-primary-50 
                     hover:bg-primary-100 transition duration-300 disabled:cursor-not-allowed disabled:bg-primary-200">Finaliser la commande</button>
               </div>
            </div>
         </div>
      </div>    
   </section>
</template>