<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { ref,watch } from 'vue';
import { router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

let item = ref(null)
defineProps({
    requisitions: Object
})
watch(item, value =>{
   router.get('/receptionist/requisition',
    {item: value},
    {
        preserveState: true,
        preserveScroll: true,
    }


    )

})


const form = useForm({
    title:"",
    description:"",
    quantity:"",
    unit_price:"",
    total_price:"",
    delivery_date:"",
    approved:"",
});

const showAddRoleOverlay = ref(null)
const submit = () => {
    form.post(route('receptionist.requisition.store'),{

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
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <div class="flex items-center justify-between" >
                        <button @click="showAddRoleOverlay = true"  class="my-auto inline-flex items-center justify-center p-0.5  overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                            <span class="p-2 my- transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                Create Requisition
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
                                <tr >
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Unit Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delivery Date
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        approved
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="requisition in requisitions.data" :key="requisition.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{requisition.title  }}
                                    </th>
                                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{requisition.quantity }}
                                    </th>

                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{requisition.unit_price }} 
                                    </th>

                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{requisition.delivery_date }} 
                                    </th>

                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                            <div v-if="requisition.approved  == 1" class="text-green-600 text-bold">
                                                Yes
                                            </div>
                                            <div v-else class="text-red-600 text-bold">
                                                No
                                            </div>
                                    </th>
                                   
                                    <td class="px-6 py-4">
                                        <template v-if="$page.props.user.userRoles.includes('Receptionist')">
                                            <Link as="button" :href="route('receptionist.requisition.show', requisition.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link>
                                            <Link as="button" :href="route('receptionist.requisition.destroy', requisition.id)" method="delete" class="font-medium text-red-600 mr-2 dark:text-red-500 hover:underline">Delete</Link>
                                        </template>
                                        <template v-if="$page.props.user.userRoles.includes('Procurement Officer')">
                                            <Link as="button" :href="route('procurement-officer.requisition.show', requisition.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        </template>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                  <!-- <Pagination :links="suppliers.links"/> -->
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
                                            <InputLabel for="email" value="Title" />

                                            <TextInput
                                                id="Email"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.title"

                                               
                                        
                                            />
                                            <InputError class="mt-2" :message="form.errors.title" />
                                        </div>
                                        <div>
                                            <InputLabel for="name" value="Description" />

                                            <textarea id="message"  v-model="form.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>

                                            <InputError class="mt-2" :message="form.errors.description" />
                                        </div>

                                        <div>
                                            <InputLabel for="email" value="Quantity" />

                                            <TextInput
                                                id="Email"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form.quantity"

                                               
                                        
                                            />
                                            <InputError class="mt-2" :message="form.errors.quantity" />
                                        </div>
                                        <div>
                                            <InputLabel for="phone" value="Price" />

                                            <TextInput
                                                id="Email"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form.unit_price"

    
                                               
                                            />

                                            <InputError class="mt-2" :message="form.errors.unit_price" />
                                        </div>
                                        
                                        <div>
                                            <InputLabel for="phone" value="Delivery Date" />

                                            <TextInput
                                                id="Email"
                                                type="date"
                                                class="mt-1 block w-full"
                                                v-model="form.delivery_date"

    
                                              
                                            />

                                            <InputError class="mt-2" :message="form.errors.delivery_date" />
                                        </div>
                                        
                                        <div class="flex items-center justify-end mt-4">

                                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Create Requisition
                                            </PrimaryButton>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </Modal>
</template>