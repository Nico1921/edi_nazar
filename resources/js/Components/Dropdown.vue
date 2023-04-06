<script setup>
import {  onMounted, onUnmounted, ref } from 'vue';

const transitionClasses = {
  enter: 'transform ease-out duration-300 transition',
  enterFrom: 'translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2',
  enterTo: 'translate-y-0 opacity-100 sm:translate-x-0',
  leave: 'transition ease-in duration-100',
  leaveFrom: 'opacity-100',
  leaveTo: 'opacity-0',
};


const props = defineProps({
    alignDrop: {
        default: 'bottom'
    },
});

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

var classChoose = () => {
    var classChoix = '';
    switch(props.alignDrop) {
        case 'bottom' : 
            classChoix = 'origin-top-left left-0 top-8';
            break;
        case 'right' : 
            classChoix = 'origin-top-left top-0 left-full';
            break;
        case 'left' : 
            classChoix = 'origin-top-left top-0 right-full';
            break;
        case 'top' : 
            classChoix = 'origin-top-left left-0 bottom-8';
            break;
        default : 
            classChoix = 'origin-top-left left-0 top-8';
            break;
    }
    
    return classChoix;
}

const open = ref(false);
</script>

<template>
    <div class="relative"  @mouseleave="open = false">
        <div @mouseenter="open = true"  @click="open = ! open" class="py-2 px-2 z-[50] relative cursor-pointer" >
            <slot name="trigger" />
        </div>

      

        <transition 
            :enter-active-class="transitionClasses.enter"
            :enter-from-class="transitionClasses.enterFrom"
            :enter-to-class="transitionClasses.enterTo "
            :leave-active-class="transitionClasses.leave"
            :leave-from-class="transitionClasses.leaveFrom"
            :leave-to-class="transitionClasses.leaveTo">
            <div  v-show="open"
                    class="absolute z-50 rounded-md shadow-lg w-full"
                    :class="classChoose()"
                    style="display: none;"
                    @mouseenter="open = true"  >
                <div class=" w-full" >
                    <slot name="content" />
                </div>
            </div>
        </transition>
    </div>
</template>
