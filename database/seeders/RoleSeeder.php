<?php

namespace Database\Seeders;


use App\Models\Ability;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories  =
        [
            'employees',
            'vendors',
            'brands',
            'models',
            'categories',
            'colors',
            'cars',
            'roles',
            'tags',
            'contact_us',
            'banks',
            'Financing_companies',
            'cities',
            'careers',
            'news',
            'branches',
            'faq',
            'settings',
            'offers',
            'orders',
            'reports',
            'news_subscribers',
            'slider_dashboard',
            'recycle_bin',
            'features',
            'packages',
            'delegates',
            'finance_approvals',
            'order_received',
            'Distribution_of_Orders'
        ];

        $actions =
        [
            'view',
            'show',
            'create',
            'update',
            'delete',
        ];

        // indices of unused actions from the above array
        $exceptions = [
            'contact_us'            => [ 'unused_actions' => [ 1,2,4 ]       , 'extra_actions' => []          ],
            'reports'               => [ 'unused_actions' => [ 1,2,3,4 ]                                      ],
            'news_subscribers'      => [ 'unused_actions' => [ 1,2,3 ]                                        ],
            'slider_dashboard'      => [ 'unused_actions' => [ 1,2,3,4 ]                                      ],
            'recycle_bin'           => [ 'unused_actions' => [ 1,2,3 ]       , 'extra_actions' => ['restore'] ],
            'Distribution_of_Orders'=> [ 'unused_actions' => [ 0,1,2,4 ]                                        ],
            'order_received'        => [ 'unused_actions' => [ 0,1,2,3,4 ] ,              'extra_actions' => ['received']                          ],
        ];


        foreach ($categories as $category)
        {
            $usedActions = array_merge( $actions , $exceptions[ $category]['extra_actions'] ?? [] );

            foreach ( $exceptions[ $category]['unused_actions'] ?? [] as $index ) // remove the unused actions
                unset( $usedActions[$index]);


            foreach ( array_values($usedActions) as $action)
            {
                Ability::create([
                    'name'     => $action . '_' . str_replace(' ','_',$category),
                    'category' => $category,
                    'action'   => $action,
                ]);
            }
        }


        $superAdminRole = Role::create([
            'name_ar' => 'مدير تنفيذي',
            'name_en' => 'super admin',
        ]);


        $employeeRole  = Role::create([
            'name_ar'    => 'صلاحيات إفتراضية',
            'name_en'    => 'default roles',
        ]);


        $superAdminAbilitiesIds = Ability::pluck('id');
        $employeeAbilitiesIds   = Ability::whereIn('category',[ 'cars' , 'brands' , 'models' , 'colors' ] )->whereIn('action' , ['view' , 'show'])->get();

        $superAdminRole->abilities()->attach( $superAdminAbilitiesIds );
        $employeeRole->abilities()->attach( $employeeAbilitiesIds );

        Employee::find(1)->assignRole($superAdminRole);
        Employee::find(1)->assignRole($employeeRole);
        Employee::find(2)->assignRole($superAdminRole);
        Employee::find(2)->assignRole($employeeRole);

    }
}
