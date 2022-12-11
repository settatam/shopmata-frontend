<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionWarehouse extends Model
{
  use HasFactory;

  protected $table = 'transactions_warehouse';

  static $accepted_date_times = [
    'payment_date_time',
    'offer_accepted_date_time',
    'sold_date_time',
    'melt_date_time'
  ];

  static $rejected_date_times = [
    'returned_date_time',
    'offer_declined_date_time',
    'received_rejected_date_time',
    'customer_declined_date_time',
    'offer_declined_send_back_date_time'
  ];

  protected $fillable = [
    'id',
    'transaction_id',
    'bought',
    'estimated_value',
    'status',
    'customer_since',
    'keywords',
    'lead',
    'website',
    'tags',
    'outgoing_tracking',
    'return_tracking',
    'first_name',
    'last_name',
    'ip_address',
    'phone',
    'email',
    'street_address',
    'suite_apt',
    'city',
    'state',
    'zip',
    'gender' ,
    'behavior',
    'customer_id',
    'dob',
    'days_in_stock',
    'profit_percent',
    'estimated_profit',
    'payment_type',
    'total_dwt',
    'inotes',
    'cnotes',
    'check_name',
    'check_address',
    'check_city',
    'check_zip',
    'check_state',
    'paypal_address',
    'paypal_type',
    'account_type',
    'routing_number',
    'account_number',
    'user_comment',
    'incoming_tracking',
    'source',
    'payment_date_time',
    'offer_declined_date_time',
    'offer_given_date_time',
    'offer_accepted_date_time',
    'kit_sent_date_time',
    'received_date_time',
    'pending_kit_returned_date_time',
    'received_rejected_date_time',
    'created_at',
    'store_id',
    'bank_name',
    'status_id',
    'store',
    'is_repeat_customer',
    'number_of_items',
    'deleted_at',
    'final_offer',
    'is_accepted',
    'is_rejected',
    'is_declined',
    'pending_kit_on_hold_date_time',
    'pending_kit_confirmed_date_time',
    'profit',
    'sold_date_time',
    'refused_by_fedex_date_time',
    'on_hold_date_time',
    'kit_request_date_time',
    'returned_date_time',
    'melt_date_time',
    'customer_declined_date_time',
    'offer_declined_send_back_date_time',
    'latest_incoming_sms_date',
    'latest_incoming_sms_id',
    'latest_incoming_sms_is_read',
    'color',
    'timezone_id'
  ];
}
