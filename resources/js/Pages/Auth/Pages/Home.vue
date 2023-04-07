<script setup>
    import { Head,usePage } from '@inertiajs/inertia-vue3';
    import { ref } from 'vue';
    import { Swiper, SwiperSlide } from "swiper/vue";
    import { Navigation, Pagination, Scrollbar, A11y } from 'swiper';
    import "swiper/css";
    import "swiper/css/navigation";
    import 'swiper/css/pagination';

    var props = defineProps(['latestCollection','bestSeller']);
    var clientUser = ref(usePage().props.value.auth.user[0].client);
    console.log(props);

    var typeVente = ref(usePage().props.value.session.typeVente);
    var linkVente  = (typeVente.value == 1 ? '/order_entrepot/gamme/' : '/dropshipping/gamme/');
    var calcul_prix_gamme = (prix_gamme) => {
        var HT = prix_gamme;
        if(clientUser.value.taux_remise > 0){
            HT = HT - ((HT) * (clientUser.value.taux_remise /100));
        }
        return roundNumber(HT);
    };

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
    <Head :title="$t('accueil.titre')" /> 
       
    <section class="container mx-auto mt-5 ">
        <div class="w-full flex flex-col items-center justify-center py-5 px-4">
            <h1 class="font-bold lg:text-2xl sm:text-xl text-lg text-gray-800 text-center">
            {{$page.props.auth.user[0].client.nom_societe}} - {{$t('accueil.titre_principal')}} - {{ (typeVente == 1 ? 'Commande entrepôt' : 'Dropshipping') }}
            </h1>
            <span class="font-bold lg:text-xl sm:text-lg text-sm text-gray-400 text-center">
                Découvrez nos collections
            </span>
        </div>
        

        <div class="">
            <h2 class="font-bold lg:text-xl sm:text-lg text-sm lg:!px-10 !px-0">Nos nouvelles collections</h2>
            <swiper :modules="[Navigation, Pagination, Scrollbar, A11y]"
                    :slides-per-view="3"
                    :space-between="40"
                    :breakpoints="{ 1280:{ slidesPerView:3}, 640:{ slidesPerView:2}, 0:{ slidesPerView:1} }"
                    :pagination="{ clickable: true, el: '.swiper-pagination-custom',bulletActiveClass: 'opacity-full',bulletClass:'swiper-pagination-bullet mx-2 !bg-primary-300', type: 'bullets' }"
                    :scrollbar="{ draggable: true }"
                    :navigation="{nextEl: '.swiper-button-prev-custom', prevEl: '.swiper-button-next-custom', disabledClass: 'lg:hidden'}"
                    class="lg:!px-10 !px-0 lg:!py-2 lg:!pt-4 !py-2 !relative">
                <div class="swiper-button-prev-custom absolute justify-center items-center top-0 bottom-0 right-0 z-40 cursor-pointer lg:flex hidden">
                    <Right class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
                </div>
                <div class="swiper-button-next-custom absolute justify-center items-center top-0 bottom-0 left-0 z-40 cursor-pointer lg:flex hidden">
                    <Left class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
                </div>
                <div class="swiper-pagination-custom lg:hidden flex items-center justify-center py-2"></div>
                <swiper-slide class="lg:px-2" v-for="(gamme, key) in props.latestCollection" :key="key">
                    <a :href="linkVente+lowercase(gamme.nom_gamme)" class="group h-full flex flex-col relative border border-primary-200 hover:scale-105 transition-all duration-300">
                        
                        <div class="relative group">
                            <div class="flex items-stretch justify-center w-full !h-52">
                                <div v-if="gamme.img_gamme != null" class="relative w-full ">
                                    <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + gamme.img_gamme"
                                            :alt="gamme.nom_gamme" 
                                            class="z-20 rounded relative  w-full h-full object-cover" />
                                </div>
                                <div v-else class="text-3xl w-full flex items-stretch justify-center bg-gray-300">
                                    <ImageOff />
                                </div>
                            </div>
                            <div class="absolute bottom-0 z-30 w-full h-full overflow-hidden">
                                <div class="absolute bottom-0 max-h-0 group-hover:max-h-full h-full w-full overflow-hidden group-hover:p-1 transition-full duration-500 bg-primary-100 text-center flex flex-col items-center justify-center  bg-opacity-80 text-white">
                                    <span class="px-4 py-2 rounded border border-primary-300 bg-primary-100 text-primary-300 font-bold">Découvrir la collection</span>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="bg-white px-4 py-2 w-full ">
                            <h3 class="font-bold lg:text-lg text-sm">
                                Collection {{ gamme.nom_gamme }}
                            </h3>
                            <span class="font-bold text-gray-400">Prix au m² : {{ calcul_prix_gamme(gamme.prix_vente_ht_m2) }} €</span>
                        </div>
                    </a>
                </swiper-slide>
            </swiper>
        </div>
        <hr class="border border-primary-300 lg:!mx-10 !mx-0 my-5" />
        <div>
            <h2 class="font-bold lg:text-xl sm:text-lg text-sm lg:!px-10 !px-0">Meilleures ventes</h2>
            <swiper :modules="[Navigation, Pagination, Scrollbar, A11y]"
                    :slides-per-view="6"
                    :space-between="40"
                    :breakpoints="{ 1536:{ slidesPerView:6}, 1280:{ slidesPerView:5}, 1024:{ slidesPerView:4}, 640:{ slidesPerView:3}, 460:{ slidesPerView:2}, 0:{ slidesPerView:1} }"
                    :pagination="{ clickable: true, el: '.swiper-pagination-custom',bulletActiveClass: 'opacity-full',bulletClass:'swiper-pagination-bullet mx-2 !bg-primary-300', type: 'bullets' }"
                    :scrollbar="{ draggable: true }"
                    :navigation="{nextEl: '.swiper-button-prev-custom', prevEl: '.swiper-button-next-custom', disabledClass: 'lg:hidden'}"
                    class="lg:!px-10 !px-0 lg:!py-2 lg:!pt-4 !py-2 !relative">
                <div class="swiper-button-prev-custom absolute justify-center items-center top-0 bottom-0 right-0 z-40 cursor-pointer lg:flex hidden">
                    <Right class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
                </div>
                <div class="swiper-button-next-custom absolute justify-center items-center top-0 bottom-0 left-0 z-40 cursor-pointer lg:flex hidden">
                    <Left class="!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100" />
                </div>
                <div class="swiper-pagination-custom lg:hidden flex items-center justify-center py-2"></div>
                <swiper-slide class="lg:px-2" v-for="(gamme, key) in props.bestSeller" :key="key">
                    <a :href="linkVente+lowercase(gamme.nom_gamme)" class="h-full flex flex-col relative border border-primary-200 hover:scale-105 transition-all duration-300">
                        <div class="relative group">
                            <div class="flex items-stretch justify-center w-full !h-52">
                                <div v-if="gamme.img_gamme != null" class="relative w-full ">
                                    <img  :src="'https://gestion.tapis-nazar.fr/img/produit/gamme/' + gamme.img_gamme"
                                            :alt="gamme.nom_gamme" 
                                            class="z-20 rounded relative  w-full h-full object-cover" />
                                </div>
                                <div v-else class="text-3xl w-full flex items-stretch justify-center bg-gray-300">
                                    <ImageOff />
                                </div>
                            </div>
                            <div class="absolute bottom-0 z-30 w-full h-full overflow-hidden">
                                <div class="absolute bottom-0 max-h-0 group-hover:max-h-full h-full w-full overflow-hidden group-hover:p-1 transition-full duration-500 bg-primary-100 text-center flex flex-col items-center justify-center  bg-opacity-80 text-white">
                                    <span class="px-4 py-2 rounded border border-primary-300 bg-primary-100 text-primary-300 font-bold">Découvrir la collection</span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="bg-white px-4 py-2 w-full ">
                            <h3 class="font-bold lg:text-lg text-sm flex flex-col justify-center text-center">
                                <span>Collection</span> 
                                <span>{{ gamme.nom_gamme }}</span>
                            </h3>
                            <span class="font-bold text-gray-400 flex flex-col justify-center text-center">
                                <span>Prix au m² : </span>
                                <span>{{ calcul_prix_gamme(gamme.prix_vente_ht_m2) }} €</span>
                            </span>
                        </div>
                    </a>
                </swiper-slide>
            </swiper>
        </div>
    </section>
</template>
<style>
.opacity-full {
    opacity: 1 !important;
}
</style>