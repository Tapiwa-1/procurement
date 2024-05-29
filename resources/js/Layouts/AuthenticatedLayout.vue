
<template>
    <div class="h-screen bg-gray-50 flex w-full gap-4">
        <Navigation/>
        <main class="flex flex-col flex-1 px-4 ">
            <div class=" flex items-center justify-between w-full">
                <SearchForm/>
                <UserSettingsDropdown/>
            </div>
            <div class="flex-1 flex flex-col" style="max-height: calc(100vh - 48px); overflow-y: auto;">
                <slot/>

            </div>
        </main>
    </div>
    <!-- make slot scrollable only -->
</template>
<script setup>

import Navigation from '@/Components/app/Navigation.vue'
import SearchForm from '@/Components/app/SearchForm.vue';
import UserSettingsDropdown from '@/Components/app/UserSettingsDropdown.vue'


</script>
