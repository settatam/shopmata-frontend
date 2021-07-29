<template>
    <div class="bg-white">
        <div class="p-6">
            <div class="flex justify-between">
                <p class="text-lg">Customer Overview</p>
                <custom-modal :styles="modalStyles">
                    <template v-slot:header>
                        <p class="font-semibold text-2xl">View Customer</p>
                    </template>
                    <template v-slot:body>
                        <personal-info-form :info="info"></personal-info-form>
                    </template>
                    <template v-slot:trigger>
                        <p class="text-purple-darker cursor-pointer">Edit</p>
                    </template>
                    <template v-slot:footer>
                        <div class="w-full flex justify-center">
                            <t-button class="text-white bg-purple-darker active:bg-purple-darker text-sm font-medium border border-transparent md:px-11 py-2" type="submit" @click="saveCustomerInfo">Save Changes</t-button>
                        </div>
                    </template>
                </custom-modal>
            </div>
            <p class="text-purple-darker my-3">{{user.email}}</p>
            <!-- <p class="text-gray-400">Account invite sent</p> -->
        </div>
        <default-address :address="customer.shipping_addresses[0]"></default-address>
        <!-- <tax-settings :customer="customer"></tax-settings> -->
    </div>
</template>

<script>
import CustomModal from '../../../Components/CustomModal.vue'
import DefaultAddress from './DefaultAddress.vue'
import EmailMarketing from './EmailMarketing.vue'
import PersonalInfoForm from './PersonalInfoForm.vue'
import TaxSettings from './TaxSettings.vue'
export default {
  components: { DefaultAddress, TaxSettings, EmailMarketing, CustomModal, PersonalInfoForm },
    props: ['customer', 'user'],
    data() {
        return {
            info: {
                id: this.customer.id,
                first_name: this.user.first_name,
                last_name: this.user.last_name,
                email: this.user.email,
                phone_number: this.customer.phone
            },
            modalStyles: {
                header: 'xl:px-28 px-6'
            }
        }
    },
    methods: {
        saveCustomerInfo() {
            this.$inertia.put(`/customers/${this.customer.id}`, this.info)
        }
    }
}
</script>