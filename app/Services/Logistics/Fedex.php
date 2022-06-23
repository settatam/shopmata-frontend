<?php

namespace App\Services\Logistics;

use App\Models\Customer;
use App\Models\Address;
use Illuminate\Support\Facades\Http;
use App\Models\StoreUser;
use App\Models\ShippingUser;

class Fedex extends Shipping
{
    protected $mergeLabelDocOption;
    protected $recipients = [];
    protected $shipper = [];
    const DEFAULT_PACKAGES_TYPE = 'YOUR_PACKAGING';
    const DEFAULT_LABEL_OPTION = 'LABEL';
    protected $accessToken = '';
    protected $trackingNumber;
    protected $base64Label;
    protected $packagingType = '';
    protected $specialServices = [];
    public $errors = [];
    protected $customer_references = [];
    protected $invoiceNumber;


    public function verifyAddress() {

    }

    public function getToken() {
        $response = Http::withHeaders(
            ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->asForm()
            ->post(config('logistics.fedex.url').'/oauth/token?', [
                'grant_type' => 'client_credentials',
                'client_id' => config('logistics.fedex.key'),
                'client_secret' => config('logistics.fedex.secret'),
            ]);
        if($response->successful()) {
           if($tokenResponse = $response->json()) {
               $this->accessToken = $tokenResponse['access_token'];
           }
           return true;
        }

        return false;
    }

    private function getRecipients() {
        return $this->recipients;
    }

    public function setShippingUser($user) {
        $this->setParams('senderCompany', $user->company_name);
        $this->setParams('senderFirstName', $user->first_name);
        $this->setParams('senderLastName', $user->first_name);
        $this->setParams('senderStreetAddress', $user->address);
        $this->setParams('senderStreetAddress2', $user->address2);
        $this->setParams('senderState', $user->state);
        $this->setParams('senderCountry', $user->country);
        $this->setParams('senderPostalCode', $user->postal_code);
        $this->setParams('senderCity', $user->city);
    }

    public function setReceiver($user) {
        $this->setParams('receiverCompany', $user->company_name);
        $this->setParams('receiveFirstName', $user->first_name);
        $this->setParams('receiveLastName', $user->first_name);
        $this->setParams('receiveStreetAddress', $user->address);
        $this->setParams('receiveStreetAddress2', $user->address2);
        $this->setParams('receiveState', $user->state);
        $this->setParams('receiveCountry', $user->country);
        $this->setParams('receivePostalCode', $user->postal_code);
        $this->setParams('receiveCity', $user->city);
    }

    public function getLabel() {
        $this->setParams('declaredValue',
            [
                'currency' => 'USD',

        ]);
        $d = $this->getShipmentData();
        if($this->getToken()) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'X-locale' => 'en_US',
                'Content-Type' => 'application/json'
            ])->post(
                config('logistics.fedex.url').'/ship/v1/shipments',
                [
                    'mergeLabelDocOption' => 'LABELS_ONLY',
                    'labelResponseOptions' => 'LABEL',
                    'requestedShipment' => [
                        'shipper' => $this->shipper,
                        'recipients' => $this->recipients,
                        'packagingType' => $this->getPackagingType(),
                        'shippingChargesPayment' => [
                            'paymentType' => 'SENDER',
                            'payor' => [
                                'accountNumber' => $this->accountNumber()
                            ]
                        ],
                        'pickupType' => $this->getPickUpType(),
                        'serviceType' => $this->getServiceType(),
                        'totalPackageCount' => 1,
                        'shipmentSpecialServices' => $this->getShipmentSpecialServices(),
                        'requestedPackageLineItems' => $this->getRequestedPackageLineItems(),
                        'labelSpecification' => $this->getLabelSpecification()
                    ],
                    'accountNumber' => $this->accountNumber(),
                ]
//                $this->getShipmentData()
            );

            if($response->successful()) {
                $responseData = $response->json();
                $pieceResponses = $responseData['output']['transactionShipments'][0]['pieceResponses'];
                $this->trackingNumber = $pieceResponses[0]['trackingNumber'];
                $this->base64Label = $pieceResponses[0]['packageDocuments'][0]['encodedLabel'];
                $this->hasErrors = false;
                return $this;
            }else{
                $this->hasErrors = true;
                $this->errors = $response->json();
                return $this;
            }
        }

        return false;

    }

    public function getPackagingType() {
        if(in_array('FEDEX_ONE_RATE', $this->specialServices)) {
            return 'FEDEX_SMALL_BOX';
        }

        if(!$this->packagingType) return self::DEFAULT_PACKAGES_TYPE;
        return $this->packagingType;
    }

    public function getTrackingNumber() {
        return $this->trackingNumber;
    }

    public function getBase64Label() {
        return $this->base64Label;
    }

    public function trackPackage() {
        if($this->trackingNumber) {

        }
        return false;
    }

    private function setUserInfo($user) {
        return [
            'address' => [
                'streetLines' => [
                    $user->address,
                    $user->address2
                ],
                'city' => $user->city,
                'stateOrProvinceCode' => $user->state ?? $user->resolvedState->code,
                'postalCode' => $user->zip ?? $user->postal_code,
                'countryCode' => $user->country ?? 'US',
                'residential' => $user->isResidential ?? true
            ],
            'contact' => [
                'personName' => $user->first_name . ' ' . $user->last_name,
                'emailAddress' => $user->email,
                'phoneNumber' => $user->phone ?? '2679809681',
                'phoneExtension' => $user->extension,
                'companyName' => $user->company_name
            ],
        ];
    }

    public function setRecipient(Address $address) {
        $this->recipients[] = $this->setUserInfo($address);
    }

    public function setShipper($user) {
        $this->shipper =  [
            'address' => [
                'streetLines' => [
                    $user->address,
                    $user->address2
                ],
                'city' => $user->city,
                'stateOrProvinceCode' => $user->state ?? $user->resolvedState->code,
                'postalCode' => $user->postal_code ?? $user->zip,
                'countryCode' => $user->country ?? 'US',
                'residential' => $user->isResidential ?? false
            ],
            'contact' => [
                'personName' => $user->first_name . ' ' . $user->last_name,
//                'emailAddress' => $user->email,
                'phoneNumber' => $user->phone ?? '2679809681',
//                'phoneExtension' => $user->extension,
                'companyName' => $user->company_name
            ],
        ];
    }

    public function getShipmentData() {
        return [
            'mergeLabelDocOption' =>  'LABELS_ONLY', //"NONE" "LABELS_AND_DOCS" "LABELS_ONLY"
            'requestedShipment' => [
                'shipDatestamp' => $this->getShippingDate(), //Date
                'totalDeclaredValue' => [
                    'amount' => $this->getDeclaredValue(),
                    'currency' => $this->getCurrency(),
                ],
                'shipper' => $this->shipper,
                'recipients' => $this->recipients,
                //'packagingType' => self::DEFAULT_PACKAGES_TYPE,
                'serviceType' => $this->getServiceType(),
                'pickupType' => $this->getPickUpType(),
                'totalWeight' => $this->totalWeight,
                'shippingChargesPayment' => [
                    'paymentType' => 'SENDER',
                    'payor' => [
                        'accountNumber' => $this->accountNumber()
                    ]
                ],
                'labelSpecification' => $this->getLabelSpecification(),
                'shipmentSpecialServices' => $this->getShipmentSpecialServices(),
                'requestedPackageLineItems' => $this->getRequestedPackageLineItems(),
            ],

            'labelResponseOptions' => self::DEFAULT_LABEL_OPTION, //"URL_ONLY" "LABEL"
            'accountNumber' => $this->accountNumber(),
            'shipAction' => 'CONFIRM',
            'processingOptionType' => "ALLOW_ASYNCHRONOUS",
            'oneLabelAtATime' => true

        ];
    }

    protected function getRequestedPackageLineItems() {
        return [
                    [
//                        'sequenceNumber' => 1,
                        'weight' => [
                            'units' => 'LB',
                            'value' => 1
                        ],
                        'customerReferences' => $this->getInvoiceReference()
                    ]
            ];
    }

    public function setInvoiceNumber($value) {
        $this->invoiceNumber = $value;
    }

    public function getInvoiceReference() : array {
        return [
            [
                'customerReferenceType' => 'INVOICE_NUMBER',
                'value' => $this->invoiceNumber
            ]
        ];
    }

    public function setShippingDate($value) {
        $this->shippingDate = $value;
    }

    protected function getLabelSpecification() {
        return [
				'labelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY
				'imageType' => 'PNG',  // valid values DPL, EPL2, PDF, ZPLII and PNG
				//'labelStockType' => 'PAPER_4X6'
                'labelStockType' => 'PAPER_8.5X11_TOP_HALF_LABEL'
        ];
    }

    public function getShipmentSpecialServices() : array {
        return [
            'specialServiceTypes' => $this->specialServices
        ];
    }

    protected function accountNumber() {
        return ['value' => config('logistics.fedex.account')];
    }

    protected function getShippingChargesPayment() {
        return [
            'paymentType' => 'SENDER',
            'payor' => [
                'accountNumber' => $this->accountNumber()
            ]
        ];
    }

    protected function getPickUpType() {
        return $this->pickupType ?? 'DROPOFF_AT_FEDEX_LOCATION';
    }

    protected function getServiceType() {
        return $this->serviceType ?? config('logistics.fedex.serviceType');
    }

    //$label_size='PAPER_8.5X11_TOP_HALF_LABEL',$label_type='PDF',$ship_type='FEDEX_GROUND'
    public static function generateLabel($sender,$receiver,$packageOptions, $labelOptions, $shipOptions) {

        $senderDetails = array(
			'Contact' => array(
				'PersonName' => $sender->name,
				'CompanyName' => $sender->company ?? '',
				'PhoneNumber' => $sender->phone ?? ''
			),
			'Address' => array(
				'StreetLines' => $sender->streetAddress,
				'City' => $sender->city,
				'StateOrProvinceCode' => $sender->state,
				'PostalCode' => $sender->zip,
				'CountryCode' => $sender->country ?? 'US'
			)
		);

        $receiverDetails = array(
			'Contact' => array(
				'PersonName' => $receiver->name,
				'CompanyName' => $receiver->company ?? '',
				'PhoneNumber' => $receiver->phone ?? ''
			),
			'Address' => array(
				'StreetLines' => $receiver->streetAddress,
				'City' => $receiver->city,
				'StateOrProvinceCode' => $receiver->state,
				'PostalCode' => $receiver->zip,
				'CountryCode' => $receiver->country ?? 'US'
			)
		);

    }


    //FEDEX SERVICE TYPES
//    FedEx 2Day®	FEDEX_2_DAY
//FedEx 2Day® A.M.	FEDEX_2_DAY_AM
//FedEx Custom Critical Air	FEDEX_CUSTOM_CRITICAL_CHARTER_AIR
//FedEx Custom Critical Air Expedite	FEDEX_CUSTOM_CRITICAL_AIR_EXPEDITE
//FedEx Custom Critical Air Expedite Exclusive Use	FEDEX_CUSTOM_CRITICAL_AIR_EXPEDITE_EXCLUSIVE_USE
//FedEx Custom Critical Air Expedite Network	FEDEX_CUSTOM_CRITICAL_AIR_EXPEDITE_NETWORK
//FedEx Custom Critical Point To Point	FEDEX_CUSTOM_CRITICAL_POINT_TO_POINT
//FedEx Custom Critical Surface Expedite	FEDEX_CUSTOM_CRITICAL_SURFACE_EXPEDITE
//FedEx Custom Critical Surface Expedite Exclusive Use	FEDEX_CUSTOM_CRITICAL_SURFACE_EXPEDITE_EXCLUSIVE_USE
//FedEx Distance Deferred	FEDEX_DISTANCE_DEFERRED
//FedEx Europe First	EUROPE_FIRST_INTERNATIONAL_PRIORITY
//FedEx Express Saver®	FEDEX_EXPRESS_SAVER
//FedEx First Overnight®	FIRST_OVERNIGHT
//FedEx First Overnight® EH	FEDEX_FIRST_OVERNIGHT_EXTRA_HOURS
//FedEx Ground	FEDEX_GROUND
//FedEx Home Delivery®	GROUND_HOME_DELIVERY
//FedEx International Airport-to-Airport	FEDEX_CARGO_AIRPORT_TO_AIRPORT
//FedEx International Connect Plus®	FEDEX_INTERNATIONAL_CONNECT_PLUS
//FedEx International Economy	INTERNATIONAL_ECONOMY
//FedEx International Economy DirectDistributionSM	INTERNATIONAL_ECONOMY_DISTRIBUTION
//FedEx International First®	INTERNATIONAL_FIRST
//FedEx International MailService®	FEDEX_CARGO_MAIL
//FedEx International Premium™	FEDEX_CARGO_INTERNATIONAL_PREMIUM
//FedEx International Priority DirectDistribution®	INTERNATIONAL_PRIORITY_DISTRIBUTION
//FedEx International Priority® Express	FEDEX_INTERNATIONAL_PRIORITY_EXPRESS
//FedEx International Priority® (New IP Service)	FEDEX_INTERNATIONAL_PRIORITY
//FedEx International Priority Plus®	FEDEX_INTERNATIONAL_PRIORITY_PLUS
//FedEx Priority Overnight®	PRIORITY_OVERNIGHT
//FedEx Priority Overnight® EH	PRIORITY_OVERNIGHT_EXTRA_HOURS
//FedEx SameDay®	SAME_DAY
//FedEx SameDay® City	SAME_DAY_CITY
//FedEx SmartPost®	SMART_POST
//FedEx Standard Overnight® EH	FEDEX_STANDARD_OVERNIGHT_EXTRA_HOURS
//FedEx Standard Overnight®	STANDARD_OVERNIGHT
//FedEx Transborder Distribution	TRANSBORDER_DISTRIBUTION_CONSOLIDATION
//Temp-Assure Air®	FEDEX_CUSTOM_CRITICAL_TEMP_ASSURE_AIR
//Temp-Assure Validated Air®	FEDEX_CUSTOM_CRITICAL_TEMP_ASSURE_VALIDATED_AIR
//White Glove Services®	FEDEX_CUSTOM_CRITICAL_WHITE_GLOVE_SERVICES
//FedEx Regional Economy®	FEDEX_REGIONAL_ECONOMY
//FedEx Regional Economy® Freight	FEDEX_REGIONAL_ECONOMY_FREIGHT
//FedEx International Priority® (Old IP Service)	INTERNATIONAL_PRIORITY
//FedEx 1 Day Freight	FEDEX_1_DAY_FREIGHT
//FedEx 2 Day Freight	FEDEX_2_DAY_FREIGHT
//FedEx 3 Day Freight	FEDEX_3_DAY_FREIGHT
//FedEx First Overnight Freight	FIRST_OVERNIGHT_FREIGHT
//FedEx Next Day Afternoon	FEDEX_NEXT_DAY_AFTERNOON
//FedEx Next Day Morning	FEDEX_NEXT_DAY_EARLY_MORNING
//FedEx Next Day End of Day	FEDEX_NEXT_DAY_END_OF_DAY
//FedEx Next Day Mid Morning	FEDEX_NEXT_DAY_MID_MORNING
//International Economy Freight	INTERNATIONAL_ECONOMY_FREIGHT
//International Priority Freight	INTERNATIONAL_PRIORITY_FREIGHT

}
