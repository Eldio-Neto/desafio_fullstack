<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('newAdvertise'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Adicione um novo Produto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                </div>
            </div>
        </div>
    </AppLayout>
</template>
