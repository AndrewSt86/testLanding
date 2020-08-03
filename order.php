<?php
     $order = array ();
     foreach ($_POST as $key => $value) {
           if ($value != '') {
                $order[$key] = $value;
            }
      }
      // Define ip
      if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
          $ip =  $_SERVER['HTTP_CF_CONNECTING_IP'];
      }  elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
         $ip =  $_SERVER['HTTP_X_REAL_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip =  $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
          $ip =  $_SERVER['REMOTE_ADDR'];
      }

      $order['ip'] = $ip;

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, "https://tracker.everad.com/conversion/new" );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt($ch, CURLOPT_POST,           1 );
      curl_setopt($ch, CURLOPT_POSTFIELDS,     http_build_query($order) );
      curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/x-www-form-urlencoded'));

      $result = curl_exec ($ch);

      if ($result === 0) {
          echo "Timeout! Everad CPA API didn't respond within default period!";
      } else {
          $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          if ($httpCode === 400) {
                echo "Order data is invalid! Order is not accepted!";
          } else if ($httpCode !== 200) {
                echo "Unknown error happened! Order is not accepted! Check campaign_id, probably no landing exists for your campaign!";
          }

      }

?> 
