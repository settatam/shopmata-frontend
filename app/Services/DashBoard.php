<?php

namespace App\Services;
use App\Helpers\Filter;
use DB;
use App\Models\TransactionHistory;

class DashBoard
{
    const BUYMYGOLD = 43;
    const SELLMYJEWELRY = 44;

    public static function summary() {
        $stores = [
            'BuyMyGold' => self::BUYMYGOLD,
            'SellMyJewelry' => self::SELLMYJEWELRY
        ];

        foreach($stores as $store => $store_id) {
            $response[$store]['kit'] = DB::select(
                "SELECT counter,val, href FROM (
                    (SELECT 'Pending Kit Request' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=0 AND store_id = $store_id) UNION
                    (SELECT 'Pending Phone Kit Request' AS counter,count(*) AS val, 'status=20' as href FROM transactions WHERE status_id=20 AND store_id = $store_id) UNION
                    (SELECT 'Kit Sent' AS counter,count(*) AS val, 'status=20' as href FROM transactions WHERE status_id=1 AND store_id = $store_id) UNION
                    (SELECT 'Kit Request Denied' AS counter,count(*) AS val, 'status=9' as href FROM transactions WHERE status_id=9 AND store_id = $store_id) UNION
                    (SELECT 'Sent Kit' AS counter,count(*) AS val, 'status=1' as href FROM transactions WHERE status_id=1 AND store_id = $store_id) UNION
                    (SELECT 'Kit Received' AS counter,count(*) AS val, 'status=2' as href FROM transactions WHERE status_id=2 AND store_id = $store_id) UNION
                    (SELECT 'Kit Received Rejected By Admin' AS counter,count(*) AS val, 'status=3' as href FROM transactions WHERE status_id=3 AND store_id = $store_id) UNION
                    (SELECT 'Offers Given' AS counter,count(*) AS val, 'status=4' as href FROM transactions WHERE status_id=4 AND store_id = $store_id) UNION
                    (SELECT 'Offers Declined' AS counter,count(*) AS val, 'tag=Declined' as href FROM transactions WHERE is_declined=1 AND store_id = $store_id) UNION
                    (SELECT 'Customer Declined Offer' AS counter,count(*) AS val, 'status=5' as href FROM transactions WHERE status_id=5 AND store_id = $store_id) UNION
                    (SELECT 'Offer 2 Given' AS counter,count(*) AS val, 'status=15' as href FROM transactions WHERE status_id=15 AND store_id = $store_id) UNION
                    (SELECT 'Return Kits' AS counter,count(*) AS val, 'status=6' as href FROM transactions WHERE status_id=6 AND store_id = $store_id) UNION
                    (SELECT 'Return kit being Processed' AS counter,count(*) AS val, 'status=6' as href FROM transactions WHERE status_id=6 AND store_id = $store_id) UNION
                    (SELECT 'Return Kit Shipped' AS counter,count(*) AS val, 'status=6' as href FROM transactions WHERE status_id=6 AND store_id = $store_id) UNION
                    (SELECT 'Offers Accepted' AS counter,count(*) AS val, 'status=24' as href FROM transactions WHERE status_id=24 AND store_id = $store_id) UNION
                    (SELECT 'Awaiting Payment' AS counter,count(*) AS val, 'status=2' as href FROM transactions WHERE status_id=2 AND store_id = $store_id) UNION
                    (SELECT 'Payments Processed' AS counter,count(*) AS val, 'status=20' as href FROM transactions WHERE status_id=20 AND store_id = $store_id)
                ) setho"
            );
        }

        foreach($stores as $store => $store_id) {
            $response[$store]['fedex'] = DB::select(
                "SELECT counter,val, href FROM (
                    (SELECT 'Fedex Outbound' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=0 AND store_id = $store_id) UNION
                    (SELECT 'Fedex Outbound Delivered' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=20 AND store_id = $store_id) UNION
                    (SELECT 'Fedex Inbound' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=1 AND store_id = $store_id) UNION
                    (SELECT 'Fedex In Bound Delivered' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=9 AND store_id = $store_id) UNION
                    (SELECT 'Printed Not Incoming' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=1 AND store_id = $store_id)
                ) setho"
            );
        }

        foreach($stores as $store => $store_id) {
            $response[$store]['import'] = DB::select(
                "SELECT counter,val, href FROM (
                    (SELECT 'Imported List - Batch or manual import' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=0 AND store_id = $store_id) UNION
                    (SELECT 'Imported List - Kit mailed' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=20 AND store_id = $store_id) UNION
                    (SELECT 'Imported List - Kits Received' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=1 AND store_id = $store_id)
                ) setho"
            );
        }

        foreach($stores as $store => $store_id) {
            $response[$store]['misc'] = DB::select(
                "SELECT counter,val, href FROM (
                    (SELECT 'Kit Request - Email' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=0 AND store_id = $store_id) UNION
                    (SELECT 'Kit Request - Download / Printed' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=20 AND store_id = $store_id) UNION
                    (SELECT 'Kits not received' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=1 AND store_id = $store_id) UNION
                    (SELECT 'High Value Kit Request' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=9 AND store_id = $store_id) UNION
                    (SELECT 'High Value Kit Sent' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=1 AND store_id = $store_id) UNION
                    (SELECT 'Refused & Return Kits' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=9 AND store_id = $store_id) UNION
                    (SELECT 'Messages' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=9 AND store_id = $store_id) UNION
                    (SELECT '14 Day' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=1 AND store_id = $store_id) UNION
                    (SELECT 'Loans' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=9 AND store_id = $store_id) UNION
                    (SELECT 'Payments rejected / returned' AS counter,count(*) AS val, 'status=0' as href FROM transactions WHERE status_id=9 AND store_id = $store_id)
                ) setho"
            );
        }

        return $response;

    }

    public static function reportSummary($filters)
    {
        $dates = Filter::dates($filters);
        $dateValues = " BETWEEN '{$dates['from']}' AND '{$dates['to']}'";
        $stores = Filter::stores($filters, true);
        if($stores) {
            $storeAddon = " AND t.store_id IN ($stores)";
        }

        $sql = "SELECT counter,val FROM (
			(SELECT 'kits_accepted' AS counter,count(*) AS val FROM transactions t INNER JOIN transaction_histories h ON t.id = h.transaction_id WHERE  h.event = '" . TransactionHistory::SHIPMENT_RECEIVED . "' AND h.created_at {$dateValues} {$storeAddon}) UNION
			(SELECT 'kits_sent' AS counter,count(*) AS val FROM transactions t WHERE status_id > 0 AND t.created_at {$dateValues} {$storeAddon} ) UNION
			(SELECT 'kits_declined' AS counter,count(*) AS val FROM transactions t INNER JOIN transaction_histories h ON t.id = h.transaction_id WHERE h.event = '" . TransactionHistory::KIT_DENIED . "' AND h.event != '" . TransactionHistory::OFFER_ACCEPTED . "' AND h.created_at {$dateValues} {$storeAddon}) UNION
			(SELECT 'offer_accepted' AS counter,round(sum(i.price),2) AS val FROM transactions t INNER JOIN transaction_histories h ON t.id = h.transaction_id INNER JOIN transaction_items i ON t.id = i.transaction_id WHERE  h.event = '" . TransactionHistory::OFFER_ACCEPTED . "' AND h.created_at {$dateValues} {$storeAddon}) UNION
			(SELECT 'kits_rejected' AS counter,count(*) AS val FROM transactions t INNER JOIN transaction_histories h ON t.id = h.transaction_id WHERE  h.event = '" . TransactionHistory::SHIPMENT_DECLINED . "' AND h.created_at {$dateValues} {$storeAddon}) UNION
			(SELECT 'kits_not_received' AS counter,count(*) AS val FROM transactions t WHERE status_id = 0 AND t.created_at {$dateValues} {$storeAddon}) UNION

			) uxmegallc";

        return DB::select($sql);
    }

}

