<template>
   <div class="h-screen bg-gradient-to-br from-pink-50 to-indigo-100 grid place-items-center">
      <div class="w-6/12 mx-auto rounded border">
         <div class="bg-white p-10 shadow-sm">   
            <!-- What is term -->
            <div class="transition hover:bg-indigo-50">
               <!-- header -->
               <div @click="eventClick" class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                  <i class="mdi"><Plus /></i>
                  <h3>What is term?</h3>
               </div>
               <!-- Content -->
               <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                  <p class="leading-6 font-light pl-9 text-justify">
                     Our asked sex point her she seems. New plenty she horses parish design you. Stuff sight equal of my
                     woody. Him children bringing goodness suitable she entirely put
                     far daughter.
                  </p>
                  <button class="rounded-full bg-indigo-600 text-white font-medium font-lg px-6 py-2 my-5 ml-9">Learn
                     more</button>
               </div>
            </div>
   
            <!-- When to use Accordion Components -->
            <div class="transition hover:bg-indigo-50">
               <!-- header -->
               <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                  <i class="mdi"><Plus /></i>
                  <h3>When to use Accordion Components?</h3>
               </div>
               <!-- Content -->
               <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                  <p class="leading-6 font-light pl-9 text-justify">
                     Our asked sex point her she seems. New plenty she horses parish design you. Stuff sight equal of my
                     woody. Him children bringing goodness suitable she entirely put
                     far daughter.
                  </p>
                  <button class="rounded-full bg-indigo-600 text-white font-medium font-lg px-6 py-2 my-5 ml-9">Learn more</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<style>
   .accordion-content {
   transition: max-height 0.3s ease-out, padding 0.3s ease;
   }
</style>

<script setup>
import { createApp } from 'vue';
import Plus from 'icons/Plus.vue';
import Minus from 'icons/Minus.vue';
const eventClick = (header) => {
   var array = header.path;
   var header = array.find(element => element.classList.contains("accordion-header"));
         const accordionContent = header.parentElement.querySelector(".accordion-content");
         let accordionMaxHeight = accordionContent.style.maxHeight;
         // Condition handling
         if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
            var minus = createApp(Minus);
            accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 32}px`;
            header.querySelector(".mdi").innerHTML = "";
            minus.mount(header.querySelector(".mdi"));
            header.parentElement.classList.add("bg-primary-100");
         } else {
            var plus = createApp(Plus);
            accordionContent.style.maxHeight = `0px`;
            header.querySelector(".mdi").innerHTML = "";
            plus.mount(header.querySelector(".mdi"));
            header.parentElement.classList.remove("bg-primary-100");
         }
      };
</script>