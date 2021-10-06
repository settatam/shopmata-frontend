<template>
    <div>
        <div class="tabs" :class="styles">
            <ul class="flex justify-start items-center">
                <li v-for="(tab, index) in tabs" class="data-tab-header -mb-1" :class="{ 'current-data': tab.isActive }" :key="index">
                    <!-- <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a> -->
                    <p @click="selectTab(tab)" class="cursor-pointer">{{ tab.name }}</p>
                </li>
            </ul>
        </div>

        <div class="tabs-details">
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    props: ['styles', 'parentRoute', 'queryKey'],
    data() {
        return {tabs: [] };
    },
    
    created() {
        this.tabs = this.$children;
    },
    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name == selectedTab.name);
                let query = {};
                if(!selectedTab.default)    query[this.queryKey] = selectedTab.name.toLowerCase()
                this.$inertia.replace(this.route(this.parentRoute, query));
            });
        }
    },
    mounted() {
        if(this.tabs.length > 0) {
            this.tabs[0].isActive = true
        }
    }
}
</script>