<script setup>
var props = defineProps(['name','titre','max','value','placeholder','id']);
function decrement(e) {
      e.preventDefault();
     const btn = e.target.parentNode.parentNode.parentElement.querySelector(
       'button[data-action="decrement"]'
     );
     const target = btn.parentNode.nextElementSibling;
     let value = Number(target.value);
     if(target.min < value){
      value--;
     }
     target.value = value;
   }
 
   function increment(e) {
      e.preventDefault();
     const btn = e.target.parentNode.parentNode.parentElement.querySelector(
       'button[data-action="decrement"]'
     );
     const target = btn.parentNode.nextElementSibling;
     let value = Number(target.value);
     
     if(target.max > value){
      value++;
     }
     
     target.value = value;
   }
</script>
<template>
  <div>
    <label v-if="titre != ''" for="custom-input-number" class="w-full text-gray-700 text-sm font-semibold">{{titre}}
      </label>
      <div class="custom-number-input flex flex-row min-h-full h-full w-full rounded-lg relative bg-transparent group">
        <div class="group-focus:border-primary-200 group-focus:border-2">
          <button data-action="decrement" @click="decrement($event);$emit('change',$event)" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-6 rounded-l cursor-pointer outline-none">
            <span class="m-auto h-auto text-xl font-thin">−</span>
         </button>
        </div> 
        
         <input type="number" required
          class="transition duration-300 focus:bg-white focus:border-2 border-solid focus:border-primary-200 focus:text-gray-800 focus:ring-0 border-none outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-base cursor-default flex items-center text-gray-700 " 
          :name="name" 
          :max="max"
          min="1"
          @change="$emit('change',$event)"
          :value="value"
          :placeholder="placeholder" 
          :id="id"/>

         <div>
            <button data-action="increment" @click="increment($event);$emit('change',$event)" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-6 rounded-r cursor-pointer">
          <span class="m-auto text-xl font-thin">+</span>
          </button>
        </div> 
         
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
 
 