<script setup>
import { usePage, useForm  } from '@inertiajs/inertia-vue3';
import { ref, watchEffect } from 'vue';
import InputNumber from '@/Components/InputNumber.vue';

var prop = defineProps(['produits','panier']);
var produits = ref(prop.produits);
var clientUser = ref(usePage().props.value.auth.user[0].client);

const roundResult = (number, nbVirugule) => {
   return parseFloat(number).toFixed(nbVirugule);
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

var modifQte = (e,nomProduit) => {
   e.preventDefault();

   var form = findElementInClassArray(e.path, 'editQteForm');
   if (form != undefined) {
      var formData = new FormData(form);
      const formProduit = useForm({
         idProduit: formData.get("id_produit"),
         quantiter: formData.get("qte"),
         id_panier_edi_list: formData.get("id_panier_edi_list"),
         id_panier_edi: formData.get("id_panier_edi"),
         id_client_edi: formData.get("id_client_edi"),
      });

      formProduit.post(route('cart/products/edit'), {
         preserveScroll: true,
         preserveState: true,
         onSuccess: (e) => {
            if (e.props.session.status) {
               produits.value[formData.get("key_tab")].panier.id_panier_edi_list = e.props.session.id_panier_edi_list;
               produits.value[formData.get("key_tab")].isInPanier = true;
               produits.value[formData.get("key_tab")].panier.quantiter = formData.get("qte");
               Toast.fire({
                  icon: 'success',
                  title: 'La quantiter du produit '+nomProduit+' à bien été modifier'
               });
            } else {
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur c\'est produit lors de la modification de la quantiter du produit.'
               });
            }

         },
      });
   }
};

var deleteCommande = (id_panier_edi_list,id_panier_edi, key) => {
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous sur de supprimer cette article du panier ?',
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
            id_panier_edi: id_panier_edi,
         });

         formProduit.post(route('cart/products/delete'), {
            preserveScroll: true,
            onSuccess: (e) => {
               if (e.props.session.status) {
                  Toast.fire({
                     icon: 'success',
                     title: 'Le produit à bien été supprimer du panier'
                  });
               } else {
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur c\'est produit lors de la supression du produit du panier'
                  });
               }

            },
         });
      }
   })
};

watchEffect(() => {
	produits.value = usePage().props.value.Panier.panier.panier;
});
//console.log(prop.panier);
</script>
<script>
import Delete from 'icons/Delete.vue';
import ImageOff from 'icons/ImageOff.vue';
import { ExclamationTriangleIcon } from '@heroicons/vue/20/solid';
</script>
<template>
            <div v-if="prop.panier.is_validate" class="w-full bg-red-200 px-4 py-2 rounded flex items-center">
               <ExclamationTriangleIcon v-if="prop.panier.is_validate" class="h-8 w-8 text-red-600" />
               <span v-if="prop.panier.is_validate" class="pl-2 text-red-600">Votre panier a déjà été valider, vous pouvez aller dans Expéditions pour voir les détails de votre commande.</span>
            </div>
            <div v-if="produits != undefined" class="sm:my-4 px-2 py-4 rounded-lg border shadow-lg  w-full grid grid-cols-12 max-h-96 overflow-y-auto scrollbarCustom">
               <div v-for="(produit, key) in produits" :key="key" class="2xl:col-span-3 lg:col-span-4 sm:col-span-6 col-span-12 bg-gray-100 rounded grid grid-cols-12 px-2 py-4 my-2 lg:mx-4 sm:mx-2 mx-6" >
                  <div class="sm:col-span-4 xsm:col-span-3 col-span-4 flex items-center justify-center">
                     <div v-if="produit.photo != null"
                        class="h-full w-full lg:max-h-52 max-h-42 min-h-min px-2">
                        <img :src="'https://gestion.tapis-nazar.fr/img/produit/'+produit.photo.img_produit"
                           :alt="produit.code_sku" class="w-full h-full object-cover rounded-xl" />
                     </div>
                     <div v-else class="text-3xl m-2 lg:h-[150px] sm:h-[130px] h-full w-full flex items-stretch justify-center bg-gray-300">
								<ImageOff />
							</div>
                  </div>
                  <div class="sm:col-span-8 xsm:col-span-9 col-span-8 h-full flex flex-col justify-evenly">
                     <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">SKU : {{ produit.code_sku }}</span>
                     <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Taille : {{produit.dimension.largeur + 'x' +
                        produit.dimension.longueur }}</span>
                     <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Prix du M² : {{ produit.gamme.prix_vente_ht_m2_remise }} € HT</span>
                     <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">M² : {{ roundResult((produit.dimension.largeur/100) *  (produit.dimension.longueur/100)*produit.panier.quantiter,2) }} m²</span>
                     <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Prix HT : {{ roundResult(((produit.dimension.largeur/100) *  (produit.dimension.longueur/100)*produit.panier.quantiter) * produit.gamme.prix_vente_ht_m2_remise,2)}} €</span>
                     <div class="grid grid-cols-8">               
                        <div class="xl:col-span-5 col-span-4 w-full h-8 bg-gray-300 flex items-center justify-center rounded">
                           <form v-if="produit.stats_produit.stock_restant > 0" class="editQteForm w-full h-full">
                              <InputNumber @change="modifQte($event,produit.design.nom_design + produit.dimension.largeur + 'x' + produit.dimension.longueur)" name="qte"
                                 :max="produit.stats_produit.stock_restant"
                                 :value="(produit.panier.quantiter > 0 ? produit.panier.quantiter : 1)" 
                                 class="h-full"/>
                              <input type="hidden" name="id_produit" :value="produit.id_produit" />
                              <input type="hidden" name="id_panier_edi_list"
                                 :value="(produit.panier.id_panier_edi_list != undefined ? produit.panier.id_panier_edi_list : 0)" />
                              <input type="hidden" name="key_tab" :value="key" />
                              <input type="hidden" name="id_panier_edi"
                                 :value="(prop.panier.id_panier_edi != undefined ? prop.panier.id_panier_edi : 0)" />
                              <input type="hidden" name="id_client_edi"
                                 :value="(produit.panier.id_client_edi != undefined ? produit.panier.id_client_edi : 0)" />
                           </form>
                        </div>
                        <div class="xl:col-span-3 col-span-4 sm:mx-4 mx-2">
                           <button type="button"
                              @click="deleteCommande((produit.panier.id_panier_edi_list != undefined ? produit.panier.id_panier_edi_list : 0),(prop.panier.id_panier_edi != undefined ? prop.panier.id_panier_edi : 0),key)"
                              class="w-full bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full">
                              <Delete class="text-white" />
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div v-else class="sm:my-4 flex items-center justify-center w-full h-full">
               <div class="rounded-lg border p-8 sm:m-0 m-4 shadow-lg flex flex-col items-center justify-center w-full h-full">
                  <span class="material-design-icon cart-remove-icon !w-24 !h-24 text-gray-400" role="img">
                     <svg class="material-design-icon__svg !w-24 !h-24"
                           width="24"
                           height="24"
                           viewBox="0 0 24 24">
                        <path d="M14.12,8.53L12,6.41L9.88,8.54L8.46,7.12L10.59,5L8.47,2.88L9.88,1.47L12,3.59L14.12,1.46L15.54,2.88L13.41,5L15.53,7.12L14.12,8.53M7,18A2,2 0 0,1 9,20A2,2 0 0,1 7,22A2,2 0 0,1 5,20A2,2 0 0,1 7,18M17,18A2,2 0 0,1 19,20A2,2 0 0,1 17,22A2,2 0 0,1 15,20A2,2 0 0,1 17,18M7.17,14.75A0.25,0.25 0 0,0 7.42,15H19V17H7A2,2 0 0,1 5,15C5,14.65 5.09,14.32 5.25,14.04L6.6,11.59L3,4H1V2H4.27L5.21,4L6.16,6L8.4,10.73L8.53,11H15.55L18.31,6L19.41,4H19.42L21.16,4.96L17.3,11.97C16.96,12.59 16.3,13 15.55,13H8.1L7.2,14.63L7.17,14.75Z">
                        </path>
                     </svg>
                  </span>
                  <h2 class="mt-6 text-3xl font-medium text-gray-900">Votre panier est vide</h2>
                  
                  <p class="mt-4 text-gray-500 text-center">Vous n'avez pas encore ajouté d'articles à votre panier.</p>
                  
                  <a href="/order_entrepot/gamme" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded mt-6 sm:w-auto animate-bounce transition-all duration-300">
                  Ajouter au panier
                  </a>
               </div>
            </div>
</template>