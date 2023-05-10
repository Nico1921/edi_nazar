<script setup>
import InputNumber from '@/Components/InputNumber.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

var props = defineProps(['products','ifEdit']);
var products = ref(props.products);

var addCommande = (e) => {
   e.preventDefault();
   
   var formData = new FormData(e.target);
   const formProduit = useForm({
      idProduit: formData.get("id_produit"),
      quantiter: formData.get("qte"),
      id_panier_edi_list: formData.get("id_panier_edi_list"),
      id_client_edi: formData.get("id_client_edi"),
   });
   
   formProduit.post(route('orders/clients/products/add'), {
      preserveScroll: true,
      preserveState:true,
      onSuccess: (e) => {
         console.log(e);
         if(e.props.session.status){
            products.value[formData.get("key_tab")].panier.id_panier_edi_list = e.props.session.id_panier_edi_list;
            products.value[formData.get("key_tab")].isInPanier = true;
            products.value[formData.get("key_tab")].panier.quantiter = formData.get("qte");
            Toast.fire({
               icon: 'success',
               title: 'Le produit à bien ajouter à la commande.'
            });
         }else{
            Toast.fire({
               icon: 'error',
               title: 'Une erreur s\'est produite lors de l\'ajout du produit à la commande.'
            });
         }
         
      },
   });
};

var editCommande = (key) =>{
   products.value[key].isInPanier = false;
};

var deleteCommande = (id_panier_edi_list,key) =>{
   Swal.fire({
      title: 'Attention',
      text: 'Êtes-vous de supprimer cet article de la commande ?',
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
         });

         formProduit.post(route('orders/clients/products/delete'), {
            preserveScroll: true,
            onSuccess: (e) => {
               console.log(e);
               if(e.props.session.status){
                  Toast.fire({
                     icon: 'success',
                     title: 'Le produit a bien été supprimer de la commande.'
                  })
                  products.value[key].isInPanier = false;
                  products.value[key].panier.quantiter = 0;
                  products.value[key].panier.id_panier_edi_list = 0;
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la suppression du produit de la commande.'
                  });
               }
               
            },
         });
      }
   })

   
};

var roundNumber = (e) => {
   return (Math.round(e * 100) / 100).toFixed(2);
};
</script>
<script>
import Check from 'icons/Check.vue';
import Delete from 'icons/Delete.vue';
import Edit from 'icons/Pencil.vue';
</script>
<template>
      <table class="min-w-full divide-y divide-gray-200 bg-white border-2 border-slate-800 ">
            <thead class="py-1">
               <tr class="font-medium text-xs uppercase text-left tracking-wider text-gray-500 my-6 px-6 uppercase">
                  <th class="px-6">Image</th>
                  <th class="px-6">Taille</th>
                  <th class="px-6">Sku</th>
                  <th class="px-6">EAN</th>
                  <th class="px-6">Prix</th>
                  <th class="px-6">Stock</th>
                  <th class="px-6">Action</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="(product, key) in products" :key="key" >
                  <td class="w-1/12 text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                     <div v-if="product.photo != null" class="lg:w-[45px] lg:h-[75px] sm:w-[60px] sm:h-[90px] w-[70px] h-[100px]">
                        <img :src="'https://gestion.tapis-nazar.fr/img/produit/'+product.photo.img_produit" :alt="product.code_sku" class="w-full h-full object-cover"/>
                     </div>
                     <div v-else>
                        <span>Pas de photo pour ce produit !</span>
                     </div>
                  </td>
                  <td class="w-1/12 text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                     {{product.dimension.largeur}}x{{product.dimension.longueur}}
                  </td>
                  <td class="w-2/12 text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                     {{product.code_sku}}
                  </td>
                  <td class="w-2/12 text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                     {{product.gencode}}
                  </td>
                  <td class="w-1/12 text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                     {{ roundNumber(product.prixProduit) }} €
                  </td>
                  <td class="w-1/12 text-sm py-4 px-6 text-gray-500 whitespace-nowrap">
                     <div v-if="product.stats_produit.stock_restant > 10">
                        <span class="bg-green-700 w-[20px] h-[20px] block rounded-full"></span>
                     </div>
                     <div v-else-if="product.stats_produit.stock_restant > 0">
                        <span class="bg-orange-400 w-[20px] h-[20px] block rounded-full"></span>
                     </div>
                     <div v-else="product.stats_produit.stock_restant== 0">
                        <span class="bg-red-700 w-[20px] h-[20px] block rounded-full"></span>
                     </div>
                  </td>
                  <td class="w-4/12 text-sm py-4 px-6 text-gray-500 whitespace-nowrap" >
                     <form @submit.prevent="addCommande" class="grid grid-cols-2" v-if="product.stats_produit.stock_restant > 0 && !product.isInPanier">
                        <InputNumber name="qte" titre="Quantité" :max="product.stats_produit.stock_restant" :value="(product.panier.quantiter > 0 ? product.panier.quantiter : 1)" />
                        <input type="hidden" name="id_produit" :value="product.id_produit" />
                        <input type="hidden" name="id_client_edi" :value="product.id_client_edi" />
                        <input type="hidden" name="id_panier_edi_list" :value="(product.panier.id_panier_edi_list != undefined ? product.panier.id_panier_edi_list : 0)" />
                        <input type="hidden" name="key_tab" :value="key" />
                        <div class="flex justify-items-center items-center">
                           <button type="submit" class="p-4 bg-primary-50 rounded hover:bg-primary-100 transition duration-300" >Ajouter à la commande</button>
                        </div>
                     </form>
                     <div v-else-if="!product.isInPanier">
                        <span class="bg-red-500 p-2 rounded text-primary-50">Rupture de stock</span>
                     </div>
                     <div v-else-if="product.isInPanier">
                        <div class="py-3" v-if="props.ifEdit">
                           <span class="p-2  text-primary-500"><Check class="text-green-500" /> Ajouter à la commande du client</span>
                        </div>
                        
                        <div class="grid grid-cols-2">
                              <span>Quantité : {{product.panier.quantiter}}</span>
                              <div class="flex justify-items-center items-center justify-around" v-if="props.ifEdit">
                                 <button type="button" @click="editCommande(key)" class="p-2 bg-primary-50 rounded hover:bg-primary-100 transition duration-300 mx-2" ><Edit class="text-white" /> Modifier</button>
                                 <button type="button" @click="deleteCommande((product.panier.id_panier_edi_list != undefined ? product.panier.id_panier_edi_list : 0),key)" class="p-2 bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 mx-2" ><Delete class="text-white" /> Supprimer</button>
                              </div>
                        </div>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
</template>