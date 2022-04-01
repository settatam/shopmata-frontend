<template>
    <div class=" rounded-md bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1>Kit Information</h1>
        </div>

        <form action="" method="post" class="px-3">
            <div class="p-4 space-y-2">
                <select
                    id="sales_method_id"
                    name="location"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="0">Choose Category</option>
                    <option
                        v-for="category in filteredCategory"
                        :key="category.index"
                        value=""
                        >{{ category.slug }}</option
                    >
                </select>
            </div>

            <div class="my-2 mx-4">
                <textarea
                    class="shadow-sm h-20 block w-full sm:text-sm border-gray-300 rounded-md "
                    placeholder="Write a delivery note ......."
                    name=""
                    id=""
                    rows="10"
                    v-model="transaction.comments"
                ></textarea>
            </div>

            <!-- images start -->

            <div class="">
                <div class="p-4 flex flex-row justify-between">
                    <div class="flex flex-col justify-center items-center">
                        <label for="Tyvek" class="text-xs lg:text-sm">
                            Tyvek</label
                        >
                        <input type="checkbox" id="Tyvek" name="Tyvek" />
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <label for="Fedex" class="text-xs lg:text-sm">
                            Fedex</label
                        >
                        <input
                            class=""
                            type="checkbox"
                            id="Fedex"
                            name="Fedex"
                        />
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <label for="Customer" class="text-xs lg:text-sm">
                            Customer</label
                        >
                        <input type="checkbox" id="Customer" name="Customer" />
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <label for="Other" class="text-xs lg:text-sm">
                            Other</label
                        >
                        <input type="checkbox" id="Other" name="Other" />
                    </div>
                </div>

                <div class="p-4 flex flex-row justify-between">
                    <div class="flex flex-col justify-center items-center">
                        <label for="10%" class="text-xs lg:text-sm"> 10%</label>
                        <input type="checkbox" id="10%" name="10%" />
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <label for=" FedexGr" class="text-xs lg:text-sm">
                            Fedex Gr</label
                        >
                        <input type="checkbox" id=" FedexGr" name="FedexGr" />
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <label for="FedexEx" class="text-xs lg:text-sm">
                            Fedex Ex</label
                        >
                        <input type="checkbox" id="FedexEx" name="FedexEx" />
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <label for="Box" class="text-xs lg:text-sm"> Box</label>
                        <input type="checkbox" id="Box" name="Box" />
                    </div>
                </div>
            </div>

            <!-- images end -->
        </form>

        <!-- sms start -->
        <div>
            <Sms :transaction="transaction.sms" class="my-4" />
        </div>
    </div>
</template>

<script>
import { computed } from '@vue/runtime-core'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Sms from '../Components/Sms.vue'

export default {
    components: { AppLayout, Sms },
    props: ['categories', 'transaction'],
    setup (props) {
        const categories = props.categories
        const filteredCategory = computed(() => {
            return categories.filter(item => {
                return item.slug
            })
        })
        return { categories, filteredCategory }
    }
}
</script>
