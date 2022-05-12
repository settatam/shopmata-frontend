<template>
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            class="fixed z-10 inset-0 overflow-y-auto "
            @close="closeModal"
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
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full sm:p-6"
                    >
                        <div>
                            <div class="flex justify-between ">
                                <div>
                                    <p class="text-2xl font-bold">
                                        Add New Lead
                                    </p>
                                </div>
                                <x-icon
                                    class="h-6 w-6 cursor-pointer"
                                    @click="closeModal"
                                />
                            </div>
                            <div class="mt-3 sm:mt-5">
                                <div class="flex required  mb-4">
                                    <div class="mr-2 w-full">
                                        <label
                                            class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                            for="country_id"
                                        >
                                            Description
                                        </label>
                                        <textarea
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            v-model="leadPayload.description"
                                            required
                                            name=""
                                            id=""
                                            cols="30"
                                            rows="3"
                                        ></textarea>

                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.description.$error"
                                        >
                                            {{
                                                v$.description.$errors[0]
                                                    .$message
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col lg:flex-row required  mb-4"
                                >
                                    <div class="mr-2 w-full">
                                        <label
                                            class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                        >
                                            Name
                                        </label>
                                        <input
                                            :class="{
                                                'border-red-600': v$.name.$error,
                                                'border-gray-300': !v$.name
                                                    .$error
                                            }"
                                            type="text"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder=""
                                            v-model="name"
                                            required
                                        />

                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.name.$error"
                                        >
                                            {{ v$.name.$errors[0].$message }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" flex justify-between">
                            <button
                                type="file"
                                @click="closeModal"
                                class=" rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                            >
                                Cancel
                            </button>
                            <button
                                type="button"
                                class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm flex"
                                @click="submit"
                            >
                                <LoadingSpinner v-if="loading" />
                                <span>{{ text }} </span>
                            </button>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref, reactive, computed } from 'vue'
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'
import { XIcon } from '@heroicons/vue/solid'
import useVuelidate from '@vuelidate/core'
import { required, helpers, numeric } from '@vuelidate/validators'
import LoadingSpinner from '../../../Components/LoadingSpinner.vue'

export default {
    props: ['store'],

    components: {
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        XIcon,
        LoadingSpinner
    },
    emits: [ 'close-modal'],
    setup (props, { emit }) {
        const open = ref(true)
        const text = ref('Save')
        const loading = ref(false)

        const leadPayload = reactive({
            description: '',
            name: '',
        })



        const closeModal = () => {
            open.value = false
            emit('close-modal', open.value)
        }

        const rules = computed(() => {
            return {
                description: {
                    required: helpers.withMessage(
                        'Enter a description',
                        required
                    )
                },
                name: {
                    required: helpers.withMessage('Enter a Name', required)
                },
            }
        })

        const v$ = useVuelidate(rules, leadPayload)


        function submit () {
            this.v$.$validate()
            loading.value = false
            text.value = 'Saving'
            axios
                .post(
                    `/admin/transactions/${transaction_id}/items`,
                    leadPayload
                )
                .then(res => {
                    loading.value = false
                    emit('it-added', res)
                    open.value = false
                    emit('close-modal', open.value)
                })
                .catch(err => (loading.value = true))
        }

        return {
            open,
            leadPayload,
            submit,
            v$,
            closeModal,
            countries,
            states,
            loading,
            text,
        }
    }
}
</script>
