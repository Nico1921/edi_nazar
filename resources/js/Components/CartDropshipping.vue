<script setup>
import { usePage,useForm } from '@inertiajs/inertia-vue3';
import { ref, watchEffect } from 'vue';
import InputNumber from '@/Components/InputNumber.vue';

var prop = defineProps(['panier']);
var panier = ref(prop.panier);
var clientUser = ref(usePage().props.value.auth.user[0].client);

const roundResult = (number, nbVirugule) => {
   return number.toFixed(nbVirugule);
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

var calcul_prix_gamme = (prix_gamme) => {
   var HT = prix_gamme;
   if(clientUser.value.taux_remise > 0){
      HT = HT - ((HT) * (clientUser.value.taux_remise /100));
   }
   return roundNumber(HT);
};

var modifQte = (e,nomProduit,keyclient) => {
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

      formProduit.post(route('dropshipping/cart/products/edit'), {
         preserveScroll: true,
         preserveState: true,
         onSuccess: (e) => {
            if (e.props.session.status) {
               console.log(panier.value.clients[keyclient]);
               panier.value.clients[keyclient].produits[formData.get("key_tab")].id_panier_edi_list = e.props.session.id_panier_edi_list;
               panier.value.clients[keyclient].produits[formData.get("key_tab")].isInPanier = true;
               panier.value.clients[keyclient].produits[formData.get("key_tab")].quantiter = formData.get("qte");
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

         formProduit.post(route('dropshipping/cart/products/delete'), {
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

var deleteClient = (e,id_client_edi,ref_externe) => {
   e.preventDefault();
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous sur de supprimer la commande client '+ref_externe+' ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
         
         Inertia.post('/dropshipping/cart/client/delete', { 
            id_client_edi: id_client_edi, 
            id_panier_edi: panier.value.id_panier_edi 
         },{
            onSuccess : (e) => {
               if (e.props.session.status == true) {
                  Toast.fire({
                        icon: 'success',
                        title: 'La commande client '+ref_externe+ ' à bien été suprimmer !'
                     });
               }else{
                  Toast.fire({
                        icon: 'error',
                        title: 'Une erreur s\'est produite lors de la supression de la commande client'+ref_externe+', veuillez ressayer !'
                     });
               }
         }});
      }
   });
};

watchEffect(() => {
	panier.value = usePage().props.value.PanierDrop.panier;
});

</script>
<script>
import Delete from 'icons/Delete.vue';
import ImageOff from 'icons/ImageOff.vue';
import { Inertia } from '@inertiajs/inertia';
</script>
<template>
            <div v-if="panier.clients != undefined" class="w-full h-90 ">
               <div v-for="(client, key1) in panier.clients" :key="key1" class="w-full lg:p-4 sm:p-3 p-2 my-2 bg-gray-100 rounded">
                  <div class="flex items-center justify-center">
                     <h2 class="font-bold text-center text-xl py-1">Commande : {{client.client.ref_externe}}</h2>
                     <button type="button"
                        @click="deleteClient($event,(client.client.id_client_edi != undefined ? client.client.id_client_edi : 0),client.client.ref_externe)"
                        class="mx-2 w-10 bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full">
                        <Delete class="text-white" />
                     </button>
                  </div>
                  <div v-if="client.nbProduit > 0" v-for="(produit, key2) in client.produits" :key="key2" class="grid grid-cols-12 py-4" >
                     <div class="sm:col-span-2 xsm:col-span-3 col-span-4 flex items-center justify-center">
                        <div v-if="produit.photo != null"
                           class="lg:h-[150px] sm:h-[130px] h-full w-full px-2">
                           <img :src="'https://gestion.tapis-nazar.fr/img/produit/'+produit.photo.img_produit"
                              :alt="produit.code_sku" class="w-full h-full object-cover rounded-xl" />
                        </div>
                        <div v-else class="text-3xl m-2 lg:h-[150px] sm:h-[130px] h-full w-full flex items-stretch justify-center bg-gray-300">
                           <ImageOff />
                        </div>
                     </div>
                     <div class="sm:col-span-10 xsm:col-span-9 col-span-8 flex flex-col xl:text-lg text-sm">
                        <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">SKU : {{ produit.code_sku }}</span>
                        <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Taille : {{produit.dimension.largeur + 'x' +
                           produit.dimension.longueur }}</span>
                        <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Prix du M² : {{ calcul_prix_gamme(produit.gamme.prix_vente_ht_m2) }} € HT</span>
                        <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">M² : {{ roundResult((produit.dimension.largeur/100) *  (produit.dimension.longueur/100)*produit.panier.quantiter,2) }} m²</span>
                        <span class="text-gray-600 sm:text-sm text-[0.700rem] font-bold">Prix HT : {{ roundResult(((produit.dimension.largeur/100) *  (produit.dimension.longueur/100)*produit.panier.quantiter) * calcul_prix_gamme(produit.gamme.prix_vente_ht_m2),2)}} €</span>
                        <div class="grid grid-cols-8">               
                           <div class="xl:col-span-5 col-span-4 w-full h-8 bg-gray-300 flex items-center justify-center rounded">
                              <form v-if="produit.stats_produit.stock_restant > 0" class="editQteForm w-full h-full">
                                 <InputNumber @change="modifQte($event,produit.design.nom_design + produit.dimension.largeur + 'x' + produit.dimension.longueur,key1)" name="qte"
                                    :max="produit.stats_produit.stock_restant"
                                    :value="(produit.quantiter > 0 ? produit.quantiter : 1)" 
                                    class="h-full"/>
                                 <input type="hidden" name="id_produit" :value="produit.id_produit" />
                                 <input type="hidden" name="id_panier_edi_list"
                                    :value="(produit.id_panier_edi_list != undefined ? produit.id_panier_edi_list : 0)" />
                                 <input type="hidden" name="key_tab" :value="key2" />
                                 <input type="hidden" name="id_panier_edi"
                                    :value="(panier.id_panier_edi != undefined ? panier.id_panier_edi : 0)" />
                                 <input type="hidden" name="id_client_edi"
                                    :value="(client.client.id_client_edi != undefined ? client.client.id_client_edi : 0)" />
                              </form>
                           </div>
                           <div class="xl:col-span-3 col-span-4 sm:mx-4 mx-2">
                              <button type="button"
                                 @click="deleteCommande((produit.panier.id_panier_edi_list != undefined ? produit.panier.id_panier_edi_list : 0),(panier.id_panier_edi != undefined ? panier.id_panier_edi : 0),key)"
                                 class="w-full bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full">
                                 <Delete class="text-white" />
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="text-center py-5" v-else>
                     <span class="text-lg">Le panier de se client est vide !</span>
                  </div>
               </div>
               
            </div>
            <div v-else class="flex items-center justify-center h-full">
               <span>Votre panier est vide !</span>
            </div>
</template>