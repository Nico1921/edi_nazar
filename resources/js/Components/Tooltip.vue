<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { TransitionRoot } from '@headlessui/vue'
defineProps({
   'color' : {
      type: String,
      default : '#ececec'
   }
});

var transitionClasses = {
   enter: 'ease-out duration-300',
  enterFrom: 'opacity-0',
  enterTo: 'opacity-100',
  leave: 'ease-in duration-200',
  leaveFrom: 'opacity-100',
  leaveTo: 'opacity-0',
};

var active = ref(false);
var tooltipRef = ref(null);

var showTooltip = () => {
   active.value = true;
};

var hideTooltip = () => {
   active.value = false;
};

var adjustPosition = () => {
  if (tooltipRef.value) {
    const tooltipRect = tooltipRef.value.getBoundingClientRect();
    const bodyRect = document.body.getBoundingClientRect();

   //  if (tooltipRect.left > bodyRect.left) {
   //    tooltipRef.value.classList.add('-translate-x-full');
   //    tooltipRef.value.classList.remove('translate-x-full');
   //  }

   //  if (tooltipRect.right > bodyRect.right) {
   //    tooltipRef.value.classList.add('translate-x-full');
   //    tooltipRef.value.classList.remove('-translate-x-full');
   //  }
    console.log(tooltipRect.left + " "+ bodyRect.left);
  }
};

onMounted(() => {
  window.addEventListener('resize', adjustPosition);
});

onUnmounted(() => {
  window.removeEventListener('resize', adjustPosition);
});
</script>
<template>
<button type="button" class="relative m-1" tabindex="0" role="link" aria-label="tooltip 1"  @mouseover="showTooltip()" @focus="showTooltip()" @mouseout="hideTooltip()">
   <div class="relative cursor-pointer">
      <slot name="header"/>
      
   </div>
   <TransitionRoot
    :show="active"
    :enter="transitionClasses.enter"
    :enter-from="transitionClasses.enterFrom"
    :enter-to="transitionClasses.enterTo"
    :leave="transitionClasses.leave"
    :leave-from="transitionClasses.leaveFrom"
    :leave-to="transitionClasses.leaveTo"
  >
   <div ref="tooltipRef" id="tooltip1" role="tooltip" :style="'background-color:'+color+';'" class="p-2 translate-x-full translate-y-2/4 bottom-2/4 z-20 w-auto absolute transition-all duration-150 ease-in-out right-0 shadow-lg rounded">
      <svg class="absolute left-0 -ml-2 bottom-0 top-0 h-full" width="9px" height="16px" viewBox="0 0 9 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
         <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Tooltips-" transform="translate(-874.000000, -1029.000000)" :fill="color">
               <g id="Group-3-Copy-16" transform="translate(850.000000, 975.000000)">
                  <g id="Group-2" transform="translate(24.000000, 0.000000)">
                     <polygon id="Triangle" transform="translate(4.500000, 62.000000) rotate(-90.000000) translate(-4.500000, -62.000000) " points="4.5 57.5 12.5 66.5 -3.5 66.5"></polygon>
                  </g>
               </g>
            </g>
         </g>
      </svg>
      <slot name="body"/>
   </div>
</TransitionRoot>
</button>
</template>