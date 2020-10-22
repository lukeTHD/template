<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Commission\CommissionInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionController extends Controller
{

    protected $commissionRepository;

    public function __construct(CommissionInterface $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }

    public function index($sso_id = null)
    {
//        $this->commissionRepository;

        if ($sso_id) {
            return response()->json([
                "ETI" => [
                    "sso_id" => "979494098",
                    "total_amount" => "5.55",
                    "children" => [
                        [
                            "ETI" => [
                                "sso_id" => "597061289",
                                "total_amount" => "16.68"
                            ],
                            "EPO" => [
                                "sso_id" => "597061289",
                                "total_amount" => "25.01"
                            ],
                            "EUSDT" => [
                                "sso_id" => "597061289",
                                "total_amount" => "41.69"
                            ]
                        ]
                    ]
                ],
                "EPO" => [
                    "sso_id" => "979494098",
                    "total_amount" => "8.33",
                    "children" => [
                        [
                            "ETI" => [
                                "sso_id" => "597061289",
                                "total_amount" => "16.68"
                            ],
                            "EPO" => [
                                "sso_id" => "597061289",
                                "total_amount" => "25.01"
                            ],
                            "EUSDT" => [
                                "sso_id" => "597061289",
                                "total_amount" => "41.69"
                            ]
                        ]
                    ]
                ],
                "EUSDT" => [
                    "sso_id" => "979494098",
                    "total_amount" => "13.88",
                    "children" => [
                        [
                            "ETI" => [
                                "sso_id" => "597061289",
                                "total_amount" => "16.68"
                            ],
                            "EPO" => [
                                "sso_id" => "597061289",
                                "total_amount" => "25.01"
                            ],
                            "EUSDT" => [
                                "sso_id" => "597061289",
                                "total_amount" => "41.69"
                            ]
                        ]
                    ]
                ]
            ]);
            return response()->json($this->commissionRepository->listCommissionsSsoId($sso_id));
        } else {
            return response()->json([
                [
                    "id" => 24,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "979494098",
                    "currency" => "ETI",
                    "lottery_id" => 45,
                    "amount" => "0.50",
                    "percent" => 2.5
                ],
                [
                    "id" => 23,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "979494098",
                    "currency" => "EPO",
                    "lottery_id" => 45,
                    "amount" => "0.75",
                    "percent" => 2.5
                ],
                [
                    "id" => 22,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "979494098",
                    "currency" => "EUSDT",
                    "lottery_id" => 45,
                    "amount" => "1.25",
                    "percent" => 2.5
                ],
                [
                    "id" => 21,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "597061289",
                    "currency" => "ETI",
                    "lottery_id" => 45,
                    "amount" => "1.51",
                    "percent" => 7.5
                ],
                [
                    "id" => 20,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "597061289",
                    "currency" => "EPO",
                    "lottery_id" => 45,
                    "amount" => "2.26",
                    "percent" => 7.5
                ],
                [
                    "id" => 19,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "597061289",
                    "currency" => "EUSDT",
                    "lottery_id" => 45,
                    "amount" => "3.77",
                    "percent" => 7.5
                ],
                [
                    "id" => 18,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "979494098",
                    "currency" => "ETI",
                    "lottery_id" => 44,
                    "amount" => "5.00",
                    "percent" => 2.5
                ],
                [
                    "id" => 17,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "979494098",
                    "currency" => "EPO",
                    "lottery_id" => 44,
                    "amount" => "7.50",
                    "percent" => 2.5
                ],
                [
                    "id" => 16,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "979494098",
                    "currency" => "EUSDT",
                    "lottery_id" => 44,
                    "amount" => "12.50",
                    "percent" => 2.5
                ],
                [
                    "id" => 15,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "597061289",
                    "currency" => "ETI",
                    "lottery_id" => 44,
                    "amount" => "15.01",
                    "percent" => 7.5
                ],
                [
                    "id" => 14,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "597061289",
                    "currency" => "EPO",
                    "lottery_id" => 44,
                    "amount" => "22.51",
                    "percent" => 7.5
                ],
                [
                    "id" => 13,
                    "from_sso_id" => "148996097",
                    "to_sso_id" => "597061289",
                    "currency" => "EUSDT",
                    "lottery_id" => 44,
                    "amount" => "37.52",
                    "percent" => 7.5
                ]
            ]);
            return response()->json($this->commissionRepository->listCommissionsApi());
        }
    }
}
