<?php

namespace App\Service;

use App\Exception\TaskException;
use App\Exception\UserException;
use App\Exception\NoteException;
use Respect\Validation\Validator as v;

/**
 * Base Service.
 */
abstract class BaseService
{
    /**
     * Validate and sanitize a username.
     *
     * @param string $name
     * @return string
     * @throws \Exception
     */
    protected static function validateName($name)
    {
        if (!v::alnum()->length(2, 100)->validate($name)) {
            throw new UserException(UserException::USER_NAME_INVALID, 400);
        }

        return $name;
    }

    /**
     * Validate and sanitize a email address.
     *
     * @param string $emailValue
     * @return string
     * @throws \Exception
     */
    protected static function validateEmail($emailValue)
    {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (!v::email()->validate($email)) {
            throw new UserException(UserException::USER_EMAIL_INVALID, 400);
        }

        return $email;
    }

    /**
     * Validate and sanitize a task name.
     *
     * @param string $name
     * @return string
     * @throws \Exception
     */
    protected static function validateTaskName($name)
    {
        if (!v::length(2, 100)->validate($name)) {
            throw new TaskException(TaskException::TASK_NAME_INVALID, 400);
        }

        return $name;
    }

    /**
     * Validate and sanitize a task status.
     *
     * @param int $status
     * @return int
     * @throws \Exception
     */
    protected static function validateStatus($status)
    {
        if (!v::numeric()->between(0, 1)->validate($status)) {
            throw new TaskException(TaskException::TASK_STATUS_INVALID, 400);
        }

        return $status;
    }

    /**
     * Validate and sanitize a note name.
     *
     * @param string $name
     * @return string
     * @throws \Exception
     */
    protected static function validateNoteName($name)
    {
        if (!v::alnum()->length(2, 50)->validate($name)) {
            throw new NoteException(NoteException::NOTE_NAME_INVALID, 400);
        }

        return $name;
    }
}
