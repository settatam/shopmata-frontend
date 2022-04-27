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
                                        Add Items
                                    </p>
                                </div>
                                <x-icon
                                    class="h-6 w-6 cursor-pointer"
                                    @click="closeModal"
                                />
                            </div>
                            <div class="mt-3 sm:mt-5">
                                <div class=" required w-full mb-4">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Choose Category
                                    </label>
                                    <select
                                        :class="{
                                            'border-red-600':
                                                v$.category_id.$error,
                                            'border-gray-300': !v$.category_id
                                                .$error
                                        }"
                                        name=""
                                        id=""
                                        v-model="category_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                    >
                                        <option default value="0"
                                            >Choose Category</option
                                        >
                                        <option
                                            :value="category.id"
                                            v-for="category in categories"
                                            :key="category.index"
                                            >{{ category.name }}</option
                                        >
                                    </select>

                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.category_id.$error"
                                    >
                                        {{ v$.category_id.$errors[0].$message }}
                                    </p>
                                </div>

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
                                            v-model="itemPayload.description"
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
                                            DWT
                                        </label>
                                        <input
                                            :class="{
                                                'border-red-600': v$.dwt.$error,
                                                'border-gray-300': !v$.dwt
                                                    .$error
                                            }"
                                            type="text"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder=""
                                            v-model="dwt"
                                            required
                                        />

                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.dwt.$error"
                                        >
                                            {{ v$.dwt.$errors[0].$message }}
                                        </p>
                                    </div>

                                    <div class="lg:ml-2 w-full lg:mt-0 mt-4">
                                        <label
                                            class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                        >
                                            m-pRICE
                                        </label>
                                        <input
                                            :class="{
                                                'border-red-600':
                                                    v$.price.$error,
                                                'border-gray-300': !v$.price
                                                    .$error
                                            }"
                                            type="text"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder=""
                                            v-model="itemPayload.price"
                                            required
                                        />
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.price.$error"
                                        >
                                            {{ v$.price.$errors[0].$message }}
                                        </p>
                                    </div>
                                </div>
                                <div class=" required w-full mb-4">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        iNote
                                    </label>
                                    <input
                                        :class="{
                                            'border-red-600': v$.inote.$error,
                                            'border-gray-300': !v$.inote.$error
                                        }"
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        v-model="itemPayload.inote"
                                        required
                                    />
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.inote.$error"
                                    >
                                        {{ v$.inote.$errors[0].$message }}
                                    </p>
                                </div>

                                <div
                                    class="required w-full mb-4"
                                >
                                    <!-- <button
                                        class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                                    >
                                        <span class="ml-2"
                                            >Click to upload files</span
                                        >
                                    </button>
                                    <input
                                        class="cursor-pointer absolute block opacity-0 pin-r pin-t"
                                        type="file"
                                        multiple
                                    /> -->

                                    <AddItemDropzone
                                        @add-image="onAddImage"
                                        class=""
                                    />
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
                                class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                                @click="submit"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref, reactive, computed, watch } from 'vue'
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
import debounce from 'lodash/debounce'

import AddItemDropzone from '../Components/AddItemDropzone.vue'

export default {
    emits: ['close'],
    props: ['store', 'countries', 'categories', 'root'],

    components: {
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        XIcon,
        AddItemDropzone
    },emits: ['return-response','close-modal'],
    setup (props, { emit }) {
        const open = ref(true)
        const countries = reactive([{}])
        const states = reactive([{}])
        const transaction_id = props.root.id
        const dwt = ref('')
        const category_id = ref('')
        const images = ref([])

        const itemPayload = reactive({
            category_id: category_id,
            description: '',
            dwt: dwt,
            price: '',
            inote: '',
            images: images,
            transaction_id: transaction_id
        })

        watch(
            [dwt, category_id],
            debounce(function () {
                if (dwt != '' && category_id != '') {
                    axios.post(`/admin/transactions/${transaction_id}/dwt`, {
                        dwt: dwt.value,
                        category_id: category_id.value
                    })
                    .then(res => itemPayload.price = res.data.price)
                }
            }, 2000)
        )

        const closeModal = () => {
            open.value = false;
            emit('close-modal', open.value)
            // ctx.emit('close')
        }

        const rules = computed(() => {
            return {
                category_id: {
                    required: helpers.withMessage('Select a category', required)
                },
                description: {
                    required: helpers.withMessage(
                        'Enter a description',
                        required
                    )
                },
                dwt: {
                    required: helpers.withMessage('Enter a DWT', required)
                },
                price: {
                    required: helpers.withMessage('Enter an mprice', required)
                },
                inote: {
                    required: helpers.withMessage('Enter an inote', required)
                }
            }
        })

        const v$ = useVuelidate(rules, itemPayload)

        function onAddImage (response) {
            images.value = response.data
        }

        function submit () {
            this.v$.$validate()
            axios
                .post(`/admin/transactions/${transaction_id}/items`, itemPayload)
                .then(res => {
                    // console.log(res)
                    emit('return-response', res)
                    open.value = false
                    // Inertia.visit(`/admin/transactions/${transaction_id}`)
                })
        }

        return {
            open,
            itemPayload,
            submit,
            v$,
            closeModal,
            countries,
            states,
            dwt,
            category_id,
            onAddImage,
            images

        }
    }
}
</script>
