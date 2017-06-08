<?php

namespace App\Contracts\Repositories;

interface UserRepository extends AbstractRepository
{
    public function getCurrentUser($userFromAuthServer);

    public function getReadingBooksByCurrentUser($select = ['*'], $with = []);

    public function getBooksReadByUser($select = ['*'], $with = []);
}
