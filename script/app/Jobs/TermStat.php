<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class TermStat implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $pd_id;
    protected $status;

    public function __construct($pd_id, $status)
    {
        $this->pd_id = $pd_id;
        $this->status = $status;
    }

    public function handle()
    {
        $product_id = $this->pd_id;
        $status = $this->status;
        $check_data = DB::table("aff_product")->get();
        $check_date = DB::table("aff_product")->where('term_id', $product_id)->orderBy('static_date', 'desc')->first();
        $date = date('Y-m-d');
        switch ($status) {
            case "views":
                if (empty($check_data)) {
                    DB::table("aff_product")->insert([
                        'term_id' => $product_id,
                        'views' => 1,
                        'static_date' => $date,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                } else {
                    if($check_date == false){
                        DB::table("aff_product")->insert([
                            'term_id' => $product_id,
                            'views' => 1,
                            'static_date' => $date,
                            'created_at' => $date,
                            'updated_at' => $date,
                        ]);
                    }else{
                        if ($check_date->static_date == $date && $check_date->term_id == $product_id) {
                            DB::table("aff_product")
                                ->where('term_id', $check_date->term_id)
                                ->where('static_date', $check_date->static_date)
                                ->update([
                                    'views' => $check_date->views + 1,
                                ]);
                        }
                        else {
                            DB::table("aff_product")->insert([
                                'term_id' => $product_id,
                                'views' => 1,
                                'static_date' => $date,
                                'created_at' => $date,
                                'updated_at' => $date,
                            ]);
                        }
                    }
                }
                break;
            case "clicks":
                break;
            default:
                echo "NOT FOUND";
        }
    }
}
