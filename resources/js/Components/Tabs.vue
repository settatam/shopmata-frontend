<template>
    <div>
        <div class="tabs" :class="styles">
            <ul class="flex justify-between items-center">
                <li v-for="(tab, index) in tabs" class="tab-header" :class="{ 'is-active': tab.isActive }" :key="index">
                    <a @click="selectTab(tab)" class="block">{{ tab.name }}</a>
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
    props: ['styles'],
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
                if(tab.name == selectedTab.name) {
                    this.$emit("setTab", tab);
                }
            });
        }
    },
    mounted() {
        if(this.tabs.length > 0) {
            this.tabs[0].isActive = true;
        }
    }
}
</script>