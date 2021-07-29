<template>
    <div class="my-4">
    <div class="bg-white">
        <p class="text-lg mb-2 px-6 pt-6">Orders Placed</p>
        <swiper class="swiper" :options="swiperOption" ref="orderSwiper">
            <swiper-slide v-for="order in allOrders" :key="order.id">
                <div class="p-6">
                <div class="flex justify-between mb-3">
                    <p class="text-lg text-purple-darker cursor-pointer">Order #{{order.id}}</p>
                    <p class="text-gray-400">{{order.created_at}}</p>
                </div>
                <p class="my-3">${{order.total}} from Online Store</p>
                <p class="px-4 py inline-flex leading-5 bg-yellow-200 mb-2" v-if="order.status === 'received'">{{order.status}}</p>
                <div class="py-4 flex items-center">
                    <div class="mr-4">
                        <img src="../../../../assets/BrokenImage.svg" class="p-4 border border-gray-200"/>
                    </div>
                    <div>
                        <p class="text-purple-darker">Amout Vert Blue Cotton Miniski</p>
                        <p>Amout Vert / Blue / Large</p>
                    </div>
                </div>
                </div>
            </swiper-slide>
            <div v-if="allOrders.length > 0" class="swiper-paginator flex justify-between p-6 border-t border-gray-200 bg-white" slot="pagination">
                <div class="flex">
                    <span class="swiper-button-prevSlide border border-r-0 p-3 cursor-pointer" :class="start ? 'border-gray-200' : 'border-black'" slot="button-prev" @click="goPrev"><angle-left></angle-left></span>
                    <span class="swiper-button-nextSlide border border-black p-3 cursor-pointer" slot="button-next" @click="goNext"><angle-right></angle-right></span>
                </div>
                <p class="text-purple-darker cursor-pointer" @click="viewOrders">View all orders</p>
            </div>
            <div v-else class="w-full text-center my-4">
                <p>No orders placed yet</p>
            </div>
        </swiper>
    </div>
    </div>
</template>
<script>
import AngleLeft from '../../../../assets/AngleLeft.vue'
import AngleRight from '../../../../assets/AngleRight.vue'
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
export default {
  components: { AngleLeft, AngleRight, Swiper, SwiperSlide },
    props: ['customer_id', 'order', 'orders'],
    data() {
        return {
            start: true,
            end: false,
            swiperOption: {
                pagination: {
                    el: '.swiper-paginator',
                    type: 'custom',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-nextSlide',
                    prevEl: '.swiper-button-prevSlide'
                }
            },
            allOrders: this.orders
        }
    },
    computed: {
        orderDate() {
            return 'May 4, 2020 at 11:10 PM'
        }
    },
    methods: {
        viewOrders() {
            this.$inertia.replace(this.route('orders', {user: this.customer_id}))
        },
        goPrev() {
            this.$refs.orderSwiper.$swiper.slidePrev()
        },
        goNext() {
            console.log(this.$refs.orderSwiper.$swiper)
            this.$refs.orderSwiper.$swiper.slideNext()
        },
        formatDate(date) {
            date = new Date(date);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            let dateArray = date.toLocaleDateString(undefined, options).split(', ');
            let timeArray = date.toLocaleTimeString('en-US').split(":");
            return `${dateArray[1]}, ${dateArray[2]} at ${timeArray[0]}:${timeArray[1]} ${timeArray[2].slice(-2)}`
        }
    },
    // mounted() {
    //     start = this.$refs.orderSwiper.$swiper.isBeginning;
    //     end = this.$refs.orderSwiper.$swiper.isEnd;
    // }
}
</script>
<style scoped>
    /* .swiper{
        padding: 1.5rem !important;
    } */
</style>