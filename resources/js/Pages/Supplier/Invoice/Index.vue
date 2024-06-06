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
import { usePage } from '@inertiajs/vue3';

let item = ref(null)
const props = defineProps({
    taxInvoices: Object,
})

// props.taxInvoices.verification_assistant_approved
// props.taxInvoices.verification_officer_approved
// props.taxInvoices.group_accountant_approved
// props.taxInvoices.fm_payments_tecla_approvedr
watch(item, value =>{
    if (props.role[0] === 'Procurement Officer') {
    router.get('/procurement-officer/market',
        { item: value },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
} else {
    router.get('/supplier/stocks',
        { item: value },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
}
})


const form = useForm({
    product_name: '',
    quantity: '',
    price:'',
});

const showAddRoleOverlay = ref(null)
const submit = () => {
    form.post(route('supplier.stocks.store'),{

        preserveScroll: true,
        onSuccess: () => closeModal(),

        onFinish: () => form.reset(),
    });

};
const closeModal = () => {
    showAddRoleOverlay.value = false;

    form.reset();
};

function calculateWidth(num1, num2, num3, num4) {
    let sum = num1 + num2 + num3 + num4;
    let width;
    
    switch (sum) {
        case 1:
            width = 'width: 25%';
            break;
        case 2:
            width = 'width: 50%';
            break;
        case 3:
            width = 'width: 75%';
            break;
        case 4:
            width = 'width: 100%';
            break;
        default:
            width = 'width: 0%';
    }
    
    return width;
}


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <!-- <div  v-if="$page.props.user.userRoles.includes('Vendor/Supplier')" class="flex items-center justify-between" >
                        <button @click="showAddRoleOverlay = true"  class="my-auto inline-flex items-center justify-center p-0.5  overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                            <span class="p-2 my- transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                Add Stock
                            </span>
                        </button>
                        <div class="relative  " >

                            <input type="text" v-model="item" id="table-search" class="block  text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>
                    </div>
                    <div  v-else class="flex items-center justify-between" >
                        <div class="relative  " >

                            <input type="text" v-model="item" id="table-search" class="block  text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>
                    </div> -->
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr >
                                    <!-- <th v-if="$page.props.user.userRoles.includes('Procurement Officer')" scope="col" class="px-6 py-3">
                                        Supplier Name
                                    </th> -->
                                    <th scope="col" class="px-6 py-3">
                                        
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>

                                    <!-- Status -->
                                    <th  v-if="$page.props.user.userRoles.includes('Vendor/Supplier')" scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Verification Assistant')" scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Verification Officer')" scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Group Accountant')" scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Fm Payments teclar')" scope="col" class="px-6 py-3">
                                        Status
                                    </th>

                                    <th  v-if="$page.props.user.userRoles.includes('General Manager')" scope="col" class="px-6 py-3">
                                        Status
                                    </th>

                                    <!-- Action -->
                                    <th  v-if="$page.props.user.userRoles.includes('Vendor/Supplier')" scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Verification Assistant')" scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Verification Officer')" scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Group Accountant')" scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('Fm Payments teclar')" scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th  v-if="$page.props.user.userRoles.includes('General Manager')" scope="col" class="px-6 py-3">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr v-for="taxInvoice in taxInvoices" :key="taxInvoice.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <!-- <th  v-if="$page.props.user.userRoles.includes('Procurement Officer')" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <template v-for="supplier in suppliers" :key="supplier.id">
                                            <template v-if="supplier.id == stock.user_id">
                                                
                                                <Link :href="route('procurement-officer.suppliers.show', supplier.id)">{{ supplier.name }}</Link>
                                            </template>
                                        </template>
                                    </th> -->
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{taxInvoice.title  }}
                                    </th>
                                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        $ {{taxInvoice.unit_price }}
                                    </th>

                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{taxInvoice.quantity }} 
                                        
                                    </th>

                                    <!-- Status -->
                                    <th v-if="$page.props.user.userRoles.includes('Vendor/Supplier')"  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <template v-if="taxInvoice.general_manager_approved">
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-green-600 h-2.5 rounded-full" 
                                                style="width: 100%">
                                            </div>
                                        
                                            </div>

                                        </template>
                                        <template v-else>
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                                :style="
                                                calculateWidth(
                                                taxInvoice.fm_payments_teclar_approved,
                                                taxInvoice.group_accountant_approved,
                                                taxInvoice.verification_officer_approved,
                                                taxInvoice.verification_assistant_approved)
                                                ">
                                            </div>
                                        
                                            </div>
                                        </template>
                                        
                                    </th>
                                    
                                    <th v-if="$page.props.user.userRoles.includes('Verification Assistant')"  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <template v-if="taxInvoice.general_manager_approved">
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-green-600 h-2.5 rounded-full" 
                                                style="width: 100%">
                                            </div>
                                        
                                            </div>

                                        </template>
                                        <template v-else>
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                                :style="
                                                calculateWidth(
                                                taxInvoice.fm_payments_teclar_approved,
                                                taxInvoice.group_accountant_approved,
                                                taxInvoice.verification_officer_approved,
                                                taxInvoice.verification_assistant_approved)
                                                ">
                                            </div>
                                        
                                            </div>
                                        </template>
                                    </th>

                                    <th v-if="$page.props.user.userRoles.includes('Verification Officer')"  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <template v-if="taxInvoice.general_manager_approved">
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-green-600 h-2.5 rounded-full" 
                                                style="width: 100%">
                                            </div>
                                        
                                            </div>

                                        </template>
                                        <template v-else>
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                                :style="
                                                calculateWidth(
                                                taxInvoice.fm_payments_teclar_approved,
                                                taxInvoice.group_accountant_approved,
                                                taxInvoice.verification_officer_approved,
                                                taxInvoice.verification_assistant_approved)
                                                ">
                                            </div>
                                        
                                            </div>
                                        </template>
                                    </th>

                                    <th v-if="$page.props.user.userRoles.includes('Fm Payments teclar')"  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <template v-if="taxInvoice.general_manager_approved">
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-green-600 h-2.5 rounded-full" 
                                                style="width: 100%">
                                            </div>
                                        
                                            </div>

                                        </template>
                                        <template v-else>
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                                :style="
                                                calculateWidth(
                                                taxInvoice.fm_payments_teclar_approved,
                                                taxInvoice.group_accountant_approved,
                                                taxInvoice.verification_officer_approved,
                                                taxInvoice.verification_assistant_approved)
                                                ">
                                            </div>
                                        
                                            </div>
                                        </template>
                                    </th>

                                    <th v-if="$page.props.user.userRoles.includes('Group Accountant')"  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <template v-if="taxInvoice.general_manager_approved">
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-green-600 h-2.5 rounded-full" 
                                                style="width: 100%">
                                            </div>
                                        
                                            </div>

                                        </template>
                                        <template v-else>
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                                :style="
                                                calculateWidth(
                                                taxInvoice.fm_payments_teclar_approved,
                                                taxInvoice.group_accountant_approved,
                                                taxInvoice.verification_officer_approved,
                                                taxInvoice.verification_assistant_approved)
                                                ">
                                            </div>
                                        
                                            </div>
                                        </template>
                                    </th>

                                    <th v-if="$page.props.user.userRoles.includes('General Manager')"  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <template v-if="taxInvoice.general_manager_approved">
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-green-600 h-2.5 rounded-full" 
                                                style="width: 100%">
                                            </div>
                                        
                                            </div>

                                        </template>
                                        <template v-else>
                                            <div  class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                                :style="
                                                calculateWidth(
                                                taxInvoice.fm_payments_teclar_approved,
                                                taxInvoice.group_accountant_approved,
                                                taxInvoice.verification_officer_approved,
                                                taxInvoice.verification_assistant_approved)
                                                ">
                                            </div>
                                        
                                            </div>
                                        </template>
                                    </th>
                                    
                                   
                                    <!-- Action -->
                                    <td  v-if="$page.props.user.userRoles.includes('Vendor/Supplier')" class="px-6 py-4">
                                        <Link as="button" :href="route('supplier.tax-invoice.show', taxInvoice.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                        <Link as="button" :href="route('supplier.tax-invoice.destroy', taxInvoice.id)" method="delete" class="font-medium text-red-600 mr-2 dark:text-red-500 hover:underline">Delete</Link>
                                   
                                    </td>
                                    <td  v-if="$page.props.user.userRoles.includes('Verification Assistant')" class="px-6 py-4">
                                        <Link as="button" :href="route('verification-assistant.tax-invoice.show', taxInvoice.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                    </td>
                                    <td  v-if="$page.props.user.userRoles.includes('Verification Officer')" class="px-6 py-4">
                                        <Link as="button" :href="route('verification-officer.tax-invoice.show', taxInvoice.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link>
                                    </td>
                                    <td  v-if="$page.props.user.userRoles.includes('Group Accountant')" class="px-6 py-4">
                                        <Link as="button" :href="route('group-accountant.tax-invoice.show', taxInvoice.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                    </td>
                                    <td  v-if="$page.props.user.userRoles.includes('Fm Payments teclar')" class="px-6 py-4">
                                        <Link as="button" :href="route('fm-payments-teclar.tax-invoice.show', taxInvoice.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                    </td>
                                    <td  v-if="$page.props.user.userRoles.includes('General Manager')" class="px-6 py-4">
                                        <Link as="button" :href="route('general-manager.tax-invoice.show', taxInvoice.id)"  class="font-medium text-green-600 mr-2 dark:text-green-500 hover:underline">Show</Link> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                  <!-- <Pagination :links="stocks.links"/> -->
            </div>

            </div>

        </div>

    </AuthenticatedLayout>

   
</template>