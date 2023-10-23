

<template title="FormEdit">
    <div class="">
             <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <img :src="props.singlepost.slug" alt="">
                        <div>
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                                autofocus />
                                <h1 id="alertTitle" class="text-red-500"></h1>
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="Description" value="Description" />
                            <textarea col=33 class="w-full resize-none" v-model="form.desc" placeholder="add multiple lines"
                                id="desc" rows="10" cols="50"></textarea>
                            <h1 id="alertDescription" class="text-red-500"></h1>
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="date" value="Expires at" />
                            <input type="date" v-model="expires">
                            <h1 id="alertData" class="text-red-500"></h1>
                        </div>

                        <div class="mt-4 ">
                            <InputLabel for="date" value="Price" />
                            <input type="number" min="0" v-model="form.price" step="0.01">
                            <h1 id="alertPrice" class="text-red-500"></h1>
                        </div>

                        <div class=" mt-4 ">
                            <InputLabel for=" file" value="Photo" />
                            <input @change="getFile" type="file" accept="image/png, image/jpeg">
                            <h1 id="alertPhoto" class="text-red-500"></h1>
                        </div>

                        <div class=" mt-4 ">
                            <InputLabel for=" file" value="Categories" />
                            <select @change="alerta" v-model="form.category">
                                <option  v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <h1 id="alertCategory" class="text-red-500"></h1>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="w-full py-4 text-center" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                               Atualizar Anuncio
                            </PrimaryButton>
                        </div>
                    </form>
                  </div>
             </div>
         </div>
 </template>


<script setup>

import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

const date = '';
const expires = ref(date);

let file

const getFile = (event) => {
    file = event.target.files[0];
    console.log(file)
}

const props = defineProps({
    singlepost:Object,
    categories:Array
});

const form = useForm({
    title:props.singlepost.title,
    desc:props.singlepost.description, 
    price:props.singlepost.price,
    expires:props.singlepost.expires_at
});


// const validateDate = () => {

// const data_array = expires._value.split('-');

// form.expires = expires._value;
// var dia = +data_array[2];
// var mes = +data_array[1];
// var ano = +data_array[0];


// var hoje = new Date();
// var d1 = hoje.getDate();
// var m1 = hoje.getMonth() + 1;
// var a1 = hoje.getFullYear();

// var d1 = new Date(a1, m1, d1);
// var d2 = new Date(ano, mes, dia);

// var diff = d2.getTime() - d1.getTime();

// diff = diff / (1000 * 60 * 60 * 24);


//     if(isNaN(diff)){
//         alert("Valide a Data de validade informada!");  
//         return false;
//     }
//     if (diff < 0) {
//         alert("Valide a Data de validade informada!");
//         console.log(false);
//         return false;
//     } else {
//         console.log(true);
//         return true;
//     }


// }
function LimpaAlerts(){
    let alertTitle = document.getElementById('alertTitle');
    let alertDescription = document.getElementById('alertDescription');
    let alertPrice = document.getElementById('alertPrice');
    let alertCategory = document.getElementById('alertCategory');
    alertData.innerHTML='';
    alertDescription.innerHTML='';
    alertPrice.innerHTML='';
    alertCategory.innerHTML='';
}

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


const submit = async () => {
    if (validateDate()) {
        if(validateForm(form)){
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
        }else {
                console.log('Erro de validação da data');
            }
};



// const submit = async () => {
//     if(expires._value.trim() == null || expires._value.trim() == undefined ){
//         alert('aaaaa')
//     }

//     console.log(expires._value );
//     if (validateDate()) {
//         const formData = new FormData();
//         formData.append('image', file);
//         formData.append('title', form.title);
//         formData.append('description', form.desc);
//         formData.append('price', form.price);
//         formData.append('expires_at', expires._value);
//         console.log(formData);
//         try {
//             router.post(`/advertise/editAd/${props.singlepost.id}`, formData, {
//                 headers: {
//                     'Content-Type': 'multipart/form-data', // Garante que o Laravel reconheça a requisição como um formulário de várias partes
//                 }
//             })
//         } catch (error) {
//             console.error('Erro ao enviar o formulário:', error);
//         }
//     } else {
//         console.log('Erro de validação da data');
//     }
// };
</script>

