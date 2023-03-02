<script setup>
import { createApp, onMounted, ref } from 'vue';
import { Head,Link } from '@inertiajs/inertia-vue3';
import Plus from 'icons/Plus.vue';
import Minus from 'icons/Minus.vue';
import ListeProduit from '@/Components/ListeProduitsGamme.vue';
import ResumeOrder from '@/Components/ResumeOrder.vue';
import ResumeOrderVertical from '@/Components/ResumeOrderVertical.vue';

const prop = defineProps(['clients','panier']);

const classListe = {
   gridImage : "2xl:col-span-3 xl:col-span-3 lg:col-span-4 sm:col-span-2 xsm:col-span-4 col-span-5",
   gridBlock : "2xl:col-span-9 xl:col-span-9 lg:col-span-8 sm:col-span-10 xsm:col-span-8 col-span-7",
   hBlock : "lg:!h-56 sm:!h-48 !h-64"
}

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

const eventClick = (header,id_client_edi) => {
   console.log(header);
   var array = header.path;
   var exclud = checkElementInClassArray(array,"notDeployAccordion");
   
   if(!exclud){
      var header = array.find(element => element.classList.contains("accordion-header"));
      const accordionContent = header.parentElement.querySelector(".accordion-content");
      let accordionMaxHeight = accordionContent.style.maxHeight;
      // Condition handling
      if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
         axios.post('orders', { id_client_edi: id_client_edi }).then((response) => {
               if (response.status == 200) {
                  if(document.getElementById("orders_" + id_client_edi).__vue_app__ != undefined){
                     document.getElementById("orders_" + id_client_edi).__vue_app__.unmount();
                  }
                  var listeProduits = createApp(ListeProduit, { products: response.data.panier,ifEdit: true,
                     type_vente: 2,url_add:'/orders/clients/validation/add',url_delete:'/orders/clients/validation/delete',
                     slidePerViewMount : { 640: {slidesPerView: 2},1024: {slidesPerView: 2}}, 
                     slidePerView: { 1536:{ slidesPerView:2}, 1024:{ slidesPerView:2}, 0:{ slidesPerView:1} },
                     classGridImage : classListe.gridImage,
                     classGridText : classListe.gridBlock,
                     hBlock: classListe.hBlock});
                  listeProduits.mount(document.getElementById("orders_" + id_client_edi));
               }
         });
         var minus = createApp(Minus);
         accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 100}%`;
         accordionContent.classList.add('px-5');
         accordionContent.classList.add('pt-0');
         accordionContent.classList.add('pb-2');
         if(header.querySelector(".mdi").__vue_app__ != undefined){
            header.querySelector(".mdi").__vue_app__.unmount();
         }
         minus.mount(header.querySelector(".mdi"));
         header.parentElement.classList.add("bg-primary-100");
         
      } else {
         var plus = createApp(Plus);
         accordionContent.style.maxHeight = `0px`;
         accordionContent.classList.remove('px-5');
         accordionContent.classList.remove('pt-0');
         accordionContent.classList.remove('pb-2');
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

const eventClick2 = (key,id_client_edi) => {

      var header = document.getElementById("accordion-header"+key);
      const accordionContent = header.parentElement.querySelector(".accordion-content");
      let accordionMaxHeight = accordionContent.style.maxHeight;
      // Condition handling
      if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
         axios.post('orders', { id_client_edi: id_client_edi }).then((response) => {
               if (response.status == 200) {
                  if(document.getElementById("orders_" + id_client_edi).__vue_app__ != undefined){
                     document.getElementById("orders_" + id_client_edi).__vue_app__.unmount();
                  }
                  var listeProduits = createApp(ListeProduit, { products: response.data.panier,ifEdit: true,
                     type_vente: 2,url_add:'/orders/clients/validation/add',url_delete:'/orders/clients/validation/delete',
                     slidePerViewMount : { 640: {slidesPerView: 2},1024: {slidesPerView: 2}}, 
                     slidePerView: { 1536:{ slidesPerView:2}, 1024:{ slidesPerView:2}, 0:{ slidesPerView:1} },
                     classGridImage : classListe.gridImage,
                     classGridText : classListe.gridBlock,
                     hBlock: classListe.hBlock});
                  listeProduits.mount(document.getElementById("orders_" + id_client_edi));
               }
         });
         var minus = createApp(Minus);
         accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 100}%`;
         accordionContent.classList.add('px-5');
         accordionContent.classList.add('pt-0');
         accordionContent.classList.add('pb-2');
         if(header.querySelector(".mdi").__vue_app__ != undefined){
            header.querySelector(".mdi").__vue_app__.unmount();
         }
         minus.mount(header.querySelector(".mdi"));
         header.parentElement.classList.add("bg-primary-100");
         
      } else {
         var plus = createApp(Plus);
         accordionContent.style.maxHeight = `0px`;
         accordionContent.classList.remove('px-5');
         accordionContent.classList.remove('pt-0');
         accordionContent.classList.remove('pb-2');
         if(header.querySelector(".mdi").__vue_app__ != undefined){
            header.querySelector(".mdi").__vue_app__.unmount();
         }
         plus.mount(header.querySelector(".mdi"));
         header.parentElement.classList.remove("bg-primary-100");
         if (document.getElementById("orders_" + id_client_edi).__vue_app__ != undefined) {
            document.getElementById("orders_" + id_client_edi).__vue_app__.unmount();
         }
      }
};

const deleteClient = (id_client_edi,id_panier_edi,nom_client,prenom_client) => {
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous sur de supprimer le client '+prenom_client+" "+nom_client+' de la commande ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
         axios.post('/orders/clients/delete', { 
            id_client_edi: id_client_edi, 
            id_panier_edi: id_panier_edi 
         }).then((response) => {
            if (response.status == 200) {
               if(response.data){
                  document.getElementById('ordersResum_'+id_client_edi).remove();
                  Toast.fire({
                     icon: 'success',
                     title: 'Le client '+prenom_client+" "+nom_client+ ' à bien été suprimmer !'
                  });
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la supression de la commande du client'+prenom_client+" "+nom_client+', veuillez ressayer !'
                  });
               }
            }
      });
      }
   });
};

const editCommande = (id_client_edi) => {
      axios.post('/orders/clients/edit', { id_client_edi: id_client_edi }).then((response) => {
            if (response.status == 200) {
               if(response.data){
                  document.location.href = "/orders/clients/products";
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la récupération de la commande, veuillez ressayer !'
                  });
               }
            }
      });
   };

const confirmCommande = () => {
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous sur de confirmer votre commande ?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
         axios.post('/orders/clients/confirmation',{paymentType: paymentType.value}).then((response) => {
            if (response.status == 200) {
               if (response.data.status) {
                  document.location.href = '/shippings/order/clients/'+response.data.num_commande;
               } else {
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la confirmation de la commande, veuillez ressayer !'
                  });
               }
            }
         });
      }
   });
};

var paymentType = ref(0);

var verifCheck = (e,type) => {
    if(e.target.checked){
      paymentType.value = type;
    }else{
      paymentType.value = 0;
    }
};

onMounted(() => {
   eventClick2(0,prop.clients[0].id_client_edi);
});
</script>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Edit from 'icons/Pencil.vue';
import Delete from 'icons/Delete.vue';
export default {
   // Using a render function
   layout: (h, page) => h(AuthenticatedLayout, () => child),
   // Using the shorthand
   layout: AuthenticatedLayout,
};
</script>

<template>
   <Head title="Validation Orders Clients" />
   <section class="container mx-auto mt-5">   
      <div class=" mx-auto rounded w-full grid grid-cols-4 ">
         <div class="col-span-4 ">
            <h1 class="text-center xl:text-3xl lg:text-2xl text-xl text-primary-300">Client de la commande</h1>  
         </div>
         <div class="2xl:mr-2 2xl:col-span-3 col-span-4 bg-white">
            
            <div class="2xl:hidden block mb-2">
               <ResumeOrderVertical :panier="prop.panier" :isButtonSubmit="false">
                  <form class="col-span-4 grid grid-cols-4 bg-primary-50 rounded px-1 py-2 mb-4">
                  <div class="my-2  col-span-4 flex items-center justify-start">
                    <!-- <input @click="verifCheck($event,2)" id="paymentCard" name="paymentType" type="radio" value="2" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100"> -->
                    <input :checked="paymentType == 2" disabled id="paymentCard" name="paymentType" type="radio" value="2" class="w-4 h-4 cursor-not-allowed text-primary-200 bg-gray-200 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                    <label for="paymentCard" class="ml-2 text-lg font-medium text-gray-900 ">Paiement par CB</label>
                  </div>
                  <div class="my-2  col-span-4 flex items-center justify-start">
                     <input :checked="paymentType == 1" @click="verifCheck($event,1)" id="paymentVirement" name="paymentType" type="radio" value="1" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                     <label for="paymentVirement" class="ml-2 text-lg font-medium text-gray-900 ">Paiement par Virement Bancaire</label>
                  </div>
               </form>
                  <div class="col-span-2 mx-2">
                     <Link class="sm:text-lg text-sm font-semibold rounded flex w-full h-10 justify-center items-center bg-primary-100 hover:bg-primary-200 transition duration-300" href="/orders/clients/add">Ajouter un clients</Link>
                  </div>
                  
                  <div class="col-span-2 mx-2">
                     <button :disabled="(paymentType == 0 ? true : false)" type="button" @click="confirmCommande" class="disabled:cursor-not-allowed disabled:bg-primary-200 sm:text-lg text-sm font-semibold rounded flex w-full h-10 justify-center items-center bg-primary-100 hover:bg-primary-200 transition duration-300">Confirmer la commande</button>
                  </div>
               </ResumeOrderVertical>
            </div>
            <div v-for="(client, key) in clients" :key="key" :id="'ordersResum_'+client.id_client_edi" class="transition hover:bg-primary-100 border shadow-sm ">
               <!-- header -->
               <div @click="eventClick($event,client.id_client_edi)" :id="'accordion-header'+key" class="grid grid-cols-12 accordion-header cursor-pointer transition flex px-5 items-center py-1 relative">
                  <div class="lg:col-span-11 col-span-12 relative">
                     <i class="mdi absolute"><Plus /></i>
                     <div class="grid grid-cols-12 ml-5">
                        <h2   class="xl:col-span-3 sm:col-span-5 col-span-12 text-center">Client : {{client.nom+" "+client.prenom}}</h2>
                        <span class="xl:col-span-1 sm:col-span-2 sm:block hidden text-center"> | </span>
                        <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Total TTC : {{ client.total_ttc }} €</span>
                        <span class="xl:col-span-1 xl:block hidden text-center"> | </span>
                        <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Quantiter : {{ client.quantiter }}</span>
                        <span class="xl:col-span-1 sm:col-span-2 sm:block hidden text-center"> | </span>
                        <span class="xl:col-span-2 sm:col-span-5 col-span-12 text-center">Total M² : {{ client.total_m2 }}</span>
                     </div>
                  </div>
                  <div class="lg:col-span-1 col-span-12 grid grid-cols-4">
                     <div class="col-span-2 flex justify-end">
                        <button @click="editCommande(client.id_client_edi)" class="rounded w-full p-2 bg-primary-200 hover:bg-primary-300 transition duration-300 xl:mr-2 mr-1 notDeployAccordion"><Edit class="text-white" /></button>
                     </div>
                     <div class="col-span-2 flex justify-end">
                        <button @click="deleteClient(client.id_client_edi,client.panier.id_panier_edi,client.nom,client.prenom)" class="rounded w-full notDeployAccordion p-2 bg-red-500 hover:bg-red-300 transition duration-300 xl:ml-2 ml-1"><Delete class="text-white" /></button>
                     </div>
                  </div>
               </div>
               <!-- Content -->
               <div class="accordion-content overflow-hidden max-h-0" :id="'orders_'+client.id_client_edi">
                  
               </div>
            </div>
         </div>
         <div class="col-span-1 2xl:block hidden">
            <ResumeOrder :panier="prop.panier" :isButtonSubmit="false">
               <form class="col-span-4 grid grid-cols-4 bg-primary-50 rounded px-1 py-2 mb-4">
                  <div class="my-2  col-span-4 flex items-center justify-start">
                    <!-- <input @click="verifCheck($event,2)" id="paymentCard" name="paymentType" type="radio" value="2" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100"> -->
                    <input :checked="paymentType == 2" disabled id="paymentCard" name="paymentType" type="radio" value="2" class="w-4 h-4 cursor-not-allowed text-primary-200 bg-gray-200 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                    <label for="paymentCard" class="ml-2 text-lg font-medium text-gray-900 ">Paiement par CB</label>
                  </div>
                  <div class="my-2  col-span-4 flex items-center justify-start">
                     <input :checked="paymentType == 1" @click="verifCheck($event,1)" id="paymentVirement" name="paymentType" type="radio" value="1" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                     <label for="paymentVirement" class="ml-2 text-lg font-medium text-gray-900 ">Paiement par Virement Bancaire</label>
                  </div>
               </form>
               <div class="col-span-2 mx-2">
                  <Link class="rounded flex w-full h-10 justify-center items-center bg-primary-100 text-sm hover:bg-primary-200 transition duration-300" href="/orders/clients/add">Ajouter un clients</Link>
               </div>
               
               <div class="col-span-2 mx-2">
                  <button :disabled="(paymentType == 0 ? true : false)" type="button" @click="confirmCommande" class="rounded flex w-full h-10 justify-center items-center px-1 text-sm bg-primary-100 hover:bg-primary-200 transition duration-300 disabled:cursor-not-allowed disabled:bg-primary-200">Confirmer la commande</button>
               </div>
            </ResumeOrder>
         </div>
      </div>
   </section>
</template>