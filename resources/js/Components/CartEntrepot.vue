<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { ref, watchEffect } from 'vue';
import InputNumber from '@/Components/InputNumber.vue';

var prop = defineProps(['produits','panier']);
var produits = ref(prop.produits);
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
</script>
<script>
import Delete from 'icons/Delete.vue';
</script>
<template>
            <div v-if="produits != undefined" class="w-full h-90 ">
               <div v-for="(produit, key) in produits" :key="key" class="w-full lg:p-4 sm:p-3 p-2  grid bg-gray-100 rounded grid-cols-12 my-2" >
                  <div class="sm:col-span-2 xsm:col-span-3 col-span-4 flex items-center justify-center">
                     <div v-if="produit.photo != null"
                        class="lg:h-[150px] sm:h-[130px] h-full w-full px-2">
                        <img :src="'https://gestion.tapis-nazar.fr/img/produit/'+produit.photo.img_produit"
                           :alt="produit.code_sku" class="w-full h-full object-cover rounded-xl" />
                     </div>
                     <div v-else>
                        <span>Pas de photo pour ce produit !</span>
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
            <div v-else class="flex items-center justify-center h-full">
               <span>Votre panier est vide !</span>
            </div>
</template>