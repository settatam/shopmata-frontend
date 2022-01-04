<template>
    <app-layout>
        <div class="flex-1 flex flex-col mt-4 min-h-screen">
            <div class="flex-shrink-0 px-6 md:px-8 py-3 flex items-center">
                <inertia-link href="/orders">
                    <p class="text-xs text-gray-400 cursor-pointer">Orders</p>
                </inertia-link>
                <ChevronRightIcon
                                class="flex-shrink-0 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                <p class="text-xs"># {{ order.id }}</p>
            </div>
            <nav class="flex px-4 md:px-8 mb-4" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4 font-bold text-2xl">
                    <li>
                        <div>
                            <a
                                href="/orders"
                                class=""
                            >
                                <ChevronLeftIcon
                                    class="flex-shrink-0 h-5 w-5"
                                    aria-hidden="true"
                                />
                                <span class="sr-only">Orders</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <a
                                href="#"
                                class=""
                                >Order Id #{{order.id}}</a
                            >
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="px-5 md:px-6  w-full flex flex-col md:flex-row">
                <div class="flex flex-col w-full md:w-2/3 mr-5 gap-4">
                    <div class="bg-white py-4 md:py-6 px-5 md:px-8 rounded">
                        <div class="flex justify-between mb-3.5">
                            <h2 class="font-bold text-lg">Orders placed</h2>
                            <button
                                class="
                                    px-5
                                    py-1
                                    text-center
                                    bg-gray-100
                                    border
                                    text-black
                                    rounded-md
                                    text-xs
                                "
                                @click="send_invoice=true"
                            >
                                Send Invoice
                            </button>
                        </div>
                        <div class="flex justify-between">
                            <h2 class="font-semibold text-xs md:text-base text-indigo-700">
                                Order #{{ order.id }}
                            </h2>
                            <p class="text-gray-400 text-xm">
                                {{ moment(order.updated_at).format("lll") }}
                            </p>
                        </div>
                        <p class="mt-2.5 text-xs md:text-base">
                            {{ store.currency.symbol_left }} {{ parseFloat(order.total_orders).toFixed(2) }} from Online Store
                        </p>
                        <div
                            v-for="item in order.items"
                            v-bind:key="item.id"
                            class="mt-10 flex flex-col md:flex-row"
                        >
                        <div class=" w-full flex md:w-4.5/10 justify-between">
                            <div class="flex">
                                <img
                                    src="../../../assets/placeholder_theme.jpg"
                                    alt="category_image"
                                    class="w-10 h-10"
                                />
                                <div class="ml-3">
                                    <h2 class="text-indigo-700 text-xs md:text-base">
                                        {{ item.title }}
                                    </h2>
                                    <p class=" text-xm md:text-base text-gray-500">
                                        Chanel / Pink
                                    </p>
                                    <!-- <p class="text-base text-gray-500">
                                        Qty: {{ item.quantity }}
                                    </p> -->
                                    <p
                                        class=" text-xm
                                            md:text-base text-gray-500
                                            whitespace-nowrap
                                        "
                                    >
                                        SKU: {{ item.sku }}
                                    </p>
                                </div>
                            </div>
                            <div class="">
                                <p class="text-xm md:text-base mb-1">Promotion</p>
                                <p class="font-semibold text-xs md:text-lg">
                                    {{ item.promotion || "N/A" }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full md:mx-auto md:w-5/10 flex justify-between">
                            <div class="">
                                <p class="text-xm md:text-base mb-1">Product Price</p>
                                <p class="font-semibold text-xs md:text-lg">
                                    {{ store.currency.symbol_left }} {{  parseFloat(item.price).toFixed(2) }}
                                </p>
                            </div>
                            <div class="">
                                <p class="text-xm md:text-base mb-1 text-center">Quantity</p>
                                <p class="font-semibold text-center text-xs md:text-lg">
                                    {{ item.quantity || 1 }}
                                </p>
                            </div>
                            <div class="">
                                <p class="text-xm md:text-base mb-1">SubTotal</p>
                                <p class="font-semibold text-xs md:text-lg">
                                    {{ store.currency.symbol_left }} {{parseFloat( item.price * (item.quantity || 1)).toFixed(2)}}
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-6 px-5 md:px-8 rounded">
                        <div class="flex justify-between mb-3.5">
                            <h2 class="font-semibold text-lg">
                                Payment Summary
                            </h2>
                        </div>
                        <div>
                            <div class="flex justify-between mb-3.5">
                                <h2 class="font-semibold text-gray-700 text-xs md:text-base" v-if="order.items.length>1">
                                    Subtotal {{ " " }} ({{ order.items.length}} items)
                                </h2>
                                <h2 class="font-semibold text-gray-700 text-xs md:text-base" v-else>
                                    Subtotal {{ " " }} ({{ order.items.length}} item)
                                </h2>
                                <p class="text-black font-semibold md:font-bold">
                                    {{ store.currency.symbol_left}} {{parseFloat(total_subtotal).toFixed(2) || 0.00  }}
                                </p>
                            </div>
                            <div class="flex justify-between mb-4">
                                <h2 class="font-semibold text-gray-700 text-xs md:text-base">Delivery</h2>
                                <p class="text-black font-semibold md:font-bold">
                                    {{ store.currency.symbol_left }} {{ parseFloat(order.delivery).toFixed(2) || "0.00"}}
                                </p>
                            </div>
                            <div class="flex justify-between">
                                <h2 class="font-semibold text-gray-700">Tax</h2>
                                <p class="text-black font-semibold md:font-bold">
                                   {{ store.currency.symbol_left }} {{ parseFloat(order.sales_tax).toFixed(2) || "0.00" }}
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-between border-t-2 border-gray-100 mt-5 pt-5">
                            <h2 class="font-semibold text-gray-500">Total Amount</h2>
                                <p class="text-black font-semibold md:font-bold">
                                   {{ store.currency.symbol_left }} {{(total_payment())}}
                                </p>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-6 px-5 md:px-8 rounded">
                        <div class="mb-4">
                            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                                <div>
                                    <p class="text-xs mb-3 text-gray-700">Date Added</p>
                                    <p class="font-semibold text-base md:text-lg">
                                        {{ moment(order.updated_at).format("ll") }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs mb-3 text-gray-700">Customer Note</p>
                                    <p
                                        v-if="order.customer_note"
                                        class="font-semibold text-base md:text-lg"
                                    >
                                        {{ order.created_at }}
                                    </p>
                                    <p
                                        v-else
                                        class="w-2 font-semibold text-gray-900"
                                    >
                                        -
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs mb-3 text-gray-700">Status</p>
                                    
                                        <span :class="[order.status=='received'?'bg-green-100 text-green-700 ':'bg-red-100 text-red-700','text-xs pl-5 pr-8  py-1 rounded capitalize']
                                        ">{{ order.status }}</span>
                                    
                                </div>

                                <div>
                                    <p class="text-xs mb-3 text-gray-700">
                                        Customer Notified
                                    </p>
                                    <p class="font-semibold text-base md:text-lg">
                                        {{ order.customer_notified || "Unavailable" }}
                                    </p>
                                </div>
                            </div>
                            <!-- <h2 class="font-semibold text-xl mb-2.5">
                                {{ getCustomer.first_name }}
                                {{ getCustomer.last_name }}
                            </h2> -->
                            <div class="text-gray-400">
                                <!-- <h2 class="font-normal">
                                    {{ getCustomer.address }},
                                    {{ getCustomer.city }}
                                    {{ getCustomer.state }},
                                    {{ getCustomer.country }}
                                </h2> -->
                                <!-- <h2>Customer for about 4 years</h2> -->
                            </div>
                        </div>
                        <div class="mt-3.5 border-t border-gray-100 -mx-6"></div>
                        <div class="mt-5">
                            <h2 class="font-semibold text-lg md:text-xl mb-5">
                                Order History
                            </h2>
                            <div class="flex mb-8 justify-between md:justify-evenly">
                                <div class="flex items-center w-2/5  md:w-1/5">
                                    <h2 class="font-normal text-xm md:text-base">
                                        Order Status
                                    </h2>
                                </div>
                                <div class="w-full ml-5 flex">
                                    <select
                                        v-if="order.status.length > 0"
                                        class="
                                            shadow-sm
                                            focus:ring-indigo-500
                                            focus:border-indigo-500
                                            md:text-xs
                                            text-xm
                                            capitalize text-gray-700
                                            border-gray-300
                                            rounded-md
                                            md:p-2
                                            px-2
                                            md:w-1/2
                                            mr-2
                                        "
                                        placeholder=""
                                        required
                                        v-model="order_status"
                                    >
                                        <option value="">
                                            Select status
                                        </option>
                                        <option v-for="status in statuses" :key="status.id" :value="status">
                                            {{status}}
                                        </option>
                                    </select>
                                    <button :class="[order_status==''?'bg-indigo-400':'bg-indigo-700','p-2 border text-white rounded-md']" :disabled="order_status==''" @click="updateStatus">Update Status</button>
                                </div>
                            </div>
                            <div class="mb-5 flex">
                                <p class="mr-10 font-normal md:text-base text-xs">
                                    Notify Customer
                                </p>
                                <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        class="
                                            focus:ring-indigo-500
                                            text-indigo-600
                                            border-gray-300
                                            mr-2
                                        "
                                        v-model="order.customer.notify"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <h2 class="font-normal text-xm md:text-xs">Customer Note</h2>
                        </div>
                        <div class="flex w-full mb-6 relative">
                            <div class="w-full mr-2 ">
                                <input
                                    id="text3"
                                    type="text"
                                    placeholder="Add a note"
                                    class="
                                        w-full
                                        pl-4
                                        py-2
                                        rounded-md
                                        border border-gray-300
                                        text-gray-900
                                        placeholder-gray-300
                                        focus:outline-none
                                    "
                                    v-model="customer_note"
                                />
                            </div>
                            <button
                                class="
                                    px-6 
                                    margin
                                    py-1.5
                                    text-center
                                    bg-indigo-700
                                    border
                                    top-0
                                    right-4
                                    text-white
                                    text-xs
                                    rounded-md
                                    absolute
                                "
                                @click=" addCustomerNote"
                            >
                                Add
                            </button>
                        </div>
                        
                        <!-- <div>
                            <div
                                class="
                                    -mr-6
                                    -ml-8
                                    border-b-2
                                    my-5
                                    border-gray-100
                                "
                            ></div>
                            <div class="mb-8 lg:w-7/10 flex justify-between">
                                <div class="">
                                    <h4 class="mb-3">Last Order</h4>
                                    <h4 class="mb-3 font-semibold text-lg">
                                        {{ order.created_at }}
                                    </h4>
                                    <h4 class="">From Online Store</h4>
                                </div>
                                <div class="">
                                    <h4 class="mb-3">Total spent to date</h4>
                                    <h4 class="mb-3 font-semibold text-lg">
                                        {{ order.total }}
                                    </h4>
                                    <h4 class="">1 Order</h4>
                                </div>
                                <div>
                                    <h4 class="mb-3">Average order value</h4>
                                    <h4 class="mb-3 font-semibold text-lg">
                                        {{ store.currency.code }}
                                        {{
                                            Number(
                                                Number(
                                                    order.average_orders
                                                ).toFixed(2)
                                            ).toLocaleString()
                                        }}
                                    </h4>
                                    <h4></h4>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="flex flex-col w-full md:hidden">
                    <div class="bg-white pl-5 mb-3 pr-7 pb-6 pt-6 rounded">
                        <div class="flex justify-between mb-3">
                            <h2 class="font-bold text-lg">Order Details</h2>
                        </div>
                        <div>
                            <div class="mb-2 flex justify-between">
                                <div>
                                    <h2
                                        class="
                                             text-gray-700
                                             text-xs md:text-base
                                        "
                                    >
                                        Channel:
                                    </h2>
                                </div>
                                <div>
                                    <h2
                                        class="
                                        text-gray-800 text-xs md:text-base
                                        "
                                    >
                                        
                                        {{ store.business_name }}
                                    </h2>
                                </div>
                            </div>
                            <div class="mb-2 flex justify-between">
                                <h2 class=" text-gray-700 text-xs md:text-base">
                                    Date:
                                </h2>
                                <div>
                                    <h2 class=" text-gray-800 text-xs md:text-base">
                                        {{ moment(order.updated_at).format('ll') }}
                                    </h2>
                                </div>
                            </div>
                            <div class="mb-2 flex justify-between">
                                <h2 class="text-gray-700 text-xs md:text-base">
                                    Payment Method
                                </h2>
                                <div>
                                    <h2
                                        class="
                                            text-gray-800 text-xs md:text-base
                                        "
                                    >
                                        {{ order.payment || "Cash on delivery" }}
                                    </h2>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <h2 class="text-gray-700 text-xs md:text-base">
                                    Delivery
                                </h2>
                                <div>
                                    <h2
                                        class="
                                            text-gray-800 text-xs md:text-base
                                        "
                                    >
                                        {{ order.delivery || "Flat shipping rate" }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <!-- <h2
                            v-if="order.note"
                            class="text-cyan-700 font-semibold"
                        >
                            {{ order.note }}
                        </h2> -->
                        <!-- <p v-else class="font-normal text-base text-gray-400">
                            No notes from customer
                        </p> -->
                    </div>
                    <!-- Customer causing the white section below -->
                        <div class="bg-white pl-5 pr-7 pb-10 pt-6 mb-5 rounded">
                        <div class="border-b border-gray-200 -mx-5 mb-6.5">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-bold text-lg">
                                    Customer Overview
                                </h2>
                                <a
                                    href="/order/edit"
                                    class="text-indigo-700 font-semibold text-xs"
                                    >View Details</a
                                >
                            </div>
                    
                            <div class="px-5 mb-6 flex">
                                <div class="flex mr-2 mt-1">
                                    <p
                                        class="
                                            h-14
                                            w-14
                                            rounded-full
                                            capitalize
                                            bg-gray-100
                                            text-black text-lg
                                            flex
                                            items-center
                                            justify-center
                                            font-semibold
                                        "
                                    >
                                        {{ getCustomer?.first_name.charAt(0)
                                        }}{{ getCustomer?.last_name.charAt(0) }}
                                    </p>
                                </div>
                                <div class="flex flex-col">
                                    <inertia-link
                                        :href="'/customers/' + getCustomer.id"
                                        >{{ getCustomer.first_name }}
                                        {{
                                            getCustomer.last_name
                                        }}</inertia-link
                                    >

                                    <h2
                                        class="
                                            font-semibold
                                            text-indigo-700
                                            mb-1 text-xs lg:text-base
                                        "
                                    >
                                        {{ getCustomer.email }}
                                    </h2>
                                    <!-- <h2 class="text-gray-400">
                                        {{ getCustomer.activation_status }}
                                    </h2> -->
                                    <!-- <h2 class="text-gray-400">
                                        {{ getCustomer.phone_number }}
                                    </h2> -->
                                   <h2 class="text-black text-xs lg:text-base">
                                        {{ store.phone }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 -mx-5 mb-6.5">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-bold">
                                    Billing Address
                                </h2>
                            </div>
                            <div class="px-5 text-gray-500 mb-6 text-xs">
                                <h2 class="font-normal mb-1">
                                    {{ getCustomer.first_name }}
                                    {{ getCustomer.last_name }}
                                </h2>
                                <h2 class="mb-1">{{ store.address }}</h2>
                                 <h2 class="mb-1">Apt 402</h2>
                                <h2 class="mb-1">
                                    {{ getCustomer.city }}
                                    {{ getCustomer.state }}
                                </h2>
                                <h2 class="mb-6">{{ getCustomer.country }}</h2>
                                <!-- <a
                                    href="/order/address"
                                    class="font-semibold text-indigo-700"
                                    >Add new address</a
                                > -->
                            </div>
                        </div>
                        <div class="border-b border-gray-200 -mx-5 mb-6.5 ">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-bold">
                                    Shipping Address
                                </h2>
                            </div>
                            <div class="px-5 text-gray-500 mb-6 text-xs">
                                <h2 class="font-normal mb-1">
                                    {{ getCustomer.first_name }}
                                    {{ getCustomer.last_name }}
                                </h2>
                                <h2 class="mb-1">{{ store.address }}</h2>
                                <h2 class="mb-1">Apt 402</h2>
                                <h2 class="mb-1">
                                    {{ getCustomer.city }}
                                    {{ getCustomer.state }}
                                </h2>
                                <h2 class="mb-6">{{ getCustomer.country }}</h2>
                                <!-- <a
                                    href="/order/address"
                                    class="font-semibold text-indigo-700"
                                    >Add new address</a
                                > -->
                            </div>
                        </div>
                         <div class=" flex justify-between mb-4">
                                <h2 class="font-bold ">
                                    Tax Settings
                                </h2>
                                <a
                                    href="/order/manage"
                                    class="text-indigo-700 font-semibold text-xs"
                                    >Manage</a
                                >
                            </div>
                            <div class="text-xs text-gray-400">
                                <h2>No exemptions</h2>
                            </div>
                    </div> 
                    <!-- Hard coded values -->
                    <div class="bg-white pl-5 pr-7 pt-6 pb-9 mb-3 rounded">
                        <div class="flex justify-between">
                            <h2 class="font-bold text-lg mb-6">
                                Email marketing
                            </h2>
                            <h2 class="text-indigo-700 text-xs font-semibold">
                                Unsubscribe
                            </h2>
                        </div>
                        <div
                            class="
                                mb-3.5
                                
                                inline-flex
                                leading-5
                                bg-green-100
                                text-green-500
                                text-xs
                                px-2
                                py-1
                            "
                        >
                            Subscribed
                        </div>
                        <div class="">
                            <h2 class="font-semibold text-indigo-700 mb-3.5 text-xs">
                                {{ getCustomer.email }}
                            </h2>
                            <h2 class="text-gray-400 text-xs">
                                Subscribed on December 30, 2018
                            </h2>
                        </div>
                    </div>
                    <div class="bg-white pl-5 pr-7 pb-9 pt-6 rounded relative">
                        <div class="flex justify-between mb-4.5 ">
                            <h2 class="font-bold text-lg">Tags</h2>
                            <h2 class="text-indigo-700 text-xs font-semibold cursor-pointer" @click="tag_open=true">
                                Add tags
                            </h2>
                        </div>
                        <input type="text" name="tag" class="border-gray-300 px-6 pl-9 w-full py-2 text-xs placeholder-gray-300 rounded-lg relative" placeholder="Search for tags">
                        <search-icon class="h-5 w-5 font-bold text-gray-500 absolute left-8 top-20"/>
                        <div class="flex text-xm mt-4 w-full overflow-x-scroll items-center">
                            <div class="py-0.5 px-2 rounded-xl mr-2 bg-indigo-100 items-center flex" v-for="(tag,index) in tags" :key="index">
                                <p class="text-indigo-700 font-medium capitalize">{{tag}}</p>
                                <x-icon class="h-3 w-3 ml-1 text-blue-400 font-bold cursor-pointer" @click="removeTag(index)"/>
                            </div>
                        </div>

                            <div class="absolute top-12 rounded p-6 bg-white w-full -mx-5 border border-gray-200" v-if="tag_open">
                                <div class="flex items-center mb-6">
                                    <ChevronLeftIcon class="h-6 w-6 mr-4" @click="cancel_tag"/>
                                    <p class="text-lg font-semibold">Add Tags</p>
                                </div>
                                <div class="mb-10 flex flex-col">
                                    <label for="tag" class="mb-2">
                                        Tag name
                                    </label>
                                    <input type="text" name="tag" class="border-gray-300 px-3 py-2 text-xs placeholder-gray-300 rounded-lg" placeholder="Seperate tags with a comma" v-model="tag_name">
                                </div>
                                <div class="flex justify-between">
                                    <button type="button" class=" inline-flex justify-center rounded-md border border-transparent shadow-sm px-7 py-3 bg-indigo-700 text-base font-medium text-white hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm" @click="addTag">
                                        Create
                                    </button>
                                    <button type="button" class="md:mt-3  inline-flex justify-center rounded-md border border-gray-300 shadow-sm py-3 px-7 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm" @click="cancel_tag" ref="cancelButtonRef">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                    </div>
                    <confirmation-modal v-if="confirm_open" @close="confirm_open=false" @confirm="submit"/>

                    <div class="bg-white pl-5 mt-3 mb-3 pr-7 pb-9 pt-6 rounded">
                        <div class="flex justify-between mb-4.5">
                            <h2 class="font-bold text-lg">Notes</h2>
                            <p class="font-semibold text-indigo-700 cursor-pointer text-xs">Edit</p>
                        </div>
                        <div v-if="customer_notes">
                            <div v-for="note in customer_notes" :key="note.id" class="border border-gray-200 rounded p-3.5 mb-2">
                                <div class="flex justify-between text-xs ">
                                    <div>
                                        <p><span class="font-bold ">You</span> added a note</p>
                                        <p class="text-xm">{{note.date}}</p>
                                    </div>
                                    <div class="flex">
                                        <pencil-icon class="text-indigo-700 w-5 h-5 cursor-pointer"/>
                                        <trash-icon class="w-5 h-5 text-gray-500 cursor-pointer"/>
                                    </div>
                                </div>
                                <div class="border-b border-gray-200 my-2 w-full h-px"></div>
                                  <p class="text-gray-800">{{note.note}}</p>  
                            </div>
                        </div>
                        <p v-else class="text-xs text-gray-400">
                            No notes from customer
                        </p>
                    </div>
                </div>
                    <!-- <p class="text-right text-gray-400 mt-1">
                        Only you and other staff can see comments
                    </p> -->
                        <div class="pt-8  mt-4 rounded">
                            <div class="flex justify-between border-gray-300 border-b mb-6">
                                <h2 class="text-lg font-bold mb-2">Timeline</h2>
                                <div>
                                    <input type="checkbox" name="timeline" id="" class="mr-2" v-model="show_timeline">
                                    <label for="timeline" class="text-xs">Show comments</label>
                                </div>

                            </div>
                                <div v-if="show_timeline">
                                    <p class=" h-10 w-10 rounded-full capitalize ml-0 md:ml-4 bg-indigo-700 text-white text-lg flex items-center justify-center font-semibold">
                                        {{ getCustomer?.first_name.charAt(0)}}{{ getCustomer?.last_name.charAt(0) }}
                                    </p>
                                </div>
                                <div class="timeline_container" v-if="show_timeline">
                                    <div class="para_1 relative event text-xm md:text-xs mb-11" v-for="timeline in timelines" :key="timeline.id">
                                        <div class="date text-gray-500 ">{{moment(timeline.date).format('ll')}}</div>
                                        <div class="flex justify-between">
                                            <div>
                                                <p class="font-semibold">{{timeline.note}}</p>
                                                <p class="font-semibold">{{timeline.email}}</p>

                                            </div>
                                            <div class="date text-gray-500">{{moment(timeline.date).format('LT')}} </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="py-2 px-8 bg-indigo-700 rounded text-white float-right mb-2 sticky bottom-0 md:static" @click="confirm_open=true">Save order</button>
                        </div>
                </div>
                
                <div class="hidden md:flex flex-col w-full md:w-1/3">
                    <div class="bg-white pl-5 mb-3 pr-7 pb-6 pt-6 rounded">
                        <div class="flex justify-between mb-3">
                            <h2 class="font-bold text-lg">Order Details</h2>
                        </div>
                        <div>
                            <div class="mb-2 flex justify-between">
                                <div>
                                    <h2
                                        class="
                                             text-gray-700
                                        "
                                    >
                                        Channel:
                                    </h2>
                                </div>
                                <div>
                                    <h2
                                        class="
                                        text-gray-800
                                        "
                                    >
                                        
                                        {{ store.business_name }}
                                    </h2>
                                </div>
                            </div>
                            <div class="mb-2 flex justify-between">
                                <h2 class=" text-gray-700">
                                    Date:
                                </h2>
                                <div>
                                    <h2 class=" text-gray-800">
                                        {{ moment(order.updated_at).format('ll') }}
                                    </h2>
                                </div>
                            </div>
                            <div class="mb-2 flex justify-between">
                                <h2 class="text-gray-700">
                                    Payment Method
                                </h2>
                                <div>
                                    <h2
                                        class="
                                            text-gray-800
                                        "
                                    >
                                        {{ order.payment || "Cash on delivery" }}
                                    </h2>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <h2 class="text-gray-700">
                                    Delivery
                                </h2>
                                <div>
                                    <h2
                                        class="
                                            text-gray-800
                                        "
                                    >
                                        {{ order.delivery || "Flat shipping rate" }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <!-- <h2
                            v-if="order.note"
                            class="text-cyan-700 font-semibold"
                        >
                            {{ order.note }}
                        </h2> -->
                        <!-- <p v-else class="font-normal text-base text-gray-400">
                            No notes from customer
                        </p> -->
                    </div>
                    <!-- Customer causing the white section below -->
                        <div class="bg-white pl-5 pr-7 pb-10 pt-6 mb-5 rounded">
                        <div class="border-b border-gray-200 -mx-5 mb-6.5">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-bold text-lg">
                                    Customer Overview
                                </h2>
                                <a
                                    href="/order/edit"
                                    class="text-indigo-700 font-semibold text-xs"
                                    >View Details</a
                                >
                            </div>
                    
                            <div class="px-5 mb-6 flex">
                                <div class="flex mr-2 mt-1">
                                    <p
                                        class="
                                            h-14
                                            w-14
                                            rounded-full
                                            capitalize
                                            bg-gray-100
                                            text-black text-lg
                                            flex
                                            items-center
                                            justify-center
                                            font-semibold
                                        "
                                    >
                                        {{ getCustomer?.first_name.charAt(0)
                                        }}{{ getCustomer?.last_name.charAt(0) }}
                                    </p>
                                </div>
                                <div class="flex flex-col">
                                    <inertia-link
                                        :href="'/customers/' + getCustomer.id"
                                        >{{ getCustomer.first_name }}
                                        {{
                                            getCustomer.last_name
                                        }}</inertia-link
                                    >

                                    <h2
                                        class="
                                            font-semibold
                                            text-indigo-700
                                            mb-1
                                        "
                                    >
                                        {{ getCustomer.email }}
                                    </h2>
                                    <!-- <h2 class="text-gray-400">
                                        {{ getCustomer.activation_status }}
                                    </h2> -->
                                    <!-- <h2 class="text-gray-400">
                                        {{ getCustomer.phone_number }}
                                    </h2> -->
                                   <h2 class="text-black">
                                        {{ store.phone }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 -mx-5 mb-6.5">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-bold">
                                    Billing Address
                                </h2>
                            </div>
                            <div class="px-5 text-gray-500 mb-6 text-xs">
                                <h2 class="font-normal mb-1">
                                    {{ getCustomer.first_name }}
                                    {{ getCustomer.last_name }}
                                </h2>
                                <h2 class="mb-1">{{ store.address }}</h2>
                                 <h2 class="mb-1">Apt 402</h2>
                                <h2 class="mb-1">
                                    {{ getCustomer.city }}
                                    {{ getCustomer.state }}
                                </h2>
                                <h2 class="mb-6">{{ getCustomer.country }}</h2>
                                <!-- <a
                                    href="/order/address"
                                    class="font-semibold text-indigo-700"
                                    >Add new address</a
                                > -->
                            </div>
                        </div>
                        <div class="border-b border-gray-200 -mx-5 mb-6.5 ">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-bold">
                                    Shipping Address
                                </h2>
                            </div>
                            <div class="px-5 text-gray-500 mb-6 text-xs">
                                <h2 class="font-normal mb-1">
                                    {{ getCustomer.first_name }}
                                    {{ getCustomer.last_name }}
                                </h2>
                                <h2 class="mb-1">{{ store.address }}</h2>
                                <h2 class="mb-1">Apt 402</h2>
                                <h2 class="mb-1">
                                    {{ getCustomer.city }}
                                    {{ getCustomer.state }}
                                </h2>
                                <h2 class="mb-6">{{ getCustomer.country }}</h2>
                                <!-- <a
                                    href="/order/address"
                                    class="font-semibold text-indigo-700"
                                    >Add new address</a
                                > -->
                            </div>
                        </div>
                         <div class=" flex justify-between mb-4">
                                <h2 class="font-bold ">
                                    Tax Settings
                                </h2>
                                <a
                                    href="/order/manage"
                                    class="text-indigo-700 font-semibold text-xs"
                                    >Manage</a
                                >
                            </div>
                            <div class="text-xs text-gray-400">
                                <h2>No exemptions</h2>
                            </div>
                    </div> 
                    <!-- Hard coded values -->
                    <div class="bg-white pl-5 pr-7 pt-6 pb-9 mb-3 rounded">
                        <div class="flex justify-between">
                            <h2 class="font-bold text-lg mb-6">
                                Email marketing
                            </h2>
                            <h2 class="text-indigo-700 text-xs font-semibold">
                                Unsubscribe
                            </h2>
                        </div>
                        <div
                            class="
                                mb-3.5
                                
                                inline-flex
                                leading-5
                                bg-green-100
                                text-green-500
                                text-xs
                                px-2
                                py-1
                            "
                        >
                            Subscribed
                        </div>
                        <div class="">
                            <h2 class="font-semibold text-indigo-700 mb-3.5 text-xs">
                                {{ getCustomer.email }}
                            </h2>
                            <h2 class="text-gray-400 text-xs">
                                Subscribed on December 30, 2018
                            </h2>
                        </div>
                    </div>
                    <div class="bg-white pl-5 pr-7 pb-9 pt-6 rounded relative">
                        <div class="flex justify-between mb-4.5 ">
                            <h2 class="font-bold text-lg">Tags</h2>
                            <h2 class="text-indigo-700 text-xs font-semibold cursor-pointer" @click="tag_open=true">
                                Add tags
                            </h2>
                        </div>
                        <input type="text" name="tag" class="border-gray-300 px-6 pl-9 w-full py-2 text-xs placeholder-gray-300 rounded-lg relative" placeholder="Search for tags">
                        <search-icon class="h-5 w-5 font-bold text-gray-500 absolute left-8 top-20"/>
                        <div class="flex text-xm mt-4 w-full overflow-x-scroll items-center">
                            <div class="py-0.5 px-2 rounded-xl mr-2 bg-indigo-100 items-center flex" v-for="(tag,index) in tags" :key="index">
                                <p class="text-indigo-700 font-medium capitalize">{{tag}}</p>
                                <x-icon class="h-3 w-3 ml-1 text-blue-400 font-bold cursor-pointer" @click="removeTag(index)"/>
                            </div>
                        </div>
                        <!-- 
                        <label for="search" class="sr-only">Search</label>
                            <input
                            id="text"
                            type="text"
                            placeholder="VIP, sale, shopper, etc"
                            class="
                                block
                                pl-3
                                py-2
                                rounded-md
                                border border-gray-300
                                text-gray-900
                                placeholder-gray-300
                                focus:outline-none
                                w-full
                            "
                        />
                        <div class="mt-4" v-if="order.tags.length > 0">
                            <span
                                v-for="tag in order.tags"
                                :key="tag.id"
                                class="
                                    inline-flex
                                    items-center
                                    py-1.5
                                    pl-2
                                    pr-2
                                    rounded-full
                                    text-base
                                    font-medium
                                    bg-yellow-100
                                    text-yellow-800
                                    mr-2
                                "
                            >
                                {{ tag.title }}
                                <button
                                    type="button"
                                    class="
                                        flex-shrink-0
                                        ml-0.5
                                        h-4
                                        w-4
                                        rounded-full
                                        inline-flex
                                        items-center
                                        justify-center
                                        text-yellow-600
                                        hover:bg-yellow-100
                                        hover:text-yellow-500
                                        focus:outline-none
                                        focus:bg-yellow-800
                                        focus:text-white
                                    "
                                >
                                    <span
                                        class="sr-only"
                                        v-if="tag.id < order.tags.length"
                                        >Remove small option</span
                                    >
                                    <svg
                                        class="h-2 w-2"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 8 8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-width="1.5"
                                            d="M1 1l6 6m0-6L1 7"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </div> -->
                            <div class="absolute top-12 rounded p-6 bg-white w-full -mx-5 border border-gray-200" v-if="tag_open">
                                <div class="flex items-center mb-6">
                                    <ChevronLeftIcon class="h-6 w-6 mr-4"/>
                                    <p class="text-lg font-semibold">Add Tags</p>
                                </div>
                                <div class="mb-10 flex flex-col">
                                    <label for="tag" class="mb-2">
                                        Tag name
                                    </label>
                                    <input type="text" name="tag" class="border-gray-300 px-3 py-2 text-xs placeholder-gray-300 rounded-lg" placeholder="Seperate tags with a comma" v-model="tag_name">
                                </div>
                                <div class="flex justify-between">
                                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-7 py-3 bg-indigo-700 text-base font-medium text-white hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm" @click="addTag">
                                        Create
                                    </button>
                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-7 py-3 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm" @click="cancel_tag" ref="cancelButtonRef">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                    </div>
                    <confirmation-modal v-if="confirm_open" @close="confirm_open=false" @confirm="submit"/>

                    <div class="bg-white pl-5 mt-3 mb-3 pr-7 pb-9 pt-6 rounded">
                        <div class="flex justify-between mb-4.5">
                            <h2 class="font-bold text-lg">Notes</h2>
                            <p class="font-semibold text-indigo-700 cursor-pointer text-xs">Edit</p>
                        </div>
                        <div v-if="customer_notes">
                            <div v-for="note in customer_notes" :key="note.id" class="border border-gray-200 rounded p-3.5 mb-2">
                                <div class="flex justify-between text-xs ">
                                    <div>
                                        <p><span class="font-bold ">You</span> added a note</p>
                                        <p class="text-xm">{{note.date}}</p>
                                    </div>
                                    <div class="flex">
                                        <pencil-icon class="text-indigo-700 w-5 h-5 cursor-pointer"/>
                                        <trash-icon class="w-5 h-5 text-gray-500 cursor-pointer"/>
                                    </div>
                                </div>
                                <div class="border-b border-gray-200 my-2 w-full h-px"></div>
                                  <p class="text-gray-800">{{note.note}}</p>  
                            </div>
                        </div>
                        <p v-else class="text-xs text-gray-400">
                            No notes from customer
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import Search from "../Search.vue";
import Nav from "../../Layouts/Nav";
import axios from "axios";
import EmptyProductModal from "./Components/EmptyProductModal.vue";
import ProductModal from "./Components/ProductModal.vue";
import ShippingModal from "./Components/ShippingModal.vue";
import DiscountModal from "./Components/DiscountModal.vue";
import TaxesModal from "./Components/TaxesModal.vue";
import NewCustomerModal from "./Components/NewCustomerModal.vue";
import BillingModal from "./Components/BillingModal.vue";
import AddressModal from "./Components/AddressModal.vue";
import TagModal from "./Components/TagModal.vue";
import MarkAsPaidModal from "./Components/MarkAsPaidModal.vue";
import ReserveItemsModal from "./Components/ReserveItemsModal.vue";
import ConfirmationModal from "./Components/ConfirmationModal.vue"

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    ChevronLeftIcon,
    XIcon,
    PlusIcon,
    ChevronRightIcon,
    ArrowLeftIcon,
    TrashIcon,
    PencilIcon,
    SearchIcon
} from "@heroicons/vue/solid";
import { HomeIcon } from "@heroicons/vue/outline";
import hljs from "highlight.js";
// import InventoryForm from "./Components/InventoryForm";
// import ShippingForm from "./Components/ShippingForm";
// import VariantsForm from "./Components/VariantsForm";
// import SearchEngineForm from "./Components/SearchEngineForm";
// import MediaUrlModal from "./Components/MediaUrlModal";
// import PricingForm from "./Components/PricingForm";
import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";
import Button from "../../Jetstream/Button.vue";
// import "vue-multiselect/dist/vue-multiselect.min.css";
import moment from "moment"

const pages = [{ name: "Orders", href: "/orders", current: false }];

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};
export default {
    props: {
        order: Object,
        store: Object,
        statuses:Array
    },

    components: {
        Nav,
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        Multiselect,
        // InventoryForm,
        // ShippingForm,
        // VariantsForm,
        // SearchEngineForm,
        // PricingForm,
        UploadIcon,
        AngleUpIcon,
        Button,
        ConfirmationModal,
        // MediaUrlModal,
        EmptyProductModal,
        ProductModal,
        ChevronLeftIcon,
        XIcon,
        SearchIcon,
        PlusIcon,
        DiscountModal,
        ShippingModal,
        TaxesModal,
        NewCustomerModal,
        BillingModal,
        AddressModal,
        TagModal,
        MarkAsPaidModal,
        ReserveItemsModal,
        ChevronRightIcon,
        ArrowLeftIcon,
        HomeIcon,
        TrashIcon,
        PencilIcon,
        XIcon
    },

    data() {
        return {
            pages,
            valueContent: "",
            openShipping: false,
            selected: "",
            send_invoice:false,
            openDiscount: false,
            openTaxes: false,
            openCustomer: false,
            openBilling: false,
            openAddress: false,
            openTag: false,
            tag_name:"",
            notify_customer:true,
            openMarkAsPaid: false,
            openReserve: false,
            confirm_open:false,
            order_status:this.order.status,
            customer_note:"",
            tag_open:false,
            tags:[],
            dropzoneOptions: {
                url: "/product-images",
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                addRemoveLinks: true,
                headers: { "My-Awesome-Header": "header value" },
                dictDefaultMessage: `<span><svg class="inline mb-3" xmlns="http://www.w3.org/2000/svg" width="72" height="58" viewBox="0 0 72 58" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M19.827 6.039C24.3247 2.16061 30.0611 0.0186233 36 0C48.105 0 58.1535 9 59.247 20.6055C66.411 21.618 72 27.6165 72 34.9785C72 43.0605 65.259 49.5 57.0915 49.5H45C44.4033 49.5 43.831 49.2629 43.409 48.841C42.9871 48.419 42.75 47.8467 42.75 47.25C42.75 46.6533 42.9871 46.081 43.409 45.659C43.831 45.2371 44.4033 45 45 45H57.096C62.9055 45 67.5 40.446 67.5 34.9785C67.5 29.5065 62.91 24.9525 57.0915 24.9525H54.8415V22.7025C54.846 12.7125 46.476 4.5 36 4.5C31.1394 4.51942 26.4458 6.27495 22.7655 9.45C19.359 12.384 17.577 15.921 17.577 18.6975V20.7135L15.5745 20.934C9.288 21.6225 4.5 26.784 4.5 32.931C4.5 39.5325 10.035 45 17.0145 45H27C27.5967 45 28.169 45.2371 28.591 45.659C29.0129 46.081 29.25 46.6533 29.25 47.25C29.25 47.8467 29.0129 48.419 28.591 48.841C28.169 49.2629 27.5967 49.5 27 49.5H17.0145C7.686 49.5 0 42.147 0 32.931C0 24.9975 5.697 18.4275 13.239 16.7625C13.8825 12.879 16.38 9.009 19.827 6.039Z" fill="#CCCCCC"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M35.438 28.3899C35.5626 28.265 35.7105 28.166 35.8734 28.0984C36.0363 28.0308 36.2109 27.996 36.3873 27.996C36.5637 27.996 36.7383 28.0308 36.9012 28.0984C37.0641 28.166 37.212 28.265 37.3366 28.3899L45.3814 36.4347C45.6331 36.6865 45.7746 37.0279 45.7746 37.384C45.7746 37.7401 45.6331 38.0815 45.3814 38.3333C45.1296 38.5851 44.7881 38.7265 44.4321 38.7265C44.076 38.7265 43.7346 38.5851 43.4828 38.3333L37.7281 32.5759V56.1552C37.7281 56.5108 37.5868 56.8518 37.3354 57.1033C37.0839 57.3547 36.7429 57.496 36.3873 57.496C36.0317 57.496 35.6907 57.3547 35.4392 57.1033C35.1878 56.8518 35.0465 56.5108 35.0465 56.1552V32.5759L29.2918 38.3333C29.04 38.5851 28.6985 38.7265 28.3425 38.7265C27.9864 38.7265 27.645 38.5851 27.3932 38.3333C27.1414 38.0815 27 37.7401 27 37.384C27 37.0279 27.1414 36.6865 27.3932 36.4347L35.438 28.3899Z" fill="#632A6D"/></span><br/><p class="m-4">Drag and drop your image here or </p><br/> <t-button class="text-white bg-purple-darker active:bg-purple-darker font-medium border border-transparent px-4 py-3.5" type="submit">Choose File</t-button>`,
            },
            show_timeline:true,
            expand: true,
            expandMedia: true,
            content: "",
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
            qty: "",
            formFields: {
                title: "",
                description: "",
                brand: "",
            },
            note: "",
            variantSelected: [],
            openModal: false,
            pricing: {
                price: "",
                compare_at_price: "",
                cost_per_item: "",
                margin: null,
                profit: null,
            },
            search: {
                page_title: "",
                search_engine_desc: "",
                url_handle: "",
            },
            inventory: {
                sku: "",
                barcode: "",
                quantity: "",
                track_quantity: false,
                out_of_stock: false,
                category: [],
            },
            shipping: {
                weight: "",
                physical_product: false,
            },
            variant_types: ["size", "weight", "color"],
            variants: {
                has_variants: false,
                is_active: 0,
                options: [
                    {
                        type: "",
                        values: [],
                    },
                ],
            },
            total_subtotal:0,
            files: [],
            showUrlModal: false,
            media: {
                url: "",
            },
            customer_notes:[],
            production: [],
            subTotal: 0,
            taxes: 0,
            total: 0,
            email: false,
            pending: false,
            paid: false,
            timelines:[
                {
                    id:1,
                    note:"Order Confirmation email for order #3296 sent to this customer",
                    email:"(jerry.gyang@gmail.com)",
                    date: "2021-10-29T08:24:58.000000Z"
                },
                {
                    id:2,
                    note:"Order Confirmation email for order #3296 sent to this customer",
                    email:"(jerry.gyang@gmail.com)",
                    date: "2021-09-20T08:24:58.000000Z"
                },
                {
                    id:3,
                    note:"Order Confirmation email for order #3296 sent to this customer",
                    email:"(jerry.gyang@gmail.com)",
                    date: "2020-03-09T08:24:58.000000Z"
                },
                {
                    id:4,
                    note:"Order Confirmation email for order #3296 sent to this customer",
                    email:"(jerry.gyang@gmail.com)",
                    date: "2020-10-29T08:24:58.000000Z"
                }
            ]
        };
    },
    computed: {
        getCustomer() {
            return this.order.customer;
        },
        calculateMargin() {
            this.formFields.margin = 0;
            return `$ ${0}`;
        },
        calculateProfit() {
            return `$ ${0}`;
        },
        formData() {
            return {
                ...this.formFields,
                description: this.$refs.description.$refs.editor.innerHTML,
                ...this.inventory,
                ...this.search,
                ...this.pricing,
                ...this.variants,
                ...this.shipping,
            };
        },
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
    },
    mounted(){
        for (let index = 0; index < this.order.items.length; index++) {
            let unit_subtotal = this.order.items[index].price * (this.order.items[index].quantity?this.order.items[index].quantity:1)
                this.total_subtotal += unit_subtotal  
                //console.log(this.total_subtotal)
            };
        
    },
    methods: {
        showFormFields() {
            console.log(this.formData);
        },
        total_payment(){
            return parseFloat(this.total_subtotal).toFixed(2)
        },
        addOption(e) {
            this.variants.options.push({
                type: "",
                values: [],
            });
        },
        addTag(){
           const tag = this.tag_name.split(",")
           for (let index = 0; index < tag.length; index++) {
               const char = tag[index];
               this.tags.push(char)
           }
           this.tag_name = ""
           this.tag_open = false
        },
        removeTag(id){
            this.tags.splice(id, 1)
        
        },
        addVariantName(e) {
            let index = e.target.getAttribute("data-index");
            this.variants.options[index].name = e.target.value;
        },
        addVariantValue(e) {
            let index = e.target.getAttribute("data-index");
            this.variants.options[index].values.push(e.target.value);
        },
        addCategory() {
            this.inventory.category.push({
                type: "",
                value: "",
            });
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
            console.log(editor.editor);
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
        submit() {
            // this.sending = true

            this.$inertia.post("/products", this.formData);
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
        displayVariants() {
            let attributes = this.variants;
            let total_count = 1;

            // a loop can do this
            if (attributes.indexOf(1) && attributes.indexOf(2)) {
                total_count =
                    attributes[0].values.length *
                    attributes[1].values.length *
                    attributes[2].values.length;
            }

            let g = [];
            let a = 0;

            let base_attribute = attributes[0];

            const gVal = (data, g) => {
                let c = g.length;
                if (data.values.indexOf(c)) return data.values[c];
                return "";
            };

            let z = [];

            //initialize variables first

            for (let j = 0; j < total_count; j++) {
                z[j] = [];
            }

            let q = 0;

            //first phase
            let first_attribute = total_count / attributes[0].values.length;

            for (let i = 0; i < base_attribute.values.length; i++) {
                for (let k = 0; k < first_attribute; k++) {
                    z[q].push(base_attribute.values[i]);
                    q++;
                }
            }

            let second_attributes = total_count / attributes[1].values.length;
            q = 0;

            for (let k = 0; k < second_attributes; k++) {
                for (let i = 0; i < attributes[1].values.length; i++) {
                    z[q].push(attributes[1].values[i]);
                    q++;
                }
            }

            let third_attributes = total_count / attributes[2].values.length;

            q = 0;
            for (let k = 0; k < third_attributes; k++) {
                for (let i = 0; i < attributes[2].values.length; i++) {
                    z[q].push(attributes[2].values[i]);
                    q++;
                }
            }

            console.log(z);
        },
        updateStatus(){
            this.order.status = this.order_status
        },
        emitClose() {
            //console.log("object")
            this.openModal = false;
            this.openShipping = false;
            this.openDiscount = false;
            this.openTaxes = false;
            this.openCustomer = false;
            this.openBilling = false;
            this.openAddress = false;
            this.openTag = false;
            this.openMarkAsPaid = false;
            this.openReserve = false;
        },
        async getProducts() {
            //this.loading = true
            const products = await axios.post("/products/get-order-products");
            this.production = products.data.data;
            //this.loading = false
            console.log(products);
        },
        browseProduct() {
            this.openModal = true;
            this.getProducts();
        },
        addCustomerNote(){
            let today = new Date();
            let date = (today.getMonth()+1)+' '+today.getDate();
            //let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            //let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            let dateTime = moment(date).format('ll');
            let customer_note_info={
                date: dateTime,
                note:this.customer_note
            }
            this.customer_notes.push(customer_note_info)
            this.customer_note=""
        },
        cancel_tag(){
            this.tag_open=false
            this.tag_name=''
        }
    },
    setup() {
        const open = ref(false);
        // console.log(order);

        // const order = orders

        return {
            statusStyles,
            pages,
            moment
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
.margin {
  margin-top: 3.5px;
  margin-bottom: 3.5px;
}
.timeline_container {
  max-width: 90%;
  margin: 0 auto;
  border-left: 4px solid rgba(180, 183, 196, 1);
  padding-left: 47px;
}
.timeline_container .event::before {
  content: "";
  width: 8px;
  height: 8px;
  position: absolute;
  border-radius: 50%;
  left: -53px;
  top: 50%;
  transform: translateY(-50%);
  background: #b4b7c4;
  z-index: 20;
}
.timeline_container .event::after {
  content: "";
  width: 16px;
  height: 16px;
  border: 1px solid #b4b7c4;
  position: absolute;
  border-radius: 50%;
  left: -57px;
  top: 50%;
  transform: translateY(-50%);
  background: #f7f5f7;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>
