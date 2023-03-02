<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import {useForm, Head, Link} from '@inertiajs/inertia-vue3';
const imageUrl = new URL('../../../images/Logo/Nazar Logo.svg', import.meta.url).href;


defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<script>
import pinterest from "icons/Pinterest.vue";
import instagram from "icons/Instagram.vue";
import facebook from "icons/Facebook.vue";
import linkedin from "icons/Linkedin.vue";
</script>

<template>
    <Head :title="$t('login.title')" />
    <GuestLayout :TextTitre="$t('login.text-titre')" :SousTitre="$t('login.text-sous-titre')" :TextBouttonTitre="$t('login.text-btn-titre')" :hrefBtnTitre="'register'"> 
        <form @submit.prevent="submit" class="sm:w-2/3 w-11/12 px-4 py-5 lg:px-0 mx-auto bg-primary-50 rounded">
            <h1 class="grid justify-center">
                <img alt="Logo Nazar" :src="imageUrl" width="300" height="300" class="sm:w-[300px] sm:h-[300px] w-[200px] h-[200px]" />
            </h1>
            <div class="pb-2 pt-4">
                <input type="text" name="email" id="email" :placeholder="$t('login.labelIdentifiant')"
                    class="block w-full sm:p-4 p-2 text-lg rounded-sm bg-primary-100" v-model="form.email" required autofocus
                    autocomplete="username">
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="pb-2 pt-4">
                <input class="block w-full sm:p-4 p-2 text-lg rounded-sm bg-primary-100" v-model="form.password" type="password" name="password" id="password" :placeholder="$t('login.labelMotDePasse')">
                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <!-- <div class="text-right text-gray-400 hover:underline hover:text-gray-100">
                        <a href="#">Forgot your password?</a>
                    </div> -->
                
            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">{{$t('login.seSouvenirDeMoi')}}</span>
                </label>
            </div>
            <div class="px-4 pb-2 pt-4">
                <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class=" block w-full p-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-400 focus:outline-none">{{$t('login.btnConnexion')}}</button>
            </div>

            <div class=" px-4 text-center flex flex-col justify-center lg:hidden text-[28px]">
                <div class="w-full py-4">
                    <div class="w-full flex items-center ">
                        <hr class="w-full"/><span class="px-2 text-xl">{{$t('Or')}}</span><hr class="w-full"/>
                    </div>
                </div>
                <div class="w-full">
                    <Link :href="route('register')" class="block w-full text-center px-5 py-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-400 focus:outline-none">{{$t('login.btnMobileOr')}}</Link>
                </div>
                <div class="w-full pt-2">
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
