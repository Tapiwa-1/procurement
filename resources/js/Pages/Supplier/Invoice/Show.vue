<template>
    

        <AuthenticatedLayout>
        <div class="">
                <!-- Invoice Header -->
                <div class="invoice-header">
                    <ApplicationLogo/>
                    <h1 class="text-xl font-semibold">Tax Invoice</h1>
                </div>

        
                <!-- Invoice Details -->
                <div class="invoice-details">
                    <!-- Verification Assistant -->
                    <template v-if="$page.props.user.userRoles.includes('Verification Assistant')">
                        <div class="invoice-item my-3">
                            <span>Supplier Name:</span>
                            <Link :href="route('verification-assistant.suppliers.show', taxInvoice.user_id)"><span>{{ taxInvoice.user.name }}</span></Link>
                        </div>
                        <div class="invoice-item my-3">
                            <span>Quatation Title:</span>
                            
                            <Link :href="route('verification-assistant.quatations.show', taxInvoice.quotation.id)"><span>{{ taxInvoice.quotation.title }}</span></Link>
                        </div>

                        <div class="invoice-item my-3 mb-5">
                            <span>Requisition Title:</span>
                            <Link :href="route('verification-assistant.requisition.show', taxInvoice.requisition.id)"> <span>{{ taxInvoice.requisition.title}}</span></Link>
                        </div>
                        
                        
                    </template>

                    <!-- Verification Officer -->
                    <template v-if="$page.props.user.userRoles.includes('Verification Officer')">
                        <div class="invoice-item my-3">
                            <span>Supplier Name:</span>
                            <Link :href="route('verification-officer.suppliers.show', taxInvoice.user_id)"><span>{{ taxInvoice.user.name }}</span></Link>
                            
                        </div>
                        <div class="invoice-item my-3">
                            <span>Quatation Title:</span>
                            
                            <Link :href="route('verification-officer.quatations.show', taxInvoice.quotation.id)"><span>{{ taxInvoice.quotation.title }}</span></Link>
                        </div>

                        <div class="invoice-item my-3 mb-5">
                            <span>Requisition Title:</span>
                            <Link :href="route('verification-officer.requisition.show', taxInvoice.requisition.id)"> <span>{{ taxInvoice.requisition.title}}</span></Link>
                        </div>
                        
                    </template>

                    <!-- Group Accountant -->
                    <template v-if="$page.props.user.userRoles.includes('Group Accountant')">
                        <div class="invoice-item my-3">
                            <span>Supplier Name:</span>
                            <Link :href="route('group-accountant.suppliers.show', taxInvoice.user_id)"><span>{{ taxInvoice.user.name }}</span></Link>
                            
                        </div>
                        <div class="invoice-item my-3">
                            <span>Quatation Title:</span>
                            
                            <Link :href="route('group-accountant.quatations.show', taxInvoice.quotation.id)"><span>{{ taxInvoice.quotation.title }}</span></Link>
                        </div>

                        <div class="invoice-item my-3 mb-5">
                            <span>Requisition Title:</span>
                            <Link :href="route('group-accountant.requisition.show', taxInvoice.requisition.id)"> <span>{{ taxInvoice.requisition.title}}</span></Link>
                        </div>
                        
                    </template>

                    <!-- Fm Payments teclar -->
                    <template v-if="$page.props.user.userRoles.includes('Fm Payments teclar')">
                        <div class="invoice-item my-3">
                            <span>Supplier Name:</span>
                            <Link :href="route('fm-payments-teclar.suppliers.show', taxInvoice.user_id)"><span>{{ taxInvoice.user.name }}</span></Link>
                        </div>
                        <div class="invoice-item my-3">
                            <span>Quatation Title:</span>
                            
                            <Link :href="route('fm-payments-teclar.quatations.show', taxInvoice.quotation.id)"><span>{{ taxInvoice.quotation.title }}</span></Link>
                        </div>

                        <div class="invoice-item my-3 mb-5">
                            <span>Requisition Title:</span>
                            <Link :href="route('fm-payments-teclar.requisition.show', taxInvoice.requisition.id)"> <span>{{ taxInvoice.requisition.title}}</span></Link>
                        </div>
                        
                    </template>
                   
                    <div class="invoice-item">
                        <span>Title:</span>
                        <span>{{ taxInvoice.title }}</span>
                    </div>
                    <div class="invoice-item">
                        <span>Invoice Number:</span>
                        <span>{{ taxInvoice.invoice_number }}</span>
                    </div>
                    <div class="invoice-item">
                        <span>Customer Name:</span>
                        <span>{{  taxInvoice.customer_name }}</span>
                    </div>
                    <div class="invoice-item">
                        <span>Description:</span>
                        <span>{{ taxInvoice.description }}</span>
                    </div>
                    <div class="invoice-item">
                        <span>Quantity:</span>
                        <span>{{ taxInvoice.quantity }}</span>
                    </div>
                    <div class="invoice-item">
                        <span>Unit Price:</span>
                        <span>$ {{ taxInvoice.unit_price }}</span>
                    </div>
                    <div class="invoice-item">
                        <span>Subtotal:</span>
                        <span>$ {{ taxInvoice.subtotal }}</span>
                    </div>
                    <div class="invoice-item">
                        <span>Tax:</span>
                        <span>{{ taxInvoice.tax }}</span>
                    </div>
                    <div class="invoice-item">
                        <span>Total Amount Due:</span>
                        <span>$ {{ taxInvoice.total_amount_due }}</span>
                    </div>
                </div>

                 <!-- Approval Section -->
                 <!-- v-if="$page.props.user.userRoles.includes('Fm Payments teclar')" -->
                <div class="approval-section my-2">
                    <h2>Approvals</h2>
                    <div class="approval-item">
                        <span>Verification Assistant Approved:</span>
                        <template v-if="taxInvoice.verification_assistant_approved  == 0">
                            <!-- Verification Assistant -->
                            <template v-if="$page.props.user.userRoles.includes('Verification Assistant')">
                                <!-- verification-assistant.quotation.approve  -->
                                <Link  method="patch" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :href="route('verification-assistant.taxinvoice.approve',taxInvoice.id)">Approve
                                </Link>
                            </template>
                            <template v-else>
                                <span class=" text-red-900">Pending</span>
                            </template>
                            
                        </template>
                        <template v-else>
                            <span class=" text-green-900">Approved</span>
                        </template>
                    </div>
                    <div class="approval-item">
                        <span>Verification Officer Approved:</span>
                        <template v-if="taxInvoice.verification_officer_approved  == 0">
                            <!-- Verification Officer -->
                            <template v-if="$page.props.user.userRoles.includes('Verification Officer')">
                                <!-- verification-officer.quotation.approve  -->
                                <Link method="patch"  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :href="route('verification-officer.taxinvoice.approve',taxInvoice.id)">Approve
                                </Link>
                            </template>
                            <template v-else>
                                <span class=" text-red-900">Pending</span>
                            </template>
                        </template>
                        <template v-else>
                            <span class=" text-green-900">Approved</span>
                        </template>
                    </div>
                    <div class="approval-item">
                        <span>Group Accountant Approved:</span>
                        <template v-if="taxInvoice.group_accountant_approved  == 0">
                            <!-- Group Accountant -->
                            <template v-if="$page.props.user.userRoles.includes('Group Accountant')">
                                <!-- group-accountent.quotation.approve -->
                                <Link method="patch"  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :href="route('group-accountant.taxinvoice.approve',taxInvoice.id)">Approve
                                </Link>
                            </template>
                            <template v-else>
                                <span class=" text-red-900">Pending</span>
                            </template>
                        </template>
                        <template v-else>
                            <span class=" text-green-900">Approved</span>
                        </template>
                    </div>

                    <div class="approval-item">
                        <span>FM Payments Teclar Approved:</span>
                        <template v-if="taxInvoice.fm_payments_teclar_approved == 0">
                            <!-- Fm Payments teclar -->
                            <template v-if="$page.props.user.userRoles.includes('Fm Payments teclar')">
                                <!-- fm-payments-teclar.quotation.approve  -->
                                <Link method="patch" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :href="route('fm-payments-teclar.taxinvoice.approve',taxInvoice.id)">Approve
                                </Link>
                            </template>
                            <template v-else>
                                <span class=" text-red-900">Pending</span>
                            </template>
                        </template>
                        <template v-else>
                            <span class=" text-green-900">Approved</span>
                        </template>
                    </div>

                    <div class="approval-item" v-if="taxInvoice.group_accountant_approved & taxInvoice.verification_assistant_approved & taxInvoice.fm_payments_teclar_approved & taxInvoice.verification_officer_approved ">
                        <span>General Manager Check Out:</span>
                        <template v-if="taxInvoice.general_manager_approved == 0">
                            <!-- Fm Payments teclar -->
                            <template v-if="$page.props.user.userRoles.includes('General Manager')">
                                <!-- fm-payments-teclar.quotation.approve  -->
                                <Link method="patch" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :href="route('general-manager.taxinvoice.approve',taxInvoice.id)">
                                    <ShoppingCartIcon class="h-5 w-5 text-gray-100 mr-2" /> 
                                    Check Out
                                </Link>
                            </template>
                            <template v-else>
                                <span class=" text-red-900">Pending</span>
                            </template>
                        </template>
                        <template v-else>
                            <span class=" text-green-900">Approved</span>
                        </template>
                        
                    </div>

                   
                </div>
            </div>
        </AuthenticatedLayout>
</template>

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
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { usePage } from '@inertiajs/vue3';
import {
  HomeIcon,
  BookmarkIcon,
  ChevronDoubleDownIcon,
  LockClosedIcon,
  ChatBubbleLeftIcon,
  CursorArrowRaysIcon,
  XMarkIcon,
  Bars3Icon,
  SunIcon,
  MoonIcon,
  UserGroupIcon,
  UsersIcon,
  KeyIcon,
  BriefcaseIcon,
  DocumentPlusIcon,
  ClipboardDocumentListIcon,
  DocumentDuplicateIcon,
  DocumentIcon,
  ClockIcon,
  CheckIcon,
  ArrowTrendingUpIcon,
  ShoppingCartIcon,
  CurrencyDollarIcon,
  BoltIcon,
  DocumentCheckIcon,

} from '@heroicons/vue/24/outline'


const props = defineProps({

    taxInvoice: Object,
})

</script>

<style >

body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .invoice-header img {
            height: 60px;
        }

        .invoice-details {
            border: 1px solid #dee2e6;
            padding: 1.5rem;
            border-radius: 8px;
            background-color: white;
        }

        .invoice-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .invoice-item span {
            font-weight: bold;
        }


        .approval-section {
            border: 1px solid #dee2e6;
            padding: 1.5rem;
            border-radius: 8px;
            background-color: white;
        }

        .approval-section h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .approval-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .approval-item span {
            font-weight: bold;
        }
</style>