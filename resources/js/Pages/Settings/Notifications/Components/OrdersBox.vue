<template>
    <div class="p-4 lg:p-8 mb-6 bg-white">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-xl">Orders</h2>
            <chevron-up-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                v-if="openOrder"
                @click="openOrder = false"
            />
            <chevron-down-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                v-else
                @click="openOrder = true"
            />
        </div>

        <div v-if="openOrder">
            <div
                v-for="order in notifications.orders"
                :key="order.id"
                class="flex mb-5 flex-col md:flex-row"
            >
                <inertia-link
                    :href="`/admin/settings/notifications/${order.id}`"
                    class="w-full md:w-3/10"
                >
                    <p
                        class="font-bold text-indigo-700 no-underline cursor-pointer"
                    >
                        {{ order.name }}
                    </p>
                </inertia-link>
                <p class="text-gray-500 w-full md:w-7/10">
                    {{ order.description }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/solid'

export default {
    props: ['notifications','openOrder'],
    components: {
        ChevronUpIcon,
        ChevronDownIcon
    }
}
</script>
