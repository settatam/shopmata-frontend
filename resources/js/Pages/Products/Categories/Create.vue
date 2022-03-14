<template>
    <app-layout>
        <div class="">
            <div class="md:px-8 px-4 lg:mx-auto">
                <nav class="flex mt-6" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center space-x-4">
                        <li>
                            <div>
                                <a
                                    href="/dashboard"
                                    class="text-gray-400 hover:text-gray-500"
                                >
                                    <HomeIcon
                                        class="flex-shrink-0 h-5 w-5"
                                        aria-hidden="true"
                                    />
                                    <span class="sr-only">Settings</span>
                                </a>
                            </div>
                        </li>
                        <li v-for="page in pages" :key="page.name">
                            <div class="flex items-center">
                                <ChevronRightIcon
                                    class="flex-shrink-0 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                                <a
                                    :href="page.href"
                                    class="ml-4 text-xm md:text-sm font-medium text-gray-500 hover:text-gray-700"
                                    :aria-current="
                                        page.current ? 'page' : undefined
                                    "
                                    >{{ page.name }}</a
                                >
                            </div>
                        </li>
                    </ol>
                </nav>
                <div
                    class="py-6 md:flex md:items-center md:justify-between lg:border-gray-200"
                >
                    <div class="flex-1 min-w-0">
                        <!-- Profile -->
                        <div class="flex items-center">
                            <div>
                                <div class="flex items-center px-0 lg:px-0">
                                    <h1
                                        class="text-lg md:text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate"
                                    >
                                        New Collections
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mt-6 md:flex space-x-3 md:mt-0 md:ml-4 justify-between hidden"
                    >
                        <inertia-link href="/categories">
                            <button
                                class="inline-flex items-center px-6 py-3 border border-cyan-600 shadow-sm rounded-md text-cyan-600 hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                            >
                                Cancel
                            </button>
                        </inertia-link>
                        <button
                            class="inline-flex items-center px-8 py-3 border border-transparent shadow-sm rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                            @click="submitForm()"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="mx-auto pb-5 md:by-10 px-4 sm:px-6 lg:px-8 flex md:flex-row flex-col md:justify-between"
        >
            <!-- Main -->
            <div class="w-full">
                <div class="bg-white flex flex-col px-4 py-8 md:p-8">
                    <p class="font-semibold text-lg">Collection Details</p>
                    <div class="mt-4">
                        <label for="name" class="block text-xs text-gray-700"
                            >Category Name</label
                        >
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input
                                type="text"
                                name="name"
                                class="block w-full pr-10 sm:text-sm rounded-md border-gray-300 border"
                                v-model="category.name"
                            />
                        </div>
                        <span
                            v-if="v$.category.name.$error"
                            class="text-red-400"
                        >
                            {{ v$.category.name.$errors[0].$message }}
                        </span>
                    </div>
                    <div class="mt-5">
                        <label
                            for="description"
                            class="block text-xs text-gray-700"
                            >Description</label
                        >
                        <textarea
                            class="shadow-sm block w-full sm:text-sm rounded-md h-40 border-gray-300 border"
                            rows="5"
                            v-model="category.description"
                        />
                    </div>
                    <span
                        v-if="v$.category.description.$error"
                        class="text-red-400"
                    >
                        {{ v$.category.description.$errors[0].$message }}
                    </span>
                    <div class="mt-9 hidden md:block">
                        <p class="font-semibold text-lg mb-4">Conditions</p>
                        <div class="flex justify-between">
                            <div class="flex flex-col w-3/10">
                                <label for="tag" class="text-gray-700 lg:mb-4"
                                    >Products must match:</label
                                >
                            </div>
                            <div class="flex flex-col w-3/10">
                                <label
                                    for="condition"
                                    class="text-gray-700 mt-0 md:mt-5 lg:mb-4 lg:mt-0"
                                    >all conditions</label
                                >
                            </div>

                            <div class="flex flex-col w-3.5/10">
                                <label
                                    for="condition"
                                    class="text-gray-700 mt-5 lg:mb-4 lg:mt-0"
                                    >any condition</label
                                >
                            </div>
                        </div>
                        <template
                            v-for="(condition, index) in conditions"
                            :key="index"
                        >
                            <div
                                class="flex flex-col lg:flex-row lg:justify-between"
                            >
                                <div class="flex flex-col w-3/10">
                                    <select
                                        name="conditions"
                                        id=""
                                        v-model="condition.tag"
                                        class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none text-xm"
                                    >
                                        <option
                                            v-for="(
                                                option, index
                                            ) in product_options"
                                            :key="index"
                                            v-bind:value="option.title"
                                        >
                                            {{ option.title }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex flex-col w-3/10">
                                    <select
                                        name="conditions"
                                        id=""
                                        v-model="condition.value"
                                        class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none text-xm"
                                    >
                                        <option
                                            v-for="(
                                                option, index
                                            ) in condition_options"
                                            :key="index"
                                            v-bind:value="option.title"
                                            class="text-gray-700', 'block px-4 py-2 text-sm"
                                        >
                                            {{ option.title }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex flex-col w-3.5/10 mb-2">
                                    <input
                                        type="text"
                                        class="w-full text-xs py-1.5 sm:text-sm rounded-md border-gray-300"
                                        v-model="condition.condition"
                                    />
                                </div>
                            </div>
                        </template>

                        <button
                            class="text-indigo-700 sm:text-sm rounded-md border border-indigo-700 text-xs mb-5 pl-3 pr-6 py-2.5 mt-4"
                            @click="add"
                        >
                            Add another condition
                        </button>
                    </div>
                    <div class="mt-4 md:hidden">
                        <p>Conditions</p>
                        <template
                            v-for="(condition, index) in conditions"
                            :key="index"
                        >
                            <div
                                class="flex text-xm justify-between w-full gap-x-5 my-2"
                            >
                                <div class="flex flex-col w-full">
                                    <label
                                        for="product_condition"
                                        class="text-gray-700"
                                        >Products must match:</label
                                    >
                                    <select
                                        name="product_condition"
                                        v-model="condition.tag"
                                        class="rounded-md border border-gray-300 shadow-sm px-3 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none text-xm"
                                    >
                                        <option
                                            v-for="(
                                                option, index
                                            ) in product_options"
                                            :key="index"
                                            v-bind:value="option.title"
                                        >
                                            {{ option.title }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex flex-col w-full">
                                    <label
                                        for="all_condition"
                                        class="text-gray-700"
                                        >all conditions</label
                                    >
                                    <select
                                        name="all_conditions"
                                        v-model="condition.tag"
                                        class="rounded-md border border-gray-300 shadow-sm px-3 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none text-xm"
                                    >
                                        <option
                                            v-for="(
                                                option, index
                                            ) in product_options"
                                            :key="index"
                                            v-bind:value="option.title"
                                        >
                                            {{ option.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col text-xm">
                                <label for="any_condition" class="text-gray-700"
                                    >any conditions</label
                                >
                                <input
                                    type="text"
                                    class="w-full text-xs py-1.5 sm:text-sm rounded-md border-gray-300"
                                    v-model="condition.condition"
                                />
                            </div>
                        </template>
                        <button
                            class="text-indigo-700 sm:text-sm rounded-md border border-indigo-700 text-xs mb-5 pl-3 pr-6 py-2.5 mt-4"
                            @click="add"
                        >
                            Add another condition
                        </button>
                    </div>
                </div>
                <div
                    class="flex flex-col md:hidden md:ml-4 mt-4.5 md:mt-0 md:max-w-sm gap-y-4 w-full"
                >
                    <div class="bg-white px-5 pt-4 pb-3 rounded-sm">
                        <p class="font-semibold">Collection image</p>
                        <drop-zone class="mt-3"></drop-zone>
                    </div>
                    <div class="bg-white px-5 py-4 md:my-4 rounded-sm">
                        <p class="font-semibold mt-2">Collection theme</p>
                        <p class="text-xs mt-1">Theme template</p>
                        <cat-drop-down
                            :label="theme_template"
                            :options="template_opt"
                            class="w-full"
                        />
                        <p class="text-xm text-gray-500 mt-2">
                            Assign a template from your current theme to define
                            how the collection is displayed.
                        </p>
                    </div>
                </div>
                <!-- <div class="bg-white flex flex-col mt-4 p-8">
                    <div class="flex justify-between" @click="toggle = !toggle">
                        <p class="font-semibold text-lg">
                            Search Engine Listing Preview
                        </p>
                        <ChevronUpIcon class="h-5 my-auto" v-if="toggle" />
                        <ChevronDownIcon class="h-5 my-auto" v-if="!toggle" />
                    </div>
                    <div v-if="toggle" class="mt-7">
                        <p class="text-gray-700">
                            Add a title and description to see how this product
                            might appear in a search engine listing
                        </p>
                        <div class="mt-8">
                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700"
                                >Page Title</label
                            >
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="
                                        block
                                        w-full
                                        pr-10
                                        sm:text-sm
                                        rounded-md
                                        border-gray-300
                                    "
                                    :class="
                                        page.page_title.length > 70
                                            ? '[border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500]'
                                            : ''
                                    "
                                    v-model="page.page_title"
                                />
                                <div
                                    class="
                                        absolute
                                        inset-y-0
                                        right-0
                                        pr-3
                                        flex
                                        items-center
                                        pointer-events-none
                                    "
                                    v-if="page.page_title.length > 70"
                                >
                                    <ExclamationCircleIcon
                                        class="h-5 w-5 text-red-500"
                                        aria-hidden="true"
                                    />
                                </div>
                            </div>
                            <p class="text-gray-500">
                                {{ page.page_title.length }} of 70 characters
                                used
                            </p>
                            <p class="mt-2 text-sm text-red-600" id="title-error" v-if="(page.title.length > 70)">Your title must be less than 70 characters.</p>
                            <span
                                v-if="v$.page.page_title.$error"
                                class="text-red-400"
                            >
                                {{ v$.page.title.$errors[0].$message }}
                            </span>
                        </div>
                        <div class="mt-9">
                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700"
                                >Description</label
                            >
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="
                                        block
                                        w-full
                                        pr-10
                                        sm:text-sm
                                        rounded-md
                                        border-gray-300
                                    "
                                    :class="
                                        page.description.length > 70
                                            ? '[border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500]'
                                            : ''
                                    "
                                    v-model="page.description"
                                />
                                <div
                                    class="
                                        absolute
                                        inset-y-0
                                        right-0
                                        pr-3
                                        flex
                                        items-center
                                        pointer-events-none
                                    "
                                    v-if="page.description.length > 70"
                                >
                                    <ExclamationCircleIcon
                                        class="h-5 w-5 text-red-500"
                                        aria-hidden="true"
                                    />
                                </div>
                            </div>
                            <p class="text-gray-500">
                                {{ page.description.length }} of 70 characters
                                used
                            </p>
                            <p class="mt-2 text-sm text-red-600" id="title-error" v-if="(page.description.length > 70)">Your description must be less than 70 characters.</p>
                            <span
                                v-if="v$.page.description.$error"
                                class="text-red-400"
                            >
                                {{ v$.page.description.$errors[0].$message }}
                            </span>
                        </div>
                        <div class="mt-9">
                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700"
                                >URL and Handle</label
                            >
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input
                                    type="text"
                                    name="url"
                                    id="title"
                                    class="
                                        block
                                        w-full
                                        pr-10
                                        sm:text-sm
                                        rounded-md
                                        border-gray-300
                                        placeholder-gray-500
                                    "
                                    v-model="page.handle"
                                    placeholder="https://www.cashinmybag.com/products/"
                                />
                            </div>
                            <span
                                v-if="v$.page.handle.$error"
                                class="text-red-400"
                            >
                                {{ v$.page.handle.$errors[0].$message }}
                            </span>
                        </div>
                    </div>
                </div> -->
                <div
                    class="mt-6 sticky bottom-0 md:static flex space-x-3 justify-between bg-gray-100 p-2"
                >
                    <inertia-link href="/categories">
                        <button
                            class="inline-flex items-center md:px-6 md:py-3 px-4 py-2 border border-cyan-600 shadow-sm rounded-md text-cyan-600 hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                        >
                            Cancel
                        </button>
                    </inertia-link>
                    <button
                        class="inline-flex items-center md:px-8 md:py-3 px-4 py-2 border border-transparent shadow-sm rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                        @click="submitForm()"
                        :disabled="v$.$error || submitting"
                        :class="{
                            disabled: v$.$error || submitting,
                            'opacity-25 cursor-not-allowed':
                                v$.$error || submitting,
                        }"
                    >
                        Save
                    </button>
                </div>
            </div>
            <!-- Sidebar -->
            <div
                class="md:flex hidden flex-col md:ml-4 mt-4.5 md:mt-0 md:max-w-sm gap-y-4 w-full"
            >
                <div class="bg-white px-5 pt-4 pb-3 rounded-sm">
                    <p class="font-semibold">Collection image</p>
                    <drop-zone class="mt-3"></drop-zone>
                </div>
                <div class="bg-white px-5 py-4 md:my-4 rounded-sm">
                    <p class="font-semibold mt-2">Collection theme</p>
                    <p class="text-xs mt-1">Theme template</p>
                    <cat-drop-down
                        :label="theme_template"
                        :options="template_opt"
                        class="w-full"
                    />
                    <p class="text-xm text-gray-500 mt-2">
                        Assign a template from your current theme to define how
                        the collection is displayed.
                    </p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref, reactive } from "vue";
import AppLayout from "../../../Layouts/AppLayout.vue";
import DropZone from "./Components/Dropzone.vue";
import CatDropDown from "./Components/CatDropdown.vue";
import Condition from "./Components/Condition.vue";
import {
    ChevronUpIcon,
    ChevronDownIcon,
    ExclamationCircleIcon,
    SelectorIcon,
    ChevronRightIcon,
} from "@heroicons/vue/solid";
import useVuelidate from "@vuelidate/core";
import { HomeIcon } from "@heroicons/vue/outline";
import { required, maxLength, url, helpers } from "@vuelidate/validators";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";

const pages = [
    { name: "All Collections", href: "/categories", current: false },
    { name: "Create Collection", href: "/categories/create", current: true },
];
export default {
    props: {
        product_options: Array,
        condition_options: Array,
    },
    data: function () {
        return {
            submitting: false,
            v$: useVuelidate(),
            theme_template: "Default Collection",
            conditions: [
                {
                    tag: "Product Title",
                    condition: "",
                    value: "value",
                },
            ],
            template_opt: {
                product_title: {
                    text: "Product Title",
                    value: "Product Title",
                },
                product_type: {
                    text: "Product Type",
                    value: "Product Type",
                },
                product_price: {
                    text: "Product Price",
                    value: "Product Price",
                },
                product_tag: {
                    text: "Product Tag",
                    value: "Product Tag",
                },
                weight: {
                    text: "Weight",
                    value: "Weight",
                },
            },
            condition_opt: {
                equal: {
                    text: "is equal to",
                    value: "equal",
                },
                greater: {
                    text: "is greater that",
                    value: "greater",
                },
                less: {
                    text: "is less than",
                    value: "less",
                },
            },
            product_tag: "Product tag",
            condition_label: "is equal to",
            toggle: true,
            page: {
                description: "",
                page_title: "",
                handle: "",
            },
            category: {
                name: "",
                description: "",
            },
        };
    },
    components: {
        AppLayout,
        DropZone,
        CatDropDown,
        ChevronUpIcon,
        ChevronDownIcon,
        ExclamationCircleIcon,
        SelectorIcon,
        Condition,
        HomeIcon,
        ChevronRightIcon,
    },
    computed: {
        formData() {
            return { ...this.category, ...this.page };
        },
    },
    methods: {
        submitForm() {
            this.v$.$validate();
            if (!this.v$.$error) {
                return;
            }
            axios
                .post("/collections", {
                    conditions: this.conditions.map((condition) => ({
                        attribute: condition.tag,
                        condition: condition.value,
                        value: condition.condition,
                    })),
                    ...this.category
                })
                .then((response) => {
                    Inertia.visit("/categories", {
                        method: "get",
                    });
                })
                .catch((error) => {
                    console.log(error.response.data);
                    if (error.response.data.errors) {
                        errors.value = error.response.data.errors;
                    }
                })
                .finally(() => {
                    this.submitting = false;
                });
            console.log(this.formData);

            // }
        },
        updateTemp(val) {
            //console.log(val)
            this.conditions.tag = val;
            //console.log(this.conditions.tag)
        },
        updateCondition(val) {
            this.conditions.value = val;
            //console.log(this.conditions.equal)
        },
        add() {
            this.conditions.push({
                tag: "",
                condition: "",
                value: "",
            });
        },
    },

    validations() {
        return {
            page: {
                description: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                    maxLength: maxLength(70),
                },
                page_title: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                    maxLength: maxLength(70),
                },
                handle: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                    url,
                },
            },
            category: {
                name: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                },
                description: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                },
            },
            conditions: {
                $each: helpers.forEach({
                    tag: {
                        required,
                    },
                    condition: {
                        required,
                    },
                    value: {
                        required,
                    },
                }),
            },
        };
    },

    setup() {
        return {
            pages,
        };
    },
};
</script>
<style scoped>
tbody tr:hover {
    background: transparent;
}
</style>
