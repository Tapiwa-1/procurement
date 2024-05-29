<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, reactive } from 'vue';
import { Link, useForm, usePage, router } from '@inertiajs/vue3';

let isValidFile = ref(null)
let fileDisplay = ref('')

defineProps({
    certificate: Object
})
const form = reactive({
    file:'',
  
});

 let error = ref({
        file: null,
    
    })


    const createFormFunc = ()=>{
        //create errors first
        error.value.file = null
       

        router.post('/supplier/tax-certificate ', form,{
            forceFormData: true,
            preserveScroll: true,
            onError: errors => {
                errors && errors.file ? error.value.file = errors.file: ''
             
            },
            onSuccess: () => {
                fileDisplay.value = null;
                form.file = null;
                isValidFile.value = null;
            }
        })
    }


const getUploadedImage = (e) =>{
        form.file = e.target.files[0] // get the file that has been uploaded and put it into form.file declared above
        let extention = form.file.name.substring(form.file.name.lastIndexOf('.') + 1); //get the file extension
        console.log(extention)

        if (extention == 'png' || extention == 'jpg' || extention == 'jpeg') {
            isValidFile.value = true
        } else {
            isValidFile.value = false
            return
        }
        fileDisplay.value = URL.createObjectURL(e.target.files[0])

        setTimeout(() => {
            document.getElementById('TextAreaSection').scrollIntoView({behavior: 'smooth'});
        }, 300);

   }

const cancelUploaded = () =>{
    fileDisplay.value = null;
    form.file = null;
    isValidFile.value = null;
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Tax Clearance Form</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's Tax Clearance form.
               
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
            

                <div  class="mb-2">
                    <div v-if="Array.isArray(certificate) && certificate.length == 0" class="flex items-center  w-full h-full overflow-hidden">
                        <div v-if="!fileDisplay" class="flex flex-col mx-auto items-start">
                            <label
                                for="file"
                                class="hover:bg-blue-700 bg-blue-500 rounded-lg p-2.5 text-white font-extrabold cursor-pointer"
                            >
                            Select From Computer
                            </label>
                            <input
                                id="file"
                                class="hidden"
                                type="file"
                                @input="getUploadedImage($event)"
                            >
                                <div v-if="error && error.file" class="text-red-500 text-center p-2 font-extrabold">{{ error.file }}</div>
                                    <div v-if="!fileDisplay && isValidFile === false" class="text-red-500 text-center p-2 font-extrabold">
                                        File not accepted
                                    </div>
                                </div>
                                <img v-if="fileDisplay && isValidFile === true" class=" min-w-[200px] p-4 mx-auto" :src="fileDisplay">
                        </div>
                        <div v-else class=" items-center  w-full h-full overflow-hidden">
                       
                            <img  class=" min-w-[200px] p-4 mx-auto" :src="certificate[0].file">
                            <Link :href="route('supplier.taxClearance.destory', certificate[0].id)" method="delete" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"  >Delete certificate</Link>
                            
                        </div>
                        
                    </div>
                    
                
                 </div>

            
                <div   class="flex items-center gap-4">
                    <PrimaryButton @click="createFormFunc" v-if="fileDisplay && isValidFile === true"  :disabled="form.processing">Save</PrimaryButton>
                    <DangerButton @click="cancelUploaded()" v-if="fileDisplay && isValidFile === true"  :disabled="form.processing">Cancel</DangerButton>
                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            
        </form>
    </section>
</template>
