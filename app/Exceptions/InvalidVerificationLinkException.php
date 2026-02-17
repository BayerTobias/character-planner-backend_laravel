<?php

namespace App\Exceptions;

class InvalidVerificationLinkException extends \Exception
{
  public function __construct()
  {
    parent::__construct('Invalid verification link', 403);
  }
}