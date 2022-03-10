<template>
    <app-layout>
        <div class="">
            <div class="px-4 sm:px-6 lg:mx-auto lg:px-8">
                <div
                    class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200"
                >
                    <div class="flex-1 min-w-0">
                        <!-- Profile -->
                        <div class="flex items-center">
                            <div>
                                <div class="flex items-center">
                                    <h1
                                        class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate"
                                    >
                                        New Collections
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mt-6 flex space-x-3 md:mt-0 md:ml-4 justify-between"
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
        <div class="flex flex-col lg:grid lg:grid-cols-5 lg:gap-x-5 mx-5">
            <!-- Main -->
            <div class="col-start-1 col-span-3">
                <div class="bg-white flex flex-col p-8">
                    <p class="font-semibold">Collection Details</p>
                    <div class="mt-4">
                        <label for="name" class="block text-sm text-gray-700"
                            >Category Name</label
                        >
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input
                                type="text"
                                name="name"
                                class="block w-full pr-10 sm:text-sm rounded-md"
                                :class="
                                    v$.collection.name.$error
                                        ? 'border-2 border-red-500'
                                        : 'border-gray-300 border'
                                "
                                v-model="collection.name"
                            />
                        </div>
                        <span
                            v-if="v$.collection.name.$error"
                            class="text-red-400"
                        >
                            {{ v$.collection.name.$errors[0].$message }}
                        </span>
                    </div>
                    <div class="mt-5">
                        <label
                            for="description"
                            class="block text-sm text-gray-700"
                            >Description</label
                        >
                        <textarea
                            class="shadow-sm block w-full sm:text-sm rounded-md h-40"
                            :class="
                                v$.collection.description.$error
                                    ? 'border-2 border-red-500'
                                    : 'border-gray-300 border'
                            "
                            rows="5"
                            v-model="collection.description"
                        />
                    </div>
                    <span
                        v-if="v$.collection.description.$error"
                        class="text-red-400"
                    >
                        {{ v$.collection.description.$errors[0].$message }}
                    </span>
                    <div class="mt-9">
                        <p class="font-semibold text-lg mb-4">Condition</p>
                        <div
                            class="flex flex-col lg:flex-row lg:justify-between"
                        >
                            <div class="flex flex-col w-3/10">
                                <label for="tag" class="text-gray-700 lg:mb-4"
                                    >Products must match:</label
                                >
                            </div>
                            <div class="flex flex-col w-3/10">
                                <label
                                    for="condition"
                                    class="text-gray-700 mt-5 lg:mb-4 lg:mt-0"
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
                                    <!-- <cat-drop-down
                                    :label="product_tag"
                                    :options="template_opt"
                                    @updateVal="updateTemp($event)"
                                    class="h-5"
                                    v-model="category.tag"
                                /> -->
                                    <select
                                        name="conditions"
                                        id=""
                                        v-model="condition.tag"
                                        class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none text-xm"
                                    >
                                        <option
                                            v-for="(
                                                option, index
                                            ) in template_opt"
                                            :key="index"
                                            v-bind:value="option.value"
                                        >
                                            {{ option.text }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex flex-col w-3/10">
                                    <!-- <cat-drop-down
                                    :label="condition_label"
                                    :options="condition_opt"
                                    @updateVal ="updateCondition($event)"
                                    class="h-5"
                                    v-model="category.equal"
                                /> -->
                                    <select
                                        name="conditions"
                                        id=""
                                        v-model="condition.equal"
                                        class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none text-xm"
                                    >
                                        <option
                                            v-for="(
                                                option, index
                                            ) in condition_opt"
                                            :key="index"
                                            v-bind:value="option.value"
                                            class="text-gray-700', 'block px-4 py-2 text-sm"
                                        >
                                            {{ option.text }}
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
                            class="text-gray-700 sm:text-sm rounded-md border border-gray-300 text-xs mb-5 pl-3 pr-6 py-2.5 mt-4"
                            @click="add"
                        >
                            Add another condition
                        </button>
                    </div>
                </div>
                <div class="bg-white flex flex-col mt-4 p-8">
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
                                    class="block w-full pr-10 sm:text-sm rounded-md border-gray-300"
                                    :class="
                                        page.seo_title.length > 70
                                            ? '[border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500]'
                                            : ''
                                    "
                                    v-model="page.seo_title"
                                />
                                <div
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                    v-if="page.seo_title.length > 70"
                                >
                                    <ExclamationCircleIcon
                                        class="h-5 w-5 text-red-500"
                                        aria-hidden="true"
                                    />
                                </div>
                            </div>
                            <p class="text-gray-500">
                                {{ page.seo_title.length }} of 70 characters used
                            </p>
                            <!-- <p class="mt-2 text-sm text-red-600" id="seo_title-error" v-if="(page.seo_title.length > 70)">Your seo_title must be less than 70 characters.</p> -->
                            <span
                                v-if="v$.page.seo_title.$error"
                                class="text-red-400"
                            >
                                {{ v$.page.seo_title.$errors[0].$message }}
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
                                    class="block w-full pr-10 sm:text-sm rounded-md border-gray-300"
                                    :class="
                                        page.seo_description.length > 70
                                            ? '[border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500]'
                                            : ''
                                    "
                                    v-model="page.seo_description"
                                />
                                <div
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                    v-if="page.seo_description.length > 70"
                                >
                                    <ExclamationCircleIcon
                                        class="h-5 w-5 text-red-500"
                                        aria-hidden="true"
                                    />
                                </div>
                            </div>
                            <p class="text-gray-500">
                                {{ page.seo_description.length }} of 70 characters
                                used
                            </p>
                            <!-- <p class="mt-2 text-sm text-red-600" id="title-error" v-if="(page.seo_description.length > 70)">Your seo_description must be less than 70 characters.</p> -->
                            <span
                                v-if="v$.page.seo_description.$error"
                                class="text-red-400"
                            >
                                {{ v$.page.seo_description.$errors[0].$message }}
                            </span>
                        </div>
                        <div class="mb-6 mt-9">
                            <label
                                class="block text-gray-600 mb-2 bg-transparent"
                                for="url_handle"
                            >
                                URL and handle
                            </label>
                            <div
                                class="mt-1 relative rounded-md shadow-sm"
                            >
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                >
                                                <span
                                                    class="text-gray-500 sm:text-sm"
                                                    ref="domain_name"
                                                >
                                                    {{ store.domains[0].name }}/
                                                </span>
                                </div>
                                <input
                                    type="text"
                                    :style="{
                                                    paddingLeft: domainWidth,
                                                }"
                                    name="handle"
                                    id="handle"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    aria-describedby="price-currency"
                                    v-model="page.url"
                                />
                            </div>
                            <div class="mt-1">
                                <p
                                    class="text-red-600 text-xs"
                                    v-if="v$.page.url.$error"
                                >
                                    {{ v$.page.url.$errors[0].$message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex space-x-3 justify-between">
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
                        Update
                    </button>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="lg:col-start-4 lg:col-span-1">
                <div class="bg-white px-5 pt-4 pb-3">
                    <p class="font-semibold">Collection image</p>
                    <drop-zone class="mt-3"></drop-zone>
                </div>
                <div class="bg-white px-5 py-4 my-4">
                    <p class="font-semibold mt-2">Collection image</p>
                    <p class="text-xs mt-1">Theme template</p>
                    <cat-drop-down
                        :label="theme_template"
                        :options="template_opt"
                    />
                    <p class="text-xxs text-gray-500 mt-2">
                        Assign a template from your current theme to define how
                        the collection is displayed.
                    </p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout.vue";
import DropZone from "./Components/Dropzone.vue";
import CatDropDown from "./Components/CatDropdown.vue";
import Condition from "./Components/Condition.vue";
import {
    ChevronUpIcon,
    ChevronDownIcon,
    ExclamationCircleIcon,
    SelectorIcon,
} from "@heroicons/vue/solid";
import useVuelidate from "@vuelidate/core";
import { required, maxLength, url, helpers } from "@vuelidate/validators";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        category: Object,
        store: Object
    },
    mounted() {
        this.domainWidth = this.$refs.domain_name.clientWidth + 10 + "px";
        this.conditions = JSON.parse(this.category.conditions).map(
            (condition) => ({
                tag: condition.attribute,
                condition: condition.value,
                equal: condition.condition,
            })
        );
        this.collection.description = this.category.description;
        this.collection.name = this.category.title;
    },
    data: function () {
        return {
            v$: useVuelidate(),
            domainWidth: "0",
            submitting: false,
            theme_template: "Default Collection",
            conditions: [
                {
                    tag: "Product Title",
                    condition: "",
                    equal: "equal",
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
                    value: "is equal to",
                },
                greater: {
                    text: "is greater that",
                    value: "is greater that",
                },
                less: {
                    text: "is less than",
                    value: "is less than",
                },
            },
            product_tag: "Product tag",
            condition_label: "is equal to",
            toggle: true,
            page: {
                seo_description: "",
                seo_title: "",
                url: "",
            },
            collection: {
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
    },
    computed: {
        formData() {
            return { ...this.conditions, ...this.collection };
        },
    },
    methods: {
        submitForm() {
            this.v$.$validate();
            if (!this.v$.$error) {
                axios
                    .post(`/collections/update/${this.category.id}`, {
                        conditions: this.conditions.map((condition) => ({
                            attribute: condition.tag,
                            condition: condition.equal,
                            value: condition.condition,
                        })),
                        ...this.collection,
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
            } else {
                alert("Form field empty");
            }
        },
        updateTemp(val) {
            //console.log(val)
            this.conditions.tag = val;
            //console.log(this.conditions.tag)
        },
        updateCondition(val) {
            this.conditions.equal = val;
            //console.log(this.conditions.equal)
        },
        add() {
            this.conditions.push({
                tag: "",
                condition: "",
                equal: "",
            });
        },
    },

    validations() {
        return {
            page: {
                seo_description: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                    minLength: maxLength(70),
                },
                seo_title: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                    minLength: maxLength(70),
                },
                url: {
                    required: helpers.withMessage(
                        "This field cannot be empty",
                        required
                    ),
                },
            },
            collection: {
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
        };
    },
};
</script>
