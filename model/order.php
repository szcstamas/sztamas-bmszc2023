<?php

class Order
{

    public $id;
    public $name;
    public $date;
    public $email;
    public $totalPrice;
    public $deliveryPostcode;
    public $deliveryCity;
    public $deliveryStreet;
    public $billPostcode;
    public $billCity;
    public $billStreet;
    public $comment;
    public $completed;
    public $completedAt;

    public function __construct(
        $id,
        $name,
        $date,
        $email,
        $totalPrice,
        $deliveryPostcode,
        $deliveryCity,
        $deliveryStreet,
        $billPostcode,
        $billCity,
        $billStreet,
        $comment,
        $completed,
        $completedAt
    ) {

        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
        $this->email = $email;
        $this->totalPrice = $totalPrice;
        $this->deliveryPostcode = $deliveryPostcode;
        $this->deliveryCity = $deliveryCity;
        $this->deliveryStreet = $deliveryStreet;
        $this->billPostcode = $billPostcode;
        $this->billCity = $billCity;
        $this->billStreet = $billStreet;
        $this->comment = $comment;
        $this->completed = $completed;
        $this->completedAt = $completedAt;
    }
}
