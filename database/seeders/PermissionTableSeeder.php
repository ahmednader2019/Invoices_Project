<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'Invoices',
            'Invoices menu',
            'Paid Invoices',
            ' Unpaid Invoices',
            ' half paid Invoices',
            'Archieve',
            'Reports' ,
            'Invoices Reports' ,
            'Invoice Clients' ,
            'Users' ,
            'Users menu' ,
            'Users Permissons' ,
            'Settings' ,
            'Sections' ,
            'products'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
