<?php

namespace App\Services;

use Exception;
use Infobip\Api\SmsApi;
use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;

class SendVisitorsNotificationService
{
    public static function sendNotification()
    {
        $configuration = new Configuration(
            host: '2mvxwz.api.infobip.com',
            apiKey: 'ea3cc6929f14d408ac7eb2d630578f01-d4a2a09f-f69e-497a-a905-6c08c957c887'
        );

        $sendSmsApi = new SmsApi( $configuration);

        $message = new SmsTextualMessage(
            destinations: [
                new SmsDestination( '2348107131225')
            ],
            from: 'InfoSMS',
            text: 'This is a dummy SMS message sent using infobip-api-php-client'
        );
    
        $request = new SmsAdvancedTextualRequest( [$message]);
    // dd($request);
        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);
        } catch (ApiException $apiException) {
            return redirect()->back()->with('error', 'an error occur while sending notification');
        }catch (Exception $exception)
        {
            return redirect()->back()->with('error', 'an error occur while sending notification');
        }

    }
    public static function send()
    {
        $url = 'https://2mvxwz.api.infobip.com/sms/2/text/advanced';

        $data = array(
            'messages' => array(
                array(
                    'destinations' => array(
                        array('to' => '2348107131225')
                    ),
                    'from' => '447491163443',
                    'text' => 'Congratulations on sending your first message.\nGo ahead and check the delivery report in the next step.'
                )
            )
        );
        
        $json_data = json_encode($data);
        
        $headers = array(
            'Authorization: App ea3cc6929f14d408ac7eb2d630578f01-d4a2a09f-f69e-497a-a905-6c08c957c887',
            'Content-Type: application/json',
            'Accept: application/json'
        );
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code == 200) {
                echo $response;
            } else {
                echo 'Unexpected HTTP status: ' . $http_code;
            }
        }
        
        curl_close($ch);
        
    }
}
