<?php

abstract class Base_Chart
{
    protected $data;
    protected $name;
    protected static $colorValues = array(  array("#F7464A", "#FF5A5E")
								         , array("#46BFBD", "#5AD3D1")
								         , array("#FDB45C", "#FFC870")
								         , array("#949FB1", "#A8B3C5")
								         , array("#4D5360", "#616774")
								         , array("#3366CC", "#5C85D6")
								         , array("#9900FF", "#B84DFF")
								         , array("#00FF99", "#4DFFB8")
								         , array("#FF7519", "#FF9147")
								         , array("#191975", "#474791") );

    public function __construct( $name, $data = array() )
    {
        $this->SetName( $name );
        $this->SetData( $data );
    }

    public function SetName( $name )
    {
        $this->name = $name;
    }

    public function GetName()
    {
        return $this->name;
    }

    public function SetData( $data )
    {
        $this->data = $data;
    }

    public function AddDatum( $datum )
    {
        $this->data[] = $datum;
    }

    public function GetColorScheme( $idx )
    {
        $idx = $idx % count( Base_Chart::$colorValues );
        return Base_Chart::$colorValues[ $idx ];
    }

    public abstract function GetJavaScript_DataSet( $var_idx );
    public abstract function GetJavaScript_CreateChart( $var_idx );
}

?>