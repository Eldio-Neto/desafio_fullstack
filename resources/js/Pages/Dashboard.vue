<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CardAd from '@/Components/CardAd.vue'
import SearchBar from '@/Components/SeachBar.vue'
import pagination from '@/Components/Pagination.vue'

defineProps({
    MyPosts: Object
})

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="lg:flex sm:block lg:items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard - Meus Produtos
                </h2>
                <SearchBar />
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div v-for="post in MyPosts.data" :key="post.id">
                        <CardAd :title="post.title" :description="post.description" :date="post.expires_at" :url="post.slug"
                            :postId="post.id" :price="post.price" :category="post.category_name" />
                    </div>
                </div>
                <div class="mt-5 flex">
                    <pagination :links="MyPosts.links" :current_page="MyPosts.current_page" />
                </div>
            </div>
        </div>

    </AppLayout>
</template>
