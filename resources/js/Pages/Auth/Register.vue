<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { wTrans } from 'laravel-vue-i18n';
import { ref } from 'vue';
import { useForm, usePage, Link, Head } from '@inertiajs/inertia-vue3';
const imageUrl = new URL('../../../images/Logo/Nazar Logo.svg', import.meta.url).href;


const form = useForm({
    nom: '',
    prenom: '',
    email: '',
    email_confirmation: '',
    tel: '',
    nom_societe: '',
    numTVA: '',
    adresse: '',
    cp: '',
    ville: '',
    pays: '',
    nameFileKbis: '',
    nameFileIdentiter: ''
});

const props = usePage().props.value;

var acceptPolitique = ref(false);

const submit = () => {
    form.post(route('register'), {
        onSuccess: (e) => {
            props.sendMessage = true;
            props.messageValidation= wTrans('register.messageValidation');
        },
        onError: (e) => {
            if(form.errors.length){
                props.sendMessage = false;
                props.messageValidation= wTrans('register.messageValidationError');
            }
        },
    });
};

var submitKbis = (e) => {
    e.preventDefault();
    let existingObj = e.target;
    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
    }
    let data = new FormData();
    data.append('fileKbis', existingObj.files[0]);
    axios.post('/uploadKbis', data, config).then(function (res) {
        form.nameFileKbis = res.data.fileName;
        document.getElementById('labelKbis').classList.add('hidden');
        document.getElementById('uploadErrorKbis').classList.add('hidden');
        document.getElementById('uploadKbis').classList.remove('hidden');
    }).catch(function (err) {
        document.getElementById('uploadErrorKbis').textContent = err.response.data.message;
        document.getElementById('uploadErrorKbis').classList.remove('hidden');
        existingObj.value = '';
    });
};

var submitIdentiter = (e) => {
    e.preventDefault();
    let existingObj = e.target;
    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
    }
    let data = new FormData();
    data.append('fileIdentiter', existingObj.files[0]);
    axios.post('/uploadIdentiter', data, config).then(function (res) {
        form.nameFileIdentiter = res.data.fileName;
        document.getElementById('labelIdentiter').classList.add('hidden');
        document.getElementById('uploadErrorIdentiter').classList.add('hidden');
        document.getElementById('uploadIdentiter').classList.remove('hidden');
    }).catch(function (err) {
        document.getElementById('uploadErrorIdentiter').textContent = err.response.data.message;
        document.getElementById('uploadErrorIdentiter').classList.remove('hidden');
        existingObj.value = '';
    });
};

var verifCheck = (e) => {
    if(e.target.checked){
        acceptPolitique.value = true;
    }else{
        acceptPolitique.value = false;
    }
};
</script>

<script >
import user from "icons/Account.vue";
import domain from "icons/Domain.vue";
import pinterest from "icons/Pinterest.vue";
import instagram from "icons/Instagram.vue";
import facebook from "icons/Facebook.vue";
import linkedin from "icons/Linkedin.vue";
</script>

<template>
    <Head :title="$t('register.title')" />
    <GuestLayout :TextTitre="$t('register.text-titre')" :SousTitre="$t('register.text-sous-titre')" :TextBouttonTitre="$t('register.text-btn-titre')" :hrefBtnTitre="'login'">
        
        <form class="xl:w-2/3 lg:w-full sm:w-2/3 px-4 lg:px-0 mx-auto bg-primary-50 rounded" @submit.prevent="submit">
            <h1 class="grid justify-center">
                <img alt="Logo Nazar" :src="imageUrl" width="150" height="150" />
            </h1>
            <div v-if="typeof props.sendMessage === 'undefined'" class="grid grid-cols-1">
                <div class="p-3 rounded-lg shadow text-left text-black grid grid-cols-1" >
                    <h2 class="text-3xl"><user /> {{$t('register.labelDiv1')}}</h2>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="nom" class="w-auto">{{$t('register.labelNom')}} :</label>
                        <input class="block w-full p-1 text-lg rounded-sm bg-primary-100" v-model="form.nom" type="text" name="nom" id="nom" required autofocus autocomplete="family-name">
                        <InputError class="mt-2" :message="form.errors.nom" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="prenom">{{$t('register.labelPrenom')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.prenom" type="text" name="prenom" id="prenom" required autofocus autocomplete="given-name">
                        <InputError class="mt-2" :message="form.errors.prenom" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="email">{{$t('register.labelEmail')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.email" type="email" name="email" id="email" required autofocus autocomplete="email">
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="email_confirmation">{{$t('register.labelEmailConfirm')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.email_confirmation" type="email" name="email_confirmation" id="email_confirmation" required autofocus autocomplete="email" >
                        <InputError class="mt-2" :message="form.errors.email_confirmation" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="tel">{{$t('register.labelTel')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.tel" type="tel" name="tel" id="tel" required autofocus autocomplete="tel">
                        <InputError class="mt-2" :message="form.errors.tel" />
                    </div>
                    <form enctype="multipart/form-data" class="grid grid-cols-2 items-center p-1">
                        <label for="fileIdentiter">Pièce identiter du dirigeant :</label>
                        <label id="labelIdentiter" class="cursor-pointer text-center p-1 text-lg text-gray-200 rounded-sm bg-primary-100" for="fileIdentiter">Importer ma pièce</label>
                        <span id="uploadIdentiter" class="hidden text-green-700">Importer avec succées</span>
                        <span id="uploadErrorIdentiter" class="hidden text-red-600"></span>
                        <input accept=".jpg,.jpeg,.png,.pdf" @change="submitIdentiter" class="hidden " type="file" name="fileIdentiter" id="fileIdentiter" required>
                        <InputError class="mt-2" :message="form.errors.nameFileIdentiter" />
                    </form>
                </div>
                <div class="p-3 rounded-lg shadow text-left text-black grid grid-cols-1" >
                    <h2 class="text-3xl"><domain /> {{$t('register.labelDiv2')}}</h2>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="nom_societe" class="w-auto">{{$t('register.labelNomSociete')}} :</label>
                        <input class="block w-full p-1 text-lg rounded-sm bg-primary-100" v-model="form.nom_societe" type="text" name="nom_societe" id="nom_societe" required autofocus autocomplete="organization">
                        <InputError class="mt-2" :message="form.errors.nom_societe" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="numTVA">{{$t('register.labelNumTVA')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.numTVA" type="text" name="numTVA" id="numTVA" required autofocus>
                        <InputError class="mt-2" :message="form.errors.numTVA" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="adresse">{{$t('register.labelAdresse')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.adresse" type="text" name="adresse" id="adresse" required autofocus autocomplete="street-address">
                        <InputError class="mt-2" :message="form.errors.adresse" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="cp">{{$t('register.labelCP')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.cp" type="text" name="cp" id="cp" required autofocus autocomplete="postal-code">
                        <InputError class="mt-2" :message="form.errors.cp" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="ville">{{$t('register.labelVille')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.ville" type="text" name="ville" id="ville" required autofocus autocomplete="city">
                        <InputError class="mt-2" :message="form.errors.ville" />
                    </div>
                    <div class="grid grid-cols-2 items-center p-1">
                        <label for="pays">{{$t('register.labelPays')}} :</label>
                        <input class="block p-1 text-lg rounded-sm bg-primary-100" v-model="form.pays" type="text" name="pays" id="pays" required autofocus autocomplete="country-name">
                        <InputError class="mt-2" :message="form.errors.pays" />
                    </div>
                    <form @submit="formSubmit" enctype="multipart/form-data" class="grid grid-cols-2 items-center p-1">
                        <label for="fileKbis">Kbis entreprise -3 mois :</label>
                        <label id="labelKbis" class="cursor-pointer text-center p-1 text-lg text-gray-200 rounded-sm bg-primary-100" for="fileKbis">Importer mon Kbis</label>
                        <span id="uploadKbis" class="hidden text-green-700">Importer avec succées</span>
                        <span id="uploadErrorKbis" class="hidden text-red-600"></span>
                        <input accept=".jpg,.jpeg,.png,.pdf" @change="submitKbis" class="hidden " type="file" name="fileKbis" id="fileKbis" required>
                        <InputError class="mt-2" :message="form.errors.fileKbis" />
                    </form>
                </div>
                <div class="flex items-center my-2 mx-1 ">
                    <input @click="verifCheck" id="checkPolitique" type="checkbox" value="1" class="w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200  focus:ring-2 bg-primary-100">
                    <label for="checkPolitique" class="ml-2 text-lg font-medium text-gray-900 ">J'accepte la <a href="/politique-confidentialite" class="text-gray-400 underline hover:text-[1.15rem] cursor-pointer transition-all duration-300">politique de confidentialité</a></label>
                </div>
                <div class="px-4 pb-2 pt-4" v-if="acceptPolitique">
                    <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class=" block w-full p-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-400 focus:outline-none">{{$t('register.btnInscription')}}</button>
                </div>
                <div class="px-4 pb-2 pt-4" v-else>
                    <button type="button" class="cursor-not-allowed block w-full p-2 text-lg rounded-full  bg-primary-200 focus:outline-none">{{$t('register.btnInscription')}}</button>
                </div>
            </div>
            <div v-if="(typeof props.sendMessage !== 'undefined')" class="p-2 rounded-lg shadow grid grid-cols-1">
                <div v-if="props.sendMessage" class="whitespace-pre-line">
                    <h2 class="text-[30px]">{{$t('register.titleValidation')}}</h2>
                    <span>{{props.messageValidation}}</span>
                </div>
                <div v-else>
                    <h2>{{$t('register.titleValidationError')}}</h2>
                    <span>{{props.messageValidation}}</span>
                </div>
            </div>
            <div class=" px-4 text-center flex flex-col justify-center lg:hidden text-[28px]">
                <div class="w-full py-4">
                    <div class="w-full flex items-center ">
                        <hr class="w-full"/><span class="px-2 text-xl">{{$t("Or")}}</span><hr class="w-full"/>
                    </div>
                </div>
                <div class="w-full">
                    <Link :href="route('login')" class="block w-full text-center px-5 py-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-400 focus:outline-none">Je me connecte</Link>
                </div>
                <div class="w-full py-3">
                    <a href="https://www.pinterest.fr/nazarrugsfrance/" class="px-2" rel="noopener" target="_blank" aria-label="Pinterest">
                    <pinterest />
                    </a>
                    <a href="https://www.instagram.com/nazar_rugs/" class="px-2" rel="noopener" target="_blank" aria-label="Instagram">
                        <instagram />
                    </a>
                    <a href="https://www.facebook.com/Nazarrugs-102036118298025" class="px-2" rel="noopener" target="_blank" aria-label="Facebook">
                        <facebook />
                    </a>
                    <a href="https://fr.linkedin.com/company/nazar-rugs" class="px-2" rel="noopener" target="_blank" aria-label="Linkedin">
                        <linkedin />
                    </a>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
