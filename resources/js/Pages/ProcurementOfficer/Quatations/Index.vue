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
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

let item = ref(null)
defineProps({
    quatations: Object,
    suppliers: Object
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
   
});

const showAddRoleOverlay = ref(null)
const submit = () => {
    form.post(route('procurement-officer.quatations.store'),{

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
   

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <div v-if="$page.props.user.userRoles.includes('Procurement Officer')"  class="flex items-center justify-between" >
                       
                        <div class="relative  " >

                            <input type="text" v-model="item" id="table-search" class="block  text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>
                    </div>
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr >
                                    <th v-if="$page.props.user.userRoles.includes('Procurement Officer')" scope="col" class="px-6 py-3">
                                        Supplier Name
                                    </th>
                                    <th v-if="$page.props.user.userRoles.includes('Assistant Group Accountant')" scope="col" class="px-6 py-3">
                                        Supplier Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    
                                    <th  scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="quatation in quatations.data" :key="quatation.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th  v-if="$page.props.user.userRoles.includes('Procurement Officer')" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                
                                        <Link :href="route('procurement-officer.suppliers.show', quatation.user.id)">{{ quatation.user.name }}</Link>         
                                      
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Assistant Group Accountant')" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                
                                        <Link :href="route('assistant-group-accountant.suppliers.show', quatation.user.id)">{{ quatation.user.name }}</Link>         
                                    
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{quatation.title  }}
                                    </th>
                                
                                   
                                    <td class="px-6 py-4">
                                        
                                        <template v-if="$page.props.user.userRoles.includes('Procurement Officer')">
                                            <Link as="button" :href="route('procurement-officer.quatations.show', quatation.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        </template>
                                        <template v-if="$page.props.user.userRoles.includes('Assistant Group Accountant')">
                                            <Link as="button" :href="route('assistant-group-accountant.quatations.show', quatation.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        </template>
                                        <template v-if="$page.props.user.userRoles.includes('Verification Assistant')">
                                            <Link as="button" :href="route('verification-assistant.quatations.show', quatation.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        </template>
                                        <template v-if="$page.props.user.userRoles.includes('Verification Officer')">
                                            <Link as="button" :href="route('verification-officer.quatations.show', quatation.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        </template>
                                        <template v-if="$page.props.user.userRoles.includes('Fm Payments teclar')">
                                            <Link as="button" :href="route('fm-payments-teclar.quatations.show', quatation.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        </template>
                                        <template v-if="$page.props.user.userRoles.includes('Group Accountant')">
                                            <Link as="button" :href="route('group-accountant.quatations.show', quatation.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        </template>
                                        <!-- General Manager -->
                                        <template v-if="$page.props.user.userRoles.includes('General Manager')">
                                            <Link as="button" :href="route('general-manager.quatations.show', quatation.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        </template>
                                        <template v-if="$page.props.user.userRoles.includes('Vendor/Supplier')">
                                            <Link as="button" :href="route('supplier.quatations.show', quatation.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                            <Link as="button" :href="route('supplier.quatations.destroy', quatation.id)" method="delete" class="font-medium text-red-600 mr-2 dark:text-red-500 hover:underline">Delete</Link>
                                        </template>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                  <!-- <Pagination :links="requisitions.links"/> -->
            </div>

            </div>

        </div>

    </AuthenticatedLayout>


</template>