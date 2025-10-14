<?php

namespace App\Support\Api;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ApiResponder
{
    public function ok(
        mixed $data = null,
        string $message = 'OK',
        array $meta = [],
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $this->normalizeData($data),
            'meta'    => (object) $meta,
        ], $status);
    }

    public function created(
        mixed $data = null,
        string $message = 'Created'
    ): JsonResponse {
        return $this->ok($data, $message, status: 201);
    }

    public function fail(
        string $message = 'Error',
        array $errors = [],
        int $status = 400,
        array $meta = []
    ): JsonResponse {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => (object) $errors,
            'meta'    => (object) $meta,
        ], $status);
    }

    public function paginated(
        LengthAwarePaginator $paginator,
        JsonResource|string|null $resource = null,
        string $message = 'OK',
        array $extraMeta = []
    ): JsonResponse {
        $collection = $paginator->getCollection();

        if (is_string($resource)) {
            $resource = $resource::collection($collection);
        } elseif ($resource instanceof JsonResource) {
            $resource = $resource::collection($collection);
        } else {
            // بدون Resource: رجّع البيانات كما هي
            $resource = $collection;
        }

        $meta = array_merge($this->paginationMeta($paginator), $extraMeta);

        return $this->ok($resource, $message, $meta);
    }

    public function paginationMeta(LengthAwarePaginator $p): array
    {
        return [
            'pagination' => [
                'current_page'   => $p->currentPage(),
                'per_page'       => $p->perPage(),
                'from'           => $p->firstItem(),
                'to'             => $p->lastItem(),
                'total'          => $p->total(),
                'last_page'      => $p->lastPage(),
                'has_more'       => $p->hasMorePages(),
                'next_page_url'  => $p->nextPageUrl(),
                'prev_page_url'  => $p->previousPageUrl(),
            ],
            'summary' => [
                'count' => $p->count(),
            ],
        ];
    }

    private function normalizeData(mixed $data): mixed
    {
        if ($data instanceof JsonResource) {
            return $data->toArray(request());
        }
        // JsonSerializable / Arrayable handled by response()->json
        return $data;
    }
}
