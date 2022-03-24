<template>
    <div class=" rounded-md bg-white lg:mx-2 ">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1>Customer Information</h1>
        </div>

        <div class="p-4 space-y-2">
            <h1 class="text-purple-darken 2xl font-bold">AMARILIS REYNOSO (ID:4178)</h1>
            <p class="font-bold text-xs lg:text-sm text-black">
                Address 1:
                <span class="font-normal">{{customer.address}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Address 2:
                <span class="font-normal">{{customer.address2}}</span>
            </p>
            <p v-if="customer.state" class="font-bold text-xs lg:text-sm text-black">
                City, State, Zip:
                <span class="font-normal ">{{customer.city}}, {{customer.state.code}}, {{customer.zip}}</span>
            </p>
            <p v-else class="font-bold text-xs lg:text-sm text-black">
                City, State, Zip:
                <span class="font-normal ">{{customer.zip}}, {{customer.zip}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Phone:
                <span class="font-normal">{{customer.phone_number}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Home/Work:
                <span class="font-normal">{{}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Email: <span class="font-normal text-purple-darken">{{customer.email}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Lead: <span class="font-normal">{{}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                DOB: <span class="font-normal">{{customer.dob}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Gender:
                <span class="font-normal">{{}}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                IP Address: <span class="font-normal">{{}}</span>
            </p>
            
        </div>
    </div>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    props:['customer'],
    components: { AppLayout },
    setup () {
        return {}
    }
}
</script>
