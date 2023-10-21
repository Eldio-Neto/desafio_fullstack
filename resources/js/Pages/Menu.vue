<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Card from '@/Components/Card.vue';

const menus = [
    { title: "Adicionar novos Produtos", description: "Adicione produtos quantas vezes quiser e no tempo que quiser!" },
    { title: "Editar Produtos", description: "Edite produtos quantas vezes quiser e no tempo que quiser!" },
    { title: "Editar Produtos", description: "Edite produtos quantas vezes quiser e no tempo que quiser!" },
]

</script>

<template>
    <AppLayout title="Menu">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menu Principal
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex items-center justify-center space-x-4 p-2">
                    <div v-for="menu in menus">
                        <Card :title="menu.title" :description="menu.description" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
