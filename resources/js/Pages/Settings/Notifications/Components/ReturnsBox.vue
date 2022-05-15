<template>
    <div class="p-4 md:p-8 my-6 bg-white">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-xl">Returns</h2>
            <chevron-up-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                @click="openReturn = false"
                v-if="openReturn"
            />
            <chevron-down-icon
                class="w-6 h-6 text-indigo-700 cursor-pointer"
                @click="openReturn = true"
                v-else
            />
        </div>
        <div v-if="openReturn">
            <div
                v-for="(ret, index) in notifications.returns"
                :key="index"
                class="flex flex-col md:flex-row mb-5"
            >
                <inertia-link
                    :href="`/admin/settings/notifications/${ret.id}`"
                    class="w-full md:w-3/10"
                >
                    <p
                        class="font-bold text-indigo-700 no-underline cursor-pointer"
                    >
                        {{ ret.name }}
                    </p>
                </inertia-link>
                <p class="text-gray-500 w-full md:w-7/10">
                    {{ ret.description }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/solid'

export default {
    props: ['notifications', 'openReturn'],
    components: {
        ChevronUpIcon,
        ChevronDownIcon
    }
}
</script>
