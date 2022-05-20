<template>
    <div class=" my-3 md:px-0 rounded">
        <div class="pt-3 ">
            <h2 class="text-xl text-purple-darken">FILTER BY:</h2>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <div
                class="w-full my-2 border bg-white"
                v-for="(item, mainIndex) in filterLists"
                :key="mainIndex"
            >
                <div class="">
                    <div
                        class="bg-purple-darken text-white font-bold px-2 py-2"
                    >
                        <h1>{{ item.label }}</h1>
                    </div>
                    <div class="pl-3 py-3 bg-white">
                        <div>
                            <div
                                v-for="(filter, filterIndex) in item.fields.options"
                                :key="filter.filterIndex"
                                class="space-x-2 px-2"
                            >
                                <input
                                    type="checkbox"
                                    :id="'id-' + filterIndex + mainIndex"
                                    :name="filter"
                                />
                                <label :for="'id-' + filterIndex + mainIndex" class="text-xs lg:text-xs">
                                    {{ filter.label }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from '@vue/reactivity'
export default {
    props: {
        notifications: Array,
        formObject: Object
    },
    setup (props) {
        const filterLists = reactive(props.formObject.formGroups)
        return {
            filterLists
        }
    }
}
</script>

<style scoped>
/* .myGrid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
} */
</style>
