<?php

namespace App\Actions;

use AmazonSellingPartner\Exception\ApiException;
use AmazonSellingPartner\Exception\InvalidArgumentException;
use AmazonSellingPartner\Model\Sellers\Participation;
use App\AmazonSpClients\SellersApiClient;
use App\Models\Connections\Connection;
use App\Models\Connections\SpToken;
use App\Models\Marketplace;
use Carbon\Carbon;
use Exception;
use Psr\Http\Client\ClientExceptionInterface;

class RegisterProfilesAction extends BaseAction {

    /**
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException
     * @throws ApiException
     * @throws Exception
     */
    public function handle(Connection $connection = null) {
        $connection = $connection ?: $this->user->connection;

        $client = new SellersApiClient($this->user, $connection->refresh_token);
        $response = $client->getAccessToken($client->getSellingPartnerSDK());

        /** @var Participation $participations */
        foreach ($client->listParticipations() as $participation) {
            /** @var Marketplace $marketplace */
            $marketplace = Marketplace::getById($participation->getMarketplace()->getId());
            if (!$marketplace) {
                continue;
            }

            console_log('Account: ' . $marketplace->code . ' | ' . env('SP_SELLER_ID'));

            $account = $this->user->registerSeller($marketplace, env('SP_SELLER_ID'));

            SpToken::query()->updateOrCreate([
                'user_id' => $account->id
            ], [
                'access_token'    => $response->token(),
                'refresh_token'   => $response->refreshToken(),
                'token_type'      => $response->type(),
                'expires_at'      => Carbon::now()->addSeconds(3000), // deliberately kept 600 secs less
                'last_updated_at' => Carbon::now()
            ]);
        }
    }

}
