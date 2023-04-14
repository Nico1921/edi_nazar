<script setup>
import { EnvelopeIcon, PhoneIcon, BuildingLibraryIcon } from '@heroicons/vue/24/outline';
import Visa from '@/Components/Logo/Visa.vue';
import Mastercard from '@/Components/Logo/Mastercard.vue';
import CB from '@/Components/Logo/CB.vue';
import OekoTex from '@/Components/Logo/OekoTex.vue';
</script>
<template>
   <!-- absolute bottom-0 -->
   <footer class="bg-primary-50 grid grid-cols-12 mt-auto justify-center text-center w-full py-4 mx-auto">
         <div class="col-span-5 mx-auto text-left">
            <h2 class="text-lg font-bold text-center"> Nous Contacter</h2>
            <div class="flex">
               <div class="flex items-center mt-4 ">
                  <div class="flex flex-items justify-center"><EnvelopeIcon class="h-8 w-8 mr-2" /></div>
                  <div class="flex flex-col">
                     <span><span class="font-bold">Service Informatique : </span> <a href="mailto:informatique@nazarrugs.fr">informatique@nazarrugs.fr</a></span>
                     <span><span class="font-bold">Service Commercial : </span> <a href="mailto:commande@nazarrugs.fr">commande@nazarrugs.fr</a></span>
                     <span><span class="font-bold">Service Après-vente : </span> <a href="mailto:sav@nazarrugs.fr">sav@nazarrugs.fr</a></span>
                     <span><span class="font-bold">Service Comptabilité : </span> <a href="mailto:compta@nazarrugs.fr">compta@nazarrugs.fr</a></span>
                  </div>
               </div>
               <div class="flex items-center ml-4">
                  <div class="flex flex-items justify-center"><PhoneIcon class="h-8 w-8 mr-2" /></div>
                  <div class="flex flex-col">
                     <a class="font-bold" href="telto:0238432914">02 38 43 29 14</a>
                     <span>du Lundi au vendredi de 9h à 17h</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-span-4 ">
            <h2 class="font-bold">Paiement Sécurisé</h2>
            <div class="flex items-center justify-center mt-4">
               <div class="flex flex-col items-center px-4">
                  <CB classIcon="h-12 w-12" />
                  <span class="text-gray-600">CB</span>
               </div>
               <div class="flex flex-col items-center px-4">
                  <Mastercard classIcon="h-12 w-12" />
                  <span class="text-gray-600">Mastercard</span>
               </div>
               <div class="flex flex-col items-center px-4">
                  <Visa classIcon="h-12 w-12" />
                  <span class="text-gray-600">Visa</span>
               </div>
               <div class="flex flex-col items-center px-4">
                  <BuildingLibraryIcon class="h-12 w-12" />
                  <span class="text-gray-600">Virement Bancaire</span>
               </div>
            </div>
         </div>
         <div class="col-span-3">
            <h2 class="font-bold">Certification</h2>
            <div class="flex flex-col items-center px-4">
               <OekoTex classIcon="h-32 w-32" />
             </div>
         </div>
         <div class="col-span-12 grid grid-cols-12 ">
            <div class="col-span-3">
               <a href="/mentions-legales" class="col-span-3 text-gray-500 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Mentions Légales</a>
            </div>
            <div class="col-span-3">
               <a href="/cgv" class=" text-gray-500 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Conditions générales de ventes</a>
            </div>
            <div class="col-span-3">
               <a href="/politique-confidentialite" class="text-gray-500 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Confidentialité</a>
            </div>
            <div class="col-span-3">
               <a href="/cookies" class="text-gray-500 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Cookies</a>
            </div>
            
            
            
         </div>
         <div class="col-span-12 mt-1">
            <span class="text-gray-400 ">@Copyright NAZAR RUGS {{ new Date().getFullYear() }}</span>
         </div>
        </footer>
</template>