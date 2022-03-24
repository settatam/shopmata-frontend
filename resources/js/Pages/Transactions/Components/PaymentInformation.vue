<template>
    <div class=" rounded-md bg-white lg:mx-2 ">
        <div class="rounded-t-md w-full bg-purple-darken py-4 pl-4 text-white">
            <h1>Payment Information</h1>
        </div>

        <div class="p-4 space-y-2">
            <p class="font-bold text-xs lg:text-sm text-black">
                Method:
                <span class="font-normal"></span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Payable To:
                <span class="font-normal"></span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Account:
                <span class="font-normal"></span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Address:
                <span class="font-normal"></span>
            </p>
            
        </div>
    </div>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    components: { AppLayout },
    setup () {
        return {}
    }
}
</script>
