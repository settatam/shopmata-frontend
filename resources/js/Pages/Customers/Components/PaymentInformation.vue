<template>
    <div class="bg-white mt-7 mb-7 mx-auto rounded-md">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">
                Payment Information
                <span
                    class="cursor-pointer hover:text-gray-400"
                    @click="toggleEdit()"
                >
                    [ Edit ]</span
                >
            </h1>
        </div>

        <div v-if="!isEdit" class="p-6 space-y-3 text-gray-lighter">
            <p>IS LOAN:</p>
            <p>PAY METHOD: {{ payment.name }}</p>
            <p>BANK NAME:</p>
            <p>ROUTING NUMBER:</p>
            <p>ACCOUNT NUMBER:</p>
            <p>ACCOUNT NAME:</p>
            <p>ACCOUNT TYPE:</p>
        </div>

        <div v-else>
            <div class="py-4 px-4 space-y-2 flex flex-col">
                <label
                    class="font-semibold w-full mt-2 bg-transparent"
                    for="pay_method"
                    >PAYMENT METHOD:
                </label>
                <select
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md"
                    name="pay_method"
                    id=""
                    v-model="payment_method"
                >
                    <option value="choose">Choose Method</option>
                    <option value="check">Pay me with a Check</option>
                    <option value="paypal">Pay me with PayPal</option>
                    <option value="ach">Pay me with ACH</option>
                    <option value="venmo">Pay me with Venmo</option>
                </select>
            </div>

            <div class="mx-auto w-full">
                <keep-alive>
                    <component :is="checkPaymentMethod" />
                </keep-alive>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed } from "vue";
import Check from "./Dynamic/Check.vue";
import Paypal from "./Dynamic/Paypal.vue";
import Ach from "./Dynamic/Ach.vue";
import Venmo from "./Dynamic/Venmo.vue";

export default {
    props: {
        payment: Object,
    },
    components: { Check },

    setup() {
        const isEdit = ref(false);
        function toggleEdit() {
            isEdit.value = !isEdit.value;
        }
        const payment_method = ref("choose");

        const checkPaymentMethod = computed(() => {
            switch (payment_method.value) {
                case "check":
                    return Check;
                case "ach":
                    return Ach;
                case "paypal":
                    return Paypal;
                case "venmo":
                    return Venmo;
                default:
                    break;
            }
        });

        return { isEdit, toggleEdit, payment_method, checkPaymentMethod };
    },
};
</script>
