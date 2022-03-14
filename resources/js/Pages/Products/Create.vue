<template>
    <app-layout>
        <div
            id="createContentContainer"
            class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden"
        >
            <div class="flex-1 flex xl:overflow-auto">
                <!-- Main content -->
                <div class="flex-1 h-full max-h-screen">
                    <!-- breadcrumbs -->
                    <nav class="flex px-6 mt-6" aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-4">
                            <li>
                                <div>
                                    <a
                                        href="/dashboard"
                                        class="text-gray-600 hover:text-gray-700"
                                    >
                                        <HomeIcon
                                            class="flex-shrink-0 h-5 w-5"
                                            aria-hidden="true"
                                        />
                                        <span class="sr-only">Settings</span>
                                    </a>
                                </div>
                            </li>
                            <li v-for="page in pages" :key="page.name">
                                <div class="flex items-center">
                                    <ChevronRightIcon
                                        class="flex-shrink-0 h-5 w-5 text-gray-600"
                                        aria-hidden="true"
                                    />
                                    <a
                                        :href="page.href"
                                        class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                                        :aria-current="
                                            page.current ? 'page' : undefined
                                        "
                                        >{{ page.name }}</a
                                    >
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <div class="flex justify-between items-center mt-4 px-6">
                        <h1 class="text-lg md:text-2xl font-bold text-gray-900">
                            Add New Product
                        </h1>
                        <div class="flex">
                            <button
                                type="button"
                                class="rounded-md border border-indigo-600 mr-4 shadow-sm px-8 md:px-10 py-3 bg-transparent text-base font-medium text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                            >
                                Preview
                            </button>
                            <button
                                class="rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer focus:ring-indigo-500 sm:text-sm"
                                @click="submitNewProduct"
                                :disabled="v$.$error || submitting"
                                :class="{
                                        disabled: v$.$error || submitting,
                                        'opacity-25 cursor-not-allowed':
                                            v$.$error || submitting,
                                    }"
                            >
                                <svg
                                    v-if="submitting"
                                    role="status"
                                    class="mr-5 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                    viewBox="0 0 100 101"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor"
                                    ></path>
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill"
                                    ></path>
                                </svg>
                                <span v-else>Save</span>
                            </button>
                        </div>
                    </div>
                    <div
                        class="mx-auto py-5 md:py-10 px-4 sm:px-6 lg:py-12 lg:px-8 flex justify-between"
                    >
                        <div class="w-full">
                            <div
                                class="bg-white mb-3 md:mb-5 pt-4 md:pt-7 rounded"
                            >
                                <!-- <div class="bg-white flex justify-between px-8 cursor-pointer" @click="expandForm">
                  <span><angle-up-icon></angle-up-icon></span>
                </div> -->
                                <div
                                    class="bg-white px-4 md:px-8 pb-6 mb-3 md:mb-6"
                                >
                                    <!-- <p class="text-black text-2xl font-semilbold mb-6">Update Product</p> -->
                                    <div
                                        class="flex justify-between cursor-pointer"
                                        @click="product_open = !product_open"
                                    >
                                        <p
                                            class="text-gray-700 font-bold text-lg mb-4"
                                        >
                                            Product Information
                                        </p>
                                        <chevron-up-icon
                                            class="h-5 w-5 text-indigo-700 cursor-pointer"
                                            v-if="product_open"
                                        />
                                        <chevron-down-icon
                                            class="h-5 w-5 text-indigo-700 cursor-pointer"
                                            v-else
                                        />
                                    </div>
                                    <div v-if="product_open">
                                        <div class="mb-10">
                                            <label
                                                class="block text-sm text-gray-500"
                                                for="title"
                                            >
                                                Product Name
                                            </label>
                                            <div class="mt-1">
                                                <input
                                                    type="text"
                                                    name="street-address"
                                                    id="street-address"
                                                    autocomplete="street-address"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    v-model="product.title"
                                                />
                                            </div>
                                            <div class="mt-1">
                                                <p
                                                    class="text-red-600 text-xs"
                                                    v-if="
                                                        v$.product.title.$error
                                                    "
                                                >
                                                    {{
                                                        v$.product.title
                                                            .$errors[0].$message
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label
                                                class="block text-gray-500 mb-2 bg-transparent"
                                                for="description"
                                            >
                                                Product Description
                                            </label>
                                            <div class="quill">
                                                <quill-editor
                                                    class="editor text-black"
                                                    ref="description"
                                                    theme="snow"
                                                    style="min-height: 102px"
                                                    :value="product.description"
                                                    :options="editorOption"
                                                    v-model:content="
                                                        product.description
                                                    "
                                                    contentType="html"
                                                    @blur="onEditorBlur($event)"
                                                    @focus="
                                                        onEditorFocus($event)
                                                    "
                                                    @ready="
                                                        onEditorReady($event)
                                                    "
                                                />
                                            </div>
                                            <div class="mt-1">
                                                <p
                                                    class="text-red-600 text-xs"
                                                    v-if="
                                                        v$.product.description
                                                            .$error
                                                    "
                                                >
                                                    {{
                                                        v$.product.description
                                                            .$errors[0].$message
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label
                                                class="block text-sm text-gray-500"
                                                for="sku"
                                            >
                                                Product SKU
                                            </label>
                                            <div class="mt-1">
                                                <input
                                                    type="text"
                                                    name="street-address"
                                                    id="sku"
                                                    autocomplete="street-address"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    v-model="product.sku"
                                                />
                                            </div>
                                            <!--                                            <div class="mt-1">-->
                                            <!--                                                <p-->
                                            <!--                                                    class="text-red-600 text-xs"-->
                                            <!--                                                    v-if="-->
                                            <!--                                                        v$.product.sku.$error-->
                                            <!--                                                    "-->
                                            <!--                                                >-->
                                            <!--                                                    {{-->
                                            <!--                                                        v$.product.sku-->
                                            <!--                                                            .$errors[0].$message-->
                                            <!--                                                    }}-->
                                            <!--                                                </p>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Princing Start here -->

                            <div
                                class="bg-white pt-4 md:pt-7 pb-1 mb-3 md:mb-5 rounded"
                            >
                                <div
                                    class="flex justify-between px-4 md:px-8 cursor-pointer"
                                    @click="price_open = !price_open"
                                >
                                    <p
                                        class="text-black font-semibold text-lg mb-6"
                                    >
                                        Pricing
                                    </p>
                                    <div>
                                        <chevron-up-icon
                                            class="h-5 w-5 text-indigo-700 cursor-pointer"
                                            v-if="price_open"
                                        />
                                        <chevron-down-icon
                                            class="h-5 w-5 text-indigo-700 cursor-pointer"
                                            v-else
                                        />
                                    </div>
                                </div>
                                <div class="px-4 md:px-8" v-if="price_open">
                                    <div class="mb-5 md:mb-1">
                                        <div class="flex flex-wrap">
                                            <div
                                                class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0"
                                            >
                                                <label
                                                    for="price"
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Price</label
                                                >
                                                <div
                                                    class="mt-1 relative rounded-md shadow-sm"
                                                >
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                                    >
                                                        <span
                                                            class="text-gray-500 sm:text-sm"
                                                        >
                                                            {{
                                                                store.currency
                                                                    .symbol_left
                                                            }}
                                                        </span>
                                                    </div>
                                                    <input
                                                        type="number"
                                                        name="price"
                                                        id="price"
                                                        class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md"
                                                        placeholder="0.00"
                                                        aria-describedby="price-currency"
                                                        v-model="product.price"
                                                    />
                                                </div>
                                                <div class="mt-1">
                                                    <p
                                                        class="text-red-600 text-xs"
                                                        v-if="
                                                            v$.product.price
                                                                .$error
                                                        "
                                                    >
                                                        {{
                                                            v$.product.price
                                                                .$errors[0]
                                                                .$message
                                                        }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div
                                                class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0"
                                            >
                                                <label
                                                    for="price"
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Compare at price</label
                                                >
                                                <div
                                                    class="mt-1 relative rounded-md shadow-sm"
                                                >
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                                    >
                                                        <span
                                                            class="text-gray-500 sm:text-sm"
                                                        >
                                                            {{
                                                                store.currency
                                                                    .symbol_left
                                                            }}
                                                        </span>
                                                    </div>
                                                    <input
                                                        type="number"
                                                        name="compare_at_price"
                                                        id="compare_at_price"
                                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md"
                                                        placeholder="0.00"
                                                        aria-describedby="price-currency"
                                                        v-model="
                                                            product.compare_at_price
                                                        "
                                                    />
                                                </div>
                                                <div class="mt-1">
                                                    <p
                                                        class="text-red-600 text-xs"
                                                        v-if="
                                                            v$.product
                                                                .compare_at_price
                                                                .$error
                                                        "
                                                    >
                                                        {{
                                                            v$.product
                                                                .compare_at_price
                                                                .$errors[0]
                                                                .$message
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                            <span
                                                class="flex items-center text-gray-600 mt-4"
                                            >
                                                <information-circle-icon
                                                    class="h-5 w-5"
                                                />
                                                Customers will not see this
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-4 mb-3 md:mb-6">
                                        <div class="flex items-center">
                                            <input
                                                type="checkbox"
                                                v-model="product.charge_taxes"
                                                class="form-checkbox cursor-pointer rounded-sm h-4 w-4 text-indigo-500 transition duration-150 ease-in-out border border-border focus:outline-none"
                                                id="charge_tax"
                                            />
                                            <label
                                                for="charge_tax"
                                                class="ml-2 block text-sm leading-5 text-black cursor-pointer"
                                            >
                                                Charge tax on this product
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white mb-3 md:mb-5 py-6 rounded">
                                <div class="px-4 md:px-8">
                                    <div
                                        class="bg-white flex justify-between"
                                        @click="media_open = !media_open"
                                    >
                                        <p
                                            class="text-black font-semibold text-lg mb-6"
                                        >
                                            Media
                                        </p>
                                        <div>
                                            <chevron-up-icon
                                                class="h-5 w-5 text-indigo-700 cursor-pointer"
                                                v-if="media_open"
                                            />
                                            <chevron-down-icon
                                                class="h-5 w-5 text-indigo-700 cursor-pointer"
                                                v-else
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="border-b border-gray-300"
                                        v-if="
                                            product.images.length && media_open
                                        "
                                    >
                                        <li
                                            class="flex text-gray-700 justify-between"
                                        >
                                            <p class="w-3/10">Image</p>
                                            <p
                                                class="w-5/10 border-r border-l border-gray-300 px-6"
                                            >
                                                Description
                                            </p>
                                            <p class="w-2/10 px-2">Thumbnail</p>
                                        </li>
                                    </div>
                                    <div class="" v-if="media_open">
                                        <images-list
                                            :images="product.images"
                                            v-if="product.images.length"
                                            @delete_img="delete_img"
                                        />
                                        <Dropzone
                                            @add-image="onAddImage"
                                            class=""
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Variant Here -->
                            <variants-form
                                :variants="variants"
                                :types="variant_types"
                                :valueContent="valueContent"
                                :variantList="variantList"
                                @added="addOption"
                                @add-variant-name="addVariantName"
                                @added-variant-value="addVariantValue"
                                @removed-variant-value="removeVariantValue"
                                v-model:has-variants="product.has_variants"
                            ></variants-form>

                            <!-- Link Starts Here -->
                            <!-- <div class="bg-white p-4 md:p-8 mb-3 md:mb-5 rounded">
                <div class="flex justify-between cursor-pointer" @click="link_open=!link_open">
                  <p class="text-black font-semibold text-lg mb-6">Link</p>
                   <chevron-up-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-if="link_open"/>
                      <chevron-down-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-else/>
                </div>
                <div v-if="link_open">
                  <div class="flex flex-col mt-4 text-gray-600">
                    <label for="manufacturer">Manufacturer</label>
                    <input type="text" name="manufacturer" id="" class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md" v-model="link.manufacturer">
                  </div>
                  <div class="flex flex-col mt-4 text-gray-600">
                    <label for="Collections">Collections</label>
                    <input type="text" name="Collections" id="" class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md" v-model="link.collections">
                  </div>
                  <div class="flex flex-col mt-4 text-gray-600">
                    <label for="filters">Filters</label>
                    <input type="text" name="filters" id="" class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md" v-model="link.filters">
                  </div>
                  <div class="flex flex-col mt-4 text-gray-600">
                    <label for="related">Related Products</label>
                    <input type="text" name="related" id="" class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md" v-model="link.related_products">
                  </div>
                </div>
              </div> -->
                            <!-- Inventory Starts here -->

                            <div
                                class="bg-white pt-4 md:pt-7 pb-1 mb-3 md:mb-5 rounded"
                            >
                                <div
                                    @click="inventory_open = !inventory_open"
                                    class="flex justify-between md:px-8 px-4 cursor-pointer"
                                >
                                    <p
                                        class="text-black font-semibold text-lg mb-6"
                                    >
                                        Inventory
                                    </p>
                                    <div>
                                        <chevron-up-icon
                                            class="h-5 w-5 text-indigo-700 cursor-pointer"
                                            v-if="inventory_open"
                                        />
                                        <chevron-down-icon
                                            class="h-5 w-5 text-indigo-700 cursor-pointer"
                                            v-else
                                        />
                                    </div>
                                </div>
                                <div
                                    v-if="inventory_open == true"
                                    class="md:px-8 px-4"
                                >
                                    <div class="mb-8">
                                        <div class="flex flex-wrap mb-6">
                                            <div
                                                class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0"
                                            >
                                                <label
                                                    class="block text-gray-600 mb-2 bg-transparent"
                                                    for="avail_qty"
                                                >
                                                    Quantity Available
                                                </label>
                                                <div
                                                    class="mt-1 relative rounded-md shadow-sm"
                                                >
                                                    <input
                                                        type="text"
                                                        name="avail_qty"
                                                        id="avail_qty"
                                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md"
                                                        aria-describedby="availabnle qty"
                                                        :disabled="
                                                            product.has_variants
                                                        "
                                                        :readonly="
                                                            product.has_variants
                                                        "
                                                        v-model="
                                                            computedQuantity
                                                        "
                                                    />
                                                </div>
                                                <div class="mt-1">
                                                    <p
                                                        class="text-red-600 text-xs"
                                                        v-if="
                                                            v$.product.quantity
                                                                .$error
                                                        "
                                                    >
                                                        {{
                                                            v$.product.quantity
                                                                .$errors[0]
                                                                .$message
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="w-full md:w-1/2 mb-6 md:mb-0 md:pl-3"
                                            >
                                                <label
                                                    class="block text-gray-600 mb-2 bg-transparent"
                                                    for="min_qty"
                                                >
                                                    Minimum Quantity
                                                </label>
                                                <div
                                                    class="mt-1 relative rounded-md shadow-sm"
                                                >
                                                    <input
                                                        type="text"
                                                        name="min_qty"
                                                        id="min_qty"
                                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md"
                                                        aria-describedby="min qty"
                                                        v-model="
                                                            product.min_quantity
                                                        "
                                                    />
                                                </div>
                                                <div class="mt-1">
                                                    <p
                                                        class="text-red-600 text-xs"
                                                        v-if="
                                                            v$.product
                                                                .min_quantity
                                                                .$error
                                                        "
                                                    >
                                                        {{
                                                            v$.product
                                                                .min_quantity
                                                                .$errors[0]
                                                                .$message
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                  <label class="block text-black font-semibold mb-2 bg-transparent" for="page-title">
                                      SKU(Stock Keeping Unit)
                                  </label>
                                  <div class="mt-1 relative rounded-md shadow-sm">
                                      <input type="text" name="sku" id="sku" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="product sku" v-model="product.sku"/>
                                  </div>
                              </div>
                              <div class="w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
                                  <label class="block text-black font-semibold mb-2 bg-transparent" for="page-title">
                                      Barcode (ISBN, UPC, GTIN, etc)
                                  </label>
                                  <div class="mt-1 relative rounded-md shadow-sm">
                                      <input type="text" name="barcode" id="barcode" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="product barcode" v-model="product.barcode"/>
                                  </div>
                              </div> -->
                                            <div class="mt-8 mb-6">
                                                <div class="flex items-center">
                                                    <input
                                                        v-model="
                                                            product.track_quantity
                                                        "
                                                        type="checkbox"
                                                        class="form-checkbox cursor-pointer rounded-sm h-4 w-4 text-indigo-600 transition duration-150 ease-in-out border border-border focus:outline-none"
                                                        id="track_quantity"
                                                    />
                                                    <label
                                                        for="track_quantity"
                                                        class="ml-2 block text-sm leading-5 text-black cursor-pointer"
                                                    >
                                                        Track Quantity
                                                    </label>
                                                </div>
                                                <div
                                                    class="flex items-center mt-4"
                                                >
                                                    <input
                                                        v-model="
                                                            product.sell_out_of_stock
                                                        "
                                                        type="checkbox"
                                                        class="form-checkbox cursor-pointer rounded-sm h-4 w-4 text-indigo-600 transition duration-150 ease-in-out border border-border focus:outline-none"
                                                        id="out_of_stock"
                                                    />
                                                    <label
                                                        for="out_of_stock"
                                                        class="ml-2 block text-sm leading-5 text-black cursor-pointer"
                                                    >
                                                        Continue selling when
                                                        out of stock
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <p class="text-gray-700 font-semibold text-lg mb-6">Quantity</p>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                              <label class="block text-gray-700 font-semibold mb-2 bg-transparent" for="page-title">
                                  Available
                              </label>
                              <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="number" placeholder="0" v-model="product.quantity">
                          </div>
                      </div> -->
                                </div>
                            </div>

                            <!-- Inventory Ends here -->

                            <!-- Shipping starts here -->

                            <!--  <div class="bg-white pt-7 pb-1 mb-10 px-8">
                  <div class="flex justify-between cursor-pointer">
                      <p class="text-black font-semibold text-lg mb-6">Shipping</p>
                      <span><angle-up-icon></angle-up-icon></span>
                  </div>
                  <div class="flex flex-wrap mb-6">
                      <div class="mb-6">
                          <div class="flex items-center">
                              <input v-model="product.physical_product" type="checkbox" id="physical_product" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none">
                              <label for="physical_product" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                  This is a physical product
                              </label>
                          </div>
                      </div>
                  </div>
                  <p class="text-black font-semibold text-lg mb-3">Weight</p>
                  <p class="text-gray-600 pb-4">Used to calculate shipping rates at checkout and label prices during fulfillment.</p>
                  <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-4/5 px-3 mb-6 md:mb-0">
                          <label class="block text-black font-semibold mb-2 bg-transparent" for="weight">
                              Weight
                          </label>
                          <div class="mt-1 relative rounded-md shadow-sm">
                              <input type="text" name="compare_at_price" id="compare_at_price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" v-model="product.weight"/>
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">
                                      {{ store.weight !== null ? store.weight.unit : '' }}
                                    </span>
                                  </div>
                              </div>
                      </div>
                  </div>
              </div> -->

                            <!-- Shipping ends here -->

                            <!-- Search Engine Starts Here -->
                            <div
                                class="bg-white pt-4 md:pt-7 pb-1 mb-3 md:mb-5 px-4 md:px-8 rounded"
                            >
                                <div class="flex justify-between">
                                    <div
                                        class="cursor-pointer"
                                        @click="seo_open = !seo_open"
                                    >
                                        <p
                                            class="text-black font-semibold text-lg mb-6"
                                        >
                                            Search Engine Listing Preview
                                        </p>
                                        <p class="text-gray-600 text-sm mb-6">
                                            Add a title and description to see
                                            how this product might appear in a
                                            search engine listing
                                        </p>
                                    </div>
                                    <chevron-up-icon
                                        class="h-5 w-5 text-indigo-700 cursor-pointer"
                                        v-if="seo_open"
                                    />
                                    <chevron-down-icon
                                        class="h-5 w-5 text-indigo-700 cursor-pointer"
                                        v-else
                                    />
                                </div>
                                <div v-if="seo_open == true">
                                    <div class="my-6">
                                        <label
                                            class="block text-gray-600 mb-2 bg-transparent"
                                            for="page-title"
                                        >
                                            Page title
                                        </label>
                                        <input
                                            :class="[
                                                product.seo_page_title.length >
                                                70
                                                    ? 'focus:ring-red-500 focus:border-red-500'
                                                    : 'focus:ring-indigo-500 focus:border-indigo-500',
                                                'shadow-sm block w-full sm:text-sm border-gray-300 rounded-md',
                                            ]"
                                            type="text"
                                            placeholder="Short sleeve t-shirt"
                                            v-model="product.seo_page_title"
                                        />
                                        <p class="text-gray-500">
                                            {{ product.seo_page_title.length }}
                                            of 70 characters used
                                        </p>
                                        <div class="mt-1">
                                            <!--                                            <p-->
                                            <!--                                                class="text-red-600 text-xs"-->
                                            <!--                                                v-if="-->
                                            <!--                                                    v$.product.seo_page_title-->
                                            <!--                                                        .$error-->
                                            <!--                                                "-->
                                            <!--                                            >-->
                                            <!--                                                {{-->
                                            <!--                                                    v$.product.seo_page_title-->
                                            <!--                                                        .$errors[0].$message-->
                                            <!--                                                }}-->
                                            <!--                                            </p>-->
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            class="block text-gray-600 mb-2 bg-transparent"
                                            for="search_engine_desc"
                                        >
                                            Description
                                        </label>
                                        <textarea
                                            name="w3review"
                                            rows="6"
                                            cols="50"
                                            :class="[
                                                product.seo_description.length >
                                                320
                                                    ? 'focus:ring-red-500 focus:border-red-500'
                                                    : 'focus:ring-indigo-500 focus:border-indigo-500',
                                                'block w-full shadow-sm py-3 px-4 placeholder-gray-500  border border-gray-300 rounded-md',
                                            ]"
                                            placeholder=""
                                            v-model="product.seo_description"
                                        />
                                        <p class="text-gray-500">
                                            {{ product.seo_description.length }}
                                            of 320 characters used
                                        </p>
                                        <div class="mt-1">
                                            <!--                                            <p-->
                                            <!--                                                class="text-red-600 text-xs"-->
                                            <!--                                                v-if="-->
                                            <!--                                                    v$.product.seo_description-->
                                            <!--                                                        .$error-->
                                            <!--                                                "-->
                                            <!--                                            >-->
                                            <!--                                                {{-->
                                            <!--                                                    v$.product.seo_description-->
                                            <!--                                                        .$errors[0].$message-->
                                            <!--                                                }}-->
                                            <!--                                            </p>-->
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            class="block text-gray-600 mb-2 bg-transparent"
                                            for="url_handle"
                                        >
                                            URL and handle
                                        </label>
                                        <div
                                            class="mt-1 relative rounded-md shadow-sm"
                                        >
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                            >
                                                <span
                                                    class="text-gray-500 sm:text-sm"
                                                    ref="domain_name"
                                                >
                                                    {{
                                                        store.domains.length
                                                            ? store.domains[0]
                                                                  .name + "/"
                                                            : ""
                                                    }}
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                :style="{
                                                    paddingLeft: domainWidth,
                                                }"
                                                name="handle"
                                                id="handle"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                aria-describedby="price-currency"
                                                v-model="product.handle"
                                            />
                                        </div>
                                        <div class="mt-1">
                                            <p
                                                class="text-red-600 text-xs"
                                                v-if="v$.product.handle.$error"
                                            >
                                                {{
                                                    v$.product.handle.$errors[0]
                                                        .$message
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Search Engine Ends here -->
                            <!-- Cancels and Save Button here -->
                            <div class="flex justify-between">
                                <button
                                    type="button"
                                    class="rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                                    @click="cancelCreation"
                                >
                                    Cancel
                                </button>
                                <button
                                    class="rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer focus:ring-indigo-500 sm:text-sm"
                                    @click="submitNewProduct"
                                    :disabled="v$.$error || submitting"
                                    :class="{
                                        disabled: v$.$error || submitting,
                                        'opacity-25 cursor-not-allowed':
                                            v$.$error || submitting,
                                    }"
                                >
                                    <svg
                                        v-if="submitting"
                                        role="status"
                                        class="mr-5 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                        viewBox="0 0 100 101"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor"
                                        ></path>
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill"
                                        ></path>
                                    </svg>
                                    <span v-else>Save</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col ml-4 max-w-sm gap-y-4 w-full">
                            <div
                                class="product-type px-7 pt-6 pb-3 bg-white rounded-sm"
                            >
                                <div>
                                    <div class="flex">
                                        <p class="font-semibold text-lg">
                                            Product Type
                                        </p>
                                        <Tooltip :tooltipText="product_tooltip">
                                            <question-mark-circle-icon
                                                class="w-5 h-5 ml-2 cursor-pointer"
                                            />
                                        </Tooltip>
                                    </div>
                                    <p class="text-gray-700 mt-5 mb-2.5">
                                        Choose product type
                                    </p>
                                    <select
                                        name="product_type"
                                        class="py-2 text-xm md:text-xs px-4 rounded border text-gray-600 border-gray-200 w-full"
                                        v-model="product.product_type_id"
                                    >
                                        <option value="" class="">
                                            Select Product Type
                                        </option>
                                        <option
                                            v-for="(
                                                product_type, index
                                            ) in product_types"
                                            :value="product_type.id"
                                            :key="`product_type-${product_type.id}`"
                                        >
                                            {{ product_type.name }}
                                        </option>
                                    </select>
                                    <p
                                        class="text-xm md:text-xs text-gray-600 mt-2"
                                    >
                                        Choose the product category that your
                                        product belongs to, create a custom
                                        product type if your product does not
                                        fit into the available product types.
                                    </p>
                                </div>
                            </div>
                            <!--                            <div-->
                            <!--                                class="collection-type px-7 pt-6 pb-3 bg-white rounded-sm"-->
                            <!--                            >-->
                            <!--                                <div>-->
                            <!--                                    <div class="flex">-->
                            <!--                                        <p class="font-semibold text-lg">-->
                            <!--                                            Collection Type-->
                            <!--                                        </p>-->
                            <!--                                        <Tooltip-->
                            <!--                                            :tooltipText="collection_tooltip"-->
                            <!--                                        >-->
                            <!--                                            <question-mark-circle-icon-->
                            <!--                                                class="w-5 h-5 ml-2 cursor-pointer"-->
                            <!--                                            />-->
                            <!--                                        </Tooltip>-->
                            <!--                                    </div>-->
                            <!--                                    <p class="text-gray-700 mt-5 mb-2.5">-->
                            <!--                                        Choose Collection type-->
                            <!--                                    </p>-->
                            <!--                                    <select-->
                            <!--                                        name="collection_type"-->
                            <!--                                        class="py-2 text-xm md:text-xs px-4 rounded border text-gray-600 border-gray-200 w-full"-->
                            <!--                                        id=""-->
                            <!--                                    >-->
                            <!--                                        <option value="default">-->
                            <!--                                            Default collection-->
                            <!--                                        </option>-->
                            <!--                                    </select>-->
                            <!--                                    <p-->
                            <!--                                        class="text-xm md:text-xs text-gray-600 mt-2"-->
                            <!--                                    >-->
                            <!--                                        Create a collection, then choose the-->
                            <!--                                        collection to which your product belongs-->
                            <!--                                        to.-->
                            <!--                                    </p>-->
                            <!--                                    <div-->
                            <!--                                        class="flex text-indigo-700 my-4 float-right"-->
                            <!--                                    >-->
                            <!--                                        <plus-icon class="w-5 h-5 mr-1" />-->
                            <!--                                        <p>Create Collection</p>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div
                                class="brand-type px-7 pt-6 pb-3 bg-white rounded-sm"
                            >
                                <p class="font-semibold text-lg">Brand Type</p>
                                <p class="text-gray-700 mt-5 mb-2.5">
                                    Brand name
                                </p>
                                <select
                                    name="product_type"
                                    class="py-2 text-xm md:text-xs px-4 rounded border text-gray-600 border-gray-200 w-full"
                                    v-model="product.brand_id"
                                >
                                    <option value="" class="">
                                        Select Brand
                                    </option>
                                    <option
                                        v-for="(brand, index) in brands"
                                        :value="brand.id"
                                        :key="`product_type-${brand.id}`"
                                    >
                                        {{ brand.name }}
                                    </option>
                                </select>

                                <p
                                    class="text-xm md:text-xs text-gray-600 mt-2 mb-4"
                                >
                                    Choose the brand name of your product,
                                    create a custom brand if you cannot find
                                    your brand name.
                                </p>

                                <div v-if="show_brand_input">
                                    <input
                                        type="text"
                                        class="py-2 text-xm md:text-xs px-4 rounded border text-gray-600 border-gray-200 w-full"
                                        name="brand_type"
                                        v-model="new_brand"
                                        placeholder="Brand Name"
                                        @keydown="initiateCreation"
                                    />
                                </div>

                                <div
                                    class="flex cursor-pointer text-indigo-700 my-4 float-right"
                                    @click="createCustomBrand"
                                >
                                    <plus-icon class="w-5 h-5 mr-1" />
                                    <p v-if="new_brand">Add Brand</p>
                                    <p v-else>Create Brand</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <SuccessNotif />
        <ErrorNotif />
    </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
// import Search from "../Search.vue";
import Nav from "./Components/Nav";
import axios from "axios";

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    ChevronLeftIcon,
    ChevronRightIcon,
    ChevronDownIcon,
    ChevronUpIcon,
    PlusIcon,
} from "@heroicons/vue/solid";
import {
    ChartPieIcon,
    InformationCircleIcon,
    HomeIcon,
    QuestionMarkCircleIcon,
} from "@heroicons/vue/outline";
import hljs from "highlight.js";
import InventoryForm from "./Components/InventoryForm";
import ShippingForm from "./Components/ShippingForm";
import VariantsForm from "./Components/VariantsForm";
import MediaUrlModal from "./Components/MediaUrlModal";
import Dropzone from "./Components/Dropzone";
import ImagesList from "./Components/ImagesList";
import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";
import Tooltip from "../../Components/Tooltip/Components/Tooltip.vue";
import { Inertia } from "@inertiajs/inertia";
import useVuelidate from "@vuelidate/core";
import { computed } from "vue";
import {
    email,
    numeric,
    alphaNum,
    helpers,
    required,
    requiredIf,
    sameAs,
} from "@vuelidate/validators";
import { notify } from "notiwind";
import SuccessNotif from "@/Pages/Products/Components/SuccessNotif.vue";
import ErrorNotif from "@/Pages/Products/Components/ErrorNotif.vue";

// import "vue-multiselect/dist/vue-multiselect.min.css";

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};

const pages = [
    { name: "All Product", href: "/products", current: false },
    { name: "Create New Product", href: "/products/create", current: true },
];

export default {
    props: {
        products: Object,
        filters: Object,
        brands: Array,
        categories: Array,
        store: Object,
        product_types: Array,
    },

    components: {
        ErrorNotif,
        SuccessNotif,
        Nav,
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        Multiselect,
        InformationCircleIcon,
        // InventoryForm,
        ShippingForm,
        VariantsForm,
        UploadIcon,
        AngleUpIcon,
        MediaUrlModal,
        Dropzone,
        ImagesList,
        pages,
        ChevronRightIcon,
        ChevronLeftIcon,
        ChevronUpIcon,
        ChevronDownIcon,
        HomeIcon,
        ChartPieIcon,
        Tooltip,
        QuestionMarkCircleIcon,
        PlusIcon,
    },

    data() {
        return {
            submitting: false,
            filteredProducts: [],
            valueContent: "",
            new_brand: "",
            variantList: [],
            expand: true,
            expandMedia: true,
            content: "",
            seo_open: true,
            inventory_open: true,
            link_open: true,
            price_open: true,
            media_open: true,
            product_open: true,
            pageTitleLength: 0,
            searchEngDescLength: 0,
            domainWidth: "0",
            show_brand_input: false,
            product_tooltip:
                "A product type is a categorization that identifies a product and helps users to organize the products in their store.",
            collection_tooltip:
                "A product type is a categorization that identifies a product and helps users to organize the products in their store.",
            editorOption: {
                modules: {
                    toolbar: [
                        [{ color: [] }, { background: [] }],
                        ["bold", "italic", "underline"],
                        [{ list: "ordered" }, { list: "bullet" }],
                        ["link", "image", "video"],
                        ["clean"],
                    ],
                    syntax: {
                        highlight: (text) => hljs.highlightAuto(text).value,
                    },
                },
            },
            product: {
                title: "",
                description: "",
                brand: "",
                images: [],
                price: "",
                compare_at_price: "",
                margin: null,
                profit: null,
                cost_per_item: "",
                handle: "",
                sku: "",
                barcode: "",
                quantity: "",
                track_quantity: false,
                sell_out_of_stock: false,
                has_variants: false,
                min_quantity: "1",
                seo_description: "",
                seo_page_title: "",
                charge_taxes: false,
                product_type_id: "",
                brand_id: "",
            },
            shipping: {
                weight: "",
                physical_product: false,
            },
            link: {
                filters: "",
                related_products: "",
                manufacture: "",
                collection: "",
            },
            variants: {
                has_variants: true,
                is_active: 0,
                options: [
                    {
                        type: "",
                        values: [],
                        price: "",
                        quantity: "",
                        sku: "",
                    },
                ],
            },
            files: [],
            showUrlModal: false,
            media: {
                url: "",
            },
        };
    },
    validations() {
        return {
            product: {
                title: {
                    required: helpers.withMessage(
                        "Please enter a title",
                        required
                    ),
                },
                description: {
                    required: helpers.withMessage(
                        "Please enter a description",
                        required
                    ),
                },
                price: {
                    required_if: helpers.withMessage(
                        "Please enter a price",
                        requiredIf(!this.has_variants)
                    ),
                    numeric,
                },
                compare_at_price: {
                    numeric,
                },
                quantity: {
                    numeric,
                },
                min_quantity: {
                    numeric,
                },
                handle: {
                    alphaNum,
                },
            },
        };
    },
    computed: {
        activeDomain() {},
        editor() {
            return this.$refs.description?.quill;
        },
        editorContent() {
            return this.$refs.description.$refs.editor.innerHTML;
        },
        variantDetails() {
            return {
                ...this.variants,
                is_active: this.variants.has_variants ? 1 : 0,
            };
        },
        computedQuantity: {
            get() {
                return this.product.has_variants
                    ? this.variantList.reduce(
                          (prev, curr) => prev + parseInt(curr.quantity),
                          0
                      )
                    : this.product.quantity;
            },
            set(val) {
                this.product.quantity = val;
            },
        },
    },
    mounted() {
        this.domainWidth = this.$refs.domain_name.clientWidth + 10 + "px";
    },
    methods: {
        cancelCreation() {
            Inertia.visit("/products", {
                method: "get",
            });
        },
        initiateCreation(e) {
            if (e.key === "Enter") {
                this.createCustomBrand();
            }
            if (e.key === "Escape") {
                this.new_brand = "";
                this.show_brand_input = false;
            }
        },
        submitNewProduct() {
            this.v$.$validate();
            if (this.v$.$error) {
                document.getElementById("createContentContainer").scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
                return;
            }

            if (this.product.has_variants) {
                this.product.variants = [];
                this.product.available_variant_attributes =
                    this.variants.options.map((option) => option.type);
                this.variantList.forEach((variant) => {
                    this.product.variants.push({
                        price: variant.price,
                        sku: variant.sku,
                        quantity: variant.quantity,
                        attributes: variant.property,
                    });
                });
            }
            const productsRequest = {};
            productsRequest.assets = [];
            this.product.images.map((image) => {
                productsRequest.assets.push({
                    url: image.large,
                    thumb: image.thumb,
                    description: image.alt,
                });
            });
            productsRequest.store_id = this.store.id;

            Object.keys(this.product).map((key) => {
                productsRequest[key] = this.product[key];
            });
            this.submitting = true;
            axios
                .post("/products", productsRequest)
                .then((response) => {
                    Inertia.visit("/products", {
                        method: "get",
                    });
                    notify(
                        {
                            group: "success",
                            title: "Success",
                            text: `Product created successfully`,
                        },
                        4000
                    );
                })
                .catch((error) => {
                    if (error.response.status === 400) {
                        notify(
                            {
                                group: "error",
                                title: "Error",
                                text: error.response.data.message,
                            },
                            4000
                        );
                    } else {
                        notify(
                            {
                                group: "error",
                                title: "Error",
                                text: "Something went wrong, please try again later.",
                            },
                            4000
                        );
                    }
                    console.log(error.response.data);
                    if (error.response.data.errors) {
                        errors.value = error.response.data.errors;
                    }
                })
                .finally(() => {
                    this.submitting = false;
                });
        },
        createCustomBrand() {
            if (!this.show_brand_input) {
                this.show_brand_input = true;
            } else {
                axios
                    .post("/brands", {
                        name: this.new_brand,
                    })
                    .then((res) => {
                        notify(
                            {
                                group: "success",
                                title: "Success",
                                text: `Your brand "${this.new_brand}" was created successfully.`,
                            },
                            4000
                        );
                        Inertia.reload({
                            only: ["brands"],
                        });
                        this.new_brand = "";
                        this.show_brand_input = false;
                    })
                    .catch((err) => {
                        if (err.response.status === 400) {
                            notify(
                                {
                                    group: "error",
                                    title: "Error",
                                    text: err.response.data.message,
                                },
                                4000
                            );
                        } else {
                            notify(
                                {
                                    group: "error",
                                    title: "Error",
                                    text: "Something went wrong, please try again later.",
                                },
                                4000
                            );
                            console.log(err);
                        }
                    });
            }
        },
        showFormFields() {
            console.log(this.formData);
        },
        addOption(e) {
            this.variants.options.push({
                type: "",
                values: [],
                price: "",
                quantity: "",
                sku: "",
            });
        },
        addVariantName(e) {
            let index = e.target.getAttribute("data-index");
            this.variants.options[index].name = e.target.value;
            //console.log(e)
        },
        addVariantValue(e) {
            if (!e) return false;
            let index = e[1];
            let name = e[0];
            this.variants.options[index].values.push(name);
            this.displayVariants();
        },
        removeVariantValue(e) {
            if (!e.e) return false;
            let index = parseInt(e.index);
            let text = e.e[0];
            let indice = this.variants.options[index].values.indexOf(text);
            this.variants.options[index].values.splice(indice, 1);
            this.displayVariants();
        },
        addCategory() {
            this.inventory.category.push({
                type: "",
                value: "",
            });
        },
        onAddImage(response) {
            for (let i = 0; i < response.data.length; i++) {
                this.product.images.push(response.data[i]);
            }
        },
        handleFileDrop(e) {
            let droppedFiles = e.dataTransfer.files;
            if (!droppedFiles) return;
            [...droppedFiles].forEach((f) => {
                this.files.push(f);
            });
        },
        handleFileInput(e) {
            let files = e.target.files;
            files = e.target.files;
            if (!files) return;
            [...files].forEach((f) => {
                this.files.push(f);
            });
        },
        removeFile(fileKey) {
            this.files.splice(fileKey, 1);
        },
        onEditorChange(editor) {
            console.log(editor);
            // console.log(this.$refs.description.$refs.editor.innerHTML);
        },
        onEditorBlur(editor) {
            // console.log("editor blur!", editor);
        },
        onEditorFocus(editor) {
            // console.log("editor focus!", editor);
        },
        onEditorReady(editor) {
            // console.log("editor ready!", editor);
        },
        showContent() {
            // console.log(this.editorContent);
        },
        upload() {
            // console.log(this.formData);
        },
        delete_img(image) {
            this.product.images = image;
        },
        submit() {
            // this.sending = true
            this.product.description =
                this.$refs.description.$refs.editor.innerHTML;
            this.product.variants = this.variantList;
            this.product.variant_options = this.variants.options;
            console.log(this.product);
            if (this.product.description == "" || this.product.variants == "") {
                alert("Imcomplete Form. Kindly fill");
            } else {
                axios.post("/products", this.product);
            }

            // this.$inertia.post("/products", this.formData);
        },
        afterComplete(file) {
            // console.log(file);
        },
        expandMediaForm() {
            this.expandMedia = !this.expandMedia;
        },
        expandForm() {
            this.expand = !this.expand;
        },
        newDisplayVariants() {},
        displayVariants() {
            let attributes = this.variants.options;
            let total_count = 1;

            // return false

            // a loop can do this
            if (attributes.length == 1) {
                total_count = attributes[0].values.length;
            } else if (attributes.length == 2) {
                total_count =
                    attributes[0].values.length * attributes[1].values.length;
            } else if (attributes.length == 3) {
                total_count =
                    attributes[0].values.length *
                    attributes[1].values.length *
                    attributes[2].values.length;
            }

            let g = [];
            let a = 0;

            let base_attribute = attributes[0];

            let z = [];

            //initialize variables first

            for (let j = 0; j < total_count; j++) {
                z[j] = [];
            }

            let q = 0;

            //first phase
            let first_attribute =
                attributes.length == 1
                    ? 1
                    : total_count / attributes[0].values.length;

            for (let i = 0; i < base_attribute.values.length; i++) {
                for (let k = 0; k < first_attribute; k++) {
                    console.log(base_attribute);
                    z[q].push({
                        attribute: base_attribute.type,
                        value: base_attribute.values[i],
                    });
                    q++;
                }
            }

            if (attributes.length > 1) {
                let second_attributes =
                    total_count / attributes[1].values.length;
                q = 0;
                for (let k = 0; k < second_attributes; k++) {
                    for (let i = 0; i < attributes[1].values.length; i++) {
                        console.log(attributes[1]);
                        z[q].push({
                            attribute: attributes[1].type,
                            value: attributes[1].values[i],
                        });
                        q++;
                    }
                }
            }

            if (attributes.length == 3) {
                let third_attributes =
                    total_count / attributes[2].values.length;
                q = 0;
                for (let k = 0; k < third_attributes; k++) {
                    for (let i = 0; i < attributes[2].values.length; i++) {
                        console.log(attributes[2]);
                        z[q].push({
                            attribute: attributes[2].type,
                            value: attributes[2].values[i],
                        });
                        q++;
                    }
                }
            }

            if (z.length > this.variantList.length) {
                // We are adding
                // Check if we are adding new variant property

                console.log("adding", z, this.variantList);
                for (let l = 0; l < z.length; l++) {
                    let filteredVariantLists = this.variantList.filter(
                        (item) => {
                            // let exists = true;
                            // // JSON.stringify(item.property) ===
                            // // JSON.stringify(z[l])
                            // Object.keys(item.property).forEach((prop) => {
                            //     if (item.property[prop] != z[l][prop]) {
                            //         exists = false;
                            //     }
                            // });
                            // return exists;
                            let exists = true;
                            z[l].forEach((singleObj) => {
                                let correspondingSingleObj =
                                    item.property.filter(
                                        (prop) =>
                                            prop.attribute ===
                                            singleObj.attribute
                                    )[0];
                                if (
                                    correspondingSingleObj.value !==
                                    singleObj.value
                                ) {
                                    exists = false;
                                }
                            });
                            return exists;
                        }
                    );
                    if (!filteredVariantLists.length) {
                        this.variantList.push({
                            property: z[l],
                            price: this.product.price || "",
                            quantity: 1,
                            sku: this.product.sku
                                ? `${this.product.sku}-${this.variantList.length}`
                                : "",
                        });
                    }
                }
            } else {
                // I don't believe we should ever get here, but this is just in case.
                this.variantList = [];
                for (let l = 0; l < z.length; l++) {
                    console.log(z[l]);
                    // Determine if we are adding or removing
                    // If we are adding, check if the value of the current z already exists in the variant list, when we find one that doesn't, we add it
                    // If we are removing, loop through the varia

                    this.variantList.push({
                        property: z[l],
                        price: this.product.price || "",
                        quantity: 1,
                        sku: this.product.sku
                            ? `${this.product.sku}-${l + 1}`
                            : "",
                    });
                }
            }

            // for (let l = 0; l < z.length; l++) {
            //     console.log(z[l]);
            //     // Determine if we are adding or removing
            //     // If we are adding, check if the value of the current z already exists in the variant list, when we find one that doesn't, we add it
            //     // If we are removing, loop through the varia
            //     variantList.push({
            //         property: z[l],
            //         price: "",
            //         quantity: 1,
            //         sku: "",
            //     });
            // }
            //
            // this.variantList = variantList;
        },
    },

    setup() {
        const open = ref(false);

        const v$ = useVuelidate();

        return {
            statusStyles,
            pages,
            v$,
        };
    },
};
</script>
<style scoped>
@import "style.css";
.quill {
    display: flex;
    flex-direction: column;
}
</style>
<style>
.quill *,
.quill .ql-container {
    font-family: "Nunito", sans-serif !important;
    font-size: 0.985rem;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>
