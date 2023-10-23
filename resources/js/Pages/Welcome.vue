<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import CardAd from '@/Components/CardAd.vue';
import pagination from '@/Components/Pagination.vue'

defineProps({
    posts: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});


</script>

<template >
     <Head title="Home" />
    <div>
        <Banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>
                                <template v-else>
                                    <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>
                                    <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
                                </template>
                            </div>
                        </div>                 
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
             
            </nav>
            <header  class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                   Anuncios 
                </div>
            </header>            
            <main>                
                <div class="py-12">
                    <div v-if="posts.data.length > 0" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <div v-for="post in posts.data" :key="post.id">
                                <CardAd :title="post.title" :description="post.description" :date="post.expires_at" :url="post.slug"
                                :postId="post.id" :price="post.price" />
                            </div>
                        </div>
                        <div class="mt-5 flex">

                            <pagination :links="posts.links" />
                        </div>
                    </div>
                    <div v-else class="flex justify-center items-center">
                        <h1 class="text-xl">Ainda não temos Anuncios</h1>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
