<?php

abstract class Base_Chart
{
    protected $data;
    protected $name;
    protected static $colorValues = array( array("#F7464A", "#FF5A5E")  #0 RED
								         , array("#46BFBD", "#5AD3D1")  #1 SKY BLUE 
								         , array("#FDB45C", "#FFC870")  #2 LIGHT ORANGE
								         , array("#949FB1", "#A8B3C5")  #3 GRAY
								         , array("#4D5360", "#616774")  #4 DARK GRAY
								         , array("#3366CC", "#5C85D6")  #5 BLUE
								         , array("#9900FF", "#B84DFF")  #6 PURPLE
								         , array("#00FF99", "#4DFFB8")  #7 SEAFOAM GREEN
								         , array("#FF7519", "#FF9147")  #8 ORANGE
								         , array("#191975", "#474791")  #9 NAVY BLUE
                                         );

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