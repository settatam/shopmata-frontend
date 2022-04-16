<?php

namespace App\Services\Logistics;

class Fedex
{
    protected $mergeLabelDocOption;
    protected $recipients = [];

    public function verifyAddress() {

    }

    public function setRecipient($receiver) {
        $this->recipients[] = [
            'address' => [
                'streetLines' => $receiver->streetAddress,
                'city' => $receiver->city,
                'stateOrProvinceCode' => $receiver->state,
                'postalCode' => $receiver->postalCode,
                'countryCode' => $receiver->country ?? 'US',
                'residential' => $receiver->isResidential ?? false
            ],
            'contact' => [
                'personName' => $receiver->name,
                'emailAddress' => $receiver->email,
                'phoneNumber' => $receiver->phone,
                'phoneExtension' => $receiver->extension ?? '',
                'companyName' => $receiver->company ?? ''
            ],
        ];
    }

    private function requestData() {
        return [
            'mergeLabelDocOption' =>  '', //"NONE" "LABELS_AND_DOCS" "LABELS_ONLY"
            'requestedShipment' => [
                'shipDatestamp' => '', //Date
                'totalDeclaredValue' => [
                    'amount' => $this->getDeclaredValue(),
                    'currency' => $this->getCurrency(),
                ],
                'shipper' => [
                    'address' => [
                        'streetLines' => $this->getSenderFullStreetAddress(),
                        'city' => $this->getSenderCity(),
                        'stateOrProvinceCode' => $this->getSenderState(),
                        'postalCode' => $this->getSenderpostalCode(),
                        'countryCode' => $this->getSenderCountryCode(),
                        'residential' => $this->isSenderResidential()
                    ],
                    'contact' => [
                        'personName' => $this->getSenderName(),
                        'emailAddress' => $this->getSenderEmail(),
                        'phoneNumber' => '',
                        'phoneExtension' => '',
                        'companyName' => ''
                    ],
                    'tins' => [
                        [
                            'number' => '',
                            'tinType' => '', //"PERSONAL_NATIONAL" "PERSONAL_STATE" "FEDERAL" "BUSINESS_NATIONAL" "BUSINESS_STATE" "BUSINESS_UNION"
                            'usage' => '',
                            'effectiveDate' => '',
                            'expirationDate' => ''
                        ],
                    ],
                ],

            ],
            'labelResponseOptions' => '', //"URL_ONLY" "LABEL"
            'soldTo' => [
                'address' => [
                        'streetLines' => $this->getFullStreetAddress(),
                        'city' => $this->getCity(),
                        'stateOrProvinceCode' => $this->getState(),
                        'postalCode' => $this->postalCode(),
                        'countryCode' => $this->getCountryCode(),
                        'residential' => $this->isResidential()
                    ],
                    'contact' => [
                        'personName' => $this->getContactName(),
                        'emailAddress' => $this->getEmail(),
                        'phoneNumber' => '',
                        'phoneExtension' => '',
                        'companyName' => ''
                    ],
                    'tins' => [
                        [
                            'number' => '',
                            'tinType' => '', //"PERSONAL_NATIONAL" "PERSONAL_STATE" "FEDERAL" "BUSINESS_NATIONAL" "BUSINESS_STATE" "BUSINESS_UNION"
                            'usage' => '',
                            'effectiveDate' => '',
                            'expirationDate' => ''
                        ],
                    ]
            ],
            'recipients' => [
                [
                    'address' => [
                        'streetLines' => $this->getFullStreetAddress(),
                        'city' => $this->getCity(),
                        'stateOrProvinceCode' => $this->getState(),
                        'postalCode' => $this->postalCode(),
                        'countryCode' => $this->getCountryCode(),
                        'residential' => $this->isResidential()
                    ],
                    'contact' => [
                        'personName' => $this->getContactName(),
                        'emailAddress' => $this->getEmail(),
                        'phoneNumber' => '',
                        'phoneExtension' => '',
                        'companyName' => ''
                    ],
                    'tins' => [
                        [
                            'number' => '',
                            'tinType' => '', //"PERSONAL_NATIONAL" "PERSONAL_STATE" "FEDERAL" "BUSINESS_NATIONAL" "BUSINESS_STATE" "BUSINESS_UNION"
                            'usage' => '',
                            'effectiveDate' => '',
                            'expirationDate' => ''
                        ],
                    ],
                    'deliveryInstructions' => ''

                ],
                'pickupType' => 'DROPOFF_AT_FEDEX_LOCATION' //CONTACT_FEDEX_TO_SCHEDULE, DROPOFF_AT_FEDEX_LOCATION, 	USE_SCHEDULED_PICKUP, ON_CALL, TAG, PACKAGE_RETURN_PROGRAM, REGULAR_STOP
                'serviceType' => '',
            ]
        ];
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

    public function trackPackage() {

    }

    //FEDEX SERVICE TYPES
    FedEx 2Day®	FEDEX_2_DAY
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
