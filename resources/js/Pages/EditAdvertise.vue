<template>
    <AppLayout title="Menu">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Edite seu anuncio
            </h2>
        </template>
        <FormEditSave :singlepost="singlepost" :categories="categories"/>        
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormEditSave from '@/Components/FormEditSave.vue'

defineProps({
    singlepost: Object,
    canEdit:Boolean,
    'categories':Array
})

// alert(singlepost);
</script>