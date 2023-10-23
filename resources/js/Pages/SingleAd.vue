<template>
    <AppLayout title="Menu">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Anuncio
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 break-words">
                <div class="">
                    <singleAd :canEdit="canEdit" :id="singlepost.id" :url="singlepost.slug" :date="singlepost.expires_at"
                        :title="singlepost.title" :postId="singlepost.id" :price="singlepost.price"
                        :description="singlepost.description" :category="singlepost.category_name" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import singleAd from '@/Components/SingleAdCard.vue'

defineProps({
    singlepost: Object,
    canEdit: Boolean
})

// alert(singlepost);
</script>
