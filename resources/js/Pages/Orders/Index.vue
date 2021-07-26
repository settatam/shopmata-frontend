<template>
  <app-layout>
    <!-- Page header -->
    <div class="">
      <div class="px-4 sm:px-6 lg:mx-auto lg:px-8">
        <div
          class="
            py-6
            md:flex
            md:items-center
            md:justify-between
            lg:border-t lg:border-gray-200
          "
        >
          <div class="flex-1 min-w-0">
            <!-- Profile -->
            <div class="flex items-center">
              <div>
                <div class="flex items-center">
                  <h1
                    class="
                      ml-3
                      text-2xl
                      font-bold
                      leading-7
                      text-gray-900
                      sm:leading-9
                      sm:truncate
                    "
                  >
                    Orders
                  </h1>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            <inertia-link
              href="orders/create"
              type="button"
              class="
                inline-flex
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
                focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500
              "
            >
              Create New Order
            </inertia-link>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-8">
      <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl leading-6 font-medium text-gray-900">
          All Orders
        </h2>
      </div>
      <!-- Activity table (small breakpoint and up) -->
      <div class="hidden sm:block">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
          <Search v-bind:suggestions="suggestions"></Search>
          <div class="flex flex-col mt-2">
            <div
              class="
                align-middle
                min-w-full
                overflow-x-auto
                shadow
                overflow-hidden
                sm:rounded-lg
              "
            >
              <table class="min-w-full divide-y divide-gray-200 table-fixed">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      OrderID
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Created at
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
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
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Total
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Items
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Payment
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Fulfillment
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Shipping Method
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr
                    v-for="order in orders.data"
                    :key="order.id"
                    class="bg-white"
                  >
                    <td
                      class="
                        px-6
                        py-3
                        text-center text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      {{ order.id }}

                    </td>
                    <td
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      {{ order.created_at }}
                    </td>
                    <td
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      {{ order.user.first_name }} {{ order.user.last_name }}
                    </td>
                    <td
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      {{ order.total }}
                    </td>
                    <td
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      {{
                        order.items.length == 1
                          ? "1 item"
                          : order.items.length + "Items"
                      }}
                    </td>
                    <td
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      <div
                        class="
                          px-3
                          py-3
                          sm:px-2
                          sm:py-2
                          md:px-4
                          md:py-6
                          text-left
                          leading-4
                          font-semibold
                          tracking-wide
                          text-gray-600
                        "
                      >
                        <div v-if="!order.status || order.status == 'unpaid'">
                          <div
                            class="
                              text-xs
                              px-4
                              py
                              inline-flex
                              leading-5
                              bg-red-lighter
                              text-red-darker
                            "
                          >
                            Unpaid
                          </div>
                        </div>
                        <div v-else>
                          <div
                            class="
                              text-xs
                              px-4
                              py
                              inline-flex
                              leading-5
                              bg-green-lighter
                              text-green-darker
                            "
                          >
                            Paid
                          </div>
                        </div>
                      </div>
                    </td>
                    <td
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      <div v-if="order.fulfillment">
                        <div
                          class="
                            text-xs
                            px-4
                            py
                            inline-flex
                            leading-5
                            bg-lightGreen
                            text-green-dark
                          "
                        >
                          Unfulfilled
                        </div>
                      </div>
                      <div v-else>
                        <div
                          class="
                            text-xs
                            px-4
                            py
                            inline-flex
                            leading-5
                            bg-green-lighter
                            text-green-dark
                          "
                        >
                          Fulfilled
                        </div>
                      </div>
                    </td>
                    <td
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      {{ order.shipping }}
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- Pagination -->
              <nav
                class="
                  bg-white
                  px-4
                  py-3
                  flex
                  items-center
                  justify-between
                  border-t border-gray-200
                  sm:px-6
                "
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
                      text-gray-700
                      bg-white
                      hover:bg-gray-50
                    "
                  >
                    Next
                  </a>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref } from 'vue'
import AppLayout from "../../Layouts/AppLayout.vue";
// import Search from '../Search.vue'
// import axios from "axios"

export default {
  props: {
    orders: Object,
    filters: Object,
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
        from: this.filters.from,
        to: this.filters.to,
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
    uncheckParentBox() {
      event.stopPropagation();
      this.selectAll = false;
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
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      this.value.push(tag);
    },
    toggle(data) {
      data = !data;
    },
  },
  components: {
    AppLayout,
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

