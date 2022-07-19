<?php

namespace App\Services;

use App\Models\Product;
use App\Models\RequestItem;
use Illuminate\Database\Eloquent\Builder;

class ReportService {
    public function getAccomplishedRequests($dept = "")
    {
        if($dept != "") {
            $requestItems = RequestItem::whereHas('request', function(Builder $builder) use ($dept) {
                return $builder->where('dept', $dept);
            });
        } else {
            $requestItems = RequestItem::query();
        }
        $requestItems = $requestItems->where('status_id', status_completed_id())->get();
        return $requestItems;
    }

    public function getPendingRequests($dept = "") {
        if($dept != "") {
            $requestItems = RequestItem::whereHas('request', function(Builder $builder) use ($dept) {
                return $builder->where('dept', $dept);
            });
        } else {
            $requestItems = RequestItem::query();
        }
        $requestItems = $requestItems->where('status_id', status_pending_id())->get();
        return $requestItems;
    }

    public function getLowStocks() {
        $products = Product::where('qty', 0)->get();
        return $products;
    }
}
