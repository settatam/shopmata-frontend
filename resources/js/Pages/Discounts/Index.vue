<template>
    <app-layout>
        <div class="px- sm:px-6 lg:mx-auto lg:px-">
            <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
          <div class="flex-1 min-w-0">
            <!-- Profile -->
            <div class="flex items-center">
              <div>
                <div class="flex items-center">
                  <h1 class=" ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate" > Discount </h1>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            <inertia-link
              href="discounts/create"
              type="button"
              class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
              Create Discount
            </inertia-link>
          </div>
        </div>
        </div>
        <div class="w-full flex justify-end md:mt-0">
            <create-discount :products="products" :countries="countries" :categories="categories" />
        </div>
        <div class="px-3 md:px-6">
                    <div class="flex tab py-2">
                        <table-tabs :activeClass='"border-solid border-b-4 border-purple-darker"' class="w-full overflow-auto" :styles='"border-solid border-b-4 border-gray-100"' :parentRoute="'discounts'" :queryKey="'status'">
                            <custom-tab name="All">
                                <div class="pb-4 flex justify-between mt-4">
                                    <div class="">
                                        <input class="search-bar border-solid border border-gray-400 text-4 py-2 pl-10 pr-2 placeholder-gray-400 focus:outline-none mr-2" placeholder="Filter Dicscounts" v-model="form.search" />
                                        <!-- <select class="p-2 pr-6 border-solid border border-gray-200 text-gray-500 focus:outline-none w-32 mr-2 mt-6 sm:mt-0">
                                            <option value="">Location</option>
                                            <option :key="index" v-for="(option, index) in options" :value="option.value">{{option.label}}</option>
                                        </select>
                                        <select class="p-2 pr-6 border-solid border border-gray-200 text-gray-500 focus:outline-none w-32 mr-2 mt-6 sm:mt-0">
                                            <option value="">Orders</option>
                                            <option :key="index" v-for="(option, index) in options" :value="option.value">{{option.label}}</option>
                                        </select>
                                        <select class="p-2 pr-6 border-solid border border-gray-200 text-gray-500 focus:outline-none w-32 mr-2 mt-6 sm:mt-0">
                                            <option value="">Total Order</option>
                                            <option :key="index" v-for="(option, index) in options" :value="option.value">{{option.label}}</option>
                                        </select> -->
                                    </div>
                                </div>
                                <div class="px-2 overflow-auto">
                                    <div class="table min-w-full divide-y divide-gray-100">
                                        <div class="table-header w-full">
                                            <div class="w-full flex">
                                                <p class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-bold tracking-wide text-gray-600 border-t-3">
                                                    <input v-model="selectAll" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-400 focus:outline-none disabled:bg-gray-400" @click="checkAll" :disabled="discounts.data.length === 0">
                                                </p>
                                                <p class="w-1/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-400">S/N</p>
                                                <p class="w-3/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-400 cursor-pointer"><span class="flex pr-2">Code</span></p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-400">Status</p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-400">Start</p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-400">End</p>
                                            </div>
                                        </div>
                                        <div class="divide-y divide-gray-200">
                                            <discount-row :key="discount.id" v-for="(discount, index) in discounts.data" :discount="discount" 
                                            :index="index" @uncheckParentBox="uncheckParentBox" :selected="selected"></discount-row>
                                            <div v-if="discounts.data.length === 0" class="text-center my-6">
                                                <p className="border-t px-6 py-4 my-10 text-center" colSpan="6">
                                                    No discounts found.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <pagination :links="myProps.links" v-if="discounts.data.length > 0"/>
                                </div>
                            </custom-tab>
                            <!-- <custom-tab name="Active" :parent="'/discounts'">
                                <div class="pb-4 flex justify-between my-4">
                                    <div class="">
                                        <input class="search-bar border-solid border border-gray-400 text-4 py-2 pl-10 pr-2 placeholder-gray-400 focus:outline-none mr-2" placeholder="Filter Dicscounts" v-model="form.search" />
                                    </div>
                                </div>
                                <div class="px-2 overflow-auto">
                                    <div class="table min-w-full divide-y divide-gray-100">
                                        <div class="table-header w-full">
                                            <div class="w-full flex">
                                                <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-bold tracking-wide text-gray-600 border-t-3">
                                                    <input v-model="selectAll" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-400 focus:outline-none disabled:bg-gray-400" @click="checkAll" :disabled="discounts.data.length === 0">
                                                </div>
                                                <p class="w-1/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">S/N</p>
                                                <p class="w-3/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600 cursor-pointer"><span class="flex pr-2">Code</span></p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">Status</p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">Start</p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">End</p>
                                            </div>
                                        </div>
                                        <div class="divide-y divide-gray-200">
                                            <discount-row :key="discount.id" v-for="(discount, index) in discounts.data" :discount="discount" 
                                            :index="index" @uncheckParentBox="uncheckParentBox" :selected="selected"></discount-row>
                                            <div v-if="discounts.data.length === 0" class="text-center my-6">
                                                <p className="border-t px-6 py-4 my-10 text-center" colSpan="6">
                                                    No discounts found.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <pagination :links="myProps.links" v-if="discounts.data.length > 0"/>
                                </div>
                            </custom-tab> -->
                            <!-- <custom-tab name="Scheduled" :parent="'/discounts'">
                                <div class="pb-4 flex justify-between my-4">
                                    <div class="">
                                        <input class="search-bar border-solid border border-gray-400 text-4 py-2 pl-10 pr-2 placeholder-gray-400 focus:outline-none mr-2" placeholder="Filter Dicscounts" v-model="form.search" />
                                    </div>
                                </div>
                                <div class="px-2 overflow-auto">
                                    <div class="table min-w-full divide-y divide-gray-100">
                                        <div class="table-header w-full">
                                            <div class="w-full flex">
                                                <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-bold tracking-wide text-gray-600 border-t-3">
                                                    <input v-model="selectAll" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-400 focus:outline-none disabled:bg-gray-400" @click="checkAll" :disabled="discounts.data.length === 0">
                                                </div>
                                                <p class="w-1/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">S/N</p>
                                                <p class="w-3/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600 cursor-pointer"><span class="flex pr-2">Code</span></p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">Status</p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">Start</p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">End</p>
                                            </div>
                                        </div>
                                        <div class="divide-y divide-gray-200">
                                            <discount-row :key="discount.id" v-for="(discount, index) in discounts.data" :discount="discount" 
                                            :index="index" @uncheckParentBox="uncheckParentBox" :selected="selected"></discount-row>
                                            <div v-if="discounts.data.length === 0" class="text-center my-6">
                                                <p className="border-t px-6 py-4 my-10 text-center" colSpan="6">
                                                    No discounts found.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <pagination :links="myProps.links" v-if="discounts.data.length > 0"/>
                                </div>
                            </custom-tab> -->
                            <!-- <custom-tab name="Expired" :parent="'/discounts'">
                                <div class="pb-4 flex justify-between my-4">
                                    <div class="">
                                        <input class="search-bar border-solid border border-gray-400 text-4 py-2 pl-10 pr-2 placeholder-gray-400 focus:outline-none mr-2" placeholder="Filter Dicscounts" v-model="form.search" />
                                    </div>
                                </div>
                                <div class="px-2 overflow-auto">
                                    <div class="table min-w-full divide-y divide-gray-100">
                                        <div class="table-header w-full">
                                            <div class="w-full flex">
                                                <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-bold tracking-wide text-gray-600 border-t-3">
                                                    <input v-model="selectAll" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-400 focus:outline-none disabled:bg-gray-400" @click="checkAll" :disabled="discounts.data.length === 0">
                                                </div>
                                                <p class="w-1/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">S/N</p>
                                                <p class="w-3/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600 cursor-pointer"><span class="flex pr-2">Code</span></p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">Status</p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">Start</p>
                                                <p class="w-2/10 px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">End</p>
                                            </div>
                                        </div>
                                        <div class="divide-y divide-gray-200">
                                            <discount-row :key="discount.id" v-for="(discount, index) in discounts.data" :discount="discount" 
                                            :index="index" @uncheckParentBox="uncheckParentBox" :selected="selected"></discount-row>
                                            <div v-if="discounts.data.length === 0" class="text-center my-6">
                                                <p className="border-t px-6 py-4 my-10 text-center" colSpan="6">
                                                    No discounts found.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <pagination :links="myProps.links" v-if="discounts.data.length > 0"/>
                                </div>
                            </custom-tab> -->
                        </table-tabs>
                    </div>
                </div>
    </app-layout>
</template>

<script>
    import { ref } from 'vue'
    import AppLayout from "../../Layouts/AppLayout.vue";
    import Create from './Create.vue'
    import ExportIcon from '../../../assets/ExportIcon'
    import ImportIcon from '../../../assets/ImportIcon'
    import SaveIcon from '../../../assets/SaveIcon'
    import SortIcon from '../../../assets/SortIcon'
    import EditIcon from '../../../assets/EditIcon'
    import AngleUpIcon from '../../../assets/AngleUpIcon'
    import Pagination from '../../Components/Pagination/Pagination'
    import mapValues from 'lodash/mapValues'
    import pickBy from 'lodash/pickBy'
    import throttle from 'lodash/throttle'
    import DiscountRow from './Components/DiscountRow.vue'
    import CustomTab from '../../Components/CustomTab.vue'
    import Tabs from '../../Components/Tabs.vue'
    import TableTabs from '../../Components/TableTabs.vue'

export default {
    components: {
        AppLayout,
        Create,
        ExportIcon,
            ImportIcon,
            SaveIcon,
            SortIcon,
            AngleUpIcon,
            Pagination,
            DiscountRow,
            //CreateDiscount,
            //Tabs,
            CustomTab,
            TableTabs
    },
    props: {
            discounts: Object,
            filters: Object,
            countries: Array,
            categories: Array,
            products: Array
        },
        data () {
            return {
                tab: 'tab-0',
                search_value: '',
                tabs:[],
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
                    search: this.filters.search
                }
            }
        },
         watch: {
            form: {
                handler: throttle(function() {
                    console.log(this.route) 
                    let query = pickBy(this.form);
                    console.log(query);
                    this.$inertia.replace(this.route('discounts', Object.keys(query).length ? query : {  }))
                }, 150),
                deep: true,
            },
        },
        computed: {
            myProps() {
                return { data: this.discounts.data, links: this.discounts.links };
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
                this.selected = !this.selectAll ? [...this.discounts.data] : [];
                // console.log(this.selectAll,this.discounts)
            },
            uncheckParentBox() {
                event.stopPropagation();
                this.selectAll = false;
            },
            showCheckedCustomers() {
                // console.log(this.discounts);
                // console.log(this.selected);
            },
            getAllDiscounts() {
                this.tab = 'tab-0'
            },
            getActiveDicounts() {
                this.tab = 'tab-1'
            },
            getScheduledDiscounts() {
                this.tab = 'tab-2'
            },
            getExpiredDiscounts() {
                this.tab = 'tab-3'
            },
            edit(discount) {
                this.$inertia.visit(`/discounts/${discount.id}/edit`, discount.id);
            },
            view(discount) {
                this.$inertia.visit(`/discounts/${discount.id}/view`, discount.id);
            },
        },
        created() {
            // console.log(this.categories)
        },
}
</script>