<template>
  <div class="w-full my-10 px-9">
    <div class="mb-10">
      <p class="text-black font-semibold text-lg">Address</p>
      <p class="text-gray-300">Please try to be as accurate as possible</p>
    </div>
    <div class="">
      <div class="flex flex-wrap mb-10">
        <div class="form-group required w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="first_name"
          >
            First Name
          </label>
          <input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="First Name"
            v-model="address.first_name"
            required
          />
        </div>
        <div class="form-group required w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="last_name"
          >
            Last Name
          </label>
          <input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="Last Name"
            v-model="address.last_name"
          />
        </div> 
      </div>
      <div class="flex flex-wrap mb-10">
        <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="address"
          >
            Address
          </label>
          <input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="Address"
            v-model="address.address"
          />
        </div>
        <div class="w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="apartment"
          >
            Apartment/Suite
          </label>
          <input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="Apartment"
            v-model="address.apartment"
          />
        </div>
      </div>
      <div class="flex flex-wrap mb-10">
        <div class="form-group required w-full md:w-1/3 mb-6 md:pr-3 md:mb-0">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="city"
          >
            City
          </label>
          <input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="City"
            v-model="address.city"
          />
        </div>
        <div class="form-group required w-full md:w-1/3 mb-6 md:mb-0 md:pl-3">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="state"
          >
            State
          </label>
          <input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="State"
            v-model="address.state"
          />
        </div>
        <div class="w-full md:w-1/3 mb-6 md:mb-0 md:pl-3">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="postal_code"
          >
            Zip / Postal Code
          </label>
          <input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="Postal Code"
            v-model="address.postal_code"
          />
        </div>
      </div>
      <div class="flex flex-wrap mb-10">
        <div class="form-group required w-full mb-6 md: md:mb-0">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="country"
          >
            Country
          </label>
          <multiselect
            v-model="address.country"
            tag-placeholder=""
            placeholder=""
            label="name"
            trackBy="name"
            :options="countries"
            valueProp="id"
            :searchable="true"
            class="text-xs text-black font-semibold w-full"
          ></multiselect>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";
// import 'vue-multiselect/dist/vue-multiselect.min.css'
// import {countries} from '../../../constants/countries'
export default {
  name: "address-form",
  props: ["address", "addTag", "countries"],
  components: {
    Multiselect,
  },
  data() {
    return {
      // options: thiscountries,
    };
  },
  methods: {
    added() {
      this.$emit("added");
    },
  },
};
</script>

<style scoped>
</style>
<style src="@vueform/multiselect/themes/default.css"></style>