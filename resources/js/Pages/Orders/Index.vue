<template>
    <app-layout :navigation="navigation">
        <!-- Page header -->
        <div class="">
            <div class="px- sm:px-6 lg:mx-auto lg:px-">
                <div class="p-6 md:py-6 md:px-0  flex items-center justify-between ">
                    <div class="flex-1 min-w-0">
                        <!-- Profile -->
                        <div class="flex items-center">
                            <div>
                                <div class="flex items-center">
                                    <h1
                                        class="
                                            md:text-3xl
                                            text-lg
                                            font-bold
                                            leading-7
                                            text-blue-gray-900
                                            sm:leading-9 sm:truncate
                                        "
                                    >
                                        Orders
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex space-x-3 md:mt-0 md:ml-4">
                        <inertia-link
                            href="orders/create"
                            type="button"
                            class="
                                flex
                                items-center
                                px-4
                                py-2
                                border border-transparent
                                shadow-sm
                                text-sm
                                font-medium
                                rounded-md
                                text-white
                                bg-cyan-600
                                hover:bg-cyan-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-offset-2
                                focus:ring-cyan-500
                            "
                        >
                            <span class="pr-2"
                                ><PlusIcon class="w-5 h-5"
                            /></span>
                            Create Order
                        </inertia-link>
                    </div>
                </div>
                <div
                    class="
                    px-6 md:px-0
                        grid
                        grid-cols-2
                        md:grid-cols-4
                        gap-2
                        rounded
                        text-xm md:text-base
                    "
                >
                    <div class="">
                        <label
                            for="search"
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-2
                                bg-transparent

                            "
                            >What are you looking for?</label
                        >
                        <div class="relative">
                            <input
                                id="search"
                                type="search"
                                placeholder="Search by order id, status...."
                                class="
                                    block
                                    pl-12
                                    bg-transparent
                                    py-2
                                    rounded-md
                                    text-xm md:text-base
                                    border border-gray-300
                                    text-gray-900
                                    placeholder-gray-400
                                    focus:outline-none
                                    w-full
                                "
                            />
                            <div
                                class="
                                    absolute
                                    inset-y-0
                                    left-0
                                    pl-3
                                    flex
                                    items-center
                                    pointer-events-none
                                "
                            >
                                <SearchIcon
                                    class="flex-shrink-0 h-5 w-5 text-gray-500"
                                    aria-hidden="true"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <label
                            for="payment_type"
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-2
                                bg-transparent
                            "
                            >Payment Type</label
                        >
                        <select
                            id="payment_type"
                            type="payment_type"
                            defaultValue="all"
                            class="
                                block
                                py-2
                                text-xm md:text-base
                                rounded-md
                                border border-gray-300
                                text-gray-600
                                placeholder-gray-300
                                focus:outline-none
                                w-full
                            "
                        >
                            <option value="all">All</option>
                        </select>
                    </div>
                    <div class="">
                        <label
                            for="delivery_type"
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-2
                                bg-transparent
                            "
                            >Delivery Type</label
                        >
                        <select
                            id="delivery_type"
                            type="delivery_type"
                            defaultValue="all"
                            class="
                                block
                                py-2
                                rounded-md
                                text-xm md:text-base
                                border border-gray-300
                                text-gray-600
                                placeholder-gray-300
                                focus:outline-none
                                w-full
                            "
                        >
                            <option value="all">All</option>
                        </select>
                    </div>
                    <div class="">
                        <label
                            for="fulfillment_type"
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-2
                                bg-transparent
                            "
                            >Fulfillment Type</label
                        >
                        <select
                            id="fulfillment_type"
                            type="fulfillment_type"
                            defaultValue="all"
                            class="
                                block
                                py-2
                                rounded-md
                                text-xm md:text-base
                                border border-gray-300
                                text-gray-600
                                placeholder-gray-300
                                focus:outline-none
                                w-full
                            "
                        >
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="mt-6 flex"> -->
                <!--  <div class="">
                <button class="">
                  <input type="date" name="" id="theDate">
                </button>
              </div> -->
                <!-- <datepicker
                v-model="form.from"
                class="date-filter text-black focus:outline-none w-36 rounded-md border-1 border-gray-300"
                date-format="Y-m-d"
                user-format="Y-m-d"
              /> -->
                <!-- <datepicker
                v-model="form.to"
                class="date-filter text-black focus:outline-none w-36 rounded-md border-1 border-gray-300 to"
                date-format="Y-m-d"
                user-format="Y-m-d"
              /> -->
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>

        <div class="flex flex-col mt-5">
            <!-- Activity table (small breakpoint and up) -->

            <div class="px-4 sm:px-6 lg:px-">
                <!-- <Search v-bind:suggestions="suggestions"></Search> -->
                <div class="flex flex-col">
                    <div class="min-w-full overflow-x-auto shadow sm:rounded">
                        <table class="w-full divide-y bg-white divide-gray-200">
                            <thead class="bg-white text-xm md:text-base">
                                <tr>
                                    <th
                                        scope="col"
                                        class="

                                            px-2
                                            text-left
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        <!-- <input
                                            id="comments"
                                            aria-describedby="comments-description"
                                            name="comments"
                                            type="checkbox"
                                            v-model="selectAll"
                                            class="
                                                mr-2
                                                h-4
                                                w-4
                                                text-indigo-600
                                                border-gray-300
                                                rounded
                                            "
                                            @click="checkAll"
                                            :disabled="orders.data.length === 0"
                                        /> -->
                                        Order No
                                    </th>
                                    <!-- <th
                                        scope="col"
                                        class="
                                            whitespace-nowrap
                                            px-3
                                            py-3
                                            text-left text-sm
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Order ID
                                    </th> -->
                                    <th
                                        scope="col"
                                        class="
                                            whitespace-nowrap
                                            px-3
                                            py-3
                                            text-left
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                            hidden md:table-cell
                                        "
                                    >
                                        Date
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                                            whitespace-nowrap
                                            px-3
                                            py-3
                                            text-left
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Customer
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                                            whitespace-nowrap
                                            px-3
                                            py-3
                                            text-center
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                            hidden md:table-cell
                                        "
                                    >
                                        QTY
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                                            whitespace-nowrap
                                            px-3
                                            py-3
                                            text-left
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                            hidden md:table-cell
                                        "
                                    >
                                        Total
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                                            whitespace-nowrap
                                            px-3
                                            py-3
                                            text-left
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                       Status
                                    </th>
                                    <!-- <th scope="col" class=" whitespace-nowrap px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                      Fulfillment
                    </th> -->
                                    <th
                                        scope="col"
                                        class="
                                            py-3
                                            whitespace-nowrap
                                            px-3
                                            text-left
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                            hidden md:table-cell
                                        "
                                    >
                                        Tag
                                    </th>
                                    <!-- <th scope="col" class=" py-3 whitespace-nowrap px-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                      Shipping Method
                    </th> -->
                                    <!-- <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th> -->
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr
                                    v-for="order in orders.data"
                                    :key="order.id"
                                    class="text-xs md:text-base"
                                >
                                <inertia-link
                                        :href="'/orders/' + order.id"
                                        class=""
                                    >
                                    <!-- <td
                                        scope="col"
                                        class="
                                            pl-6
                                            pr-2
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        <input
                                            id="comments"
                                            aria-describedby="comments-description"
                                            name="comments"
                                            type="checkbox"
                                            :value="order"
                                            v-model="selected"
                                            @click="uncheckParentBox(order)"
                                            class="
                                                focus:ring-indigo-500
                                                text-indigo-600
                                                border-gray-300
                                                rounded
                                            "
                                        />
                                    </td> -->

                                        <td
                                            class="
                                                px-3
                                                pt-2.5
                                                text-left
                                                font-medium
                                                text-indigo-600
                                                tracking-wider
                                            "
                                        >
                                            {{ " " + order.id }}
                                        </td>
                                    </inertia-link>
                                    <td
                                        class="
                                            px-3
                                            text-left
                                            tracking-wider
                                            hidden md:table-cell
                                        "
                                    >
                                        {{moment(order.updated_at).format("ll")}}
                                    </td>
                                    <td
                                        class="
                                            px-3
                                            text-left
                                            tracking-wider
                                        "
                                    >
                                        <inertia-link
                                            :href="
                                                '/customers/' + order.user.id
                                            "
                                        >
                                            {{ order.user.first_name }}
                                            {{ order.user.last_name }}
                                        </inertia-link>
                                    </td>
                                    <td
                                        class="


                                            text-center
                                            tracking-wider
                                            hidden md:table-cell
                                        "
                                    >
                                        {{
                                            order.items.length == 1
                                                ? "1"
                                                : order.items.length
                                        }}
                                    </td>
                                    <td
                                        class="
                                            px-3

                                            tracking-wider
                                            hidden md:table-cell
                                        "
                                    >
                                        {{ order.total }}
                                    </td>
                                    <td
                                        class="
                                            px-3
                                            text-left
                                            tracking-wider
                                        "
                                    >
                                        <div
                                            class="
                                                sm:pr-2
                                                md:pr-4
                                                py-3
                                                text-left
                                                leading-4

                                                tracking-wide
                                            "
                                        >
                                            <div>
                                                <span
                                                    :class="[
                                                        statusStyles[
                                                            order.status
                                                        ],
                                                        'inline-flex items-center px-2.5 py-1 rounded capitalize',
                                                    ]"
                                                >
                                                    {{ order.status }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        v-if="order.tags.length > 0"
                                        class="
                                            px-3
                                            text-left
                                            tracking-wider hidden md:table-cell
                                        "
                                    >
                                        <span
                                            v-for="tag in order.tags"
                                            :key="tag.id"
                                        >
                                            {{ tag.title }}
                                            <span
                                                v-if="
                                                    tag.id < order.tags.length
                                                "
                                                >,
                                            </span>
                                        </span>
                                    </td>
                                    <td
                                        v-else
                                        class="
                                            px-3
                                            text-left
                                            tracking-wider
                                            hidden md:table-cell
                                        "
                                    >
                                        -
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                    </div>

                    <nav
                        class="py-3 flex items-center justify-between"
                        aria-label="Pagination"
                    >
                        <div class="hidden sm:block">
                            <p class="text-sm text-gray-700">
                                Showing
                                {{ " " }}
                                <span class="font-semibold">1</span>
                                {{ " " }}
                                to
                                {{ " " }}
                                <span class="font-semibold">10</span>
                                {{ " " }}
                                of
                                {{ " " }}
                                <span class="font-semibold">20</span>
                                {{ " " }}
                                results
                            </p>
                        </div>
                        <div class="flex-1 flex justify-between sm:justify-end">
                            <a
                                href="#"
                                class="
                                    relative
                                    inline-flex
                                    items-center
                                    px-4
                                    py-2
                                    border border-gray-300
                                    text-sm
                                    font-medium
                                    rounded-md
                                    text-gray-700
                                    bg-white
                                    hover:bg-gray-50
                                "
                            >
                                Previous
                            </a>
                            <a
                                href="#"
                                class="
                                    ml-3
                                    relative
                                    inline-flex
                                    items-center
                                    px-4
                                    py-2
                                    border border-gray-300
                                    text-sm
                                    font-medium
                                    rounded-md
                                    text-white
                                    bg-indigo-700
                                "
                            >
                                Next
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import { ChevronDownIcon, ChevronUpIcon, PlusIcon } from "@heroicons/vue/solid";
import { FilterIcon, SearchIcon } from "@heroicons/vue/outline";
import Input from "../../Jetstream/Input.vue";
import ArrowRight from "../../../assets/ArrowRight.vue";
// import Datepicker from 'vue3-datepicker'
import Search from "../Search.vue";
import moment from 'moment';
// import axios from "axios"

const tabs = [
    { name: "All", href: "#", current: true },
    { name: "Fulfilment", href: "#", current: false },
    { name: "Unfulfilment", href: "#", current: false },
    { name: "Sales Withdrawal", href: "#", current: false },
];

const statusStyles = {
    received: "bg-green-100 text-green-800",
    shipped: "bg-green-100 text-green-800",
    delivered: "bg-green-100 text-green-800",
    fulfilled: "bg-green-100 text-green-800",
    confirmed: "bg-green-100 text-green-800",
    pending: "bg-yellow-100 text-yellow-800",
    returned: "bg-yellow-100 text-yellow-800",
    refunded: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
    expired: "bg-gray-100 text-gray-800",
    cancelled: "bg-red-100 text-red-800",
};

export default {
    props: {
        orders: Object,
        filters: Object,
        navigation: Array
    },
    data() {
        return {
            value: [{ name: "Javascript", code: "js" }],
            options: [
                { name: "Vue.js", code: "vu" },
                { name: "Javascript", code: "js" },
                { name: "Open Source", code: "os" },
            ],
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
            form: {
                search: this.filters.search,
                from: new Date(),
                to: new Date(),
                user: this.filters.user,
            },
            source: {
                international: true,
                domestic: false,
            },
            fullfillment: {
                unfullfilled: true,
                partial: false,
                fulfilled: true,
            },
            payment: {
                paid: true,
                partial: false,
                voided: false,
                pending: true,
                authorized: true,
                refunded: true,
            },
            shipmentMethod: {
                international: true,
                domestic: false,
            },
        };
    },
    computed: {
        myProps() {
            return { data: this.orders.data, links: this.orders.links };
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
        numberOfItems() {
            return this.orders.items.length == 1
                ? "1 Item"
                : this.orders.items.length + "Items";
        },
    },
    methods: {
        next() {
            axios.get(this.nextPageUrl);
        },
        previous() {
            axios.get(this.previouPageUrl);
        },
        checkAll() {
            this.selected = !this.selectAll ? [...this.orders.data] : [];
            console.log(this.selectAll, this.customers);
        },
        uncheckParentBox(order) {
            event.stopPropagation();
            //this.selectAll = false;
            //console.log(order)
            let rows = this.selected.filter((p) => p.id == order.id);
            if (rows.length > 0) {
                // unselect
                this.selected = this.selected.filter((p) => p.id != order.id);
            } else {
                // select
                this.selected.push(order);
            }
            this.orders.data.length == this.selected.length
                ? (this.selectAll = true)
                : (this.selectAll = false);
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
        addTag(newTag) {
            const tag = {
                name: newTag,
                code:
                    newTag.substring(0, 2) +
                    Math.floor(Math.random() * 10000000),
            };
            this.options.push(tag);
            this.value.push(tag);
        },
        toggle(data) {
            data = !data;
        },
        /* checkCurrent(tab){
      //tabs[tab].current = true
      tabs[tab].current = "true"
      console.log(tabs[tab].current)
    }  */
    },
    components: {
        AppLayout,
        ChevronUpIcon,
        ChevronDownIcon,
        Input,
        ArrowRight,
        PlusIcon,
        SearchIcon,
        FilterIcon,
        Search,
        //moment
    },

    setup() {
        const open = ref(false);
        const suggestions = ref([]);
        const selection = ref("");

        function getAutoCompleteData(term) {
            selection.value = term;
            if (term.length > 2) {
                axios.get(`/products/get-data?term=${term}`).then((res) => {
                    suggestions.value = res.data;
                });
            }
        }

        function updateCurrentList(index) {
            const suggestion = suggestions.value.filter(
                (list) => list.id == index
            );
            selection.value = suggestion[0].title;
            suggestions.value = [];
            Inertia.visit(`products/${suggestion[0].id}`);
        }
        // console.log(tabs.selected)
        return {
            tabs,
            selection,
            updateCurrentList,
            getAutoCompleteData,
            suggestions,
            statusStyles,
            moment
        };
    },
};
</script>
<style scoped>
select,
.date-filter {
  -moz-appearance: none; /* Firefox */
  -webkit-appearance: none; /* Safari and Chrome */
  appearance: none;
  background: url("../../../assets/ArrowDownFilled.svg") no-repeat right 0.3rem
    center/14px 4px;
}

input[type="date"]::-webkit-calendar-picker-indicator {
  background: none;
}
.v3dp__datepicker {
  --elem-hover-bg-color: var(--vdp-hover-bg-color, #4f46e5);
  --elem-selected-bg-color: var(--vdp-selected-bg-color, #4f46e5);
}
tbody tr:hover {
  background: transparent;
}
</style>
