<template>
    <div class="bg-white pt-4 md:pt-7 pb-2 md:pb-4 mb-3 md:mb-5">
        <div
            class="flex justify-between px-4 md:px-8 cursor-pointer"
            @click="variant_open = !variant_open"
        >
            <p class="text-black font-semibold text-lg mb-6">Variants</p>
            <div>
                <chevron-up-icon
                    class="h-5 w-5 text-indigo-700 cursor-pointer"
                    v-if="variant_open"
                />
                <chevron-down-icon
                    class="h-5 w-5 text-indigo-700 cursor-pointer"
                    v-else
                />
            </div>
        </div>
        <div v-if="variant_open">
            <div class="flex flex-wrap mb-6">
                <div class="px-4 md:px-8">
                    <div class="flex flex-wrap -mx-3">
                        <div class="-mx-3 px-8">
                            <div class="flex items-center">
                                <input
                                    v-model="has_variants"
                                    type="checkbox"
                                    id="has_variants"
                                    class="form-checkbox cursor-pointer rounded-sm h-4 w-4 text-indigo-600 transition duration-150 ease-in-out border border-border focus:outline-none"
                                />
                                <label
                                    for="has_variants"
                                    class="ml-2 block text-sm leading-5 text-black cursor-pointer"
                                >
                                    This product has multiple options, like
                                    different sizes or colours
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <template v-if="hasVariants">
                <p class="text-black font-semibold text-lg px-4 md:px-8">
                    Options
                </p>
                <div
                    v-for="(option, index) of variants.options"
                    :key="index"
                    class="mx-4 md:mx-8 mb-6"
                    :data-index="index"
                >
                    <p class="text-gray-600 pt-4 pb-1">
                        Option {{ index + 1 }}
                    </p>
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                            <input
                                class="shadow-sm focus:ring-transparent focus:border-gray-300 block w-full sm:text-sm border-gray-300 rounded-md"
                                v-model="option.type"
                                type="text"
                                :data-index="index"
                                @blur="setVariant"
                            />
                        </div>
                        <div class="w-full md:w-1/2">
                            <TagInput
                                :default-tags="option.values"
                                :addVariantValue="addVariantValue"
                                :dataIndex="index"
                                @comment="addVariantValue"
                                @removedtag="
                                    (e) => removeVariantValue(e, index)
                                "
                            />
                        </div>
                    </div>
                </div>
                <t-button
                    v-if="variants.options.length < 3"
                    class="text-white rounded bg-indigo-600 active:bg-indigo-600 text-xs md:text-sm font-medium cursor-pointer border border-transparent float-right mr-4 md:mr-8 px-4 md:px-4 py-2 md:py-3 mb-6"
                    v-model="newVariant"
                    @click="added"
                    >Add another option</t-button
                >
                <div class="py-6">
                    <div
                        class="grid grid-cols-5 md:px-8 lg:px-8 xl:px-8 min-w-full py-2"
                        v-if="variantList.length > 0"
                    >
                        <div class="col-span-1 text-xs text-gray-600">
                            Image
                        </div>
                        <div class="col-span-1 text-xs text-gray-600">
                            Variant
                        </div>
                        <div class="col-span-1 text-xs text-gray-600">
                            Price
                        </div>
                        <div class="col-span-1 text-xs text-gray-600">
                            Quantity
                        </div>
                        <div class="col-span-1 text-xs text-gray-600">SKU</div>
                    </div>
                    <div
                        class="grid grid-cols-5 md:px-8 lg:px-8 xl:px-8 min-w-full py-2"
                        v-for="(el, index) in variantList"
                        :key="index"
                    >
                        <div class="col-span-1 bg-white">
                            <div
                                class="p-2 border border-gray-300 w-10 h-10 rounded"
                            >
                                <camera-icon class="h-5 w-5 text-gray-600" />
                            </div>
                        </div>
                        <div class="col-span-1 mr-2 text-gray-600 my-auto">
                            {{
                                el.property.reduce(
                                    (prev, curr) =>
                                        `${prev ? `${prev},` : prev}${
                                            curr.value
                                        }`,
                                    ""
                                )
                            }}
                        </div>
                        <div class="col-span-1 mr-2">
                            <input
                                class="border-gray-300 rounded-md bg-transparent text-xs w-full py-2 px-3 text-gray-600 leading-tight focus:outline-none"
                                placeholder="$ 0.00"
                                type="text"
                                v-model="variantList[index].price"
                            />
                        </div>
                        <div class="col-span-1 mr-2">
                            <input
                                class="border-gray-300 rounded-md bg-transparent text-xs w-full py-2 px-3 text-gray-600 leading-tight focus:outline-none"
                                placeholder="0"
                                type="Number"
                                v-model="variantList[index].quantity"
                            />
                        </div>
                        <div class="col-span-1">
                            <input
                                class="border-gray-300 rounded-md bg-transparent w-full text-xs py-2 px-3 text-gray-600 leading-tight focus:outline-none"
                                type="text"
                                v-model="variantList[index].sku"
                            />
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import AngleUpIcon from "../../../../assets/AngleUpIcon";
import { ChevronUpIcon, ChevronDownIcon } from "@heroicons/vue/solid";
import { CameraIcon } from "@heroicons/vue/outline";
import TagInput from "./TagInput.vue";

import { computed } from "vue";
export default {
    name: "variants-form",
    props: ["variants", "types", "addOption", "variantList", "hasVariants"],
    components: {
        AngleUpIcon,
        TagInput,
        ChevronUpIcon,
        ChevronDownIcon,
        CameraIcon,
    },
    emits: [
        "added",
        "added-variant-name",
        "added-variant-value",
        "removed-variant-value",
        "update:has-variants",
    ],
    data() {
        return {
            variant_open: true,
            newVariant: "",
            tags: [],
        };
    },
    mounted() {
    },
    setup(props, { emit }) {
        const has_variants = computed({
            get() {
                return props.hasVariants;
            },
            set(value) {
                emit("update:has-variants", value);
            },
        });
        return { has_variants };
    },
    methods: {
        added(e) {
            e.preventDefault();
            this.$emit("added");
        },
        setVariant(e) {
            console.log(e);
            this.$emit("added-variant-name", e);
        },
        addVariantValue(e) {
            this.$emit("added-variant-value", e);
            this.valueContent = "";
        },
        removeVariantValue(e, index) {
            this.$emit("removed-variant-value", { e, index });
        },
        expandForm() {
            this.expand = !this.expand;
        },
        pushVariant(i) {
            const newVariant = this.$refs.editable[0].innerText;
            const regex = "^\\s+$";
            if (newVariant.match(regex) === null && newVariant !== "") {
                this.variants.options[i].values.push(newVariant);
                this.doVariantList();
            }
        },

        doVariantList() {
            console.log("I got fired");
            let maxLength = 0;
            let variantList = [];
            this.variants.options.forEach((element) => {
                if (element.values.length > maxLength)
                    maxLength = element.values.length;
            });
            if (this.variants.options.length > 1) {
                this.variants.options[0].values.forEach((el) => {
                    for (let index = 0; index < maxLength - 1; index++) {
                        variantList.push({
                            name: `${el}/${
                                this.variants.options[1]
                                    ? this.variants.options[1].values[index] ||
                                      ""
                                    : ""
                            }/
                                ${
                                    this.variants.options[2]
                                        ? this.variants.options[2].values[
                                              index
                                          ] || ""
                                        : ""
                                }`,
                            price: 0,
                            quantity: 0,
                            sku: "",
                        });
                    }
                });
            }
        },
        removeItem(index, i) {
            this.variants.options[index].values.splice(i, 1);
        },
    },
};
</script>

<style scoped>
[type="text"]:focus {
    --tw-ring-color: none;
    --tw-ring-shadow: none;
}
</style>
