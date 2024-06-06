<template>
    <nav class="min-w-[200px]">
        <Link href="/" class="h-[80px] px-3 flex items-center gap-3">
            <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800"/>
    
        </Link>  
        <div class="px-3">
            <!-- <CreateNewDropdown/> -->
            <div class="py-3">
                <NavLink :href="route('dashboard')" :active="$page.url == '/dashboard'">
                    <HomeIcon class="h-5 w-5 text-gray-900 " /> 
                    <span class="pl-2">Home</span>
                </NavLink>
                <template v-if="$page.props.user.userRoles.includes('admin')">
                    <NavLink :href="route('admin.overview')" :active="$page.url == '/admin/overview'">
                        <ArrowTrendingUpIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Overview</span>
                    </NavLink>
                    <NavLink :href="route('admin.roles.index')" :active="$page.url == '/admin/roles'">
                        <UserGroupIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Roles</span>
                    </NavLink>
                    <NavLink :href="route('admin.users.index')" :active="$page.url == '/admin/users'">
                        <UsersIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Users</span>
                    </NavLink>
                    <NavLink :href="route('admin.suppliers.index')" :active="$page.url == '/admin/suppliers'">
                        <ShoppingCartIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Suppliers</span>
                    </NavLink>
                </template>
                
                <template v-if="$page.props.user.userRoles.includes('Vendor/Supplier')">
                    <NavLink :href="route('supplier.stocks.index')" :active="$page.url == '/supplier/stocks'">
                        <ShoppingCartIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">My Stock</span>
                    </NavLink>
                    <NavLink :href="route('supplier.requisition.index')" :active="$page.url == '/supplier/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                    <NavLink :href="route('supplier.quatations.index')" :active="$page.url == '/supplier/quatations'">
                        <CurrencyDollarIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Quatations</span>
                    </NavLink>
                    
                    <NavLink :href="route('supplier.tax-invoice.index')" :active="$page.url == '/supplier/tax-invoice'">
                        <DocumentCheckIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Invoice</span>
                    </NavLink>
                    
                </template>
               
                <template v-if="$page.props.user.userRoles.includes('Receptionist')" >
                    <NavLink :href="route('receptionist.requisition.index')" :active="$page.url == '/receptionist/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                </template>

                <template v-if="$page.props.user.userRoles.includes('Procurement Officer')" >
                    <NavLink :href="route('procurement-officer.market.index')" :active="$page.url == '/procurement-officer/market'">
                        <ShoppingCartIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Market</span>
                    </NavLink>
                    <NavLink :href="route('procurement-officer.requisition.index')" :active="$page.url == '/procurement-officer/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                    <NavLink :href="route('procurement-officer.quatations.index')" :active="$page.url == '/procurement-officer/quatations'">
                        <CurrencyDollarIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Quatations</span>
                    </NavLink>

                    <NavLink :href="route('procurement-officer.summaries.index')" :active="$page.url == '/procurement-officer/summaries'">
                        <BoltIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Summary</span>
                    </NavLink>
                    
                </template>

                <template v-if="$page.props.user.userRoles.includes('Assistant Group Accountant')" >
                    <NavLink :href="route('assistant-group-accountant.requisition.index')" :active="$page.url == '/assistant-group-accountant/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                    <NavLink :href="route('assistant-group-accountant.quatations.index')" :active="$page.url == '/assistant-group-accountant/quatations'">
                        <CurrencyDollarIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Quatations</span>
                    </NavLink>

                    <NavLink :href="route('assistant-group-accountant.summaries.index')" :active="$page.url == '/assistant-group-accountant/summaries'">
                        <BoltIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Summary</span>
                    </NavLink>
                    
                </template>
                
                <template v-if="$page.props.user.userRoles.includes('Verification Assistant')" >
                    <NavLink :href="route('verification-assistant.requisition.index')" :active="$page.url == '/verification-assistant/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                    <NavLink :href="route('verification-assistant.quatations.index')" :active="$page.url == '/verification-assistant/quatations'">
                        <CurrencyDollarIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Quatations</span>
                    </NavLink>

                    <NavLink :href="route('verification-assistant.summaries.index')" :active="$page.url == '/verification-assistant/summaries'">
                        <BoltIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Summary</span>
                    </NavLink>
                    
                    <NavLink :href="route('verification-assistant.tax-invoice.index')" :active="$page.url == '/verification-assistant/tax-invoice'">
                        <DocumentCheckIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Invoice</span>
                    </NavLink>
                </template>

                <!-- Verification Officer -->
                <template v-if="$page.props.user.userRoles.includes('Verification Officer')" >
                    <NavLink :href="route('verification-officer.requisition.index')" :active="$page.url == '/verification-officer/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                    <NavLink :href="route('verification-officer.quatations.index')" :active="$page.url == '/verification-officerquatations'">
                        <CurrencyDollarIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Quatations</span>
                    </NavLink>

                    <NavLink :href="route('verification-officer.summaries.index')" :active="$page.url == '/verification-officer/summaries'">
                        <BoltIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Summary</span>
                    </NavLink>
                    
                    <NavLink :href="route('verification-officer.tax-invoice.index')" :active="$page.url == '/verification-officer/tax-invoice'">
                        <DocumentCheckIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Invoice</span>
                    </NavLink>
                </template>

                <!-- Group Accountant -->
                <template v-if="$page.props.user.userRoles.includes('Group Accountant')" >
                    <NavLink :href="route('group-accountant.requisition.index')" :active="$page.url == '/group-accountant/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                    <NavLink :href="route('group-accountant.quatations.index')" :active="$page.url == '/group-accountant/quatations'">
                        <CurrencyDollarIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Quatations</span>
                    </NavLink>

                    <NavLink :href="route('group-accountant.summaries.index')" :active="$page.url == '/group-accountant/summaries'">
                        <BoltIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Summary</span>
                    </NavLink>
                    
                    <NavLink :href="route('group-accountant.tax-invoice.index')" :active="$page.url == '/group-accountant/tax-invoice'">
                        <DocumentCheckIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Invoice</span>
                    </NavLink>
                </template>

                <!-- Fm Payments teclar -->
                <template v-if="$page.props.user.userRoles.includes('Fm Payments teclar')" >
                    <NavLink :href="route('fm-payments-teclar.requisition.index')" :active="$page.url == '/fm-payments-teclar/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                    <NavLink :href="route('fm-payments-teclar.quatations.index')" :active="$page.url == '/fm-payments-teclar/quatations'">
                        <CurrencyDollarIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Quatations</span>
                    </NavLink>

                    <NavLink :href="route('fm-payments-teclar.summaries.index')" :active="$page.url == '/fm-payments-teclar/summaries'">
                        <BoltIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Summary</span>
                    </NavLink>
                    
                    <NavLink :href="route('fm-payments-teclar.tax-invoice.index')" :active="$page.url == '/fm-payments-teclar/tax-invoice'">
                        <DocumentCheckIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Invoice</span>
                    </NavLink>
                </template>

                <!-- General Manager -->
                <template v-if="$page.props.user.userRoles.includes('General Manager')" >
                    <NavLink :href="route('general-manager.requisition.index')" :active="$page.url == '/general-manager/requisition'">
                        <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Requisition</span>
                    </NavLink>
                    
                    <NavLink :href="route('general-manager.quatations.index')" :active="$page.url == '/general-manager/quatations'">
                        <CurrencyDollarIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Quatations</span>
                    </NavLink>

                    <NavLink :href="route('general-manager.summaries.index')" :active="$page.url == '/general-manager/summaries'">
                        <BoltIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Summary</span>
                    </NavLink>
                    
                    <NavLink :href="route('general-manager.tax-invoice.index')" :active="$page.url == '/general-manager/tax-invoice'">
                        <DocumentCheckIcon class="h-5 w-5 text-gray-900 " /> 
                        <span class="pl-2">Invoice</span>
                    </NavLink>
                </template>
                
                
                
            </div>
        </div>
    </nav>
</template>
<script setup>
import ApplicationLogo from '../ApplicationLogo.vue';
import CreateNewDropdown from '@/Components/app/CreateNewDropdown.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
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
</script>