<template>
    <div class="grid  grid-cols-3 md:grid-cols-5 gap-2 mx-4 mt-3 justify-between">
        <a :href="link.link"
            class="rounded-md border text-center border-black hover:border-purple-darken bg-white px-4 py-2 text-sm font-medium text-gray-900 shadow-sm hover:bg-purple-darken hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-darken focus:ring-offset-2 sm:w-auto"
            v-for="link in links" :key="link.index">{{ link.Name }}</a>
    </div>
</template>

<script>
import { reactive } from 'vue';
export default {
    setup() {
        const links = reactive([
            { Name: 'Dashboard', link: "/admin/dashboard" },
            { Name: 'Settings', link: "/admin/settings" },
            { Name: 'Reports', link: "/admin/reports" },
            { Name: 'messages', link: "/admin/messages" },
            { Name: 'Customers', link: "/admin/customers" },
        ])

        return { links }
    }
}

</script>