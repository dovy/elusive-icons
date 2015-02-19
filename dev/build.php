<?php

    $icons = json_decode( file_get_contents( 'elusiveicons.css' ), true );

    include('alias_filter_categories.php');

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
            $name            = ucwords( str_replace( '-', ' ', $icon ) );
            $filter_parts = explode('-', $icon);
            if (isset($filters[$icon])) {
                foreach($filter_parts as $key) {
                    if (!in_array($key, $filters[$icon])) {
                        $filters[$icon][] = $key;
                    }
                }
            } else {
                $filter = $filter_parts;
            }
            if (!in_array($name, $filters[$icon])) {
                $filters[$icon][] = $name;
            }
            if (!in_array($icon, $filters[$icon])) {
                $filters[$icon][] = $icon;
            }

            $filters[] = $name;
            $newIcon = array(
                'name'       => $name,
                'id'         => $icon,
                'unicode'    => $unicode,
                'created'    => "2.0",
                'filter'     => $filters[$icon],
                'categories' => array( 'Web Application Icons' )
            );
            if (isset($alias[$icon])) {
                $newIcon['aliases'] = $alias[$icon];
            }
            $data['icons'][] = $newIcon;
        }
    }

    //echo (Spyc::YAMLDump($data,2,false,true));
    file_put_contents( dirname( __FILE__ ) . '/../src/icons.yml', Spyc::YAMLDump( $data, 2, false, true ) );


    //    print_r($data);
