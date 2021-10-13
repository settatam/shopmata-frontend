<template>
    <div class="xl:px-28 px-6 mb-10">
        <p class="text-lg xl:mt-8 mt-4 mb-2 font-semibold">Active dates</p>
        <p class="block text-gray-400 bg-transparent">
            If you do not specify and end date, the discount code will continue running
        </p>
        <div class="w-full flex justify-between mt-6">
            <div class="required w-5/10 mb-6 md:mb-0">
                <label class="block text-black mb-2 bg-transparent text-sm" for="name">
                    Start date
                </label>
                <t-datepicker
                    v-model="discount.start_date"
                    class="date-filter text-black focus:outline-none w-11/12"
                    placeholder=""
                    date-format="Y-m-d"
                    user-format="Y-m-d"
                />
            </div>
            <div class="w-5/10 mb-6 md:mb-0 ">
                <label class="block text-black mb-2 bg-transparent text-sm" for="name">
                    End date
                </label>
                <t-datepicker
                    v-model="discount.end_date"
                    class="date-filter text-black focus:outline-none w-11/12"
                    placeholder=""
                    date-format="Y-m-d"
                    user-format="Y-m-d"
                />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['discount'],
    data() {
        return {
            start: "",
            end: "",
        }
    },
}
</script>
<style scoped>
.required label:after {
    content: "*";
    color: #000;
    font-size: 14px;
}
.form-input{
    height:40px
}
</style>