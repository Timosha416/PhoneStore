<?php

class Phone {
    private $id;
    private $brand;
    private $model;
    private $releaseYear;
    private $color;
    private $operatingSystem;
    private $price;

    public function __construct($id, $brand, $model, $releaseYear, $color, $operatingSystem, $price) {
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
        $this->releaseYear = $releaseYear;
        $this->color = $color;
        $this->operatingSystem = $operatingSystem;
        $this->price = $price;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getReleaseYear() {
        return $this->releaseYear;
    }

    public function setReleaseYear($releaseYear) {
        $this->releaseYear = $releaseYear;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getOperatingSystem() {
        return $this->operatingSystem;
    }

    public function setOperatingSystem($operatingSystem) {
        $this->operatingSystem = $operatingSystem;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}
