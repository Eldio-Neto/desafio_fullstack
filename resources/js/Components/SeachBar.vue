<template>
   <div class="mt-0 max-w-639:block sm:mt-5 lg:flex" id="searchDiv">
      <input  id="search" v-model="searchTerm" class="p-2 border border-gray-300 lg:w-full md:w-full sm:w-full" placeholder="Digite sua pesquisa" />
      <button id="button" @click="search" class="p-2 bg-blue-500 text-white lg:w-auto md:w-full sm:w-full h-full">Pesquisar</button>
  </div>
</template>
    
<script>
import { Head, Link, router } from '@inertiajs/vue3';
  export default {
    data() {
      return {
        searchTerm: "",
      };
    },
    methods: {
      search() {
        router.get(route('search',this.searchTerm));      
      },
    },
  };
</script>

<style>
@media only screen and (min-width: 100px) and (max-width: 639px) {
 #button,
  #search{
  display: block !important;
  width: 100%;
  margin-top: 0.5rem;
 }
}
</style>