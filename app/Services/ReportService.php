<?php

namespace App\Services;

use App\Models\Product;
use App\Models\RequestItem;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ReportService
{
    public function getAccomplishedRequests($dept = "", $startDate = "", $endDate = "")
    {
        if ($dept != "") {
            $requestItems = RequestItem::whereHas('request', function (Builder $builder) use ($dept) {
                return $builder->where('dept', $dept);
            });
        } else {
            $requestItems = RequestItem::query();
        }
        if ($startDate != "") {
            $startDate = Carbon::parse($startDate)->format('m/d/Y');
            $requestItems = $requestItems->whereHas('request', function (Builder $builder) use ($startDate) {
                return $builder->where('date', '>=', $startDate);
            });
        }
        if ($endDate != "") {
            $endDate = Carbon::parse($endDate)->format('m/d/Y');
            $requestItems = $requestItems->whereHas('request', function (Builder $builder) use ($endDate) {
                return $builder->where('date', '<=', $endDate);
            });
        }
        $requestItems = $requestItems->where('status_id', status_completed_id())->get();
        return $requestItems;
    }

    public function getPendingRequests($dept = "", $startDate = "", $endDate = "")
    {
        if ($dept != "") {
            $requestItems = RequestItem::whereHas('request', function (Builder $builder) use ($dept) {
                return $builder->where('dept', $dept);
            });
        } else {
            $requestItems = RequestItem::query();
        }
        if ($startDate != "") {
            $startDate = new Carbon($startDate);
            $requestItems = $requestItems->where('created_at', '>=', $startDate);
        }
        if ($endDate != "") {
            $endDate = new Carbon($endDate);
            $requestItems = $requestItems->where('created_at', '<=', $endDate);
        }
        $requestItems = $requestItems->where('status_id', status_pending_id())->get();
        return $requestItems;
    }

    public function getLowStocks()
    {
        $products = Product::where('qty', '<', 5)->get();
        return $products;
    }
}
