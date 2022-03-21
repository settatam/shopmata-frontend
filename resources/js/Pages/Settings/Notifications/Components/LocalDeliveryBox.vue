<template>
    <div class="p-4 md:p-8 my-6 bg-white">
        <div class="flex mb-5 flex-col">
            <div class="flex items-center justify-between">
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

            <div class="text-gray-500">
                <h1>
                    Select an option and edit the template to enable its
                    function.
                </h1>
            </div>
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

                <div class="flex items-center">
                    <input type="checkbox" id="vehicle1" name="Tyvek" />
                    <label for="vehicle1" class="text-gray-500 w-full px-2 ">
                        {{ delivery.description }}</label
                    >
                </div>
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
