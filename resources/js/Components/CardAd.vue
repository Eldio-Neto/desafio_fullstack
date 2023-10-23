<template title="CardAd">
    <div @click="GoToSinglePost"
        class="cursor-pointer max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow ">
        <img :src="`${url}`" alt="" class="rounded-md w-full h-40 object-cover mb-4">
        <a>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">
                {{ title }}
            </h5>
        </a>
        <p class="mb-3 overflow-hidden text-ellipsis font-normal text-gray-700 ">
            {{ description }}
        </p>
        Valido até:
        <p class="mb-3 font-normal text-gray-700 ">
            {{ formatDate(date) }}
        </p>
        Preço
        <p class="mb-3 font-normal text-gray-700 ">
            {{price }}
        </p>
    </div>
</template>

<style scoped>
.text-ellipsis {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

<script>

import { Head, Link, router } from '@inertiajs/vue3';

export default {
    props: {
        title: String,
        description: String,
        url: String,
        postId: Number,
        date: String,
        price: String,
    },
    methods: {
        GoToSinglePost() {

            router.get(`/singleAd/${this.postId}`);
        },
        formatDate(timestamp) {
            const date = new Date(timestamp);
            return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
        },
    },
};
</script>
