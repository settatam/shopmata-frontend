<template>
    <div class="bg-white mt-7 mb-7 mx-auto rounded-md">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">
                Payment Information
                <span
                    class="cursor-pointer hover:text-gray-400"
                    @click="toggleEdit()"
                >
                    [ Edit ]
                </span>
            </h1>
        </div>

        <div v-if="!isEdit" class="p-6 space-y-3 text-gray-lighter">
            <payment-method
                :payment_method_name="
                    customer.payment_address.payment_type.name
                "
                :payment="customer.payment_address"
            />
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
                    <option value="Check">Pay me with a Check</option>
                    <option value="PayPal">Pay me with PayPal</option>
                    <option value="ACH">Pay me with ACH</option>
                    <option value="Venmo">Pay me with Venmo</option>
                </select>
            </div>

            <div class="mx-auto w-full">
                <keep-alive>
                    <component
                        :customer="customer"
                        :states="states"
                        :is="checkPaymentMethod"
                        :transaction="transaction"
                    />
                </keep-alive>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import Check from "./Dynamic/Check.vue";
import PayPal from "./Dynamic/PayPal.vue";
import Ach from "./Dynamic/Ach.vue";
import Venmo from "./Dynamic/Venmo.vue";
import PaymentMethod from "../../../Components/PaymentMethod.vue";
import urls from "../../../api/urls";

export default {
    props: {
        customer: Object,
        states: Array,
        transaction: Object
    },
    components: { Check, PaymentMethod },

    setup(props) {
        const transaction_id = ref(12628);
        onMounted(() => {
           getData()
        })

        const getData = async () => {
            //const cancelToken = axios.cancelToken;
            //const source = cancelToken.source();
        //source.cancel("Operation canceled by the user.");
        const res = await axios.get(
            urls.paymentInformation.get(transaction_id.value),
            {
                //cancelToken,
            },
            {
                //cancelToken: source.token,
            }
        );

        };

        const isEdit = ref(false);
        const payment_method = ref("choose");
        let name = props.customer.payment_address.payment_type.name;
        let checkPaymentMethod = computed(() => {
            switch (payment_method.value) {
                case "Check":
                    return Check;
                case "ACH":
                    return Ach;
                case "PayPal":
                    return PayPal;
                case "Venmo":
                    return Venmo;
                default:
                    break;
            }
        });

        function toggleEdit() {
            payment_method.value = null != name ? name : "choose";
            isEdit.value = !isEdit.value;
        }

        return { isEdit, toggleEdit, payment_method, checkPaymentMethod };
    },
};
</script>
