<template>
    <nav class="min-w-[200px]">
        <Link href="/" class="h-[80px] px-3 flex items-center gap-3">
            <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800"/>
            Procurement
        </Link>  
        <div class="px-3">
            <!-- <CreateNewDropdown/> -->
            <div class="py-3">
                <NavLink :href="route('dashboard')" :active="true">Home</NavLink>
                
            </div>
        </div>
    </nav>
</template>
<script setup>
import ApplicationLogo from '../ApplicationLogo.vue';
import CreateNewDropdown from '@/Components/app/CreateNewDropdown.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
</script>