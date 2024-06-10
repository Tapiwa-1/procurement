<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import { createInertiaApp, Head, Link , useForm, router   } from '@inertiajs/vue3';
import { nextTick, ref,watch } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Pagination from '@/Components/Pagination.vue'


let item = ref(null)
const showAddRoleOverlay = ref(null)
defineProps({
    roles: Object
})

watch(item, value =>{
   router.get('/admin/roles',
    {item: value},
    {
        preserveState: true,
        preserveScroll: true,
    }


    )

})


const form = useForm({
    name: '',
});

const submit = () => {
    form.post(route('admin.roles.store'),{

        preserveScroll: true,
        onSuccess: () => closeModal(),

        onFinish: () => form.reset(),
    });

};

const closeModal = () => {
    showAddRoleOverlay.value = false;

    form.reset();
};
</script>

<template>
 
    <section>
    <AuthenticatedLayout>
       
        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <div class="flex items-center justify-between" >
                        <button @click="showAddRoleOverlay = true"  class="my-auto inline-flex items-center justify-center p-0.5  overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                            <span class="p-2 my- transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                Add Roles
                            </span>
                        </button>
                        <div class="relative  " >

                            <input type="text" v-model="item" id="table-search" class="block  text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>
                    </div>


                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="role in roles.data" :key="role.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{role.name  }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <Link :href="route('admin.roles.edit',role.id)" class="font-medium mr-1 text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                        <Link method="delete" as="button" ae :href="route('admin.roles.destroy', role.id)"  class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                  <Pagination :links="roles.links"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
      <Modal :show="showAddRoleOverlay" @close="closeModal">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                         <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                        {{ status }}
                                    </div>

                                    <form class="m-1" @submit.prevent="submit">
                                        <div>
                                            <InputLabel for="name" value="name" />

                                            <TextInput
                                                id="name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.name"

                                                autofocus
                                                autocomplete="name"
                                            />

                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                        <div class="flex items-center justify-end mt-4">

                                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Add Role
                                            </PrimaryButton>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </Modal>

    </section>

</template>