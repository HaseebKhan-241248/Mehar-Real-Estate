<?php

return [
    [
        'name'       => 'Dashboard',
        'id'         => '1',
        'parent'         => true,
        'operations' => ['','Read'],
    ],

    [
        'name'       => 'Charts of Accounts',
        'id'         => '2',
        'parent'         => true,
        'operations' => ['','Read'],
    ],
    [
        'name'        => 'Add New',
        'id'          => '3',
        'parent_id'   => '2',
        'operations'  => ['Create','Read','Update',''],
    ],
    [
        'name'        => 'Manage Accounts',
        'id'          => '4',
        'parent_id'   => '2',
        'operations'  => ['Create','Read','Update','Delete'],
    ],


    [
        'name'        => 'Partners',
        'id'          => '5',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],

    [
        'name'        => 'Manage Partners',
        'id'          => '6',
        'parent_id'   => '5',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Partners Share',
        'id'          => '7',
        'parent_id'   => '5',
        'operations'  => ['','Read','Pay',''],
    ],

    [
        'name'        => 'Customers',
        'id'          => '8',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],

    [
        'name'        => 'Manage Customers',
        'id'          => '9',
        'parent_id'   => '8',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Dealers',
        'id'          => '10',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],

    [
        'name'        => 'Manage Dealers',
        'id'          => '11',
        'parent_id'   => '10',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Marketers',
        'id'          => '12',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],

    [
        'name'        => 'Manage Marketers',
        'id'          => '13',
        'parent_id'   => '12',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Inventory Management',
        'id'          => '14',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],

    [
        'name'        => 'Manage Projects',
        'id'          => '15',
        'parent_id'   => '14',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Manage Sectors',
        'id'          => '16',
        'parent_id'   => '14',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Manage Blocks',
        'id'          => '17',
        'parent_id'   => '14',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Manage Plots',
        'id'          => '18',
        'parent_id'   => '14',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Bookings',
        'id'          => '19',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],

    [
        'name'        => 'Add New Booking',
        'id'          => '20',
        'parent_id'   => '19',
        'operations'  => ['Create','Read','Update','Delete','Marketers Commision','Dealer Commision'],
    ],

    [
        'name'        => 'Manage Booking',
        'id'          => '21',
        'parent_id'   => '19',
        'operations'  => ['','Read','Update','Payment Schedule','Pay Amount','Receipts','Confirmation Sheet','Update Intiqal','Allotment Letter'],
    ],


    [
        'name'        => 'Master',
        'id'          => '22',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],

    [
        'name'        => 'Add Plot Marla',
        'id'          => '23',
        'parent_id'   => '22',
        'operations'  => ['Create','Read','Update',''],
    ],

    [
        'name'        => 'Add Installment Head',
        'id'          => '24',
        'parent_id'   => '22',
        'operations'  => ['Create','Read','Update',''],
    ],

    [
        'name'        => 'User Roles & Permission',
        'id'          => '25',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],


    [
        'name'        => 'Manage Users',
        'id'          => '26',
        'parent_id'   => '25',
        'operations'  => ['Create','Read','Update',''],
    ],
    [
        'name'        => 'Journal Voucher',
        'id'          => '27',
        'parent_id'   => '2',
        'operations'  => ['Create','Read','Update','Delete'],
    ],
    [
        'name'        => 'Bank Receipt Voucher',
        'id'          => '28',
        'parent_id'   => '2',
        'operations'  => ['Create','Read','Update','Delete'],
    ],
    [
        'name'        => 'Cash Voucher',
        'id'          => '29',
        'parent_id'   => '2',
        'operations'  => ['Create','Read','Update','Delete'],
    ],
    [
        'name'        => 'Debit Voucher',
        'id'          => '30',
        'parent_id'   => '2',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Add Sub Account Category',
        'id'          => '31',
        'parent_id'   => '2',
        'operations'  => ['Create','Read','Update','Delete'],
    ],

    [
        'name'        => 'Accounting Reports',
        'id'          => '32',
        'parent'      => true,
        'operations'  => ['','Read','',''],
    ],

    [
        'name'        => 'General Journal',
        'id'          => '33',
        'parent_id'   => '32',
        'operations'  => ['','Generate Report','',''],
    ],


]

?>
