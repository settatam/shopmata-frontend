<template>
    <div class="bg-white">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center mb-2">
                <span>
                    <img :src="customer.profile_pic" v-if="customer.profile_photo_url" class="bg-purple-darker rounded-full w-6 h-6"/>
                    <img src="../../../../assets/CustomerAvatar.svg" v-else class="bg-purple-darker rounded-full p-0.5"/>
                </span>
                <p class="ml-4 text-lg">{{customer.first_name}} {{customer.last_name}}</p>
            </div>
            <div>
                <p class="text-gray-400">{{customer.address || 'Boston, MA, United States'}}</p>
                <p class="text-gray-400">Customer for {{customer.customer_since.slice(0, -4)}}</p>
            </div>
            <div class="my-4 relative">
                <label class="block text-black font-semibold mb-2 bg-transparent" for="note">
                    Customer Note
                </label>
                <input class="appearance-none border border-gray-400 bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="text" placeholder="Add a note" v-model="customer.note">
                <t-button class="text-white bg-purple-darker active:bg-purple-darker text-sm font-medium border border-transparent px-7 py-1 absolute -ml-22 mt-0.5 focus:outline-none">Add</t-button>
            </div>
        </div>
        <div class="flex justify-between p-6">
            <div class="">
                <p>Last Order</p>
                <p class="text-lg mt-3 mb-2">{{customer.last_order_placed || 0}}</p>
                <p>From {{'online'}} store</p>
            </div>
            <div class="">
                <p>Total spent to date</p>
                <p class="text-lg mt-3 mb-2">${{customer.total_order || 0}}</p>
                <p>{{customer.number_of_orders}} orders</p>
            </div>
            <div>
                <p>Average order value</p>
                <p class="text-lg mt-3 mb-2">${{customer.average_order || 0}}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  components: { },
    props: ['customer', 'user'],
    data() {
        return {
            
        }
    },
    computed: {
        profilePicture() {
            return this.customer.profile_pic?.trim().length > 0 ? this.customer.profile_pic : "../../../../assets/CustomerAvatar.svg"
        },
        years() {
            return new Date() - new Date(this.customer.created_at);
            // return diff;
        }
    },
    mounted() {
        console.log(this.customer);
    }
}
</script>