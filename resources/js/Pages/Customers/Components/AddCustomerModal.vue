<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            class="fixed z-10 inset-0 overflow-y-auto"
            @close="open = false"
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
                        <div class="flex justify-between">
                            <div>
                                <p class="text-2xl font-bold">
                                    {{ title }} Personal Information
                                </p>
                            </div>
                            <x-icon
                                class="h-6 w-6 cursor-pointer"
                                @click="closeModal"
                            />
                        </div>
                        <div
                            class="border-t border-gray-300 mt-1.5 mb-6 -mx-6"
                        ></div>
                        <div class="mt-3 sm:mt-5">
                            <div class="required w-full mr-5 mt-4">
                                <label
                                    class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                >
                                    Full Name
                                </label>
                                <input
                                    type="text"
                                    id="fullName"
                                    name="fullName"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="personal_info.full_name"
                                />
                            </div>

                            <div class="required w-full mr-5 mt-5">
                                <label
                                    class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                >
                                    Email Address
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="personal_info.email"
                                />
                            </div>
                            <div class="required w-full mr-5 mt-5">
                                <label
                                    class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                >
                                    Phone Number
                                </label>
                                <input
                                    type="tel"
                                    id="tel"
                                    name="tel"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="personal_info.phone"
                                />
                            </div>
                            <div
                                class="border-t-2 border-gray-300 mt-6 mb-7 -mx-8"
                            ></div>
                            <h2 class="text-xl font-semibold">Address</h2>

                            <div class="required w-full mr-5 mt-4">
                                <label
                                    class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                >
                                    Full Name
                                </label>
                                <input
                                    type="text"
                                    id="fullName"
                                    name="fullName"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="address_info.full_name"
                                />
                            </div>

                            <div class="flex mt-4">
                                <div class="required w-full mr-5">
                                    <label
                                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                    >
                                        Address
                                    </label>
                                    <input
                                        type="text"
                                        id="address"
                                        name="address"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        required
                                        v-model="address_info.address"
                                    />
                                </div>
                                <div class="required w-full ml-5">
                                    <label
                                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                    >
                                        Apartment/Suite
                                    </label>
                                    <input
                                        type="text"
                                        id="apartment"
                                        name="apartment"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        required
                                        v-model="address_info.apartment"
                                    />
                                </div>
                            </div>
                            <div class="required w-full mr-5 mt-5">
                                <label
                                    class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                >
                                    Country
                                </label>
                                <select
                                    type="select"
                                    id="country"
                                    name="country"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="address_info.country_id"
                                >
                                    <option
                                        v-for="(country, index) in this
                                            .countries"
                                        :key="index"
                                        :value="country.id"
                                    >
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="flex mt-4">
                                <div class="required w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                    >
                                        State
                                    </label>
                                    <select
                                        type="select"
                                        id="state"
                                        name="state"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        required
                                        v-model="address_info.state_id"
                                    >
                                        <option value="">Choose a State</option>
                                        <option
                                            v-for="(
                                                state, index
                                            ) in country_state"
                                            :key="index"
                                            :value="state.id"
                                        >
                                            {{ state.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="required w-full ml-5">
                                    <label
                                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                    >
                                        City
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        required
                                        v-model="address_info.city"
                                    />
                                </div>

                                <div class="required w-full ml-5">
                                    <label
                                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                    >
                                        Zip/Postal Code
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        required
                                        v-model="address_info.zip"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between w-1/2 mx-auto mb-9">
                        <div class="">
                            <inertia-link href="/customers">
                                <button
                                    class="text-gray-400 bg-gray-100 border border-gray-400 rounded-md px-6 py-3"
                                >
                                    Cancel
                                </button>
                            </inertia-link>
                        </div>
                        <div class="">
                            <button
                                class="text-white bg-indigo-700 rounded-md px-8 py-3"
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
import { ref, reactive } from "vue";
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XIcon } from "@heroicons/vue/solid";
import { QuestionMarkCircleIcon } from "@heroicons/vue/outline";
import { Inertia } from "@inertiajs/inertia";

export default {
    emits: ["close"],
    props: ["title", "buttonMsg"],

    components: {
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        QuestionMarkCircleIcon,
        XIcon,
        TransitionRoot,
    },
    data() {
        return {
            states: this.states,
            notification: null,
            country_state: {},
            customer: {},
            personal_info: {
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
            },
            address_info: {
                first_name: "",
                last_name: "",
                address: "",
                apartment: "",
                city: "",
                state: "",
            },
            // last_name: this.last_name,
        };
    },
    methods: {
        closeModal() {
            this.open = false;
            this.$emit("close");
        },
    },
    mounted() {
        this.country_state = this.states;
    },
    watch: {
        "address_info.country_id"(newVal, oldVal) {
            //console.log(oldVal)
            axios.get(`/api/states?country_id=${newVal}`).then((res) => {
                this.country_state = res.data.data;
                console.log(this.country_state);
            });
        },
    },
    setup(props, context) {
        const open = ref(true);
        // const menu = {
        //     full: "",
        //     handle: "",
        // };

        function submit() {
            try {
                const customer = {
                    ...this.personal_info,
                    ...this.address_info,
                };
                Inertia.post("/customers", customer);
                context.emit("close");
            } catch (error) {
                console.log(error);
            }
        }

        return {
            open,
            // menu,
            submit,
        };
    },
};
</script>
