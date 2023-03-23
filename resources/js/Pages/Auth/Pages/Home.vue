<script setup>
    import { Head,Link,usePage } from '@inertiajs/inertia-vue3';
    import { ref } from 'vue';
    var typeVente = ref(usePage().props.value.session.typeVente);
    const imgAccueil = {
        cosy: new URL('../../../../images/Accueil/Collection_COSY.webp', import.meta.url).href,
        carry: new URL('../../../../images/Accueil/Collection_CARRY.webp', import.meta.url).href,
        bianca: new URL('../../../../images/Accueil/Collection_BIANCA.webp', import.meta.url).href,
        asma: new URL('../../../../images/Accueil/Collection_ASMA.webp', import.meta.url).href,
        harmonie: new URL('../../../../images/Accueil/Collection_HARMONIE.webp', import.meta.url).href,
        stampa: new URL('../../../../images/Accueil/Collection_STAMPA.webp', import.meta.url).href,
    };

    var active = ref(false);
 </script>
<script >

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Contact from 'icons/Gmail.vue';

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
               <h1 class="font-bold lg:text-3xl sm:text-xl text-lg text-gray-800 text-center pb-1 pt-5 px-2">
               {{$page.props.auth.user[0].client.nom_societe}} - {{$t('accueil.titre_principal')}}
               </h1>
               <div class="grid grid-cols-4">
                <div class="col-span-4 m-4"><h2 class="text-center font-bold lg:text-3xl sm:text-2xl text-xl">Découvrez nos dernières collections</h2></div>
                   <article class="xl:col-span-3 col-span-4 grid grid-cols-3 xl:h-full h-[100vh]">
                        <div class="lg:col-span-1 col-span-3 m-2 ">
                            <div :style="{'background-image':'url('+imgAccueil.cosy+')'}" class="relative bg-cover bg-no-repeat h-full w-full">
                                <h3 class="text-white xl:text-3xl lg:text-2xl sm:text-xl text-lg text-center pt-5">Collection Cosy</h3>
                                <Link class="absolute bottom-5 left-1/4 right-1/4 text-center xl:text-2xl lg:text-xl sm:text-lg text-sm text-white bg-primary-100 hover:bg-primary-50 transition duration-300 rounded-xl py-2 xl:px-4 px-2 hover:bg-primary-100 transition duration-300" :href="(typeVente == 1 ? '/order_entrepot' : '/dropshipping')+'/gamme/cosy'">Je découvre</Link>
                            </div>
                        </div>
                        <div class="lg:col-span-2 col-span-3 grid grid-rows-2 m-2 ">
                            <div class="col-span-1 mb-2">
                                <div :style="{'background-image':'url('+imgAccueil.carry+')'}" class="relative bg-cover bg-no-repeat h-full w-full">
                                    <h3 class="text-white xl:text-3xl lg:text-2xl sm:text-xl text-lg text-center pt-5">Collection Carry</h3>
                                    <Link class="absolute bottom-5 left-1/4 right-1/4 text-center xl:text-2xl lg:text-xl sm:text-lg text-sm text-white bg-primary-100 hover:bg-primary-50 transition duration-300 rounded-xl py-2 xl:px-4 px-2 hover:bg-primary-100 transition duration-300" :href="(typeVente == 1 ? '/order_entrepot' : '/dropshipping')+'/gamme/carry'">Je découvre</Link>
                                </div>
                            </div>
                            <div class="col-span-1 mt-2">
                                <div :style="{'background-image':'url('+imgAccueil.bianca+')'}" class="relative bg-cover bg-no-repeat h-full w-full">
                                    <h3 class="text-white xl:text-3xl lg:text-2xl sm:text-xl text-lg text-center pt-5">Collection Bianca</h3>
                                    <Link class="absolute bottom-5 left-1/4 right-1/4 text-center xl:text-2xl lg:text-xl sm:text-lg text-sm text-white bg-primary-100 hover:bg-primary-50 transition duration-300 rounded-xl py-2 xl:px-4 px-2 hover:bg-primary-100 transition duration-300" :href="(typeVente == 1 ? '/order_entrepot' : '/dropshipping')+'/gamme/bianca'">Je découvre</Link>
                                </div>
                            </div>
                        </div>
                   </article>
                   <aside class="ml-16 fixed xl:hidden block right-0 top-[6.5rem] transition-full duration-300 " :class="(active ? 'translate-x-0' : 'translate-x-[100%]')">
                    <button type="button" @click="active = (active ? false : true)" class="shadow-lg h-10 w-10 absolute -left-9 text-primary-200 z-10 text-lg bg-primary-50 rounded-l-lg py-2 px-2" ><Contact /></button>
                    <div class="relative rounded-bl-lg p-3 bg-primary-50 z-40 transition-full duration-300 overflow-scroll" >
                       <div class="overflow-scroll">
                            <h2 class="text-center lg:text-xl text-lg font-bold"> {{$t('accueil.titre_contact')}}</h2>
                            <div class="lg:py-5 py-1">
                                <p class="lg:text-lg text-sm">{{$t('accueil.textMailInfo.text1')}} <br />
                                    {{$t('accueil.textMailInfo.text2')}}  <a class="font-bold" href="mailto:informatique@nazarrugs.fr">informatique@nazarrugs.fr</a></p>
                            </div>
                            <div class="lg:py-5 py-1">
                                <p class="lg:text-lg text-sm">{{$t('accueil.textMailSav.text1')}}<br />
                                    {{$t('accueil.textMailSav.text2')}} <a class="font-bold" href="mailto:sav@nazarrugs.fr">sav@nazarrugs.fr</a></p>
                            </div>
                            <div class="lg:py-5 py-1">
                                <p class="lg:text-lg text-sm">{{$t('accueil.textMailCommande.text1')}}
                                    <br />
                                    {{$t('accueil.textMailCommande.text2')}} <a class="font-bold" href="mailto:commande@nazarrugs.fr">commande@nazarrugs.fr</a></p>
                            </div>
                            <div class="lg:py-5 py-1">
                                <p class="lg:text-lg text-sm">{{$t('accueil.textMailCompta.text1')}}
                                    <br />
                                    {{$t('accueil.textMailCompta.text2')}} <a class="font-bold" href="mailto:compta@nazarrugs.fr">compta@nazarrugs.fr</a></p>
                            </div>
                            <div class="lg:py-5 py-1">
                                <p class="lg:text-lg text-sm">{{$t('accueil.adresseEntrepot')}}<br />
                                    1625 route de Sandillon <br />
                                    45 560 Saint Denis en Val <br />
                                    Tél : <a class="font-bold" href="telto:0238432914">02 38 43 29 14</a></p>
                            </div>
                       </div>
                    </div>
                   </aside>
                   <aside class="col-span-1 text-center m-2 xl:block hidden">
                        <div class="p-3 bg-primary-50">
                       <h2 class="text-center text-xl font-bold"> {{$t('accueil.titre_contact')}}</h2>
                       <div class="py-5">
                           <p class="text-lg">{{$t('accueil.textMailInfo.text1')}} <br />
                            {{$t('accueil.textMailInfo.text2')}}  <a class="font-bold" href="mailto:informatique@nazarrugs.fr">informatique@nazarrugs.fr</a></p>
                       </div>
                       <div class="py-5">
                           <p class="text-lg">{{$t('accueil.textMailSav.text1')}}<br />
                            {{$t('accueil.textMailSav.text2')}} <a class="font-bold" href="mailto:sav@nazarrugs.fr">sav@nazarrugs.fr</a></p>
                       </div>
                       <div class="py-5">
                           <p class="text-lg">{{$t('accueil.textMailCommande.text1')}}
                            <br />
                            {{$t('accueil.textMailCommande.text2')}} <a class="font-bold" href="mailto:commande@nazarrugs.fr">commande@nazarrugs.fr</a></p>
                       </div>
                       <div class="py-5">
                           <p class="text-lg">{{$t('accueil.textMailCompta.text1')}}
                            <br />
                            {{$t('accueil.textMailCompta.text2')}} <a class="font-bold" href="mailto:compta@nazarrugs.fr">compta@nazarrugs.fr</a></p>
                       </div>
                       <div class="py-5">
                           <p class="text-lg">{{$t('accueil.adresseEntrepot')}}<br />
                            1625 route de Sandillon <br />
                            45 560 Saint Denis en Val <br />
                            Tél : <a class="font-bold" href="telto:0238432914">02 38 43 29 14</a></p>
                       </div>
                    </div>
                   </aside>
                   <article class="col-span-4 grid grid-cols-3">
                        <div class="col-span-3 text-center text-3xl m-5">
                            <h2 class="font-bold text-center">BEST-SELLERS</h2>
                            <span >nos meilleures ventes</span>
                        </div>
                        <div class="lg:col-span-1 col-span-3 m-3 hover:drop-shadow-2xl hover:m-2 transition-full duration-300">
                            <Link class="" :href="(typeVente == 1 ? '/order_entrepot' : '/dropshipping')+'/gamme/asma'">
                                <img :src="imgAccueil.asma" alt="Collection Asma" />
                            </Link>
                        </div>
                        <div class="lg:col-span-1 col-span-3 m-3 hover:drop-shadow-2xl hover:m-2 transition-full duration-300">
                            <Link class="" :href="(typeVente == 1 ? '/order_entrepot' : '/dropshipping')+'/gamme/harmonie'">
                                <img :src="imgAccueil.harmonie" alt="Collection Harmonie" />
                            </Link>
                        </div>
                        <div class="lg:col-span-1 col-span-3 m-3 hover:drop-shadow-2xl hover:m-2 transition-full duration-300">
                            <Link class="" :href="(typeVente == 1 ? '/order_entrepot' : '/dropshipping')+'/gamme/stampa'">
                                <img :src="imgAccueil.stampa" alt="Collection Stampa" />
                            </Link>
                        </div>
                   </article>
               </div>
           </section>
   </template>
        