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

    /**
     * Get account balances
     *
     * @link https://docs.hiro.so/api#operation/get_account_balance
     *
     * @param string $principal
     * @param bool $unanchored Include transaction data from unanchored (i.e. unconfirmed) microblocks
     * @param string $untilBlock Returned data representing the state up until that point in time, rather than the current block.
     * @return void
     */
    public function accountBalances(
        $principal,
        $unanchored = false,
        $untilBlock = null
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/balances", [
                            'query' => [
                                'unanchored' => $unanchored,
                                'until_block' => $untilBlock,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get account STX balance
     *
     * @link https://docs.hiro.so/api#operation/get_account_stx_balance
     *
     * @param string $principal
     * @param bool $unanchored Include transaction data from unanchored (i.e. unconfirmed) microblocks
     * @param string $untilBlock Returned data representing the state up until that point in time, rather than the current block.
     * @return void
     */
    public function accountStxBalance(
        $principal,
        $unanchored = false,
        $untilBlock = null
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/stx", [
                            'query' => [
                                'unanchored' => $unanchored,
                                'until_block' => $untilBlock,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get account transactions
     *
     * @link https://docs.hiro.so/api#operation/get_account_transactions
     *
     * @param string $principal
     * @param bool $unanchored Include transaction data from unanchored (i.e. unconfirmed) microblocks
     * @param string $untilBlock Returned data representing the state up until that point in time, rather than the current block.
     * @param int $limit
     * @param int $offset
     * @param int $height
     * @return void
     */
    public function accountTransactions(
        $principal,
        $unanchored = false,
        $untilBlock = null,
        $limit = null,
        $offset = null,
        $height = null,
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/transactions", [
                            'query' => [
                                'unanchored' => $unanchored,
                                'until_block' => $untilBlock,
                                'limit' => $limit,
                                'offset' => $offset,
                                'height' => $height,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get account transaction information for a specific transaction
     *
     * @link https://docs.hiro.so/api#operation/get_single_transaction_with_transfers
     *
     * @param string $principal
     * @param string $transactionId
     * @return void
     */
    public function accountTransactionForSpecificTransaction(
        $principal,
        $transactionId
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/{$transactionId}/with_transfers")
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Retrieve all transactions for an account or contract identifier including STX transfers for each transaction.
     *
     * @param string $principal
     * @param bool $unanchored
     * @param string $untilBlock
     * @param int $limit
     * @param int $offset
     * @param int $height
     * @return void
     */
    public function accountTransactionsWithStacksTransfers(
        $principal,
        $unanchored = false,
        $untilBlock = null,
        $limit = null,
        $offset = null,
        $height = null,
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/transactions_with_transfers", [
                            'query' => [
                                'unanchored' => $unanchored,
                                'until_block' => $untilBlock,
                                'limit' => $limit,
                                'offset' => $offset,
                                'height' => $height,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get recent transactions
     *
     * @link https://docs.hiro.so/api#operation/get_transaction_list
     *
     * @param int $limit
     * @param int $offset
     * @param array<string> $type
     * @param bool $unanchored Include transaction data from unanchored (i.e. unconfirmed) microblocks
     * @return void
     */
    public function recentTransactions(
        $limit = null,
        $offset = null,
        $type = null,
        $unanchored = null
    ) {
        $response = $this->client
                        ->get('extended/v1/tx', [
                            'query' => [
                                'limit' => $limit,
                                'offset' => $offset,
                                'type' => $type,
                                'unanchored' => $unanchored,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get the latest nonce used by an account
     *
     * @link https://docs.hiro.so/api#operation/get_account_nonces
     *
     * @param string $principal
     * @param int $block_height
     * @param string $block_hash
     * @return void
     */
    public function lastNonce(
        $principal,
        $block_height = null,
        $block_hash = null,
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/nonces", [
                            'query' => [
                                'block_height' => $block_height,
                                'block_hash' => $block_hash,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get account assets
     *
     * @link https://docs.hiro.so/api#operation/get_account_assets
     *
     * @param string $principal
     * @param bool $unanchored
     * @param string $untilBlock
     * @param int $limit
     * @param int $offset
     * @return void
     */
    public function accountAssets(
        $principal,
        $unanchored = false,
        $untilBlock = null,
        $limit = null,
        $offset = null,
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/assets", [
                            'query' => [
                                'unanchored' => $unanchored,
                                'until_block' => $untilBlock,
                                'limit' => $limit,
                                'offset' => $offset,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get inbound STX transfers
     *
     * @link https://docs.hiro.so/api#operation/get_account_inbound
     *
     * @param string $principal
     * @param bool $unanchored
     * @param string $untilBlock
     * @param int $limit
     * @param int $offset
     * @param string $height
     * @return void
     */
    public function inboundStxTransfers(
        $principal,
        $unanchored = false,
        $untilBlock = null,
        $limit = null,
        $offset = null,
        $height = null,
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/stx_inbound", [
                            'query' => [
                                'unanchored' => $unanchored,
                                'until_block' => $untilBlock,
                                'limit' => $limit,
                                'offset' => $offset,
                                'height' => $height,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get nft events
     *
     * @link https://docs.hiro.so/api#operation/get_account_nft
     *
     * @param string $principal
     * @param bool $unanchored
     * @param string $untilBlock
     * @param int $limit
     * @param int $offset
     * @return void
     */
    public function nftEvents(
        $principal,
        $unanchored = false,
        $untilBlock = null,
        $limit = null,
        $offset = null,
    ) {
        $response = $this->client
                        ->get("extended/v1/address/{$principal}/nft_events", [
                            'query' => [
                                'unanchored' => $unanchored,
                                'until_block' => $untilBlock,
                                'limit' => $limit,
                                'offset' => $offset,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get account info
     *
     * @link https://docs.hiro.so/api#operation/get_account_info
     *
     * @param string $principal
     * @param int $proof
     * @param string $tip
     * @return void
     */
    public function accountInfo(
        $principal,
        $proof = null,
        $tip = null,
    ) {
        $response = $this->client
                        ->get("v2/accounts/{$principal}", [
                            'query' => [
                                'proof' => $proof,
                                'tip' => $tip,
                            ],
                        ])
                        ->getBody()
                        ->getContents();

        return json_decode($response, true);
    }
}
