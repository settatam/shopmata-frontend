<template>
  <div class="xl:px-28 px-6">
    <p class="text-lg font-semibold xl:my-8 my-4">Discount code</p>
    <p class="block text-black mb-2 bg-transparent">Enter Discount Code</p>
    <div class="flex-none md:flex flex-wrap mb-10">
      <div class="form-group w-full md:w-1/2 mb-6 md:mb-0">
        <input
          class="appearance-none border bg-transparent w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none uppercase h-10 items-center mt-1"
          type="text"
          placeholder="SHOPNOW20"
          v-model="discount.code"
        />
        <!-- <span class="text-red-darker" v-if="errors.name">{{errors.name}}</span> -->
      </div>
      <div
        class="flex-none md:flex w-full md:w-1/2 mb-6 md:mb-0 justify-between items-center"
      >
        <div class="flex w-full md:w-2/5 justify-between px-13">
          <span>&mdash;</span>
          <span class="px-2">OR</span>
          <span>&mdash;</span>
        </div>
        <div class="w-full md:w-3/5 md:text-right mt-4 md:mt-0">
          <button
            class="bg-purple-darker text-white font-semibold cursor-pointer self-center px-4 text-center py-3 md:ml-8 focus:outline-none text-sm disabled:opacity-50 "
            @click="generateDiscount"
            :disabled="loading"
          >
            {{loading ? "Generating Code" : "Generate Discount"}}
            <i class="fas fa-spinner fa-pulse text-white m-2" v-if="loading"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// import Button from '../../../Jetstream/Button.vue'
import axios from "axios";
export default {
  props: ["discount", "showError"],
  data() {
    return{
      loading: false
    }
  },
  methods: {
    async generateDiscount() {
      try {
        this.loading = true;
        const resp = await axios.post("/generate/user/discount/code");
        const { code } = resp.data;
        this.discount.code = code;
        this.loading = false;
      } catch (error) {
        this.$emit("showError", error);
        this.loading = false;
        console.log(error);
      }
    },
  },
};
</script>