<template>
    <app-layout>
        <!-- Page header -->
        <div class="">
            <div class="px- sm:px-6 lg:mx-auto lg:px-">
                <div
                    class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200"
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
                        <inertia-link
                            href="customers/create"
                            type="button"
                            class="inline-flex px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                        >
                            <!-- <p
                            @click="addCustomer"
                            class="cursor-pointer inline-flex px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                        > -->
                            <span class="pr-3"
                                ><PlusIcon class="w-5 h-5" /></span
                            >Add Customer
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div
                class="flex items-center justify-between py-2 px-8 rounded md:w-4/5"
            >
                <div class="w-full md:w-4/5">
                    <label
                        for="search"
                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                        >Search</label
                    >
                    <div class="relative">
                        <input
                            id="search"
                            type="search"
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

                <div class="w-full mx-10 md:w-2/5">
                    <label
                        for="delivery_type"
                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                        >Date Created</label
                    >
                    <input
                        id="delivery_type"
                        type="date"
                        name="date"
                        defaultValue="all"
                        class="block py-2 rounded-md border border-gray-300 text-gray-900 placeholder-gray-300 focus:outline-none w-full"
                    />
                </div>
            </div>
            <!-- <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-xl leading-6 font-medium text-gray-900">
                    All Customers
                </h2>
            </div> -->
            <!-- Activity table (small breakpoint and up) -->
            <div class="hidden sm:block">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <Search v-bind:suggestions="suggestions"></Search>
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
                                            class="pl-6 pr-2 text-left text-base font-medium text-gray-400 uppercase tracking-wider"
                                        >
                                            <input
                                                id="comments"
                                                aria-describedby="comments-description"
                                                name="comments"
                                                type="checkbox"
                                                v-model="selectAll"
                                                class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                @click="checkAll"
                                                :disabled="
                                                    customers.data.length === 0
                                                "
                                            />
                                        </th>
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
                                            Location
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-base font-medium text-gray-400 uppercase tracking-wider"
                                        >
                                            Total Order
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
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="customer in customers.data"
                                        :key="customer.id"
                                        class="bg-white"
                                    >
                                        <td
                                            scope="col"
                                            class="pl-6 pr-2 text-left text-base font-medium text-gray-700 tracking-wider"
                                        >
                                            <input
                                                id="comments"
                                                aria-describedby="comments-description"
                                                name="comments"
                                                type="checkbox"
                                                :value="customer"
                                                v-model="selected"
                                                @click="
                                                    uncheckParentBox(customer)
                                                "
                                                class="focus:ring-indigo-500 text-indigo-600 border-gray-300 rounded"
                                            />
                                        </td>
                                        <td
                                            class="px-6 py-3 text-left text-base font-medium text-gray-700 tracking-wider"
                                        >
                                            <inertia-link
                                                :href="
                                                    '/customers/' + customer.id
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
                                            {{ customer.state }}
                                            {{ customer.country }}
                                        </td>
                                        <td
                                            class="px-6 py-3 text-left text-base font-medium text-gray-700 tracking-wider"
                                        >
                                            {{ customer.total_orders }}
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
                        </nav>
                        <add-customer-modal
                            v-if="popModal"
                            @close="this.popModal = false"
                            :login="login"
                            :title="title"
                            :buttonMsg="buttonMsg"
                        />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import { PlusIcon, EyeIcon, PencilIcon, TrashIcon } from "@heroicons/vue/solid";
import { SearchIcon } from "@heroicons/vue/outline";
// import Search from '../Search.vue'
// import axios from "axios"
import moment from "moment";
import AddCustomerModal from "./Components/AddCustomerModal.vue";

export default {
    props: {
        customers: Object,
        filters: Object,
        data: Object,
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
            form: {
                search: this.filters.search,
                orderBy: this.filters.orderBy,
                sortOrder: this.filters.sortOrder,
            },
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
        uncheckParentBox(customer) {
            event.stopPropagation();
            let rows = this.selected.filter((s) => s.id == customer.id);
            if (rows.length > 0) {
                this.selected = this.selected.filter(
                    (s) => s.id != customer.id
                );
            } else {
                this.selected.push(customer);
            }
            this.customers.data.length == this.selected.length
                ? (this.selectAll = true)
                : (this.selectAll = false);
        },
        deleteRow(customer) {
            event.stopPropagation();
            this.$inertia.delete(`/customers/${customer.id}`, customer.id);
        },
        deleteSelected() {
            let selectedRows = this.selected.map((s) => s.id).join(",");
            this.$inertia.delete(`/customers/${selectedRows}`, selectedRows);
        },
        showCheckedCustomers() {
            console.log(this.customers);
            console.log(this.selected);
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
        PencilIcon,
        TrashIcon,
        AddCustomerModal,
        // SideNav,
        // ExportIcon,
        // ImportIcon,
        // SaveIcon,
        // SortIcon,
        // DeleteIcon,
        // DeleteSolidIcon,
        // EditIcon,
        // AngleUpIcon,
        // ArrowRight,
        // Pagination,
        // ArrowDownFilled,
        // Multiselect,
        // OrderRow,
        // Badge
    },

    setup() {
        const open = ref(false);
    },
};
</script>
