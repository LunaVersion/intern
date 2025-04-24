<?php

declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements JsonSerializable
{
    protected $table = 'users';
    protected $fillable = ['name', 'email'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

}
