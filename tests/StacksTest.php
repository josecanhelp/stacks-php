<?php

use Stacks\Stacks;

beforeEach(function () {
    $this->stacks = new Stacks('http://localhost:3999');
    $this->principal = 'ST1PQHQKV0RJXZFY1DGX8MNSNYVE3VGZJSRTPGZGM';
});

it('shows account balances for a principal', function () {
    $response = $this->stacks->accountBalances($this->principal);

    $this->assertTrue($response['stx']['balance'] > 0);
});

it('shows account STX balance for a principal', function () {
    $response = $this->stacks->accountStxBalance($this->principal);

    $this->assertTrue($response['balance'] > 0);
});

it('shows account transactions', function () {
    $response = $this->stacks->accountTransactions($this->principal);

    $this->assertTrue($response['results'] > 0);
});

it('shows account transaction information for a specific transaction', function () {
    $transactionId = $this->stacks->accountTransactions($this->principal)['results'][0]['tx_id'];
    $response = $this->stacks->accountTransactionForSpecificTransaction($this->principal, $transactionId);

    $this->assertTrue($response['tx']['tx_status'] != null);
});

it('shows account transactions with stacks transfers', function () {
    $response = $this->stacks->accountTransactionsWithStacksTransfers($this->principal);

    $this->assertTrue(count($response['results']) > 0);
});

it('shows the last nonce for an account', function () {
    $response = $this->stacks->lastNonce($this->principal);

    $this->assertTrue($response['possible_next_nonce'] > 0);
});

it('shows the account assets for a principal', function () {
    $response = $this->stacks->accountAssets($this->principal);

    $this->assertTrue(count($response['results']) > 0);
});

it('shows inbound STX transfers', function () {
    $response = $this->stacks->inboundStxTransfers($this->principal);

    $this->assertTrue(array_key_exists('results', $response));
});

it('shows all nfts owned by an address', function () {
    $response = $this->stacks->nftEvents($this->principal);

    $this->assertTrue(array_key_exists('total', $response));
    $this->assertTrue(array_key_exists('nft_events', $response));
});

it('shows account information for a principal', function () {
    $response = $this->stacks->accountInfo($this->principal);

    $this->assertTrue(array_key_exists('balance', $response));
    $this->assertTrue(array_key_exists('nonce', $response));
});

it('shows recent transactions', function () {
    $response = $this->stacks->recentTransactions(1);

    $this->assertCount(1, $response['results']);
});
