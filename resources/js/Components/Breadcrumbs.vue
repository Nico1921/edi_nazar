<script setup>
const props = defineProps(['links']);
console.log(props);
</script>
<script>
import { ChevronRightIcon,HomeIcon }  from '@heroicons/vue/24/solid';
</script>
<template>
   <ol class="flex items-center whitespace-nowrap min-w-0 w-full border px-2 rounded border-primary-50 py-2 my-4" aria-label="Breadcrumb">
      <li class="text-sm" :class="link.active ? 'font-semibold text-gray-800 truncate' : ''"  v-for="(link,key) in links" :key="key">
         <a v-if="!link.active" class="flex items-center text-gray-700 hover:text-blue-600 transition duration-300" :href="link.link">
            <component :is="link.icon" class="flex-shrink-0 mr-2 h-4 w-4 text-gray-700 "/>
            {{ link.title }}
            <ChevronRightIcon class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-700" />
         </a>
         <span v-else class="flex">
            <component v-if="link.icon != ''" :is="link.icon" class="flex-shrink-0 mr-2 mb-1 h-4 w-4 text-gray-600 "/>
            {{ link.title }}
         </span>
      </li>
   </ol>
</template>