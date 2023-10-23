<template lang="">
    <div v-if="links.length > 3" class="flex">
        <div v-for="(link, index) in links">
            <Link v-if="link.url != null && shouldDisplayLink(index)" :href="link.url" >
                <div class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" 
                :class="{ 'bg-blue-700	': link.active }">
                    {{decodeEntities(link.label)}}
                </div>           
            </Link>
        </div>
    </div>
</template>



<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    links: Array   
});

const decodeEntities = (encodedString) => {
  const text = encodedString.replace(/&laquo;|&raquo;/g, '')
  return text;
};

const shouldDisplayLink = (index) => {
  // Exibe apenas os primeiros 5 links
  const startIndex = Math.max(0, props.links.length - 5);
  const endIndex = props.links.length -5;
  return index <= endIndex;
};

</script>
<style lang="">
    
</style>