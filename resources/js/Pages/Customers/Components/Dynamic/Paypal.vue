<template>
    <div class="px-4 space-y-3 w-full pb-8">
        <div class="flex flex-col space-y-2">
            <label
                class="font-semibold mt-2 w-full bg-transparent"
                for="address"
                >PAYPAL ADDRESS:</label
            >
            <input
                :class="{
                    'border-red-600': v$.paypal_address.$error,
                    'border-gray-300': !v$.paypal_address.$error,
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.paypal_address"
                placeholder="My paypal address is..."
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.paypal_address.$error">
                {{ v$.paypal_address.$errors[0].$message }}
            </p>
        </div>

        <!-- submit -->
        <div class="flex justify-between w-2/3 mx-auto pt-8 mt-8">
            <div class="">
                <button
                    class="text-gray-400 bg-gray-100 border border-gray-400 rounded-md px-6 py-3"
                >
                    Cancel
                </button>
            </div>
            <div class="">
                <button
                    v-if="!v$.$error"
                    :disabled="loading"
                    type="submit"
                    :class="{
                        disabled: loading,
                        'opacity-25 cursor-not-allowed': loading,
                    }"
                    class="disabled:bg-gray-400 w-full flex justify-center py-3 px-12 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    @click="submit"
                >
                    <LoadingSpinner v-if="loading" />
                    Save
                </button>

                <!-- else -->
                <button
                    v-else
                    type="button"
                    class="bg-indigo-600 text-white rounded-md px-8 py-3"
                >
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, computed } from "vue";
import {
    required,
    maxLength,
    numeric,
    helpers,
    email,
} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import LoadingSpinner from "../../../../Components/LoadingSpinner.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        customer: Object,
    },
    components: {
        LoadingSpinner,
    },
    setup(props) {
        const loading = ref(false);
        let payment = props.customer.payment_address;

        const paymentInfo = reactive({
            payment_method: "PayPal",
            paypal_address: payment.paypal_address,
        });

        const rules = computed(() => {
            return {
                paypal_address: {
                    required: helpers.withMessage("Enter an address", required),
                },
            };
        });

        const v$ = useVuelidate(rules, paymentInfo);

        function submit() {
            this.v$.$validate();
            if (this.v$.$error) {
                return;
            }
            loading.value = true;
            axios
                .post(
                    `/admin/customer/${props.customer.id}/payment`,
                    paymentInfo
                )
                .then((res) => {
                    Inertia.visit(`/admin/customers/${props.customer.id}`, {
                        method: "get",
                    });
                })
                .catch((error) => {
                    loading.value = false;

                    //setTimeout(onClickBot, 2000);
                });
        }

        return {
            v$,
            paymentInfo,
            loading,
            submit,
        };
    },
};
</script>
