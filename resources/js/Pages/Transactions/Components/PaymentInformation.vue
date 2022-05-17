<template>
    <div class="rounded-md bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken py-4 pl-4 text-white">
            <h1>Payment Information</h1>
        </div>

        <div class="p-4 space-y-2">
            <payment-method
                :payment_method_name="name"
                :payment="transaction.payment_address"
            />
        </div>
    </div>
</template>

<script>
import { ref } from "vue";

import AppLayout from "../../../Layouts/AppLayout.vue";
import PaymentMethod from "../../../Components/PaymentMethod.vue";

export default {
    props: {
        transaction: Object,
    },
    components: { AppLayout, PaymentMethod },
    setup({ transaction }) {
        const name = ref(
            transaction.payment_address.payment_type
                ? transaction.payment_address.payment_type.name
                : null
        );

        return { name };
    },
};
</script>
