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
    quatation: Object
})


const form = useForm({
    user_id: props.quatation.user_id,
    requisition_id: props.quatation.requisition.id,
    quotation_id: props.quatation.id,
    title:'',
    description:"",
    quantity:"",
    unit_price:"",
   
});

const showAddRoleOverlay = ref(null)
const submit = () => {
    form.post(route('supplier.tax-invoice.store'),{

        preserveScroll: true,
        onSuccess: () => closeModal(),

        // onFinish: () => form.reset(),
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
                <div class=" dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                        <div class="bg-white w-full shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ quatation.title }}
                                
                                    
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Details and informations about the quatation.
                                </p>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>

                                    <!-- Verification Assistant -->
                                    <div  v-if="$page.props.user.userRoles.includes('Verification Assistant')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Supplier Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('verification-assistant.suppliers.show', quatation.user_id)">{{ quatation.user.name }}</Link>
                                           
                                        </dd>
                                    </div>

                                     <!-- Verification Officer -->
                                     <div  v-if="$page.props.user.userRoles.includes('Verification Officer')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Supplier Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('verification-officer.suppliers.show', quatation.user_id)">{{ quatation.user.name }}</Link>
                                           
                                        </dd>
                                    </div>

                                     <!-- Group Accountant  -->
                                     <div  v-if="$page.props.user.userRoles.includes('Group Accountant')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Supplier Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('group-accountant.suppliers.show', quatation.user_id)">{{ quatation.user.name }}</Link>
                                           
                                        </dd>
                                    </div>

                                     <!-- Fm Payments teclar  -->
                                     <div  v-if="$page.props.user.userRoles.includes('Fm Payments teclar')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Supplier Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('fm-payments-teclar.suppliers.show', quatation.user_id)">{{ quatation.user.name }}</Link>
                                           
                                        </dd>
                                    </div>

                                    <!-- Procurement Officer -->

                                    <div v-if="$page.props.user.userRoles.includes('Procurement Officer')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Requisition Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('procurement-officer.requisition.show', quatation.requisition.id)">{{  quatation.requisition.title }}</Link>
                                        </dd>
                                        
                                    </div>

                                    <!-- Assistant Group Accountant -->
                                    <div v-if="$page.props.user.userRoles.includes('Assistant Group Accountant')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Requisition Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('assistant-group-accountant.requisition.show', quatation.requisition.id)">{{  quatation.requisition.title }}</Link>
                                        </dd>
                                    </div>

                                    <!-- Vendor/Supplier -->
                                    <div v-if="$page.props.user.userRoles.includes('Vendor/Supplier')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Requisition Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('supplier.requisition.show', quatation.requisition.id)">{{  quatation.requisition.title }}</Link>
                                        </dd>
                                    </div>
                                    <!-- Verification Assistant -->
                                    <div v-if="$page.props.user.userRoles.includes('Verification Assistant')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Requisition Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('verification-assistant.requisition.show', quatation.requisition.id)">{{  quatation.requisition.title }}</Link>
                                        </dd>
                                    </div>

                                    <!-- Verification Officer -->
                                    <div v-if="$page.props.user.userRoles.includes('Verification Officer')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Requisition Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('verification-officer.requisition.show', quatation.requisition.id)">{{  quatation.requisition.title }}</Link>
                                        </dd>
                                    </div>


                                    <!-- Group Accountant -->
                                    <div v-if="$page.props.user.userRoles.includes('Group Accountant')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Requisition Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('group-accountant.requisition.show', quatation.requisition.id)">{{  quatation.requisition.title }}</Link>
                                        </dd>
                                    </div>

                                    <!-- Fm Payments teclar -->
                                    <div v-if="$page.props.user.userRoles.includes('Fm Payments teclar')"  class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Requisition Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <Link :href="route('fm-payments-teclar.requisition.show', quatation.requisition.id)">{{  quatation.requisition.title }}</Link>
                                        </dd>
                                    </div>
                                    
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ quatation.title  }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Description
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ quatation.description  }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Price
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                           $ {{ quatation.unit_price  }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Quantity
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ quatation.quantity  }}
                                        </dd>
                                    </div>
                                   
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt v-if="$page.props.user.userRoles.includes('Assistant Group Accountant')"   class="text-sm font-medium text-gray-500">
                                            Approved
                                        </dt>
                                        <dt v-if="$page.props.user.userRoles.includes('Vendor/Supplier') "   class="text-sm font-medium text-gray-500">
                                            Approved
                                        </dt>
                                        <dt v-if="$page.props.user.userRoles.includes('Verification Assistant') "   class="text-sm font-medium text-gray-500">
                                            Approved
                                        </dt>
                                        <dt v-if="$page.props.user.userRoles.includes('Verification Officer') "   class="text-sm font-medium text-gray-500">
                                            Approved
                                        </dt>
                                        <dt v-if="$page.props.user.userRoles.includes('Group Accountant') "   class="text-sm font-medium text-gray-500">
                                            Approved
                                        </dt>
                                        <dt v-if="$page.props.user.userRoles.includes('Fm Payments teclar') "   class="text-sm font-medium text-gray-500">
                                            Approved
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            
                                            
                                            <!-- Verification Assistant -->
                                            <div v-if="$page.props.user.userRoles.includes('Verification Assistant') " class="">
                                                <div v-if="quatation.approved  == 1" class="text-green-600 text-bold">
                                                    Yes
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    No
                                                </div>
                                            </div>

                                            <!-- Verification Officer -->
                                            <div v-if="$page.props.user.userRoles.includes('Verification Officer') " class="">
                                                <div v-if="quatation.approved  == 1" class="text-green-600 text-bold">
                                                    Yes
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    No
                                                </div>
                                            </div>

                                            <!-- Group Accountant -->
                                            <div v-if="$page.props.user.userRoles.includes('Group Accountant') " class="">
                                                <div v-if="quatation.approved  == 1" class="text-green-600 text-bold">
                                                    Yes
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    No
                                                </div>
                                            </div>

                                            <!-- Fm Payments teclar -->
                                            <div v-if="$page.props.user.userRoles.includes('Fm Payments teclar') " class="">
                                                <div v-if="quatation.approved  == 1" class="text-green-600 text-bold">
                                                    Yes
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    No
                                                </div>
                                            </div>
                                            

                                            <div v-if="$page.props.user.userRoles.includes('Assistant Group Accountant') " class="">
                                                <div v-if="quatation.approved  == 1" class="text-green-600 text-bold">
                                                    Yes
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    <Link method="patch" :href="route('assistant-group-accountant.quotation.approve', quatation.id)">Click to approve</Link>
                                                </div>
                                            </div>
                                            <div v-if="$page.props.user.userRoles.includes('Vendor/Supplier') " class="">
                                                <div v-if="quatation.approved  == 1" class="text-green-600 text-bold">
                                                    <PrimaryButton  @click="showAddRoleOverlay = true" class="my-3">Create  TaxInvoice</PrimaryButton>
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    
                                                    No
                                                </div>
                                                
                                            </div>
                                           
                                        </dd>

                                        
                                        
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                       
                                        <dt v-if="$page.props.user.userRoles.includes('Procurement Officer') "   class="text-sm font-medium text-gray-500">
                                            Approved
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
    
                                            <div v-if="$page.props.user.userRoles.includes('Procurement Officer') " class="">
                                                <div v-if="quatation.approved  == 1" class="text-green-600 text-bold">
                                                    Yes
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    No
                                                </div>
                                            </div>
                                            <!-- <div class="">
                                                <PrimaryButton v-if="$page.props.user.userRoles.includes('Vendor/Supplier')"  @click="showAddRoleOverlay = true" >Create  Quatation</PrimaryButton>
                                            </div> -->
                                        </dd>
                                        
                                        
                                    </div>


                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-blue-500 underline">
                                            <!-- <Link  v-if="$page.props.user.userRoles.includes('Receptionist')" :href="route('receptionist.requisition.index')">Back</Link> -->
                                            <Link  v-if="$page.props.user.userRoles.includes('Procurement Officer')" :href="route('procurement-officer.quatations.index')">Back</Link>
                                            <Link  v-if="$page.props.user.userRoles.includes('Vendor/Supplier')" :href="route('supplier.quatations.index')">Back</Link>
                                            
                                        </dt>
                                    
                                    </div>
                                </dl>
                            </div>
                        </div>
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
                                            <InputLabel for="email" value="Unit price" />

                                            <TextInput
                                                type="number"
                                                :step="0.01"
                                                class="mt-1 block w-full"
                                                v-model="form.unit_price"
                                            />
                                            <InputError class="mt-2" :message="form.errors.unit_price" />
                                        </div>
                                        <div>
                                            <InputLabel for="email" value="Quantity" />

                                            <TextInput
                                             
                                                type="number"
                                                
                                                class="mt-1 block w-full"
                                                v-model="form.quantity"

                                               
                                        
                                            />
                                            <InputError class="mt-2" :message="form.errors.quantity" />
                                        </div>        
                                        <div class="flex items-center justify-end mt-4">
                                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Create Quatation
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