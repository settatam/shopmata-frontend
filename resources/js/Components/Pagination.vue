<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div
        class="bg-transparent  py-3 flex items-center justify-between border-t border-gray-200"
    >
        <div class="flex-1 flex justify-between sm:hidden">
            <a
                href="#"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
            >
                Previous
            </a>
            <a
                href="#"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
            >
                Next
            </a>
        </div>
        <div
            class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.from }}</span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.to }}</span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.total }}</span>
                    {{ ' ' }}
                    result
                </p>
            </div>
            <div>
                <nav
                    class="relative z-0 inline-flex  rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <span v-for="(page, index) in meta.links" :key="index">
                        <inertia-link
                            v-if="page.label.includes('Previous') && page.url"
                            :href="!page.url ? '#' : page.url"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        >
                            <span class="sr-only">Previous</span>
                            <ChevronLeftIcon
                                class="h-6 w-5"
                                aria-hidden="true"
                            />
                        </inertia-link>
                        <inertia-link
                            v-if="
                                page.label.includes('Previous') == false &&
                                    page.label.includes('Next') == false &&
                                    page.url
                            "
                            :href="page.url"
                            aria-current="page"
                            :class="
                                page.active
                                    ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border  font-medium'
                                    : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border font-medium'
                            "
                        >
                            {{ page.label }}
                        </inertia-link>
                        <inertia-link
                            v-if="page.label.includes('Next') && page.url"
                            :href="!page.url ? '#' : page.url"
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        >
                            <span class="sr-only">Next</span>
                            <ChevronRightIcon
                                class="h-6 w-5"
                                aria-hidden="true"
                            />
                        </inertia-link>
                    </span>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
export default {
    props: {
        meta: Object
    },
    components: {
        ChevronLeftIcon,
        ChevronRightIcon
    }
}
</script>
