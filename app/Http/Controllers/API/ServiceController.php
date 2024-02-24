<?php

namespace App\Http\Controllers\API;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $types = $request->input('types');

        if ($id) {
            $service = Service::find($id);

            if ($service)
                return ResponseFormatter::success(
                    $service,
                    'Data layanan berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data layanan tidak ada',
                    404
                );
        }

        $service = Service::query();

        if ($name)
            $service->where('name', 'like', '%' . $name . '%');

        if ($types)
            $service->where('types', 'like', '%' . $types . '%');

        return ResponseFormatter::success(
            $food->paginate($limit),
            'Data list layanan berhasil diambil'
        );
    }
}
