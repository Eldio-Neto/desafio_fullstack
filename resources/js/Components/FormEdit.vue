
<template title="FormEdit">
   <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div>
                            <img :src="url" alt="">
                        </div>
                        <div>
                            <InputLabel for="title" value="Title" />
                            <!-- <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                                autofocus /> -->
                            <TextInput id="title" v-model="data.title" type="text" class="mt-1 block w-full" required autofocus />

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
                                Atualizar Anuncio
                            </PrimaryButton>
                        </div>
                    </form>

                </div>
            </div>
        </div>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

</script>

<script>
const date = '';
const expires = ref(date);
let file = '';
export default {
//   props: {
//     title: String,
//     description: String,
//     price: String,
//     expires_at: Date,
//     url: String,
//   },
//   setup(props) {
//     console.log(props);
//     const { data, setData, post } = useForm({
//       title: props.title || '',
//       desc: props.description || '',
//       price: props.price || '',
//       expires: props.expires_at || '',
//       image: '',
//     });
props: {
    title: String,
    description: String,
    price: String,
    expires_at: String,
  },
  setup(props) {
    // Usando a função useForm do Inertia
    const { data, setData, post } = useForm({
      title: props.title || '',
      desc: props.description || '',
      price: props.price || '',
      expires: props.expires_at || '',
      image: '',
    });

    return {
      data,
      setData,
      post,
    };
  },
};



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
