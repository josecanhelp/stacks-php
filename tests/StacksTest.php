<?php

use Stacks\Stacks;

beforeEach(function () {
    $this->stacks = new Stacks('http://localhost:3999');
    $this->principal = 'ST1PQHQKV0RJXZFY1DGX8MNSNYVE3VGZJSRTPGZGM';
});

it('can retrieve recent transactions', function () {
    $response = $this->stacks->recentTransactions(['limit' => 1]);

    $this->assertCount(1, $response['results']);
});

it('can retrieve account balances for a principal', function () {
    $response = $this->stacks->accountBalances($this->principal);

    $this->assertTrue($response['stx']['balance'] > 0);
});

it('can retrieve account STX balance for a principal', function () {
    $response = $this->stacks->accountStxBalance($this->principal);

    $this->assertTrue($response['balance'] > 0);
});

it('can retrieve account transactions', function () {
    $response = $this->stacks->accountTransactions($this->principal);

    $this->assertTrue($response['results'] > 0);
});

it('can retrieve account transaction information for a specific transaction', function () {
    $transactionId = $this->stacks->accountTransactions($this->principal)['results'][0]['tx_id'];
    $response = $this->stacks->accountTransactionForSpecificTransaction($this->principal, $transactionId);

    $this->assertTrue($response['tx']['tx_status'] != null);
});
