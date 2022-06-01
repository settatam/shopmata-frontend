<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="closeModal()">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0"
                    enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div class="mt-3">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="flex flex-row justify-between">
                                    <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                                        Bin Location
                                    </DialogTitle>

                                    <x-icon class="h-6 w-6 cursor-pointer" @click="closeModal" />
                                </div>

                                <div class="mt-8 w-full">
                                    <input type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" required v-model="bin_location" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-4">
                            <button :disabled="loading" type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg:purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:purple-darken sm:ml-3 sm:w-auto sm:text-sm"
                                @click="closeModal()">

                                Cancel
                            </button>

                            <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-8 py-2 bg-indigo-600  text-base font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                @click="saveDetails()">
                                <LoadingSpinner v-if="loading" />
                                Ok
                            </button>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref, useContext } from 'vue'
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/solid'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'
import LoadingSpinner from '../Components/LoadingSpinner.vue'


export default {
    emits: ['close', 'send'],
    props: [''],
    components: {
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        LoadingSpinner,
        XIcon
    },
    setup(props, { emit }) {
        const open = ref(true)
        const loading = ref(false)
        const bin_location = ref("")

        function saveDetails() {
            emit('send', bin_location.value)
        }

        function closeModal() {
            open.value = false
            emit('close', open.value)
        }

        return {
            open,
            closeModal,
            loading,
            bin_location,
            saveDetails
        }


    }


}
</script>
