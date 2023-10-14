<?php

namespace phamquanglinhdev\Laptrinhluon\Application;

use Illuminate\Http\JsonResponse;

/**
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 10/14/2023 4:03 PM
 */
class HttpResponse
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @param $message
     * @return JsonResponse
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 4:03 PM
     */
    public function unExpectedResponse($message): JsonResponse
    {
        return response()->json(['message' => $message], 500);
    }

    /**
     * @param $message
     * @return JsonResponse
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 4:03 PM
     */
    public function successResponse($message): JsonResponse
    {
        return response()->json(['message' => $message]);
    }
}
