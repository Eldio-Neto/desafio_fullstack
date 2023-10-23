<script setup>

import { Head, Link, router } from '@inertiajs/vue3';

const GoToAdd = () => {
    router.get('newAdvertise');
}

defineProps({
    title: String,
    description: String
});

</script>

<template title="Card">
    <div :title="title" :description="description" @click="GoToAdd"
        class="p-6 bg-white border border-gray-200 rounded-lg shadow ">
        <a>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">
                {{ title }}
            </h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 ">
            {{ description }}
        </p>
    </div>
</template>
