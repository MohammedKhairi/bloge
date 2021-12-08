<?php

function refresh($page,$sec)
	{
        echo"
            <meta http-equiv='refresh' content='".$sec."; url=".$page."'/>
        ";
    }
?>