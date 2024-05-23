<template>
    <nav class="min-w-[200px]">
        <Link href="/" class="h-[80px] px-3 flex items-center gap-3">
            <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800"/>
            Procurement
        </Link>  
        <div class="px-3">
            <!-- <CreateNewDropdown/> -->
            <div class="py-3">
                <NavLink :href="route('dashboard')" :active="$page.url == '/dashboard'">
                    <HomeIcon class="h-5 w-5 text-gray-900 " /> 
                    <span class="pl-2">Home</span>
                </NavLink>

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
                    <DocumentIcon class="h-5 w-5 text-gray-900 " /> 
                    <span class="pl-2">Suppliers</span>
                </NavLink>
                
                
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

} from '@heroicons/vue/24/outline'
</script>