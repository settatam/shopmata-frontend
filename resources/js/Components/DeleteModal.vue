<template>
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            class="fixed z-10 inset-0 overflow-y-auto"
            @close="closeModal()"
        >
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                    >
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                            >
                                <ExclamationIcon
                                    class="h-6 w-6 text-red-600"
                                    aria-hidden="true"
                                />
                            </div>
                            <div
                                class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Delete
                                </DialogTitle>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Confirm deletion of
                                        {{
                                            checkedTransactions.length
                                        }}
                                        transaction(s) ?
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button
                                type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                @click="deleteTransactions()"
                            >
                                <LoadingSpinner v-if="loading" />
                                {{ deleteMessage }}
                                {{ checkedTransactions.length }}
                            </button>
                            <button
                                type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                @click="closeModal()"
                                ref="cancelButtonRef"
                            >
                                Cancel
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
import { ExclamationIcon } from '@heroicons/vue/outline'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'
import notification from '../Utils/notification'
import LoadingSpinner from '../Components/LoadingSpinner.vue'

export default {
    emits: ['close'],
    props: ['id', 'msg', 'checkedTransactions', 'deleteProps'],
    components: {
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        ExclamationIcon,
        LoadingSpinner
    },
    setup (props, { emit }) {
        const { onClickTop, onClickBot } = notification()
        const open = ref(true)
        const successMessage = ref('')
        const checkedTransactions = props.checkedTransactions
        const deleteProps = props.deleteProps
        const loading = ref(false)
        const deleteMessage = ref('Delete')

        function deleteTransactions () {
            axios
                .post(deleteProps.url, {
                    transaction_ids: checkedTransactions
                })
                .then(res => {
                    deleteMessage.value == 'Deleting '
                    loading.value = false
                    // transactionItems.value = res.data.items
                    successMessage.value = 'Item deleted'
                    setTimeout(onClickTop(successMessage.value), 2000)
                })
                .catch(error => {
                    loading.value = false
                    open.value = false
                    emit('close', open.value)
                    successMessage.value = 'Error processing your request'
                    setTimeout(onClickBot(successMessage.value), 2000)
                })
        }

        function closeModal () {
            open.value = false
            emit('close', open.value)
        }

        return {
            open,
            closeModal,
            deleteTransactions,
            checkedTransactions,
            deleteProps,
            deleteMessage
        }
    }
}
</script>
