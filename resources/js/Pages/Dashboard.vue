<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import CardAd from '@/Components/CardAd.vue'

defineProps({
    MyPosts: []
})

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard - Meus Produtos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div v-for="post in MyPosts" :key="post.id">
                        <CardAd :title="post.title" :description="post.description" :date="post.expires_at" :url="post.slug"
                            :postId="post.id" />
                    </div>
                </div>
            </div>
        </div>


    </AppLayout>
</template>
