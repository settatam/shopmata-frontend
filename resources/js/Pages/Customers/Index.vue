<template>
    <app-layout :navigation="navigation">
        <!-- Page header -->
        <div class="">
            <div class="px- sm:px-6 lg:mx-auto lg:px-">
                <div
                    class="py-6 ml-8 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200"
                >
                    <div class="flex-1 min-w-0">
                        <!-- Profile -->
                        <div class="flex items-center">
                            <div>
                                <div class="flex items-center">
                                    <h1
                                        class="text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate"
                                    >
                                        All Customers
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                        <inertia-link href="/admin/customers/create">
                            <button
                                class="inline-flex px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md cursor-pointer text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                            >
                                <!-- <p
                                @click="addCustomer"
                                class="cursor-pointer inline-flex px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                            > -->
                                <span class="pr-3"
                                    ><PlusIcon class="w-5 h-5" /></span
                                >Add Customer
                            </button>
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div
                class="flex flex-wrap items-center justify-between py-2 px-8 rounded gap-8"
            >
                <div class="w-full">
                    <label
                        for="search"
                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                        >Search</label
                    >
                    <div class="relative">
                        <input
                            id="search"
                            type="search"
                            v-model="filter.q"
                            placeholder="Search by name, email...."
                            class="block pl-12 py-2 rounded-md border border-gray-300 text-gray-900 placeholder-gray-300 focus:outline-none w-full"
                        />
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <SearchIcon
                                class="flex-shrink-0 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                        </div>
                    </div>
                </div>
                <div class="w-full flex flex-wrap gap-3">
                    <div class="flex flex-wrap">
                        <div class="">
                            <label
                                for="date_from"
                                class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                >Date Created</label
                            >
                            <input
                                id="date_from"
                                type="date"
                                name="date"
                                pattern="dd-mm-yyyy"
                                v-model="filter.from_date"
                                defaultValue="all"
                                class="block py-2 rounded-md border border-gray-300 text-gray-900 placeholder-gray-300 focus:outline-none w-full"
                            />
                        </div>
                        <div>
                            <label
                                for=""
                                class="block text-gray-600 font-semibold mb-2 bg-transparent text-transparent"
                                >None</label
                            >
                            <div
                                class="my-auto flex border border-gray-300 py-2 px-4"
                            >
                                <arrow-right-icon class="w-5 h-6" />
                            </div>
                        </div>
                        <div class="">
                            <label
                                for="date_to"
                                class="block text-gray-600 font-semibold mb-2 bg-transparent text-transparent"
                                >None</label
                            >
                            <input
                                id="date_to"
                                type="date"
                                name="date"
                                v-model="filter.to_date"
                                pattern="dd-mm-yyyy"
                                defaultValue="all"
                                class="block py-2 rounded-md border border-gray-300 text-gray-900 placeholder-gray-300 focus:outline-none w-full"
                            />
                        </div>
                    </div>
                    <div>
                        <label
                            for="submit"
                            class="block text-gray-600 font-semibold mb-2 bg-transparent text-transparent"
                            >None</label
                        >
                        <button
                            type="button"
                            class="disabled:bg-gray-400 rounded-md border border-transparent shadow-sm px-4 lg:px-7 py-2 text-center text-xs lg:text-base font-medium text-white sm:text-sm bg-indigo-600"
                            @click="submit"
                            :disabled="disableBtn"
                        >
                            Search
                        </button>
                    </div>
                </div>
            </div>
            <!-- <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-xl leading-6 font-medium text-gray-900">
                    All Customers
                </h2>
            </div> -->
            <!-- Activity table (small breakpoint and up) -->
            <div class="sm:block mb-10">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col mt-4">
                        <div
                            class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg"
                        >
                            <table
                                class="min-w-full divide-y divide-gray-200 table-fixed"
                            >
                                <thead class="bg-white">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-base font-medium text-gray-400 uppercase tracking-wider"
                                        >
                                            Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-base font-medium text-gray-400 uppercase tracking-wider"
                                        >
                                            Email
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-base font-medium text-gray-400 uppercase tracking-wider"
                                        >
                                            Phone Number
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-base font-medium text-gray-400 uppercase tracking-wider"
                                        >
                                            Date Joined
                                        </th>
                                        <!-- <th scope="col" class="px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th> -->
                                    </tr>
                                </thead>
                                <div
                                    v-if="loading"
                                    class="absolute top-2/3 scale-150 left-1/2 flex flex-col justify-center items-center"
                                >
                                    <spinner class=" " />
                                    <p class="text-lg font-bold">loading...</p>
                                </div>
                                <tbody
                                    v-else
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="customer in filterLists"
                                        :key="customer.id"
                                        class="bg-white"
                                    >
                                        <td
                                            class="flex flex-row px-6 py-3 text-left text-base font-medium text-gray-700 tracking-wider"
                                        >
                                            <inertia-link
                                                :href="
                                                    '/admin/customers/' +
                                                    customer.id
                                                "
                                            >
                                                {{ customer.first_name }}
                                                {{ customer.last_name }}
                                            </inertia-link>
                                        </td>
                                        <td
                                            class="px-6 py-3 text-left text-base font-medium text-gray-700 tracking-wider"
                                        >
                                            {{ customer.email }}
                                        </td>
                                        <td
                                            class="px-6 py-3 text-left text-base font-medium text-gray-700 tracking-wider"
                                        >
                                            {{ customer.phone_number }}
                                            <!-- {{ customer.state }}
                                            {{ customer.country }} -->
                                        </td>
                                        <td
                                            class="px-6 py-3 text-left text-base font-medium text-gray-700 tracking-wider"
                                        >
                                            {{
                                                moment(
                                                    customer.created_at
                                                ).format("YYYY-MM-DD")
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <pagination
                            :meta="pagination"
                            v-if="pagination.total > pagination.per_page"
                        />

                        <!-- <nav
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
                            <div
                                class="flex-1 flex justify-between sm:justify-end"
                            >
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
                        </nav> -->

                        <!-- Customer modal -->
                        <customer
                            @close="openCustomer = false"
                            v-if="openCustomer"
                            :countries="countries"
                        />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { computed, reactive, ref, watch } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import { PlusIcon, EyeIcon, TrashIcon } from "@heroicons/vue/solid";
import { SearchIcon, ArrowRightIcon } from "@heroicons/vue/outline";
import Pagination from "../../Components/Pagination.vue";
// import Search from '../Search.vue'
// import axios from "axios"
import moment from "moment";
import Spinner from "../../../assets/Spinner.vue";
import Customer from "./Components/Customer.vue";

export default {
    props: {
        customers: Object,
        //filters: Object,
        //data: Object,
        store: Object,
        countries: Array,
        navigation: Array,
    },
    data() {
        return {
            tab: "tab-0",
            search_value: "",
            selected: [],
            selectAll: false,
            itemsPerPage: 50,
            isMouted: false,
            itemsLength: 100,
            currentPage: 0,
            rightPages: [],
            leftpages: [],
            nextPageUrl: "",
            previouPageUrl: "",
            options: [],
            /* form: {
                search: this.filters.search,
                orderBy: this.filters.orderBy,
                sortOrder: this.filters.sortOrder,
            }, */
            message: "",
            moment,
        };
    },
    computed: {
        myProps() {
            return { data: this.customers.data, links: this.customers.links };
        },
        rows() {
            return this.itemsPerPage * this.currentPage;
        },
        firstRowOnPage() {
            let rows = this.itemsPerPage * this.currentPage;
            return rows - this.itemsPerPage + 1;
        },
        numberOfPages() {
            return this.itemsLength / this.itemsPerPage;
        },
        showEllipsis() {
            return this.itemsLength / this.itemsPerPage > 7;
        },
        disableNextButton() {
            let lastPage = this.itemsPerPage * this.currentPage;
            return lastPage >= this.itemsLength;
        },
        disablePreviousButton() {
            return this.currentPage === 1;
        },
    },
    methods: {
        resetForm() {
            this.form = {
                search: null,
            };
        },
        next() {
            axios.get(this.nextPageUrl);
        },
        previous() {
            axios.get(this.previouPageUrl);
        },
        checkAll() {
            this.selected = !this.selectAll ? [...this.customers.data] : [];
            console.log(this.selectAll, this.customers);
        },

        getAllCustomers() {
            this.tab = "tab-0";
        },
        getMarketingCustomers() {
            this.tab = "tab-1";
        },
        getRepeatCustomers() {
            this.tab = "tab-2";
        },
        getProspects() {
            this.tab = "tab-3";
        },
        edit(customer) {
            this.$inertia.visit(`/customers/${customer.id}/edit`, customer.id);
        },
        show(customer) {
            this.$inertia.visit(`/customers/${customer.id}/show`, customer.id);
        },
        sortByLastname() {
            this.form.orderBy = "last_name";
            this.form.sortOrder = this.form.sortOrder == "asc" ? "desc" : "asc";
        },
        format(dateString) {
            return formatDate(dateString);
        },
        total_orders() {
            return parseFloat(this.total_orders).toFixed(2);
        },
    },
    components: {
        AppLayout,
        PlusIcon,
        SearchIcon,
        EyeIcon,
        TrashIcon,
        ArrowRightIcon,
        Pagination,
        Spinner,
        Customer,
    },

    setup({ customers }) {
        const open = ref(false);
        const filterLists = ref(customers.data);
        const openCustomer = ref(false);
        const filter = reactive({
            from_date: "",
            to_date: "",
            q: "",
            filter: true,
        });
        const pagination = ref(customers);
        const loading = ref(false);

        const disableBtn = computed(() => {
            if (
                (filter.from_date == "" || filter.to_date == "") &&
                filter.q == ""
            ) {
                return true;
            } else if (
                filter.q != "" &&
                (filter.from_date == "" || filter.to_date == "")
            ) {
                return false;
            } else {
                return false;
            }
        });

        function success(list, page) {
            filterLists.value = list;
            pagination.value = page;
            loading.value = false;
        }
        function reset() {
            filter.from_date = "";
            filter.to_date = "";
        }
        function submit() {
            loading.value = true;
            axios
                .get("/admin/customers", {
                    params: {
                        from_date: filter.from_date,
                        to_date: filter.to_date,
                        q: filter.q,
                        filter: true,
                    },
                })
                .then((res) => {
                    const list = res.data.data;
                    const page = res.data.meta;
                    setTimeout(success(list, page), 2000);
                    // setTimeout(reset(),2100)
                });
        }
        return {
            filter,
            submit,
            filterLists,
            pagination,
            loading,
            openCustomer,
            disableBtn,
        };
    },
};
</script>
