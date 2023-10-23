

<template title="CardAdSingle">
    
    <div class="bg-white p-4 rounded-lg shadow-md box-border">
        <div class="flex justify-between mb-5">
            <h2 class="text-2xl font-bold mb-2">{{ title }}</h2> 
            <!-- Condição para mostrar botão de edição -->
            <div v-if="canEdit" class="flex items-center">
                <button @click="editAd" class="ml-5 bg-blue-500 text-white px-4 py-2 rounded-md">Edit Ad</button>
                <button @click="Delete" class="ml-5 bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
            </div>
        </div>
        <img :src="url" alt="" class="rounded-md w-full h-50 object-cover mb-4">
        <h3>Descição:</h3>
        <p class="text-gray-700 mb-4 whitespace-pre-line">{{ description }}</p>
        <p class="text-gray-500 mb-2">Valido Até {{ formatDate(date) }}</p> 
        <p class="text-gray-700 mb-4 whitespace-pre-line">Preço: {{price}}</p>   

    </div>

</template>

<script>
import { Head, Link, router } from '@inertiajs/vue3';

export default {
    props: {
        title: String,
        description: String,
        url: String,
        postId: Number,
        date: String,
        canEdit:Boolean,
        id:Number,
        price:String
    },
    methods: {
        
        formatDate(timestamp) {
            const date = new Date(timestamp);
            return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
        },
        editAd() {
            router.get(`/advertise/editAd/${this.id}`);
        },
        Delete() {
            router.delete(`/advertise/delete/${this.id}`);
        }
    },
};
</script>

