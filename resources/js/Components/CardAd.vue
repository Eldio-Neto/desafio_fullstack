<template title="CardAd">
    <div @click="GoToSinglePost"
        class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <img :src="`${url}`" alt="" class="rounded-md w-full h-40 object-cover mb-4">
        <a>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ title }}
            </h5>
        </a>
        <p class="mb-3 overflow-hidden text-ellipsis font-normal text-gray-700 dark:text-gray-400">
            {{ description }}
        </p>
        Valido até:
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            {{ formatDate(date) }}
        </p>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            {{postId }}
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
