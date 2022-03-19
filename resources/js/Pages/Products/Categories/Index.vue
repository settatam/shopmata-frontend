<template>
    <app-layout>
        <div class="px-4 lg:px-8">
            <div>
                <div class="lg:mx-auto">
                    <div
                        class="py-6 flex items-center justify-between lg:border-t lg:border-gray-200"
                    >
                        <div class="flex-1 min-w-0">
                            <!-- Profile -->
                            <div class="flex items-center">
                                <div>
                                    <div class="flex items-center">
                                        <h1
                                            class="text-lg md:text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate"
                                        >
                                            All Collections
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="lg:mt-6 flex space-x-3 mt-0 md:ml-4 items-center"
                        >
                            <inertia-link
                                href="categories/create"
                                type="button"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                            >
                                <plus-icon class="h-5 w-5 mr-2" /> Create
                                Collection
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <label for="search" class="text-xm md:text-base mb-3">
                    What are you looking for?
                </label>
                <div
                    class="relative w-full text-gray-400 focus-within:text-gray-600"
                >
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pointer-events-none"
                        aria-hidden="true"
                    >
                        <SearchIcon class="h-5 w-5 ml-5" aria-hidden="true" />
                    </div>
                    <input
                        id="search-field"
                        name="search-field"
                        class="rounded text-xm md:text-base text-gray-500 w-full md:search-field md:w-full pl-12 pr-2 bg-transparent border border-gray-200 placeholder-gray-500 placehol"
                        placeholder="Search by collection name"
                        type="search"
                        v-model="q"
                        @keydown="searchAction"
                    />
                </div>
            </div>
            <div v-if="selected.length" class="mt-3 mb-3">
                <button
                    class="rounded-md border border-transparent shadow-sm px-10 py-3 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer focus:ring-red-500 sm:text-sm"
                    @click="delete_selected = true"
                >
                    Delete Collection
                </button>
            </div>
            <div class="flex items-center justify-between my-4 md:hidden">
                <div
                    class="border border-gray-200 px-4 py-2 text-center rounded text-xm"
                >
                    <input
                        id="comments"
                        aria-describedby="comments-description"
                        name="comments"
                        type="checkbox"
                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-5 cursor-pointer"
                        v-model="selectedAll"
                        @click.stop="select"
                        :disabled="categories.length === 0"
                    />
                    Select all
                </div>
                <div
                    class="border p-2 cursor-pointer rounded border-red-500 ml-1"
                    v-if="selected.length"
                    @click="delete_selected = true"
                >
                    <trash-icon class="w-4 h-4 text-red-500" />
                </div>
            </div>
            <div class="flex flex-col mt-2">
                <div
                    class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg"
                >
                    <table
                        class="min-w-full divide-y divide-gray-200 table-fixed"
                    >
                        <thead class="bg-gray-50 hidden md:table-header-group">
                            <tr>
                                <th
                                    scope="col"
                                    class="w-1/10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    <input
                                        id="comments"
                                        aria-describedby="comments-description"
                                        name="comments"
                                        type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                        v-model="selectedAll"
                                        @click.stop="select"
                                        :disabled="categories.length === 0"
                                    />
                                </th>
                                <th
                                    scope="col"
                                    class="w-3/10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Collection name
                                </th>
                                <th
                                    scope="col"
                                    class="w-3/10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    PRODUCT CONDITION
                                </th>
                                <th
                                    scope="col"
                                    class="w-1/5 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    No of Product
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody
                            class="bg-white divide-y divide-gray-200"
                            v-if="collectionListing.length > 0"
                        >
                            <tr
                                class="bg-white hover:bg-indigo-50"
                                v-for="category in collectionListing"
                                :key="category.id"
                            >
                                <td
                                    scope="col"
                                    class="w-1/10 pl-4.5 pr-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    <input
                                        id="comments"
                                        aria-describedby="comments-description"
                                        name="comments"
                                        type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                        :value="category.id"
                                        v-model="selected"
                                        @click="uncheckBox(category.id)"
                                    />
                                </td>
                                <td
                                    class="w-3/10 px-2 md:px-6 py-4 items-center whitespace-nowrap text-gray-900 hidden md:table-cell"
                                >
                                    <div class="flex items-center">
                                        <div
                                            v-if="category.image_url"
                                            class="flex-shrink-0 h-12 w-12 rounded-sm mr-3.5 lg:mr-5 border-2 border-r"
                                        >
                                            <img
                                                :src="category.image_thumb"
                                                alt="category_image"
                                            />
                                        </div>
                                        <img
                                            v-else
                                            src="/images/product-placeholder.png"
                                            class="h-12 w-12 rounded-full mr-3.5 lg:mr-5"
                                            alt="{{category.title}}"
                                        />
                                        <inertia-link
                                            :href="`/categories/${category.id}/edit`"
                                            class="group inline-flex space-x-2 w-72"
                                        >
                                            <p
                                                class="text-gray-800 truncate group-hover:text-gray-900 break-normal"
                                            >
                                                {{ category.title }}
                                            </p>
                                        </inertia-link>
                                    </div>
                                </td>
                                <td
                                    class="hidden md:table-cell w-3/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500"
                                >
                                    <p
                                        class="text-gray-800 truncate text-left break-normal"
                                    >
                                        {{ category.condition }}
                                    </p>
                                </td>
                                <td
                                    class="hidden md:table-cell w-1/5 px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                >
                                    <p
                                        class="text-gray-800 truncate text-center break-normal"
                                    >
                                        {{ category.sort }}
                                    </p>
                                </td>
                                <td class="md:hidden flex items-center py-2">
                                    <div
                                        class="flex-shrink-0 h-8 w-8 rounded-sm mr-3.5 border-2 border-r"
                                    >
                                        <img
                                            :src="category.image"
                                            alt="category_image"
                                        />
                                    </div>
                                    <inertia-link
                                        href="/categories/edit"
                                        class="flex flex-col"
                                    >
                                        <p
                                            class="text-gray-800 text-xm font-semibold group-hover:text-gray-900 break-normal"
                                        >
                                            {{ category.description }}
                                        </p>
                                        <p class="text-gray-800 text-xm">
                                            {{ category.condition }}
                                        </p>
                                    </inertia-link>
                                </td>
                                <td
                                    class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500"
                                >
                                    <inertia-link
                                        :href="
                                            'categories/' +
                                            category.id +
                                            '/edit'
                                        "
                                    >
                                        <pencil-icon
                                            class="w-5 h-5 text-indigo-700 cursor-pointer"
                                        />
                                    </inertia-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        class="flex flex-col items-center pb-20 bg-white"
                        v-if="categories.length == 0"
                    >
                        <img
                            src="../../../../assets/EmptyTable.svg"
                            alt="empty_table"
                            srcset=""
                        />
                        <p class="mb-4 text-xs md:text-lg">
                            No collection has been created
                        </p>
                        <inertia-link
                            href="/categories/create"
                            type="button"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm cursor-pointer rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                        >
                            <plus-icon class="w-5 h-5 text-white mr-2" /> Create
                            New Collection
                        </inertia-link>
                    </div>
                    <!-- Pagination -->
                    <nav
                        class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                        aria-label="Pagination"
                    >
                        <div class="hidden sm:block">
                            <p class="text-sm text-gray-700">
                                Showing
                                {{ " " }}
                                <span class="font-medium">1</span>
                                {{ " " }}
                                to
                                {{ " " }}
                                <span class="font-medium">10</span>
                                {{ " " }}
                                of
                                {{ " " }}
                                <span class="font-medium">20</span>
                                {{ " " }}
                                results
                            </p>
                        </div>
                        <div class="flex-1 flex justify-between sm:justify-end">
                            <a
                                href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Previous
                            </a>
                            <a
                                href="#"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Next
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <delete-alert
            @close="close"
            @delete="delete_action"
            v-if="delete_selected"
            :selected="selected"
            :open="open_delete"
            item="collection"
        />
        <SuccessNotif />
        <ErrorNotif />
    </app-layout>
</template>
<script>
import { ref } from "vue";
import AppLayout from "../../../Layouts/AppLayout.vue";
import SuccessNotif from "@/Pages/Products/Components/SuccessNotif.vue";
import ErrorNotif from "@/Pages/Products/Components/ErrorNotif.vue";
import { PencilIcon, PlusIcon, SearchIcon } from "@heroicons/vue/solid";
import { TrashIcon } from "@heroicons/vue/outline";
import axios from "axios";
import { notify } from "notiwind";
import { Inertia } from "@inertiajs/inertia";
import DeleteAlert from "@/Pages/Products/Components/DeleteAlert.vue";
export default {
    props: {
        categories: Object,
    },
    components: {
        AppLayout,
        PencilIcon,
        PlusIcon,
        SearchIcon,
        TrashIcon,
        DeleteAlert,
        ErrorNotif,
        SuccessNotif
    },
    computed: {
        collectionListing() {
            if (
                !this.q
            ) {
                return this.categories.data;
            } else {
                if (this.haveFilteredOnce) {
                    return this.filteredCollections;
                } else {
                    return this.categories.data;
                }
            }
        },
    },
    data() {
        return {
            selected: [],
            selectedAll: false,
            delete_selected: false,
            filteredCollections: [],
            q: "",
            haveFilteredOnce: false,
        };
    },
    watch: {
        q: function (value) {
            if (!value) {
                this.initiateSearch();
            }
        },
    },
    methods: {
        initiateSearch: function () {
            axios
                .get(`/collections/search`, {
                    params: {
                        q: this.q,
                    },
                })
                .then((res) => {
                    this.haveFilteredOnce = true;
                    this.filteredCollections = res.data.data;
                });
        },
        searchAction: function (e) {
            if (e.key === "Enter" && this.q) {
                this.initiateSearch();
            }
        },
        select() {
            this.selected = [];
            if (!this.selectedAll) {
                for (let i in this.categories.data) {
                    this.selected.push(this.categories.data[i].id);
                }
            }
        },
        uncheckBox(id) {
            let row = this.selected.filter((p) => p == id);
            if (row.length > 0) {
                this.selected = this.selected.filter((p) => p != id);
            } else {
                this.selected.push(id);
            }
            this.categories.length == this.selected.length
                ? (this.selectedAll = true)
                : (this.selectedAll = false);
        },
        close() {
            this.delete_selected = false;
            this.selected = [];
            this.selectedAll = false;
        },
        delete_action() {
            //console.log(id)
            const count = this.selected.length;
            axios
                .post(`collections/delete-multiple`, {
                    collection_ids: this.selected,
                })
                .then((response) => {
                    notify(
                        {
                            group: "success",
                            title: "Success",
                            text: `Collection${
                                count > 1 ? "s" : ""
                            } deleted  successfully`,
                        },
                        4000
                    );
                    this.selected = [];
                    this.selectedAll = false;
                    Inertia.reload({
                        only: ["categories"],
                    });
                    notify(
                        {
                            group: "success",
                            title: "Success",
                            text: "Collection(s) deleted successfully",
                        },
                        4000
                    );
                })
                .catch((error) => {
                    console.log(error.response.data);
                    if (error.response.status === 400) {
                        notify(
                            {
                                group: "error",
                                title: "Error",
                                text: error.response.data.message,
                            },
                            4000
                        );
                    } else {
                        notify(
                            {
                                group: "error",
                                title: "Error",
                                text: "Something went wrong, please try again later.",
                            },
                            4000
                        );
                    }
                    if (error.response.data.errors) {
                        errors.value = error.response.data.errors;
                    }
                })
                .finally(() => {
                    this.submitting = false;
                });
        },
    },
    setup() {
        const open_delete = ref(false);

        return { open_delete };
    },
};
</script>
<style scoped>
.tbody tr:hover {
    background: transparent;
}
</style>
