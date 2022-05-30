<template>
    <div class="rounded-md bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1>Transaction #{{ transaction.id }}</h1>
        </div>

        <div class="p-4 space-y-2">
            <p class="font-bold text-xs lg:text-sm text-black">
                Kit Type:
                <span class="font-normal"> {{ transaction.kit_type }} </span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Status:
                <span class="font-normal">
                    {{ transaction.status_date_time }}</span
                >
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Lead: <span class="font-normal"> {{ transaction.lead }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                From Date/Time:
                <span class="font-normal"> {{ transaction.created_at }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Received Date/Time:
                <span class="font-normal">
                    {{ transaction.received_date_time }}
                </span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Incoming Tracking#:
                <span class="font-normal text-purple-darken">{{
                    transaction.incoming_tracking
                }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Outgoing Tracking#:
                <span class="font-normal text-purple-darken">
                    {{ transaction.outgoing_tracking }}
                </span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Return Tracking#:
                <span class="font-normal text-purple-darken">
                    {{ transaction.return_tracking }}
                </span
                >
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Estimated Value:
                <span class="font-normal">{{ transaction.est_value }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Estimated Profit:
                <span class="font-normal"> {{ transaction.est_profit }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Final Offer:
                <span class="font-normal">{{ transaction.offer }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Payment Type:
                <span class="font-normal">
                    {{ transaction.transaction_payment_type }}</span
                >
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Payment Date:
                <span class="font-normal">
                    {{ transaction.payment_date_time }}
                </span>
            </p>

            <p
                v-if="transaction.tags"
                class="font-bold text-xs lg:text-sm text-black"
            >
                Tags:
                <span
                    v-for="item in transaction.tags"
                    :key="item.index"
                    class="font-normal"
                    >{{ item.tag_id }},
                </span>
            </p>
            <p v-else class="font-bold text-xs lg:text-sm text-black">
                Tags: <span class="font-normal"></span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Total DWT:
                <span class="font-normal">{{ transaction.total_dwt }}</span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Bin Location:
                <span class="font-normal">{{ transaction.bin_location }}</span>
            </p>

            <p class="font-bold text-xs lg:text-sm text-black">
                Hold Date: <span class="font-normal"></span>
            </p>
            <p class="font-bold text-xs lg:text-sm text-black">
                Website: <span class="font-normal"> {{ store.name }}</span>
            </p>
            <p class="font-bold text-sm text-black">
                Website Categories
                <span class="font-normal">
                    {{ transaction.customer_categories }}
                </span>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: ["transaction", "store"],
    setup() {
        return {};
    },
};
</script>
