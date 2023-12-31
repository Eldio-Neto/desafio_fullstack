<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
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
    image: '',
    category: ''
});

defineProps({
    categories: Array
})


const validateDate = () => {
    let alert = document.getElementById('alertData');

    // Verifica se a data está preenchida
    if (!expires._value.trim()) {
        alert.innerHTML = "Por favor, preencha a data";
        return false;
    }

    const data_array = expires._value.split('-');
    form.expires = expires._value;

    var dia = parseInt(data_array[2], 10);
    var mes = parseInt(data_array[1], 10);
    var ano = parseInt(data_array[0], 10);

    // Verifica se a data é válida
    if (isNaN(dia) || isNaN(mes) || isNaN(ano) || dia <= 0 || mes <= 0 || ano <= 0) {
        alert.innerHTML = "Por favor, insira uma data válida";
        return false;
    }

    var hoje = new Date();
    hoje.setHours(0, 0, 0, 0); // Zera as horas, minutos, segundos e milissegundos

    var d2 = new Date(ano, mes - 1, dia); // Meses em JavaScript são de 0 a 11

    // Verifica se a data é anterior ao dia de hoje
    if (d2.getTime() < hoje.getTime()) {
        alert.innerHTML = "Data não pode ser anterior ao dia de hoje!";
        return false;
    }

    // Limpa o alerta se a data for válida
    alert.innerHTML = "";

    return true;
}

let file = '';

const getFile = (event) => {
    file = event.target.files[0];
    console.log(file)
}

function validateForm(form) {
    LimpaAlerts()

    // Validação do título
    if (!form.title.trim()) {
        let alert = document.getElementById('alertTitle');
        alert.innerHTML = 'Por favor, preencha o campo de título';
        return false;
    }

    // Validação da descrição
    if (!form.desc.trim()) {
        let alert = document.getElementById('alertDescription');
        alert.innerHTML = 'Por favor, preencha o campo de descrição';
        return false;
    }

    // Validação do preço
    const price = parseFloat(form.price);
    if (isNaN(price) || price <= 0) {
        let alert = document.getElementById('alertPrice');
        alert.innerHTML = 'Por favor, insira um preço válido maior que zero';
        return false;
    }

    // Validação da categoria
    if (!form.category) {
        let alert = document.getElementById('alertCategory');
        alert.innerHTML = 'Por favor, selecione uma categoria';
        return false;
    }

    return true; // Se todas as validações passarem
}


function LimpaAlerts() {
    let alertTitle = document.getElementById('alertTitle');
    let alertDescription = document.getElementById('alertDescription');
    let alertPrice = document.getElementById('alertPrice');
    let alertCategory = document.getElementById('alertCategory');
    alertData.innerHTML = '';
    alertDescription.innerHTML = '';
    alertPrice.innerHTML = '';
    alertCategory.innerHTML = '';
}

const submit = async () => {
    if (validateDate()) {
        if (validateForm(form)) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('title', form.title);
            formData.append('desc', form.desc);
            formData.append('price', form.price);
            formData.append('expires', expires._value);
            formData.append('category', form.category);

            try {
                router.post(route('newAdvertise'), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Garante que o Laravel reconheça a requisição como um formulário de várias partes
                    }
                })
            } catch (error) {
                console.error('Erro ao enviar o formulário:', error);
            }
        }
    } else {
        console.log('Erro de validação da data');
    }
};


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Adicione um novo Produto
            </h2>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div>
                            <InputLabel for="title" value="Titulo" />
                            <TextInput maxlength="50" id="title" v-model="form.title" type="text" class="mt-1 block w-full"
                                required autofocus />
                            <h1 id="alertTitle" class="text-red-500"></h1>
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="Description" value="Descrição" />
                            <textarea maxlength="50" col=33 class="w-full resize-none" v-model="form.desc" id="desc"
                                rows="10" cols="50"></textarea>
                            <h1 id="alertDescription" class="text-red-500"></h1>
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="date" value="Valido até" />
                            <input type="date" v-model="expires">
                            <h1 id="alertData" class="text-red-500"></h1>
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="date" value="Preço" />
                            <input type="number" min="0" v-model="form.price" step="0.01">
                            <h1 id="alertPrice" class="text-red-500"></h1>
                        </div>

                        <div class=" mt-4 ">
                            <InputLabel for=" file" value="Foto" />
                            <input @change="getFile" type="file" accept="image/png, image/jpeg">
                            <h1 id="alertPhoto" class="text-red-500"></h1>
                        </div>

                        <div class=" mt-4 ">
                            <InputLabel for=" file" value="Categoria" />
                            <select @change="alerta" v-model="form.category">
                                <option v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <h1 id="alertCategory" class="text-red-500"></h1>
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
