<template>
    <div class=" rounded-md bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1>Transaction {{}}</h1>
        </div>

        <div class="p-4 space-y-2">
            <p class="font-medium text-xs lg:text-sm text-black">
                Kit Type: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Status: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Lead: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                From Date/Time:
                <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Received Date/Time:
                <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Incoming Tracking#:
                <span class="font-normal text-purple-darken"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Estimated Value:
                <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Estimated Profit:
                <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Final Offer: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Payment Type: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Payment Date: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Insurance Value:
                <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Tags: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Total DWT: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Bin Location: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Outgoing Tracking#:
                <span class="font-normal text-purple-darken"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Hold Date: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-xs lg:text-sm text-black">
                Website: <span class="font-normal"></span>
            </p>
            <p class="font-medium text-sm text-black">
                Website Categories
                <span class="font-normal"></span>
            </p>
        </div>
    </div>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    components:{AppLayout},
    setup () {
        return {}
    }
}
</script>
