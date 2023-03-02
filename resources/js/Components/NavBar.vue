<script setup>
import { ref, watchEffect, } from 'vue';
import { Link, usePage, useForm } from '@inertiajs/inertia-vue3';
import { Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import InputNumber from '@/Components/InputNumberVertical.vue';
import Langue from '@/Components/LangueChoice.vue';

const imageUrl = new URL('../../images/Logo/Nazar Logo.svg', import.meta.url).href;
const active = ref(false);
var user = ref(usePage().props.value.auth.user);

var typeVente = ref(usePage().props.value.session.typeVente);
var countPanier = ref(usePage().props.value.Panier.count);
var panier = ref(usePage().props.value.Panier.panier.panier);

watchEffect(() => {
	countPanier.value = usePage().props.value.Panier.count;
	typeVente.value = usePage().props.value.session.typeVente;
	panier.value = usePage().props.value.Panier.panier.panier;
});

const imgBase64 = "data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDQwMDAgNDAwMCIgd2lkdGg9IjEwMDAiIGhlaWdodD0iMTAwMCI+PHN0eWxlPi5he2ZpbGw6I2EzYTNhM30uYntmaWxsOiNmZmZ9PC9zdHlsZT48cGF0aCBjbGFzcz0iYSIgZD0ibTQwMDAgNDAwMGgtNDAwMHYtNDAwMGg0MDAweiIvPjxwYXRoIGNsYXNzPSJiIiBkPSJtMzI2NSAzMDQ2Ljh2MjY1LjJoLTI1MzB2LTI2NS4yYzAtNDg5IDU2Ni40LTg4NS41IDEyNjUtODg1LjUgNjk4LjYgMCAxMjY1IDM5Ni41IDEyNjUgODg1LjV6Ii8+PHBhdGggY2xhc3M9ImIiIGQ9Im0yNjI0LjEgMTMxMi4xYzAgMzQ0LjYtMjc5LjQgNjI0LTYyNC4xIDYyNC0zNDQuNyAwLTYyNC4xLTI3OS40LTYyNC4xLTYyNCAwLTM0NC43IDI3OS40LTYyNC4xIDYyNC4xLTYyNC4xIDM0NC43IDAgNjI0LjEgMjc5LjQgNjI0LjEgNjI0LjF6Ii8+PC9zdmc+";

const buttonRef = ref(null);
const timeoutDuration = 200;
let timeout;

const closePopover = () => {
	return buttonRef.value.el.dispatchEvent(
		new KeyboardEvent("keydown", {
			key: "Escape",
			bubbles: true,
			cancelable: true
		})
	)
};

const onMouseEnter = (open) => {
	clearTimeout(timeout);
	if (open) return;
	return buttonRef.value.el.click();
}

const onMouseLeave = (open) => {
	if (!open) return
	timeout = setTimeout(() => closePopover(), timeoutDuration)
};

function strUcFirst(a){return (a+'').charAt(0).toUpperCase()+a.substr(1);};

const findElementInClassArray = (array, elementSearch) => {
   var elementCheck = undefined;
   array.forEach(element => {
      if (element.classList != undefined && element.classList.length > 0) {
         if (element.classList.contains(elementSearch)) {
            elementCheck = element;
         }
      }
   });

   return elementCheck;
}

var modifQte = (e,nomProduit) => {
   e.preventDefault();

   var form = findElementInClassArray(e.path, 'editQteForm');
   if (form != undefined) {
      var formData = new FormData(form);
      const formProduit = useForm({
         idProduit: formData.get("id_produit"),
         quantiter: formData.get("qte"),
         id_panier_edi_list: formData.get("id_panier_edi_list"),
         id_panier_edi: formData.get("id_panier_edi"),
         id_client_edi: formData.get("id_client_edi"),
      });

      formProduit.post(route('cart/products/edit'), {
         preserveScroll: true,
         preserveState: true,
         onSuccess: (e) => {
            if (e.props.session.status) {
               Toast.fire({
                  icon: 'success',
                  title: 'La quantiter du produit '+nomProduit+' à bien été modifier'
               });
            } else {
               Toast.fire({
                  icon: 'error',
                  title: e.props.session.message
               });
            }

         },
      });
   }
};

var deleteCommande = (id_panier_edi_list,id_panier_edi, key) => {
   Swal.fire({
      title: 'Attention',
      text: 'Etes-vous sur de supprimer cette article du panier ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
         const formProduit = useForm({
            id_panier_edi_list: id_panier_edi_list,
            id_panier_edi: id_panier_edi,
         });

         formProduit.post(route('cart/products/delete'), {
            preserveScroll: true,
            onSuccess: (e) => {
               if (e.props.session.status) {
                  Toast.fire({
                     icon: 'success',
                     title: 'Le produit à bien été supprimer du panier'
                  });
               } else {
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur c\'est produit lors de la supression du produit du panier'
                  });
               }

            },
         });
      }
   })
};

var confirmChangeTypeVente = () => {
	Swal.fire({
      title: 'Attention',
      text: 'Etes-vous sur de vouloir passer au commande '+(typeVente.value == 1 ? "B to C"	: "B to B")+' ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Non',
      confirmButtonText: 'Oui',
   }).then((result) => {
      if (result.isConfirmed) {
			document.location.href = (typeVente.value == 1 ? '/type_order/customers' : '/type_order/warehouse');
      }
   })
};
</script>
<script>
import Delete from 'icons/Delete.vue';
import Cart from 'icons/Cart.vue';
import menuHamburger from 'icons/Menu.vue';
import dotsVertical from 'icons/DotsVertical.vue';
import close from 'icons/Close.vue';
import { Link } from '@inertiajs/inertia-vue3';
export default {
	components: {
		Link,
	}
}
</script>

<template>
	<div class="nav" v-if="typeVente != undefined && user != ''">
		<nav class="relative px-4 lg:py-4 py-0 flex justify-between items-center bg-primary-50 z-40">
			<div class="lg:hidden absolute left-5">
				<button @click="active = (active ? false : true)"
					class="navbar-burger flex items-center text-primary-300 text-[20px] p-3 hover:text-primary-500 transition duration-300">
					<menuHamburger />
				</button>
			</div>
			<Link class="text-2xl flex items-center lg:justify-start justify-center w-full font-bold leading-none" href="/">
			<img alt="Logo Nazar" :src="imageUrl" width="100" height="100" />
			</Link>
			<div class="sm:absolute left-10 bottom-1 lg:block hidden" :class="(typeVente == 1 ? 'right-32' : 'right-20')">
				<button class="text-primary-300 font-semibold" @click="confirmChangeTypeVente">{{ (typeVente == 2 ? "B to C" : "B to B") }}</button>
			</div>
			<ul
				class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:items-center lg:w-auto lg:space-x-6">
				<li>
					<Link href="/about-us" :class="{ 'text-primary-500': $page.url.startsWith('/about-us') }"
						class="text-sm text-primary-300 hover:text-primary-500 transition duration-300">
					{{ $t('navbar.aPropos') }}</Link>
				</li>
				<li class="text-primary-300">
					<dotsVertical />
				</li>
				<li>
					<Link href="/products" :class="{ 'text-primary-500': $page.url.startsWith('/products') }"
						class="text-sm text-primary-300 hover:text-primary-500 transition duration-300">
					{{ $t('navbar.produits') }}</Link>
				</li>
				<li class="text-primary-300">
					<dotsVertical />
				</li>
				<li v-if="typeVente == 2">
					<Link href="/orders" :class="{ 'text-primary-500': $page.url.startsWith('/orders') }"
						class="text-sm text-primary-300 hover:text-primary-500 transition duration-300">
					{{ $t('navbar.commandes') }}</Link>
				</li>
				<li v-if="typeVente == 2" class="text-primary-300">
					<dotsVertical />
				</li>
				<li>
					<Link href="/shippings" :class="{ 'text-primary-500': $page.url.startsWith('/shippings') }"
						class="text-sm text-primary-300 hover:text-primary-500 transition duration-300">
					{{ $t('navbar.expeditions') }}</Link>
				</li>
			</ul>

			
			<Menu as="div" class="absolute" :class="(typeVente == 1 ? 'right-20' : 'right-10')">
				<div>
					<MenuButton
						class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
						<span class="sr-only">{{ $t('navbar.txt_profile') }}</span>
						<img class="h-8 w-8 rounded-full bg-white"
							:src="(usePage().props.value.auth.user[0].img_profil != '' ? 'data:image;base64,' + usePage().props.value.auth.user[0].img_profil : imgBase64)" alt="Image profil" />
					</MenuButton>
				</div>
				<transition enter-active-class="transition ease-out duration-100"
					enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
					leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
					leave-to-class="transform opacity-0 scale-95">
					<MenuItems
						class="absolute px-4 right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-primary-50 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
						<MenuItem>
						<Link href="/settings" :class="[active ? 'bg-gray-100' : '', 'block  py-2 text-sm text-gray-700']">
						{{ $t('navbar.profile') }}</Link>
						</MenuItem>
						<MenuItem>
						<Link class="block  py-2 text-sm text-gray-700"
							:href="(typeVente == 1 ? '/type_order/customers' : '/type_order/warehouse')">Passer au {{ (typeVente
									== 1 ? "B to C" : "B to B")
							}}</Link>
						</MenuItem>
						<MenuItem>
						<div class="flex items-center">
							<span class="block pr-2 pt-1 text-sm text-gray-700">Langue : </span>
							<Langue class="relative w-1/2" />
						</div>
						</MenuItem>
						<MenuItem>
						<Link :class="[active ? 'bg-gray-100' : '', 'block  py-2 text-sm text-red-700']"
							:href="route('logout')" method="post" as="button">{{ $t('navbar.deconnexion') }}</Link>
						</MenuItem>
					</MenuItems>
				</transition>
			</Menu>
			<div class="absolute right-10" v-if="typeVente == 1">
				<Popover class="relative" v-slot="{ open }">
					<div @mouseleave="onMouseLeave(open)">
						<PopoverButton class="outline-none" ref="buttonRef" @mouseenter="onMouseEnter(open)">
							<Cart class=" text-2xl text-primary-300 hover:text-primary-500 transition duration-300" />
							<div
								class=" rounded-full bg-primary-200 absolute -top-2 -right-2 w-5 h-5 flex justify-center items-center">
								<span class="text-xs text-primary-500">{{ countPanier }}</span>
							</div>
						</PopoverButton>

						<transition enter-active-class="transition duration-200 ease-out"
							enter-from-class="translate-y-1 opacity-0" enter-to-class="translate-y-0 opacity-100"
							leave-active-class="transition duration-150 ease-in" leave-from-class="translate-y-0 opacity-100"
							leave-to-class="translate-y-1 opacity-0">
							<PopoverPanel @mouseenter="onMouseEnter(open)" @mouseleave="onMouseLeave(open)"
								class="absolute z-20 right-0 mt-2 w-72 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
								<div class="max-h-80 overflow-auto scrollbarCustom">
									<div class=" px-1 py-1 grid grid-cols-6" v-if="panier != undefined" v-for="(produit, key) in panier" :key="key">
										<div class="col-span-1 flex items-center justify-center">
											<div v-if="produit.photo.img_produit != null"
												class="lg:w-[45px] lg:h-[75px] sm:w-[60px] sm:h-[90px] w-[70px] h-[100px]">
												<img :src="'https://gestion.tapis-nazar.fr/img/produit/' + produit.photo.img_produit"
													:alt="produit.code_sku" class="w-full h-full object-cover" />
											</div>
											<div v-else>
												<span>Pas de photo pour ce produit !</span>
											</div>
										</div>
										<div class="col-span-3 flex flex-col ml-1">
											<span>{{ produit.design.nom_design }}</span>
											<span>{{ strUcFirst(produit.couleur.nom_couleur) }}</span>
											<span>{{ produit.dimension.largeur + "x" + produit.dimension.longueur }}cm</span>
										</div>
										<div class="col-span-2 flex items-center justify-evenly">
											<div class="col-span-2 h-full">
												<form v-if="produit.stats_produit.stock_restant > 0" class="editQteForm">
													<InputNumber @change="modifQte($event,produit.design.nom_design + produit.dimension.largeur + 'x' + produit.dimension.longueur)" name="qte"
														:max="produit.stats_produit.stock_restant"
														:value="(produit.panier.quantiter > 0 ? produit.panier.quantiter : 1)" />
													<input type="hidden" name="id_produit" :value="produit.id_produit" />
													<input type="hidden" name="id_panier_edi_list"
														:value="(produit.panier.id_panier_edi_list != undefined ? produit.panier.id_panier_edi_list : 0)" />
													<input type="hidden" name="key_tab" :value="key" />
													<input type="hidden" name="id_panier_edi"
														:value="(produit.id_panier_edi != undefined ? produit.id_panier_edi : 0)" />
													<input type="hidden" name="id_client_edi"
														:value="(produit.panier.id_client_edi != undefined ? produit.panier.id_client_edi : 0)" />
												</form>
											</div>
											<div class="col-span-2 mx-2">
												<button type="button"
													@click="deleteCommande((produit.panier.id_panier_edi_list != undefined ? produit.panier.id_panier_edi_list : 0),(produit.id_panier_edi != undefined ? produit.id_panier_edi : 0),key)"
													class="p-2 bg-red-500 text-white rounded hover:bg-red-300 transition duration-300  h-10">
													<Delete class="text-white" />
												</button>
											</div>
											
										</div>
									</div>
									<div class="h-28 w-full flex items-center justify-center px-1 py-1" v-else>
										<span class="w-full text-center">Votre panier est vide</span>
									</div>
								</div>
								
								<div class="px-1 py-1 rounded-md text-center bg-primary-100 hover:bg-primary-50 transition duration-300 border drop-shadow cursor-pointer">
									<Link href="/cart" class="w-full block text-center">Voir mon panier</Link>
								</div>
							</PopoverPanel>
						</transition>
					</div>
				</Popover>
			</div>
		</nav>
		<div class="navbar-menu relative z-50">
			<div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-0 transition-full duration-300 " :class="(active ? 'opacity-25' : 'relative')" @click="active = (active ? false : true)">
			</div>
			<nav :class="(active ? 'left-0' : '-left-full')" class="transition-full duration-300 fixed top-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-primary-50 border-r overflow-y-auto">
				<div class="flex items-center mb-8 relative">
					<a class="mr-auto text-3xl font-bold leading-none" href="/">
						<img alt="Logo Nazar" :src="imageUrl" width="150" height="150" />
					</a>
					<div class="sm:hidden block absolute -bottom-3 left-5 w-20 bg-primary-100 text-center rounded-lg" :class="(typeVente == 1 ? 'right-32' : 'right-20')">
						<button @click="confirmChangeTypeVente" class="text-primary-300 font-semibold w-full" >{{ (typeVente == 2 ? "B to C" : "B to B") }}</button>
					</div>
					<button class="navbar-close text-[20px]" @click="active = (active ? false : true)">
						<close />
					</button>
				</div>
				<div>
					<ul>
						<li class="mb-1">
							<Link href="/about-us" :class="{ 'text-primary-500': $page.url.startsWith('/about-us') }"
								class="block p-4 text-sm font-semibold text-gray-400 hover:text-gray-600 rounded">
							{{ $t('navbar.aPropos') }}</Link>
						</li>
						<li class="mb-1">
							<Link href="/products" :class="{ 'text-primary-500': $page.url.startsWith('/products') }"
								class="block p-4 text-sm font-semibold text-gray-400 hover:text-gray-600 rounded">
							{{ $t('navbar.produits') }}</Link>
						</li>
						<li v-if="typeVente == 2" class="mb-1">
							<Link href="/orders" :class="{ 'text-primary-500': $page.url.startsWith('/orders') }"
								class="block p-4 text-sm font-semibold text-gray-400 hover:text-gray-600 rounded">
							{{ $t('navbar.commandes') }}</Link>
						</li>
						<li class="mb-1">
							<a :class="{ 'text-primary-500': $page.url.startsWith('/shippings') }"
								class="block p-4 text-sm font-semibold text-gray-400 hover:text-gray-600 rounded"
								href="/shippings">{{ $t('navbar.expeditions') }}</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<div class="nav" v-else>
		<nav class="relative px-4 lg:py-4 py-0 flex justify-between items-center bg-primary-50 z-40">
			<div class="text-2xl flex items-center lg:justify-start justify-center w-full font-bold leading-none" >
				<img alt="Logo Nazar" :src="imageUrl" width="100" height="100" />
			</div>
		</nav>
	</div>

	<slot />
</template>

<style>
/* ===== Scrollbar CSS ===== */
  /* Firefox */
  .scrollbarCustom {
    scrollbar-width: auto;
    scrollbar-color: #c9bfb5 #ffffff;
  }

  /* Chrome, Edge, and Safari */
  .scrollbarCustom::-webkit-scrollbar {
    width: 16px;
  }

  .scrollbarCustom::-webkit-scrollbar-track {
    background: #ffffff;
  }

  .scrollbarCustom::-webkit-scrollbar-thumb {
    background-color: #c9bfb5;
    border-radius: 10px;
    border: 3px solid #ffffff;
  }
</style>

