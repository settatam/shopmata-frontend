<template>
    <div class=" ml-6 space-y-3 w-full pb-4">
        <div class="flex flex-row space-x-2">
            <label
                class="font-semibold mt-2 w-1/6 bg-transparent"
                for="payable_to"
                >PAYABLE TO:</label
            >
            <input
                class=" shadow-sm focus:ring-indigo-500 focus:border-indigo-500  w-3/4 sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="payable_to"
                placeholder="Make check payable to"
            />
        </div>

        <div class="flex flex-row space-x-2">
            <label class="font-semibold mt-2 w-1/6 bg-transparent" for="address"
                >ADDRESS:</label
            >
            <input
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500  w-3/4 sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="address"
                placeholder="Send Check to this Street"
            />
        </div>

        <div class="flex flex-row space-x-2">
            <label class="font-semibold mt-2 w-1/6 bg-transparent" for="city"
                >CITY:</label
            >
            <input
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500  w-3/4 sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="city"
                placeholder="city"
            />
        </div>

        <div class="flex flex-row space-x-2">
            <label
                class="font-semibold mt-2 w-1/6 bg-transparent"
                for="state_id"
                >STATE:</label
            >
            <select
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-3/4 sm:text-sm border-gray-300 rounded-md"
                name="state"
                id=""
                v-model="state_id"
            >
                <option value="choose">State/Province</option>
            </select>
        </div>

        <div class="flex flex-row space-x-2">
            <label class="font-semibold w-1/6 mt-2 bg-transparent" for="zip"
                >ZIP:</label
            >
            <input
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500  w-3/4 sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="zip"
                placeholder="Zip/Postal"
            />
        </div>

        <!-- submit -->
        <div class="flex justify-between w-2/3 mx-auto mb-9">
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
                        'opacity-25 cursor-not-allowed': loading
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
import { ref, reactive, computed } from 'vue'
import {
    required,
    maxLength,
    numeric,
    helpers,
    email
} from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'

export default {
    setup () {
        const loading = ref(false)
        const paymentInfo = reactive({
            payment_method: 'check',
            payable_to: '',
            address: '',
            city: '',
            state_id: '',
            zip: ''
        })

        const rules = computed(() => {
            return {
                payable_to: {
                    required: helpers.withMessage('Enter a last name', required)
                },
                payable_to: {
                    required: helpers.withMessage('Enter an address', required)
                },
                address: {
                    required: helpers.withMessage('Enter a city', required)
                },
                city: {
                    required: helpers.withMessage('Select a state', required)
                },
                state_id: {
                    required: helpers.withMessage('Select a state', required)
                },
                zip: {
                    required: helpers.withMessage(
                        'Enter a postal code',
                        required
                    )
                }
            }
        })

        const v$ = useVuelidate(rules, paymentInfo)

        function submit () {
            this.v$.$validate()
            if (this.v$.$error) {
                return
            }
            loading.value = true
            axios
                .put(`/admin/customers/${customer.id}`, CustomerInfo)
                .then(res => {
                    successMessage.value = res.data.message
                    setTimeout(onClickTop, 2000)
                })
                .then(Inertia.visit('/admin/customers', { method: 'get' }))
                .catch(error => {
                    loading.value = false
                    successMessage.value = 'Error processing your request'
                    setTimeout(onClickBot, 2000)
                })
        }

        return {
            v$,
            paymentInfo
        }
    }
}
</script>
