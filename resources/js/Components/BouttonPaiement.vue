<script setup>
import {ArrowRightCircleIcon} from '@heroicons/vue/24/outline';
</script>

<template>
   <button type="submit" 
      class="py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white
            hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed
                            disabled:bg-green-300">
                            Payer la commande <ArrowRightCircleIcon class="h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300" viewBox="0 0 24 24" fill="none" /></button>
</template>
