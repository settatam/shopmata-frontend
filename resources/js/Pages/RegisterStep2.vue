<template>
  <div class="min-h-screen bg-white flex">
    <div class="hidden lg:block lg:w-1/2 relative w-0 lg:bg-indigo-700" />
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:w-1/2">
      <div class="mx-auto w-full">

        <div class="mt-8">
          <div>
            <div>
              <p class="text-sm font-medium text-gray-700">
                Store Details
              </p>

            </div>

          </div>

          <div class="mt-6">
            <form action="#" method="POST" class="space-y-6" @submit.prevent="submit">
              <div>
                <label for="sales_method_id" class="block text-sm font-medium text-gray-700">
                  How do you currently sell your products <span class="text-red-600 text-xs mx-4" v-if="v$.sales_method_id.$error">{{ v$.sales_method_id.$errors[0].$message }}</span>
                </label>

                <div class="mt-1 relative rounded-md shadow-sm">

                  <select id="sales_method_id" name="location" v-model="store.sales_method_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="0"> Choose method</option>
                    <option v-for="method in methods" :key="method.id" :value="method.id">{{ method.name }}</option>
                  </select>
                </div>

              </div>

              <div>
                <label for="" class="block text-sm font-medium text-gray-700">
                  What Industry are you currently operating? <span class="text-red-600 text-xs mx-4" v-if="v$.industry_id.$error">{{ v$.industry_id.$errors[0].$message }}</span>
                </label>

                <div class="mt-1 relative rounded-md shadow-sm">

                  <select id="location" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" v-model="store.industry_id">
                    <option value="0"> Choose Industry</option>
                    <option v-for="industry in industries" :key="industry.id" :value="industry.id">{{ industry.name }}</option>
                  </select>
                </div>

              </div>

              <div>
                <label for="has_website" class="block text-sm font-medium text-gray-700">
                  Do you currently have a website? <span class="text-red-600 text-xs mx-4" v-if="v$.has_website.$error">{{ v$.has_website.$errors[0].$message }}</span>
                </label>

                <div class="mt-1 relative rounded-md shadow-sm">

                  <select id="has_website" name="has_website" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" v-model="store.has_website">
                    <option value="0"> Select </option>
                    <option value="1"> Yes</option>
                    <option value="0"> No</option>
                  </select>
                </div>

              </div>

              <div>
                <label for="has_website" class="block text-sm font-medium text-gray-700">
                  Which country will you primarily sell in? <span class="text-red-600 text-xs mx-4" v-if="v$.country_id.$error">{{ v$.country_id.$errors[0].$message }}</span>
                </label>

                <div class="mt-1 relative rounded-md shadow-sm">

                  <select id="country" name="country_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" v-model="store.country_id">
                    <option value="0"> Choose Country</option>
                    <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                  </select>
                </div>

              </div>

              <div>
                <button v-if="!v$.$error" type="submit" :disabled="v$.$error" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Continue
                </button>

                <button v-else type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Continue
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { ref, reactive, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia'
import useVuelidate from "@vuelidate/core";
import { required, minValue, helpers } from "@vuelidate/validators";

export default {
  props: {
      industries: Array,
      methods: Array,
      errors: Object,
      countries: Array
  },
  
  data() {
    return {
      loading: false,
      notification: null,
      show: false,
      user: {
        email: "",
        password: "",
      },
      selectStore: false,
      stores: [],
      search: "",
    };
  },
  methods: {
    // async registerUser() {
    //   this.loading = true;
    //   try {
    //     const res = await axios.post("/register", { ...this.user});
    //     const { notification, storeCount, stores } = res.data;
    //     if (storeCount > 1) {
    //       this.stores = stores;
    //       this.selectStore = true;
    //     } else {
    //       this.notification = notification;
    //       // window.location.href = "/dashboard";
    //     }
    //   } catch (error) {
    //     console.log(error);
    //     const { notification } = error.response.data;
    //     this.notification = notification;
    //     this.loading = false;
    //   }
    // },
    toggleShow() {
      this.show = !this.show;
    },
  },

  setup(props){

    const industries = props.industries;
    const methods = props.methods;
    const selected_method = ref('');

    const store = reactive({
      industry_id: 0,
      sales_method_id: 0,
      has_website: 0,
      step: 2,
      country_id: 0
    })

    const rules = computed(() => {
            return {
                sales_method_id: { required, minValueValue: helpers.withMessage("* Select a valid sales method", minValue(1))},
                has_website: { required, minValueValue: helpers.withMessage("* Select a valid option", minValue(1)) },
                industry_id: {required, minValueValue: helpers.withMessage("* Select a valid industry", minValue(1))},
                country_id: {required, minValueValue: helpers.withMessage("* Select a valid country", minValue(1))},
            };
        });

        const v$ = useVuelidate(rules, store);

    function submit() {
      this.v$.$validate();
      if (!this.v$.$error) {
                Inertia.put('/store', store);
            } else {
                console.log("Errors in your form!");
            }
      
    }
    return {
      industries,
      methods,
      selected_method,
      submit,
      store,
      v$
    }
  }
};
</script>
