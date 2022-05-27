<template>
    <div>
        <ImageSlider :images="images" :open="openModal" @close="doClose">
        </ImageSlider>

        <div class="sm:flex sm:items-center mt-6">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">{{ title }}</h1>
                <p class="mt-2 text-sm text-gray-700">{{ description }}</p>
            </div>


            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    @click="filterToggle()"
                >
                    Filter by:
                </button>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    v-if="exportable"
                    @click="exportData()"
                >
                    Export
                </button>
            </div>

        </div>

        <div>
            <Filter v-if="filterToggleStatus" @getFilters="filterValues" @switchToggle="filterToggle"/>
        </div>

        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                >
                    <div
                        class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5"
                    >
                        <div
                            class="shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600"
                            v-if="isSearchable"
                        >
                            <input
                                type="search"
                                name="filter"
                                id="name"
                                class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm px-3 py-3"
                                :placeholder="filterText"
                                @keyup="handleSearchChange"
                                v-model="pageFilters.term"
                            />
                        </div>
                        <div
                            v-if="selectedItems.length && actions.length"
                            class="px-3 py-3 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16"
                        >
                            <form
                                v-for="(action, index) in actions"
                                class="flex mr-2 items-center"
                            >
                                <div
                                    v-for="(formGroup,
                                    formIndex) in action.formGroups"
                                    class="mr-3"
                                >
                                    <label v-if="formGroup.label">
                                        {{ formGroup.label }}</label
                                    >
                                    <select
                                        v-model="
                                            formGroup.field.attributes.value
                                        "
                                        :name="formGroup.field.attributes.name"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md mr-2"
                                    >
                                        <option
                                            v-for="option in formGroup.field
                                                .options"
                                            :value="option.value"
                                        >
                                            {{ option.text }}
                                        </option>
                                    </select>
                                </div>
                                <button
                                    type="button"
                                    @click="doAction(index, 0)"
                                    class="inline-flex h-10 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                >
                                    {{ action.buttons[0].label }}
                                </button>
                            </form>
                            <p class="text-gray-500 text-xs">
                                {{ selectedItems.length }} Items selected
                            </p>
                        </div>
                        <table
                            class="min-w-full divide-y divide-gray-300 table-fixed"
                        >
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="relative w-12 px-6 sm:w-16 sm:px-8"
                                        v-if="hasCheckBox"
                                    >
                                        <input
                                            type="checkbox"
                                            class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
                                            :checked="
                                                indeterminate ||
                                                    selectedItems.length ===
                                                        items.length
                                            "
                                            :indeterminate="indeterminate"
                                            @change="
                                                selectedItems = $event.target
                                                    .checked
                                                    ? items.map(i => i.id)
                                                    : []
                                            "
                                        />
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900"
                                        v-for="(field, index) in fields"
                                        :key="index"
                                    >
                                        {{ field[1] }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="(item, index) in items" :key="index">
                                    <td
                                        class="relative w-12 px-6 sm:w-16 sm:px-8"
                                        v-if="hasCheckBox"
                                    >
                                        <div
                                            v-if="
                                                selectedItems.includes(item.id)
                                            "
                                            class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"
                                        ></div>
                                        <input
                                            type="checkbox"
                                            class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
                                            :value="item.id"
                                            v-model="selectedItems"
                                        />
                                    </td>
                                    <td
                                        class="px-3 py-4 text-xs text-gray-900"
                                        v-for="(tranItem, tranIndex) in item"
                                    >
                                        <div
                                            class="flex items-center"
                                            v-if="
                                                item[tranIndex].type ==
                                                    'customer_info'
                                            "
                                        >
                                            <div class="ml-4">
                                                <div
                                                    class="font-medium text-gray-900"
                                                >
                                                    <inertia-link
                                                        :href="
                                                            item[tranIndex].href
                                                        "
                                                        class="text-indigo-700 font-bold"
                                                    >
                                                        <span
                                                            v-if="
                                                                item[
                                                                    tranIndex
                                                                ].hasOwnProperty(
                                                                    'class'
                                                                )
                                                            "
                                                            :class="
                                                                item[tranIndex]
                                                                    .class
                                                            "
                                                        >
                                                            {{ item.customer_info.data.first_name }}
                                                            {{ item.customer_info.data.last_name }}
                                                        </span>
                                                        <span v-else>
                                                            {{ item.customer_info.data.first_name }}
                                                            {{ item.customer_info.data.last_name }}

                                                        </span>
                                                    </inertia-link>
                                                </div>
                                                <div class="text-gray-500">
                                                    {{ item.customer_info.data.email }} <br />
                                                    {{ item.customer_info.data.address.address }} <br />
                                                    {{ item.customer_info.data.address.state.code }} {{item.customer_info.data.address.zip }}
                                                    {{ item.customer_info.data.address.phone }}
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center"
                                            v-else-if="
                                                item[tranIndex].type ==
                                                    'slideshow'
                                            "
                                        >
                                            <a
                                                class="h-10 w-10 flex-shrink-0 cursor-pointer"
                                                v-if="item.pictures.data.length"
                                                @click="
                                                    doSlider(item.pictures.data)
                                                "
                                            >
                                                <img
                                                    class="h-10 w-10"
                                                    :src="
                                                        item.pictures.data[0]
                                                            .url
                                                    "
                                                    alt=""
                                                />
                                            </a>
                                        </div>
                                        <div
                                            class="flex items-center"
                                            v-else-if="
                                                item[tranIndex].type == 'link'
                                            "
                                        >
                                            <inertia-link
                                                :href="item[tranIndex].href"
                                                class="text-indigo-700 font-bold"
                                            >
                                                <span
                                                    v-if="
                                                        item[
                                                            tranIndex
                                                        ].hasOwnProperty(
                                                            'class'
                                                        )
                                                    "
                                                    :class="
                                                        item[tranIndex].class
                                                    "
                                                >
                                                    {{ item[tranIndex].data }}
                                                </span>
                                                <span v-else>
                                                    {{ item[tranIndex].data }}
                                                </span>
                                            </inertia-link>
                                        </div>

                                        <div
                                            class="flex items-center"
                                            v-else-if="
                                                item[tranIndex].type ==
                                                    'description'
                                            "
                                        >
                                            <span class="w-96 min-width-full">{{
                                                item[tranIndex].data
                                            }}</span>
                                        </div>

                                        <div
                                            class="flex items-center max-w-xs flex-wrap"
                                            v-else
                                        >
                                            <span
                                                v-if="
                                                    item[
                                                        tranIndex
                                                    ].hasOwnProperty('class')
                                                "
                                                :class="item[tranIndex].class"
                                            >
                                                {{ item[tranIndex].data }}
                                            </span>
                                            <span v-else>
                                                {{ item[tranIndex].data }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <table-pagination
                    :meta="pagination"
                    @updatePage="updatePage"
                ></table-pagination>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue'
import Filter from '../../Components/Filter.vue'
import axios from 'axios'
import Pagination from '../../Components/Pagination'
import { Inertia } from '@inertiajs/inertia'
import ImageSlider from './ImageSlider'
import TablePagination from '../../Components/TablePagination'

const props = defineProps({
    filters: Object,
    term: String,
})

const emits = defineEmits(['action', 'termUpdated'])

const transactions = ref([])
const title = ref('')
const description = ref('')
let fields = ref([])
let items = ref([])
const actions = ref([])
const checked = ref(false)
const selectedItems = ref([])
const hasCheckBox = ref(false)
const indeterminate = computed(
    () =>
        selectedItems.value.length > 0 &&
        selectedItems.value.length < items.length
)
const filterText = ref('Search Table')
const bulkAction = ref('')
const exportable = ref(false)
const isSearchable = ref(false)
const pagination = ref({})
const openModal = ref(false)
const images = ref([])
const pageFilters = ref({})
const searchTerm = ref(props.term)
const filterToggleStatus = ref(false)

function filterToggle(){
    filterToggleStatus.value = !filterToggleStatus.value
}

const filters = props.filters

onMounted(() => {
    pageFilters.value = props.filters
    getData()
})
const bulkActions = el => {}

function doAction (index, formGroupIndex) {
    //we should emit actions here ...
    emits('action', actions.value[index], selectedItems.value)
}


function filterValues(res){
    console.log(res)
}

const getFieldIndex = (field, obj) => {
    return obj.findIndex(e => e.key === field)
}

let cancelToken

const getData = async e => {
    const CancelToken = axios.CancelToken
    const source = CancelToken.source()

    source.cancel('Operation canceled by the user.')

    const res = await axios.get(
        '/admin/widgets/view',
        {
            params: pageFilters.value,
            cancelToken
        },
        {
            cancelToken: source.token
        }
    )

    fields.value = res.data.fields
    items.value = res.data.data.items
    actions.value = res.data.actions
    hasCheckBox.value = res.data.hasCheckBox
    title.value = res.data.title
    exportable.value = res.data.exportable
    isSearchable.value = res.data.isSearchable
    pagination.value = res.data.pagination
}

const doClose = () => {
    openModal.value = false
}

const doSlider = i => {
    images.value = i
    openModal.value = true
}

const updatePage = page => {
    pageFilters.value.page = page
    getData()
}

const search = () => {
    // console.log('running')
}

const handleSearchChange = () => {
    if (pageFilters.value.term.length < 3) return
    getData()
}

const open = ref(false)
</script>
