<?php declare( strict_types=1 );

return (object) array(
    'TYPE' => 'mysql',
    'HOST' => 'localhost',
    'PORT' => '3306',
    'NAME' => 'test_phpneeds',
    'USER' => 'test_phpneeds',
    'PASS' => 'rb2RZPtwf8zmnpEC',

    'TABLES' => (object) array(

        'USER' => (object) array(
            'NAME'       => 'users',
            'COLLATE'    => 'utf8mb4_general_ci',
            'PRIMARYKEY' => 'ID',

            'FIELDS' => array(

                'ID' => array(
                    'NAME'           => 'ID',
                    'TYPE'           => 'INT',
                    'LENGHT'         => '11',
                    'AUTO_INCREMENT' => 'AUTO_INCREMENT'
                ),

                'USERNAME' => array(
                    'NAME'           => 'username',
                    'TYPE'           => 'VARCHAR',
                    'LENGHT'         => '50',
                    'AUTO_INCREMENT' => ''
                ),

                'PASSWORD' => array(
                    'NAME'           => 'password',
                    'TYPE'           => 'VARCHAR',
                    'LENGHT'         => '50',
                    'AUTO_INCREMENT' => ''
                )
            )
        )
    )
);
