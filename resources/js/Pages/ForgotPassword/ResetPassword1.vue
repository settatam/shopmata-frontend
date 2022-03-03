<template>
    <div class="min-h-screen bg-white flex mx-4 px-8 py-8">
        <div class="">
            <div class="px-2 py-2 bg-gray-200">
                <ArrowLeftIcon class="h-5 w-5  text-black" />
            </div>
        </div>

        <div class="flex flex-col items-center w-full my-32">
            <div class="my-1 py-1">
                <h1 class="font-bold text-2xl">Forgot Password</h1>
            </div>
            <div class="mx-0 w-38">
                <p class="text-xs text-gray-lighter text-center">
                    Enter your email address below and we will send you a
                    password reset link
                </p>
            </div>

            <div class="mt-8">
                <form action="" method="post" class="w-auto">
                    <!-- Password start -->
                    <div class="space-y-1">
                        <label
                            for="password"
                            class="block text-xs font-medium text-gray-darker"
                        >
                            Password
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input
                                :class="{
                                    'border-red-600': v$.password.$error,
                                    'border-gray-300': !v$.password.$error
                                }"
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                class="appearance-none cursor-pointer block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                v-model="store.password"
                            />
                        </div>
                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.password.$error"
                            >
                                {{ v$.password.$errors[0].$message }}
                            </p>
                        </div>
                    </div>
                    <!-- Password end -->

                    <!-- Confirm password start -->
                    <div class="space-y-1">
                        <label
                            for="confirm_password"
                            class="block text-xs font-normal text-gray-darker"
                        >
                            Confirm Password
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input
                                id="confirm_password"
                                :class="{
                                    'border-red-600':
                                        v$.password_confirmation.$error,
                                    'border-gray-300': !v$.password_confirmation
                                        .$error
                                }"
                                name="confirm_password"
                                type="password"
                                autocomplete="current-password"
                                class="appearance-none cursor-pointer block px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-96"
                                v-model="store.password_confirmation"
                            />
                        </div>
                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.password_confirmation.$error"
                            >
                                {{
                                    v$.password_confirmation.$errors[0].$message
                                }}
                            </p>
                        </div>
                    </div>
                    <!-- Confirm password end -->

                    <!-- buttons -->
                    <div class="mt-6">
                        <button
                            v-if="!v$.$error"
                            :disabled="loading"
                            type="submit"
                            :class="{
                                disabled: loading,
                                'opacity-25 cursor-not-allowed': loading
                            }"
                            class="flex justify-center w-96 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-darken hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                        >
                            <LoadingSpinner v-if="loading" />

                            Reset
                        </button>

                        <!-- v-else -->
                        <button
                            v-else
                            type="submit"
                            class="w-full lg:w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-darken hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                        >
                            Reset
                        </button>
                    </div>
                </form>

                <!-- remember your password start -->

                <div class="mt-4">
                    <button
                        type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-xs font-medium text-purple-darken bg-purplish-light hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 hover:text-purplish-light focus:ring-purple-darken"
                    >
                        Remember your password? Login
                    </button>
                </div>

                <!-- remember your password end -->
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { ref, reactive, computed, watch } from 'vue'
import useVuelidate from '@vuelidate/core'
import { Inertia } from '@inertiajs/inertia'
import { required, helpers, sameAs } from '@vuelidate/validators'
import { ArrowLeftIcon } from '@heroicons/vue/solid'
import LoadingSpinner from '../../Components/LoadingSpinner.vue'

export default {
    data () {},
    components: { ArrowLeftIcon, LoadingSpinner },
    setup () {
        const store = reactive({
            step: 3,
            password: '',
            password_confirmation: ''
        })
        const loading = ref(false)
        const submit = () => {
            loading.value = true
        }
        const rules = computed(() => {
            return {
                password: {
                    required: helpers.withMessage(
                        'Please enter a password',
                        required
                    )
                },
                password_confirmation: {
                    required: helpers.withMessage(
                        'Please confirm your password',
                        required
                    ),
                    sameAsPassword: helpers.withMessage(
                        'Passwords do not match',
                        sameAs(store.password)
                    )
                }
            }
        })

        const v$ = useVuelidate(rules, store)
        return { v$, store, loading, submit }
    }
}
</script>
