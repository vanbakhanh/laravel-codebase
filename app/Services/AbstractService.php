<?php

namespace App\Services;

use App\Exceptions\DatabaseException;
use DB;
use Exception;
use Log;

abstract class AbstractService
{
    /**
     * Rollback database and throw exception if have error while do action.
     *
     * @param callable $callback
     * @return Response
     *
     * @throws DatabaseException
     */
    protected function transaction(callable $callback)
    {
        DB::beginTransaction();

        try {
            if (is_callable($callback)) {
                $data = call_user_func_array($callback, []);
            }

            DB::commit();

            return $data;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            throw new DatabaseException($exception->getMessage(), $exception->getCode());
        }
    }
}
