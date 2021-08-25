<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" auto-reopen="true" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xlg sm:w-full sm:p-6">
           <div>
                <div class="flex justify-between">
                    <h2 class="text-xl">Create a New Customer</h2>
                    <XIcon class="w-5 h-5 cursor-pointer" @click="emitClose()"/>
                </div>
              <div class=" mt-3 -mx-6 border-t border-gray-300"></div>
             <div class="lg:col-span-2">
            <form action="#" method="POST" class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
              <div>
                <label for="first-name" class="block text-warm-gray-900">First name</label>
                <div class="mt-1">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
              <div>
                <label for="last-name" class="block text-warm-gray-900">Last name</label>
                <div class="mt-1">
                  <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
              <div class=" col-span-2">
                <label for="email" class="block text-sm font-medium text-warm-gray-900">Email</label>
                <div class="mt-1">
                  <input id="email" name="email" type="email" autocomplete="email" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
              <div class="mt-4 col-span-2">
                <div class="flex">
                  <input aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-4 my-auto" />
                  <label for="" class="">Customer accepts email marketing</label>  
                </div>
                <div class="flex mt-3">
                  <input aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-4 my-auto" />
                  <label for="" class="">Customer is tax exempt</label>
                </div>
              </div>
            </form>
        </div>
      <div class=" mt-6 mb-4 -mx-6 border-t border-gray-300"></div>
      <div>
        <h2 class="text-lg">Shipping Address</h2>
        <form action="#" method="POST" class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
              <div>
                <label for="first-name" class="block text-warm-gray-900">Company</label>
                <div class="mt-1">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
              <div>
                <label for="last-name" class="block text-warm-gray-900">Phone Number</label>
                <div class="mt-1">
                  <input type="tel" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
               <div>
                <label for="first-name" class="block text-warm-gray-900">Address</label>
                <div class="mt-1">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
              <div>
                <label for="last-name" class="block text-warm-gray-900">Apartment, suite etc (optional)</label>
                <div class="mt-1">
                  <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
              <div>
                <label for="first-name" class="block text-warm-gray-900">City</label>
                <div class="mt-1">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
              <div>
                <label for="last-name" class="block text-warm-gray-900">Country/Region</label>
                <div class="mt-1">
                  <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
               <div>
                <label for="first-name" class="block text-warm-gray-900">State</label>
                <div class="mt-1">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
              <div>
                <label for="last-name" class="block text-warm-gray-900">ZIP/Postal Code</label>
                <div class="mt-1">
                  <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" />
                </div>
              </div>
            </form>
      </div>
            </div>
              <div class=" mt-3 -mx-6 border-t border-gray-300"></div>
            <div class="mt-5 flex justify-between">
              <button type="button" class="mt-3 w-20 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="emitClose()" ref="cancelButtonRef">
                Close
              </button>
              <button type="button" class="inline-flex w-20 justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" @click="open = false">
                Apply
              </button>
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'

var countries = {
    AF: 'Afghanistan',
    AX: 'Aland Islands',
    AL: 'Albania',
    DZ: 'Algeria',
    AS: 'American Samoa',
    AD: 'Andorra',
    AO: 'Angola',
    AI: 'Anguilla',
    AQ: 'Antarctica',
    AG: 'Antigua And Barbuda',
    AR: 'Argentina',
    AM: 'Armenia',
    AW: 'Aruba',
    AU: 'Australia',
    AT: 'Austria',
    AZ: 'Azerbaijan',
    BS: 'Bahamas',
    BH: 'Bahrain',
    BD: 'Bangladesh',
    BB: 'Barbados',
    BY: 'Belarus',
    BE: 'Belgium',
    BZ: 'Belize',
    BJ: 'Benin',
    BM: 'Bermuda',
    BT: 'Bhutan',
    BO: 'Bolivia',
    BA: 'Bosnia And Herzegovina',
    BW: 'Botswana',
    BV: 'Bouvet Island',
    BR: 'Brazil',
    IO: 'British Indian Ocean Territory',
    BN: 'Brunei Darussalam',
    BG: 'Bulgaria',
    BF: 'Burkina Faso',
    BI: 'Burundi',
    KH: 'Cambodia',
    CM: 'Cameroon',
    CA: 'Canada',
    CV: 'Cape Verde',
    KY: 'Cayman Islands',
    CF: 'Central African Republic',
    TD: 'Chad',
    CL: 'Chile',
    CN: 'China',
    CX: 'Christmas Island',
    CC: 'Cocos (Keeling) Islands',
    CO: 'Colombia',
    KM: 'Comoros',
    CG: 'Congo',
    CD: 'Congo, Democratic Republic',
    CK: 'Cook Islands',
    CR: 'Costa Rica',
    CI: "Cote D'Ivoire",
    HR: 'Croatia',
    CU: 'Cuba',
    CY: 'Cyprus',
    CZ: 'Czech Republic',
    DK: 'Denmark',
    DJ: 'Djibouti',
    DM: 'Dominica',
    DO: 'Dominican Republic',
    EC: 'Ecuador',
    EG: 'Egypt',
    SV: 'El Salvador',
    GQ: 'Equatorial Guinea',
    ER: 'Eritrea',
    EE: 'Estonia',
    ET: 'Ethiopia',
    FK: 'Falkland Islands (Malvinas)',
    FO: 'Faroe Islands',
    FJ: 'Fiji',
    FI: 'Finland',
    FR: 'France',
    GF: 'French Guiana',
    PF: 'French Polynesia',
    TF: 'French Southern Territories',
    GA: 'Gabon',
    GM: 'Gambia',
    GE: 'Georgia',
    DE: 'Germany',
    GH: 'Ghana',
    GI: 'Gibraltar',
    GR: 'Greece',
    GL: 'Greenland',
    GD: 'Grenada',
    GP: 'Guadeloupe',
    GU: 'Guam',
    GT: 'Guatemala',
    GG: 'Guernsey',
    GN: 'Guinea',
    GW: 'Guinea-Bissau',
    GY: 'Guyana',
    HT: 'Haiti',
    HM: 'Heard Island & Mcdonald Islands',
    VA: 'Holy See (Vatican City State)',
    HN: 'Honduras',
    HK: 'Hong Kong',
    HU: 'Hungary',
    IS: 'Iceland',
    IN: 'India',
    ID: 'Indonesia',
    IR: 'Iran, Islamic Republic Of',
    IQ: 'Iraq',
    IE: 'Ireland',
    IM: 'Isle Of Man',
    IL: 'Israel',
    IT: 'Italy',
    JM: 'Jamaica',
    JP: 'Japan',
    JE: 'Jersey',
    JO: 'Jordan',
    KZ: 'Kazakhstan',
    KE: 'Kenya',
    KI: 'Kiribati',
    KR: 'Korea',
    KW: 'Kuwait',
    KG: 'Kyrgyzstan',
    LA: "Lao People's Democratic Republic",
    LV: 'Latvia',
    LB: 'Lebanon',
    LS: 'Lesotho',
    LR: 'Liberia',
    LY: 'Libyan Arab Jamahiriya',
    LI: 'Liechtenstein',
    LT: 'Lithuania',
    LU: 'Luxembourg',
    MO: 'Macao',
    MK: 'Macedonia',
    MG: 'Madagascar',
    MW: 'Malawi',
    MY: 'Malaysia',
    MV: 'Maldives',
    ML: 'Mali',
    MT: 'Malta',
    MH: 'Marshall Islands',
    MQ: 'Martinique',
    MR: 'Mauritania',
    MU: 'Mauritius',
    YT: 'Mayotte',
    MX: 'Mexico',
    FM: 'Micronesia, Federated States Of',
    MD: 'Moldova',
    MC: 'Monaco',
    MN: 'Mongolia',
    ME: 'Montenegro',
    MS: 'Montserrat',
    MA: 'Morocco',
    MZ: 'Mozambique',
    MM: 'Myanmar',
    NA: 'Namibia',
    NR: 'Nauru',
    NP: 'Nepal',
    NL: 'Netherlands',
    AN: 'Netherlands Antilles',
    NC: 'New Caledonia',
    NZ: 'New Zealand',
    NI: 'Nicaragua',
    NE: 'Niger',
    NG: 'Nigeria',
    NU: 'Niue',
    NF: 'Norfolk Island',
    MP: 'Northern Mariana Islands',
    NO: 'Norway',
    OM: 'Oman',
    PK: 'Pakistan',
    PW: 'Palau',
    PS: 'Palestinian Territory, Occupied',
    PA: 'Panama',
    PG: 'Papua New Guinea',
    PY: 'Paraguay',
    PE: 'Peru',
    PH: 'Philippines',
    PN: 'Pitcairn',
    PL: 'Poland',
    PT: 'Portugal',
    PR: 'Puerto Rico',
    QA: 'Qatar',
    RE: 'Reunion',
    RO: 'Romania',
    RU: 'Russian Federation',
    RW: 'Rwanda',
    BL: 'Saint Barthelemy',
    SH: 'Saint Helena',
    KN: 'Saint Kitts And Nevis',
    LC: 'Saint Lucia',
    MF: 'Saint Martin',
    PM: 'Saint Pierre And Miquelon',
    VC: 'Saint Vincent And Grenadines',
    WS: 'Samoa',
    SM: 'San Marino',
    ST: 'Sao Tome And Principe',
    SA: 'Saudi Arabia',
    SN: 'Senegal',
    RS: 'Serbia',
    SC: 'Seychelles',
    SL: 'Sierra Leone',
    SG: 'Singapore',
    SK: 'Slovakia',
    SI: 'Slovenia',
    SB: 'Solomon Islands',
    SO: 'Somalia',
    ZA: 'South Africa',
    GS: 'South Georgia And Sandwich Isl.',
    ES: 'Spain',
    LK: 'Sri Lanka',
    SD: 'Sudan',
    SR: 'Suriname',
    SJ: 'Svalbard And Jan Mayen',
    SZ: 'Swaziland',
    SE: 'Sweden',
    CH: 'Switzerland',
    SY: 'Syrian Arab Republic',
    TW: 'Taiwan',
    TJ: 'Tajikistan',
    TZ: 'Tanzania',
    TH: 'Thailand',
    TL: 'Timor-Leste',
    TG: 'Togo',
    TK: 'Tokelau',
    TO: 'Tonga',
    TT: 'Trinidad And Tobago',
    TN: 'Tunisia',
    TR: 'Turkey',
    TM: 'Turkmenistan',
    TC: 'Turks And Caicos Islands',
    TV: 'Tuvalu',
    UG: 'Uganda',
    UA: 'Ukraine',
    AE: 'United Arab Emirates',
    GB: 'United Kingdom',
    US: 'United States',
    UM: 'United States Outlying Islands',
    UY: 'Uruguay',
    UZ: 'Uzbekistan',
    VU: 'Vanuatu',
    VE: 'Venezuela',
    VN: 'Viet Nam',
    VG: 'Virgin Islands, British',
    VI: 'Virgin Islands, U.S.',
    WF: 'Wallis And Futuna',
    EH: 'Western Sahara',
    YE: 'Yemen',
    ZM: 'Zambia',
    ZW: 'Zimbabwe'
}

export default {
  emits: ['emitClose'],
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    XIcon,
  },
  data(){
    return{
      
    }
  },
  methods:{
    emitClose(){
      this.open = false
      this.$emit('emitClose')
    }
  },
  setup() {
    const open = ref(true)

    return {
      open,
    }
  },
}
</script>


