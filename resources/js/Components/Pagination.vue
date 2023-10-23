
<template lang="">
    <div v-if="links.length > 3" class="flex">
      <div v-for="(link, index) in visibleLinks" :key="index">
        <Link v-if="link.url != null" :href="link.url">
          <div class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
            :class="{ 'bg-blue-700': link.active }">
            {{ decodeEntities(link.label) }}
          </div>
        </Link>
      </div>
    </div>
  </template>

<script setup>
import { ref, computed, defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['links', 'current_page']);

const visibleLinks = ref([]);

const computeVisibleLinks = computed(() => {
    const totalLinks = props.links.length;
    const startIndex = Math.max(0, totalLinks - 5); // Inicia do último grupo de 5
    const endIndex = Math.min(totalLinks - 1, startIndex + 4); // Limita ao último índice disponível
    return props.links.slice(startIndex, endIndex + 1);
});


visibleLinks.value = computeVisibleLinks.value;

const decodeEntities = (encodedString) => {
    const textArea = document.createElement('textarea');
    textArea.innerHTML = encodedString;
    return textArea.value.replace(/&laquo;|&raquo;/g, '');
};
</script>

<style lang="">

</style>
