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
    requisition: Object
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                <div class=" dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                        <div class="bg-white w-full shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ requisition.title }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Details and informations about the requisition.
                                </p>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Title
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ requisition.title  }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Description
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ requisition.description  }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Unit Price
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ requisition.unit_price  }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Delivery Date
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ requisition.delivery_date  }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Approved
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <div v-if="$page.props.user.userRoles.includes('Receptionist')" class="">
                                                <div v-if="requisition.approved  == 1" class="text-green-600 text-bold">
                                                    Yes
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    No
                                                </div>
                                            </div>
                                            <div v-if="$page.props.user.userRoles.includes('Procurement Officer')" class="">
                                                <div v-if="requisition.approved  == 1" class="text-green-600 text-bold">
                                                    Yes
                                                </div>
                                                <div v-else class="text-red-600 text-bold">
                                                    
                                                    <Link method="patch" :href="route('procurement-officer.requisition.approve', requisition.id)">Click to approve</Link>
                                                </div>
                                            </div>
                                            
                                        </dd>
                                    </div>


                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-blue-500 underline">
                                            <Link  v-if="$page.props.user.userRoles.includes('Receptionist')" :href="route('receptionist.requisition.index')">Back</Link>
                                            <Link  v-if="$page.props.user.userRoles.includes('Procurement Officer')" :href="route('procurement-officer.requisition.index')">Back</Link>
                                            
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

   
</template>