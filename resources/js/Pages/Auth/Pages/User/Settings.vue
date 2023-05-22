<script setup>
import { Head,usePage,useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { HomeIcon,Cog6ToothIcon  } from '@heroicons/vue/24/solid';
      
var links = [{
      title: 'Accueil',
      link: '/',
      icon: HomeIcon,
      active: false
   },{
      title: 'Votre profil',
      link: '/settings',
      icon: Cog6ToothIcon,
      active: true
}];

var user = ref(usePage().props.value.auth.user[0]);
var client = ref(usePage().props.value.auth.user[0].client);
const imgBase64 = "data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDQwMDAgNDAwMCIgd2lkdGg9IjEwMDAiIGhlaWdodD0iMTAwMCI+PHN0eWxlPi5he2ZpbGw6I2EzYTNhM30uYntmaWxsOiNmZmZ9PC9zdHlsZT48cGF0aCBjbGFzcz0iYSIgZD0ibTQwMDAgNDAwMGgtNDAwMHYtNDAwMGg0MDAweiIvPjxwYXRoIGNsYXNzPSJiIiBkPSJtMzI2NSAzMDQ2Ljh2MjY1LjJoLTI1MzB2LTI2NS4yYzAtNDg5IDU2Ni40LTg4NS41IDEyNjUtODg1LjUgNjk4LjYgMCAxMjY1IDM5Ni41IDEyNjUgODg1LjV6Ii8+PHBhdGggY2xhc3M9ImIiIGQ9Im0yNjI0LjEgMTMxMi4xYzAgMzQ0LjYtMjc5LjQgNjI0LTYyNC4xIDYyNC0zNDQuNyAwLTYyNC4xLTI3OS40LTYyNC4xLTYyNCAwLTM0NC43IDI3OS40LTYyNC4xIDYyNC4xLTYyNC4xIDM0NC43IDAgNjI0LjEgMjc5LjQgNjI0LjEgNjI0LjF6Ii8+PC9zdmc+";
const formSecu = useForm({
    email: user.value.email,
    email_confirmation: user.value.email,
    actualPassword: '',
    password: '',
    password_confirmation: '',
});

const formGeneral = useForm({
    contact: client.value.contact,
    tel: client.value.tel1,
});

const formSociete = useForm({
    adresse: client.value.adresse1,
    cp: client.value.code_postal,
    ville: client.value.ville,
    pays: client.value.pays,
});

const formProfil = useForm({
    profil: client.value.img_profil,
});

const formReseaux = useForm({
   social_twitter: client.value.social_twitter,
   social_insta: client.value.social_insta,
   social_facebook: client.value.social_facebook,
   social_linkedin: client.value.social_linkedin,
   social_website: client.value.social_website,
});

var editFormSecu = ref(false);
var editFormGeneral = ref(false);
var editFormSociete = ref(false);
var editformReseaux = ref(false);

var fEditSecu = () => {
   editFormSecu.value = true;
   editFormGeneral.value = false;
   editFormSociete.value = false;
   editformReseaux.value = false;
};

var fEditGeneral = () => {
   editFormSecu.value = false;
   editFormGeneral.value = true;
   editFormSociete.value = false;
   editformReseaux.value = false;
};

var fEditSociete = () => {
   editFormSecu.value = false;
   editFormGeneral.value = false;
   editFormSociete.value = true;
   editformReseaux.value = false;
};

var fEditResaux = () => {
   editFormSecu.value = false;
   editFormGeneral.value = false;
   editFormSociete.value = false;
   editformReseaux.value = true;
};

var fNotEdit = () => {
   editFormSecu.value = false;
   editFormGeneral.value = false;
   editFormSociete.value = false;
   editformReseaux.value = false;
};


var submitSecu = () => {
   formSecu.post(route('settings/save/security'), {
        onSuccess: (e) => {
            if(e.props.session.status){
               user.value.email = formSecu.email;
               fNotEdit();
               Toast.fire({
                  icon: 'success',
                  title: 'Mise à jour avec succès !'
               });
            }else{
               if(e.props.session.message != ""){
                  Toast.fire({
                     icon: 'error',
                     title: e.props.session.message
                  });
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
                  });
               }
            }
        },
        onError: (e) => {
            if(formSecu.errors.length == 0){
               if(e.props.session.message != ""){
                  Toast.fire({
                     icon: 'error',
                     title: e.props.session.message
                  });
               }else{
                  Toast.fire({
                     icon: 'error',
                     title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
                  });
               }
               
            }
        },
    });
};

var submitGeneral = () =>{
   formGeneral.post(route('settings/save/general'), {
        onSuccess: (e) => {
            if(e.props.session.status){
               client.value.contact = formGeneral.contact;
               client.value.tel1 = formGeneral.tel;
               fNotEdit();
               Toast.fire({
                  icon: 'success',
                  title: 'Mise à jour avec succès !'
               });
            }else{
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
               });
            }
        },
        onError: (e) => {
            if(formGeneral.errors.length == 0){
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
               });
            }
        },
    });
};

var submitSociete = () =>{
   formSociete.post(route('settings/save/company'), {
        onSuccess: (e) => {
            if(e.props.session.status){
               client.value.adresse1 = formSociete.adresse;
               client.value.code_postal = formSociete.cp;
               client.value.ville = formSociete.ville;
               client.value.pays = formSociete.pays;
               fNotEdit();
               Toast.fire({
                  icon: 'success',
                  title: 'Mise à jour avec succès !'
               });
            }else{
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
               });
            }
        },
        onError: (e) => {
            if(formSociete.errors.length == 0){
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
               });
            }
        },
    });
};

var submitProfil = () =>{
   formProfil.post(route('settings/save/profil'), {
        onSuccess: (e) => {
            if(e.props.session.status){
               user.value.img_profil = e.props.session.imgBase64;
               fNotEdit();
               Toast.fire({
                  icon: 'success',
                  title: 'Mise à jour avec succès !'
               });
            }else{
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
               });
            }
        },
        onError: (e) => {
            if(formProfil.errors.length == 0){
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
               });
            }
        },
    });
};

var submitResaux = () =>{
   formReseaux.post(route('settings/save/sociaux'), {
        onSuccess: (e) => {
            if(e.props.session.status){
               console.log('test');
               client.value.social_twitter = formReseaux.social_twitter;
               client.value.social_insta = formReseaux.social_insta;
               client.value.social_facebook = formReseaux.social_facebook;
               client.value.social_linkedin = formReseaux.social_linkedin;
               client.value.social_website = formReseaux.social_website;
               fNotEdit();
               Toast.fire({
                  icon: 'success',
                  title: 'Mise à jour avec succès !'
               });
            }else{
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
               });
            }
        },
        onError: (e) => {
            if(formReseaux.errors.length == 0){
               Toast.fire({
                  icon: 'error',
                  title: 'Une erreur s\'est produite lors de la modification des informations veuillez ressayer plus tard !'
               });
            }
        },
    });
};
</script>
<script >
import User from "icons/Account.vue";
import Security from "icons/AccountLock.vue";
import Domain from "icons/Domain.vue";
import Edit from "icons/Pencil.vue";
import Close from "icons/Close.vue";
import Account from "icons/AccountDetails.vue";
import Lock from "icons/Lock.vue";
import KeyAccount from "icons/AccountKey.vue";
import Mail from "icons/Email.vue";
import Phone from "icons/Phone.vue";
import WebSocial from "icons/SearchWeb.vue";
import Documents from "icons/FileDocumentMultiple.vue";
import Web from "icons/Web.vue";
import Twitter from "icons/Twitter.vue";
import Facebook from "icons/Facebook.vue";
import Instagram from "icons/Instagram.vue";
import Linkedin from "icons/Linkedin.vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    // Using a render function
    layout: (h, page) => h(AuthenticatedLayout, () => child),

    // Using the shorthand
    layout: AuthenticatedLayout,
}
</script>
   
<template>
    <Head title="Mon profil" />
    <section class="container mx-auto sm:px-7 mt-5">
      <Breadcrumbs :links="links" />
      <div class="grid grid-cols-4">
         <div class="col-span-4 m-2 relative w-full pt-20 mr-2 pr-4 lg:hidden block">
            <form class="w-full flex items-center justify-center absolute top-0 z-30">
               <img class="h-32 w-32 rounded-full drop-shadow-xl" :src="(user.img_profil != '' ? 'data:image;base64,' + user.img_profil : imgBase64)" alt="Image profil" />
               <input type="file" @change="submitProfil" accept=".jpg, .jpeg, .png" id="img_profil" class="hidden" name="img-profil" required @input="formProfil.profil = $event.target.files[0]"  />
               <label for="img_profil" class="flex items-center justify-center cursor-pointer h-7 w-7 absolute sm:right-[40%] xsm:right-[38%] right-[35%] top-2 rounded-full bg-primary-50 hover:bg-primary-100 transition duration-300 "><Edit class="absolute bottom-0.5" /></label>
               <InputError class="mt-2" :message="formProfil.errors.profil" />
            </form>
            <div class="w-full flex items-center justify-center absolute top-0 z-20">
               <i class="block bg-white rounded-full h-36 w-36 "></i>
            </div>
            <div class=" bg-gray-50 drop-shadow-xl rounded-lg min-h-full pt-16 p-4 z-10">
               <h2 class="text-center font-bold text-lg">{{client.nom_societe}}</h2>
               <span class="text-center font-semibold text-sm block">N° TVA : {{client.tva_intra}}</span>

               <h3 class="text-center font-semibold text-lg mt-5">Contact : </h3>
               <div class="flex sm:flex-row flex-col mx-2 mt-2 items-center justify-center">
                  <span class="mr-1">{{client.contact}},</span>
                  <span class="mr-1">{{client.adresse1}},</span>
                  <span class="mr-1">{{client.code_postal}}, {{client.ville}}</span>
                  <span class="mr-1">{{client.pays}}</span>
               </div>
               
            </div>
         </div>
         <div class="lg:col-span-3 col-span-4 bg-gray-50 m-2 p-4 drop-shadow-xl rounded-lg h-full">
            <h1 class="text-center font-bold text-xl">Votre profil</h1>
            <div class="m-4">
               <div class="flex">
                  <h2 class="font-semibold text-lg mr-4 mt-0.5"><Security /> Sécurité</h2>
                  <button v-if="!editFormSecu" type="button" @click="fEditSecu" 
                  class="hover:text-white hover:bg-primary-100 flex items-center justify-start px-2 py-2  rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative">
                     <Edit class="absolute bottom-0.5" /> <span class="text-white absolute px-2  left-6">Modifier</span>
                  </button>
                  <button v-if="editFormSecu" type="button" @click="fNotEdit"
                  class="hover:text-white hover:bg-red-500 flex items-center justify-start px-2 py-2  rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative">
                  <Close class="absolute bottom-0.5" /> <span class="text-white absolute px-2 left-6">Annuler</span></button>
               </div>
               
               <div v-if="!editFormSecu" class="grid grid-cols-4 mt-3">
                  <span class="lg:col-span-2 col-span-4">E-mail : {{user.email}}</span>
                  <span class="lg:col-span-2 col-span-4">Mot de passe : ****************</span>
               </div>
               <form v-if="editFormSecu" @submit.prevent="submitSecu" class="grid grid-cols-4 mt-3">
                  <div class="2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="email" class="lg:w-2/12 sm:w-3/12 w-full"><Mail /> Mail :</label>
                     <input type="email" id="email"
                  class="bg-transparent focus:ring-0 border-none lg:w-10/12 sm:w-9/12 w-full text-zinc-800"
                  name="email" required autofocus autocomplete="email" v-model="formSecu.email"/>
                     <InputError class="mt-2" :message="formSecu.errors.email" />
                  </div>
                  <div class="2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="email_confirmation" class="sm:w-5/12 w-full"><Mail /> Confirmation Mail :</label>
                     <input type="email" id="email_confirmation"
                  class="bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-zinc-800"
                  name="email_confirmation" required autofocus autocomplete="email" v-model="formSecu.email_confirmation"/>
                     <InputError class="mt-2" :message="formSecu.errors.email_confirmation" />
                  </div>
                  <div class="col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="actualPassword" class="sm:w-6/12 w-full"><KeyAccount /> Mot de passe actuelle : </label>
                     <input type="password" id="actualPassword"
                  class="bg-transparent focus:ring-0 border-none sm:w-6/12 w-full text-zinc-800"
                  name="actualPassword" autofocus v-model="formSecu.actualPassword"/>
                     <InputError class="mt-2" :message="formSecu.errors.actualPassword" />
                  </div>
                  <div class="2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="password" class="sm:w-6/12 w-full"><Lock /> Nouveau mot de passe</label>
                     <input type="password" id="password"
                  class="bg-transparent focus:ring-0 border-none sm:w-6/12 w-full text-zinc-800"
                  name="password" autofocus v-model="formSecu.password"/>
                     <InputError class="mt-2" :message="formSecu.errors.password" />
                  </div>
                  <div class="2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="password_confirmation" class="lg:w-6/12 sm:w-7/12 w-full"><Lock /> Confirmation mot de passe :</label>
                     <input type="password" id="password_confirmation"
                  class="bg-transparent focus:ring-0 border-none lg:w-6/12 sm:w-4/12 w-full text-zinc-800"
                  name="password_confirmation" autofocus v-model="formSecu.password_confirmation"/>
                     <InputError class="mt-2" :message="formSecu.errors.password_confirmation" />
                  </div>

                  <div class="col-span-4 flex justify-center items-center">
                     <button :class="{ 'opacity-25': formSecu.processing }" :disabled="formSecu.processing" type="submit" class="rounded-2xl bg-primary-100 text-white px-4 py-2 m-2 hover:bg-primary-50 transition duration-300">Sauvegarder</button>
                  </div>
               </form>
            </div>
            <div class="m-4">
               <div class="flex">
                  <h2 class="font-semibold text-lg mr-4 mt-0.5"><User /> Informations générales</h2>
                  <button v-if="!editFormGeneral" type="button" @click="fEditGeneral" class="hover:text-white hover:bg-primary-100 flex items-center justify-start px-2 py-2  rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative">
                     <Edit class="absolute bottom-0.5" /> <span class="text-white absolute px-2  left-6">Modifier</span></button>
                  <button v-if="editFormGeneral" type="button" @click="fNotEdit" class="hover:text-white hover:bg-red-500 flex items-center justify-start px-2 py-2  rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative">
                  <Close class="absolute bottom-0.5" /> <span class="text-white absolute px-2 left-6">Annuler</span></button>
               </div>
               
               <div v-if="!editFormGeneral" class="grid grid-cols-4 mt-3">
                  <span class="lg:col-span-2 col-span-4">Nom contact : {{client.contact}}</span>
                  <span class="lg:col-span-2 col-span-4">Téléphone : {{client.tel1}}</span>
               </div>
               <form v-if="editFormGeneral" @submit.prevent="submitGeneral" class="grid grid-cols-4 mt-3">
                  <div class="2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="contact" class="sm:w-5/12 w-full"><Account /> Nom contact :</label>
                     <input type="text" id="contact"
                  class="bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500"
                  name="text" required autofocus autocomplete="name" v-model="formGeneral.contact"/>
                     <InputError class="mt-2" :message="formGeneral.errors.contact" />
                  </div>
                  <div class="2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="phone" class="sm:w-5/12 w-full"><Phone /> Téléphone :</label>
                     <input type="text" id="phone"
                  class="bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500"
                  name="phone" required autofocus autocomplete="tel" v-model="formGeneral.tel"/>
                     <InputError class="mt-2" :message="formGeneral.errors.tel" />
                  </div>

                  <div class="col-span-4 flex justify-center items-center">
                     <button :class="{ 'opacity-25': formGeneral.processing }" :disabled="formGeneral.processing" type="submit" class="rounded-2xl bg-primary-100 text-white px-4 py-2 m-2 hover:bg-primary-50 transition duration-300">Sauvegarder</button>
                  </div>
               </form>
            </div>
            <div class="m-4">
               <div class="flex">
                  <h2 class="font-semibold text-lg mr-4 mt-0.5"><Domain /> Société</h2>
                  <button v-if="!editFormSociete" type="button" @click="fEditSociete" class="hover:text-white hover:bg-primary-100 flex items-center justify-start px-2 py-2  rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative">
                     <Edit class="absolute bottom-0.5" /> <span class="text-white absolute px-2  left-6">Modifier</span></button>
                  <button v-if="editFormSociete" type="button" @click="fNotEdit" class="hover:text-white hover:bg-red-500 flex items-center justify-start px-2 py-2  rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative">
                  <Close class="absolute bottom-0.5" /> <span class="text-white absolute px-2 left-6">Annuler</span></button>
               </div>
               
               <div v-if="!editFormSociete" class="grid grid-cols-4 mt-3">
                  <span class="2xl:col-span-1 lg:col-span-2 col-span-4">Adresse : {{client.adresse1}}</span>
                  <span class="2xl:col-span-1 lg:col-span-2 col-span-4">Code Postal : {{client.code_postal}}</span>
                  <span class="2xl:col-span-1 lg:col-span-2 col-span-4">Ville : {{client.ville}}</span>
                  <span class="2xl:col-span-1 lg:col-span-2 col-span-4">Pays : {{client.pays}}</span>
               </div>
               <form v-if="editFormSociete" @submit.prevent="submitSociete" class="grid grid-cols-4 mt-3">
                  <div class="xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="adresse" class="sm:w-5/12 w-full">Adresse entreprise :</label>
                     <input type="text" id="adresse"
                  class="bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500"
                  name="text" required autofocus autocomplete="street-address" v-model="formSociete.adresse"/>
                     <InputError class="mt-2" :message="formSociete.errors.adresse" />
                  </div>
                  <div class="xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="cp" class="sm:w-5/12 w-full">Code postal : </label>
                     <input type="text" id="cp"
                  class="bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500"
                  name="cp" required autofocus autocomplete="postal-code" v-model="formSociete.cp"/>
                     <InputError class="mt-2" :message="formSociete.errors.cp" />
                  </div>
                  <div class="xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="ville" class="sm:w-5/12 w-full">Ville : </label>
                     <input type="text" id="ville"
                  class="bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500"
                  name="ville" required autofocus autocomplete="city"  v-model="formSociete.ville"/>
                     <InputError class="mt-2" :message="formSociete.errors.ville" />
                  </div>
                  <div class="xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="pays" class="sm:w-5/12 w-full">Pays : </label>
                     <input type="text" id="pays"
                  class="bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500"
                  name="pays" required autofocus autocomplete="country-name"  v-model="formSociete.pays"/>
                     <InputError class="mt-2" :message="formSociete.errors.pays" />
                  </div>

                  <div class="col-span-4 flex justify-center items-center">
                     <button :class="{ 'opacity-25': formSociete.processing }" :disabled="formSociete.processing" type="submit" class="rounded-2xl bg-primary-100 text-white px-4 py-2 m-2 hover:bg-primary-50 transition duration-300">Sauvegarder</button>
                  </div>
               </form>
            </div>
            <div class="m-4">
               <div class="flex">
                  <h2 class="font-semibold text-lg mr-4 mt-0.5"><WebSocial /> Réseaux sociaux</h2>
                  <button v-if="!editformReseaux" type="button" @click="fEditResaux" class="hover:text-white hover:bg-primary-100 flex items-center justify-start px-2 py-2  rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative">
                     <Edit class="absolute bottom-0.5" /> <span class="text-white absolute px-2  left-6">Modifier</span></button>
                  <button v-if="editformReseaux" type="button" @click="fNotEdit" class="hover:text-white hover:bg-red-500 flex items-center justify-start px-2 py-2  rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative">
                  <Close class="absolute bottom-0.5" /> <span class="text-white absolute px-2 left-6">Annuler</span></button>
               </div>
               
               <div v-if="!editformReseaux" class="grid grid-cols-4 mt-3">
                  <span class="2xl:col-span-1 lg:col-span-2 col-span-4"><Twitter /> {{ (client.social_twitter == null ? '(Votre pseudo ici)' : client.social_twitter)}}</span>
                  <span class="2xl:col-span-1 lg:col-span-2 col-span-4"><Instagram /> {{ (client.social_insta == null ? '(Votre pseudo ici)' : client.social_insta)}}</span>
                  <span class="2xl:col-span-1 lg:col-span-2 col-span-4"><Facebook /> {{ (client.social_facebook == null ? '(Votre pseudo ici)' : client.social_facebook)}}</span>
                  <span class="2xl:col-span-1 lg:col-span-2 col-span-4"><Linkedin /> {{ (client.social_linkedin == null ? '(Votre pseudo ici)' : client.social_linkedin)}}</span>
                  <span class="col-span-4"><Web /> {{ (client.social_website == null ? '(Votre url ici)' : client.social_website)}}</span>
               </div>
               <form v-if="editformReseaux" @submit.prevent="submitResaux" class="grid grid-cols-4 mt-3">
                  <div class="lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="social_twitter" class="w-5/12"><Twitter /> (pseudo)</label>
                     <input type="text" id="social_twitter"
                  class="bg-transparent focus:ring-0 border-none w-7/12 text-primary-500"
                  name="social_twitter" autofocus  v-model="formReseaux.social_twitter"/>
                     <InputError class="mt-2" :message="formReseaux.errors.social_twitter" />
                  </div>
                  <div class="lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="social_insta" class="w-5/12"><Instagram /> (pseudo)</label>
                     <input type="text" id="social_insta"
                  class="bg-transparent focus:ring-0 border-none w-7/12 text-primary-500"
                  name="social_insta" autofocus  v-model="formReseaux.social_insta"/>
                     <InputError class="mt-2" :message="formReseaux.errors.social_insta" />
                  </div>
                  <div class="lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="social_facebook" class="w-5/12"><Facebook /> (pseudo)</label>
                     <input type="text" id="social_facebook"
                  class="bg-transparent focus:ring-0 border-none w-7/12 text-primary-500"
                  name="social_facebook" autofocus  v-model="formReseaux.social_facebook"/>
                     <InputError class="mt-2" :message="formReseaux.errors.social_facebook" />
                  </div>
                  <div class="lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="social_linkedin" class="w-5/12"><Linkedin /> (pseudo)</label>
                     <input type="text" id="social_linkedin"
                  class="bg-transparent focus:ring-0 border-none w-7/12 text-primary-500"
                  name="social_linkedin" autofocus  v-model="formReseaux.social_linkedin"/>
                     <InputError class="mt-2" :message="formReseaux.errors.social_linkedin" />
                  </div>
                  <div class="lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2">
                     <label for="social_website" class="w-5/12"><Web /> (Link)</label>
                     <input type="text" id="social_website"
                  class="bg-transparent focus:ring-0 border-none w-7/12 text-primary-500"
                  name="social_website" autofocus v-model="formReseaux.social_website"/>
                     <InputError class="mt-2" :message="formReseaux.errors.social_website" />
                  </div>

                  <div class="col-span-4 flex justify-center items-center">
                     <button :class="{ 'opacity-25': formReseaux.processing }" :disabled="formReseaux.processing" type="submit" class="rounded-2xl bg-primary-100 text-white px-4 py-2 m-2 hover:bg-primary-50 transition duration-300">Sauvegarder</button>
                  </div>
               </form>
            </div>
            <div class="m-4">
               <div class="flex flex-col">
                  <h2 class="font-semibold text-lg mr-4 mt-0.5"><Documents/> Documents</h2>
                  <div class="flex flex-col mt-4">
                     <div class="flex">
                        <h3>Nos Condition générale de vente : </h3>
                        <a href="/cgv" class="underline text-blue-500 ml-2 hover:text-blue-800 transition duration-300">ici</a>
                     </div>
                     <div class="flex">
                        <h3>Nos mentions légales : </h3>
                        <a href="/mentions-legales" class="underline text-blue-500 ml-2 hover:text-blue-800 transition duration-300">ici</a>
                     </div>
                     <div class="flex" v-if="user.token_client != undefined && user.token_client != ''">
                        <h3>Votre fichier de stock : </h3>
                        <a :href="'/stock/get_stock_csv?token='+user.token_client" class="underline text-blue-500 ml-2 hover:text-blue-800 transition duration-300">Téléchargez mon stock</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-span-1 m-2 relative h-full w-full pt-20 lg:block hidden">
            <form class="w-full flex items-center justify-center absolute top-0 z-30">
               <img class="h-32 w-32 rounded-full drop-shadow-xl"  :src="(user.img_profil != '' ? 'data:image;base64,' + user.img_profil : imgBase64)" alt="Image profil" />
               <input type="file" @change="submitProfil" accept=".jpg, .jpeg, .png" id="img_profil" class="hidden" name="img-profil" required @input="formProfil.profil = $event.target.files[0]"  />
               <label for="img_profil" class="flex items-center justify-center cursor-pointer h-7 w-7 absolute 2xl:right-28 xl:right-24 right-14 top-2 rounded-full bg-primary-50 hover:bg-primary-100 transition duration-300 "><Edit class="absolute bottom-0.5" /></label>
               <InputError class="mt-2" :message="formProfil.errors.profil" />
            </form>
            <div class="w-full flex items-center justify-center absolute top-0 z-20">
               <i class="block bg-white rounded-full h-36 w-36 "></i>
            </div>
            <div class=" bg-gray-50 drop-shadow-xl rounded-lg min-h-full pt-16 p-4 z-10">
               <h2 class="text-center font-bold text-lg">{{client.nom_societe}}</h2>
               <span class="text-center font-semibold text-sm block">N° TVA : {{client.tva_intra}}</span>

               <h3 class="text-center font-semibold text-lg mt-5">Contact : </h3>
               <div class="flex flex-col mx-2 mt-2 ">
                  <span>{{client.contact}}</span>
                  <span>{{client.adresse1}},</span>
                  <span>{{client.code_postal}}, {{client.ville}}</span>
                  <span>{{client.pays}}</span>
               </div>
               
            </div>
         </div>
      </div>
   </section>
</template>