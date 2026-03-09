<?php

namespace App\Console\Commands;

use App\AmazonSpClients\SellersApiClient;
use Domain\Users\Models\User;
use Exception;
use Illuminate\Console\Command;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class GetAPITokens extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tokens {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command helps fetch tokens for SP-API test calls';

	/** @var User */
	protected $user;

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws ClientExceptionInterface
	 * @throws JsonException
	 * @throws Exception
	 */
    public function handle() {
		$this->user = User::query()->find($this->argument('user_id'));

        $client = new SellersApiClient($this->user);
        $sdk = $client->getSellingPartnerSDK();

        console_log('Access Token: ', $client->getAccessToken($sdk)->token()); // x-amz-access-token
    }

}
