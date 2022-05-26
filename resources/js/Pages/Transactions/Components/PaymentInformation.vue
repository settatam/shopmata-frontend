<template>
    <div class="rounded-md bg-white lg:mx-2">
        <div class="rounded-t-md w-full bg-purple-darken py-4 pl-4 text-white">
            <h1>Payment Information</h1>
        </div>

        <div class="p-4 space-y-2">
            {{ transaction.customer.payment_address.payment_type.name }}
            <payment-method
                :payment_method_name="
                    transaction.customer.payment_address.payment_type.name
                "
                :payment="transaction.customer.payment_address"
            />
        </div>
    </div>
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout.vue";
import PaymentMethod from "../../../Components/PaymentMethod.vue";

export default {
    props: {
        transaction: Object,
    },
    components: { AppLayout, PaymentMethod },
    setup({ transaction }) {},
};
</script>
