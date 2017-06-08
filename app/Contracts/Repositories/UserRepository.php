<?php

namespace App\Contracts\Repositories;

interface UserRepository extends AbstractRepository
{
    public function getCurrentUser($userFromAuthServer);

    public function getMyBookSharing($select = ['*'], $with = []);
}
