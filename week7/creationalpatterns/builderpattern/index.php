<?php
class Car {
    private string $brand;
    private string $color;
    private int $seats;
    private bool $hasGPS;

    private function __construct(CarBuilder $builder) {
        $this->brand = $builder->getBrand();
        $this->color = $builder->getColor();
        $this->seats = $builder->getSeats();
        $this->hasGPS = $builder->hasGPS();
    }

    public static function builder(): CarBuilder {
        return new CarBuilder();
    }

    public function getInfo(): string {
        return "{$this->brand}, {$this->color}, Seats: {$this->seats}, GPS: " . ($this->hasGPS ? "Yes" : "No");
    }
}

class CarBuilder {
    private string $brand = "Unknown";
    private string $color = "White";
    private int $seats = 4;
    private bool $hasGPS = false;

    public function setBrand(string $brand): self {
        $this->brand = $brand;
        return $this;
    }

    public function setColor(string $color): self {
        $this->color = $color;
        return $this;
    }

    public function setSeats(int $seats): self {
        $this->seats = $seats;
        return $this;
    }

    public function addGPS(): self {
        $this->hasGPS = true;
        return $this;
    }

    public function build(): Car {
        return new Car($this);
    }

    public function getBrand(): string { return $this->brand; }
    public function getColor(): string { return $this->color; }
    public function getSeats(): int { return $this->seats; }
    public function hasGPS(): bool { return $this->hasGPS; }
}

$car = Car::builder()
    ->setBrand("Toyota")
    ->setColor("Red")
    ->setSeats(5)
    ->addGPS()
    ->build();

echo $car->getInfo();

