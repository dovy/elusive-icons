<?php

    // Include the various filters, categories, and alias keys
    include( 'alias_filter_categories.php' );

    function cleanIcon($icon) {
        global $iconData;
        $icon['name'] = ucwords( str_replace( '-', ' ', $icon['name'] ) );

        // Filters
        $filter_parts = explode( '-', $icon['id'] );
        $icon['filter'] = $filter_parts;
        if ( ! in_array( $icon['name'], $icon['filter'] ) ) {
            $icon['filter'][] = $icon['name'];
        }
        if ( ! in_array( $icon['id'], $icon['filter'] ) ) {
            $icon['filter'][] = $icon['id'];
        }
        $icon['filter'][] = $icon['name'];
        $icon['filter']           = array_unique( $icon['filter'] );

        if (isset($iconData[$icon['id']])) {
            // Filters
            if (isset($iconData[$icon['id']]['filters']) && !empty($iconData[$icon['id']]['alias'])) {
                if (!is_array($iconData[$icon['id']]['filters'])) {
                    $iconData[$icon['id']]['filters'] = array($iconData[$icon['id']]['filters']);
                }
                foreach($iconData[$icon['id']]['filters'] as $filter) {
                    $icon['filter'][] = $filter;
                }
                $icon['filter']     = array_unique( $icon['filter'] );
            }

            // Alias
            if (isset($iconData[$icon['id']]['alias']) && !empty($iconData[$icon['id']]['alias'])) {
                if (!is_array($iconData[$icon['id']]['alias'])) {
                    $iconData[$icon['id']]['alias'] = array($iconData[$icon['id']]['alias']);
                }
                $icon['alias'] = $iconData[$icon['id']]['alias'];
                $icon['alias']     = array_unique( $icon['alias'] );
            }
            // Categories
            if (isset($iconData[$icon['id']]['categories']) && !empty($iconData[$icon['id']]['categories'])) {
                if (!is_array($iconData[$icon['id']]['categories'])) {
                    $iconData[$icon['id']]['categories'] = array($iconData[$icon['id']]['categories']);
                }
                $icon['categories'] = $iconData[$icon['id']]['categories'];
                $icon['categories']     = array_unique( $icon['categories'] );
            }
        }

        if (!isset($icon['categories']) || empty($icon['categories'])) {
            $icon['categories'] = array( "New Icons" );
        }

        return $icon;

    }

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

    // Add an empty item for new items
    if ( ! empty( $icons ) ) {
        foreach ( $icons as $icon => $unicode ) {
            $newIcon         = array(
                'name'       => $icon,
                'id'         => $icon,
                'unicode'    => $unicode,
                'created'    => "2.0",
                'filter'     => array(),
                'categories' => array( 'Unsorted Icons' )
            );
            $data['icons'][] = $newIcon;
        }
    }

    // Adding in the filters and such.
    foreach ( $data['icons'] as $key => $icon ) {
        unset($icon['categories']);
        $icon = cleanIcon($icon);
        $data['icons'][ $key ] = $icon;
    }

    //echo (Spyc::YAMLDump($data,2,false,true));
    file_put_contents( dirname( __FILE__ ) . '/../src/icons.yml', Spyc::YAMLDump( $data, 2, false, true ) );
    echo "built yaml...";

    //    print_r($data);
