<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 04.03.2018
 * Time: 13:16
 */

namespace App\Services;

use DocuSign\eSign\Configuration;
use DocuSign\eSign\ApiClient;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Api\AuthenticationApi;
use DocuSign\eSign\Api\AuthenticationApi\LoginOptions;
use DocuSign\eSign\Model\TemplateRole;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions;

class DocuSign
{
    const HOST = 'https://demo.docusign.net/restapi';
    private $username;
    private $password;
    private $integrationKey;
    private $accountId;

    private $config;
    private $apiClient;

    public function __construct($username = 'nickolashapoval@gmail.com', $password = 'toha4444', $integrationKey = '5df2b09a-627c-4281-a620-ec7fdf497df4')
    {
        $this->username       = $username;
        $this->password       = $password;
        $this->integrationKey = $integrationKey;

        $this->config = new Configuration();
        $this->config->setHost(self::HOST);
    }

    private function getAuthString()
    {
        $auth = [
            'Username'      => $this->username,
            'Password'      => $this->password,
            'IntegratorKey' => $this->integrationKey
        ];

        return json_encode($auth);
    }

    public function signatureRequestFromTemplate($name, $email)
    {
        $this->config->addDefaultHeader("X-DocuSign-Authentication", $this->getAuthString());

        $apiClient = new ApiClient($this->config);

        try {
            $authenticationApi = new AuthenticationApi($apiClient);
            $options           = new LoginOptions();
            $loginInformation  = $authenticationApi->login($options);
            if (isset($loginInformation) && is_object($loginInformation) && $loginInformation) {
                $loginAccount = $loginInformation->getLoginAccounts()[0];
                $host         = $loginAccount->getBaseUrl();
                $host         = explode("/v2", $host);
                $host         = $host[0];

                $this->config->setHost($host);

                $this->apiClient = new ApiClient($this->config);

                if (isset($loginInformation)) {
                    if ($this->accountId = $loginAccount->getAccountId()) {
                        $this->signatureRequest($name, $email);
                    }
                }
            }
        } catch (DocuSign\eSign\ApiException $ex) {
            echo "Exception: " . $ex->getMessage() . "\n";
        }
    }

    private function signatureRequest($name, $email)
    {
        $envelopeApi = new EnvelopesApi($this->apiClient);

        $templateRole = new TemplateRole();

        //fucking hardcode
        $templateRole->setEmail($email);
        $templateRole->setName($name);
        $templateRole->setRoleName("Developer");

        $envelop_definition = new EnvelopeDefinition();

        //the same (fucking hardcode)
        $envelop_definition->setEmailSubject("Kodo doc sample");
        $envelop_definition->setTemplateId('70298264-c799-4c00-a81a-25222386e7db');
        $envelop_definition->setTemplateRoles(array($templateRole));

        $envelop_definition->setStatus("sent");

        $options = new CreateEnvelopeOptions();
        $options->setCdseMode(null);
        $options->setMergeRolesOnDraft(null);
        $envelop_summary = $envelopeApi->createEnvelope($this->accountId, $envelop_definition, $options);
        if (!empty($envelop_summary)) {
            echo "$envelop_summary";
        }
    }

}