<template>
    <div class="p-4 md:p-8 my-6 bg-white">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-xl">Local Delivery</h2>
            <chevron-up-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                v-if="openLocal"
                @click="openLocal = false"
            />
            <chevron-down-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                v-else
                @click="openLocal = true"
            />
        </div>

        <div v-if="openLocal">
            <div
                v-for="delivery in notifications.deliveries"
                :key="delivery.id"
                class="flex flex-col md:flex-row mb-5"
            >
                <inertia-link
                    :href="`/settings/notifications/${delivery.id}`"
                    class="w-full md:w-3/10"
                >
                    <p class="font-bold text-indigo-700 no-underline">
                        {{ delivery.name }}
                    </p>
                </inertia-link>
                <p class="text-gray-500 w-full">
                    {{ delivery.description }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/solid'

export default {
    props: ['notifications', 'openLocal'],
    components: {
        ChevronUpIcon,
        ChevronDownIcon
    }
}
</script>
