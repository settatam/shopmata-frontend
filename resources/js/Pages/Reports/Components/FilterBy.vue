<template>
    <div class=" my-3 md:px-0 bg-white rounded">

        <div class="pt-3 pl-3">
            <h2 class="text-xs" >FILTER BY: </h2>
        </div>

        <div
            class="myGrid
"
        >
            <div class="w-full my-2 border" v-for="i in 13" :key="i">
                <div class="">
                    <div
                        class="bg-purple-darken text-white px-2 py-2"
                    >
                        <h1>Statuses</h1>
                    </div>
                    <div class="pl-3 py-3 bg-white">
                        <div>
                            <input type="checkbox" id="vehicle1" name="Tyvek" />
                            <label for="vehicle1" class="text-xs lg:text-sm">
                                Tyvek ()</label
                            >
                        </div>
                        <div>
                            <input type="checkbox" id="vehicle1" name="Tyvek" />
                            <label for="vehicle1" class="text-xs lg:text-sm">
                                Tyvek ()</label
                            >
                        </div>
                        <div>
                            <input type="checkbox" id="vehicle1" name="Tyvek" />
                            <label for="vehicle1" class="text-xs lg:text-sm">
                                Tyvek ()</label
                            >
                        </div>
                        <div>
                            <input type="checkbox" id="vehicle1" name="Tyvek" />
                            <label for="vehicle1" class="text-xs lg:text-sm">
                                Tyvek ()</label
                            >
                        </div>

                        <div>
                            <input type="checkbox" id="vehicle1" name="Tyvek" />
                            <label for="vehicle1" class="text-xs lg:text-sm">
                                Tyvek ()</label
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {}
</script>

<style scoped>
.myGrid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
}
</style>
