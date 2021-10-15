<template>
    <app-layout>
        <div class="flex-1 ml-0 lg:ml-64 md:ml-64 overflow-hidden mr-0 lg:mr-8 md:mr-8">
            <div class="bg-white border-gray-200 py-3 md:py-6 lg:py-6 md:mt-32 main-div">
                <div class="flex justify-between items-center mb-10 px-3 md:px-6 lg:px-6">
                    <h2 class="text-2xl text-black font-semibold">Store Domains</h2>
                    <div class="flex justify-between items-center">
                        <button @click="addDomain" class="add-btn bg-purple-darker text-white font-semibold cursor-pointer self-center pl-10 pr-4 py-3.5 ml-8">Add Custom Domain</button>
                    </div>
                </div>
                <div class="px-3 md:px-6 lg:px-6 pb-4 flex justify-between flex-col">
                    <h3 class="text-xl pb-5 leading-4 text-black font-semibold block"> Shopmata Domain</h3>
                     <div class="flex justify-center items-center border-b-2 border-gray-100">
                        <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10 md:px-10 lg:px-10 xl:px-10 min-w-full">
                            <div class="mt-2 col-span-1 hidden md:block lg:block xl:block"></div>
                            <div class="mt-2 flex col-span-3 mr-2 cursor-pointer">Domain Name </div>
                            <div class="mt-2 flex col-span-2 mr-2 cursor-pointer">Provider </div>
                            <div class="mt-2 col-span-3 cursor-pointer">Status</div>
                            <div class="cursor-pointer mt-2 col-span-1 hidden md:block lg:block xl:block">
                                Date added
                            </div>
                        </div>
                    </div>
                    <item-row :key="domain.id" v-for="domain in shopmata_domain" :domain="domain" @edit="edit(domain)" @uncheckParentBox="uncheckParentBox" :selected="selected"></item-row>
                </div>
                <div class="px-3 md:px-6 lg:px-6 pb-4 flex justify-between flex-col">
                    <h3 class="text-xl pb-5 leading-4 text-black font-semibold block border-b-2 border-gray-100"> Custom Domains</h3>
                    <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10 md:px-10 lg:px-10 xl:px-10 min-w-full">
                            <div class="mt-2 col-span-1 hidden md:block lg:block xl:block"></div>
                            <div class="mt-2 flex col-span-3 mr-2 cursor-pointer">Domain Name </div>
                            <div class="mt-2 flex col-span-2 mr-2 cursor-pointer">Provider </div>
                            <div class="mt-2 col-span-3 cursor-pointer">Status</div>
                            <div class="cursor-pointer mt-2 col-span-1 hidden md:block lg:block xl:block">
                                Date added
                            </div>
                        </div>
                    <item-row :key="domain.id" v-for="domain in custom_domains" :domain="domain" @edit="edit(domain)" @uncheckParentBox="uncheckParentBox" :selected="selected"></item-row>
                </div>
                <div class="px-2 0">
                    
                    <div class="flex justify-center items-center py-4 border-t-2 border-gray-100"  v-if="!custom_domains.length">
                        <div className="border-t px-6 py-4">
                            No Domain found.
                        </div>
                    </div>
              
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    
    export default {
        props: {
            shopmata_domain: Array,
            custom_domains: Array,
        },
        data () {
            return {
                // all_products: this.products.data,
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
                options: [
                    {
                        label: 'Option 1',
                        value: 'option1'
                    },
                    {
                        label: 'Option 2',
                        value: 'option2'
                    },
                    {
                        label: 'Option 3',
                        value: 'option3'
                    }
                ]
            }
        },
        components: {
            AppLayout,
        },
       
        computed: {
            
        },
        watch: {
 
        },
        methods: {
            resetForm() {
                this.form = {
                    search: null,
                    tag: null,
                    brand: null,
                    status: null
                }
            },
            next() {
                axios.get(this.nextPageUrl);
            },
            previous() {
                axios.get(this.previouPageUrl);
            },
            checkAll() {
                this.selected = !this.selectAll ? [...this.products.data] : [];
                console.log(this.selectAll,this.products)
            },
            uncheckParentBox() {
                event.stopPropagation();
                this.selectAll = false;
            },
            showCheckedProducts() {
                console.log(this.products);
                console.log(this.selected);
            },
            getAllProducts() {
                this.tab = 'tab-0';
                this.resetForm();
            },
            getActiveProducts() {
                this.tab = 'tab-1';
                this.form.status='active'
            },
            getDraftProducts() {
                this.tab = 'tab-2'
                this.form.status='draft'
            },
            getArchivedProducts() {
                this.tab = 'tab-3'
                this.form.status='archive'
            },
            edit(product) {
                this.$inertia.visit(`/products/${product.id}/edit`, product.id);
            },
            addProduct() {
                this.$inertia.visit(`/domains/create`);
            },
            addDomain() {
                this.$inertia.visit(`/store/domains/create`);
            }
        },
        created() {
            // this.nextPageUrl= this.products.next_page_url || '';
            // this.previouPageUrl= this.products.prev_page_url || '';
            // this.currentPage= this.products.current_page || '';
        }
    }
</script>

<style scoped>

@media only screen and (max-width: 600px) {
  .main-div{
      margin-top: 100px;
    }   
}
</style>