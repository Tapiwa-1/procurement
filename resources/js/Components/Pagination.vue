<template>
    <nav aria-label="Page navigation ">
    <ul v-for="(link,key) in links" :key="key" class="inline-flex -space-x-px text-sm">
      <Link>
        <div v-if="link.url == null" v-html="link.label" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></div>
        <Link v-else :href="link.url" :class="{'bg-gray-700 text-white' : link.active}" v-html="link.label" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></Link>
      </Link>
  
    </ul>
  </nav>
  </template>
  
  <script setup>
     import { Link } from '@inertiajs/vue3';
  
      defineProps({
          links:[]
      })
  </script>
  
  <style>
  
  </style>