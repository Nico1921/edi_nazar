<script setup>
import { ref } from 'vue';
import { getActiveLanguage,loadLanguageAsync  } from 'laravel-vue-i18n';
import { useForm} from '@inertiajs/inertia-vue3';
import "/node_modules/flag-icons/css/flag-icons.min.css";
import {  Listbox,  ListboxButton, ListboxOptions,  ListboxOption } from '@headlessui/vue';
import UnfoldMoreHorizontal from 'icons/UnfoldMoreHorizontal.vue';
import Check from 'icons/Check.vue'; 
import axios from 'axios';


const lang = getActiveLanguage(); 
const pays = [
   { name: 'fr', icon: 'fi fi-fr' },
   { name: 'en', icon: 'fi fi-gb' },
]
const form = useForm({
   language: '',
});

const submit = (pays) => {
   if(pays != "" && pays != null){
      axios.get('/language/'+pays).then((response)=>{
         if(response.status == 200){
            loadLanguageAsync(pays);
         }
      })
   }
    
};

var selectedonePays = ref(pays[1]);
if(lang == 'fr'){
   selectedonePays = ref(pays[0]);
}else if(lang == 'en'){
   selectedonePays = ref(pays[1]);
}else {
   selectedonePays = ref(pays[1]);
}
</script>

<template>
   <!-- <div class="relative">
      <Listbox v-model="selectedonePays">
         <div class="relative mt-1">
            <ListboxButton
               class="relative w-full cursor-default rounded-lg bg-primary-50 py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm">
               <span class="block truncate"><span :class="selectedonePays.icon"></span></span>
               <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                  <UnfoldMoreHorizontal class="h-5 w-5 text-gray-400" aria-hidden="true" />
               </span>
            </ListboxButton>

            <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
               <ListboxOptions  class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-primary-50 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                  <ListboxOption v-slot="{ active, selected }" v-for="onePays in pays" :key="onePays.name" :value="onePays" as="template">
                     <li>
                        <button @click="submit(onePays.name)" :value="onePays.name" :class="[active ? 'bg-primary-100 text-amber-900' : 'text-gray-900', 'relative cursor-default select-none py-2 pr-10 pl-4 w-full',]">
                           <span v-if="selected" class="absolute inset-y-0 right-0 flex items-center pr-3 text-primary-300">
                              <Check class="h-5 w-5" aria-hidden="true" />
                           </span>
                           <span :class="[ selected ? 'font-medium' : 'font-normal', 'block truncate flex', ]"><span :class="onePays.icon"></span></span>
                        </button>
                     </li>
                  </ListboxOption>
               </ListboxOptions>
            </transition>
         </div>
      </Listbox>
   </div> -->
</template>
 

 