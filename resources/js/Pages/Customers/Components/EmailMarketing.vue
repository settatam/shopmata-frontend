<template>
    <div class="px-6 pt-4 pb-6 my-4 bg-white">
        <div class="flex justify-between mb-4">
            <p class="text-lg mb-5">Email marketing</p>
            <p class="text-purple-darker cursor-pointer">Unsubscribe</p>
        </div>
        <div>
            <p class="px-4 py inline-flex leading-5 bg-lightGreen text-green-dark">{{customer.sub || 'Subscribed'}}</p>
            <!-- <p class="px-4 py inline-flex leading-5 bg-red-lighter text-red-darker">{{customer.sub || 'Not Subscribed'}}</p> -->
            <p class="text-purple-darker cursor-pointer mt-4 mb-3">{{customer.email}}</p>
            <p class="text-gray-400">Subscribed on {{subscribedOn}}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['customer'],
    computed: {
        subscribedOn() {
            return 'December 30, 2018'
        }
    }
}
</script>