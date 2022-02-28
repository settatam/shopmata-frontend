<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SessionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sessions')->delete();
        
        \DB::table('sessions')->insert(array (
            0 => 
            array (
                'id' => 'nioTeIpKEvwxyIWKwbmzvkvZ2yqB5NUPwjAMV5mi',
                'user_id' => NULL,
                'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36',
                'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSk1aMGVlWjdtUjFkUDhqaWdZM3c3MkFXSDNVbVo5OElIYmNJaDRLaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9yZWdpc3RlciI7fX0=',
                'last_activity' => 1631484256,
            ),
            1 => 
            array (
                'id' => 'NzhoPPP7fJTc8OQ17m83g2bxSA2r0ocWK82Tkzn0',
                'user_id' => NULL,
                'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36',
                'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibExvUGV6TFU5N2FlaDZJRFJoSFFXSWVwS2ltaXphcWF3VktFckZtSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9yZWdpc3RlciI7fX0=',
                'last_activity' => 1631489085,
            ),
            2 => 
            array (
                'id' => 'os6C5ykQ0csIYNcxDasPydfdhW9ImNhetIsEqIdu',
                'user_id' => NULL,
                'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36',
                'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWkzalF0RWIwdHllZGRoTEFNaTB5V1hRdG5xSEZTSFU0RkxmYkVkbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9yZWdpc3RlciI7fX0=',
                'last_activity' => 1631502155,
            ),
        ));
        
        
    }
}