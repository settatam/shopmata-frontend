<template>
    <div class="p-4 md:p-8 my-6 bg-white">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-xl">Customer</h2>
            <chevron-up-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                v-if="openCustomer"
                @click="openCustomer = false"
            />
            <chevron-down-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                v-else
                @click="openCustomer = true"
            />
        </div>
        <div v-if="openCustomer">
            <div
                v-for="customer in notifications.customers"
                :key="customer.id"
                class="flex flex-col md:flex-row mb-5"
            >
                <inertia-link
                    :href="`/admin/settings/notifications/${customer.id}`"
                    class="w-full md:w-3/10"
                >
                    <p class="font-bold text-indigo-700 no-underline">
                        {{ customer.name }}
                    </p>
                </inertia-link>
                <p class="text-gray-500 w-full md:w-7/10">
                    {{ customer.description }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/solid'

export default {
    props: ['notifications', 'openCustomer'],
    components: {
        ChevronUpIcon,
        ChevronDownIcon
    }
}
</script>

