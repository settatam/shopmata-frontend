<template>
    <div class="p-4 md:p-8 my-6 bg-white">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-xl">
                Email Marketing
            </h2>
            <chevron-up-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                @click="openMarketing = false"
                v-if="openMarketing"
            />
            <chevron-down-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                @click="openMarketing = true"
                v-else
            />
        </div>
        <div v-if="openMarketing">
            <div
                v-for="email in notifications.marketings"
                :key="email.id"
                class="flex flex-col md:flex-row mb-5"
            >
                <inertia-link
                    :href="`/settings/notifications/${email.id}`"
                    class="w-full md:w-3/10"
                >
                    <p
                        class="font-bold text-indigo-700 no-underline cursor-pointer"
                    >
                        {{ email.name }}
                    </p>
                </inertia-link>
                <p class="text-gray-500 w-full md:w-7/10">
                    {{ email.description }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/solid'

export default {
    props: ['notifications', 'openMarketing'],
    components: {
        ChevronUpIcon,
        ChevronDownIcon
    }
}
</script>
