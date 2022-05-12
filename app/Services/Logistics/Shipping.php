<?php

namespace App\Services\Logistics;

class Shipping
{
    const SHIPPING_TYPE_FROM = 'from';
    const SHIPPING_TYPE_TO = 'to';

    protected $senderName;
    protected $senderCompany;
    protected $senderStreetAddress;
    protected $senderStreetAddress2;
    protected $senderCity;
    protected $senderPostalCode;
    protected $senderState;
    protected $senderCountry;
    protected $senderEmail;
    protected $senderPhone;
    protected $receiverName;
    protected $receiverEmail;
    protected $receiverPhone;
    protected $receiverCompany;
    protected $receiverStreetAddress;
    protected $receiverStreetAddress2;
    protected $receiverCity;
    protected $receiverState;
    protected $receiverPostalCode;
    protected $receiverCountry;
    protected $declaredValue;
    protected $currency;
    protected $totalWeight;
    protected $isTest = false;
    protected $hasErrors = false;

    public function setSenderName($value) {
        $this->senderName = $value;
    }

    public function getSenderName() {
        return $this->senderName;
    }

    public function setSenderCompany($value) {
        $this->senderCompany = $value;
    }

    public function getSenderCompany() {
        return $this->senderCompany;
    }

    public function setSenderStreetAddress($value) {
        $this->senderStreetAddress = $value;
    }

    public function getSenderAddress() {
        return $this->senderStreetAddress;
    }

    public function setSenderStreetAddress2($value) {
        $this->senderStreetAddress = $value;
    }

    public function getSenderAddress2() {
        return $this->senderStreetAddress2;
    }

    public function getSenderFullStreetAddress() {
        return $this->getSenderAddress() . ' ' . $this->getSenderAddress2();
    }

    public function setSenderCity($value) {
        $this->senderCity = $value;
    }

    public function getSenderCity() {
        return $this->senderCity;
    }

    public function setSenderState($value) {
        $this->senderState = $value;
    }

    public function getSenderState() {
        return $this->senderState;
    }

    public function setSenderPostalCode($value) {
        $this->senderPostalCode = $value;
    }

    public function getSenderPostalCode() {
        return $this->senderPostalCode;
    }

    public function setSenderEmail($value) {
        $this->senderEmail = $value;
    }

    public function getSenderEmail() {
        return $this->senderEmail;
    }

    public function setSenderPhone($value) {
        $this->senderPhone = $value;
    }

    public function getSenderPhone() {
        return $this->senderPhone;
    }

    public function setReceiverName($value) {
        $this->receiverName = $value;
    }

    public function getReceiverName() {
        return $this->receiverName;
    }

    public function setReceiverCompany($value) {
        $this->receiverCompany = $value;
    }

    public function getReceiverCompany() {
        return $this->receiverCompany;
    }

    public function setReceiverStreetAddress($value) {
        $this->receiverStreetAddress = $value;
    }

    public function getReceiverAddress() {
        return $this->receiverStreetAddress;
    }

    public function setReceiverStreetAddress2($value) {
        $this->receiverStreetAddress = $value;
    }

    public function getReceiverAddress2() {
        return $this->receiverStreetAddress2;
    }

    public function getReceiverFullStreetAddress() {
        return $this->getReceiverAddress() . ' ' . $this->getReceiverAddress2();
    }

    public function setReceiverCity($value) {
        $this->receiverCity = $value;
    }

    public function getReceiverCity() {
        return $this->receiverCity;
    }

    public function setReceiverState($value) {
        $this->senderReceiver = $value;
    }

    public function getReceiverState() {
        return $this->receiverState;
    }

    public function setReceiverPostalCode($value) {
        $this->senderReceiverCode = $value;
    }

    public function getReceiverPostalCode() {
        return $this->receiverPostalCode;
    }

    public function setReceiverEmail($value) {
        $this->receiverEmail = $value;
    }

    public function getReceiverEmail() {
        return $this->receiverEmail;
    }

    public function setReceiverPhone($value) {
        $this->receiverPhone = $value;
    }

    public function getReceiverPhone() {
        return $this->receiverPhone;
    }

    public function setDeclaredValue($value) {
        $this->declaredValue = $value;
    }

    public function getDeclaredValue() {
        return $this->declaredValue;
    }

     public function setTotalWeight($value) {
        $this->totalWeight = $value;
    }

    public function getTotalWeight() {
        return $this->totalWeight;
    }

    public function setParams($field, $value) {
        $this->{$field} = $value;
    }

    public function getParams($field) {
        return $this->{$field} ?? '';
    }

    public function getCurrency() {
        return 'USD';
    }

    public function hasErrors() {
        return $this->hasErrors;
    }

}
