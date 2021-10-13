<template>
  <app-layout></app-layout>
</template>
<script>
import AppLayout from "../../Layouts/AppLayout.vue";
export default {
  props: [],
  components: {
     AppLayout,
  },
  data() {
    return {
     
    };
  },
  methods: {
    async submit() {
      /**
       * Please note the data descriptiion to pass to the api below:
       *
       *
       * type: percentage,fixed or freeshipping
       * applies_to: one of all_products, all_categories, entire_order, products, categories
       * categories: an array of category ids.. of the discount will apply to that category
       * products: an array of products id.. if the discount will apply to those products
       * countries: if the discount is freeshipping, enter an array of country ids
       * start_date,
       * end_date
       * code: the discount code
       * discount: the discount values
       */

      //dummy data to see how it works === please fix with real data
    },
    
  },
};
</script>
<style scoped>
@import "index.css";
</style>