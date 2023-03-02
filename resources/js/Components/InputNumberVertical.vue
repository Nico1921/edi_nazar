<script setup>
defineProps(['name','max','value']);
function decrement(e) {
      e.preventDefault();
      
     const btn = e.target.parentNode.parentElement.querySelector(
       'button[data-action="increment"]'
     );
     const target = btn.nextElementSibling;
     let value = Number(target.value);
     if(target.min < value){
      value--;
     }
     target.value = value;
   }
 
   function increment(e) {
      e.preventDefault();
     const btn = e.target.parentNode.parentElement.querySelector(
       'button[data-action="increment"]'
     );
     const target = btn.nextElementSibling;
     let value = Number(target.value);
     
     if(target.max > value){
      value++;
     }
     
     target.value = value;
   }
</script>
<template>
   <div class="custom-number-input h-full">
      <div class="flex flex-col h-10 w-full rounded-lg relative bg-transparent mt-1">
        <button data-action="increment" @click="increment($event);$emit('change',$event)" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-5 w-full rounded-t cursor-pointer">
         <span class="mx-auto -mt-2 text-lg font-thin">+</span>
         </button>
         <input type="number" required
         class="p-0 border-none outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black md:text-basecursor-default flex items-center text-gray-700 outline-none" 
         :name="name" 
         :max="max"
         min="1"
         @change="$emit('change',$event)"
         :value="value" />
         <button data-action="decrement" @click="decrement($event);$emit('change',$event)" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-5 w-full rounded-b cursor-pointer outline-none">
            <span class="m-auto text-lg font-thin">−</span>
         </button>
      </div>
   </div>
 </template>
 <style>
   input[type='number']::-webkit-inner-spin-button,
   input[type='number']::-webkit-outer-spin-button {
     -webkit-appearance: none;
     margin: 0;
   }
 
   .custom-number-input input:focus {
     outline: none !important;
   }
 
   .custom-number-input button:focus {
     outline: none !important;
   }
 </style>
 
 