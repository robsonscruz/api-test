<?php

namespace AppBundle\Exception;

/**
 * Class Error
 * @package AppBundle\Exception
 */
class Error
{
    const AUTHENTICATION_FAILED = 'Not authenticated.';
    const NOT_ACTIVE = 'Not active.';
    const BAD_CREDENTIALS = 'Bad credentials.';
    const INVALID_PARAMETERS = 'Invalid parameters';
    const NOT_ALLOWED = 'Not allowed.';
    const BAD_REQUEST = 'Bad Request';
    const GONE = 'Gone';
    const FORBIDDEN = 'Forbidden';
    const NOT_FOUND = 'Not Found';

    const ERROR_SAVE_DATA = 'Error saving data';

    const INVALID_REPOSITORY = 'Invalid repository.';
    const INVALID_DATE = 'Invalid date';
    const INVALID_DATETIME = 'Invalid datetime';
    const INVALID_HOUR = 'Invalid hour';
    const INVALID_NUMBER = 'Invalid number';
    const INVALID_DECIMAL = 'Invalid decimal value';
    const INVALID_VALUE = 'Invalid value';
    const INVALID_SELECTED_OPTION = 'Invalid selected option';
    const INVALID_FILE_TRANSLATION = 'Invalid file translation.';

    const INVALID_PARAMETERS_EMAIL = 'Invalid parameters to send email.';

    public static function getConstants()
    {
        $errorClass = new \ReflectionClass(__CLASS__);
        return new \ArrayIterator($errorClass->getConstants());
    }
}
