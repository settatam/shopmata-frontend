<template>
    <app-layout>
        <!-- Page header -->
        <div class="">
          <div class="px-4 sm:px-6 lg:mx-auto lg:px-8">
            <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
              <div class="flex-1 min-w-0">
                <!-- Profile -->
                <div class="flex items-center">
                  <div>
                    <div class="flex items-center">
                      <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                        Customers
                      </h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                <inertia-link href="orders/create" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                  Create New Customer
                </inertia-link>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-8">
          <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl leading-6 font-medium text-gray-900">All Products</h2>
          </div>
          <!-- Activity table (small breakpoint and up) -->
          <div class="hidden sm:block">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
              <Search v-bind:suggestions="suggestions"></Search>
              <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="w-1/2 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          First Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Last Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Locations
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Orders
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Orders
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Created
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="order in orders.data" :key="order.id" class="bg-white">
                        <td class="max-w-0 w-1/2 px-6 py-4 items-center whitespace-nowrap text-gray-900">
                            {{customer.first_name}}
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          {{ customer.last_name }}
                        </td>
                        <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                          {{customer.shipping_addresses.length}}
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                            {{customer.orders.length}}
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                             {{ customer.total_order }}
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          {{ format(customer.created_at)}}
                        </td>
                        
                      </tr>
                    </tbody>
                  </table>
                  <!-- Pagination -->
                  <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination">
                    <div class="hidden sm:block">
                      <p class="text-sm text-gray-700">
                        Showing
                        {{ ' ' }}
                        <span class="font-medium">1</span>
                        {{ ' ' }}
                        to
                        {{ ' ' }}
                        <span class="font-medium">10</span>
                        {{ ' ' }}
                        of
                        {{ ' ' }}
                        <span class="font-medium">20</span>
                        {{ ' ' }}
                        results
                      </p>
                    </div>
                    <div class="flex-1 flex justify-between sm:justify-end">
                      <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                      </a>
                      <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
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
import { formatDate } from '../../Utils/helper';

export default {
  props: {
            customers: Object,
            filters: Object,
            data: Object
        },
        data () {
            return {
                tab: 'tab-0',
                search_value: '',
                selected: [],
                selectAll: false,
                itemsPerPage: 50,
                isMouted: false,
                itemsLength: 100,
                currentPage: 0,
                rightPages: [],
                leftpages: [],
                nextPageUrl: '',
                previouPageUrl: '',
                options: [],
                form: {
                    search: this.filters.search,
                    orderBy: this.filters.orderBy,
                    sortOrder: this.filters.sortOrder
                },
                message: ''
            }
        },
        watch: {
            form: {
                handler: throttle(function() {
                    console.log(this.route) 
                    let query = pickBy(this.form);
                    console.log(Object.keys(query));
                    this.$inertia.replace(this.route('customers', Object.keys(query).length ? query : {  }))
                }, 150),
                deep: true,
            },
        },
		// components: {
        //     AppLayout,
        //     SideNav,
        //     ExportIcon,
        //     ImportIcon,
        //     SaveIcon,
        //     DeleteIcon,
        //     DeleteSolidIcon,
        //     EditIcon,
        //     SortArrow,
        //     Pagination,
        //     CustomerRow,
        //     CreateCustomer,
        //     CustomTab,
        //     TableTabs,
        //     SortArrow
        // },
        computed: {
            myProps() {
                return { data: this.customers.data, links: this.customers.links };
            },
            rows() {
                return this.itemsPerPage * this.currentPage;
            },
            firstRowOnPage() {
                let rows = this.itemsPerPage * this.currentPage;
                return (rows - this.itemsPerPage) + 1;
            },
            numberOfPages() {
                return this.itemsLength / this.itemsPerPage;
            },
            showEllipsis() {
                return (this.itemsLength / this.itemsPerPage) > 7;
            },
            disableNextButton() {
                let lastPage = this.itemsPerPage * this.currentPage;
                return lastPage >= this.itemsLength;
            },
            disablePreviousButton() {
                return this.currentPage === 1;
            }
        },
        methods: {
            resetForm() {
                this.form = {
                    search: null,
                }
            },
            next() {
                axios.get(this.nextPageUrl);
            },
            previous() {
                axios.get(this.previouPageUrl);
            },
            checkAll() {
                this.selected = !this.selectAll ? [...this.customers.data] : [];
                console.log(this.selectAll,this.customers)
            },
            uncheckParentBox(customer) {
                event.stopPropagation();
                let rows = this.selected.filter(s => s.id == customer.id);
                if(rows.length > 0) {
                    this.selected = this.selected.filter(s => s.id != customer.id);
                }   else {
                    this.selected.push(customer);
                }
                this.customers.data.length == this.selected.length ? this.selectAll = true : this.selectAll = false;
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
                this.tab = 'tab-0'
            },
            getMarketingCustomers() {
                this.tab = 'tab-1'
            },
            getRepeatCustomers() {
                this.tab = 'tab-2'
            },
            getProspects() {
                this.tab = 'tab-3'
            },
            edit(customer) {
                this.$inertia.visit(`/customers/${customer.id}/edit`, customer.id);
            },
            view(customer) {
                this.$inertia.visit(`/customers/${customer.id}/view`, customer.id);
            },
            sortByLastname() {
                this.form.orderBy = "last_name";
                this.form.sortOrder = this.form.sortOrder == "asc" ? "desc" : "asc"
            },
            format(dateString) {
            return formatDate(dateString);
        }
        },
        created() {
        },
        mounted() {
            if(this.message.length > 0) {
                alert(this.message);
            }
        }

}
</script>

