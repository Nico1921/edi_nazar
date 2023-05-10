<script setup>
import { Head, usePage } from '@inertiajs/inertia-vue3';
import EtapeOrder from '@/Components/EtapeOrder.vue';
import { ref } from 'vue';
import BoutonPaiement from '@/Components/BouttonPaiement.vue';
import {
  RadioGroup,
  RadioGroupLabel,
  RadioGroupDescription,
  RadioGroupOption,
} from '@headlessui/vue';

const props = defineProps(['client','panier', 'produits']);

var clientUser = ref(usePage().props.value.auth.user[0].client);
var listeEtape = ['Panier', 'Adresse Livraison / Facturation', 'Finaliser commande'];
var hrefEtape = ['/cart', '/cart/adresses', '/cart/validation'];

const roundResult = (number, nbVirugule) => {
   return parseFloat(number).toFixed(nbVirugule);
};

var venteCondition = ref(0);
var paymentType = ref(0);

var validationCommande = () => {
   const btnProcess = document.querySelectorAll('.btnProcess');
         for(let i = 0;i<btnProcess.length;i++){
            btnProcess[i].classList.add('opacity-25');
            btnProcess[i].setAttribute('disabled','disabled');
         }
   axios.post('/cart/validation/order',{paymentType: paymentType.value}).then((response) => {
           if(response.status == 200){
            document.location.href = "/shippings/order/clients/"+response.data.num_commande;
           }else {

            Toast.fire({
               icon: 'error',
               title: 'Une erreur s\'est produite lors de l\'enregistrement de votre commande, veuillez ressayer !'
            });
            const btnProcess = document.querySelectorAll('.btnProcess');
            for(let i =0 ;i<btnProcess.length;i++){
               btnProcess[i].classList.remove('opacity-25');
               btnProcess[i].removeAttribute('disabled');
            }
         };
   });
   
};

var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};

/*
var calcul_prix_gamme = (prix_gamme) => {
   var HT = prix_gamme;
   if(clientUser.value.taux_remise > 0){
      HT = HT - ((HT) * (clientUser.value.taux_remise /100));
   }
   return roundNumber(HT);
};
*/

var verifCheck = (e,type) => {
      if(type == 2){
         if(document.getElementById('paymentCB').getElementsByTagName('form').length === 0){
            axios.post('/cart/payment/cb',{paymentType: paymentType.value}).then((response) => {
               if(response.status == 200){
                  if(response.data.statut){
                     var btn = document.getElementById('bouttonPaiement');
                     document.getElementById('paymentCB').innerHTML =response.data.formpay;
                     document.getElementById('submitPayButton').appendChild(btn);
                  }else{
                     Toast.fire({
                        icon: 'error',
                        title: response.data.msg
                     });
                  }
               }else {
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la génération du formulaire de paiement, veuillez ressayer !'
                  });
               };
            });
         } 
      }
};

var verifCheckVenteCondition = (e) => {
    if(e.target.checked){
      venteCondition.value = true;
    }else{
      venteCondition.value = false;
    } 
};

var formatPrix = (prix) => {
   return new Intl.NumberFormat("fr-FR", {
      style: "currency",
      currency: "EUR",
   }).format(prix);
};
</script>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {ExclamationCircleIcon,CreditCardIcon,BuildingLibraryIcon,CheckCircleIcon,ArrowRightCircleIcon} from '@heroicons/vue/24/outline';
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
         <div class="col-span-4">
            <EtapeOrder :hrefEtape="hrefEtape" :etape="3" :nbEtape="3" :listeEtape="listeEtape" />
         </div>
         <div class="col-span-4 xl:mx-16 lg:mx-8">
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
                  <div class="grid 2xl:grid-cols-7 grid-cols-4 justify-center flex-row mt-4 mx-6">
                     <div class="2xl:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span class="font-semibold text-gray-600">Quantité : {{props.panier.produits_total}} pcs</span>
                        <hr class="absolute sm:block hidden w-px h-5 border border-primary-100  right-0" />
                     </div>
                     <div class="2xl:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span class="font-semibold text-gray-600">M² : {{props.panier.total_m2}} m²</span>
                        <hr class="absolute lg:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="2xl:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Montant HT : {{formatPrix(props.panier.montant_ht)}} </span>
                        <hr class="absolute sm:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="2xl:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Transport HT : {{formatPrix(props.panier.prix_transport)}} </span>
                        <hr class="absolute sm:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="2xl:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix HT : {{formatPrix(props.panier.total_HT)}} </span>
                        <hr class="absolute sm:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="2xl:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix TVA : {{formatPrix(props.panier.total_taxe)}} </span>
                        <hr class="absolute lg:block hidden w-px h-5 border border-primary-100 right-0" />
                     </div>
                     <div class="2xl:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative">
                        <span lass="font-semibold text-gray-600">Prix TTC : {{formatPrix(props.panier.total_ttc)}} </span>
                     </div>
                  </div>
               </div>

               
               <div class="grid grid-cols-1 flex items-center justify-center my-4 mx-2">
                  <h2 class="px-5 py-3 bg-primary-50 rounded font-bold text-center">Produits</h2>
                  <div v-if="produits != undefined" class="grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50 xl:max-h-[calc(100vh-550px)] lg:max-h-[calc(100vh-250px)] max-h-screen overflow-auto">
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
                              <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Prix du M² : {{ produit.gamme.prix_vente_ht_m2_remise?produit.gamme.prix_vente_ht_m2_remise:produit.gamme.prix_vente_ht_m2 }} € HT</span>
                              <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">M² : {{ roundResult((produit.dimension.largeur/100) *  (produit.dimension.longueur/100)*produit.panier.quantiter,2) }} m²</span>
                              <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Quantité : {{ produit.panier.quantiter }}</span>
                              <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Prix HT : {{ roundResult(((produit.dimension.largeur/100) *  (produit.dimension.longueur/100)*produit.panier.quantiter) * (produit.gamme.prix_vente_ht_m2_remise?produit.gamme.prix_vente_ht_m2_remise:produit.gamme.prix_vente_ht_m2),2)}} €</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="bg-gray-100 rounded-b-lg">
                  <div class="text-center bg-primary-50 rounded-t-lg py-1">
                     <h2 class="text-lg font-bold">Moyens de paiement</h2>
                  </div>

                  <div v-if="paymentType == 0 || !venteCondition" class="bg-yellow-200 px-4 py-2 rounded flex items-center">
                     <ExclamationCircleIcon class="h-8 w-8 text-yellow-600" />
                     <span class="pl-2 text-yellow-600">Pour continuer, veuillez sélectionner votre moyen de paiement et accepter les CGV.</span>
                  </div>  

                  <div class="mx-auto w-full my-4">
                     <RadioGroup v-model="paymentType">
                        <RadioGroupLabel class="sr-only">Type de paiement</RadioGroupLabel>
                        <div class="flex sm:flex-row flex-col w-full sm:justify-evenly justify-center items-center">
                           <RadioGroupOption as="template" value="2" v-slot="{ active, checked }" @click="verifCheck($event,2)">
                              <div :class="[active ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-300' : '',
                                 checked ? 'bg-blue-900 bg-opacity-75 text-white ' : 'bg-white ',
                              ]"
                              class="relative sm:my-0 my-2 mx-2 w-full sm:max-w-sm max-w-xs flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none">
                              <div class="flex w-full items-center justify-between">
                                 <div class="flex items-center">
                                    <div class="text-sm">
                                    <RadioGroupDescription as="span" :class="checked ? 'text-blue-100' : 'text-gray-500'" class="inline flex items-center">
                                       <CreditCardIcon class="h-6 w-6" viewBox="0 0 24 24" fill="none" />
                                       <span class="ml-2"> Carte Bancaire</span>
                                    </RadioGroupDescription>
                                    </div>
                                 </div>
                                 <div v-show="checked" class="shrink-0 text-white">
                                    <CheckCircleIcon class="h-6 w-6" viewBox="0 0 24 24" fill="none"/>
                                 </div>
                              </div>
                              </div>
                           </RadioGroupOption>
                           <RadioGroupOption as="template" value="1" v-slot="{ active, checked }" @click="verifCheck($event,1)">
                              <div :class="[active
                                    ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-300'
                                    : '',
                                 checked ? 'bg-blue-900 bg-opacity-75 text-white ' : 'bg-white ',
                              ]"
                              class="relative w-full sm:my-0 my-2 mx-2 sm:max-w-sm max-w-xs flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"
                              >
                              <div class="flex w-full items-center justify-between">
                                 <div class="flex items-center">
                                    <div class="text-sm">
                                    <RadioGroupDescription as="span" :class="checked ? 'text-blue-100' : 'text-gray-500'" class="inline flex items-center">
                                       <BuildingLibraryIcon class="h-6 w-6" viewBox="0 0 24 24" fill="none" />
                                       <span class="ml-2"> Virement Bancaire</span>
                                    </RadioGroupDescription>
                                    </div>
                                 </div>
                                 <div v-show="checked" class="shrink-0 text-white">
                                    <CheckCircleIcon class="h-6 w-6" viewBox="0 0 24 24" fill="none"/>
                                 </div>
                              </div>
                              </div>
                           </RadioGroupOption>
                        </div>
                     </RadioGroup>
                  </div>
                  <div class="flex items-center my-6 mx-auto max-w-sm">
                    <input @click="verifCheckVenteCondition" id="checkVenteCondition" type="checkbox" value="1" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                    <label for="checkVenteCondition" class="ml-2 sm:text-lg text-sm font-medium text-gray-900 ">J'accepte les <a href="/cgv" class="text-gray-400 underline hover:text-[1.15rem] cursor-pointer transition-all duration-300">conditions générales de vente</a></label>
                  </div>
                  <div class="py-2">
                     <div v-show="paymentType == 2" id="paymentCB" class="flex items-center justify-center mb-5">
                        <BoutonPaiement :disabled="((paymentType == 0 || !venteCondition) ? true : false)" id="bouttonPaiement" />
                     </div>
                     <div v-if="paymentType == 1 || paymentType == 0" class="flex justify-center mb-5">
                        <button :disabled="((paymentType == 0 || !venteCondition) ? true : false)" @click="validationCommande" type="button" 
                        class="btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
                           hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">Finaliser la commande <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>    
   </section>
</template>