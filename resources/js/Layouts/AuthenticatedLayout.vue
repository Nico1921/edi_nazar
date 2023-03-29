<script setup>
import NavBar from '@/Components/NavBar.vue';
import Home from 'icons/Home.vue';
import Right from 'icons/ChevronRight.vue';
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';

var user = ref(usePage().props.value.auth.user);
</script>

<template>
    <div class="min-h-full relative lg:pb-20 pb-24" >
        <NavBar>
            <!-- <div class="container mx-auto mt-5" v-if="$page.url != '/' && user != ''">
                <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg " aria-label="Breadcrumb">
                    <ol class="flex items-center ">
                        <li class="flex items-center" v-if="!$page.url.startsWith('/type_order')">
                            <Link href="/" class="text-sm font-medium text-gray-700 hover:text-gray-900"><Home /> Accueil</Link>
                        </li>
                        <li class="flex items-center" v-if="$page.url.startsWith('/type_order')">
                            <Link href="/" class="text-sm font-medium text-gray-700 hover:text-gray-900"><Home /> Choix Type Commande</Link>
                        </li>
                        <li class="flex items-center text-sm" v-if="$page.url != '/'"><Right class="bottom-initial" /></li>
                        <li aria-current="page" class="flex items-center" v-if="$page.url.startsWith('/products')">
                            <span class="text-sm font-medium text-gray-500" > {{$t('navbar.produits')}} </span>
                        </li>
                        <li aria-current="page" class="flex items-center" v-if="$page.url == '/about-us' || $page.url.startsWith('/type_order/about-us')">
                            <span class="text-sm font-medium text-gray-500"> {{$t('navbar.aPropos')}} </span>
                        </li>
                        <li aria-current="page" class="flex items-center" v-if="$page.url == '/settings'">
                            <span class="text-sm font-medium text-gray-500">Mon profil</span>
                        </li>
                        <li aria-current="page" class="flex items-center" v-if="$page.url.startsWith('/orders')">
                            <span class="text-sm font-medium text-gray-500" v-if="$page.url == '/orders'"> {{$t('navbar.commandes')}} </span>
                            <Link href="/orders" class="text-sm font-medium text-gray-700 hover:text-gray-900" v-if="$page.url.startsWith('/orders/')">{{$t('navbar.commandes')}}</Link>
                        </li>
                        <li class="flex items-center text-sm" v-if="$page.url.startsWith('/orders/')"><Right class="bottom-initial" /></li>
                        <li aria-current="page" class="flex items-center" v-if="$page.url.startsWith('/orders/entrepots')">
                            <span class="text-sm font-medium text-gray-500" v-if="$page.url == '/orders/entrepots'"> Entrepots </span>
                            <Link href="/orders" class="text-sm font-medium text-gray-700 hover:text-gray-900" v-if="$page.url.startsWith('/orders/entrepots/')"> Entrepots </Link>
                        </li>
                        <li aria-current="page" class="flex items-center" v-if="$page.url.startsWith('/orders/clients')">
                            <span class="text-sm font-medium text-gray-500" v-if="$page.url == '/orders/clients'"> Clients </span>
                            <Link href="/orders/clients" class="text-sm font-medium text-gray-700 hover:text-gray-900" v-if="$page.url.startsWith('/orders/clients/')"> Clients </Link>
                        </li>
                        <li class="flex items-center text-sm" v-if="$page.url.startsWith('/orders/clients/')"><Right class="bottom-initial" /></li>
                        <li aria-current="page" class="flex items-center" v-if="$page.url.startsWith('/orders/clients/validation')">
                            <span class="text-sm font-medium text-gray-500" v-if="$page.url == '/orders/clients/validation'"> Validation </span>
                        </li>
                        <li aria-current="page" class="flex items-center" v-if="$page.url.startsWith('/cart')">
                            <span class="text-sm font-medium text-gray-500" v-if="$page.url == '/cart'"> Panier </span>
                        </li>
                    </ol>
                </nav>
            </div> -->

            <slot />
        </NavBar>
    </div>
        <footer class="bg-primary-50 grid grid-cols-12 items-center justify-center text-center w-full absolute bottom-0 lg:h-16 h-24">
            <div class="lg:absolute left-5 lg:block hidden">
                <a href="/politique-confidentialite" class="text-gray-400 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Politique de confidentialité</a>
            </div>
            
            <div class="col-span-12">
                <span class="text-gray-400 ">@Copyright NAZAR RUGS {{ new Date().getFullYear() }}</span>
            </div>
            <div class="lg:hidden block col-span-12">
                <a href="/politique-confidentialite" class="text-gray-400 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Politique de confidentialité</a>
            </div>
            <div class="lg:absolute right-5 col-span-12">
                <a href="/cgv" class="text-gray-400 underline hover:text-[1.1rem] cursor-pointer transition-all duration-300">Condition Générale de Vente</a>
            </div>
        </footer>
    
</template>

<style>
.material-design-icon.bottom-initial > .material-design-icon__svg  {
    bottom: 0;
}
</style>