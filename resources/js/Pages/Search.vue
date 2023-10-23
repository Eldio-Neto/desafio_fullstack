<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CardAd from '@/Components/CardAd.vue'
import SearchBar from '@/Components/SeachBar.vue'
import pagination from '@/Components/Pagination.vue'

defineProps({
    posts: [],
    term:String
})

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                   Você pesquisou por: {{ term }}
                </h2>
                <SearchBar/>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div v-for="post in posts.data" :key="post.id">
                        <CardAd :title="post.title" :description="post.description" :date="post.expires_at" :url="post.slug"
                            :postId="post.id" />
                    </div>
                </div>
                <div class="mt-5 flex">
                    <pagination :links="posts.links" :current_page="posts.current_page"/>
                </div>
            </div>
        </div>


    </AppLayout>
</template>
