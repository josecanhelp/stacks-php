<?php

namespace Stacks;

use GuzzleHttp\Client;

class Stacks
{
    protected $client;

    public function __construct(private $url)
    {
        $this->client = new Client([
            'base_uri' => $url,
            'timeout' => 2.0,
        ]);
    }

    public function accountBalances($principal, $queryParams = ['unanchored' => false, 'untilBlock' => null])
    {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/balances", [
                            'query' => $this->cleanQueryParams($queryParams),
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    public function accountStxBalance($principal, $queryParams = ['unanchored' => null, 'untilBlock' => null])
    {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/stx", [
                            'query' => $this->cleanQueryParams($queryParams),
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    public function accountTransactions($principal, $queryParams = ['limit' => null, 'offset' => null, 'unanchored' => null, 'until_block' => null])
    {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/transactions", [
                            'query' => $this->cleanQueryParams($queryParams),
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    public function accountTransactionForSpecificTransaction($principal, $transactionId)
    {
        $response = $this->client
                        ->get("/extended/v1/address/{$principal}/{$transactionId}/with_transfers")
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    public function recentTransactions($queryParams = ['limit' => null, 'offset' => null, 'type' => null, 'unanchored' => null])
    {
        $response = $this->client
                        ->get('/extended/v1/tx', [
                            'query' => $this->cleanQueryParams($queryParams),
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    protected function cleanQueryParams($queryParams)
    {
        return array_filter($queryParams, function ($value) {
            return $value !== null;
        });
    }
}
