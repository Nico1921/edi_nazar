<script setup>
import { Link } from '@inertiajs/inertia-vue3';
const props = defineProps(['nbEtape','etape','listeEtape']);

var classEtape = {
   etapeActual : 'w-1/3 flex justify-between h-1 items-center relative',
   etapePass: 'w-1/3 bg-primary-200 h-1 flex items-center',
   etapeNotPass : 'w-1/3 flex' 
};
</script>

<template>
   <div class="xl:block hidden h-full ">
      <div class="flex items-center">
         <span
            :class="[props.etape == 1 || props.etape > 1 ? 'bg-primary-300' : 'bg-primary-100'] + ' block w-10 h-10 rounded-full flex items-center justify-center border-2 border-primary-200'">1</span>
         <span class="pl-3" v-if="props.etape == 1">Panier</span>
         <Link href="/cart" class="pl-3" v-if="props.etape > 1">Panier</Link>
      </div>
      <div class="flex items-center relative py-20"><i
            class="w-px border-2 border-primary-400 border-dashed h-40 absolute top-0 left-[1.1rem]"></i></div>
      <div class="flex items-center">
         <span
            :class="[props.etape == 2 || props.etape > 2 ? 'bg-primary-300' : 'bg-primary-100'] + ' block w-10 h-10 rounded-full flex items-center justify-center border-2 border-primary-200'">2</span>
         <span class="pl-3" v-if="props.etape <= 2">Adresse Livraison / Facturation</span>
         <Link href="/cart/adresses" class="pl-3" v-if="props.etape > 2">Adresse Livraison / Facturation</Link>
      </div>
      <div class="flex items-center relative py-20"><i
            class="w-px border-2 border-primary-400 border-dashed h-40 absolute top-0 left-[1.1rem]"></i></div>
      <div class="flex items-center">
         <span
            :class="[props.etape == 3 ? 'bg-primary-300' : 'bg-primary-100'] + ' block w-10 h-10 rounded-full flex items-center justify-center border-2 border-primary-200'">3</span>
         <span class="pl-3">Finaliser commande</span>
      </div>
   </div>
   <div class="xl:hidden block sm:pb-20 lg:pb-18 pb-24 pt-5 sm:mx-5 mx-14">
      <div class="w-11/12 mx-auto">
         <div class="bg-primary-50 h-1 flex items-center justify-between">
            <div v-for="n in props.nbEtape" :class="(props.etape == n ? classEtape.etapeActual : (props.etape > n ? (n == 1 ? classEtape.etapePass : classEtape.etapePass+' justify-center mr-1') : (n != 1 && n != props.nbEtape ? classEtape.etapeNotPass + ' justify-center' : classEtape.etapeNotPass + ' justify-end')))"> 
               <div v-if="props.etape == n" class="relative w-full ">
                  <div  :class="(props.nbEtape == n  ? 'w-full' : (n == 1 ? 'w-0' : 'w-1/2'))" class=" h-1 relative bg-primary-200 -ml-1"></div>
                  <div :class="(props.etape == 1 ? 'right-1/2 ml-1.5' : (n == props.nbEtape ? 'left-1/2 ml-1.5' : ''))" class="absolute w-full">
                     <div class="relative w-full mt-5 flex justify-center">   
                        <Triangle class="text-gray-100 flex items-center justify-center !absolute -top-2 pl-0.5 !w-full right-0 left-0" />
                        <div class="px-2 py-1 bg-gray-100 rounded shadow-lg">
                           <p tabindex="0" class="focus:outline-none text-primary-200 text-xs font-bold">{{ props.listeEtape[n-1] }}</p>
                        </div>     
                     </div>
                  </div>
                  <div :class="(props.etape == 1 ? '-ml-3 left-0' : (n == props.nbEtape ? '-mr-5 right-0' : '-ml-3 left-1/2'))" class="bg-white h-6 w-6 rounded-full shadow flex items-center justify-center absolute -top-2.5">
                     <div class="h-3 w-3 bg-primary-200 rounded-full"></div>
                  </div>
               </div>
               
               <div v-else-if="props.etape > n" :class="n != 1 ? 'ml-1' : ''" class=" bg-primary-100 h-6 w-6 rounded-full shadow flex items-center justify-center">
                  <Check class="text-white mb-1" />
               </div>
               <div v-else class="bg-primary-50 h-6 w-6 rounded-full shadow -mr-1"></div>
            </div>
         </div>
      </div>
   </div>
</template>