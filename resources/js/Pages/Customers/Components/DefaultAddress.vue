<template>
    <div class="border-t border-b border-gray-200 p-6">
        <div class="flex justify-between">
            <p class="text-lg">Default Address</p>
            <custom-modal :styles="modalStyles">
                    <template v-slot:header>
                        <p class="font-semibold text-2xl">Default Address</p>
                    </template>
                    <template v-slot:body>
                        <address-form :address="formFields"></address-form>
                    </template>
                    <template v-slot:trigger>
                        <p class="text-purple-darker cursor-pointer">Manage</p>
                    </template>
                    <template v-slot:footer>
                        <div class="w-full flex justify-center">
                            <t-button class="text-white bg-purple-darker active:bg-purple-darker text-sm font-medium border border-transparent md:px-11 py-2" type="submit">Save Changes</t-button>
                        </div>
                    </template>
            </custom-modal>
        </div>
        <div class="py-6">
            <p>{{`${address.first_name} ${address.last_name}` || ""}}</p>
            <p>{{address.address || ""}}</p>
            <p>{{address.address2 || ""}}</p>
            <p>{{address.city || ""}}</p>
            <p>{{address.state || ""}}</p>
            <p>{{address.country || ""}}</p>
        </div>
        <custom-modal :styles="modalStyles">
            <template v-slot:header>
                <p class="font-semibold text-2xl">New Address</p>
            </template>
            <template v-slot:body>
                <address-form :address="newAddress"></address-form>
            </template>
            <template v-slot:trigger>
                <p class="text-purple-darker cursor-pointer">Add new address</p>
            </template>
            <template v-slot:footer>
                <div class="w-full flex justify-center">
                    <t-button class="text-white bg-purple-darker active:bg-purple-darker text-sm font-medium border border-transparent md:px-11 py-2" type="submit">Save Changes</t-button>
                </div>
            </template>
        </custom-modal>
    </div>
</template>

<script>
import CustomModal from '../../../Components/CustomModal.vue'
import AddressForm from './AddressForm.vue'
export default {
  components: { AddressForm, CustomModal },
    props: ['address'],
    data() {
        return {
            formFields: {
                first_name: this.address?.first_name || '',
                last_name: this.address?.last_name || '',
                state: this.address?.state || null,
                city: this.address?.city || null,
                postal_code: this.address?.zip || '',
                address: this.address?.address || '',
                apartment: this.address?.address2 || '',
                country: this.address?.country || null
            },
            newAddress: {
                first_name: '',
                last_name: '',
                state: null,
                city: null,
                postal_code: '',
                address: '',
                apartment: '',
                country: null
            },
            modalStyles: {
                header: 'xl:px-28 px-6'
            }
        }
    }
}
</script>
