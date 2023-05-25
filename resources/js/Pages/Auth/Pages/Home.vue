<script setup>
    import { Head,usePage } from '@inertiajs/inertia-vue3';
    import { ref } from 'vue';
    const tag = new URL('../../../../images/Symbole/Tag.svg', import.meta.url).href;
    const bulle = new URL('../../../../images/Symbole/Bulle.svg', import.meta.url).href;
    const coeur = new URL('../../../../images/Symbole/Coeur.svg', import.meta.url).href;
    const main = new URL('../../../../images/Symbole/Main.svg', import.meta.url).href;
    const note = new URL('../../../../images/Symbole/Note.svg', import.meta.url).href;
    const smiley = new URL('../../../../images/Symbole/Smiley.svg', import.meta.url).href;
    const trait = new URL('../../../../images/Symbole/Trait.svg', import.meta.url).href;
    const carre = new URL('../../../../images/Symbole/Carre.svg', import.meta.url).href;
    const newI = new URL('../../../../images/Symbole/New.svg', import.meta.url).href;
    var props = defineProps([
            'bandeau', 
            'coupDeCoeur', 
            'news', 
            'best', 
            'hey', 
            'lost']);
    var clientUser = ref(usePage().props.value.auth.user[0].client);

    var typeVente = ref(usePage().props.value.session.typeVente);
    var linkVente  = (typeVente.value == 1 ? '/order_entrepot/gamme/' : '/dropshipping/gamme/');

    var roundNumber = (e) => {
        return (Math.round(e * 100) / 100).toFixed(2);
    };

    const lowercase = (nom) => {
        return HtmlEntities.decode(nom.toLowerCase());
    };

</script>
<script >
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import ImageOff from 'icons/ImageOff.vue';
    import Left from 'icons/MenuLeft.vue';
    import Right from 'icons/MenuRight.vue';

    export default {
    // Using a render function
    layout: (h, page) => h(AuthenticatedLayout, () => child),

    // Using the shorthand
    layout: AuthenticatedLayout,
    }
</script>


<template>
    <Head title="Accueil" /> 
       
    <section class="container mx-auto mt-5 ">
        <div class="w-full flex flex-col items-center justify-center py-5 px-4">
            <h1 class="font-bold lg:text-2xl sm:text-xl text-lg text-gray-800 text-center">
            {{$page.props.auth.user[0].client.nom_societe}} - {{$t('accueil.titre_principal')}} - {{ (typeVente == 1 ? 'Commandes entrepôt' : 'Dropshipping') }}
            </h1>
            <span class="font-bold lg:text-xl sm:text-lg text-sm text-gray-400 text-center">
                Découvrez nos collections
            </span>
        </div>
    </section>
    <section class="mt-5 bg-primary-50 relative h-[45rem]" v-if="props.bandeau != null">
        <a :href="linkVente+lowercase(props.bandeau.nom_gamme)" class="h-full relative w-full container mx-auto">
            <div v-if="props.bandeau.img_gamme !=null" class="h-full relative container mx-auto w-full z-10">
                <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + props.bandeau.img_gamme"
                    :alt="props.bandeau.nom_gamme" 
                    class="z-20 rounded relative  w-full h-full object-cover" />
                    <span class="absolute inset-0 flex items-center justify-center text-white z-20 uppercase xl:text-5xl text-3xl text-center">{{ props.bandeau.text }}</span>
            </div>
            <div v-else class="relative container mx-auto text-3xl w-full flex items-stretch justify-center bg-gray-300">
                <ImageOff />
                <span class="absolute inset-0 flex items-center justify-center text-white z-20 uppercase xl:text-5xl text-3xl text-center">{{ props.bandeau.text }}</span>
            </div>
        </a>
        
    </section>
    <section class="container mx-auto grid grid-cols-6 h-full">
        <div class="xl:col-span-2 col-span-6 h-full mt-5 relative" v-if="props.coupDeCoeur != null">
            <div class="grid grid-cols-3 items-center xl:relative absolute w-full xl:top-12 sm:top-20 top-12">
                <h2 class="text-xl font-semibold col-span-2 ml-[8rem] absolute bottom-0">{{props.coupDeCoeur.text }}</h2>
            </div>
            <div class="relative mt-2">
                <img :src="coeur" alt="coup de coeur" class="absolute xl:left-0 lg:-left-7 xl:top-0 lg:top-12 sm:top-8 z-30 h-24 w-24 object-cover col-span-1 -rotate-12" />
                <div class="relative xl:ml-16">
                    <img :src="carre" alt="coup de coeur" class="absolute z-20 h-full w-full object-cover col-span-1" />
                    <a :href="linkVente+lowercase(props.coupDeCoeur.nom_gamme)" class="p-16 h-full relative w-full container mx-auto block hover:scale-105 transition-all duration-300 z-40">
                        <div class="xl:p-0 lg:p-16 sm:p-12">
                            <div class="relative h-full p-8">    
                                <div v-if="props.coupDeCoeur.img_gamme !=null" class=" relative container mx-auto w-full z-10">
                                    <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + props.coupDeCoeur.img_gamme"
                                        :alt="props.coupDeCoeur.nom_gamme" 
                                        class="z-20 rounded relative  w-full h-full object-cover" />
                                </div>
                                <div v-else class="container mx-auto text-3xl w-full h-full flex items-stretch justify-center bg-gray-300">
                                    <ImageOff />
                                </div>
                                <div class="absolute top-10 -left-4 z-30">
                                    <span class="relative px-12 font-semibold uppercase z-30 h-full flex items-center">{{ props.coupDeCoeur.nom_gamme }}</span>
                                    <img :src="tag" alt="tag" class="absolute top-0 z-20 opacity-80 h-full w-full object-cover" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
        </div>
        <div class="xl:col-span-4 col-span-6 h-full sm:flex hidden items-center justify-center xl:mx-28 mx-16 xl:mt-5 text-center" v-if="props.coupDeCoeur != null">
            <p>{{ props.coupDeCoeur.description_tag }}</p>
        </div>
    </section>
    <hr class="container mx-auto border-2 border-primary-50 mb-8 mt-12" />
        <section class="container mx-auto grid grid-cols-6 h-full">
        <div class="col-span-6 grid xl:grid-cols-3 grid-cols-1" v-if="props.news != null">
            <div class="flex items-center xl:col-span-3 col-span-1 relative mb-5">
                <h2 class="text-xl z-30 font-semibold ml-28">{{props.news[0].text }}</h2>
                <img :src="newI" alt="tag" class="absolute -bottom-4 left-5 -rotate-12 z-20 h-full w-20 overflow-visible object-cover" />
            </div>
            <div v-for="(newP,key) in props.news" :key="key" class="col-span-1 xl:my-0 my-8  mx-8 z-30">
                <a :href="linkVente+lowercase(newP.nom_gamme)" class="h-72 relative w-full container mx-auto block hover:scale-105 transition-all duration-300">
                    <div class="relative pl-12 h-full">    
                        <div v-if="newP.img_gamme !=null" class="h-full relative container mx-auto w-full z-10">
                            <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + newP.img_gamme"
                                :alt="newP.nom_gamme" 
                                class="z-20 rounded relative  w-full h-full object-cover" />
                        </div>
                        <div v-else class="container mx-auto text-3xl w-full flex items-stretch justify-center bg-gray-300">
                            <ImageOff />
                        </div>
                        <div class="absolute -bottom-7 left-1/4 right-1/4 z-40 flex justify-center">
                            <span class="relative px-12 font-semibold uppercase z-30 h-full w-full text-center text-xl py-5">{{ newP.nom_gamme }}</span>
                            <img :src="tag" alt="tag" class="absolute top-0 z-20 opacity-80 h-full w-full object-cover" />
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <hr class="container mx-auto border-2 border-primary-50 mb-8 mt-12" />
    <section class="container mx-auto grid grid-cols-6" v-if="props.best != null">
        <div class="relative flex items-center col-span-6 ">
            <h2 class="text-xl z-30 font-semibold ml-28 xl:mb-5">{{props.best[0].text }}</h2>
            <img :src="note" alt="Note" class="absolute -bottom-4 left-5 -rotate-12 z-20 h-full w-20 overflow-visible object-cover" />
        </div>
        <div v-for="(bestP,key) in props.best" :key="key" class="xl:col-span-2 col-span-6 xl:my-0 my-8 mx-8">
                <a :href="linkVente+lowercase(bestP.nom_gamme)" class="z-20 h-72 relative w-full container mx-auto block hover:scale-105 transition-all duration-300">
                    <div class="relative pl-12 h-full">    
                        <div v-if="bestP.img_gamme !=null" class="h-full relative container mx-auto w-full z-10">
                            <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + bestP.img_gamme"
                                :alt="bestP.nom_gamme" 
                                class="z-20 rounded relative  w-full h-full object-cover" />
                        </div>
                        <div v-else class="container mx-auto text-3xl w-full flex items-stretch justify-center bg-gray-300">
                            <ImageOff />
                        </div>
                        <div class="absolute -bottom-7 left-1/4 right-1/4 z-40 flex justify-center">
                            <span class="relative px-12 font-semibold uppercase z-30 h-full w-full text-center text-xl py-5">{{ bestP.nom_gamme }}</span>
                            <img :src="tag" alt="tag" class="absolute top-0 z-20 opacity-80 h-full w-full object-cover" />
                        </div>
                    </div>
                </a>
        </div>
    </section>
    <hr class="container mx-auto border-2 border-primary-50 mb-8 mt-12" />
    <section class="container mx-auto grid grid-cols-6" v-if="props.hey != null">
        <div class="flex items-center justify-start col-span-6 relative xl:pb-3">
                <img :src="main" alt="bulle" class="absolute -bottom-4 left-2 -rotate-12 z-20 h-full w-32 overflow-visible object-cover" />
                <h2 class="text-xl z-30 font-semibold ml-28">{{props.hey[0].text }}</h2>
            </div>
            <div v-for="(heyP,key) in props.hey" :key="key" class="xl:col-span-2 col-span-6 xl:my-0 my-8 mx-8">
                <a :href="linkVente+lowercase(heyP.nom_gamme)" class="h-72 relative w-full container mx-auto z-20 block hover:scale-105 transition-all duration-300">
                    <div class="relative pl-12 h-full">    
                        <div v-if="heyP.img_gamme !=null" class="h-full relative container mx-auto w-full z-30">
                            <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + heyP.img_gamme"
                                :alt="heyP.nom_gamme" 
                                class="z-20 rounded relative  w-full h-full object-cover" />
                        </div>
                        <div v-else class="container mx-auto text-3xl w-full flex items-stretch justify-center bg-gray-300">
                            <ImageOff />
                        </div>
                        <div class="absolute -bottom-7 left-1/4 right-1/4 z-40 flex justify-center">
                            <span class="relative px-12 font-semibold uppercase z-30 h-full w-full text-center text-xl py-5">{{ heyP.nom_gamme }}</span>
                            <img :src="tag" alt="tag" class="absolute top-0 z-20 opacity-80 h-full w-full object-cover" />
                        </div>
                    </div>
                </a>
            </div>
    </section>
    <hr class="container mx-auto border-2 border-primary-50 mb-8 mt-12" />
    <section class="container mx-auto grid grid-cols-6 mb-12" v-if="props.best != null">
        <div class="flex items-center col-span-6 relative">
                <h2 class="text-xl z-30 font-semibold ml-28 xl:mb-5">{{props.lost[0].text }}</h2>
                <img :src="smiley" alt="smiley" class="absolute -bottom-2 left-8 -rotate-12 z-20 h-full w-16 overflow-visible object-cover" />
            </div>
            <div v-for="(lostP,key) in props.lost" :key="key" class="xl:col-span-2 col-span-6 xl:my-0 my-8  mx-8">
                <a :href="linkVente+lowercase(lostP.nom_gamme)" class="h-72 relative w-full container mx-auto block hover:scale-105 transition-all duration-300 z-20">
                    <div class="relative pl-12 h-full">    
                        <div v-if="lostP.img_gamme !=null" class="h-full relative container mx-auto w-full z-30">
                            <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + lostP.img_gamme"
                                :alt="lostP.nom_gamme" 
                                class="z-20 rounded relative w-full h-full object-cover" />
                        </div>
                        <div v-else class="container mx-auto text-3xl w-full flex items-stretch justify-center bg-gray-300">
                            <ImageOff />
                        </div>
                        <div class="absolute -bottom-7 left-1/4 right-1/4 z-40 flex justify-center">
                            <span class="relative px-12 font-semibold uppercase z-30 h-full w-full text-center text-xl py-5">{{ lostP.nom_gamme }}</span>
                            <img :src="tag" alt="tag" class="absolute top-0 z-20 opacity-80 h-full w-full object-cover" />
                        </div>
                    </div>
                </a>
            </div>
    </section>
</template>
<style>
.opacity-full {
    opacity: 1 !important;
}
</style>