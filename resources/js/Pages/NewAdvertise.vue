<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

const date = '';
const expires = ref(date);

const form = useForm({
    title: '',
    desc: '',
    price: 0,
    expires: '',
    image: ''
});

const validateDate = () => {

    const data_array = expires._value.split('-');
    form.expires = expires._value;
    var dia = data_array[2];
    var mes = data_array[1];
    var ano = data_array[0];

    if (data_array[0].length != 4) {
        dia = data_array[0];
        mes = data_array[1];
        ano = data_array[2];
    }

    var hoje = new Date();
    var d1 = hoje.getDate();
    var m1 = hoje.getMonth() + 1;
    var a1 = hoje.getFullYear();

    var d1 = new Date(a1, m1, d1);
    var d2 = new Date(ano, mes, dia);

    var diff = d2.getTime() - d1.getTime();
    diff = diff / (1000 * 60 * 60 * 24);


    if (diff < 0) {
        console.log("Data não pode ser anterior ao dia de hoje!");
        console.log(false);
        return false;
    } else {
        console.log(true);
        return true;
    }


}

let file = '';

// const submit = () => {
//     if (validateDate()) {
//         form.transform(data => ({
//             ...data,
//             expires: expires._value,
//         })).post(route('newAdvertise'), {
//             onFinish: () => {
//                 form.reset('title');
//                 form.reset('desc');
//                 expires.value = ''; // Limpa o campo de data após o envio do formulário
//             }
//         });
//     } else {
//         // Faça algo se a validação falhar (por exemplo, exibir uma mensagem de erro)
//         console.log('Erro de validação da data');
//     }
// };

const getFile = (event) => {
    file = event.target.files[0];
    console.log(file)
}

const submit = async () => {
    if (validateDate()) {

        const formData = new FormData();
        formData.append('image', file);
        formData.append('title', form.title);
        formData.append('desc', form.desc);
        formData.append('price', form.price);
        formData.append('expires', expires._value);


        try {

            router.post(route('newAdvertise'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data', // Garante que o Laravel reconheça a requisição como um formulário de várias partes
                }
            })


        } catch (error) {
            console.error('Erro ao enviar o formulário:', error);
        }
    } else {
        console.log('Erro de validação da data');
    }
};
</script>


<script>
export default {
    name: 'App',
    methods: {
        async sendFile() {

            let dataForm = new FormData();
            for (let file of this.$refs.files.files) {
                dataForm.append(`file`, file);
            }

            let res = await form.post(route('newAdvertise'), dataForm, {
                headers: {
                    'Content-Type': 'multipart/form-data', // Garante que o Laravel reconheça a requisição como um formulário de várias partes
                },
                // onFinish: () => {
                //     form.reset('title');
                //     form.reset('desc');
                //     expires.value = '';
                //     fileInput.value = ''; // Limpa o campo de arquivo após o envio do formulário
                // },
            });
            alert(res)
            let data = await res.json();
            console.log(data);
        },
    },
};
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Adicione um novo Produto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div>
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                                autofocus autocomplete="username" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="Description" value="Description" />
                            <textarea col=33 class="w-full resize-none" v-model="form.desc" placeholder="add multiple lines"
                                id="desc" rows="10" cols="50"></textarea>
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="date" value="Expires at" />
                            <input type="date" v-model="expires">
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="date" value="Price" />
                            <input type="number" min="0" v-model="form.price">
                        </div>

                        <div class=" mt-4 ">
                            <InputLabel for=" file" value="Photo" />
                            <input @change="getFile" type="file" accept="image/png, image/jpeg">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="w-full py-4 text-center" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Criar Novo Anuncio
                            </PrimaryButton>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
