<?php

namespace App\Admin_model;

use App\Product_model\Purchase;
use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    public function offeriddata()
    {
        $maxinvoice = Purchase::max('offer_id');

        if ($maxinvoice == ''){
            $newinvoice = 1000;
        }else{
            $newinvoice = $maxinvoice +1;
        }
        return $newinvoice;
    }
}
