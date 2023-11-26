<?php

namespace Modules\Lens\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LensDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $cyl = [
            [
                // 'id'                 => 1,
                'cylinder'               => '0',
            ],
            [
                // 'id'                 => 1,
                'cylinder'               => '-0.25',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-0.50',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-0.75',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-1.00',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-1.25',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-1.50',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-1.75',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-2.00',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-2.25',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-2.50',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-2.75',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-3.00',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-3.25',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-3.50',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-3.75',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-4.00',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-4.25',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-4.50',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-4.75',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-5.00',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-5.25',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-5.50',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-5.75',
            ],[
                // 'id'                 => 1,
                'cylinder'               => '-6.00',
            ]
            ];
            Cylinder::insert($cyl);

        $sphf = [
            [
                // 'id'                 => 1,
                'sph_from'               => '0',
            ],
            [
                // 'id'                 => 1,
                'sph_from'               => '0.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '0.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '0.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '1.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '1.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '1.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '1.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '2.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '2.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '2.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '2.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '3.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '3.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '3.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '3.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '4.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '4.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '4.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '4.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '5.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '5.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '5.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '5.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '6.00',
            ],
            [
                // 'id'                 => 1,
                'sph_from'               => '-0.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-0.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-0.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-1.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-1.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-1.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-1.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-2.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-2.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-2.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-2.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-3.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-3.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-3.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-3.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-4.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-4.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-4.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-4.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-5.00',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-5.25',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-5.50',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-5.75',
            ],[
                // 'id'                 => 1,
                'sph_from'               => '-6.00',
            ]

            ];
            SphFrom::insert($sphf);

            $spht = [
                [
                    // 'id'                 => 1,
                    'sph_to'               => '1',
                ],
                    [
                        // 'id'                 => 1,
                        'sph_to'               => '0.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '0.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '0.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '1.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '1.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '1.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '1.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '2.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '2.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '2.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '2.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '3.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '3.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '3.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '3.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '4.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '4.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '4.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '4.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '5.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '5.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '5.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '5.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '6.00',
                    ],
                    [
                        // 'id'                 => 1,
                        'sph_to'               => '-0.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-0.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-0.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-1.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-1.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-1.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-1.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-2.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-2.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-2.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-2.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-3.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-3.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-3.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-3.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-4.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-4.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-4.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-4.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-5.00',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-5.25',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-5.50',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-5.75',
                    ],[
                        // 'id'                 => 1,
                        'sph_to'               => '-6.00',
                    ]
        
    
                ];
                SphTo::insert($spht);

                $sign = [
                    [
                        // 'id'                 => 1,
                        'signal_type'               => '-.-',

                    ],
                    [
                        // 'id'                 => 1,
                        'signal_type'               => '-.+',

                    ],
        
                    ];
                    Signaltype::insert($sign);

                    
            $diam = [
                [
                    // 'id'                 => 1,
                    'lens_diameter'               => '45',
                ],
                [
                    // 'id'                 => 1,
                    'lens_diameter'               => '50',
                ],
                [
                    // 'id'                 => 1,
                    'lens_diameter'               => '55',
                ],
                [
                    // 'id'                 => 1,
                    'lens_diameter'               => '60',
                ],
                [
                    // 'id'                 => 1,
                    'lens_diameter'               => '65',
                ],
                [
                    // 'id'                 => 1,
                    'lens_diameter'               => '70',
                ],
    
                ];
                LensDiameter::insert($diam);

    }
}
