<template>
    <div class="px-4 space-y-3 w-full pb-8">
        <div class="flex flex-col space-y-2">
            <label
                class="font-semibold mt-2 w-full bg-transparent"
                for="bank_name"
                >BANK NAME:</label
            >
            <input
                :class="{
                    'border-red-600': v$.bank_name.$error,
                    'border-gray-300': !v$.bank_name.$error,
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.bank_name"
                placeholder="Bank Name"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.bank_name.$error">
                {{ v$.bank_name.$errors[0].$message }}
            </p>
        </div>

        <div class="flex flex-col space-y-2">
            <label
                class="font-semibold mt-2 w-full bg-transparent"
                for="routing_number"
                >ROUTING NUMBER:</label
            >
            <input
                :class="{
                    'border-red-600': v$.routing_number.$error,
                    'border-gray-300': !v$.routing_number.$error,
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.routing_number"
                placeholder="Routing Number (9 Digit Number)"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.routing_number.$error">
                {{ v$.routing_number.$errors[0].$message }}
            </p>
        </div>

        <div class="flex flex-col space-y-2">
            <label
                class="font-semibold mt-2 w-full bg-transparent"
                for="account_number"
                >ACCOUNT NUMBER:</label
            >
            <input
                :class="{
                    'border-red-600': v$.account_number.$error,
                    'border-gray-300': !v$.account_number.$error,
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.account_number"
                placeholder="Account Number"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.account_number.$error">
                {{ v$.account_number.$errors[0].$message }}
            </p>
        </div>

        <div class="flex flex-col space-y-2">
            <label
                class="font-semibold mt-2 w-full bg-transparent"
                for="account_name"
                >ACCOUNT NAME:</label
            >
            <input
                :class="{
                    'border-red-600': v$.account_name.$error,
                    'border-gray-300': !v$.account_name.$error,
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.account_name"
                placeholder="Account name (your name here)"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.account_name.$error">
                {{ v$.account_name.$errors[0].$message }}
            </p>
        </div>

        <div class="flex flex-col space-y-2">
            <label
                class="font-semibold w-full mt-2 bg-transparent"
                for="account_type"
                >ACCOUNT TYPE:</label
            >
            <input
                :class="{
                    'border-red-600': v$.account_type.$error,
                    'border-gray-300': !v$.account_type.$error,
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.account_type"
                placeholder="Account type (Checking, Savings)"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.account_type.$error">
                {{ v$.account_type.$errors[0].$message }}
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
        transaction: Object,
    },
    components: {
        LoadingSpinner,
    },
    setup(props) {
        const loading = ref(false);
        let payment = props.transaction.payment_address;
        const paymentInfo = reactive({
            payment_method: "ACH",
            bank_name: payment.bank_name,
            routing_number: payment.routing_number,
            account_number: payment.account_number,
            account_name: payment.account_name,
            account_type: payment.account_type,
        });

        const rules = computed(() => {
            return {
                bank_name: {
                    required: helpers.withMessage(
                        "Enter a bank name",
                        required
                    ),
                },
                routing_number: {
                    required: helpers.withMessage(
                        "Enter a routing number",
                        required
                    ),
                },
                account_number: {
                    required: helpers.withMessage(
                        "Select a account number",
                        required
                    ),
                },
                account_name: {
                    required: helpers.withMessage(
                        " Enter a account name",
                        required
                    ),
                },
                account_type: {
                    required: helpers.withMessage(
                        "Enter an account type",
                        required
                    ),
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
                    `/admin/transactions/${props.transaction.id}/payment`,
                    paymentInfo
                )
                .then((res) => {
                    Inertia.visit(`/admin/transactions/${props.transaction.id}`, {
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
