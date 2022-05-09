<template>
    <div class=" my-3 md:px-0 rounded">
        <div class="pt-3 ">
            <h2 class="text-xl text-purple-darken">FILTER BY:</h2>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <div
                class="w-full my-2 border bg-white"
                v-for="item in filterLists"
                :key="item.index"
            >
                <div class="">
                    <div
                        class="bg-purple-darken text-white font-bold px-2 py-2"
                    >
                        <h1>{{ item.header }}</h1>
                    </div>
                    <div class="pl-3 py-3 bg-white">
                        <div>
                            <div
                                v-for="filter in item.filters"
                                :key="filter.index"
                                class="space-x-2 px-2"
                            >
                                <input
                                    type="checkbox"
                                    :id="filter"
                                    :name="filter"
                                />
                                <label :for="filter" class="text-xs lg:text-xs">
                                    {{ filter }}
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
    setup () {
        const filterLists = reactive([
            {
                header: 'Statuses',
                filters: [
                    'Kit Sent (94)',
                    'Payment Processed (14)',
                    'Incoming-Fedex (5)',
                    'Pending Kit Request (2)',
                    'Kit Received - Rejected By Admin (2)',
                    'Offer Given (1)',
                    'Offer Accepted (1)',
                    'Customer Declined Offer (1)',
                    'Kit Received (0)',
                    'Offer Declined (0)'
                ]
            },
            {
                header: 'Lead Type',
                filters: [
                    'Google-CPC (32)',
                    'Unknown (2)',
                    'Referral (0)',
                    'TV (0)',
                    'NY Post (0)',
                    'Facebook (0)',
                    'IG (0)',
                    'Bing -CPC (0)',
                    'Facebook (0)',
                    'CIMB (0)'
                ]
            },

            {
                header: 'Source',
                filters: ['goog (79)', 'importer (0)', 'msft (0)', 'phone (3)']
            },

            {
                header: 'Gender',
                filters: ['Female (17)', 'Male (17)']
            },

            {
                header: 'Repeat',
                filters: ['Yes (30)', 'no (90)']
            },

            {
                header: 'Payment Type',
                filters: ['Check (45)', 'ACH (0)', 'Paypal (0)', 'Venmo (0)']
            },

            {
                header: 'Behaviour',
                filters: ['Easy (22)', 'Medium (5)', 'Hard (3)']
            },

            {
                header: 'Tags',
                filters: [
                    'Unknown (107)',
                    'Jewelry (8)',
                    'Coin (2)',
                    'Handbags (1)',
                    'Watch (1)',
                    'Gold Scrap (1)',
                    'Multiple Item (0)',
                    'Diamond (0)',
                    'Scrap (0)',
                    'Various (0)'
                ]
            },

            {
                header: 'Age',
                filters: [
                    '18 - 25 (0)',
                    '26 - 40 (0)',
                    '41 - 60 (0)',
                    '60+ (0)'
                ]
            },

            {
                header: 'State',
                filters: [
                    'OHIO (11)',
                    'CALIFORNIA (10)',
                    'FLORIDA (8)',
                    'NEW YORK (7)',
                    'TEXAS (7)',
                    'GEORGIA (5)',
                    'INDIANA (5)',
                    'SOUTH CAROLINA (5)'
                ]
            },

            {
                header: 'Days',
                filters: [
                    'Monday (26)',
                    'Tuesday (21)',
                    'Wednesday (21)',
                    'Thursday (16)',
                    'Friday (15)',
                    'Staturday (12)',
                    'Sunday (9)'
                ]
            },

            {
                header: 'Times',
                filters: [
                    '12:0am to 12:59am (16)',
                    '1:00am to 1:59am (13)',
                    '2:00am to 2:59am (11)',
                    '3:00am to 3:59am (8)',
                    '4:00am to 4:59am (7)',
                    '5:00am to 5:59am (7)',
                    '6:00am to 6:59am (6)'
                ]
            },

            {
                header: 'Keywords',
                filters: [
                    'sell gold (13)',
                    'buyer of gold near me (11)',
                    'buyer of gold (9)',
                    'sell my gold (8)',
                    'sell my gold near me (8)',
                    'sell my old gold (5)',
                    'buy my gold (6)'
                ]
            }
        ])

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
