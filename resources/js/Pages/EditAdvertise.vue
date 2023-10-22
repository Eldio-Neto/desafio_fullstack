<template>
    <AppLayout title="Menu">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Edite seu anuncio
            </h2>
        </template>
        <teste :singlepost="singlepost" />        
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import singleAd from '@/Components/SingleAdCard.vue'
import teste from '@/Components/teste.vue'

defineProps({
    singlepost: Object,
    canEdit:Boolean
})

// alert(singlepost);
</script>