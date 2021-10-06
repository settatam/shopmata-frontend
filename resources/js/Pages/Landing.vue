<template>
    <!-- <app-layout> -->
    <div id="dashboard" class=" text-gray-800 font-sans-serif">
        <div class="bg-black flex justify-center items-center" v-if="showAd">
            <p class="text-white py-3.5">Promotional message goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Viverra urna venenatis consectetur ornare sit eu ut aliquam.</p>
            <div class="ml-8 cursor-pointer" @click="toggleAd"><cancel-l-icon /></div>
        </div>
        <dashboard-nav/>
        <header>
            <div class="inner md:w-9/10 mx-auto py-20 px-4 md:px-8 flex items-center">
                <div class="w-4.5/10 -mt-1/12">
                    <p class="text-purple-light">Selling made easy</p>
                    <p class="text-5.5xl font-bold text-indigo-900 mb-4 font-sans-serif pr-4">
                    Launch Your Business 3, 2, 1...
                    </p>
                    <p class="mt-5 mb-10">
                    Simple tools for your big ideas. An eCommerce solution that makes it easy to
build a website and grow your business in few clicks without hassle.  
                    </p>
                    <inertia-link href="/auth/get-started/1" class="bg-purple-darker text-white font-semibold cursor-pointer self-center px-4 sm:px-12 py-3 my-5 text-sm">Create Your Store</inertia-link>
                </div>
            </div>
        </header>
        <section id="services" class="md:flex block justify-between md:w-9/10 mx-auto py-20 px-4 md:px-0">
            <div class="md:px-8 px-4 mt-6 md:mt-0">
                <div class="">
                <div class="px-4 py-4 w-12 bg-landingBlue rounded-md mb-8"><img src="../../assets/landing_store.svg" /></div>
                <p class="text-xl text-landingBlueDarker font-bold mb-4">Create a Store</p>
                <p class="text-gray-800 leading-6">
                    Build a store that caters to your unique business needs—with the design tools, features, and support to get you up and running.
                </p>
                </div>
            </div>
            <div class="md:px-8 px-4 mt-6 md:mt-0">
                <div class="md:mx-8">
                <div class="px-4 py-4 w-12 bg-landingOrange rounded-md mb-8"><img src="../../assets/landing_launch.svg" /></div>
                <p class="text-xl text-landingOrangeDarker font-bold mb-4">Launch your store</p>
                <p class="text-gray-800">
                    Design and customize a beautiful storefront with powerful features and expert ecommerce support along the way.
                </p>
                </div>
            </div>
            <div class="md:px-8 px-4 mt-6 md:mt-0">
                <div class="">
                <div class="px-4 py-3.5 w-12 bg-landingGreen rounded-md mb-8"><img src="../../assets/landing_growth.svg" class="h-5" /></div>
                <p class="text-xl text-landingGreenDarker font-bold mb-4">Grow your business</p>
                <p class="text-gray-800">
                    Build your brand with a storefront designed to jumpstart growth, from your very first sale onward.
                </p>
                </div>
            </div>
        </section>
        <section id="run-store" class="flex flex-col-reverse md:flex-row justify-between md:w-9/10 mx-auto pt-20 md:py-20 px-4 md:px-8">
            <div class="md:w-1/2 px-4 md:px-0 md:pr-11 md:mb-0 mb-20 left py-15">
                <img src="../../assets/user_on_mac.jpg" class="w-full"/>
            </div>
            <div class="md:w-1/2 px-4 md:px-0 md:ml-10 flex flex-col justify-center">
                <p class="text-4.5xl font-semibold text-indigo-900 mb-4">
                    Run Your Store from Anywhere
                </p>
                <p class="my-5">
                    Manage your business on the go with the ShopMata tools that help you find customers, drive sales, and manage your day-to-day. Create products, process orders, and keep an eye on key stats in real-time.  
                </p>
                <p>
                    Build, Run, and Grow  a better online business that’s up and running in less time, with less cost. With ShopMata, get an ecommerce platform that won’t hold you back today or in the future—with your choice of the best features and functionality to showcase your products and manage your business.
                </p>
                <inertia-link href="/store/create" class="flex items-center my-8">
                    <p class="text-purple-darker mr-4 font-semibold">Explore How To Sell</p><angle-right-link />
                </inertia-link>
            </div>
        </section>
        <section id="dashboard-actions" class="text-center mx-auto px-4 md:px-8 py-20">
            <div class="mx-auto lg:w-4/10 md:w-6/10">
                <p class="text-4.5xl font-semibold text-indigo-900 sm:px-8">
                    Manage Your Business from One Dashboard
                </p>
                <p class="my-8 px-4 md:px-8">
                    Streamline your operation and run your business smoothly from a single, powerful dashboard.
                </p>
            </div>
            <div class="sm:flex w-full block justify-between md:w-9/10 mx-auto px-4 md:px-0">
                <div class="px-4 w-full md:mr-4 mt-6 md:mt-0 sm:w-1/2 md:w-3/12 bg-light pt-11 pb-9 rounded-md">
                    <div class="">
                        <div class="p-4 flex justify-center mb-6"><img src="../../assets/landing_orders.svg" /></div>
                        <p class="text-xl text-purple-darker font-semibold mb-4">Fulfill and Manage Orders</p>
                        <p class="text-gray-800 leading-6">
                            Track and process all store orders with one dashboard, from purchase to delivery.
                        </p>
                    </div>
                </div>
                <div class="px-4 w-full md:mr-4 mt-6 sm:w-1/2 md:w-3/12 md:mt-0 bg-light pt-11 pb-9 rounded-md">
                    <div class="">
                        <div class="p-4 flex justify-center mb-6"><img src="../../assets/landing_payments.svg" /></div>
                        <p class="text-xl text-purple-darker font-semibold mb-4">Manage Your Payments</p>
                        <p class="text-gray-800 leading-6">
                            Handle all your business transactions from one place with ShopMata payments method.
                        </p>
                    </div>
                </div>
                <div class="px-4 w-full md:mr-4 mt-6 sm:w-1/2 md:w-3/12 md:mt-0 bg-purple-darker pt-11 pb-9 rounded-md">
                    <div class="">
                        <div class="p-4 mb-6 flex justify-center"><img src="../../assets/landing_analytics.svg" /></div>
                        <p class="text-xl text-white font-semibold mb-4">Get Detailed Business Insights</p>
                        <p class="leading-6 text-white">
                            An integrated analytics dashboard lets you review your sales success, focus your marketing efforts and create tailored business reports.
                        </p>
                    </div>
                </div>
                <div class="px-4 w-full mt-6 md:mt-0 sm:w-1/2 md:w-3/12 bg-light pt-11 pb-9 rounded-md">
                    <div class="">
                        <div class="p-4 flex justify-center mb-6"><img src="../../assets/landing_globe.svg" /></div>
                        <p class="text-xl text-purple-darker font-semibold mb-4">Run Your Business from Anywhere</p>
                        <p class="text-gray-800 leading-6">
                            Manage your site smoothly with the Wix mobile app, 24/7. Add new products and track your inventory
                        </p>
                    </div>
                </div>
            </div>
            <inertia-link href="/store/create" class="flex justify-center items-center my-8">
                <p class="text-purple-darker mr-4 font-semibold">Explore More Features</p><angle-right-link />
            </inertia-link>
        </section>
        <section id="faq">
            <div class="md:w-8/10 lg:w-7/10 mx-auto px-4 py-20 md:px-0">
                <p class="text-4.5xl font-semibold text-indigo-900 sm:px-8 mb-13 text-center">
                    Frequently Asked Questions
                </p>
                <accordion>
                    <accordion-item v-for="(question, index) in questions" :key="index">
                        <template slot="accordion-trigger">
                            <div class="">
                                <p class="text-2.75xl">{{question.item}}</p>
                                <!-- <span class="text-black">cancel</span> -->
                            </div>
                        </template>
                        <template slot="accordion-content">
                            <p class="py-4">{{question.answer}}</p>
                        </template>
                    </accordion-item>
                </accordion>
                <inertia-link href="/store/create" class="flex justify-center items-center my-8">
                    <p class="text-purple-darker mr-9 font-semibold">View All</p><angle-right-link />
                </inertia-link>
            </div>
        </section>
        <section class="text-center md:w-8/10 lg:w-7/10 mx-auto px-4 py-20 md:px-0">
            <div class="px-2 sm:px-6 lg:px-8">
                <p class="text-4.5xl font-semibold text-indigo-900 sm:px-8 mb-13">
                    Build, run and grow your eCommerce business with industry-leading tools.
                </p>
                <inertia-link href="/store/create" class="bg-purple-darker text-white font-semibold cursor-pointer self-center px-4 sm:px-12 py-3 text-sm">Create Your Store</inertia-link>
            </div>
        </section>
        <dashboard-footer />
        <!-- <div class="flex-1 ml-56 overflow-hidden">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="bg-white border-gray-200 py:3 md:py-6 lg:py-6 md:mt-32">
                </div>
            </div>
        </div> -->
    </div>
    <!-- </app-layout> -->
</template>

<script>
    import Accordion from '../Components/Accordion.vue'
    import AccordionItem from '../Components/AccordionItem.vue'
    import CancelLIcon from '../../assets/CancelLIcon.vue'

    export default {
        data() {
            return {
                showAd: true,
                questions: [
                    {
                        item: "How does ecommerce software work?",
                        answer: "A traditional ecommerce software allows to build an online store or ecommerce website to allow visitors to purchase products or services online. "
                    },
                    {
                        item: "How much does an online store cost?",
                        answer: "What do you think?"
                    },
                    {
                        item: "Do online stores need a business license?",
                        answer: "Just go with your guts fam. We gat you!"
                    }
                ]
            }
        },
        components: {
            Accordion,
            AccordionItem,
            CancelLIcon
        },
        methods: {
            toggleAd() {
                this.showAd = !this.showAd
            }
        }
    }
</script>

<style scoped>
    #run-store .left {
        background: url('../../assets/ellipsis.svg') no-repeat top -2rem right 6rem, url('../../assets/right-bg.svg') no-repeat bottom 1.75rem right;
    }

    #dashboard header {
        height: 95vh;
        background: rgba(255, 250, 251, 0.42);
    }

    #dashboard header .inner {
        height: inherit;
        background: url('../../assets/hero.svg') no-repeat top 40% right 2rem;
    }

    @media (max-width: 767px) {
        #run-store .left {
            background: url('../../assets/ellipsis.svg') no-repeat top -2rem right, url('../../assets/right-bg.svg') no-repeat bottom 1.75rem right;
        }
    }
</style>