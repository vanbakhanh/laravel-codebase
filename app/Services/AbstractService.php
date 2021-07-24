<?php

namespace App\Services;

use DB;
use Exception;
use Illuminate\Database\QueryException;
use Log;

abstract class AbstractService
{
    /**
     * Rollback database and throw exception if have error while do action.
     *
     * @param callable $callback
     * @return Response
     *
     * @throws Exception
     */
    protected function transaction(callable $callback)
    {
        DB::beginTransaction();

        try {
            $data = call_user_func_array($callback, []);

            DB::commit();

            return $data;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
