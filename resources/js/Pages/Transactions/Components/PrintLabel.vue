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
                                        Kit Assembly Checklist
                                        <span class="text-purple-darken"
                                            >Order #{{
                                                transaction.id
                                            }}</span
                                        >
                                    </p>
                                </div>
                                <x-icon
                                    class="h-6 w-6 cursor-pointer"
                                    @click="closeModal"
                                />
                            </div>
                            <div class="mt-3 sm:mt-5">
                                <!-- print label -->
                                <div
                                    class="flex flex-row w-full mb-4 space-x-2"
                                >
                                    <p class="py-1">Print Label:</p>
                                    <input
                                        class="mt-2 py-1"
                                        type="checkbox"
                                        name="ground"
                                        id="ground"
                                    />
                                    <label class="py-1" for="ground"
                                        >Ground?</label
                                    >

                                    <div
                                        class="space-x-2 flex flex-col lg:flex-row"
                                    >
                                        <button
                                            class="bg-gray-background px-2 py-1"
                                        >
                                            From Seller
                                        </button>
                                        <button
                                            class="bg-gray-background lg:mt-0 mt-2 px-2 py-1"
                                        >
                                            To Seller
                                        </button>
                                    </div>
                                </div>

                                <!-- print label ends -->

                                <!-- print barcode start -->

                                <div
                                    class="flex flex-row w-full mb-4 space-x-2"
                                >
                                    <label class="py-1" for="ground"
                                        >Print Barcode:</label
                                    >

                                    <button
                                        class="bg-gray-background px-2 py-1"
                                    >
                                        To Seller
                                    </button>
                                </div>

                                <!-- proint barcode ends -->

                                <h2 class="mb-4 font-bold">
                                    Check off each item as you complete it:
                                    <span
                                        class="text-purple-darken cursor-pointer"
                                        @click="checkAll()"
                                        >Check All</span
                                    >
                                </h2>

                                <!-- checkboxes-->

                                <div class="mb-4 w-full">
                                    <div
                                        class="flex flex-row w-full mb-2 p-2 bg-gray-background"
                                    >
                                        <input
                                            :checked="isChecked"
                                            class="mt-2 py-1"
                                            type="checkbox"
                                            name="fromseller"
                                            id="fromseller"
                                        />
                                        <label
                                            class="py-1 px-2"
                                            for="fromseller"
                                            >From Seller Label printed &
                                            attached to kit return
                                            package</label
                                        >
                                    </div>

                                    <div
                                        class="flex flex-row w-full mb-2 p-2 bg-gray-background"
                                    >
                                        <input
                                            :checked="isChecked"
                                            class="mt-2 py-1"
                                            type="checkbox"
                                            name="toseller"
                                            id="toseller"
                                        />
                                        <label class="py-1 px-2" for="toseller"
                                            >To Seller Label printed & attached
                                            to shipping kit package</label
                                        >
                                    </div>

                                    <div
                                        class="flex flex-row w-full mb-2 p-2 bg-gray-background"
                                    >
                                        <input
                                            :checked="isChecked"
                                            class="mt-2 py-1"
                                            type="checkbox"
                                            name="barcodesprinted"
                                            id="barcodesprinted"
                                        />
                                        <label
                                            class="py-1 px-2"
                                            for="barcodesprinted"
                                            >Barcodes printed & attached to kit
                                            envelopes</label
                                        >
                                    </div>

                                    <div
                                        class="flex flex-row w-full mb-2 p-2 bg-gray-background"
                                    >
                                        <input
                                            :checked="isChecked"
                                            class="mt-2 py-1"
                                            type="checkbox"
                                            name="packagecontent"
                                            id="packagecontent"
                                        />
                                        <label
                                            class="py-1 px-2"
                                            for="packagecontent"
                                            >Package Contents Verified &
                                            Assembled</label
                                        >
                                    </div>

                                    <div
                                        class="flex flex-row w-full mb-2 p-2 bg-gray-background"
                                    >
                                        <input
                                            :checked="isChecked"
                                            class="mt-2 py-1"
                                            type="checkbox"
                                            name="kitsent"
                                            id="kitsent"
                                        />
                                        <label class="py-1 px-2" for="kitsent"
                                            >Shipping kit sent to shipping
                                            carrier</label
                                        >
                                    </div>
                                </div>
                                <!-- checkboxes ends -->

                                <div class="w-full mb-4">
                                    <p class="font-bold">
                                        You must check off each item on this
                                        checklist before the order can be marked
                                        as shipped.
                                    </p>
                                </div>

                                <div
                                    class="required w-full mb-4 flex justify-start"
                                >
                                    <button
                                        class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                                    >
                                        <span class="">Mark as shipped</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref, reactive, computed } from 'vue'
import { XIcon } from '@heroicons/vue/solid'
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'
import useVuelidate from '@vuelidate/core'
import { required, helpers } from '@vuelidate/validators'
export default {
    emits: ['close'],
    props: ['transaction'],
    components: {
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        XIcon
    },
    setup (props, ctx) {
        const open = ref(true)
        const countries = reactive([{}])
        const states = reactive([{}])
        const isChecked = ref(false)
        const local_pickup = reactive({
            category: '',
            description: '',
            dwt: '',
            mprice: '',
            inote: ''
        })
        function checkAll () {
            isChecked.value = true
        }
        const closeModal = () => {
            open.value = false
            ctx.emit('close')
        }
        const rules = computed(() => {
            return {
                category: {
                    required: helpers.withMessage('Enter a category', required)
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
                mprice: {
                    required: helpers.withMessage('Enter an mprice', required)
                },
                city: {
                    required: helpers.withMessage('Enter a city name', required)
                },
                inote: {
                    required: helpers.withMessage('Enter an inote', required)
                }
            }
        })
        const v$ = useVuelidate(rules, local_pickup)
        function submit () {
            this.v$.$validate()
            if (local_pickup.address.length < 1) {
                return
            } else {
                axios
                    .post('/', local_pickup)
                    .then(res => {
                        //console.log(res.data)
                        this.open = false
                        Inertia.visit('/settings/shipping-and-delivery')
                    })
            }
        }
        return {
            open,
            local_pickup,
            submit,
            v$,
            closeModal,
            countries,
            states,
            isChecked,
            checkAll
        }
    }
}
</script>
