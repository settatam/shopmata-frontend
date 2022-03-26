<template>
    <div class=" my-3 md:px-0 bg-white rounded">
        <div class="pt-3 pl-3">
            <h2 class="text-xs">FILTER BY:</h2>
        </div>

        <div
            class="myGrid
"
        >
            <div
                class="w-full my-2 border"
                v-for="item in filterLists"
                :key="item.index"
            >
                <div class="">
                    <div class="bg-purple-darken text-white px-2 py-2">
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
                                    id="vehicle1"
                                    name="Tyvek"
                                />
                                <label
                                    for="vehicle1"
                                    class="text-xs lg:text-xs"
                                >
                                    {{ filter }} ()</label
                                >
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
        const filterTitles = reactive([
            'Statuses',
            'Lead Type',
            'Source',
            'Gender',
            'Repeat',
            'Payment Type',
            'Behaviour',
            'Tags',
            'Age',
            'State',
            'Days',
            'Times',
            'Keywords'
        ])

        const filterLists = reactive([
            {
                header: 'Statuses',
                filters: [
                    'Kit Sent',
                    'Payment Processed',
                    'Incoming-Fedex',
                    'Pending Kit Request',
                    'Kit Received - Rejected By Admin',
                    'Offer Given',
                    'Offer Accepted',
                    'Customer Declined Offer',
                    'Kit Received',
                    'Offer Declined'
                ]
            },
            {
                header: 'Lead Type',
                filters: [
                    'Google-CPC',
                    'Unknown',
                    'Referral',
                    'TV',
                    'NY Post',
                    'Facebook',
                    'IG',
                    'Bing -CPC',
                    'Facebook',
                    'CIMB'
                ]
            },

            {
                header: 'Source',
                filters: ['goog', 'importer', 'msft', 'phone']
            },

            {
                header: 'Gender',
                filters: ['Female', 'Male']
            },

            {
                header: 'Repeat',
                filters: ['Yes', 'no']
            },

            {
                header: 'Payment Type',
                filters: ['Check', 'ACH', 'Paypal', 'Venmo']
            },

            {
                header: 'Behaviour',
                filters: ['Easy', 'Medium', 'Hard']
            },

            {
                header: 'Tags',
                filters: [
                    'Unknown',
                    'Jewelry',
                    'Coin',
                    'Handbags',
                    'Watch',
                    'Gold Scrap',
                    'Multiple Item',
                    'Diamond',
                    'Scrap',
                    'Various'
                ]
            },

            {
                header: 'Age',
                filters: ['18 - 25', '26 - 40', '41 - 60', '60+']
            },

            {
                header: 'State',
                filters: [
                    'OHIO',
                    'CALIFORNIA',
                    'FLORIDA',
                    'NEW YORK',
                    'TEXAS',
                    'GEORGIA',
                    'INDIANA',
                    'SOUTH CAROLINA'
                ]
            },

            {
                header: 'Days',
                filters: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Staturday',
                    'Sunday'
                ]
            },

            {
                header: 'Times',
                filters: [
                    '12:0am to 12:59am',
                    '1:00am to 1:59am',
                    '2:00am to 2:59am',
                    '3:00am to 3:59am',
                    '4:00am to 4:59am',
                    '5:00am to 5:59am',
                    '6:00am to 6:59am'
                ]
            },

            {
                header: 'Keywords',
                filters: [
                    'sell gold',
                    'buyer of gold near me',
                    'buyer of gold',
                    'sell my gold',
                    'sell my gold near me',
                    'sell my old gold',
                    'buy my gold'
                ]
            }
        ])

        return {
            filterTitles,
            filterLists
        }
    }
}
</script>

<style scoped>
.myGrid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}
</style>
