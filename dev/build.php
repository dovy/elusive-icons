<?php

    $icons = json_decode( file_get_contents( 'elusiveicons.css' ), true );

    require_once "spyc/spyc.php";
    $data    = Spyc::YAMLLoad( dirname( __FILE__ ) . '/../src/icons.yml' );
    $newyaml = array();
    foreach ( $data['icons'] as $key => $value ) {
        if ( ! isset( $icons[ $value['id'] ] ) ) {
            unset( $data['icons'][ $key ] );
        } else {
            $data['icons'][ $key ]['unicode'] = $icons[ $value['id'] ];
            unset( $icons[ $value['id'] ] );
        }
    }
    if ( ! empty( $icons ) ) {
        foreach ( $icons as $icon => $unicode ) {
            $data['icons'][] = array(
                'name'       => $icon,
                'id'         => $icon,
                'unicode'    => $unicode,
                'created'    => "2.0",
                'filter'     => array(
                    $icon
                ),
                'categories' => array( 'Web Application Icons' )
            );
        }
    }

    //echo (Spyc::YAMLDump($data,2,false,true));
    file_put_contents( dirname( __FILE__ ) . '/../src/icons.yml', Spyc::YAMLDump( $data, 2, false, true ) );


    //    print_r($data);
