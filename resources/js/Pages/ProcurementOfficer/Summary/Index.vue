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
const props = defineProps({
    summaries: Object,
    requisitions:Object,
   
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
    requisition_id:"",
    title:"",
    content:"",
   
});

const showAddRoleOverlay = ref(null)
const submit = () => {
    form.post(route('procurement-officer.summaries.store'),{

        preserveScroll: true,
        onSuccess: () => closeModal(),

        onFinish: () => form.reset(),
    });

};
const closeModal = () => {
    showAddRoleOverlay.value = false;

    form.reset();
};

const search = ref('');

const filteredRequsitions = ref([]);
const  requisitions  = props.requisitions

function filterOptions() {
  filteredRequsitions.value = requisitions.filter(requisition =>
    requisition.title.toLowerCase().includes(search.value.toLowerCase())
  );
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <div v-if="$page.props.user.userRoles.includes('Procurement Officer')"  class="flex items-center justify-between" >
                        <button @click="showAddRoleOverlay = true"  class="my-auto inline-flex items-center justify-center p-0.5  overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                            <span class="p-2 my- transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                Create Summary
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
                                        Approved
                                    </th>
                                    
                                    <th v-if="$page.props.user.userRoles.includes('Procurement Officer')" scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                   
                                    

                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="summary in summaries.data" :key="summary.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                   
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{summary.title  }}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{summary.approved  }}
                                    </th>
                                   
                                    <td class="px-6 py-4">
                                        <template v-if="$page.props.user.userRoles.includes('Procurement Officer')">
                                            <Link as="button" :href="route('procurement-officer.summaries.show', summary.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                            <Link as="button" :href="route('procurement-officer.summaries.destroy', summary.id)"  method="delete"  class="font-medium text-red-600 mr-2 dark:text-red-500 hover:underline">Delete</Link> 
                                        </template>
                                        <!-- Assistant Group Accountant -->
                                        <template v-if="$page.props.user.userRoles.includes('Assistant Group Accountant')">
                                            <Link as="button" :href="route('assistant-group-accountant.summaries.show', summary.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        
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
                                             
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.title"

                                               
                                        
                                            />
                                            <InputError class="mt-2" :message="form.errors.title" />
                                        </div>

                                        <div class="">
                                                <InputLabel for="name" value="Select Requesition" />
                                                <div class="relative">
                                                    <input
                                                    v-model="search"
                                                    @input="filterOptions"
                                                    placeholder="Search..."
                                                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 dark:bg-slate-800 dark:text-white"
                                                    />
                                                    <select multiple v-model="form.requisition_id" id="countries_multiple" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="" selected>Choose a category</option>
                                                    <option v-for="(requisition, index) in filteredRequsitions" :key="index" :value="requisition.id">{{ requisition.title }}</option>
                                                    </select>
                                                </div>

                                                <div v-if="error && error.requisition_id" class="text-red-500 p-2 font-extrabold">{{ error.requisition_id }}</div>
                                        </div>
                                       
                                        <div>
                                            <InputLabel for="name" value="Content" />

                                            <QuillEditor  v-model:content="form.content" content-type="html"  class=" min-h-96" theme="snow" />
                                            <InputError class="mt-2 " :message="form.errors.content" />
                                        </div>           
                                        <div class="flex items-center justify-end mt-4">
                                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Create Summary
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