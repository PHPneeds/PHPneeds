<?php declare( strict_types=1 );

return (object) array(
    'TYPE' => 'mysql',
    'HOST' => 'localhost',
    'PORT' => '3306',
    'NAME' => 'test_phpneeds2',
    'USER' => 'test_phpneeds2',
    'PASS' => 'rJT4wbSeY26RTfzz',

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
