<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { ref,watch } from 'vue';
import { router } from '@inertiajs/vue3';

let item = ref(null)
defineProps({
    users: Object
})
watch(item, value =>{
   router.get('/admin/users',
    {item: value},
    {
        preserveState: true,
        preserveScroll: true,
    }


    )

})
</script>

<template>
  

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <div class="flex items-center justify-between" >

                        <div class="relative  " >

                            <input type="text" v-model="item" id="table-search" class="block  text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>
                    </div>
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr >
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Roles
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.email" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{user.name  }}
                                    </th>
                                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{user.email  }}
                                    </th>
                                    <template v-for="role in user.roles" :key="role">

                                        <div scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{role.name }}
                                        </div>
                                    </template>
                                    <td class="px-6 py-4">
                                        <Link :href="route('admin.users.show', user.id)" class="font-medium text-blue-600 mr-2 dark:text-blue-500 hover:underline">Roles</Link>
                                        <!-- <a href="" class="font-medium text-blue-600 mr-2 dark:text-blue-500 hover:underline">Permission</a> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                  <Pagination :links="users.links"/>
            </div>

            </div>

        </div>

    </AuthenticatedLayout>
</template>