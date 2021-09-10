<template>
	<app-layout>
        <side-nav></side-nav>
        <div class="overflow-hidden xl:w-3/5 w-9/10 m-auto">
            <div class="overflow-auto border-gray-100 my-10 mx-auto md:mt-32 md:ml-56">
                <form @submit.prevent="submit">
                    <div class="bg-white mb-10 py-6">
                        <div class="bg-white flex justify-between xl:px-28 px-6">
                            <p class="text-black text-2xl font-semilbold">Update Brand</p>
                        </div>
                        <brand-details-form :brand="brand"></brand-details-form>
                        <search-details-form :search="search"></search-details-form>
                        <div class="w-full flex justify-center">
                            <t-button class="text-white bg-purple-darker active:bg-purple-darker font-medium border border-transparent md:px-11 py-3.5" type="submit">Save Changes</t-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
	import AppLayout from './../../Layouts/AppLayout'
    import BrandDetailsForm from './Components/BrandDetailsForm'
    import SearchDetailsForm from './Components/SearchDetailsForm'
    import SideNav from './../../Layouts/SideNav'
	export default {
		props: ['brand'],
		components: {
            AppLayout,
            SideNav,
            SearchDetailsForm,
            BrandDetailsForm
        },
        data() {
            return {
                brand: {
                    name: '',
                    description: '',
                    page_title: ''
                },
                search: {
                    meta_keyword: '',
                    search_keywords: '',
                    meta_description: '',
                    meta_title: ''
                }
            }
        },
        computed: {
            formData() {
                return {...this.brand, ...this.search};
            }
        },
        methods: {
            submit() {
                console.log(this.formData);
                this.$inertia.put(`/brands/${this.brand.id}`, this.formData);
            }
        },
        mounted() {
            const {name, description, page_title, meta_keyword, search_keywords, meta_description, meta_title} = this.brand;
            this.brand = {
                name,
                description,
                page_title
            }
            this.search = {
                meta_keyword,
                search_keywords,
                meta_description,
                meta_title
            }
        }
	}
</script>