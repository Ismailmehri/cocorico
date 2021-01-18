<?php

/*
 * This file is part of the Cocorico package.
 *
 * (c) Cocolabs SAS <contact@cocolabs.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocorico\MessageBundle\FormHandler;

use Cocorico\MessageBundle\FormModel\NewThreadMessage;
use FOS\MessageBundle\FormHandler\AbstractMessageFormHandler;
use FOS\MessageBundle\FormModel\AbstractMessage;
use FOS\MessageBundle\Model\MessageInterface;

class NewThreadMessageFormHandler extends AbstractMessageFormHandler
{

    const BASE_URL = 'http://api.smspartner.fr/v1/';

    /**
     * Composes a message from the form data
     *
     * @param AbstractMessage $message
     * @return MessageInterface the composed message ready to be sent
     * @throws \InvalidArgumentException if the message is not a NewThreadMessage
     */
    public function composeMessage(AbstractMessage $message)
    {
        if (!$message instanceof NewThreadMessage) {
            throw new \InvalidArgumentException(
                sprintf('Message must be a NewThreadMessage instance, "%s" given', get_class($message))
            );
        }

        $newThread = $this->composer->newThread()
            ->setListing($message->getListing())
            ->setSubject($message->getListing()->getTitle())
            ->addRecipient($message->getRecipient())
            ->setSender($this->getAuthenticatedParticipant())
            ->setBody($message->getBody());


            $fields = array(
                "apiKey"=>"2c97113671c894d9995f31734670feb80b183d6d",
                "phoneNumbers"=>"+21621170468",
                "message"=> "Test",
                "sender" => "Jobber"
            
            );
        // $this->sendSms($fields);
        return $newThread->getMessage();
    }

	public function sendSms($fields)
	{
		if (empty($fields))
			return false;

		$result = $this->postRequest(self::BASE_URL.'send', $fields);
		return $this->returnJson($result);
	}

	/**
	 * Requête cURL - Vous n'êtes pas sensé appeler cette méthode
	 * @access private
	 *
	 */
	private function postRequest($url, $fields = array())
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		if (!empty($fields))
		{

			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
		}

		$result = curl_exec($curl);

		if ($result === false)
		{
			if ($this->debug)
				echo curl_error($curl);
			else
				$result = curl_error($curl);
		}
		else
			curl_close($curl);
		return $result;
	}

	private function returnJson($string)
	{
		$json_array = json_decode($string);
		if (is_null($json_array))
			return $string;
		else
			return $json_array;
	}

}
