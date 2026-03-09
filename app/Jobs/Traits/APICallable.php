<?php

namespace App\Jobs\Traits;

use App\AmazonSpClients\CatalogsApiClient;
use App\AmazonSpClients\FeesApiClient;
use App\AmazonSpClients\InboundApiClient;
use App\AmazonSpClients\PricingApiClient;
use App\AmazonSpClients\ReportsApiClient;
use Exception;

trait APICallable {

    public function setClient($client) {
        $this->client = $client;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getCatalogsClient(): CatalogsApiClient {
        if (!$this->client) {
            $this->client = new CatalogsApiClient($this->getUser());
        }
        return $this->client;
    }

    /**
     * @throws Exception
     */
    public function getFeesClient(): FeesApiClient {
        if (!$this->client) {
            $this->client = new FeesApiClient($this->getUser());
        }
        return $this->client;
    }

    /**
     * @throws Exception
     */
    public function getInboundClient(): InboundApiClient {
        if (!$this->client) {
            $this->client = new InboundApiClient($this->getUser());
        }
        return $this->client;
    }

    /**
     * @throws Exception
     */
    public function getPricingClient(): PricingApiClient {
        if (!$this->client) {
            $this->client = new PricingApiClient($this->getUser());
        }
        return $this->client;
    }

    /**
     * @throws Exception
     */
    public function getReportsClient(): ReportsApiClient {
        if (!$this->client) {
            $this->client = new ReportsApiClient($this->getUser());
        }
        return $this->client;
    }
}
